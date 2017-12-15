<?php

class ContextlyKitPackageAssetsAggregator extends ContextlyKitBase {

  /**
   * @var ContextlyKitPackageManager
   */
  protected $manager;

  /**
   * @var \Monolog\Logger
   */
  protected $log;

  /**
   * @var \Symfony\Component\Filesystem\Filesystem
   */
  protected $fs;

  protected $sourceBase;
  protected $targetBase;

  /**
   * @var ContextlyKitAssetsConfigAggregated[]
   */
  protected $aggregated = array();

  protected $media = array();

  /**
   * @param ContextlyKit $kit
   * @param ContextlyKitPackageManager $manager
   */
  public function __construct($kit, $manager) {
    parent::__construct($kit);

    $this->manager = $manager;
    $this->log = $manager->getLog();
    $this->fs = $manager->getFs();

    $this->sourceBase = $this->kit->getFolderPath('client/src', TRUE);
    $this->targetBase = $this->kit->getFolderPath('client/aggregated', TRUE);
  }

  protected function getAssetFileName($packageName) {
    return str_replace('/', '--', $packageName);
  }

  protected function aggregateLicenses() {
    // TODO Automatically extract and aggregate all the licenses.
    $filename = 'licenses.txt';
    $source = $this->kit->getFolderPath('client/src', TRUE) . '/' . $filename;
    $target = $this->kit->getFolderPath('client/aggregated', TRUE) . '/' . $filename;
    $this->fs->copy($source, $target);
  }

  public function cleanup() {
    $paths = array(
      $this->kit->getFolderPath('client/aggregated', TRUE),
      $this->kit->getFolderPath('config/aggregated', TRUE),
    );
    foreach ($paths as $path) {
      if (file_exists($path)) {
        $iterator = new \FilesystemIterator($path);
        $this->fs->remove($iterator);
      }
      else {
        $this->fs->mkdir($path);
      }
    }

    $this->aggregated = array();
    $this->media = array();
  }

  /**
   * @param ContextlyKitAssetsPackage $package
   * @param ContextlyKitAssetsConfigAggregated $config
   */
  protected function addIncludes($package, $config) {
    $include = $package->getIncluded();
    if (!empty($include)) {
      $config->include = $include;
    }
  }

  /**
   * @param ContextlyKitAssetsPackage $package
   */
  protected function aggregateMedia($package) {
    $media = $package->getMedia();
    if (empty($media)) {
      return;
    }

    foreach ($media as $path) {
      if (isset($this->media[$path])) {
        continue;
      }
      $this->media[$path] = TRUE;

      $source_path = $this->sourceBase . '/' . $path;
      $target_path = $this->targetBase . '/' . $path;
      if (is_dir($source_path)) {
        $this->fs->mirror($source_path, $target_path, NULL, array('override' => TRUE));
      }
      else {
        $this->fs->copy($source_path, $target_path, TRUE);
      }
    }
  }

  protected function convertCssUrlsToAbsolute($code, $source_folder) {
    $callback = function($matches) use ($source_folder) {
      $prefix = $matches[1];
      $url_value = trim($matches[2]);
      if (!stream_is_local($url_value)) {
        return $matches[0];
      }

      // Cut-off URL arguments and/or fragment.
      $url_suffix = '';
      $parts = preg_split('@([\?\#])@', $url_value, 2, PREG_SPLIT_DELIM_CAPTURE);
      if (count($parts) === 3) {
        list($url_value, $delimiter, $url_suffix) = $parts;
        $url_suffix = $delimiter . $url_suffix;
      }

      // Resolve double dots and other relative things on the path.
      $real_path = realpath($source_folder . '/' . $url_value);
      if ($real_path === FALSE) {
        throw $this->kit->newException('Unable to build aggregated path for the media "' . $url_value . '" on the CSS file.');
      }

      // Build media path relative to the "client/src" folder, it will be
      // exactly the same from "client/aggregated" folder.
      $relative_path = $this->manager->buildRelativeFilePath($real_path, $this->sourceBase);

      // Set updated media URL back to the document.
      return
        $prefix
        . $this->kit->buildCdnUrl($relative_path, array(
          'protocol-required' => FALSE,
        ))
        . $url_suffix;
    };

    return preg_replace_callback('@(url\(\s*[\'"]?)([^\'"\)]+)@', $callback, $code);
  }

  /**
   * @param string $packageName
   * @param ContextlyKitAssetsPackage $package
   * @param ContextlyKitAssetsConfigAggregated $config
   *
   * @return mixed|void
   */
  public function aggregateCss($packageName, $package, $config) {
    $css = $package->getCss();
    if (empty($css)) {
      return;
    }

    $target_name = $this->getAssetFileName($packageName);
    $target_path = $this->targetBase . '/' . $target_name . '.css';
    $command = $this->kit->newExecCommand('cleancss')
      ->args(array(
        'output' => $target_path,
        'skip-import-from' => 'remote',
        'skip-advanced' => NULL,
        'skip-aggressive-merging' => NULL,
        'skip-media-merging' => NULL,
        'skip-restructuring' => NULL,
        'skip-shorthand-compacting' => NULL,
        's1' => NULL,
        'rounding-precision' => '-1',
        'source-map' => NULL,
      ));

    // Put licensing info into a file, since the minifier doesn't support adding
    // it through an option.
    $license_path = $this->targetBase . '/licensing.css';
    if (!$this->fs->exists($license_path)) {
      $code = '/*! ' . $this->manager->getLicenseInfo() . ' */' . "\n";
      $this->fs->dumpFile($license_path, $code);
    }
    $command->file($license_path);

    // For source maps to work properly we should serve source files from CDN.
    // We also have to turn all the relative URLs into absolute, because CSS
    // loader inserts code right into the page content and relative URLs won't
    // work.
    foreach ($css as $path) {
      $source_path = $this->sourceBase . '/' . $path . '.css';
      $copy_path = $this->targetBase . '/' . $path . '.css';

      $code = file_get_contents($source_path);
      $this->fs->dumpFile($copy_path, $this->convertCssUrlsToAbsolute($code, dirname($source_path)));

      $command->file($copy_path);
    }

    $command
      ->errorsOutput()
      ->exec()
      ->requireSuccess('Unable to aggregate CSS files of the "' . $packageName . '" package.');

    // Fill the aggregated config.
    $config->css[] = $target_name;
  }

  /**
   * @param string $packageName
   * @param ContextlyKitAssetsPackage $package
   * @param \ContextlyKitAssetsConfigAggregated $config
   *
   * @return mixed
   */
  protected function aggregateTpl($packageName, $package, $config) {
    $templates = $package->getTpl();
    if (empty($templates)) {
      return;
    }

    $target_name = $this->getAssetFileName($packageName) . '.tpl';
    $temp_base = $this->manager->getTempPath() . '/tpl';

    // Compile templates at once into a single file. We can't override template
    // name, so we just copy all of them to a temporary folder with proper names.
    $compiled_path = $temp_base . '/' . $target_name . '.js';
    $command = $this->kit->newExecCommand('handlebars');
    foreach ($templates as $name => $path) {
      $temp_path = $temp_base . '/' . $path . '/' . $name . '.handlebars';
      $this->fs->copy($this->sourceBase . '/' . $path . '.handlebars', $temp_path);
      $command->file($temp_path);
    }
    $command
      ->args(array(
        'namespace' => 'Contextly.templates',
        'output' => $compiled_path,
      ))
      ->errorsOutput()
      ->exec()
      ->requireSuccess('Unable to compile "' . $packageName . '" package templates.');

    $target_path = $this->targetBase . '/' . $target_name . '.js';
    $this->kit->newExecCommand('uglifyjs')
      ->file($compiled_path)
      ->args(array(
        'output' => $target_path,
        'compress' => NULL,
      ))
      ->errorsOutput()
      ->exec()
      ->requireSuccess('Unable to compress compiled "' . $packageName . '" package templates');

    // Fill the aggregated config.
    $config->tpl[] = $target_name;
  }

  /**
   * @param string $packageName
   * @param ContextlyKitAssetsPackage $package
   * @param ContextlyKitAssetsConfigAggregated $config
   */
  protected function aggregateData($packageName, $package, $config) {
    $code = $this->kit->newDataManager($package->buildDataPaths())
      ->addVersions($package->containsVersions())
      ->compile(FALSE);
    if ($code === '') {
      return;
    }

    $target_name = $this->getAssetFileName($packageName) . '.data';
    $target_path = $this->targetBase . '/' . $target_name . '.js';
    $this->fs->dumpFile($target_path, $code);

    $config->js[] = $target_name;
  }

  /**
   * @param string $parentName
   * @param ContextlyKitAssetsPackage $parentPackage
   * @param ContextlyKitAssetsConfigAggregated $config
   */
  protected function aggregateExposed($parentName, $parentPackage, $config) {
    // To build exposed structure for the package we take list of manually
    // listed packages and add all their dependencies. To expose aggregated data
    // and not the source one, we use aggregated configs and fill package with
    // them.
    $tree = array();
    $expose = array_flip($parentPackage->getExposed());
    while (!empty($expose)) {
      $slice = array_splice($expose, 0, 1);
      $name = key($slice);
      if (empty($this->aggregated[$name])) {
        throw $this->kit->newException('Unable to expose package ' . $name . ' from package ' . $parentName . ', because it was not aggregated.');
      }

      $aggregated = $this->aggregated[$name];
      $include = $aggregated->include ?: array();

      $package = $this->kit->newAssetsPackage()
        ->addConfig($aggregated)
        ->addIncluded(array_fill_keys($include, TRUE));
      $tree[$name] = $package->toExposed();

      // Add all the dependencies of exposed packages to the pool, order is not
      // important here.
      foreach ($include as $name) {
        if (!isset($tree[$name]) && !isset($expose[$name])) {
          $expose[$name] = TRUE;
        }
      }
    }
    if (empty($tree)) {
      return;
    }
    $code = $this->kit->newExposedAssetsManager($tree)
      ->compile(FALSE);

    $target_name = $this->getAssetFileName($parentName) . '.expose';
    $target_path = $this->targetBase . '/' . $target_name . '.js';
    $this->fs->dumpFile($target_path, $code);

    $config->js[] = $target_name;
  }

  /**
   * @param string $packageName
   * @param ContextlyKitAssetsPackage $package
   * @param ContextlyKitAssetsConfigAggregated $config
   */
  protected function aggregateJs($packageName, $package, $config) {
    $js = $package->getJs();
    $compiledJs = isset($config->js) ? $config->js : array();
    $compiledTpls = isset($config->tpl) ? $config->tpl : array();
    if (empty($js) && empty($compiledJs) && empty($compiledTpls)) {
      return;
    }

    $command = $this->kit->newExecCommand('uglifyjs');

    // Aggregate compiled data before the main files.
    foreach ($compiledJs as $path) {
      $command->file($this->targetBase . '/' . $path . '.js');
    }
    $config->js = array();

    // For source maps to work properly we should serve source files from CDN
    // too, so we mirror JS source to the aggregated folder and then compile
    // them all into a single file.
    foreach ($js as $path) {
      $source_path = $this->sourceBase . '/' . $path . '.js';
      $copy_path = $this->targetBase . '/' . $path . '.js';
      $this->fs->copy($source_path, $copy_path);

      $command->file($copy_path);
    }

    // Append templates, as they depend on the Handlebars runtime.
    foreach ($compiledTpls as $path) {
      $command->file($this->targetBase . '/' . $path . '.js');
    }
    unset($config->tpl);

    $target_name = $this->getAssetFileName($packageName);
    $target_path = $this->targetBase . '/' . $target_name . '.js';
    $map_path = $this->targetBase . '/' . $target_name . '.js.map';
    $command
      ->args(array(
        'output' => $target_path,
        'compress' => NULL,
        'source-map' => $map_path,
        'prefix' => 'relative',
        'preamble' => '/* ' . $this->manager->getLicenseInfo() . ' */',
      ))
      ->errorsOutput()
      ->exec()
      ->requireSuccess('Unable to aggregate JS files of the "' . $packageName . '" package.');

    // Fill the aggregated config.
    $config->js[] = $target_name;
  }

  /**
   * @param string $packageName
   * @param ContextlyKitAssetsConfigAggregated $config
   */
  protected function saveConfig($packageName, $config) {
    $base_path = $this->kit->getFolderPath('config/aggregated', TRUE);
    $target_path = $base_path . '/' . $packageName . '.json';
    $this->fs->dumpFile($target_path, $config->export());
    $this->aggregated[$packageName] = $config;
  }

  /**
   * @param ContextlyKitAssetsPackage[] $packages
   */
  public function aggregate($packages) {
    $this->log->addInfo('Preparing folders for aggregated files.');
    $this->cleanup();

    // Copy license file.
    $this->log->addInfo('Aggregating licenses.');
    $this->aggregateLicenses();

    foreach ($packages as $packageName => $package) {
      $this->log->addInfo('Aggregating "' . $packageName . '" package assets.');

      $config = $this->kit->newAssetsConfigAggregated($this, $this->manager->getFs(), $packageName);

      $this->addIncludes($package, $config);
      $this->aggregateMedia($package);
      $this->aggregateCss($packageName, $package, $config);
      $this->aggregateData($packageName, $package, $config);
      $this->aggregateExposed($packageName, $package, $config);
      $this->aggregateTpl($packageName, $package, $config);
      $this->aggregateJs($packageName, $package, $config);

      $this->saveConfig($packageName, $config);
      $this->log->addInfo('Aggregated config of the "' . $packageName . '" package saved successfully.');
    }
  }

}

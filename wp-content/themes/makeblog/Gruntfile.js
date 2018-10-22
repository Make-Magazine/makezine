module.exports = function(grunt) {
  var watchFiles = [
    'less/**/*.less',
    'version-2/less/**/*.less',
    'reviews/less/**/**/*.less',
    'version-2/js/single-story/*.js',
    'js/footer-scripts/*.js',
    'gift-guide-fe/src/main.js',
    'gift-guide-fe/src/*.vue',
  ];
  var lessSrcFiles = {
    'css/style.css': 'less/style.less',
    'css/print.css': 'less/print.less',
    'version-2/css/style.css': 'version-2/less/style.less',
    'reviews/css/master.css': 'reviews/less/master.less'
  };
  // All configurations go here
  grunt.initConfig({

    // Reads the package.json file
    pkg: grunt.file.readJSON('package.json'),

    // Each Grunt plugins configurations will go here
    less: {
      prod: {
        options: {
          compress: true
        },
        files: lessSrcFiles
      },
      dev: {
        options: {
          compress: false,
          dumpLineNumbers: 'comments'
        },
        files: lessSrcFiles
      }
    },
    browserify: {
      bundle: {
        src: 'gift-guide-fe/src/main.js',
        dest: 'gift-guide-fe/dist/main.js'
      },
      options: {
        browserifyOptions: {
          debug: true
        },
        transform: [
          [
            'vueify',
            ['babelify', { presets: "es2015" }]
         ]
        ]
      }
    },

    // Concat js files
    concat: {
      options: {
        banner: '// Compiled file - any changes will be overwritten by grunt task\n',
        separator: ';',
        process: function(src, filepath) {
          return '//!!\n//!! ' + filepath + '\n' + src;
        }
      },
      dist: {
        files: {
          'version-2/js/single-story.js': ['version-2/js/single-story/*.js'],
          'js/footer-scripts/min/misc.js': ['js/footer-scripts/*.js'],
        }
      },
    },
    uglify: {
      js: {
        options: {
          mangle: false,
          banner: '// Compiled file - any changes will be overwritten by grunt task\n',
        },
        files: {
          'version-2/js/single-story.js': 'version-2/js/single-story.js',
          'js/footer-scripts/min/misc.min.js': 'js/footer-scripts/min/misc.js',
          'gift-guide-fe/dist/main.min.js': 'gift-guide-fe/dist/main.js',
        }
      }
    },
    watch: {
      prod: {
        files: watchFiles,
        tasks: ['less:prod', 'concat', 'browserify', 'uglify']//, 'babel']
      },
      dev: {
        files: watchFiles,
        tasks: ['less:dev', 'concat', 'browserify']//, 'babel']
      },
      reload: {
        files: watchFiles,
        tasks: ['less'],
        options: {
          livereload: true
        }
      }
    }
  });

  // Simplify the repetivite work of listing each plugin in grunt.loadNpmTasks(), just get the list from package.json and load them...
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  // Register the tasks with Grunt
  // To only watch for less changes and process without browser reload type in "grunt"
  grunt.registerTask('default', ['less:prod', 'concat', 'uglify', 'watch:prod']);
  // Dev mode build task
  grunt.registerTask('dev', ['less:dev', 'concat', 'watch:dev']);
  // To watch for less changes and process them with livereload type in "grunt reload"
  grunt.registerTask('reload', ['less', 'watch:reload']);

};

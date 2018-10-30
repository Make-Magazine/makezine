module.exports = function(grunt) {
  var watchFiles = [
    'less/**/*.less',
    'version-2/less/**/*.less',
    'reviews/less/**/**/*.less',
    'version-2/js/single-story/*.js',
    'js/footer-scripts/*.js',
    'Vue/gift-guide/src/*.js',
    'Vue/gift-guide/src/*.vue',
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

   run: {
      options: {

      },
      gg_dev: {
         cmd: 'npm',
         args: [
           'run',
           'buildGG:dev'
         ]
      },
      gg_prod: {
         cmd: 'npm',
         args: [
           'run',
           'buildGG:prod'
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
          'js/footer-scripts/min/misc.min.js': 'js/footer-scripts/min/misc.js'
        }
      }
    },
    watch: {
      prod: {
        files: watchFiles,
        tasks: ['less:prod', 'concat', 'run:gg_prod', 'uglify']
      },
      dev: {
        files: watchFiles,
        tasks: ['less:dev', 'concat', 'run:gg_dev']
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
  grunt.loadNpmTasks('grunt-run');

  // Register the tasks with Grunt
  // To only watch for less changes and process without browser reload type in "grunt"
  grunt.registerTask('default', ['less:prod', 'concat', 'uglify', 'run:gg_prod', 'watch:prod']);
  // Dev mode build task
  grunt.registerTask('dev', ['less:dev', 'concat', 'run:gg_dev', 'watch:dev']);
  // To watch for less changes and process them with livereload type in "grunt reload"
  grunt.registerTask('reload', ['less', 'watch:reload']);

};

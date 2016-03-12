module.exports = function(grunt) {

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
        files: {
          'css/style.css': 'less/style.less',
          'css/print.css': 'less/make/print.less',
          'css/takeover.css': 'less/make/takeover.less',
          'css/day-of-making.css': 'less/day-of-making.less',
          'version-2/css/style.css': 'version-2/less/style.less',
          'reviews/css/master.css': 'reviews/less/master.less'
        }
      },
      dev: {
        options: {
          compress: false,
          dumpLineNumbers: 'comments'
        },
        files: {
          'css/style.css': 'less/style.less',
          'css/print.css': 'less/make/print.less',
          'css/takeover.css': 'less/make/takeover.less',
          'css/day-of-making.css': 'less/day-of-making.less',
          'version-2/css/style.css': 'version-2/less/style.less',
          'reviews/css/master.css': 'reviews/less/master.less'
        }
      }
    },
    sass: {
      prod: {
        options: {
          style: 'compressed', noCache: true
        },
        files: {
          'version-2/css/bootstrap.min.css': 'version-2/less/bootstrap/bootstrap.scss'
        }
      },
      dev: {
        options: {
          style: 'expanded', lineNumbers: true, noCache: true
        },
        files: {
          'version-2/css/bootstrap.min.css': 'version-2/less/bootstrap/bootstrap.scss'
        }
      },
    },
    watch: {
      prod: {
        files: ['less/**/*.less', 'version-2/less/**/*.less', 'version-2/less/**/*.sass'],
        tasks: ['less:prod', 'sass:prod']
      },
      dev: {
        files: ['less/**/*.less', 'version-2/less/**/*.less', 'version-2/less/**/*.sass'],
        tasks: ['less:dev', 'sass:dev']
      },
      reload: {
        files: ['less/**/*.less'],
        tasks: ['less'],
        options: {
          livereload: true
        }
      }
    }
  });

  // Simplify the repetivite work of listing each plugin in grunt.loadNomTasks(), just get the list from package.json and load them...
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  // Register the tasks with Grunt
  // To only watch for less changes and process without browser reload type in "grunt"
  grunt.registerTask('default', ['less:prod', 'sass:prod', 'watch:prod']);
  // Dev mode build task
  grunt.registerTask('dev', ['less:dev', 'sass:dev', 'watch:dev']);
  // To watch for less changes and process them with livereload type in "grunt reload"
  grunt.registerTask('reload', ['less', 'watch:reload']);

};
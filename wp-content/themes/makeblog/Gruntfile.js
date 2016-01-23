module.exports = function( grunt ) {

	// All configurations go here
	grunt.initConfig({

		// Reads the package.json file
		pkg: grunt.file.readJSON( 'package.json' ),

		// Each Grunt plugins configurations will go here
		less: {
			development: {
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
			}
		},
		watch: {
			css: {
				files: ['less/**/*.less', 'version-2/less/**/*.less'],
				tasks: ['less']
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
	grunt.registerTask( 'default', ['less', 'watch:css'] );

	// To watch for less changes and process them with livereload type in "grunt reload"
	grunt.registerTask( 'reload', ['less', 'watch:reload'] );

};
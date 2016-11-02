module.exports = function(grunt) {

	"use strict";

	var banner = '/*! Copyright (C) StreamUX <http://www.streamux.com> */\n';
	var banner_jsux_js = banner + '/**!\n * @concat jsux.js \n * project <%= pkg.name %>\n * date <%= grunt.template.today("dd-mm-yyyy") %>\n @brief jsux Common Javascript\n **/\n';

	grunt.file.defaultEncoding = 'utf8';

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),
		clean: {
			minify: [
				'common/js/jsux*.js'
			]			
		},
		concat: {
			'common-js': {
				src: [
					'common/js/app/jsux_cookie.js',
					'common/js/app/jsux_popup.js',
					'common/js/app/jsux_pagination.js'
				],
				dest: 'common/js/jsux_common.js'
			},
			'common-admin-app': {
				src: [
					'common/js/app/jsux_admin_gnb_*.js'
				],
				dest: 'common/js/jsux_admin_app.js'
			},
			'common-app': {
				src: [					
					'common/js/app/jsux_gnb_*.js',
					'common/js/app/jsux_mobile_gnb.js',				
					'common/js/app/jsux_visual.js'		
				],
				dest: 'common/js/jsux_app.js'
			}
		},
		uglify: {
			'common-api': {
				options: {
					banner: banner_jsux_js
				},
				files: {
					'common/js/jsux.min.js': ['common/js/jsux/jsux-1.1.0.js']
				}
			},
			'common-apps': {
				files: {
					'common/js/jsux_common.min.js':['common/js/jsux_common.js'],
					'common/js/jsux_app.min.js':['common/js/jsux_app.js'],
					'common/js/jsux_app_stage.min.js': ['common/js/app/jsux_app_stage.js'],
					'common/js/jsux_admin_app.min.js':['common/js/jsux_admin_app.js'],
					'common/js/jsux_admin_app_stage.min.js': ['common/js/app/jsux_admin_app_stage.js']
				}
			}
		},
		cssmin: {
			'common': {
				files: {
					'common/css/sux_common.min.css': ['common/css/sux_common.css'],
					'common/css/sux_default.min.css': ['common/css/sux_default.css'],					
					'common/css/sux_layout.min.css': ['common/css/sux_layout.css']
				}
			}
		},
		jshint: {
			files: [
				'Gruntfile.js',
				'common/js/app/*.js',
				'modules/**/tpl/js/*.js',
				'modules/**/skin/**/js/*.js'
			],
			options: {				
				// options here to override JSHint defaults
				globals: {
					jQuery: true,
					console: true,	
					module: true,
					document: true
				},
				ignores: [
					'**/jquery*.js',
					'**/jquery-*.js',
					'**/jquery.*.js',
					'**/*.min.js',
					'common/js/idangerous*.js',
					'common/js/Tween*.js',
					'common/js/api/*.js',
					'test/**	'
				]
			}
		},
		csslint: {
			'common-css': {
				options: {
					import : 2,
					'adjoining-classes' : false,
					'box-model' : false,
					'duplicate-background-images' : false,
					'ids' : false,
					'important' : false,
					'order-alphabetical' : false,
					'overqualified-elements' : false,
					'qualified-headings' : false,
					'star-property-hack' : false,
					'underscore-property-hack' : false,
					'universal-selector' : false,
					'box-sizing' : false,
					'compatible-vendor-prefixes' : false
				},
				src: [					
					'common/css/*.css',		
					'modules/**/tpl/css/*.css',
					'!common/css/*.min.css',
					'!common/css/swiper*.css'	,
					'!common/css/api/*.css'
				]
			}			
		},
		phplint: {
			default: {
				options: {
					phpCmd: "php"
				}
			},
			src: [
				'classes/**/*.php',
				'config/*.php',
				'modules/**/*.php',
				'modules/board/skin/*.php',
				'modules/board/skin/**/*.php'
			]
		},
		watch: {
			files: ['<%= jshint.files %>'],
			tasks: ['jshint','csslint','phplint']
		}
	});

	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-csslint');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-phplint');

	grunt.registerTask('default', ['jshint', 'csslint']);
	grunt.registerTask('lint', ['jshint','csslint','phplint']);
	grunt.registerTask('minify', ['jshint','clean','concat','uglify','cssmin']);	
};
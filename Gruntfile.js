module.exports = function(grunt) {

	"use strict";

	var banner = '/*! Copyright (C) StreamUX <http://www.streamux.com> */\n';
	var banner_jsux_js = banner + '/**!\n * @concat jsux.js \n * project <%= pkg.name %>\n * date <%= grunt.template.today("dd-mm-yyyy") %>\n @brief jsux Common Javascript\n **/\n';

	grunt.file.defaultEncoding = 'utf8';

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		clean: {
			minify: [
				'common/js/jsux.js',
				'common/js/jsux.min.js',
				'common/js/gnb.js',
				'common/js/gnb.min.js',
				'common/js/visual.js',
				'common/js/visual.min.js'
			]			
		},
		concat: {
			'common-js': {
				options: {
					stripBanners: true,
					banner: banner_jsux_js
				},
				src: [
					'common/js/jsux/jsux-1.1.0.js'
				],
				dest: 'common/js/jsux.js'
			},
			'common-gnb': {
				src: [
					'common/js/app/gnb_*.js'
				],
				dest: 'common/js/gnb.js'
			},
			'main-visual': {
				src: [
					'common/js/app/visual_*.js'
				],
				dest: 'common/js/visual.js'
			}
		},
		uglify: {
			'common-js': {
				options: {
					banner: banner_jsux_js
				},
				files: {
					'common/js/jsux-1.0.0.min.js': ['common/js/jsux/jsux-1.0.0.js'],
					'common/js/jsux.min.js': ['common/js/jsux.js']
				}
			},
			'common-apps': {
				files: {
					'common/js/gnb.min.js':['common/js/gnb.js'],
					'common/js/visual.min.js': ['common/js/visual.js'],
					'common/js/navi.min.js': ['common/js/app/navi.js']
				}
			},
			'modules': {
				files:{
					// admin
					// board
					// install
					// login
					// mail
					// members
					// outlogin
					// popup
					// promotion
					// question
				}
			}
		},
		jshint: {
			files: [
				'Gruntfile.js',
				'common/js/*.js',
				'common/js/app/*.js',
				'modules/**/tpl/js/*.js'
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
					'overqualified-elements' : false,
					'qualified-headings' : false,
					'star-property-hack' : false,
					'underscore-property-hack' : false
				},
				src: [
					'common/css/*.css',
					'modules/**/tpl/css/*.css'
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
				'modules/**/*.php'
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
	grunt.registerTask('minify', ['jshint','csslint','clean','concat','uglify','cssmin']);	
};
/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.extraPlugins = 'uploadimage,embed';
	config.height = 300;
	//config.uploadUrl = jsux.rootPath + 'libs/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json';

      // Configure your file manager integration. This example uses CKFinder 3 for PHP.
      //config.filebrowserBrowseUrl = jsux.rootPath + 'libs/ckfinder/ckfinder.html';
      //config.filebrowserUploadUrl = jsux.rootPath + 'libs/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
      config.filebrowserImageBrowseUrl = jsux.rootPath + 'libs/ckfinder/ckfinder.html';     
      config.filebrowserImageUploadUrl = jsux.rootPath + 'libs/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';

      // The following options are not necessary and are used here for presentation purposes only.
      // They configure the Styles drop-down list and widgets to use classes.

      config.stylesSet = [
        { name: 'Narrow image', type: 'widget', widget: 'image', attributes: { 'class': 'image-narrow' } },
        { name: 'Wide image', type: 'widget', widget: 'image', attributes: { 'class': 'image-wide' } }
      ];

      // Load the default contents.css file plus customizations for this sample.
      config.contentsCss = [ CKEDITOR.basePath + 'contents.css', 'http://sdk.ckeditor.com/samples/assets/css/widgetstyles.css' ];

      // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
      // resizer (because image size is controlled by widget styles or the image takes maximum
      // 100% of the editor width).
      config.image2_alignClasses = [ 'image-align-left', 'image-align-center', 'image-align-right' ];
      config.image2_disableResizer = true;

      config.embed_provider = '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}';

      // set ui
      config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	config.removeButtons = 'Templates,Subscript,Superscript,Set language,Styles';
};

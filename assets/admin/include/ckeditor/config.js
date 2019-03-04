/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	var baseHref = document.getElementsByTagName('base')[0].href

	 config.language = 'en';
	 config.uiColor = '#E8E8E8';
     config.toolbar = [
    [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Format', 'Styles' ],
    ['NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote'],
    ['Image','Iframe','Youtube', 'Link', 'Unlink', 'Anchor', 'Table', 'HorizontalRule', 'SpecialChar', 'Maximize'],
    ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', 'Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt']
];
	config.extraPlugins = 'uploadwidget';
    config.extraPlugins = 'uploadimage';
    config.extraPlugins = 'youtube';
	config.youtube_width = '640';
	config.youtube_height = '480';
	config.youtube_related = true;
	config.youtube_older = false;
	config.youtube_privacy = false;
	config.youtube_autoplay = false;
	config.youtube_controls = true;
	config.youtube_disabled_fields = ['txtEmbed', 'chkAutoplay'];
    config.uploadUrl = baseHref+'/home/cmsupload';
};

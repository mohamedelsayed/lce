/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
/* this configuration is coded by:
 * Author "Mohamed Elsayed" 
 * Author Email "me@mohamedelsayed.net"
 * Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */ 
CKEDITOR.editorConfig = function( config ){
	// Define changes to default configuration here. For example:
	config.language = 'en';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = '/ckeditor/filemanager/browser/default/browser.html?Connector=ckeditor/filemanager/connectors/php/connector.php';	
	config.filebrowserImageBrowseUrl = '/ckeditor/filemanager/browser/default/browser.html?Type=Image&amp;Connector=ckeditor/filemanager/connectors/php/connector.php';
	config.filebrowserFlashBrowseUrl ='/ckeditor/filemanager/browser/default/browser.html?Type=Flash&amp;Connector=ckeditor/filemanager/connectors/php/connector.php';
	config.filebrowserUploadUrl = '/ckeditor/filemanager/connectors/php/upload.php?Type=File';
	config.filebrowserImageUploadUrl = '/ckeditor/filemanager/connectors/php/upload.php?Type=Image';
	config.filebrowserFlashUploadUrl = '/ckeditor/filemanager/connectors/php/upload.php?Type=Flash';
	config.font_names =
	'Arial/Arial, Helvetica, sans-serif;' +
	'Arial Black/Arial Black, Gadget, sans-serif;' +
	'Century Gothic/Century Gothic, sans-serif;' +
	'Comic Sans MS/Comic Sans MS, cursive;' +
	'Copperplate / Copperplate Gothic Light, sans-serif;' +
	'Courier New/Courier New, Courier, monospace;' +
	'Georgia/Georgia, serif;' +
	'Gill Sans / Gill Sans MT, sans-serif;' +
	'Impact/Impact, Charcoal, sans-serif;' +
	'Lucida Console/Lucida Console, Monaco, monospace;' +
	'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
	'Palatino Linotype/Palatino Linotype’, ‘Book Antiqua’, Palatino, serif;' +
	'Tahoma/Tahoma, Geneva, sans-serif;' +
	'Times New Roman/Times New Roman, Times, serif;' +
	'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
	'Verdana/Verdana, Geneva, sans-serif'; 
};
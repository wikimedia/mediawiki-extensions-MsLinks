<?php

$wgExtensionCredits['parserhook'][] = [
	'name' => 'MsLinks',
	'url' => 'https://www.mediawiki.org/wiki/Extension:MsLinks',
	'version' => '5.0',
	'descriptionmsg' => 'msl-desc',
	'license-name' => 'GPL-2.0+',
	'author' => [
		'[mailto:wiki@ratin.de Martin Schwindl]',
		'[mailto:wiki@keyler-consult.de Martin Keyler]',
		'[https://www.mediawiki.org/wiki/User:Sophivorus Sophivorus]'
	],
];

$wgResourceModules['ext.MsLinks'] = [
	'scripts' => 'MsLinks.js',
	'messages' => [
		'msl-tooltip',
		'msl-example-filename',
	],
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'MsLinks',
];

$wgAutoloadClasses['MsLinks'] = __DIR__ . '/MsLinks.body.php';

$wgMessagesDirs['MsLinks'] = __DIR__ . '/i18n';

$wgHooks['ParserFirstCallInit'][] = 'MsLinks::setHook';
$wgHooks['EditPage::showEditForm:initial'][] = 'MsLinks::start';
$wgHooks['LanguageGetMagic'][] = 'MsLinks::getMagicWord';

// Default configuration
$wgMSL_FileTypes = [
	'no' => 'no_icon.png',
	'jpg' => 'image_icon.png',
	'gif' => 'image_icon.png',
	'bmp' => 'image_icon.png',
	'png' => 'image_icon.png',
	'tiff' => 'image_icon.png',
	'tif' => 'image_icon.png',
	'ai' => 'image_ai_icon.png',
	'psd' => 'image_ps_icon.png',
	'pdf' => 'pdf_icon.png',
	'pps' => 'pps_icon.png',
	'ppt' => 'pps_icon.png',
	'pptx' => 'pps_icon.png',
	'xls' => 'xls_icon.png',
	'xlsx' => 'xls_icon.png',
	'doc' => 'doc_icon.png',
	'docx' => 'doc_icon.png',
	'dot' => 'doc_icon.png',
	'dotx' => 'doc_icon.png',
	'rtf' => 'doc_icon.png',
	'txt' => 'txt_icon.png',
	'html' => 'code_icon.png',
	'php' => 'code_icon.png',
	'exe' => 'exe_icon.gif',
	'asc' => 'txt_icon.png',
	'dwg' => 'dwg_icon.gif',
	'zip' => 'zip_icon.png',
	'mov' => 'movie_icon.png',
	'mpeg' => 'movie_icon.png',
	'mpg' => 'movie_icon.png',
	'wmv' => 'movie_icon.png',
	'avi' => 'movie_icon.png',
	'mp4' => 'movie_icon.png',
	'flv' => 'movie_flash_icon.png',
	'wma' => 'music_icon.png',
	'mp3' => 'music_icon.png',
	'wav' => 'music_icon.png',
	'mid' => 'music_icon.png',
];
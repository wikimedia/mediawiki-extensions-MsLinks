<?php
############################################################
# Author:
#Martin Schwindl, info@ratin.de
#
# Icons: 
#Silk icon set
#famfamfam.com, Mark James, a web developer from Birmingham, UK. 
#
# Usage:
#{{#l:dlink|Testfile.zip|Description|right}}
#{{#l:Testfile.zip}}
#
# LocalSettings.php:
#require_once("$IP/extensions/MsLinks/mslinks.php");
#$wgMSL_FileTypes = array(
#                          "no" => "no_icon.png",
#                          "jpg" => "image_icon.png", 
#                          "gif" => "image_icon.png", 
#                          "bmp" => "image_icon.png", 
#                          "png" => "image_icon.png", 
#                          "tiff" => "image_icon.png", 
#                          "tif" => "image_icon.png", 
#                          "ai" => "image_ai_icon.png",
#                          "psd" => "image_ps_icon.png", 
#                          "pdf" => "pdf_icon.png", 
#                          "pps" => "pps_icon.png", 
#                          "ppt" => "pps_icon.png", 
#                          "pptx" => "pps_icon.png", 
#                          "xls" => "xls_icon.png",
#                          "xlsx" => "xls_icon.png", 
#                          "doc" => "doc_icon.png", 
#                          "docx" => "doc_icon.png",
#                          "dot" => "doc_icon.png",
#                          "dotx" => "doc_icon.png",
#                          "rtf" => "doc_icon.png",
#                          "txt" => "txt_icon.png",
#                          "html" => "code_icon.png",
#                          "php" => "php_icon.png",
#                          "exe" => "exe_icon.gif",
#                          "asc" => "txt_icon.png",
#                          "zip" => "zip_icon.png",
#                          "mov"  => "movie_icon.png",
#                          "mpeg"  => "movie_icon.png",
#                          "mpg"  => "movie_icon.png",
#                          "wmv"  => "movie_icon.png",
#                          "avi"  => "movie_icon.png",
#                          "mp4"  => "movie_icon.png",
#                          "flv"  => "movie_flash_icon.png",
#                          "wma"  => "music_icon.png",
#                          "mp3"  => "music_icon.png",
#                          "wav"  => "music_icon.png",
#                          "mid"  => "music_icon.png"
#                   );
############################################################

if(! defined('MEDIAWIKI')) {
	die("This is a MediaWiki extension and can not be used standalone.\n");
}

$wgExtensionCredits['parserhook'][] = array(
	'name' => 'MsLinks',
	'url'  => 'http://www.ratin.de/mslinks.html',
	'description' => 'Erzeugt einem Link mit dem passenden Icon sowie einen Direkt- und Versionslink',
	'version' => '3.1',
	'author' => '[mailto:info@ratin.de info@ratin.de] | Ratin'
);
 
$dir = dirname(__FILE__).'/';
require_once('mslinks_body.php');

#$wgExtensionFunctions[] = "wfMsLinksSetup";
$wgHooks['EditPageBeforeEditButtons'][]='MsLinksAddButton';
$wgHooks['LanguageGetMagic'][] = 'wfMsLinksMagic';
$wgHooks['ParserFirstCallInit'][] = 'MsLinksRegisterHook';


// Tell MediaWiki that the parser function exists.
function MsLinksRegisterHook(&$parser) {
   $parser->setFunctionHook('mslink', 'wfMsLinksRender');
   return true; 
}
 
function wfMsLinksMagic( &$magicWords, $langCode ) {
	$magicWords['mslink'] = array(0,'l');
	return true;
}

function MsLinksAddButton(){
	global $wgOut,$wgScriptPath,$wgJsMimeType;
	$path =  $wgScriptPath.'/extensions/MsLinks';
	$wgOut->addScript( "<script type=\"{$wgJsMimeType}\">var path_button_msl='$path'; </script>\n" );
	$wgOut->addScriptFile( $path.'/mslinks.js' );
  	
	return true;
}


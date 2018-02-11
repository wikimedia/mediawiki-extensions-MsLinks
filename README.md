# MsLinks

The MsLinks extension adds a button to the editor that creates links to view or download files using icons appropriate to the file type.

## Installation

To install MsLinks, add the following to your LocalSettings.php:

wfLoadExtension( 'MsLinks' );

## Usage

To insert a basic link to view a file:
{{#l:Example.zip}}

To insert a link to download a file, with "Download this file" as text and with the icon aligned to the right:
{{#l:dlink|Example.zip|Download this file|right}}

## Configuration

If you want to change the icons for the different types of links, you may set the following BELOW the require_once line:

$wgMSL_FileTypes = [
	'jpg' => 'your_icon_for_jpgs.png',
	'gif' => 'your_icon_for_gifs.png',
	'doc' => 'your_icon_for_docs.png',
];

The icons should be in the MsLinks/images directory. The defaults are the following:

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
	'mid' => 'music_icon.png'
];

## Credits

* Developed and coded by Martin Schwindl (wiki@ratin.de)
* Idea, project management and bug fixing by Martin Keyler (wiki@keyler-consult.de)
* Updated, debugged and enhanced by Felipe Schenone (schenonef@gmail.com)
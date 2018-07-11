<?php

if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'MsLinks' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['MsLinks'] = __DIR__ . '/i18n';
	$wgExtensionMessagesFiles['MsLinksMagic'] = __DIR__ . '/MsLinks.i18n.magic.php';
	wfWarn(
		'Deprecated PHP entry point used for MsLinks extension. Please use wfLoadExtension instead, ' .
		'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
	return;
} else {
	die( 'This version of the MsLinks extension requires MediaWiki 1.25+' );
}


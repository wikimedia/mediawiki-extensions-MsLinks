<?php

use MediaWiki\EditPage\EditPage;
use MediaWiki\MediaWikiServices;
use MediaWiki\Title\Title;

class MsLinks {

	static function onShowEditFormInitial( EditPage $editPage, OutputPage $output ) {
		$output->addModules( 'ext.MsLinks' );
	}

	static function onParserFirstCallInit( Parser $parser ) {
		$parser->setFunctionHook( 'mslink', 'MsLinks::makeLink' );
	}

	static function makeLink( $parser, $type = 'no', $filename = '', $description = '', $align = '' ) {
		if ( $type !== 'dlink' && $type !== 'vlink' ) {
			$align = $description;
			$description = $filename;
			$filename = $type;
		}

		try {
			$title = Title::newFromText( $filename, NS_FILE );
			$file = MediaWikiServices::getInstance()->getRepoGroup()->findFile( $title );
			$namespace = ( is_object( $file ) && $file->exists() && $type !== 'dlink'  && $type !== 'vlink' ) ? ':Image' : 'Media';
		} catch ( Exception $exception ) {
			$namespace = 'Media';
		} 

		$extension = strtolower( substr( strrchr( $filename, '.' ), 1 ) );
		if ( !$description ) {
			if ( $extension ) {
				$description = substr( $filename, 0, ( strlen( $filename ) - ( strlen( $extension ) + 1 ) ) );
			} else {
				$description = $filename;
			}
		}

		// Icon
		$config = MediaWikiServices::getInstance()->getMainConfig();
		$path = $config->get( 'ScriptPath' );
		$filetypes = $config->get( 'MSL_FileTypes' );
		$icon = $filetypes['no'];
		foreach ( $filetypes as $key => $value ) { 
			if ( $key === $extension ) {
				$icon = $value;
				break;
			}
		}
		$image = '<img src="' . $path . '/extensions/MsLinks/images/' . $icon . '" />';
		$image = $parser->insertStripItem( $image );
		$image = "[[Media:$filename|$image]]";

		// File link
		$wikitext = "[[$namespace:$filename|$description]]";
		if ( $align === 'right' ) { 
			$wikitext = $wikitext . ' ' . $image;
		} else {
			$wikitext = $image.' ' . $wikitext;
		}

		return $wikitext;
	}
}

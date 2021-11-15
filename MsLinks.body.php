<?php

use MediaWiki\MediaWikiServices;

class MsLinks {

	static function start() {
		global $wgOut, $wgScriptPath;
		$wgOut->addModules( 'ext.MsLinks' );
		$path = $wgScriptPath . '/extensions/MsLinks';
		$wgOut->addScript( "<script type=\"text/javascript\">var msl_icon_path = \"$path\";</script>" );
		return true;
	}

	static function setHook( &$parser ) {
		$parser->setFunctionHook( 'mslink', 'MsLinks::render' );
		return true;
	}

	static function getMagicWord( &$magicWords, $langCode ) {
		$magicWords['mslink'] = [ 0, 'l' ];
		return true;
	}

	static function render( $parser, $type = 'no', $url = '', $description = '', $align = '' ) {
		global $wgOut, $wgScriptPath, $wgMSL_FileTypes;

		if ( $type !== 'dlink' && $type !== 'vlink' ) {
			$align = $description;
			$description = $url;
			$url = $type;
		}

		try {
			$title = Title::newFromText( $url, NS_FILE );
			if ( method_exists( MediaWikiServices::class, 'getRepoGroup' ) ) {
				// MediaWiki 1.34+
				$file = MediaWikiServices::getInstance()->getRepoGroup()->findFile( $title );
			} else {
				$file = wfFindFile( $title );
			}
			$base = ( is_object( $file ) && $file->exists() && $type !== 'dlink'  && $type !== 'vlink' ) ? ':Image' : 'Media';
		} catch ( Exception $exception ) {
			$base = 'Media';
		} 

		$extension = strtolower( substr( strrchr( $url, '.' ), 1 ) );
		if ( !$description ) {
			if ( $extension ) {
				$description = substr( $url, 0, ( strlen( $url ) - ( strlen( $extension ) + 1 ) ) );
			} else {
				$description = $url;
			}
		}

		// Defaults
		$wikitext = "[[$base:$url|$description]]";
		$image = "<img src=\"$wgScriptPath/extensions/MsLinks/images/" . $wgMSL_FileTypes['no'] . "\">";

		foreach ( $wgMSL_FileTypes as $key => $value ) { 
			if ( $key === $extension ) {
				$image = "<img title=\"$extension\" src=\"$wgScriptPath/extensions/MsLinks/images/$value\">"; 
			}
		}
		$image = $parser->insertStripItem( $image );
		$image = "[[$base:$url|$image]]";

		if ( $align === 'right' ) { 
			$wikitext = $wikitext . ' ' . $image;
		} else {
			$wikitext = $image . ' ' . $wikitext;
		}
		return $wikitext;
	}
}

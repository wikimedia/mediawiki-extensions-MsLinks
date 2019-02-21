<?php

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

		if ( $type !== 'dlink' and $type !== 'vlink' ) {
			$align = $description;
			$description = $url;
			$url = $type;
		}

		try {
			$title = Title::newFromText( $url, NS_FILE );
			$file = function_exists( 'wfFindFile' ) ? wfFindFile( $title ) : new Image( $title );
			$base = ( is_object( $file ) && $file->exists() ) ? ':Image' : 'Media';
		} catch( Exception $exception ) {
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

		//Defaults
		$wikitext = "[[$base:$url|$description]]";
		$image = "<img src=\"$wgScriptPath/extensions/MsLinks/images/" . $wgMSL_FileTypes['no'] . "\">";

		foreach ( $wgMSL_FileTypes as $key => $value ) { 
			if ( $key === $extension ) {
				$image = "<img title=\"$extension\" src=\"$wgScriptPath/extensions/MsLinks/images/$value\">"; 
			}
		}
		$image = $parser->insertStripItem( $image, $parser->mStripState );

		if ( $type !== 'vlink' and $type !== 'dlink' ) {
			$base = 'Media';
		}

		$image = "[[$base:$url|$image]]";

		if ( $align === 'right' ) { 
			$wikitext = $wikitext . ' ' . $image;
		} else {
			$wikitext = $image . ' ' . $wikitext;
		}
		return $wikitext;
	}
}

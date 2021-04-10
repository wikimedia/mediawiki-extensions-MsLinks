var msl_tooltip = mw.msg( 'msl-tooltip' );
var msl_icon = msl_icon_path + "/images/mslink_icon.png";
var msl_pre = "{{#l:";
var msl_peri = mw.msg( 'msl-example-filename' );
var msl_post = "}}";

if ( $.inArray( mw.config.get( 'wgAction' ), [ 'edit', 'submit' ] ) !== -1 ) {
	mw.loader.using( 'user.options', function () {
		if ( mw.user.options.get( 'usebetatoolbar' ) ) {
			$.when(
				mw.loader.using( 'ext.wikiEditor' ), $.ready
			).then( msl_addButton1 );
		} else {
			mw.loader.using( 'mediawiki.action.edit', msl_addButton2 );
		}
	});
}

function msl_addButton1() {
	$( '#wpTextbox1' ).wikiEditor( 'addToToolbar', {
        section: 'main',
        group: 'insert',
        tools: {
            MsLink: {
                label: msl_tooltip,
                type: 'button',
                icon: msl_icon,
                action: {
                    type: 'encapsulate',
					options: {
						pre: msl_pre, 
						peri: msl_peri,
						post: msl_post
					}
                }
            }
        }
    } );
}

function msl_addButton2() {
	mw.toolbar.addButton({
		imageFile: msl_icon,
		speedTip: mw.msg( 'msl-tooltip' ),
		tagOpen: msl_pre,
		tagClose: msl_post,
		sampleText: msl_peri,
		imageId: 'mslink'
	});
}
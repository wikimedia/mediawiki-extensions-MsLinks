const MsLinks = {

	init: function () {
		mw.hook( 'wikiEditor.toolbarReady' ).add( MsLinks.addButton );
	},

	addButton: function ( $textarea ) {
		$textarea.wikiEditor( 'addToToolbar', {
			section: 'main',
			group: 'insert',
			tools: {
				MsLink: {
					label: mw.msg( 'msl-tooltip' ),
					type: 'button',
					icon: mw.config.get( 'wgExtensionAssetsPath' ) + '/MsLinks/images/mslink_icon.png',
					action: {
						type: 'encapsulate',
						options: {
							pre: '{{#l:',
							post: '}}',
							peri: mw.msg( 'msl-example-filename' )
						}
					}
				}
			}
		} );
	}
};

$( MsLinks.init );

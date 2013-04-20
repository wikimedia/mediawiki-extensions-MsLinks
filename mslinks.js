if(typeof(add_buttons) != 'undefined'){
	add_buttons.push("msl");
}
		
$(document).ready(function () { //jquery
	
	var img_msl = "extensions/MsLinks/images/Wiki-Editor-Buttons_Li.png";
	var img_msl2 = path_button_msl +"/images/Wiki-Editor-Buttons_Li.png";
	var nam_msl = "Direktlink";
	var pre_msl = "{{#l:";
	var peri_msl = "Filename.ext";
	var post_msl = "\}\}";
	
	if ( $.inArray( mw.config.get( 'wgAction' ), ['edit', 'submit'] ) !== -1 ) {
        mw.loader.using( 'user.options', function () {
                if ( mw.user.options.get('usebetatoolbar') ) {
                        mw.loader.using( 'ext.wikiEditor.toolbar', function () {
                                
                                if(typeof(addThisButton) == 'undefined'){
                                addGroup_msl();
								addButton_msl(nam_msl,pre_msl,peri_msl,post_msl,img_msl2);	
								}
                                return true;
                        } );
                }
        } );
        
        mw.toolbar.addButton({
	        "imageFile": img_msl, 
	        "speedTip": nam_msl,
	        "tagOpen": pre_msl, 
	        "tagClose": post_msl,     
	        "sampleText": peri_msl  
		});
	}	
});

function addGroup_msl(){
	// To add a group to an existing toolbar section:
	$( '#wpTextbox1' ).wikiEditor( 'addToToolbar', {
    	'section': 'main',
        'groups': {
        	'MsLinks': {}
    	}
    });
}

function addButton_msl(nam,prex,perix,postx,img){

	// To add a button to an existing toolbar group:
	$('#wpTextbox1' ).wikiEditor( 'addToToolbar', {
	'section': 'main',
	'group': 'MsLinks',
	'tools': {
		 nam: {
		    label: nam, // or use labelMsg for a localized label, see above
		    type: 'button',
		    icon: img,
		    action: {
		    	type: 'encapsulate',
		        options: {
		           pre: prex, 
		           peri: perix,
		           post: postx,
		        }
		    }
		 }
	}
	});
}

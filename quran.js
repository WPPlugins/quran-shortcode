jQuery(document).ready(function($) {
    tinymce.create('tinymce.plugins.quran_plugin', {
        init : function(ed, url) {
                // Register command for when button is clicked
               /* ed.addCommand('quran_insert_shortcode', function() {
                    selected = tinyMCE.activeEditor.selection.getContent();

                    if( selected ){
                        //If text is selected when button is clicked
                        //Wrap shortcode around it.
                        content =  '[shortcode]'+selected+'[/shortcode]';
                    }else{
                        content =  '[shortcode]';
                    }

                    tinymce.execCommand('mceInsertContent', false, content);
                });*/
               
            function edc_quran_ajax(url,keyword,aya_limit){
				jQuery.ajax({
		                type: "GET",
		                url: url+"/ajax_search.php",
		                data: {
		                    'search_keyword' : keyword,
		                    'aya_limit' :aya_limit,
		                },
		                dataType: "text",
		                beforeSend:function(){
		                	jQuery('.ajax-loader').show();
		                },
		                error:function(){
		                	alert(error);
		                },
		                success: function(msg){
		                    //we need to check if the value is the same
		                	
		                    if (keyword==jQuery('#quran_keyword').val()) {
		                    //Receiving the result of search here
		                    	jQuery('#quran_search_result').html(msg);
		                    	jQuery('.ajax-loader').hide();
		                    }
		                }
		            });
            }
        	ed.addCommand('quran_insert_shortcode', function() {

        		ed.windowManager.open(
        		            {
        		              //file   : url + '/dialog.php',
        		              //width  : 450,
        		              //height : auto,
        		            	//inline : 1,
        		              title  :'أدراج اية',
        		              body:[
        		                   
									{//add header input
									    type: 'textbox',
									    name: 'quran_keyword',
									    label: 'كلمة البحث',
									    id   : 'quran_keyword',
									    value: '',
									    tooltip: 'insert search word',
									    onKeyUp : function(){
											 
									    	var keyword = jQuery('#quran_keyword').val();
	
									    	// ajax
									    	edc_quran_ajax(url,keyword,'');
									    	
									    }
									},
									{
					                    type   : 'listbox',
					                    name   : 'quran_aya_limit',
					                    id   : 'quran_aya_limit',
					                    label  : 'عدد الايات',
					                    tooltip: 'سوف يظهر عدد الايات المحدد بعد تلك الاية',
					                    values : [
					                    	{ text: '', value: '' },
					                        { text: '2', value: '2' },
					                        { text: '3', value: '3' },
					                        { text: '4', value: '4' },
					                        { text: '5', value: '5' },
					                        { text: '6', value: '6' },
					                        { text: '7', value: '7' },
					                        { text: '8', value: '8' },
					                        { text: '9', value: '9' },
					                        { text: '10', value: '10' },
					                        { text: '10', value: '11' },
					                        { text: '10', value: '12' },
					                        { text: '10', value: '13' },
					                        { text: '10', value: '14' },
					                        { text: '10', value: '15' },
					                    ],
					                    onselect : function(e){
					                    	var limit = this.value();
					                    	var keyword = jQuery('#quran_keyword').val();
					                    	edc_quran_ajax(url,keyword,limit);	
					                    },
              						 },
              						 {
					                    type   : 'listbox',
					                    name   : 'quran_aya_trans',
					                    id   : 'quran_aya_trans',
					                    label  : 'أضف الترجمة',
					                    tooltip: 'بأختيارك هذا الخيار سوف تظهر الترجمة مصحوبة للايات ',
					                    values : [
					                    	{ text: '', value: '' },
					                        { text: 'English', value: 'en' },
					                    ],
					                    onselect : function(e){
					                    	var trans = this.value();
					                    	jQuery('#quran_trans').val(trans);
					                    	/*var keyword = jQuery('#quran_keyword').val();
					                    	edc_quran_ajax(url,keyword,limit);	*/
					                    },
              						 },
									 {
        		                    	type: 'container',
        		                        html: '<input type="hidden" name= "quran_trans" id="quran_trans"/><div class="ajax-loader"></div><ul id="quran_search_result"></ul>'
        		                    }
        		                    ],
        		              buttons: [{
        		                  text: 'Insert',
        		                  subtype: 'primary',
        		                  onclick: function() {
        		                      // TODO: handle primary button click
        		                	  content = '';
        		                	  jQuery('input[name^="quran_aya"]').each(function(index) {
        		                		  if(jQuery(this).is(":checked")){
        		                			  var sora = jQuery('input[name^="sora"]:eq('+index+')').val();
        		                			  var aya = jQuery('input[name^="aya"]:eq('+index+')').val();
        		                			  var limit = jQuery('input[name^="limit"]:eq('+index+')').val();
        		                			  var trans = jQuery('input[name^="quran_trans"]:eq('+index+')').val();
        		                			  
        		                			  content +=  '[Quran sora="'+sora+'" aya="'+aya+'" after="'+limit+'" trans="'+trans+'"]\n';
        		                		  }
        		                		    
        		                		});
        		                	  
        		                	  tinymce.execCommand('mceInsertContent', false, content);
        		                	  (this).parent().parent().close();
        		               
        		                  }
        		              },
        		              {
        		                  text: 'Close',
        		                  onclick: function() {
        		                      (this).parent().parent().close();
        		                  }
        		              }]
        		            }, 
        		            {
        		              plugin_url      : url,
        		              some_custom_arg : 'custom value'
        		            }
        		);
        		
            });

            // Register buttons - trigger above command when clicked
            ed.addButton('quran_button', {title : 'أدراج اية', cmd : 'quran_insert_shortcode', image: url + '/quran.png' });
        },   
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('quran_button', tinymce.plugins.quran_plugin);
    
    
    
    
    
   
});
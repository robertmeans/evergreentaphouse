(function() {
    tinymce.create('tinymce.plugins.bliccaThemes', {
        init : function(ed, url) {

            ed.addButton('bliccaThemes_dropcap', {
                title : 'bliccaThemes Drop Cap',
                cmd : 'bliccaThemes_dropcap',
                image : url + '/img/dropcap.jpg'
            });
          
            ed.addButton('bliccaThemes_highlight', {
                title : 'bliccaThemes Highlight',
                cmd : 'bliccaThemes_highlight',
                image : url + '/img/highlight.png'
            });
          
            ed.addCommand('bliccaThemes_highlight', function() {
               var highlight_content = prompt ("Highlight Content", "Lorem ipsum..");
               var highlight_style = prompt ("Highlight Style", "highlight, highlight2 or highlight3");
         
               ed.execCommand('mceInsertContent', false, '[bliccaThemes_highlight highlight_style="'+highlight_style+'" highlight_content="'+highlight_content+'"][/bliccaThemes_highlight]');

            });
            

            ed.addCommand('bliccaThemes_dropcap', function() {
               var drop_text = prompt ("Drop Cap Text", "D");
               var drop_style = prompt ("Dropcap Style", "cleany or backy");
         
               ed.execCommand('mceInsertContent', false, '[bliccaThemes_dropcap drop_style="'+drop_style+'" drop_text="'+drop_text+'"][/bliccaThemes_dropcap]');

            });
 
            

        },
        // ... Hidden code
    });
    // Register plugin
    tinymce.PluginManager.add( 'bliccaThemes_tiny', tinymce.plugins.bliccaThemes );
})();
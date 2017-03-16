(function() {

    tinymce.PluginManager.add( '20-15_child_custom_class', function( editor, url ) {
        // Add Button to Visual Editor Toolbar

        editor.addButton('guest_book_shortcode_button', {
            title: 'Insert Shortcode',
            cmd: 'guest_book_shortcode_button',
            image: url + '../../images/code.png',
        });

        // Add Command when Button Clicked
        editor.addCommand('guest_book_shortcode_button', function() {
            editor.execCommand('mceReplaceContent', false, '[20-15_child_guest_book]');
        });

    });
})();
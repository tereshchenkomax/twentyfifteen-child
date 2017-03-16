jQuery(function($) {
    $(document).ready(function () {

    });

    $(document).find('#guestBookShortcodeButton').click(function (e) {
        insertShortcode('[twentyseventeen_child_guest_book]');
    });

    function insertShortcode(shortcodes){
        if(typeof tinyMCE  != "undefined"){
            if( ! tinyMCE.activeEditor || tinyMCE.activeEditor.isHidden()){
                if(QTags.insertContent(shortcodes) != true)
                    document.getElementById('content').value += shortcodes;
            } else if(tinyMCE && tinyMCE.activeEditor) {
                tinyMCE.activeEditor.selection.setContent(shortcodes);
            }
        } else{
            document.getElementById('description').value += shortcodes;
            document.getElementById('tag-description').value += shortcodes;

        }
    }
});
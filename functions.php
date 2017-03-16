<?php

define("MY_THEME_TEXTDOMAIN", 'twentyseventeen-child');


add_filter('wp_title', 'filterTitle');
function filterTitle($title) {
    return $title.' - Twenty Fifteen Child';
}

add_filter('the_content', 'filterTheContent');
function filterTheContent($content) {
    return $content.' - Twenty Fifteen Child';
}

add_action('wp_enqueue_scripts', 'my_theme_styles' );
function my_theme_styles() {
    wp_enqueue_style('parent-theme-css', get_template_directory_uri() .'/style.css' );
    wp_enqueue_style('child-theme-css', get_stylesheet_directory_uri() .'/style.css', array('parent-theme-css') );
}



/**
 * Загрузка Text Domain
 */
function childThemeLocalization(){
    load_child_theme_textdomain(MY_THEME_TEXTDOMAIN, get_stylesheet_directory() . '/languages/');
}
add_action('after_setup_theme', 'childThemeLocalization');


add_action('admin_menu', 'addAdminMenu');
function addAdminMenu(){

    $themeMenuPage = add_theme_page(
        __('Sub theme Step By Step', MY_THEME_TEXTDOMAIN),
        __('Sub theme Step By Step', MY_THEME_TEXTDOMAIN),
        'read',
        'twentyseventeen_child_control_sub_theme_menu',
        'renderThemeMenu'
    );
}
function renderThemeMenu(){
    _e('Sub theme Step By Step', MY_THEME_TEXTDOMAIN);
}


add_shortcode( 'twentyseventeen_child_guest_book', 'guestBookShortcode');
function guestBookShortcode(){
    $output = '';
    $output .= '<form  method="post">
                    <label>'.__('User name', MY_THEME_TEXTDOMAIN ).'</label>
                    <input type="text" name="twentyseventeen_child_" class="twentyseventeen-child-name">
                    <label>'.__('Message', MY_THEME_TEXTDOMAIN ).'</label>
                    <textarea name="twentyseventeen_child_message" class="twentyseventeen-child-message"></textarea>
                    <button class="twentyseventeen-child-btn-add" >'.__('Add', MY_THEME_TEXTDOMAIN ).'</button>                   
                </form>';
    return $output;
}

add_action('media_buttons','addMediaButtons');
function addMediaButtons(){
    $button = '<a href="#" id="guestBookShortcodeButton" class="su-generator-button button">'
        .__('Insert shortcode', MY_THEME_TEXTDOMAIN).'</a>';
    echo $button;

}

add_action('admin_enqueue_scripts', 'loadScriptAdmin');
function loadScriptAdmin($hook){
    wp_enqueue_script(
        'twentyseventeen_child_admin_main', //$handle
        get_stylesheet_directory_uri() .'/assets/js/twentyseventeen-child-admin-main.js', //$src
        array(
            'jquery',
        )
    );

}

add_action( 'init', 'setupTinyMCE' );
function setupTinyMCE(){
    add_filter( 'mce_external_plugins', 'addTinyMCE' );
    add_filter( 'mce_buttons', 'addTinyMCEToolbar' );
}

function addTinyMCE( $plugin_array ) {

    $plugin_array['twentyseventeen_child_custom_class'] = get_stylesheet_directory_uri()
        . '/assets/js/MYTinyMCE.js';
    return $plugin_array;

}

function addTinyMCEToolbar( $buttons ) {

    array_push( $buttons, 'guest_book_shortcode_button' );
    return $buttons;

}

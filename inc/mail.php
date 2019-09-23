<?php
/*
 *	File for email form 
 * 
 */
?>
<?php 
add_action( 'wp_ajax_ajax_order', 'ajax_mail_function' ); // wp_ajax_{ЗНАЧЕНИЕ ПАРАМЕТРА ACTION!!}
add_action( 'wp_ajax_nopriv_ajax_order', 'ajax_mail_function' );  // wp_ajax_nopriv_{ЗНАЧЕНИЕ ACTION!!}
function ajax_mail_function(){
    //Variables
    $headers      = "Content-type: text/html; charset=utf-8\r\n";
    $sitename     = get_bloginfo('name');
    $admin_email  = carbon_get_theme_option('form_email');
    $subject      = __('Message from the site ') . $sitename;
    $user_phone   = htmlspecialchars(trim($_POST['phone']));
    $user_name    = htmlspecialchars(trim($_POST['name']));
    $user_company = htmlspecialchars(trim($_POST['company']));
    $user_email   = htmlspecialchars(trim($_POST['email']));
    $user_message = htmlspecialchars(trim($_POST['message']));
    $spam_first   = (trim($_POST['spamFirst']));
    $spam_second  = (trim($_POST['spamSecond']));
    
    if( (isset( $spam_first ) && !empty( $spam_first )) || (isset( $spam_second ) && !empty( $spam_second) )){
        exit;
    }  
    
    //Use SMTP server
    $use_smtp = carbon_get_theme_option('smtp');
    if( $use_smtp ){
        require_once('mail-parts/mail-smtp.php'); 
    }
    //Save in admin panel
    $panel_save = carbon_get_theme_option('panel');
    if( $panel_save ){
        require_once('mail-parts/save-in-panel.php');
    }
    //Default
    if( !is_plugin_active('wp-mail-smtp/wp-mail-smtp.php') ) {
        require_once('mail-parts/mail.php');
    }
    //Exit
    die();
}
//Create Mail post type
add_action( 'init', 'cpt_mail_calback' );
function cpt_mail_calback() {
    $panel_save = carbon_get_theme_option('panel');
    if( $panel_save ){
        $labels = array(
            "name" => __("Mail"),
            "singular_name" => __("Mail"),
            "menu_name" => __("Mail"),
            "all_items" => __("All mail"),
            "add_new" => __("Add New"),
            "add_new_item" => __("Add New"),
            "edit" => __("Edit"),
            "edit_item" => __("Edit"),
            "new_item" => __("New item"),
            "view" => __("View"),
            "view_item" => __("View item"),
            "search_items" => __("Search item"),
            "not_found" => __("No found"),
            "not_found_in_trash" => __("No found"),
        );

        $args = array(
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "show_ui" => true,
            "has_archive" => false,
            "show_in_menu" => true,
            "exclude_from_search" => true,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => true,
            "rewrite" => false,
            "query_var" => true,
            "menu_position" => 7,
            "menu_icon" => "dashicons-email-alt",
            "supports" => array( "title", "editor" ),
        );

        register_post_type( "mail", $args );

    }
}
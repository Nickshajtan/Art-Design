<?php
/*
 *	This file duplicate emails messages and save as post type 
 * 
 */
?>
<?php 
$post_data = array(
   'post_title'    => __('Name: ') . $user_name,
   'post_content'  => __("Email: ") . $user_email . '<br/>' . __('Company: ') . $user_company . '<br/>' . __('Phone number: ') . $user_phone . '<br/>' . __('Message: ') . $user_message,
   'post_status'   => 'publish',
   'post_author'   => 1,
   'post_type' => 'mail',
  );
wp_insert_post( $post_data );
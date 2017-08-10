<?php
function admin_scripts($hook) {
    $admin_page = ( isset($_GET['page']) ? filter_var( $_GET['page'],FILTER_SANITIZE_STRING) : '' );

    if ( 'blank' != $admin_page ) {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script( 'admin_scripts', plugin_dir_url(__FILE__) . '/js/main.js', array('jquery'));
    wp_enqueue_style( 'admin_styles', plugin_dir_url(__FILE__) . '/css/main.css');
}
add_action( 'admin_enqueue_scripts', 'admin_scripts' );
<?php
/*
 * Enter the post type information
 * using a class to avoid variable conflicts with other cpt plugins
 */
class Defines {
    // CPT DEFINES
    const AST_CPT = '';
    const AST_CPT_SINGLE = '';
    const AST_CPT_PLURAL = '' ;
    const AST_CATEGORY_NAME = '' ;
    const AST_CATEGORY_SLUG = '' ;
    const AST_CATEGORY_SINGLE = '' ;
    const AST_CATEGORY_PLURAL = '' ;
    const AST_TAG_NAME = '' ;
    const AST_TAG_SLUG = '' ;
    const AST_TAG_SINGLE = '' ;
    const AST_TAG_PLURAL = '' ;
    const CREATE_CPT = '';
    
    

    public function __construct() {
        
        define('AST_SITE_TITLE', get_bloginfo( 'name' ));

        define('AST_PLUGIN_NAME', 'Blank');
        define('AST_PLUGIN_SHORT_NAME', 'Blank');
        define('AST_PLUGIN_SLUG', 'blank');
        define('AST_PLUGIN_UNDERSCORED_NAME', 'blank');


        // Enable to display smarty template debug. Leave blank to disable or enter "TRUE"
        define('AST_PLUGIN_DEBUG_SMARTY', '');

        // Determine which system we're running on - If not provided, assume PRODUCTION
        $host = getenv('AST_HOST_ID');
        if (trim($host) == '') {
            $host = 'PRODUCTION';
        }
        define('AST_PLUGIN_HOST', $host);

        // Get various pieces of the URL
        $url_shards = parse_url(get_bloginfo('url'));
        $page_uri = explode('?', $_SERVER['REQUEST_URI']);   
        $wp_upload_dir = wp_upload_dir();

        /*
         *  Create a copy of the plugin slug that can be used as a variable prefix used to keep
         *  global instances from clashing with instances in other plugins.
         */
        $ast_prefix = str_replace('-', '_', AST_PLUGIN_SLUG);
        define('AST_PLUGIN_PREFIX', $ast_prefix.'_');

        // URLs
        define('AST_HOSTNAME', $url_shards['host']);
        define('AST_SITE_BASE_URL', home_url('/') );
        define('AST_PLUGIN_URL', plugin_dir_url(__FILE__));
        define('AST_PLUGIN_ADMIN_URL', admin_url('admin.php'));
        define('AST_PLUGIN_ADMIN_AJAX_URL', admin_url('admin-ajax.php'));
        define('AST_PLUGIN_ASSETS_URL', AST_PLUGIN_URL.'assets');
        define('AST_PLUGIN_JS_URL', AST_PLUGIN_URL.'js');
        define('AST_PLUGIN_BASE_URL', WP_PLUGIN_URL.'/'.AST_PLUGIN_SLUG);
        define('AST_PLUGIN_CURRENT_URL', $url_shards['scheme'].'://'.$url_shards['host'].$page_uri[0]);
        define('AST_PLUGIN_MEDIA_URL', $wp_upload_dir['baseurl'].'/'.AST_PLUGIN_SLUG);

        // WP Options
        define('AST_PLUGIN_OPTION_PREFIX', 'ast_blank_database_option_');
        define('AST_PLUGIN_OPTION_FIRST_ACTIVATION', AST_PLUGIN_OPTION_PREFIX.'first_activation');

        // Directories
        define('AST_PLUGIN_PATH', dirname(__FILE__));
        define('AST_PLUGIN_SETUP_PATH', AST_PLUGIN_PATH.'/setup');
        define('AST_PLUGIN_DB_SCRIPTS', AST_PLUGIN_SETUP_PATH.'/databaseScripts');
        define('AST_PLUGIN_CLASS_PATH', AST_PLUGIN_PATH.'/classes');
        define('AST_PLUGIN_LIB_PATH', AST_PLUGIN_PATH.'/lib');
        define('AST_PLUGIN_MEDIA_PATH', $wp_upload_dir['basedir'].'/'.AST_PLUGIN_SLUG);
        define('AST_PLUGIN_IMAGES_PATH', AST_PLUGIN_MEDIA_PATH.'/images');
        define('AST_PLUGIN_FILES_PATH', AST_PLUGIN_MEDIA_PATH.'/files');
        define('AST_PLUGIN_CONFIG_PATH', AST_PLUGIN_PATH.'/config');

        $plugins_path = str_replace(AST_PLUGIN_SLUG, '', AST_PLUGIN_PATH);
        define('AST_WORDPRESS_PLUGIN_PATH', $plugins_path);
        define('AST_WORDPRESS_PLUGIN_URL', WP_PLUGIN_URL);

        // Database defines
        global $wpdb;
        define('AST_PLUGIN_DB_PREFIX', $wpdb->prefix.'ast_blank_');
        define('AST_PLUGIN_DB_VERSION', 'astDatabaseVersion');

        // Current Theme Information
        $current_theme = wp_get_theme();
        define('AST_PLUGIN_CURRENT_THEME', $current_theme->get_template());
        define('AST_PLUGIN_CURRENT_THEME_DIR', $current_theme->get_template_directory());
    }
}

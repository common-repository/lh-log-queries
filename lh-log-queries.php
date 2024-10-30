<?php
/**
 * Plugin Name: LH Log Queries and Hooks
 * Description: Adds a list of all queries and hook as a html comment.
 * Author: Peter Shaw
 * Author URI: https://shawfactor.com
 * Plugin URI: https://lhero.org/portfolio/lh-log-queries/
 * Version: 1.02
 */
 
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
if (isset($_GET['lh_log_queries']) && (($_GET['lh_log_queries'] == 'both') or ($_GET['lh_log_queries'] == 'hooks') or ($_GET['lh_log_queries'] == 'queries'))){
 
 if ( ! defined( 'SAVEQUERIES' ) ) {
	define( 'SAVEQUERIES', true );
}

if (!class_exists('LH_Log_queries_plugin')) {


class LH_Log_queries_plugin {
    
    private static $instance;
    var $hooks;

    public function track_hooks( ) {
        $filter = current_filter();
        if ( ! empty($GLOBALS['wp_filter'][$filter]) ) {
          foreach ( $GLOBALS['wp_filter'][$filter] as $priority => $tag_hooks ) {
            foreach ( $tag_hooks as $hook ) {
              if ( is_array($hook['function']) )  {
                if ( is_object($hook['function'][0]) ) {
                  $func = get_class($hook['function'][0]) . '->' . $hook['function'][1];
                } elseif ( is_string($hook['function'][0]) ) {
                  $func = $hook['function'][0] . '::' . $hook['function'][1];
                }
              } elseif( $hook['function'] instanceof Closure ) {
                $func = 'a closure';
              } elseif( is_string($hook['function']) ) {
                $func = $hook['function'];
              }
              $this->$hooks[] = 'On hook "' . $filter . '" run '. $func . ' at priority ' . $priority;
            }
          }
        }
    }

    public function lh_log_queries() {
         
         global $wpdb;
         
    echo '<!-- ' . print_r($wpdb->queries, true) . ' -->'; 
         
    }

    public function filter_wp_die($function){
        
         global $wpdb;
         
        echo '<!-- ' . print_r($wpdb->queries, true) . ' -->'; 

        return $function;
    }
 
    public function log_on_shutdown(){
        
        if (!empty($_GET['lh_log_queries']) && (($_GET['lh_log_queries'] == 'both') or ($_GET['lh_log_queries'] == 'queries'))){
        
            add_action( 'shutdown',array( $this, 'lh_log_queries') , 999 );
    
            add_filter('wp_die_ajax_handler',array( $this, 'filter_wp_die') , 999,1 );
    
        }
    
        if (!empty($_GET['lh_log_queries']) && (($_GET['lh_log_queries'] == 'both') or ($_GET['lh_log_queries'] == 'hooks'))){
    
            add_action( 'shutdown', function() {
                echo '<!-- ';
                
                print_r($this->$hooks);
                
            echo ' -->'; 
            }, 9999); 
    
        }
     
    }

    public function plugin_init(){
        
        if (!empty($_GET['lh_log_queries']) && (($_GET['lh_log_queries'] == 'both') or ($_GET['lh_log_queries'] == 'hooks') or ($_GET['lh_log_queries'] == 'queries'))){
    
            //frontend    
            add_action('wp_footer', array( $this, 'log_on_shutdown' ));
            
            //backend
            add_action('admin_footer', array( $this, 'log_on_shutdown' ));
    
        }
    
        if (!empty($_GET['lh_log_queries']) && (($_GET['lh_log_queries'] == 'both') or ($_GET['lh_log_queries'] == 'hooks'))){
     
            add_action( 'all', array($this, 'track_hooks') );
    
        }
        
    }
 
    /**
     * Gets an instance of our plugin.
     *
     * using the singleton pattern
     */
     
    public static function get_instance(){
        
        if (null === self::$instance) {
            
            self::$instance = new self();
            
        }
 
        return self::$instance;
        
    }


    public function __construct() {
        
    	 //run our hooks on plugins loaded to as we may need checks       
        add_action( 'plugins_loaded', array($this,'plugin_init'));
     
    }

}

$lh_log_queries_instance = LH_Log_queries_plugin::get_instance();

}
 
}


?>
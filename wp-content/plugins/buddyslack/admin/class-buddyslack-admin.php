<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.davidbisset.com
 * @since      1.0.0
 *
 * @package    Buddyslack
 * @subpackage Buddyslack/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Buddyslack
 * @subpackage Buddyslack/admin
 * @author     David Bisset <dbisset@dimensionmedia.com>
 */
class Buddyslack_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Buddyslack_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Buddyslack_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/buddyslack-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Buddyslack_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Buddyslack_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/buddyslack-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function check_for_buddypress() {
		
		if ( !class_exists('BuddyPress') ) {
		    echo "<div class='error'><p>BuddySlack requires <a href='https://wordpress.org/plugins/buddypress/''>BuddyPress</a> to be actively running on your site.</p></div>";
		    // update_option('buddyslack_bprequired_notice_shown', 'true');
		}
	}

}

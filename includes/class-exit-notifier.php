<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class Exit_Notifier {

	/**
	 * The single instance of Exit_Notifier.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * Settings class object
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $settings = null;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $_version;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $_token;

	/**
	 * The main plugin file.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $file;

	/**
	 * The main plugin directory.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $dir;

	/**
	 * The plugin assets directory.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $assets_dir;

	/**
	 * The plugin assets URL.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $assets_url;

	/**
	 * Suffix for Javascripts.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $script_suffix;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct ( $file = '', $version = '1.4.2' ) {
		$this->_version = $version;
		$this->_token = 'exit_notifier';

		// Load plugin environment variables
		$this->file = $file;
		$this->dir = dirname( $this->file );
		$this->assets_dir = trailingslashit( $this->dir ) . 'assets';
		$this->assets_url = esc_url( trailingslashit( plugins_url( '/assets/', $this->file ) ) );

		$this->script_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		register_activation_hook( $this->file, array( $this, 'install' ) );

		// Load frontend JS & CSS
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 10 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 10 );

		// Load admin JS & CSS
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 10, 1 );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_styles' ), 10, 1 );

		// Load API for generic admin functions
		if ( is_admin() ) {
			$this->admin = new Exit_Notifier_Admin_API();
		}

		// Handle localisation
		$this->load_plugin_textdomain();
		add_action( 'init', array( $this, 'load_localisation' ), 0 );
	} // End __construct ()

	/**
	 * Wrapper function to register a new post type
	 * @param  string $post_type   Post type name
	 * @param  string $plural      Post type item plural name
	 * @param  string $single      Post type item single name
	 * @param  string $description Description of post type
	 * @return object              Post type class object
	 */
	public function register_post_type ( $post_type = '', $plural = '', $single = '', $description = '' ) {

		if ( ! $post_type || ! $plural || ! $single ) return;

		$post_type = new Exit_Notifier_Post_Type( $post_type, $plural, $single, $description );

		return $post_type;
	}

	/**
	 * Wrapper function to register a new taxonomy
	 * @param  string $taxonomy   Taxonomy name
	 * @param  string $plural     Taxonomy single name
	 * @param  string $single     Taxonomy plural name
	 * @param  array  $post_types Post types to which this taxonomy applies
	 * @return object             Taxonomy class object
	 */
	public function register_taxonomy ( $taxonomy = '', $plural = '', $single = '', $post_types = array() ) {

		if ( ! $taxonomy || ! $plural || ! $single ) return;

		$taxonomy = new Exit_Notifier_Taxonomy( $taxonomy, $plural, $single, $post_types );

		return $taxonomy;
	}

	/**
	 * Load frontend CSS.
	 * @access  public
	 * @since   1.0.0
	 * @return void
	 */
	public function enqueue_styles () {
		wp_register_style( $this->_token . '-frontend', esc_url( $this->assets_url ) . 'css/frontend.css', array(), $this->_version );
		wp_enqueue_style( $this->_token . '-frontend' );
		wp_register_style( $this->_token . '-jAlert-v3', esc_url( $this->assets_url ) . 'css/jAlert-v3.css', array(), $this->_version );
		wp_enqueue_style( $this->_token . '-jAlert-v3' );
/*
		wp_register_style( $this->_token . '-animate', esc_url( $this->assets_url ) . 'css/animate.css', array(), $this->_version );
		wp_enqueue_style( $this->_token . '-animate' );
*/
	} // End enqueue_styles ()

	/**
	 * Load frontend Javascript.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function enqueue_scripts () {
		wp_register_script( $this->_token . '-frontend', esc_url( $this->assets_url ) . 'js/frontend.js', array( 'jquery' ), $this->_version );
		wp_enqueue_script( $this->_token . '-frontend' );
		$siteurl = explode('//',get_option('siteurl'));
		$exitboxsettings=array(
			'title' => do_shortcode(get_option('exitbox_title_field')),
			'body' => do_shortcode(get_option('exitbox_body_text')),
			'GoButtonText' => get_option('exitbox_go_button_text'),
			'Include_URL' => get_option('exitbox_include_url'),
			'CancelButtonText' => get_option('exitbox_cancel_button_text'),
			'siteroot' => $siteurl[1],
			'siteurl' => get_option('siteurl'),
			'theme' => get_option('exitbox_theme'),
			'backgroundcolor' => get_option('exitbox_backgroundcolor'),
			'size' => get_option('exitbox_size'),
			'showAnimation' => get_option('exitbox_showAnimation'),
			'hideAnimation' => get_option('exitbox_hideAnimation'),
			'apply_to_all_offsite_links' => get_option('exitbox_apply_to_all_offsite_links'),
			'jquery_selector_field' => get_option('exitbox_jquery_selector_field'),
			'new_window' => get_option('exitbox_new_window'),
			'visual' => get_option('exitbox_visual_indication'),
			'custom_css' => get_option('exitbox_custom_css'),
			'advanced_custom_css' => get_option('exitbox_advanced_custom_css'),
			'enable_timeout' => get_option('exitbox_enable_timeout'),
			'continue_or_cancel' => get_option('exitbox_continue_or_cancel'),
			'timeout_seconds' => get_option('exitbox_timeout_seconds')
		);
		wp_localize_script( $this->_token . '-frontend', "ExitBoxSettings", $exitboxsettings);
		wp_register_script( $this->_token . '-jAlert-v3', esc_url( $this->assets_url ) . 'js/jAlert-v3.js', array( 'jquery' ), $this->_version );
		wp_enqueue_script( $this->_token . '-jAlert-v3' );
/*
		wp_register_script( $this->_token . '-jAlert-functions', esc_url( $this->assets_url ) . 'js/jAlert-functions.js', array( 'jquery' ), $this->_version );
		wp_enqueue_script( $this->_token . '-jAlert-functions' );
*/

/*
		wp_register_script( $this->_token . '-confirm', esc_url( $this->assets_url ) . 'js/jquery.confirm.min.js', array( 'jquery' ), $this->_version );
		wp_enqueue_script( $this->_token . '-confirm' );
*/
	} // End enqueue_scripts ()

	/**
	 * Load admin CSS.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function admin_enqueue_styles ( $hook = '' ) {
		wp_register_style( $this->_token . '-admin', esc_url( $this->assets_url ) . 'css/admin.css', array(), $this->_version );
		wp_enqueue_style( $this->_token . '-admin' );
	} // End admin_enqueue_styles ()

	/**
	 * Load admin Javascript.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function admin_enqueue_scripts ( $hook = '' ) {
		wp_register_script( $this->_token . '-admin', esc_url( $this->assets_url ) . 'js/admin.js', array( 'jquery' ), $this->_version );
		wp_enqueue_script( $this->_token . '-admin' );
	} // End admin_enqueue_scripts ()

	/**
	 * Load plugin localisation
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function load_localisation () {
		load_plugin_textdomain( 'exit-notifier', false, dirname( plugin_basename( $this->file ) ) . '/lang/' );
	} // End load_localisation ()

	/**
	 * Load plugin textdomain
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function load_plugin_textdomain () {
	    $domain = 'exit-notifier';

	    $locale = apply_filters( 'plugin_locale', get_locale(), $domain );

	    load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
	    load_plugin_textdomain( $domain, false, dirname( plugin_basename( $this->file ) ) . '/lang/' );
	} // End load_plugin_textdomain ()

	/**
	 * Main Exit_Notifier Instance
	 *
	 * Ensures only one instance of Exit_Notifier is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Exit_Notifier()
	 * @return Main Exit_Notifier instance
	 */
	public static function instance ( $file = '', $version = '1.4.2' ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $file, $version );
		}
		return self::$_instance;
	} // End instance ()

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
	} // End __clone ()

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
	} // End __wakeup ()

	/**
	 * Installation. Runs on activation.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function install () {
		$this->_log_version_number();
	} // End install ()

	/**
	 * Log the plugin version number.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	private function _log_version_number () {
		update_option( $this->_token . '_version', $this->_version );
	} // End _log_version_number ()

}
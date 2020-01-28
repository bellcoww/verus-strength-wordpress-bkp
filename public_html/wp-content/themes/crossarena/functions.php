<?php
/**
 * Crossarena functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Crossarena
 */

 /**
 * Valedictorians backward compatibility with WordPress less than 4.7.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! class_exists( 'Crossarena_Theme_Setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since 1.0.0
	 */
	class Crossarena_Theme_Setup {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * A reference to an instance of cherry framework core class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private $core = null;

		/**
		 * Holder for CSS layout scheme.
		 *
		 * @since 1.0.0
		 * @var   array
		 */
		public $layout = array();

		/**
		 * Holder for current customizer module instance.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		public $customizer = null;

		/**
		 * Holder for current dynamic_css module instance.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		public $dynamic_css = null;

		/**
		 * Sets up needed actions/filters for the theme to initialize.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// Set the constants needed by the theme.
			add_action( 'after_setup_theme', array( $this, 'constants' ), -1 );

			// Load the installer core.
			add_action( 'after_setup_theme', require( get_parent_theme_file_path( 'cherry-framework/setup.php' ) ), 0 );

			// Load the core functions/classes required by the rest of the theme.
			add_action( 'after_setup_theme', array( $this, 'get_core' ), 1 );

			// Language functions and translations setup.
			add_action( 'after_setup_theme', array( $this, 'l10n' ), 2 );

			// Handle theme supported features.
			add_action( 'after_setup_theme', array( $this, 'theme_support' ), 3 );

			// Load the theme includes.
			add_action( 'after_setup_theme', array( $this, 'includes' ), 4 );

			// Initialization of modules.
			add_action( 'after_setup_theme', array( $this, 'init' ), 10 );

			// Load admin files.
			add_action( 'wp_loaded', array( $this, 'admin' ), 1 );

			// Enqueue admin assets.
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );

			// Register public assets.
			add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ), 9 );

			// Enqueue public assets.
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ), 20 );

			// Overrides the load textdomain function for the 'cherry-framework' domain.
			add_filter( 'override_load_textdomain', array( $this, 'override_load_textdomain' ), 5, 3 );

		}

		/**
		 * Defines the constant paths for use within the core and theme.
		 *
		 * @since 1.0.0
		 */
		public function constants() {
			global $content_width;

			/**
			 * Fires before definitions the constants.
			 *
			 * @since 1.0.0
			 */
			do_action( 'crossarena_constants_before' );

			$template  = get_template();
			$theme_obj = wp_get_theme( $template );

			/** Sets the theme version number. */
			define( 'CROSSARENA_THEME_VERSION', $theme_obj->get( 'Version' ) );

			/** Sets the theme directory path. */
			define( 'CROSSARENA_THEME_DIR', get_template_directory() );

			/** Sets the theme directory URI. */
			define( 'CROSSARENA_THEME_URI', get_template_directory_uri() );

			/** Sets the path to the core framework directory. */
			defined( 'CHERRY_DIR' ) or define( 'CHERRY_DIR', trailingslashit( CROSSARENA_THEME_DIR ) . 'cherry-framework' );

			/** Sets the path to the core framework directory URI. */
			defined( 'CHERRY_URI' ) or define( 'CHERRY_URI', trailingslashit( CROSSARENA_THEME_URI ) . 'cherry-framework' );

			/** Sets the theme assets URIs. */
			define( 'CROSSARENA_THEME_CSS', trailingslashit( CROSSARENA_THEME_URI ) . 'assets/css' );
			define( 'CROSSARENA_THEME_JS', trailingslashit( CROSSARENA_THEME_URI ) . 'assets/js' );

			// Sets the content width in pixels, based on the theme's design and stylesheet.
			if ( ! isset( $content_width ) ) {
				$content_width = 885;
			}
		}

		/**
		 * Loads the core functions. These files are needed before loading anything else in the
		 * theme because they have required functions for use.
		 *
		 * @since  1.0.0
		 */
		public function get_core() {
			/**
			 * Fires before loads the core theme functions.
			 *
			 * @since 1.0.0
			 */
			do_action( 'crossarena_core_before' );

			global $chery_core_version;

			if ( null !== $this->core ) {
				return $this->core;
			}

			if ( 0 < sizeof( $chery_core_version ) ) {
				$core_paths = array_values( $chery_core_version );

				require_once( $core_paths[0] );
			} else {
				die( 'Class Cherry_Core not found' );
			}

			$this->core = new Cherry_Core( array(
				'base_dir' => CHERRY_DIR,
				'base_url' => CHERRY_URI,
				'modules'  => array(
					'cherry-js-core' => array(
						'autoload' => true,
					),
					'cherry-ui-elements' => array(
						'autoload' => false,
					),
					'cherry-interface-builder' => array(
						'autoload' => false,
					),
					'cherry-utility' => array(
						'autoload' => true,
						'args'     => array(
							'meta_key' => array(
								'term_thumb' => 'cherry_terms_thumbnails',
							),
						),
					),
					'cherry-widget-factory' => array(
						'autoload' => true,
					),
					'cherry-post-formats-api' => array(
						'autoload' => true,
						'args'     => array(
							'rewrite_default_gallery' => false,
							'gallery_args' => array(
								'size'          => 'crossarena-thumb-l',
								'base_class'    => 'post-gallery',
								'container'     => '<div class="%2$s swiper-container" id="%4$s" %3$s><div class="swiper-wrapper">%1$s</div><div class="swiper-pagination"></div></div>',
								'slide'         => '<figure class="%2$s swiper-slide">%1$s</figure>',
								'img_class'     => 'swiper-image',
								'slider_handle' => 'jquery-swiper',
								'slider'        => 'swiper',
								'popup'         => 'magnificPopup',
								'popup_handle'  => 'magnific-popup',
								'popup_init'    => array(
									'type' => 'image',
								),
							),
							'image_args' => array(
								'size'         => 'crossarena-thumb-l',
								'popup'        => 'magnificPopup',
								'popup_handle' => 'magnific-popup',
								'popup_init'   => array(
									'type' => 'image',
								),
							),
						),
					),
					'cherry-customizer' => array(
						'autoload' => false,
					),
					'cherry-dynamic-css' => array(
						'autoload' => false,
					),
					'cherry-google-fonts-loader' => array(
						'autoload' => false,
					),
					'cherry-term-meta' => array(
						'autoload' => false,
					),
					'cherry-post-meta' => array(
						'autoload' => false,
					),
					'cherry-breadcrumbs' => array(
						'autoload' => false,
					),
				),
			) );

			return $this->core;
		}

		/**
		 * Loads the theme translation file.
		 *
		 * @since 1.0.0
		 */
		public function l10n() {
			/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 */
			load_theme_textdomain( 'crossarena', get_parent_theme_file_path( 'languages' ) );
		}

		/**
		 * Adds theme supported features.
		 *
		 * @since 1.0.0
		 */
		public function theme_support() {

			// Enable support for Post Thumbnails on posts and pages.
			add_theme_support( 'post-thumbnails' );

			// Enable HTML5 markup structure.
			add_theme_support( 'html5', array(
				'comment-list',
				'comment-form',
				'search-form',
				'gallery',
				'caption',
			) );

			// Enable default title tag.
			add_theme_support( 'title-tag' );

			// Enable post formats.
			add_theme_support( 'post-formats', array(
				'aside',
				'gallery',
				'image',
				'link',
				'quote',
				'video',
				'audio',
				'status',
			) );

			// Enable custom background.
			add_theme_support( 'custom-background', array( 'default-color' => '191a1f' ) );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			// Add support for mobile menu
			add_theme_support( 'tm-custom-mobile-menu' );

			// Allow copy custom sidebars into child theme on activation
			add_theme_support( 'cherry_migrate_sidebars' );
		}

		/**
		 * Loads the theme files supported by themes and template-related functions/classes.
		 *
		 * @since 1.0.0
		 */
		public function includes() {
			/**
			 * Configurations.
			 */
			require_once get_parent_theme_file_path( 'config/layout.php' );
			require_once get_parent_theme_file_path( 'config/menus.php' );
			require_once get_parent_theme_file_path( 'config/sidebars.php' );
			require_once get_parent_theme_file_path( 'config/skins.php' );
			require_if_theme_supports( 'post-thumbnails', get_parent_theme_file_path( 'config/thumbnails.php' ) );

			/**
			 * Functions.
			 */
			if ( ! is_admin() ) {
				require_once get_parent_theme_file_path( 'inc/template-tags.php' );
				require_once get_parent_theme_file_path( 'inc/template-menu.php' );
				require_once get_parent_theme_file_path( 'inc/template-comment.php' );
				require_once get_parent_theme_file_path( 'inc/template-related-posts.php' );
				require_once get_parent_theme_file_path( 'inc/extras.php' );
			}

			require_once get_parent_theme_file_path( 'inc/extras.php' );
			require_once get_parent_theme_file_path( 'inc/context.php' );
			require_once get_parent_theme_file_path( 'inc/customizer.php' );
			require_once get_parent_theme_file_path( 'inc/hooks.php' );
			require_once get_parent_theme_file_path( 'inc/register-plugins.php' );
			
			/**
			 * Third party plugins hooks.
			 */

			if ( class_exists( 'Cherry_Projects' ) ) {
				require_once get_parent_theme_file_path( 'inc/plugins-hooks/cherry-projects.php' );
			}

			if ( class_exists( 'Cherry_Services_List' ) ) {
				require_once get_parent_theme_file_path( 'inc/plugins-hooks/cherry-services-list.php' );
			}

			if ( class_exists( 'Cherry_Team_Members' ) ) {
				require_once get_parent_theme_file_path( 'inc/plugins-hooks/cherry-team-members.php' );
			}

			if ( class_exists( 'TM_Testimonials_Plugin' ) ) {
				require_once get_parent_theme_file_path( 'inc/plugins-hooks/cherry-testi.php' );
			}

			if( defined( 'ELEMENTOR_VERSION' ) ){
				require_once get_parent_theme_file_path( 'inc/plugins-hooks/elementor.php' );
			}

			if ( class_exists( 'tm_mega_menu' ) ) {
				require_once get_parent_theme_file_path( 'inc/plugins-hooks/tm-mega-menu.php' );
			}

			/**
			 * Widgets.
			 */
			require_once get_parent_theme_file_path( 'inc/widgets/about/class-about-widget.php' );
			require_once get_parent_theme_file_path( 'inc/widgets/about-author/class-about-author-widget.php' );
			require_once get_parent_theme_file_path( 'inc/widgets/banner/class-banner-widget.php' );
			require_once get_parent_theme_file_path( 'inc/widgets/carousel/class-carousel-widget.php' );
			require_once get_parent_theme_file_path( 'inc/widgets/custom-posts/class-custom-posts-widget.php' );
			require_once get_parent_theme_file_path( 'inc/widgets/image-grid/class-image-grid-widget.php' );
			require_once get_parent_theme_file_path( 'inc/widgets/taxonomy-tiles/class-taxonomy-tiles-widget.php' );
			require_once get_parent_theme_file_path( 'inc/widgets/contact-information/class-contact-information-widget.php' );
			require_once get_parent_theme_file_path( 'inc/widgets/featured-posts-block/class-featured-posts-block-widget.php' );
			require_once get_parent_theme_file_path( 'inc/widgets/news-smart-box/class-news-smart-box-widget.php' );
			require_once get_parent_theme_file_path( 'inc/widgets/playlist-slider/class-playlist-slider-widget.php' );
			require_once get_parent_theme_file_path( 'inc/widgets/subscribe-follow-widget/class-subscribe-follow-widget.php' );

			if ( class_exists( 'Elementor\Plugin' ) ) {
				require_once get_parent_theme_file_path( 'inc/widgets/elementor-template/class-elementor-template-widget.php' );
			}

			/**
			 * Classes.
			 */
			if ( ! is_admin() ) {
				require_once get_parent_theme_file_path( 'inc/classes/class-wrapping.php' );
			}

			require_once get_parent_theme_file_path( 'inc/classes/class-widget-area.php' );
			require_once get_parent_theme_file_path( 'inc/classes/class-tgm-plugin-activation.php' );

			/**
			 * Extensions.
			 */
			require_once get_parent_theme_file_path( 'inc/extensions/tm-mega-menu.php' );
			require_once get_parent_theme_file_path( 'inc/extensions/import.php' );
		}

		/**
		 * Run initialization of modules.
		 *
		 * @since 1.0.0
		 */
		public function init() {
			$this->customizer  = $this->get_core()->init_module( 'cherry-customizer', crossarena_get_customizer_options() );
			$this->dynamic_css = $this->get_core()->init_module( 'cherry-dynamic-css', crossarena_get_dynamic_css_options() );
			$this->get_core()->init_module( 'cherry-google-fonts-loader', crossarena_get_fonts_options() );
			$this->get_core()->init_module( 'cherry-term-meta', array(
				'tax'      => 'category',
				'priority' => 10,
				'fields'   => array(
					'cherry_terms_thumbnails' => array(
						'type'                => 'media',
						'value'               => '',
						'multi_upload'        => false,
						'library_type'        => 'image',
						'upload_button_text'  => esc_html__( 'Set thumbnail', 'crossarena' ),
						'label'               => esc_html__( 'Category thumbnail', 'crossarena' ),
					),
				),
			) );
			$this->get_core()->init_module( 'cherry-term-meta', array(
				'tax'      => 'post_tag',
				'priority' => 10,
				'fields'   => array(
					'cherry_terms_thumbnails' => array(
						'type'                => 'media',
						'value'               => '',
						'multi_upload'        => false,
						'library_type'        => 'image',
						'upload_button_text'  => esc_html__( 'Set thumbnail', 'crossarena' ),
						'label'               => esc_html__( 'Tag thumbnail', 'crossarena' ),
					),
				),
			) );
			$this->get_core()->init_module( 'cherry-post-meta', apply_filters( 'crossarena_page_settings_meta',  array(
				'id'            => 'page-settings',
				'title'         => esc_html__( 'Page settings', 'crossarena' ),
				'page'          => array( 'post', 'page', 'team', 'cherry-services', 'projects' ),
				'context'       => 'normal',
				'priority'      => 'high',
				'callback_args' => false,
				'fields'        => array(
					'tabs' => array(
						'element' => 'component',
						'type'    => 'component-tab-horizontal',
					),
					'layout_tab' => array(
						'element'     => 'settings',
						'parent'      => 'tabs',
						'title'       => esc_html__( 'Layout Options', 'crossarena' ),
					),
					'header_tab' => array(
						'element'     => 'settings',
						'parent'      => 'tabs',
						'title'       => esc_html__( 'Header Style', 'crossarena' ),
						'description' => esc_html__( 'Header style settings', 'crossarena' ),
					),
					'header_elements_tab' => array(
						'element'     => 'settings',
						'parent'      => 'tabs',
						'title'       => esc_html__( 'Header Elements', 'crossarena' ),
						'description' => esc_html__( 'Enable/Disable header elements', 'crossarena' ),
					),
					'breadcrumbs_tab' => array(
						'element'     => 'settings',
						'parent'      => 'tabs',
						'title'       => esc_html__( 'Breadcrumbs', 'crossarena' ),
						'description' => esc_html__( 'Breadcrumbs settings', 'crossarena' ),
					),
					'footer_tab' => array(
						'element'     => 'settings',
						'parent'      => 'tabs',
						'title'       => esc_html__( 'Footer Settings', 'crossarena' ),
						'description' => esc_html__( 'Footer settings', 'crossarena' ),
					),
					'crossarena_sidebar_position' => array(
						'type'          => 'radio',
						'parent'        => 'layout_tab',
						'title'         => esc_html__( 'Sidebar Layout', 'crossarena' ),
						'value'         => 'inherit',
						'display_input' => false,
						'options'       => array(
							'inherit' => array(
								'label'   => esc_html__( 'Inherit', 'crossarena' ),
								'img_src' => trailingslashit( CROSSARENA_THEME_URI ) . 'assets/images/admin/inherit.svg',
							),
							'one-left-sidebar' => array(
								'label'   => esc_html__( 'Sidebar on left side', 'crossarena' ),
								'img_src' => trailingslashit( CROSSARENA_THEME_URI ) . 'assets/images/admin/page-layout-left-sidebar.svg',
							),
							'one-right-sidebar' => array(
								'label'   => esc_html__( 'Sidebar on right side', 'crossarena' ),
								'img_src' => trailingslashit( CROSSARENA_THEME_URI ) . 'assets/images/admin/page-layout-right-sidebar.svg',
							),
							'fullwidth' => array(
								'label'   => esc_html__( 'No sidebar', 'crossarena' ),
								'img_src' => trailingslashit( CROSSARENA_THEME_URI ) . 'assets/images/admin/page-layout-fullwidth.svg',
							),
						),
					),
					'crossarena_header_container_type' => array(
						'type'          => 'radio',
						'parent'        => 'layout_tab',
						'title'         => esc_html__( 'Header layout', 'crossarena' ),
						'value'         => 'inherit',
						'display_input' => false,
						'options'       => array(
							'inherit'   => array(
								'label'   => esc_html__( 'Inherit', 'crossarena' ),
								'img_src' => trailingslashit( CROSSARENA_THEME_URI ) . 'assets/images/admin/inherit.svg',
							),
							'boxed'     => array(
								'label'   => esc_html__( 'Boxed', 'crossarena' ),
								'img_src' => trailingslashit( CROSSARENA_THEME_URI ) . 'assets/images/admin/type-boxed.svg',
							),
							'fullwidth' => array(
								'label'   => esc_html__( 'Fullwidth', 'crossarena' ),
								'img_src' => trailingslashit( CROSSARENA_THEME_URI ) . 'assets/images/admin/type-fullwidth.svg',
							),
						),
					),
					'crossarena_content_container_type' => array(
						'type'          => 'radio',
						'parent'        => 'layout_tab',
						'title'         => esc_html__( 'Content layout', 'crossarena' ),
						'value'         => 'inherit',
						'display_input' => false,
						'options'       => array(
							'inherit'   => array(
								'label'   => esc_html__( 'Inherit', 'crossarena' ),
								'img_src' => trailingslashit( CROSSARENA_THEME_URI ) . 'assets/images/admin/inherit.svg',
							),
							'boxed'     => array(
								'label'   => esc_html__( 'Boxed', 'crossarena' ),
								'img_src' => trailingslashit( CROSSARENA_THEME_URI ) . 'assets/images/admin/type-boxed.svg',
							),
							'fullwidth' => array(
								'label'   => esc_html__( 'Fullwidth', 'crossarena' ),
								'img_src' => trailingslashit( CROSSARENA_THEME_URI ) . 'assets/images/admin/type-fullwidth.svg',
							),
						),
					),
					'crossarena_footer_container_type'  => array(
						'type'          => 'radio',
						'parent'        => 'layout_tab',
						'title'         => esc_html__( 'Footer layout', 'crossarena' ),
						'value'         => 'inherit',
						'display_input' => false,
						'options'       => array(
							'inherit'   => array(
								'label'   => esc_html__( 'Inherit', 'crossarena' ),
								'img_src' => trailingslashit( CROSSARENA_THEME_URI ) . 'assets/images/admin/inherit.svg',
							),
							'boxed'     => array(
								'label'   => esc_html__( 'Boxed', 'crossarena' ),
								'img_src' => trailingslashit( CROSSARENA_THEME_URI ) . 'assets/images/admin/type-boxed.svg',
							),
							'fullwidth' => array(
								'label'   => esc_html__( 'Fullwidth', 'crossarena' ),
								'img_src' => trailingslashit( CROSSARENA_THEME_URI ) . 'assets/images/admin/type-fullwidth.svg',
							),
						),
					),
					'crossarena_header_layout_type' => array(
						'type'    => 'select',
						'parent'  => 'header_tab',
						'title'   => esc_html__( 'Header Layout', 'crossarena' ),
						'value'   => 'inherit',
						'options' => crossarena_get_header_layout_pm_options(),
					),
					'crossarena_header_transparent_layout' => array(
						'type'          => 'radio',
						'parent'        => 'header_tab',
						'title'         => esc_html__( 'Header Overlay', 'crossarena' ),
						'value'         => 'inherit',
						'display_input' => false,
						'options' => array(
							'inherit' => array(
								'label' => esc_html__( 'Inherit', 'crossarena' ),
							),
							'true'    => array(
								'label' => esc_html__( 'Enable', 'crossarena' ),
							),
							'false'   => array(
								'label' => esc_html__( 'Disable', 'crossarena' ),
							),
						),
					),
					'crossarena_top_panel_visibility' => array(
						'type'          => 'select',
						'parent'        => 'header_elements_tab',
						'title'         => esc_html__( 'Top panel', 'crossarena' ),
						'value'         => 'inherit',
						'display_input' => false,
						'options' => array(
							'inherit' => esc_html__( 'Inherit', 'crossarena' ),
							'true'    => esc_html__( 'Enable', 'crossarena' ),
							'false'   => esc_html__( 'Disable', 'crossarena' ),
						),
					),
					'crossarena_header_contact_block_visibility' => array(
						'type'          => 'select',
						'parent'        => 'header_elements_tab',
						'title'         => esc_html__( 'Header Contact Block', 'crossarena' ),
						'value'         => 'inherit',
						'display_input' => false,
						'options' => array(
							'inherit' => esc_html__( 'Inherit', 'crossarena' ),
							'true'    => esc_html__( 'Enable', 'crossarena' ),
							'false'   => esc_html__( 'Disable', 'crossarena' ),
						),
					),
					'crossarena_header_search' => array(
						'type'          => 'select',
						'parent'        => 'header_elements_tab',
						'title'         => esc_html__( 'Header Search', 'crossarena' ),
						'value'         => 'inherit',
						'display_input' => false,
						'options' => array(
							'inherit' => esc_html__( 'Inherit', 'crossarena' ),
							'true'    => esc_html__( 'Enable', 'crossarena' ),
							'false'   => esc_html__( 'Disable', 'crossarena' ),
						),
					),
					'crossarena_breadcrumbs_visibillity' => array(
						'type'          => 'radio',
						'parent'        => 'breadcrumbs_tab',
						'title'         => esc_html__( 'Breadcrumbs visibillity', 'crossarena' ),
						'value'         => 'inherit',
						'display_input' => false,
						'options' => array(
							'inherit' => array(
								'label' => esc_html__( 'Inherit', 'crossarena' ),
							),
							'true'    => array(
								'label' => esc_html__( 'Enable', 'crossarena' ),
							),
							'false'   => array(
								'label' => esc_html__( 'Disable', 'crossarena' ),
							),
						),
					),
					'crossarena_footer_layout_type' => array(
						'type'    => 'select',
						'parent'  => 'footer_tab',
						'title'   => esc_html__( 'Footer Layout', 'crossarena' ),
						'value'   => 'inherit',
						'options' => crossarena_get_footer_layout_pm_options(),
					),
					'crossarena_footer_widget_area_visibility' => array(
						'type'          => 'select',
						'parent'        => 'footer_tab',
						'title'         => esc_html__( 'Footer Widgets Area', 'crossarena' ),
						'value'         => 'inherit',
						'display_input' => false,
						'options' => array(
							'inherit' => esc_html__( 'Inherit', 'crossarena' ),
							'true'    => esc_html__( 'Enable', 'crossarena' ),
							'false'   => esc_html__( 'Disable', 'crossarena' ),
						),
					),
					'crossarena_footer_contact_block_visibility' => array(
						'type'          => 'select',
						'parent'        => 'footer_tab',
						'title'         => esc_html__( 'Footer Contact Block', 'crossarena' ),
						'value'         => 'inherit',
						'display_input' => false,
						'options' => array(
							'inherit' => esc_html__( 'Inherit', 'crossarena' ),
							'true'    => esc_html__( 'Enable', 'crossarena' ),
							'false'   => esc_html__( 'Disable', 'crossarena' ),
						),
					),
				),
			) ) );
			$this->get_core()->init_module( 'cherry-post-meta', array(
				'id'            => 'post-single-type',
				'title'         => esc_html__( 'Single Post Style', 'crossarena' ),
				'page'          => array( 'post' ),
				'context'       => 'side',
				'priority'      => 'low',
				'callback_args' => false,
				'fields' => array(
					'crossarena_single_post_type' => array(
						'type'          => 'radio',
						'value'         => 'inherit',
						'display_input' => false,
						'options'       => array(
							'inherit' => array(
								'label' => esc_html__( 'Inherit', 'crossarena' ),
							),
							'default' => array(
								'label' => esc_html__( 'Default', 'crossarena' ),
							),
							'modern'  => array(
								'label' => esc_html__( 'Modern', 'crossarena' ),
							),
						),
					),
				),
			) );
		}

		/**
		 * Load admin files for the theme.
		 *
		 * @since 1.0.0
		 */
		public function admin() {

			// Check if in the WordPress admin.
			if ( ! is_admin() ) {
				return;
			}
		}

		/**
		 * Enqueue admin-specific assets.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_admin_assets( $hook ) {
			// FIX admin style to `The Events Calendar` plugin
			if ( class_exists( 'Tribe__Events__Main' ) ) {
				wp_enqueue_style( 'crossarena-admin-fix-style', CROSSARENA_THEME_CSS . '/admin-fix.min.css', array(), CROSSARENA_THEME_VERSION );
			}

			$available_pages = array(
				'widgets.php',
			);

			if ( ! in_array( $hook, $available_pages ) ) {
				return;
			}

			wp_enqueue_style( 'crossarena-admin-style', CROSSARENA_THEME_CSS . '/admin.min.css', array(), CROSSARENA_THEME_VERSION );
		}

		/**
		 * Register assets.
		 *
		 * @since 1.0.0
		 */
		public function register_assets() {
			wp_register_script( 'jquery-slider-pro', CROSSARENA_THEME_JS . '/min/jquery.slider-pro.min.js', array( 'jquery' ), '1.2.4', true );
			wp_register_script( 'jquery-swiper', CROSSARENA_THEME_JS . '/min/swiper.jquery.min.js', array( 'jquery' ), '3.3.0', true );
			wp_register_script( 'magnific-popup', CROSSARENA_THEME_JS . '/min/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
			wp_register_script( 'object-fit-images', CROSSARENA_THEME_JS . '/min/ofi.min.js', array(), '3.0.1', true );
			wp_register_style( 'jquery-slider-pro', CROSSARENA_THEME_CSS . '/slider-pro.min.css', array(), '1.2.4' );
			wp_register_style( 'jquery-swiper', CROSSARENA_THEME_CSS . '/swiper.min.css', array(), '3.3.0' );
			wp_register_style( 'magnific-popup', CROSSARENA_THEME_CSS . '/magnific-popup.min.css', array(), '1.1.0' );
			wp_register_style( 'font-awesome', CROSSARENA_THEME_CSS . '/font-awesome.min.css', array(), '4.6.3' );

			wp_dequeue_script( 'booked-font-awesome' );
		}

		/**
		 * Enqueue assets.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_assets() {
			wp_enqueue_style( 'crossarena-theme-style', get_stylesheet_uri(),
				array( 'font-awesome', 'magnific-popup' ),
				CROSSARENA_THEME_VERSION
			);

			/**
			 * Filter the depends on main theme script.
			 *
			 * @since 1.0.0
			 * @var   array
			 */
			$depends = apply_filters( 'crossarena_theme_script_depends', array( 'cherry-js-core', 'hoverIntent' ) );

			wp_enqueue_script( 'crossarena-theme-script', CROSSARENA_THEME_JS . '/theme-script.js', $depends, CROSSARENA_THEME_VERSION, true );

			/**
			 * Filter the strings that send to scripts.
			 *
			 * @since 1.0.0
			 * @var   array
			 */
			$labels = apply_filters( 'crossarena_theme_localize_labels', array(
				'totop_button'  => '',
				'header_layout' => esc_html( get_theme_mod( 'header_layout_type', crossarena_theme()->customizer->get_default( 'header_layout_type' ) ) ),
			) );

			$more_button_options = apply_filters( 'crossarena_theme_more_button_options', array(
				'more_button_type'             => esc_html( get_theme_mod( 'more_button_type', crossarena_theme()->customizer->get_default( 'more_button_type' ) ) ),
				'more_button_text'             => esc_html( get_theme_mod( 'more_button_text', crossarena_theme()->customizer->get_default( 'more_button_text' ) ) ),
				'more_button_icon'             => esc_html( get_theme_mod( 'more_button_icon', crossarena_theme()->customizer->get_default( 'more_button_icon' ) ) ),
				'more_button_image_url'        => esc_url( get_theme_mod( 'more_button_image_url', crossarena_theme()->customizer->get_default( 'more_button_image_url' ) ) ),
				'retina_more_button_image_url' => esc_url( get_theme_mod( 'retina_more_button_image_url', crossarena_theme()->customizer->get_default( 'retina_more_button_image_url' ) ) ),
			) );

			wp_localize_script( 'crossarena-theme-script', 'crossarena', apply_filters(
				'crossarena_theme_script_variables',
				array(
					'ajaxurl'             => esc_url( admin_url( 'admin-ajax.php' ) ),
					'labels'              => $labels,
					'more_button_options' => $more_button_options,
				) ) );

			// Threaded Comments.
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			wp_add_inline_style( 'crossarena-theme-style', crossarena_header_inline_css() );
		}

		/**
		 * Overrides the load textdomain functionality when 'cherry-framework' is the domain in use.
		 *
		 * @since  1.0.0
		 * @link   https://gist.github.com/justintadlock/7a605c29ae26c80878d0
		 *
		 * @param  bool   $override
		 * @param  string $domain
		 * @param  string $mofile
		 *
		 * @return bool
		 */
		public function override_load_textdomain( $override, $domain, $mofile ) {

			// Check if the domain is our framework domain.
			if ( 'cherry-framework' === $domain ) {

				global $l10n;

				// If the theme's textdomain is loaded, assign the theme's translations
				// to the framework's textdomain.
				if ( isset( $l10n['crossarena'] ) ) {
					$l10n[ $domain ] = $l10n['crossarena'];
				}

				// Always override.  We only want the theme to handle translations.
				$override = true;
			}

			return $override;
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
	}
}

/**
 * Returns instanse of main theme configuration class.
 *
 * @since  1.0.0
 * @return object
 */
function crossarena_theme() {
	return Crossarena_Theme_Setup::get_instance();
}

crossarena_theme();

add_action( 'init', 'crossarena_plugins_wizard_config', 9 );
add_action( 'init', 'crossarena_data_importer_config', 9 );

/**
 * Register Jet Plugins Wizards config
 */
function crossarena_plugins_wizard_config() {
	if ( ! is_admin() ) {
		return;
	}
	if ( ! function_exists( 'jet_plugins_wizard_register_config' ) ) {
		return;
	}
	include get_theme_file_path( 'tm-wizard-manifest.php' );
	jet_plugins_wizard_register_config( array(
		'license' => array( 'enabled' => false ),
		'plugins' => $plugins,
		'skins'   => $skins,
		'texts'   => $texts,
	) );
}

/**
 * Register Jet Data Importer config
 */
function crossarena_data_importer_config() {
	if ( ! is_admin() ) {
		return;
	}
	if ( ! function_exists( 'jet_data_importer_register_config' ) ) {
		return;
	}
	include get_theme_file_path( 'cherry-import-manifest.php' );

	jet_data_importer_register_config( $settings );
}
<?php
/**
 * The template for displaying post-format-ui.php
 *
 */
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}
if (!class_exists('Spring_Plant_Post_Formats_UI')) {
	class Spring_Plant_Post_Formats_UI
	{

		private $format_link_url = 'gf_format_link_url';

		private $format_video_embed = 'gf_format_video_embed';

		private $format_audio_embed = 'gf_format_audio_embed';

		private $format_gallery_images = 'gf_format_gallery_images';


		/**
		 * The instance of this object
		 *
		 * @var null|object
		 */
		private static $instance;

		/**
		 * Init GF_Custom_Css
		 *
		 * @return Spring_Plant_Post_Formats_UI|null|object
		 */
		public static function init()
		{
			if (self::$instance == NULL) {
				self::$instance = new self();
				self::$instance->afterInit();
			}

			return self::$instance;
		}

		public function afterInit()
		{
			add_action('save_post', array($this, 'update_post_meta'));
			add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
		}

		/**
		 * Get Plugin Url
		 *
		 * @return string
		 */
		public function get_plugin_url()
		{
			$plugin_url = Spring_Plant()->themeUrl('core/post-format-ui/');
			$plugin_url = apply_filters('gf-post-format-ui/plugin-url', $plugin_url);
			return $plugin_url;
		}

		/**
		 * Get Plugin Dir
		 *
		 * @return string
		 */
		public function get_plugin_dir()
		{
			return Spring_Plant()->themeDir('core/post-format-ui/');
		}

		/**
		 * Plugin Version
		 *
		 * @return string
		 */
		public function get_plugin_version()
		{
			return '1.0';
		}

		public function get_plugin_prefix()
		{
			return apply_filters('gf-post-format-ui/plugin-prefix', 'sf_');
		}

		public function get_template_part($slug, $args = array())
		{
			if ($args && is_array($args)) {
				extract($args);
			}
			$located = $this->get_plugin_dir() . 'templates/' . $slug . '.php';
			if (!file_exists($located)) {
				_doing_it_wrong(__FUNCTION__, sprintf('<code>%s</code> does not exist.', $slug), '1.0');
				return;
			}
			include($located);
		}

		public function get_format_link_url()
		{
			return $this->format_link_url;
		}

		public function get_format_video_embed()
		{
			return $this->format_video_embed;
		}

		public function get_format_audio_embed()
		{
			return $this->format_audio_embed;
		}

		public function get_format_gallery_images()
		{
			return $this->format_gallery_images;
		}

		public function get_post_type_support()
		{
			$post_type = array('post');
			return apply_filters('gf-post-format-ui/post-type', $post_type);
		}

		public function update_post_meta($post_id)
		{
			if (!defined('XMLRPC_REQUEST')) {
				$keys = array(
					$this->format_link_url,
					$this->format_video_embed,
					$this->format_audio_embed,
					$this->format_gallery_images
				);
				foreach ($keys as $key) {
					if (isset($_POST[$key])) {
						update_post_meta($post_id, $key, $_POST[$key]);
					}
				}
			}
		}

		public function add_meta_boxes($post_type)
		{
			$post_type_support = $this->get_post_type_support();
			if (in_array($post_type, $post_type_support)) {
				wp_enqueue_style($this->get_plugin_prefix() . 'post-format-ui', $this->get_plugin_url() . 'assets/css/post-format-ui.css', array(), $this->get_plugin_version());
				wp_enqueue_script($this->get_plugin_prefix() . 'media', $this->get_plugin_url() . 'assets/js/media.js', array('jquery'), $this->get_plugin_version(), true);
				wp_enqueue_script($this->get_plugin_prefix() . 'gallery', $this->get_plugin_url() . 'assets/js/gallery.js', array(), $this->get_plugin_version(), true);
				wp_enqueue_script($this->get_plugin_prefix() . 'post-format-ui', $this->get_plugin_url() . 'assets/js/post-format-ui.js', array('jquery'), $this->get_plugin_version(), true);
				add_action('edit_form_after_title', array($this, 'render_meta_boxes'));
			}
		}

		public function render_meta_boxes($post)
		{
			$post_format_views = array('standard', 'gallery', 'video', 'audio', 'link', 'quote');
			$post_formats = get_theme_support('post-formats');
			if ($post_formats === false) {
				$post_formats = array();
			} else {
				$post_formats = $post_formats[0];
			}
			$post_type = get_post_type($post);
			$current_post_format = $this->get_post_format($post->ID);
			array_unshift($post_formats, 'standard');
			if ($current_post_format === false) {
				$current_post_format = 'standard';
			}
			if ($post_type !== 'post') {
				$post_formats = array('standard', 'video', 'gallery');
			}
			$this->get_template_part('tabs', array(
				'post_formats' => $post_formats,
				'current_post_format' => $current_post_format,
				'post_format_views' => $post_format_views,
				'post_type' => $post_type
			));
		}

		public function get_post_format($post = null)
		{
			if (!$post = get_post($post))
				return false;

			$_format = get_the_terms($post->ID, 'post_format');

			if (empty($_format))
				return false;

			$format = reset($_format);

			return str_replace('post-format-', '', $format->slug);
		}
	}

	function Spring_Plant_Post_Formats_UI()
	{
		return Spring_Plant_Post_Formats_UI::init();
	}

	Spring_Plant_Post_Formats_UI();

}
<?php
	namespace Dodel;

	final class Shortcodes{

		protected $options;

		public function __construct(){
			$this->options = get_option( 'meetfox-page' );
			add_shortcode( 'meetfox-button', [$this, 'button'] );
			add_shortcode( 'meetfox-iframe', [$this, 'iframe'] );
			add_shortcode( 'meetfox-floating', [$this, 'floating'] );
		}

		/**
		 * Output [meetfox-button] shortcode results (view static button)
		 * @return html
		 */
		public function button(){
			$options = $this->options;
			ob_start();
			include __DIR__.'/templates/button.php';
			return ob_get_clean();
		}

		/**
		 * Output [meetfox-iframe] shortcode results (view iframe)
		 * @return html
		 */
		public function iframe(){
			$options = $this->options;
			ob_start();
			include __DIR__.'/templates/iframe.php';
			return ob_get_clean();
		}

		/**
		 * Output [meetfox-floating] shortcode results (view floating widget)
		 * @return html
		 */
		public function floating(){
			$options = $this->options;
			ob_start();
			include 'templates/floating.php';
			return ob_get_clean();
		}
	}
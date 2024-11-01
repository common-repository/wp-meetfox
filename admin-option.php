<?php
	namespace Dodel;

	final class Admin{
		public function __construct(){
			$pages = array(
				'meetfox-page'	=> array(
					'page_title'	=> __( 'MeetFox', 'dodel-meetfox' ),
					'icon_url'		=> 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAMAAABhEH5lAAAATlBMVEUAxv4Ax/8Ax/8Axv8Ax/8Axv4Axv4Ax/8Axv8Ax/8Ax/8Axv4Axv4Axv4Ax/8Ax/4Ax/8Axf0Ax/8Axv4Axv4AxPwAx/8Axv4Axv5HcExG1eaRAAAAGnRSTlMv//I15iXF1Que7h5mTQ/Po732TD3CzHhUANpQj6IAAACESURBVHjaXciFAcQwDAPAKFRm1P6DlpRHs8+QZjBMYaIh77IxSEK0L8JttyBRW+CxsAClKFmI+BDzHlhXYLBWlDtnLgMK5xMZP9Z5cUlevcmiZlsULcMPMc/5T3dUX7SJ9jFRtcJPt0weXfUQXQbfkI1H5iiSSUSyspSIZJIPcfZ+TucJirISbMqBIVkAAAAASUVORK5CYII=',
					'sections'		=> [
						'meetfox-one'	=> array(
							'include'	=> 'admin-style.php',
							'title'		=> __( 'MeetFox Settings', 'dodel-meetfox' ),
							'fields'	=> [
								[
									'type'			=>	'text',
									'title'			=>	'MeetFox Link',
									'placeholder'	=>	'https://meetfox.com/en/e/...',
									'id'			=> 	'meetfox_link',
								],
								[
									'type'			=>	'color',
									'title'			=>	'Button background color',
									'id'			=>	'meetfox_background',
									'value'		=>	'#00c6ff'
								],
								[
									'type'			=>	'color',
									'title'			=>	'Button text color',
									'id'			=>	'meetfox_color',
									'value'		=>	'#ffffff'
								],
								[
									'type'			=>	'switch',
									'title'			=>	'Automatically display MeetFox floating widget on every page of website',
									'id'			=>	'meetfox_whole',
									'choices'		=> [0,1]
								],
								[
									'type'			=>	'switch',
									'title'			=>	'Automatically display MeetFox floating widget on selected pages',
									'id'			=>	'meetfox_selected',
									'choices'		=> [0,1]
								],
								[
									'type'			=>	'select',
									'title'			=>	'Select pages of website',
									'attributes'	=> 	['multiple'=>true, 'size'=>5],
									'choices'		=>	$this->get_pages_options(),
									'id'			=>	'meetfox_selected_pages',
									'sanitize'		=>	false,
									'text'			=>	'Use Ctrl+Click (Cmd+Click) to select several pages'
								],
								[
									'type'			=>	'select',
									'title'			=>	'Select posts of website',
									'attributes'	=> 	['multiple'=>true, 'size'=>5],
									'choices'		=>	$this->get_posts_options(),
									'id'			=>	'meetfox_selected_posts',
									'sanitize'		=>	false,
									'text'			=>	'Use Ctrl+Click (Cmd+Click) to select several posts'
								],
							]
						),
						'meetfox-help'	=>	[
							'title'		=>	'Shortcodes',
							'include'	=>	'admin-help.php'
						]
					],
					
				),
			);
			$option_page = new Options( $pages );
		}

		/**
		 * Get list of existing pages on website
		 * @return Array List of pages
		 */
		public function get_pages_options(){
			$existing_pages = get_pages('posts_per_page=-1');
			$page_options = [];
			foreach($existing_pages as $page){
				if($page->post_status=='publish')
					$page_options[$page->ID]=$page->post_title;
			}
			return $page_options;
		}

		/**
		 * Get list of existing posts on website
		 * @return Array List of posts
		 */
		public function get_posts_options(){
			$existing_posts = get_posts('posts_per_page=-1');
			$post_options = [];
			foreach($existing_posts as $post){
				if($post->post_status=='publish')
					$post_options[$post->ID]=$post->post_title;
			}
			return $post_options;
		}
	}
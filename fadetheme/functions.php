<?php 
	function xzht_theme_styles()
	{
		wp_enqueue_style('base_css',get_template_directory_uri().'/css/base.css');
		wp_enqueue_style('index_css',get_template_directory_uri().'/css/index.css');
		wp_enqueue_style('m_css',get_template_directory_uri().'/css/m.css');
		wp_enqueue_style('page_css',get_template_directory_uri().'/css/page.css');
	}
	add_action('wp_enqueue_scripts','xzht_theme_styles');
	
	function xzht_theme_js()
	{
		wp_enqueue_script('modernizr_js',get_template_directory_uri().'/js/modernizr.js','','',false);
		wp_enqueue_script('scrollreveal_js',get_template_directory_uri().'/js/scrollReveal.js','','',false);
		wp_enqueue_script('easyfader_js',get_template_directory_uri().'/js/jquery.easyfader.min.js',array('jquery'),'',false);
		wp_enqueue_script('common_js',get_template_directory_uri().'/js/common.js',array('easyfader_js','scrollreveal_js'),'',false);
		//wp_enqueue_script('app_js',get_template_directory_uri().'/js/app.js',array('easyfader_js'),'',false);
	}
	add_action('wp_enqueue_scripts','xzht_theme_js');
	
	add_theme_support('menus');
	
	function xzht_register_menus()
	{
		register_nav_menus( array(
		'primary-menu' => 'Primary Menu',
		) );
	}
	add_action('init','xzht_register_menus');
	
	remove_filter('the_content', 'wpautop');
	remove_filter('the_excerpt', 'wpautop');
	remove_filter('comment_text', 'wpautop');
	
	function catch_that_image($post_content,&$all_imgs) 
	{
		$first_img = '';
		ob_start();
		ob_end_clean();
		$matches = array();
		$output = preg_match_all('/<img[^>]*src=\"([^\"]+)\"[^>]*\/?>/i', $post_content, $matches);

		//获取文章中第一张图片的路径并输出
		$first_img = $matches[1][0];
		$all_imgs = $matches[1];

		//print_r ($matches);
		//如果文章无图片，获取自定义图片
		if(empty($first_img))
		{ 	//Defines a default image
			$first_img = get_template_directory_uri()."/images/default.jpg";
		}
		return $first_img;
	}
	
	function get_banner_posts()
	{
		$args = array(
			'category_name' => 'banner',   // 分类ID
			'posts_per_page' => 3, // 显示篇数
		);
		$query = new WP_Query( $args );
		return $query;
	}
	
	function get_post_imagetype()
	{
		$categories = get_the_category();
		$cate_name = '';
		foreach($categories as $category)  
		{  
			$parent = get_cat_name($category->category_parent);
			if($parent == 'imagetype')//判断其父分类是否是'imagetype'
			{
				$cate_name = $category->cat_name;//如果其父分类是'imagetype'，那么认为此第一个分类就是imagetype类型
				break;
			}				
		}  
		return $cate_name;
	}
?>
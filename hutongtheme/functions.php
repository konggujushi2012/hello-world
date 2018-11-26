<?php 
	function xzht_theme_styles()
	{
		wp_enqueue_style('base_css',get_template_directory_uri().'/css/base.css');
		wp_enqueue_style('index_css',get_template_directory_uri().'/css/index.css');
		wp_enqueue_style('m_css',get_template_directory_uri().'/css/m.css');
	}
	add_action('wp_enqueue_scripts','xzht_theme_styles');
	
	function xzht_theme_js()
	{
		wp_enqueue_script('modernizr_js',get_template_directory_uri().'/js/modernizr.js','','',false);
		wp_enqueue_script('scrollreveal_js',get_template_directory_uri().'/js/scrollReveal.js','','',false);
		wp_enqueue_script('easyfader_js',get_template_directory_uri().'/js/jquery.easyfader.min.js',array('jquery'),'',false);
		wp_enqueue_script('app_js',get_template_directory_uri().'/js/app.js',array('easyfader_js'),'',false);
	}
	add_action('wp_enqueue_scripts','xzht_theme_js');
?>

<?php
	function xzht_theme_styles()
	{
		wp_enqueue_style('main_css',get_template_directory_uri().'/style.css');
	}
	add_action('wp_enqueue_scripts','xzht_theme_styles');
	
	function xzht_theme_js()
	{
		wp_enqueue_script('modernizr_js',get_template_directory_uri().'/js/modernizr.js','','',false);
		wp_enqueue_script('silder_js',get_template_directory_uri().'/js/silder.js','','',false);
	}
	add_action('wp_enqueue_scripts','xzht_theme_js');
?>
<?php 
	function xzht_theme_styles()
	{
		wp_enqueue_style('base_css',get_template_directory_uri().'/css/base.css');
		wp_enqueue_style('index_css',get_template_directory_uri().'/css/index.css');
		wp_enqueue_style('m_css',get_template_directory_uri().'/css/m.css');
		wp_enqueue_style('page_css',get_template_directory_uri().'/css/page.css');
		wp_enqueue_style('partner_css',get_template_directory_uri().'/css/englishpartner.css');
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
	
	//remove_filter('the_content', 'wpautop');
	remove_filter('the_excerpt', 'wpautop');
	remove_filter('comment_text', 'wpautop');
	
	//获取文章中的图片及其url
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
	
	//获取分类为banner的文章
	function get_banner_posts()
	{
		$args = array(
			'category_name' => 'banner',   // 分类ID
			'posts_per_page' => 3, // 显示篇数
		);
		$query = new WP_Query( $args );
		return $query;
	}
	//获取文章分类为topright的文章
	function get_topright_posts()
	{
		$args = array(
			'category_name' => 'topright',   // 分类ID
			'posts_per_page' => 2, // 显示篇数
		);
		$query = new WP_Query( $args );
		return $query;
	}
	
	function get_recommend_top_post()
	{
		$args = array(
			'category_name' => 'recommendtop',   // 分类ID
			'posts_per_page' => 1, // 显示篇数
		);
		$query = new WP_Query( $args );
		return $query;
	}
	
	function get_recommend_posts()
	{
		$args = array(
			'category_name' => 'recommend',   // 分类ID
			'posts_per_page' => 4, // 显示篇数
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
				$cate_name = $category->slug;//如果其父分类是'imagetype'，那么认为此第一个分类就是imagetype类型
				break;
			}				
		}  
		return $cate_name;
	}
	function get_first_cat_name()
	{
		$categories = get_the_category();
		$cate_name = '';
		foreach($categories as $category)  
		{  
			if($category->slug == 'english' || $category->slug == 'literature' || $category->slug == 'technology')
			{
				$cate_name = $category->cat_name;//如果是这三种分类中的一种，则输出分类名称
				break;	
			}				
		}  
		return $cate_name;
	}
	function get_cat_link($cat_name)
	{
		$category_id = get_cat_ID($cat_name);
		$category_link = get_category_link( $category_id );
		return $category_link;
	}
	function get_current_cat_link()
	{
		$cat_ID = get_query_var('cat');
		$category_link = get_category_link($cat_ID);
		return $category_link;
	}
	
	function get_current_tag_link()
	{
		$tag_id = get_query_var('tag');
		$tag_link = get_tag_link($tag_id);
		return $tag_link;
	}
	
	function get_pre_count_tags($count)
	{
		$tags = get_terms("post_tag");
		$num = 0;
		foreach ( $tags as $key => $tag ) 
		{
			if($num >= $count)
			{
				break;
			}
			$link = get_term_link( intval($tag->term_id), "post_tag" );
			$tags[ $key ]->link = $link;
			$num++;
		}
		return $tags;
	}

	add_action('wpcf7_before_send_mail', 'my_get_form_values');

	function my_get_form_values($contact_form)
	{
		if ($contact_form->name() == "sign-up") //your contact form 7 id
		{
			//get info about the form and current submission instance
			$submission = WPCF7_Submission::get_instance();
			if ( $submission )
			{
				$posted_data = $submission->get_posted_data();
				//var_dump($posted_data);
				if(check_wechat_exist($posted_data) === true)
				{
					redirect_page('http://localhost/wordpress/signupresult?result=1');
				}
				else
				{
					$ret = save_data_into_database($posted_data);
					if(!$ret)
					{
						redirect_page('http://localhost/wordpress/signupresult?result=2');
					}
					else
					{
						redirect_page('http://localhost/wordpress/signupresult?result=0');
					}
				}
				
			}
		}
	}
	
	function redirect_page($url)
	{
		$script .= '<script>'.PHP_EOL;
		$script .= 'window.location.href = "'.$url.'";'.PHP_EOL;
		$script .= '</script>'.PHP_EOL;
		echo $script;
	}

	define('TABLE_PARTNER', $wpdb->prefix . 'partners');
	define('TABLE_APPLICATION', $wpdb->prefix .'applications');
	date_default_timezone_set('PRC');//设置为中国时区
	//global $wpdb;

	function check_wechat_exist($partner_data)
	{
		global $wpdb;
		$query = "SELECT * FROM ".TABLE_PARTNER." where wechat_id="."'".$partner_data["wechat"]."'";
		$var = $wpdb->query($query);
		if($var == 0)
		{
			return false;
		}
		return true;
	}
	
	function save_data_into_database($partner_data)
	{
		global $wpdb;
	    $data['nickname'] = $partner_data["nickname"];
	    $data['wechat_id'] = $partner_data["wechat"];
	    $data['telephone']  = "";
	    if($partner_data["sex"] == "男"){
	    	$data["sex"] = 0;
	    }else{
	    	$data["sex"] = 1;
	    }
	    
	    if($partner_data["level"] == "新手"){
	    	$data["english_level"] = 0;
	    }else if($partner_data["level"] == "四级"){
	    	$data["english_level"] = 1;
	    }else if($partner_data["level"] == "六级"){
	    	$data["english_level"] = 2;
	    }else if($partner_data["level"] == "专业"){
	    	$data["english_level"] = 3;
	    }else{
	    	$data["english_level"] = 0;
	    }

	    foreach($partner_data["purpose"] as $purpose)
	    {
	    	if($purpose == "出国旅游"){
		    	$data["purpose"] = 0;
		    }else if($purpose == "工作需要"){
		    	$data["purpose"] = 1;
		    }else if($purpose == "日常交流"){
		    	$data["purpose"] = 2;
		    }else if($purpose == "自我提升"){
		    	$data["purpose"] = 3;
		    }else{
		    	$data["purpose"] = 4;
	    }
	    }
	    
	    $data["prefer_sex"] = 1;
	    $data["message"] = $partner_data["message"];

	    return $wpdb->insert(TABLE_PARTNER, $data);
	}

	function query_openid($code,&$openid)
	{
		$current_time = date('Y-m-d h:i:s', time());
		wplog('query_openid start excute.code: ', $code);
		$http = new WP_Http;
		$app_id = 'wxb697f58addb123fb';
		$app_secret = '1e80231bd9e1bd373d1921445068c735';
		//开发文档写的是GET方法请求，这里用POST方法是不行的
		// $params = array( 'appid' => $app_id, 'secret' => $app_secret,'js_code' => $code, 'grant_type' => 'authorization_code' );
		// $result = $http->request( 'https://api.weixin.qq.com/sns/jscode2session', array( 'method' => 'POST', 'body' => $params ) );
		$url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$app_id.'&secret='.$app_secret;
		$url = $url.'&js_code='.$code.'&grant_type=authorization_code';
		wplog('request url: ',$url);
		$result = $http->request($url);
		if($result['response']['code'] == 200)
		{
			$session_data = json_decode($result['body']);
			$openid = $session_data->openid;
			wplog('request success. session_data: ',$result['body']);
			return 0;
		}
		return $result['response']['code'];
	}

	function insert_partner_data($request)
	{
		global $wpdb;
		$data['nickname'] = $request['nickName'];
		$data['wechat_id'] = $request['wechat'];
		$data['telephone'] = $request['telephone'];
		$data["sex"] = $request['gender'];
		$data['english_level'] = $request['level'];
		$data["purpose"] = $request['purpose'];
		$data["prefer_sex"] = 1;
		$data["message"] = $request["message"];
		$data['avatar_url'] = $request['avatarUrl'];
		$data['country'] = $request['country'];
		$data['province'] = $request['province'];
		$data['city'] = $request['city'];
		$openid = "";

		$query_ret = query_openid($request['code'],$openid);
		if($openid == "")
		{
			return new WP_Error( '102', esc_html__( 'Query openid failed.', 'english-partner' ), array( 'status' => $query_ret) );
		}
		if(check_partner_exist($openid))
		{
			wplog('insert_partner_data ,check : partner has exist.');
		}
		else
		{
			$data['openid'] = $openid;
			if(!$wpdb->insert(TABLE_PARTNER, $data))
			{
				return new WP_Error( '101', esc_html__( 'Insert partner info failed.', 'english-partner' ), array( 'status' => 101 ) );
			}
			else
			{
				$result['code'] = 0;
				$result['message'] = "success.";
				return rest_ensure_response( $result );
			}
		}
		
	}

	function check_partner_exist($openid)
	{
		$sql_partner = "select * from " . TABLE_PARTNER . " where openid = ". "'".$openid."'";
		wplog('database query ,sql : ',$sql_partner);
		$var = $wpdb -> get_row($sql_partner, ARRAY_A);
		if($var != null && empty($var))
		{
			return true;
		}
		return false;
	}

	function get_partner_data($request)
	{
		$wechat = $request['wechat'];
	}

	function insert_apply_record()
	{
		
	}

	function get_apply_record($request)
	{
		global $wpdb;
		wplog('get_apply_record: request: ', $request['code']);
		$openid = $request['code'];
		$query_ret = query_openid($request['code'],$openid);
		if($openid == "")
		{
			return new WP_Error( '102', esc_html__( 'Query openid failed.', 'english-partner' ), array( 'status' => $query_ret ) );
		}
		$sql = "select * from " . TABLE_APPLICATION . " where openid = ". "'".$openid."'";
		$sql_partner = "select * from " . TABLE_PARTNER . " where openid = '11123'";
		wplog('database query ,sql : ',$sql);
		$var = $wpdb -> get_row($sql, ARRAY_A);
		wplog('get_row end,$var : ',$var);

		if($var == null)
		{
			return new WP_Error( '103', esc_html__( 'Database query failed.', 'english-partner' ), array( 'status' => 103) );
		}
		else if(empty($var))
		{
			return new WP_Error( '104', esc_html__( 'No apply record.', 'english-partner' ), array( 'status' => 104 ) );
		}
		$result['code'] = 0;
		$result['message'] = "success.";
		$result['data'] = $var;

		return rest_ensure_response( $result );
		//return new WP_REST_Response( $result, 0 );
		//return new WP_Error( '200', esc_html__( 'success.', 'english-partner' ), $var );
	}

	// Log信息输出
	function wplog( $str, $tag ) 
	{
		$current_time = date('Y-m-d h:i:s', time());
	    file_put_contents( get_template_directory().'/wp.log', $current_time . ': ' . $str . $tag . "\n", FILE_APPEND );
	}

	function function_test($request)
	{
		return new WP_Error( '103', esc_html__( 'Database query failed.', 'english-partner' ), array( 'status' => 103 ) );
	}
	
	function register_partner_routes()
	{
		register_rest_route('english-partner/v1','partners',array(
			'methods' => 'POST',
			'callback' => 'insert_partner_data',
		));
		register_rest_route('english-partner/v1','partners',array(
			'methods' => 'GET',
			'callback' => 'get_partner_data',
		));
		register_rest_route('english-partner/v1','applications',array(
			'methods' => 'GET',
			'callback' => 'get_apply_record',
		));
		register_rest_route('english-partner/v1','test',array(
			'methods' => 'GET',
			'callback' => 'function_test',
		));
	}
	add_action('rest_api_init','register_partner_routes');
?>
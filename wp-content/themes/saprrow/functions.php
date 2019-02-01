<?php       
    ////////////////////////////////////////////
    add_action( 'wp_enqueue_scripts', 'style_theme' );
    function style_theme() {
        wp_enqueue_style('style', get_stylesheet_uri());
        wp_enqueue_style( 'luboeslovo', get_template_directory_uri() . '/essets/css/default.css' );
        wp_enqueue_style( 'layout', get_template_directory_uri() . '/essets/css/layout.css' );
        wp_enqueue_style( 'media-queries', get_template_directory_uri() . '/essets/css/media-queries.css' );
    }
    /////////////////////////////////////////
    ////////////////////////////////////////////
    add_action( 'wp_footer', 'scripts_theme' );
    function scripts_theme() {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js' );
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/essets/js/flexslider.js', ['jquery'], null, true);
        wp_enqueue_script( 'doubletaptogo', get_template_directory_uri() . '/essets/js/doubletaptogo.js', ['jquery'], null, true);
        wp_enqueue_script( 'init', get_template_directory_uri() . '/essets/js/init.js', ['jquery'], null, true);
        wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/essets/js/modernizr.js', null, null, false );
    }
    /////////////////////////////////////////
    ////////////свой контент/////////////////
    add_filter( 'the_content', 'test_content' );
    function test_content($content){
        $content .= 'Спасибо!';
        return $content;
    }
    /////////////////////////////////////////
    /////////меняем в закладках//////////////////
    add_filter( 'document_title_separator', 'my_sep' );
    function my_sep( $sep ){
    	$sep = ' | ';
    	return $sep;
    }
    ///////////////////////////////////////////////////
    ////////////////САЙДБАР////////////////////////////
    add_action( 'widgets_init', 'register_my_widgets' );
    function register_my_widgets(){
    	register_sidebar( array(
    		'name'          => 'Left Sidebar',
    		'id'            => "left_sidebar",
    		'description'   => 'Описание моего сайдбара',
		    'before_widget' => '<div class="widget %2$s">',
		    'after_widget'  => "</div>\n",
		    'before_title'  => '<h5 class="widgettitle">',
		    'after_title'   => "</h5>\n"
    	) );
    }
    ////////////////////////////////////////
    /////////////////////МЕНЮ///////////////
    add_action( 'after_setup_theme', 'theme_register_nav_menu' );
    function theme_register_nav_menu() {
		register_nav_menu( 'top', 'Меню в шапке' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails', array( 'post' ) );
		add_theme_support( 'post-formats', array( 'video', 'aside' ) );
		add_image_size( 'post_thumb', 1300, 500, true);
		
    add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
    function my_navigation_template( $template, $class ){
	    return '<nav class="navigation %1$s" role="navigation">
		        <div class="nav-links">%3$s</div>
		    </nav>';
        } the_posts_pagination( array(
	       'end_size' => 2, ) ); 
    }
    ////////////////////////////////////////////////////
    //////////////ШОРТКОД////////////////////
    add_shortcode('my_short', 'short_function');
        function short_function() {
        return 'Я тут - ШОРТКОД';
    }
    
    function Generate_iframe( $atts ) {
	$atts = shortcode_atts( array(
		'href'   => 'https://wp-kama.ru/',
		'height' => '550px',
		'width'  => '600px',     
	), $atts );

	return '<iframe src="'. $atts['href'] .'" width="'. $atts['width'] .'" height="'. $atts['height'] .'"> <p>Your Browser does not support Iframes.</p></iframe>';
    }
    add_shortcode('iframe', 'Generate_iframe');
    // использование: [iframe href="https://wp-kama.ru/" height="480" width="640"]
    ///////////////////////////////////////////////////
    ////////////////ЧИТАТЬ ДАЛЬШЕ//////////////////////
    add_filter( 'excerpt_more', 'new_excerpt_more' );
    function new_excerpt_more( $more ){
	global $post;
	return '<a href="'. get_permalink($post) . '">Читать дальше...</a>';
    }
    /////////////////////////////////////////
    ////////////////////////////////////////////
    add_action('init', 'my_post_types');
    function my_post_types(){
    	register_post_type('portfolio', array(
    		    'labels'             => array(
    			'name'               => 'Портфолио', // Основное название типа записи
    			'singular_name'      => 'Портфолио', // отдельное название записи типа Book
    			'add_new'            => 'Добавить работу',
    			'add_new_item'       => 'Добавить новую работу',
    			'edit_item'          => 'Редактировать работу',
    			'new_item'           => 'Новая работа',
    			'view_item'          => 'Посмотреть работу',
    			'search_items'       => 'Найти работу',
    			'not_found'          => 'Работа не найдено',
    			'not_found_in_trash' => 'В корзине не найдено',
    			'parent_item_colon'  => '',
    			'menu_name'          => 'Портфолио'
    
    		  ),
    		'menu_icon'          => 'dashicons-format-gallery',
    		'public'             => true,
    		'publicly_queryable' => true,
    		'show_ui'            => true,
    		'show_in_menu'       => true,
    		'query_var'          => true,
    		'rewrite'            => true,
    		'capability_type'    => 'post',
    		'has_archive'        => true,
    		'hierarchical'       => false,
    		'menu_position'      => 4,
    		'supports'           => array('title','editor','author','thumbnail','excerpt','comments')
    	) );
    }


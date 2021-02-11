<?php
add_action( 'after_setup_theme', 'orolifestyle_setup' );
function orolifestyle_setup() {
	load_theme_textdomain( 'orolifestyle', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form' ) );
	
	global $content_width;
	if ( ! isset( $content_width ) ) { $content_width = 1920; }
	register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'orolifestyle' ) ) );
}
	
add_action( 'wp_enqueue_scripts', 'orolifestyle_load_scripts' );
function orolifestyle_load_scripts() {
	//wp_enqueue_style( 'orolifestyle-style', get_stylesheet_uri() );
	//wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/assets/css/bootstrap.css' );
	wp_enqueue_style( 'all.min.css', get_template_directory_uri().'/assets/css/all.min.css' );
	wp_enqueue_style( 'fontawesome.min.css', get_template_directory_uri().'/assets/css/fontawesome.min.css' );
	wp_enqueue_style( 'dataTables.bootstrap4.min.css', get_template_directory_uri().'/assets/css/dataTables.bootstrap4.min.css' );
	wp_enqueue_style( 'responsive.bootstrap4.min.css', get_template_directory_uri().'/assets/css/responsive.bootstrap4.min.css' );
	wp_enqueue_style( 'adminlte.min.css', get_template_directory_uri().'/assets/css/adminlte.min.css' );
	wp_enqueue_style( 'sweetalert2-theme-bootstrap-4.css', get_template_directory_uri().'/assets/css/sweetalert2-theme-bootstrap-4.css' );
	wp_enqueue_style( 'sweetalert2.min.css', get_template_directory_uri().'/assets/css/sweetalert2.min.css' );
	wp_enqueue_style( 'daterangepicker', get_template_directory_uri().'/assets/css/daterangepicker.css' );
	//wp_enqueue_style( 'bootstrap-glyphicons.css', get_template_directory_uri().'/assets/css/bootstrap-glyphicons.css' );
	wp_enqueue_style( 'datetimepicker.min.css', get_template_directory_uri().'/assets/css/datetimepicker.min.css' );
	wp_enqueue_style( 'summernote-bs4.min.css', get_template_directory_uri().'/assets/css/summernote-bs4.min.css' );
	
	wp_enqueue_script( 'jquery' );
	//wp_enqueue_script( 'font-awesome', get_template_directory_uri().'/assets/js/all.min.js', array('jquery'), time() );
	wp_enqueue_script( 'bootstrap.bundle.min.js', get_template_directory_uri().'/assets/js/bootstrap.bundle.min.js', array('jquery'), time() );
	wp_enqueue_script( 'adminlte.min.js', get_template_directory_uri().'/assets/js/adminlte.min.js', array('jquery'), time() );
	wp_enqueue_script( 'jquery.dataTables.min.js', get_template_directory_uri().'/assets/js/jquery.dataTables.min.js', array('jquery'), time() );
	wp_enqueue_script( 'dataTables.bootstrap4.min.js', get_template_directory_uri().'/assets/js/dataTables.bootstrap4.min.js', array('jquery'), time() );
	wp_enqueue_script( 'dataTables.responsive.min.js', get_template_directory_uri().'/assets/js/dataTables.responsive.min.js', array('jquery'), time() );
	wp_enqueue_script( 'responsive.bootstrap4.min.js', get_template_directory_uri().'/assets/js/responsive.bootstrap4.min.js', array('jquery'), time() );
	wp_enqueue_script( 'sweetalert2.min.js', get_template_directory_uri().'/assets/js/sweetalert2.min.js', array('jquery'), time() );
	wp_enqueue_script( 'daterangepicker', get_template_directory_uri().'/assets/js/daterangepicker.js', array('jquery'), time() );
	wp_enqueue_script( 'moment.min.js', get_template_directory_uri().'/assets/js/moment.min.js', array('jquery'), time() );
	wp_enqueue_script( 'datetimepicker.min.js', get_template_directory_uri().'/assets/js/datetimepicker.min.js', array('jquery'), time() );
	wp_enqueue_script( 'summernote-bs4.min.js', get_template_directory_uri().'/assets/js/summernote-bs4.min.js', array('jquery'), time() );
	wp_enqueue_script( 'jquery.validate.min.js', get_template_directory_uri().'/assets/js/jquery.validate.min.js', array('jquery'), time() );
	wp_enqueue_script( 'additional-methods.min.js', get_template_directory_uri().'/assets/js/additional-methods.min.js', array('jquery'), time() );
	//wp_enqueue_script( 'orolifestyle.js', get_template_directory_uri().'/assets/js/orolifestyle.js', array('jquery'), time() );

}

add_action( 'wp_footer', 'orolifestyle_footer_scripts' );
function orolifestyle_footer_scripts() { ?>
<script>
	jQuery(document).ready(function ($) {
		var deviceAgent = navigator.userAgent.toLowerCase();
		if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
			$("html").addClass("ios");
			$("html").addClass("mobile");
		}
		if (navigator.userAgent.search("MSIE") >= 0) {
			$("html").addClass("ie");
		}else if (navigator.userAgent.search("Chrome") >= 0) {
			$("html").addClass("chrome");
		}else if (navigator.userAgent.search("Firefox") >= 0) {
			$("html").addClass("firefox");
		}else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
			$("html").addClass("safari");
		}else if (navigator.userAgent.search("Opera") >= 0) {
			$("html").addClass("opera");
		}
	});
</script>
<?php
}

add_filter( 'document_title_separator', 'orolifestyle_document_title_separator' );
function orolifestyle_document_title_separator( $sep ) {
	$sep = '|';
	return $sep;
}

add_filter( 'the_title', 'orolifestyle_title' );
function orolifestyle_title( $title ) {
	if ( $title == '' ) {
		return '...';
	} else {
		return $title;
	}
}

add_filter( 'the_content_more_link', 'orolifestyle_read_more_link' );
function orolifestyle_read_more_link() {
	if ( ! is_admin() ) {
		return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">...</a>';
	}
}

add_filter( 'excerpt_more', 'orolifestyle_excerpt_read_more_link' );
function orolifestyle_excerpt_read_more_link( $more ) {
	if ( ! is_admin() ) {
		global $post;
		return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">...</a>';
	}
}

add_filter( 'intermediate_image_sizes_advanced', 'orolifestyle_image_insert_override' );
function orolifestyle_image_insert_override( $sizes ) {
	unset( $sizes['medium_large'] );
	return $sizes;
}

add_action( 'widgets_init', 'orolifestyle_widgets_init' );
function orolifestyle_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Sidebar Widget Area', 'orolifestyle' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

add_action( 'wp_head', 'orolifestyle_pingback_header' );
function orolifestyle_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'comment_form_before', 'orolifestyle_enqueue_comment_reply_script' );
function orolifestyle_enqueue_comment_reply_script() {
	if ( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function orolifestyle_custom_pings( $comment ) { ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php }
add_filter( 'get_comments_number', 'orolifestyle_comment_count', 0 );

function orolifestyle_comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$get_comments = get_comments( 'status=approve&post_id=' . $id );
		$comments_by_type = separate_comments( $get_comments );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

// Register Custom Post Type
function setup_custom_post_type_and_taxonomy() {

	$labels = array(
		'name'                  => _x( 'Customers', 'Post Type General Name', 'orolifestyle' ),
		'singular_name'         => _x( 'Customer', 'Post Type Singular Name', 'orolifestyle' ),
		'menu_name'             => __( 'Customers', 'orolifestyle' ),
		'name_admin_bar'        => __( 'Customers', 'orolifestyle' ),
		'archives'              => __( 'Customer Archives', 'orolifestyle' ),
		'attributes'            => __( 'Customer Attributes', 'orolifestyle' ),
		'parent_item_colon'     => __( 'Parent Customer:', 'orolifestyle' ),
		'all_items'             => __( 'All Customers', 'orolifestyle' ),
		'add_new_item'          => __( 'Add New Customer', 'orolifestyle' ),
		'add_new'               => __( 'Add New', 'orolifestyle' ),
		'new_item'              => __( 'New Customer', 'orolifestyle' ),
		'edit_item'             => __( 'Edit Customer', 'orolifestyle' ),
		'update_item'           => __( 'Update Customer', 'orolifestyle' ),
		'view_item'             => __( 'View Customer', 'orolifestyle' ),
		'view_items'            => __( 'View Customers', 'orolifestyle' ),
		'search_items'          => __( 'Search Customer', 'orolifestyle' ),
		'not_found'             => __( 'Not found', 'orolifestyle' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'orolifestyle' ),
		'featured_image'        => __( 'Featured Image', 'orolifestyle' ),
		'set_featured_image'    => __( 'Set featured image', 'orolifestyle' ),
		'remove_featured_image' => __( 'Remove featured image', 'orolifestyle' ),
		'use_featured_image'    => __( 'Use as featured image', 'orolifestyle' ),
		'insert_into_item'      => __( 'Insert into item', 'orolifestyle' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'orolifestyle' ),
		'items_list'            => __( 'Customers list', 'orolifestyle' ),
		'items_list_navigation' => __( 'Customers list navigation', 'orolifestyle' ),
		'filter_items_list'     => __( 'Filter customers list', 'orolifestyle' ),
	);
	$args = array(
		'label'                 => __( 'Customer', 'orolifestyle' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'customers', $args );

	register_taxonomy(
    	'business-types',
		'customers',
		array(
			'label' => __( 'Business Types' ),
			'rewrite' => array( 'slug' => 'business-types' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
    	'western',
		'customers',
		array(
			'label' => __( 'Western' ),
			'rewrite' => array( 'slug' => 'western' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
    	'long-growns',
		'customers',
		array(
			'label' => __( 'Long Growns' ),
			'rewrite' => array( 'slug' => 'long-growns' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
    	'lahengas',
		'customers',
		array(
			'label' => __( 'Lahengas' ),
			'rewrite' => array( 'slug' => 'lahengas' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
    	'tops-and-t-shirts',
		'customers',
		array(
			'label' => __( 'Tops And T-Shirts' ),
			'rewrite' => array( 'slug' => 'tops-and-t-shirts' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
    	'kurtis',
		'customers',
		array(
			'label' => __( 'Kurtis' ),
			'rewrite' => array( 'slug' => 'kurtis' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
    	'shirts',
		'customers',
		array(
			'label' => __( 'Shirts' ),
			'rewrite' => array( 'slug' => 'shirts' ),
			'hierarchical' => true,
		)
	);

}
add_action( 'init', 'setup_custom_post_type_and_taxonomy', 0 );

add_action( 'init', 'create_customer_endpoint' );
function create_customer_endpoint(){
    add_rewrite_rule(
        'edit-customer/([^/]*)/?$',
        'index.php?pagename=edit-customer/&id=$matches[1]',
        'top' 
    );
}

add_filter( 'query_vars', 'create_customer_endpoint_query_vars' );
function create_customer_endpoint_query_vars( $query_vars ){
    $query_vars[] = 'id';   
    return $query_vars;
}

function add_sales_role_and_hide_admin_toolbar_for_sales_user(){

	add_role( 'sales', 'Sales', array( 'read' => true, 'level_0' => true ) );

    if(!current_user_can('administrator')){
        add_filter( 'show_admin_bar', '__return_false' );
        add_action( 'admin_print_scripts-profile.php', function(){
        	?><style type="text/css">.show-admin-bar {display: none;}</style><?php
        } );
    }

}
add_action('init', 'add_sales_role_and_hide_admin_toolbar_for_sales_user', 9);

function check_user_logged_in(){
    //redirect_non_logged_users_to_login_page
    if ( 
    	( 
    		is_page('add-customer') || 
    		is_page( 'all-customer' ) || 
    		is_page( 'dashboard' ) || 
    		is_page( 'edit-customer' ) || 
    		is_page( 'all-customer' )
    	) && ! is_user_logged_in() 
    	) 
    {
		wp_safe_redirect( home_url() ); 
		exit;
	}
}
add_action("wp", "check_user_logged_in");

//add customer service
add_action('wp_ajax_nopriv_add_customer', 'add_customer'); 
add_action('wp_ajax_add_customer', 'add_customer');
function add_customer(){

	parse_str($_POST['customer_data'], $customer_data);
	
	if ( ! wp_verify_nonce( $_POST['security'], 'security' ) ){
		wp_send_json_error(array(
			'message' => __('You can not perform this operation.','orolifestyle')
		));
	}
	
	if( $customer_data['customer']['first_name'] == '' || $customer_data['customer']['last_name'] == '' || $customer_data['customer']['primary_number'] == '' ){
		wp_send_json_error(array(
			'message' => __('Please enter required information.','orolifestyle')
		));
	}

	if( is_customer_mobile_exist( $customer_data['customer']['primary_number'] ) ){
		wp_send_json_error(array(
			'message' => __('Customer already exist with this primary mobile number.','orolifestyle')
		));
	}

	if( $customer_data['customer']['secondary_number'] != '' && is_customer_mobile_exist( $customer_data['customer']['secondary_number'] ) ){
		wp_send_json_error(array(
			'message' => __('Customer already exist with this secondary mobile number.','orolifestyle')
		));
	}

	if( $customer_data['customer']['email'] != '' && is_customer_email_exist( $customer_data['customer']['email'] ) ){
		wp_send_json_error(array(
			'message' => __('Customer already exist with this email.','orolifestyle')
		));
	}

	//echo "<pre>"; print_r($customer_data['category']); echo "</pre>"; die;

	$customer = array(
		'post_type'    => 'customers',
	    'post_title'   => $customer_data['customer']['first_name'].' ' .$customer_data['customer']['last_name'],
	    'post_status'  => 'publish',
	    'post_author'  => ( isset( $customer_data['customer']['author'] ) && $customer_data['customer']['author'] != '' ) ? $customer_data['customer']['author'] : get_current_user_id(),
	    //'tax_input'    => $customer_data['category'],
	);

	$customer_id = wp_insert_post( $customer, $wp_error );

	if( !empty( $customer_data['category'] ) ){
		foreach ($customer_data['category'] as $key => $value) {
			wp_set_post_terms( $customer_id, $value, $key );
		}
	}

	if( !is_wp_error( $customer_id ) ){
		if( !empty( $customer_data['customer'] ) ){
			$customer_data['customer']['follow_up_date'] = strtotime( $customer_data['customer']['follow_up_date'] );
			foreach ($customer_data['customer'] as $key => $value) {
				if( $key != 'discussion' ){
					update_post_meta( $customer_id, $key, $value );
				}
			}

			$discussions = array();
			if( !empty( $customer_data['customer']['discussion'] ) ){
				foreach ($customer_data['customer']['discussion'] as $key => $discussion) {
					if( isset( $discussion['date'] ) && $discussion['date'] != '' && isset( $discussion['description'] ) && $discussion['description'] != '' ){
						$discussions[$key] = $discussion;
						$discussions[$key]['date'] = strtotime( $discussions[$key]['date'] );
					}
				}
				if( !empty( $discussions ) ){
					update_post_meta( $customer_id, 'discussions', $discussions );
				}
			}	
		}

		wp_send_json_success(array(
			'message' => __('Customer added sucessfully.','orolifestyle')
		));
	}else{
		wp_send_json_error(array(
			'message' => $customer_id->get_error_message()
		));
	}

}

//edit customer service
add_action('wp_ajax_nopriv_update_customer', 'update_customer'); 
add_action('wp_ajax_update_customer', 'update_customer');
function update_customer(){

	parse_str($_POST['customer_data'], $customer_data);

	if ( ! wp_verify_nonce( $_POST['security'], 'security' ) ){
		wp_send_json_error(array(
			'message' => __('You can not perform this operation.','orolifestyle')
		));
	}
	
	if( $customer_data['customer']['first_name'] == '' || $customer_data['customer']['last_name'] == '' || $customer_data['customer']['primary_number'] == '' ){
		wp_send_json_error(array(
			'message' => __('Please enter required information.','orolifestyle')
		));
	}

	if( is_customer_mobile_exist( $customer_data['customer']['primary_number'], $customer_data['id']) ){
		wp_send_json_error(array(
			'message' => __('Customer already exist with this primary mobile number.','orolifestyle')
		));
	}

	if( $customer_data['customer']['secondary_number'] != '' && is_customer_mobile_exist( $customer_data['customer']['secondary_number'], $customer_data['id']) ){
		wp_send_json_error(array(
			'message' => __('Customer already exist with this secondary mobile number.','orolifestyle')
		));
	}

	if( $customer_data['customer']['email'] != '' && is_customer_email_exist( $customer_data['customer']['email'], $customer_data['id'] ) ){
		wp_send_json_error(array(
			'message' => __('Customer already exist with this email.','orolifestyle')
		));
	}

	$customer = array(
		'ID' 		   => $customer_data['id'],
		'post_type'    => 'customers',
	    'post_title'   => $customer_data['customer']['first_name'].' ' .$customer_data['customer']['last_name'],
	    'post_status'  => 'publish',
	    'post_author'  => ( isset( $customer_data['customer']['author'] ) && $customer_data['customer']['author'] != '' ) ? $customer_data['customer']['author'] : get_current_user_id(),
	    //'tax_input'    => $customer_data['category'],
	);

	$customer_id = wp_update_post( $customer, $wp_error );

	if( !empty( $customer_data['category'] ) ){
		foreach ($customer_data['category'] as $key => $value) {
			wp_set_post_terms( $customer_id, $value, $key );
		}
	}

	if( !is_wp_error( $customer_id ) ){
		if( !empty( $customer_data['customer'] ) ){
			$customer_data['customer']['follow_up_date'] = strtotime( $customer_data['customer']['follow_up_date'] );
			foreach ($customer_data['customer'] as $key => $value) {
				if( $key != 'discussion' ){
					update_post_meta( $customer_id, $key, $value );
				}
			}

			$discussions = array();
			if( !empty( $customer_data['customer']['discussion'] ) ){
				foreach ($customer_data['customer']['discussion'] as $key => $discussion) {
					if( isset( $discussion['date'] ) && $discussion['date'] != '' && isset( $discussion['description'] ) && $discussion['description'] != '' ){
						$discussions[$key] = $discussion;
						$discussions[$key]['date'] = strtotime( $discussions[$key]['date'] );
					}
				}

				if( !empty( $discussions ) ){
					$discussions = array_combine(range(1, count($discussions)), array_values($discussions));
					update_post_meta( $customer_id, 'discussions', $discussions );
				}
			}
		}
		wp_send_json_success(array(
			'message' => __('Customer updated sucessfully.','orolifestyle')
		));
	}else{
		wp_send_json_error(array(
			'message' => $customer_id->get_error_message()
		));
	}

}

function is_customer_mobile_exist( $mobile, $customer_id = '' ){
	$customers_args = array(
	    'post_type'      => 'customers',
	    'posts_per_page' => -1,
	    'meta_query'	 => array(
	    	'relation'   => 'OR',
	    	array(
	    		'key'     => 'primary_number',
	    		'value'   => $mobile,
	    		'compare' => '=',
	    	),
	    	array(
	    		'key'     => 'secondary_number',
	    		'value'   => $mobile,
	    		'compare' => '=',
	    	)
	    )
	);   

	if( $customer_id != '' ){
		$customers_args['post__not_in'] = array( $customer_id );
	}

	$customers = new WP_Query( $customers_args );

	if( $customers->have_posts() ){
		return true;
	}
	return false;
}

function is_customer_email_exist( $email, $customer_id = '' ){
	$customers_args = array(
	    'post_type'      => 'customers',
	    'posts_per_page' => -1,
	    'meta_query'	 => array(
	    	array(
	    		'key'     => 'email',
	    		'value'   => $email,
	    		'compare' => '=',
	    	)
	    )
	);

	if( $customer_id != '' ){
		$customers_args['post__not_in'] = array( $customer_id );
	}

	$customers = new WP_Query( $customers_args );

	if( $customers->have_posts() ){
		return true;
	}
	return false;
}

//delete customer service
add_action('wp_ajax_nopriv_delete_customer', 'delete_customer'); 
add_action('wp_ajax_delete_customer', 'delete_customer');
function delete_customer(){
	$customer = wp_trash_post( $_POST['id'] );
	if( $customer ){
		wp_send_json_success(array(
			'message' => __('Customer deleted sucessfully.','orolifestyle')
		));
	}else{
		wp_send_json_error(array(
			'message' => __('Customer not deleted. Something went wrong','orolifestyle')
		));
	}
}

function change_lostpassword_url( $lostpassword_url, $redirect ){
	$lostpassword_url = home_url('/forgot-password/');
	return $lostpassword_url;
}
add_filter( 'lostpassword_url', 'change_lostpassword_url', 10, 2 );

add_action( 'wp_ajax_login_user', 'login_user' );
add_action( 'wp_ajax_nopriv_login_user', 'login_user' );
function login_user(){

	parse_str($_POST['login_data'], $login_data);

	if ( ! wp_verify_nonce( $_POST['security'], 'security' ) ){
		wp_send_json_error(array(
			'message' => __('You can not perform this operation.','orolifestyle')
		));
	}

    $email    = sanitize_email( $login_data['email'] );
	$password = esc_attr( $login_data['password'] );

	$creds = array(
        'user_login'    => $email,
        'user_password' => $password,
        'remember'      => true
    );
 
    $user = wp_signon( $creds, true );
 
    if ( is_wp_error( $user ) ) {
        wp_send_json_error(array(
			'message' => $user->get_error_message(),
			'user' => $user
		));
    }

    wp_send_json_success(array(
    	'redirect' => home_url('/dashboard/')
    ));

}

add_action( 'wp_ajax_update_user_profile', 'update_user_profile' );
add_action( 'wp_ajax_nopriv_update_user_profile', 'update_user_profile' );
function update_user_profile(){

	parse_str($_POST['profile_data'], $profile_data);

	/* Update user information. */

	if ( empty( $profile_data['first_name'] ) || empty( $profile_data['last_name'] ) || empty( $profile_data['email'] ) || empty( $profile_data['phone'] ) ){
		wp_send_json_error(array(
			'message' => __('Please enter required field.', 'orolifestyle')
		));
	}

    if ( !empty( $profile_data['email'] ) ){
        if (!is_email(esc_attr( $profile_data['email'] ))){
        	wp_send_json_error(array(
				'message' => __('The Email you entered is not valid.  please try again.', 'orolifestyle')
			));
        }elseif(email_exists(esc_attr( $profile_data['email'] )) != get_current_user_id() ){
        	wp_send_json_error(array(
				'message' => __('This email is already used by another user.  try a different one.', 'orolifestyle')
			));
        }else{
            wp_update_user( array('ID' => get_current_user_id(), 'user_email' => esc_attr( $profile_data['email'] )));
        }
    }

    if ( !empty( $profile_data['first_name'] ) ){
        update_user_meta( get_current_user_id(), 'first_name', esc_attr( $profile_data['first_name'] ) );
    }
    if ( !empty( $profile_data['last_name'] ) ){
        update_user_meta( get_current_user_id(), 'last_name', esc_attr( $profile_data['last_name'] ) );
    }
    if ( !empty( $profile_data['phone'] ) ){
        update_user_meta( get_current_user_id(), 'phone', esc_attr( $profile_data['phone'] ) );
    }

	wp_send_json_success(array(
		'message' => __('Profile updated successfully.','orolifestyle')
	));
}

add_action( 'wp_ajax_request_new_password', 'request_new_password' );
add_action( 'wp_ajax_nopriv_request_new_password', 'request_new_password' );
function request_new_password(){

	parse_str($_POST['forgot_password_data'], $forgot_password_data);

	if ( ! wp_verify_nonce( $_POST['security'], 'security' ) ){
		wp_send_json_error(array(
			'message' => __('You can not perform this operation.','orolifestyle')
		));
	}

	if ( empty( $forgot_password_data['email'] ) ){
		wp_send_json_error(array(
			'message' => __('Please enter required field.', 'orolifestyle')
		));
	}

    if ( !empty( $forgot_password_data['email'] ) ){
        if (!is_email(esc_attr( $forgot_password_data['email'] ))){
        	wp_send_json_error(array(
				'message' => __('The Email you entered is not valid.  please try again.', 'orolifestyle')
			));
        }elseif( !email_exists(esc_attr( $forgot_password_data['email'] ) ) ){
        	wp_send_json_error(array(
				'message' => __('This email is not registered in our system.  try a different one.', 'orolifestyle')
			));
        }else{

        	$user = get_user_by( 'email', $forgot_password_data['email'] );

        	$last_password_requested = get_user_meta( $user->ID, 'last_password_requested', true );

			if( $last_password_requested != '' ){
				$d1 = new DateTime( date('Y-m-d H:i:s A', $last_password_requested ) ); 
				$d2 = new DateTime( date('Y-m-d H:i:s A', current_time( 'timestamp', 0 ) ) );
				$interval = $d1->diff($d2);
				$hours = ($interval->days * 24) + $interval->h;
				if( $hours < 24 ){
					wp_send_json_error(array(
						'message' => __('You already requested for new password. request for new password again please try after 24 hours.', 'orolifestyle'),
					));
				}
			}

        	add_filter( 'wp_mail_content_type', 'orolifestyle_set_html_mail_content_type' );

     		$to 	 = 'admin@gmail.com';
			$subject = 'New password requested - '.get_bloginfo( 'name' );
			$body    = $user->first_name . ' ' . $user->last_name .' Requested for new password';
			$headers = array(
				'From: '.$user->first_name . ' ' . $user->last_name.' <'.$forgot_password_data['email'].'>'
			);
			 
			wp_mail( $to, $subject, $body, $headers );

			remove_filter( 'wp_mail_content_type', 'orolifestyle_set_html_mail_content_type' );

			update_user_meta( $user->ID, 'last_password_requested', current_time( 'timestamp', 0 ) );

        }
    }

	wp_send_json_success(array(
		'message' => __( 'Your new password request sent to the admin.','orolifestyle' )
	));
}

function orolifestyle_set_html_mail_content_type() {
    return 'text/html';
}

add_action( 'wp_ajax_get_discussions', 'get_discussions' );
add_action( 'wp_ajax_nopriv_get_discussions', 'get_discussions' );
function get_discussions(){

	ob_start();

	$id = $_POST['id'];
	$get_discussions = get_post_meta( $id, 'discussions', true );
	if( !empty( $get_discussions ) ){ ?>
		<div class="timeline">
		  <?php foreach ($get_discussions as $key => $discussion) { ?>
		      <!-- timeline time label -->
		      <div class="time-label">
		        <span class="bg-green">Discussion <?php echo $key; ?>:</span>
		      </div>
		      <!-- /.timeline-label -->
		      <!-- timeline item -->
		      <div>
		        <i class="fas fa-envelope bg-blue"></i>
		        <div class="timeline-item">
		          <h3 class="timeline-header"><?php echo date('d M. Y H:i a', $discussion['date'] ); ?></h3>
		          <div class="timeline-body">
		           <?php echo $discussion['description']; ?>
		          </div>
		        </div>
		      </div>
		      <!-- END timeline item -->
		  <?php } ?>
	      <div>
	        <i class="fas fa-clock bg-gray"></i>
	      </div>
	    </div>
	<?php
	}else{ ?>
		<div class="alert alert-danger alert-dismissible">No discussions available.</div>
	<?php }

	$html = ob_get_clean();

	wp_send_json_success(array(
		'html' => $html
	));	

}

add_action( 'wp_ajax_edit_customer', 'edit_customer' );
add_action( 'wp_ajax_nopriv_edit_customer', 'edit_customer' );
function edit_customer(){

	ob_start();

	$id = $_POST['id'];
	if( get_post( $id ) ){ ?>
	<div class="">
    <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php echo get_the_title( $id ); ?></h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
             <div class="col-sm-12">
                <form class="customer_form" method="post">
                   <div class="form-group row">
                      <label for="name" class="col-sm-2 col-form-label">Name of Person :</label>
                      <div class="col-sm-3 mb-2 mb-md-0">
                         <input type="text" name="customer[first_name]" class="form-control" id="first_name" value="<?php echo get_post_meta( $id, 'first_name', true ); ?>" placeholder="First Name">
                      </div>
                      <div class="col-sm-3 mb-2 mb-md-0">
                         <input type="text" name="customer[last_name]"  class="form-control" id="last_name" value="<?php echo get_post_meta( $id, 'last_name', true ); ?>" placeholder="Last Name">
                      </div>
                      <div class="col-sm-3">
                         <input type="email" name="customer[email]" class="form-control" id="email" value="<?php echo get_post_meta( $id, 'email', true ); ?>" placeholder="Email">
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="primary_number" class="col-sm-2 col-form-label">Contact Number :</label>
                      <div class="col-sm-2 mb-2 mb-md-0">
                         <input type="number" name="customer[primary_number]" class="form-control" id="primary_number" value="<?php echo get_post_meta( $id, 'primary_number', true ); ?>" placeholder="Primary Number">
                      </div>
                      <div class="col-sm-4 mb-2 mb-md-0">
                      	 <input type="text" class="form-control" name="customer[code]" id="code" value="<?php echo get_post_meta( $id, 'code', true ); ?>" placeholder="Code">
                      </div>
                      <div class="col-sm-4">
                         <input type="number" name="customer[secondary_number]" class="form-control" id="secondary_number" value="<?php echo get_post_meta( $id, 'secondary_number', true ); ?>" placeholder="Secondary Number">
                      </div>
                   </div>
                   <div class="space"></div>
                   <div class="form-group row">
                      <label for="business_name" class="col-sm-2 col-form-label">Organization & Business Name :</label>
                      <div class="col-sm-10">
                         <input type="text" name="customer[business_name]" class="form-control" id="business_name" value="<?php echo get_post_meta( $id, 'business_name', true ); ?>">
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="designation" class="col-sm-2 col-form-label">Designation :</label>
                      <div class="col-sm-10">
                         <input type="text" name="customer[designation]" class="form-control" id="designation" value="<?php echo get_post_meta( $id, 'designation', true ); ?>">
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="gst_no" class="col-sm-2 col-form-label">GST No & Other Registration No :</label>
                      <div class="col-sm-10">
                         <input type="text" name="customer[gst_no]" class="form-control" id="gst_no" value="<?php echo get_post_meta( $id, 'gst_no', true ); ?>">
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="business_establishments_date" class="col-sm-2 col-form-label">Business Establishments Date :</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control datetimepicker-input" name="customer[business_establishments_date]" id="business_establishments_date" data-toggle="datetimepicker" data-target="#business_establishments_date" value=""/>
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="address1" class="col-sm-2 col-form-label">Address 1 :</label>
                      <div class="col-sm-10">
                         <input type="text" name="customer[address1]" class="form-control" id="address1_first_line" value="<?php echo get_post_meta( $id, 'address1', true ); ?>">
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="address2" class="col-sm-2 col-form-label">Address 2 :</label>
                      <div class="col-sm-10">
                         <input type="text" name="customer[address2]" class="form-control" id="address2_first_line" value="<?php echo get_post_meta( $id, 'address2', true ); ?>">
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="business_types" class="col-sm-2">Business Types</label>
                      <div class="col-sm-10">
                        <?php
                        $business_types = get_terms( array(
                          'taxonomy' => 'business-types',
                          'hide_empty' => false
                        ) );
                        if ( ! empty( $business_types ) && ! is_wp_error( $business_types ) ){
                          $business_types_selected = array_map(function ( $arr ) { return $arr->term_id; }, get_the_terms( $id, 'business-types' ));
                          foreach ( $business_types as $business_type ) { 
                            $checked = ( !empty( $business_types_selected ) && in_array( $business_type->term_id, $business_types_selected ) ) ? "checked" : "" ;
                            ?>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="category[<?php echo $business_type->taxonomy; ?>][]" type="checkbox" id="<?php echo $business_type->taxonomy; ?>_<?php echo $business_type->slug; ?>" value="<?php echo $business_type->term_id; ?>" <?php echo $checked; ?>>
                              <label class="form-check-label" for="<?php echo $business_type->taxonomy; ?>_<?php echo $business_type->slug; ?>"><?php echo $business_type->name; ?></label>
                           </div>
                          <?php }
                        }?>
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="category" class="col-sm-12">Category :</label>
                      <label for="category" class="col-sm-2">1. Western :</label>
                      <div class="col-sm-10">
                        <?php
                        $westerns = get_terms( array(
                          'taxonomy' => 'western',
                          'hide_empty' => false
                        ) );
                        if ( ! empty( $westerns ) && ! is_wp_error( $westerns ) ){
                          $western_selected = array_map(function ( $arr ) { return $arr->term_id; }, get_the_terms( $id, 'western' ));
                          foreach ( $westerns as $western ) { 
                            $checked = ( !empty( $western_selected ) && in_array( $western->term_id, $western_selected ) ) ? "checked" : "" ;
                            ?>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="category[<?php echo $western->taxonomy; ?>][]" type="checkbox" id="<?php echo $western->taxonomy; ?>_<?php echo $western->slug; ?>" value="<?php echo $western->term_id; ?>" <?php echo $checked; ?>>
                              <label class="form-check-label" for="<?php echo $western->taxonomy; ?>_<?php echo $western->slug; ?>"><?php echo $western->name; ?></label>
                           </div>
                          <?php }
                        }?>
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="category" class="col-sm-2">2. Long Growns :</label>
                      <div class="col-sm-10">
                         <?php
                          $long_growns = get_terms( array(
                            'taxonomy' => 'long-growns',
                            'hide_empty' => false
                          ) );
                          if ( ! empty( $long_growns ) && ! is_wp_error( $long_growns ) ){
                            $long_growns_selected = array_map(function ( $arr ) { return $arr->term_id; }, get_the_terms( $id, 'long-growns' ));
                            foreach ( $long_growns as $long_grown ) { 
                              $checked = ( !empty( $long_growns_selected ) && in_array( $long_grown->term_id, $long_growns_selected ) ) ? "checked" : "" ;
                              ?>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="category[<?php echo $long_grown->taxonomy; ?>][]" type="checkbox" id="<?php echo $long_grown->taxonomy; ?>_<?php echo $long_grown->slug; ?>" value="<?php echo $long_grown->term_id; ?>" <?php echo $checked; ?>>
                                <label class="form-check-label" for="<?php echo $long_grown->taxonomy; ?>_<?php echo $long_grown->slug; ?>"><?php echo $long_grown->name; ?></label>
                             </div>
                            <?php }
                          }?>
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="category" class="col-sm-2">3. Lahengas :</label>
                      <div class="col-sm-10">
                        <?php
                          $lahengas = get_terms( array(
                            'taxonomy' => 'lahengas',
                            'hide_empty' => false
                          ) );
                          if ( ! empty( $lahengas ) && ! is_wp_error( $lahengas ) ){
                            $lahengas_selected = array_map(function ( $arr ) { return $arr->term_id; }, get_the_terms( $id, 'lahengas' ));
                            foreach ( $lahengas as $lahenga ) { 
                              $checked = ( !empty( $lahengas_selected ) && in_array( $lahenga->term_id, $lahengas_selected ) ) ? "checked" : "" ;
                              ?>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="category[<?php echo $lahenga->taxonomy; ?>][]" type="checkbox" id="<?php echo $lahenga->taxonomy; ?>_<?php echo $lahenga->slug; ?>" value="<?php echo $lahenga->term_id; ?>" <?php echo $checked; ?>>
                                <label class="form-check-label" for="<?php echo $lahenga->taxonomy; ?>_<?php echo $lahenga->slug; ?>"><?php echo $lahenga->name; ?></label>
                             </div>
                            <?php }
                         }?>
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="category" class="col-sm-2">4. Tops And T-Shirts :</label>
                      <div class="col-sm-10">
                        <?php
                          $tops_and_t_shirts = get_terms( array(
                            'taxonomy' => 'tops-and-t-shirts',
                            'hide_empty' => false
                          ) );
                          if ( ! empty( $tops_and_t_shirts ) && ! is_wp_error( $tops_and_t_shirts ) ){
                            $tops_and_t_shirts_selected = array_map(function ( $arr ) { return $arr->term_id; }, get_the_terms( $id, 'tops-and-t-shirts' ));
                            foreach ( $tops_and_t_shirts as $tops_and_t_shirt ) { 
                              $checked = ( !empty( $tops_and_t_shirts_selected ) && in_array( $tops_and_t_shirt->term_id, $tops_and_t_shirts_selected ) ) ? "checked" : "" ;
                              ?>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="category[<?php echo $tops_and_t_shirt->taxonomy; ?>][]" type="checkbox" id="<?php echo $tops_and_t_shirt->taxonomy; ?>_<?php echo $tops_and_t_shirt->slug; ?>" value="<?php echo $tops_and_t_shirt->term_id; ?>" <?php echo $checked; ?>>
                                <label class="form-check-label" for="<?php echo $tops_and_t_shirt->taxonomy; ?>_<?php echo $tops_and_t_shirt->slug; ?>"><?php echo $tops_and_t_shirt->name; ?></label>
                             </div>
                            <?php }
                         }?>
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="category" class="col-sm-2">5. Kurtis :</label>
                      <div class="col-sm-10">
                        <?php
                          $kurtis = get_terms( array(
                            'taxonomy' => 'kurtis',
                            'hide_empty' => false
                          ) );
                          if ( ! empty( $kurtis ) && ! is_wp_error( $kurtis ) ){
                            $kurtis_selected = array_map(function ( $arr ) { return $arr->term_id; }, get_the_terms( $id, 'kurtis' ));
                            foreach ( $kurtis as $kurti ) { 
                              $checked = ( !empty( $kurtis_selected ) && in_array( $kurti->term_id, $kurtis_selected ) ) ? "checked" : "" ;
                              ?>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="category[<?php echo $kurti->taxonomy; ?>][]" type="checkbox" id="<?php echo $kurti->taxonomy; ?>_<?php echo $kurti->slug; ?>" value="<?php echo $kurti->term_id; ?>" <?php echo $checked; ?>>
                                <label class="form-check-label" for="<?php echo $kurti->taxonomy; ?>_<?php echo $kurti->slug; ?>"><?php echo $kurti->name; ?></label>
                             </div>
                            <?php }
                         }?>
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="category" class="col-sm-2">6. Shirts :</label>
                      <div class="col-sm-10">
                         <?php
                          $shirts = get_terms( array(
                            'taxonomy' => 'shirts',
                            'hide_empty' => false
                          ) );
                          if ( ! empty( $shirts ) && ! is_wp_error( $shirts ) ){
                            $shirts_selected = array_map(function ( $arr ) { return $arr->term_id; }, get_the_terms( $id, 'shirts' ));
                            foreach ( $shirts as $shirt ) {
                              $checked = ( !empty( $shirts_selected ) && in_array( $shirt->term_id, $shirts_selected ) ) ? "checked" : "" ;
                              ?>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="category[<?php echo $shirt->taxonomy; ?>][]" type="checkbox" id="<?php echo $shirt->taxonomy; ?>_<?php echo $shirt->slug; ?>" value="<?php echo $shirt->term_id; ?>" <?php echo $checked; ?>>
                                <label class="form-check-label" for="<?php echo $shirt->taxonomy; ?>_<?php echo $shirt->slug; ?>"><?php echo $shirt->name; ?></label>
                             </div>
                            <?php }
                         }?>
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="special_requirements" class="col-sm-12 col-form-label">7. Special Requirements</label>
                      <div class="col-sm-12">
                         <textarea class="form-control" name="customer[special_requirements]" rows="4" id="special_requirements"><?php echo get_post_meta( $id, 'special_requirements', true ); ?></textarea>
                      </div>
                   </div>
                   <!-- <div class="form-group row">
                      <label for="code" class="col-sm-1 col-form-label">Code :</label>
                      <div class="col-sm-5">
                         <input type="text" class="form-control" name="customer[code]" id="code" value="<?php echo get_post_meta( $id, 'code', true ); ?>">
                      </div>
                      <label for="wn" class="col-sm-1 col-form-label">WN.</label>
                      <div class="col-sm-5">
                         <input type="number" class="form-control" name="customer[wn]" id="wn" value="<?php echo get_post_meta( $id, 'wn', true ); ?>">
                      </div>
                   </div> -->
                   <div class="form-group discussions">

                      <?php

                      // global $wpdb;

                      // $table = $wpdb->prefix.'customer_dicussion';

                      $customer_dicussion = get_post_meta( $id, 'discussions', true );

                      if( !empty( $customer_dicussion ) ){
                        foreach ($customer_dicussion as $key => $dicussion) { ?>

                        <div class="card card-body discussion"> 
                          <div class="form-group row">
                            <label for="discussion<?php echo $key; ?>" class="col-form-label">Discussion 0<?php echo $key; ?>:</label> 
                         </div>
                         <div class="form-group row">
                            <label for="code" class="col-form-label">Date :</label>
                            <div class="col-sm-2">
                               <input type="text" class="form-control datetimepicker-input discussion-date" id="discussion-date<?php echo $key; ?>" name="customer[discussion][<?php echo $key; ?>][date]" data-toggle="datetimepicker" data-target="#discussion-date<?php echo $key; ?>" aria-invalid="false">
                            </div>
                            <label for="wn" class="col-form-label">Description.</label>
                            <div class="col-sm-8">
                               <textarea class="form-control" rows="4" name="customer[discussion][<?php echo $key; ?>][description]" id="discussion"><?php echo $dicussion['description']; ?></textarea>
                            </div>
                          </div>
                        </div>

                      <?php } } else{  ?>
                        <div class="card card-body discussion"> 
                          <div class="form-group row">
                            <label for="discussion1" class="col-form-label">Discussion 01:</label> 
                         </div>
                         <div class="form-group row">
                            <label for="code" class="col-form-label">Date :</label>
                            <div class="col-sm-2">
                               <input type="text" class="form-control datetimepicker-input discussion-date" id="discussion-date1" name="customer[discussion][1][date]" data-toggle="datetimepicker" data-target="#discussion-date1" aria-invalid="false">
                            </div>
                            <label for="wn" class="col-form-label">Description.</label>
                            <div class="col-sm-8">
                               <textarea class="form-control" rows="4" name="customer[discussion][1][description]" id="discussion"></textarea>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                 </div>
                 <div class="form-group row">
                    <div class="col-sm-12">
                       <button class="btn btn-primary" type="button" id="add_more_discussions">Add more discussion</button>
                    </div>
                 </div>
                   <?php

                    $sales_users = get_users( array(
                      'role__in' => array('sales')
                    ) );

                  if( current_user_can('administrator') ){ ?>
                   <div class="form-group row">
                      <div class="col-sm-3">
                          <label>Sales User</label>
                          <select class="form-control" name="customer[author]">
                            <?php foreach ( $sales_users as $sales_user ) { ?>
                              <option value="<?php echo $sales_user->ID; ?>" <?php echo $sales_user->ID == get_post_field( 'post_author', $id ) ? 'selected' : '' ; ?>><?php echo $sales_user->display_name; ?></option>
                            <?php } ?>
                          </select>
                      </div>
                      <div class="col-sm-3">
                      	<label for="follow_up_date">Follow up Date :</label>
	                    <input type="text" class="form-control datetimepicker-input" name="customer[follow_up_date]" id="follow_up_date" data-toggle="datetimepicker" data-target="#follow_up_date" value="" />  
                      </div>
                   </div>
                  <?php }else{ ?>
                  	<div class="form-group row">
                      <div class="col-sm-3">
                      	<label for="follow_up_date">Follow up Date :</label>
	                    <input type="text" class="form-control datetimepicker-input" name="customer[follow_up_date]" id="follow_up_date" data-toggle="datetimepicker" data-target="#follow_up_date" value="" />  
                      </div>
                   	</div>
                  <?php } ?>
                   <div class="form-group row required">
                    <div class="col-sm-3">
                        <label>Priority</label>
                        <select class="form-control" name="customer[priority]">
                          <option value="high" <?php echo get_post_meta( $id, 'priority', true ) == 'high' ? 'selected' : '' ; ?>>High</option>
                          <option value="medium" <?php echo get_post_meta( $id, 'priority', true ) == 'medium' ? 'selected' : '' ; ?>>Medium</option>
                          <option value="low" <?php echo get_post_meta( $id, 'priority', true ) == 'low' ? 'selected' : '' ; ?>>Low</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label>Status</label>
                        <select class="form-control" name="customer[status]">
                          <option value="pending" <?php echo get_post_meta( $id, 'status', true ) == 'pending' ? 'selected' : '' ; ?>>Pending</option>
                          <option value="complete" <?php echo get_post_meta( $id, 'status', true ) == 'complete' ? 'selected' : '' ; ?>>Complete</option>
                        </select>
                    </div>
                 </div>
                   <div class="form-group row">
                      <div class="col-sm-12"> 
                        <button class="btn btn-primary" type="submit" id="update_customer">Update customer</button>
                      </div>
                   </div>
                   <input type="hidden" name="id" value="<?php echo $id; ?>">
                </form>
             </div>
          </div>
        </div>
      </section>
  	</div>
	<script type="text/javascript">
	  (function($){

	    const Toast = Swal.mixin({
	      toast: true,
	      position: 'top-end',
	      showConfirmButton: false,
	      timer: 3000
	    });

	    $(document).ready(function(){

	      var customer_form = $(".customer_form").validate({
	        rules: {
	          "customer[first_name]": {
	              required: true
	          },
	          "customer[last_name]": {
	              required: true
	          },
	          "customer[email]": {
	              email: true
	          },
	          "customer[primary_number]": {
	              required: true,
	              maxlength: 10,
	              minlength: 10
	          },
	          "customer[secondary_number]": {
	              maxlength: 10,
	              minlength: 10
	          },
	          "customer[follow_up_date]": {
	              required: true
	          }
	        },
	        errorElement: 'span',
	        errorPlacement: function (error, element) {
	          error.addClass('invalid-feedback');
	          element.parent().append(error);
	        },
	        highlight: function (element, errorClass, validClass) {
	          $(element).addClass('is-invalid');
	        },
	        unhighlight: function (element, errorClass, validClass) {
	          $(element).removeClass('is-invalid');
	        }

	      });

	      $(document).on('submit', '.customer_form', function(e) {
	        
	        e.preventDefault();

	        $('#update_customer').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  Updating customer...').prop('disabled', true);

	        $.ajax({
	              type : "POST",
	              dataType : "json",
	              url : '<?php echo admin_url('admin-ajax.php'); ?>',
	              data : {
	                action: 'update_customer',
	                customer_data:$('.customer_form').serialize(),
	                security : '<?php echo wp_create_nonce('security'); ?>'
	              },
	              success: function(response) {
	                if( response.success ){
	                  Toast.fire({
	                    icon: 'success',
	                    title: response.data.message
	                  });
	                  $("#all-customer").DataTable().ajax.reload();
	                }else{
	                  Toast.fire({
	                    icon: 'error',
	                    title: response.data.message
	                  });
	                }
	                $('#update_customer').html('Update customer').prop('disabled', false);
	              },error: function (request, status, error) {
	                console.log(request.responseText);
	                $('#update_customer').html('Update customer').prop('disabled', false);
	              }
	          });
	      });
	    });

	    //Date time picker
	    $('#business_establishments_date').datetimepicker({
	      format: 'DD-MM-YYYY'
	    });

	    $('#business_establishments_date').val('<?php echo get_post_meta( $id, 'business_establishments_date', true ); ?>');

	    //Date range picker
	    $('#follow_up_date').datetimepicker({
	      sideBySide: true,
	      format: 'DD-MM-YYYY hh:mm A'
	    });

	    $('#follow_up_date').val('<?php echo date('d-m-Y h:i A', get_post_meta( $id, 'follow_up_date', true ) ); ?>');

	    var i = $('.discussion').length;

	    $('#discussion-date'+i).datetimepicker({
		    sideBySide: true,
		    format: 'DD-MM-YYYY hh:mm A'
		});

	    $('#add_more_discussions').click(function() {

	      if( $('.discussion').length < 7 ){
	        i++;
	        var html = '<div class="card card-body discussion">';
	              html += '<div class="form-group row">';
	                html += '<label for="discussion'+i+'" class="col-form-label">Discussion 0'+i+':</label>';
	              html += '</div>';
	              html += '<div class="form-group row">';
	                  html += '<label for="code" class="col-form-label">Date :</label>';
	                  html += '<div class="col-sm-2">';
	                     html += '<input type="text" class="form-control datetimepicker-input discussion-date" id="discussion-date'+i+'" name="customer[discussion]['+i+'][date]" data-toggle="datetimepicker" data-target="#discussion-date'+i+'" aria-invalid="false">';
	                  html += '</div>';
	                  html += '<label for="wn" class="col-form-label">Description.</label>';
	                  html += '<div class="col-sm-8">';
	                     html += '<textarea class="form-control" rows="4" name="customer[discussion]['+i+'][description]" id="discussion"></textarea>';
	                  html += '</div>';
	              html += '</div>';
	            html += '</div>';

	          $('.discussions').append(html);

	          //$(html).insertBefore();
	          
	          console.log(i);
	          //Date time picker
	          $('#discussion-date'+i).datetimepicker({
	            sideBySide: true,
	            format: 'DD-MM-YYYY hh:mm A'
	          });
	      }
	      
	    });

	    <?php if( !empty( $customer_dicussion ) ){
	      foreach ($customer_dicussion as $key => $dicussion) { ?>
	        $('#discussion-date<?php echo $key; ?>').datetimepicker({
	          sideBySide: true,
	          format: 'DD-MM-YYYY hh:mm A'
	        });
	        $('#discussion-date<?php echo $key; ?>').val('<?php echo date('d-m-Y h:i A', $dicussion['date'] ); ?>');
	    <?php } } ?>

	  })(jQuery);
	</script>

	<?php }else{ ?>
		<div class="alert alert-danger alert-dismissible">No customer available.</div>
	<?php }

	$html = ob_get_clean();

	wp_send_json_success(array(
		'html' => $html
	));	

}

// add_action( 'wp_ajax_check_phone_number', 'check_phone_number' );
// add_action( 'wp_ajax_nopriv_check_phone_number', 'check_phone_number' );
// function check_phone_number(){

// 	if ( ! wp_verify_nonce( $_POST['security'], 'security' ) ){
// 		wp_send_json_error(array(
// 			'message' => __('You can not perform this operation.','orolifestyle')
// 		));
// 	}

// 	$phone = $_POST['phone'];

// 	if( is_customer_mobile_exist( $phone ) ){
// 		wp_send_json_error(array(
// 			'message' => __('Customer already exist with this mobile number.','orolifestyle')
// 		));
// 	}

// 	wp_send_json_success();

// }

add_action( 'wp_ajax_send_email', 'send_email' );
add_action( 'wp_ajax_nopriv_send_email', 'send_email' );
function send_email(){

	$subject = get_option( 'email_subject_'.get_current_user_id() );
	$body    = get_option( 'email_template_'.get_current_user_id() );
	$from    = get_option( 'email_from_'.get_current_user_id() );

	if( $subject == '' || $body == '' || $from == '' ){
		wp_send_json_error(array(
			'message' => __('Please check your email settings. some settings are missing.','orolifestyle')
		));
	}

	if( $_POST['id'] == 'all' ){

		$customers_args = array(
		    'post_type' 	 => 'customers',
		    'posts_per_page' => -1
		);              

		if( current_user_can('sales') ){
			$customers_args['author'] = get_current_user_id();
		}

		$customers = new WP_Query( $customers_args );

		$customers_id = array();

		if( $customers->have_posts() ) : while ( $customers->have_posts() ) : $customers->the_post(); 
			$customers_id[] = get_the_ID();
		endwhile; wp_reset_postdata(); else: endif;

		if( !empty( $customers_id ) ){
			if( send_email_to_customer( $customers_id ) ){
				wp_send_json_success(array(
					'message' => __('Email sent successfully.','orolifestyle')
				));
			}else{
				wp_send_json_error(array(
					'message' => __('Email not sent. Something went wrong. Please try later.','orolifestyle')
				));
			}
		}else{
			wp_send_json_error(array(
				'message' => __('Email not sent. Because you dont\'t have any customers.','orolifestyle')
			));
		}
	}

	if( send_email_to_customer( $_POST['id'] ) ){
		wp_send_json_success(array(
			'message' => __('Email sent successfully.','orolifestyle')
		));
	}else{
		wp_send_json_error(array(
			'message' => __('Email not sent. Something went wrong. Please try later.','orolifestyle')
		));
	}
		
}

function send_email_to_customer( $customers_id ){

	add_filter( 'wp_mail_content_type', 'orolifestyle_set_html_mail_content_type' );

	$to = array();
	if( is_array( $customers_id ) ){
		foreach ( $customers_id as $customer_id ) {
			if( get_post_meta( $customer_id, 'email', true ) != '' ){
				$to[] = get_post_meta( $customer_id, 'email', true );
			}
		}
	}else{
		if( get_post_meta( $customers_id, 'email', true ) != '' ){
			$to[] = get_post_meta( $customers_id, 'email', true );
		}
	}

	if( empty( $to ) ){
		wp_send_json_error(array(
			'message' => __('Please add an email address to the customers to send an email.','orolifestyle')
		));
	}

	$subject = get_option( 'email_subject_'.get_current_user_id() );
	$body    = get_option( 'email_template_'.get_current_user_id() );
	$from    = get_option( 'email_from_'.get_current_user_id() );

	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: '.get_bloginfo('name').' <'.$from.'>',
		'Reply-To: '.get_bloginfo('name').' <'.$from.'>'
	);
	
	foreach ($to as $email) {
		$mail_results = wp_mail( $email, $subject, $body, $headers );
	}

	remove_filter( 'wp_mail_content_type', 'orolifestyle_set_html_mail_content_type' );

	if( $mail_results ){
		return true;
	}

	return false;

}

add_action( 'wp_ajax_save_email_template', 'save_email_template' );
add_action( 'wp_ajax_nopriv_save_email_template', 'save_email_template' );
function save_email_template(){

	parse_str($_POST['data'], $data);
	
	delete_option( 'email_template_'.get_current_user_id() );
	delete_option( 'email_subject_'.get_current_user_id() );
	delete_option( 'email_from_'.get_current_user_id() );
	
	if( 
		update_option( 'email_template_'.get_current_user_id(), $data['email_template'] ) && 
		update_option( 'email_subject_'.get_current_user_id(), $data['email_subject'] ) && 
		update_option( 'email_from_'.get_current_user_id(), $data['email_from'] ) 
	){
		wp_send_json_success(array(
			'message' => __('Email settings save successfully','orolifestyle')
		));
	}else{
		wp_send_json_error(array(
			'message' => __('Email settings not saved. Something went wrong.','orolifestyle')
		));
	}
}

add_action( 'wp_ajax_get_all_customers', 'get_all_customers' );
add_action( 'wp_ajax_nopriv_get_all_customers', 'get_all_customers' );
function get_all_customers(){
	
	$meta_query = array( 'relation' => 'AND' );
	$author 	= get_current_user_id();

	if( current_user_can('administrator') ){
		$author = $_REQUEST['author'] != '' ? $_REQUEST['author'] : '' ;
	}

	if( isset( $_REQUEST['status'] ) && $_REQUEST['status'] != '' ){
		$meta_query[] = array(
			'key'     => 'status',
            'value'   => $_REQUEST['status'],
            'compare' => '=',
		);
	}

	if( isset( $_REQUEST['search']['value'] ) && $_REQUEST['search']['value'] != '' ){
		
		$meta_query[] = array(
			'relation' => 'OR',
			array(
				'key'     => 'first_name',
	            'value'   => $_REQUEST['search']['value'],
	            'compare' => 'LIKE',
	        ),array(
				'key'     => 'last_name',
	            'value'   => $_REQUEST['search']['value'],
	            'compare' => 'LIKE',
	        ),
	        array(
				'key'     => 'primary_number',
	            'value'   => $_REQUEST['search']['value'],
	            'compare' => 'LIKE',
	        ),
	        array(
				'key'     => 'email',
	            'value'   => $_REQUEST['search']['value'],
	            'compare' => 'LIKE',
	        )

		);
	}

	if( isset( $_REQUEST['time'] ) && $_REQUEST['time'] != '' ){
		
		if( $_REQUEST['time'] == 'present' ){
            $meta_query[] = array(
	            'key'       => 'follow_up_date',
	            'value'     => strtotime( date( 'Y-m-d 00:00:00', current_time( 'timestamp', 0 ) ) ),
	            'compare'   => '>='
	        );
	        $meta_query[] = array(
	            'key'       => 'follow_up_date',
	            'value'     => strtotime( date( 'Y-m-d 23:59:59', current_time( 'timestamp', 0 ) ) ),
	            'compare'   => '<='
	        );
		}

		if( $_REQUEST['time'] == 'past' ){
	        $meta_query[] = array(
	            'key'       => 'follow_up_date',
	            'value'     => strtotime( date( 'Y-m-d 00:00:00', current_time( 'timestamp', 0 ) ) ),
	            'compare'   => '<'
	        );
		}

	}

	$customers_args = array(
	    'post_type' 	 => 'customers',
	    'author'  		 => $author,
	    'posts_per_page' => isset( $_REQUEST["length"] ) ? $_REQUEST["length"] : 10,
	    'offset' 		 => isset( $_REQUEST["start"] ) ? $_REQUEST["start"] : 10,
	    'meta_query' 	 => $meta_query
	);              
	$customers = new WP_Query( $customers_args );

	$data = array();

	if( $customers->have_posts() ) : while ( $customers->have_posts() ) : $customers->the_post(); 

		$html = '<a class="mb-2 btn btn-info btn-xs edit-customer" href="#" data-id="'.get_the_ID().'">
		           	<i class="fas fa-pencil-alt"></i> Edit
		        </a>
		        <a class="mb-2 btn btn-danger btn-xs delete-customer" href="#" data-id="'.get_the_ID().'">
		            <i class="fas fa-trash"></i> Delete
		        </a>
		        <a class="mb-2 btn btn-secondary btn-xs view-discussions" href="#" data-id="'.get_the_ID().'">
		            <i class="fas fa-eye"></i> View Discussions
		        </a>
		        <button type="button" class="mb-2 btn btn-primary btn-xs send-email-single" data-id="'.get_the_ID().'">
		            Send Email
		        </button>';

		if( get_post_meta( get_the_ID(), 'priority', true ) == 'high' ){
			$priority = '<span class="badge badge-danger">'.ucfirst(get_post_meta( get_the_ID(), 'priority', true )).'</span>';
		}elseif( get_post_meta( get_the_ID(), 'priority', true ) == 'medium' ){
			$priority = '<span class="badge badge-primary">'.ucfirst(get_post_meta( get_the_ID(), 'priority', true )).'</span>';
		}else{
			$priority = '<span class="badge badge-warning">'.ucfirst(get_post_meta( get_the_ID(), 'priority', true )).'</span>';
		}

		if( get_post_meta( get_the_ID(), 'status', true ) == 'pending' ){
			$status = '<span class="badge badge-warning">'.ucfirst(get_post_meta( get_the_ID(), 'status', true )).'</span>';
		}else{
			$status = '<span class="badge badge-success">'.ucfirst(get_post_meta( get_the_ID(), 'status', true )).'</span>';
		}

		$follow_up_progress = '<div class="progress progress-sm">
	                              <div class="progress-bar bg-green" role="progressbar" aria-volumenow="'.get_follow_up_progress( get_the_ID() ).'" aria-volumemin="0" aria-volumemax="100" style="width: '.get_follow_up_progress( get_the_ID() ).'%">
	                              </div>
	                          </div>
	                          <small>
	                              '.get_follow_up_progress( get_the_ID() ).'% Complete
	                          </small>';

		$data[] = array(
			'<input type="checkbox" name="customer_id" value="'.get_the_ID().'" id="customer_id_checkbox">',
			get_the_title(),
			get_post_meta( get_the_ID(), 'email', true ),
			get_post_meta( get_the_ID(), 'primary_number', true ),
			get_post_meta( get_the_ID(), 'follow_up_date', true ) != '' ? date( 'd-m-Y h:i A', get_post_meta( get_the_ID(), 'follow_up_date', true ) ) : 'N/A' ,
			get_the_author_meta('display_name', get_post_field( 'post_author', get_the_ID() ) ),
			$follow_up_progress,
			$priority,
			$status,
			$html
		);

	endwhile; wp_reset_postdata(); else: endif;

    wp_send_json( array(
        "draw"            => (isset($_REQUEST["draw"]) ? $_REQUEST["draw"] : 0),  
        "recordsTotal"    => $customers->found_posts,
        "recordsFiltered" => $customers->found_posts,
        "data"            => $data
    ) );

}

function get_follow_up_progress( $customer_id ){

	$max_progress   = 7;
	$total_progress = get_post_meta( $customer_id, 'discussions', true ) != '' ? count( get_post_meta( $customer_id, 'discussions', true ) ) : 0 ;
	$percentage     = ( $total_progress / $max_progress ) * 100;
	$percentage     = floor( $percentage );

	return $percentage;
}

function get_total_customers(){

	$author = get_current_user_id();

	if( current_user_can('administrator') ){
		$author = '';
	}

	$customers_args = array(
	    'post_type' 	 => 'customers',
	    'post_status'    => 'publish',
	    'author'  		 => $author,
	    'posts_per_page' => -1,
	);              
	$customers = new WP_Query( $customers_args );

	return $customers->found_posts;
}

function get_todays_customers(){

	$author = get_current_user_id();

	if( current_user_can('administrator') ){
		$author = '';
	}

	$meta_query = array( 'relation' => 'AND' );
	$meta_query[] = array(
        'key'       => 'follow_up_date',
        'value'     => strtotime( date( 'Y-m-d 00:00:00', current_time( 'timestamp', 0 ) ) ),
        'compare'   => '>='
    );
    $meta_query[] = array(
        'key'       => 'follow_up_date',
        'value'     => strtotime( date( 'Y-m-d 23:59:59', current_time( 'timestamp', 0 ) ) ),
        'compare'   => '<='
    );
    $meta_query[] = array(
        'key'       => 'status',
        'value'     => 'pending',
        'compare'   => '='
    );

	$customers_args = array(
	    'post_type' 	 => 'customers',
	    'post_status'    => 'publish',
	    'author'  		 => $author,
	    'posts_per_page' => -1,
	    'meta_query'     => $meta_query
	);              
	$customers = new WP_Query( $customers_args );

	return $customers->found_posts;
}

function get_forget_customers(){

	$author = get_current_user_id();

	if( current_user_can('administrator') ){
		$author = '';
	}

	$meta_query = array( 'relation' => 'AND' );
	$meta_query[] = array(
        'key'       => 'follow_up_date',
        'value'     => strtotime( date( 'Y-m-d 00:00:00', current_time( 'timestamp', 0 ) ) ),
        'compare'   => '<'
    );
    $meta_query[] = array(
        'key'       => 'status',
        'value'     => 'pending',
        'compare'   => '='
    );


	$customers_args = array(
	    'post_type' 	 => 'customers',
	    'post_status'    => 'publish',
	    'author'  		 => $author,
	    'posts_per_page' => -1,
	    'meta_query'     => $meta_query
	);              
	$customers = new WP_Query( $customers_args );

	return $customers->found_posts;
}

function get_complete_customers(){
	
	$author = get_current_user_id();

	if( current_user_can('administrator') ){
		$author = '';
	}

	$meta_query = array( 'relation' => 'AND' );
	$meta_query[] = array(
		'key'     => 'status',
        'value'   => 'complete',
        'compare' => '=',
	);

	$customers_args = array(
	    'post_type' 	 => 'customers',
	    'post_status'    => 'publish',
	    'author'  		 => $author,
	    'posts_per_page' => -1,
	    'meta_query'     => $meta_query
	);              
	$customers = new WP_Query( $customers_args );

	return $customers->found_posts;

}
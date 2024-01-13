<?php
// echo get_template_directory_uri();      // http://wordpress_project.test/wp-content/themes/mythemeproject
define('THEME_DIRECTORY_URL', get_template_directory_uri());
define('THEME_IMAGES_DIRECTORY_URL', get_template_directory_uri() . '/images');
define('THEME_FILES_DIRECTORY_URL', get_template_directory_uri() . '/files');
define('THEME_DEFAULT_IMAGE_DIRECTORY_URL', THEME_FILES_DIRECTORY_URL . '/uploads/2014/01/shutterstock_111362132-620x350.jpg');
define('THEME_CSS_DIRECTORY_URL', get_template_directory_uri() . '/css');
define('THEME_JS_DIRECTORY_URL', get_template_directory_uri() . '/js');
define('THEME_INCLUDES_URL', get_template_directory_uri() . '/includes');
define('THEME_INCLUDES_JS_URL', THEME_INCLUDES_URL . '/customize/controls/js');

define('THEME_DIRECTORY', get_template_directory());
define('THEME_INCLUDES_DIRECTORY', get_template_directory() . '/includes');
define('THEME_SUPPORT_DIRECTORY', get_template_directory() . '/includes/support');
define('THEME_SIDEBARS_DIRECTORY', THEME_INCLUDES_DIRECTORY . '/sidebars');
define('THEME_INCLUDES_JS_DIRECTORY', THEME_INCLUDES_DIRECTORY . '/customize/controls/js');

define('THEME_WIDGETS_DIRECTORY', THEME_INCLUDES_DIRECTORY . '/widgets');

/*******************************************************************************************************
 1. Add css files to Theme
 *******************************************************************************************************/

add_action('wp_enqueue_scripts', 'mythemeproject_theme_register_style');
function mythemeproject_theme_register_style()
{
	global $wp_styles;

	$cssFiles = [
		'symple_shortcodes_styles_css'  => 'symple_shortcodes_styles.css',
		'style_css'                     => 'style.css',
		'responsive_css'                => 'responsive.css',
		'site_css'                      => 'site.css',
		'customize_css'                 => 'customize.css',     // them css nay de sau nay co thay doi css thi o day
	];
	foreach ($cssFiles as $key => $cssFile) {
		wp_register_style(
			'mythemeproject_theme_' . $key,
			THEME_CSS_DIRECTORY_URL . "/$cssFile",
			[],
			false,
			'all'
		);
		wp_enqueue_style('mythemeproject_theme_' . $key);
	}

	wp_register_style(
		'mythemeproject_theme_ie8',
		THEME_CSS_DIRECTORY_URL . "/ie8.css",
		[],
		false,
		'screen'
	);
	$wp_styles->add_data('mythemeproject_theme_ie8', 'conditional', 'IE 8');
	wp_enqueue_style('mythemeproject_theme_ie8');
}

/*******************************************************************************************************
 2. Add JS files to Theme
 *******************************************************************************************************/

add_action('wp_enqueue_scripts', 'mythemeproject_theme_register_script');
function mythemeproject_theme_register_script()
{
	$jsFiles = [
		'jquery_form_min_js'        => 'jquery.form.min.js',
		'scripts_js'                => 'scripts.js',
		'plugins_js'                => 'plugins.js',
		'global_js'                 => 'global.js',
	];

	foreach ($jsFiles as $key => $jsFile) {
		wp_register_script(
			'mythemeproject_theme_' . $key,
			THEME_JS_DIRECTORY_URL . "/$jsFile",
			[],
			false,
			['in_footer' => true]
		);
		wp_enqueue_script('mythemeproject_theme_' . $key);
	}

	// jquery va jquery-migrate o phan header. 
	// Vi version khac nhau nen jquery-migrate.min.js cua theme va core wordpress co khac nhau, 
	// dan den slider ko chay. Do vay ta bat buoc load file nay tu theme ra

	wp_register_script(
		'mythemeproject_theme_jquery_js',
		THEME_JS_DIRECTORY_URL . "/jquery/jquery.js"
	);
	wp_enqueue_script('mythemeproject_theme_jquery_js');

	wp_register_script(
		'mythemeproject_theme_jquery_migrate',
		THEME_JS_DIRECTORY_URL . "/jquery/jquery-migrate.min.js"
	);
	wp_enqueue_script('mythemeproject_theme_jquery_migrate');

	if (is_singular() && comments_open()) {
		// wp_enqueue_script('comment-reply');

		wp_register_script(
			'mythemeproject_theme_comment_reply',
			THEME_JS_DIRECTORY_URL . "/comment-reply.min.js",
			'',
			false,
			true
		);
		wp_enqueue_script('mythemeproject_theme_comment_reply');
	}

	if ( is_page() ) {
		wp_enqueue_script( 'password-strength-meter-mediator', THEME_JS_DIRECTORY_URL . '/password_meter.js', 
			array('password-strength-meter', 'jquery'), false, true);
	}
}

add_action('wp_footer', 'mythemeproject_theme_add_scripts');
function mythemeproject_theme_add_scripts()
{
	echo '
        <script type=\'text/javascript\'>         
            var wpexLocalize = {
                "mobileMenuOpen" : "Browse Categories",
                "mobileMenuClosed" : "Close navigation",
                "homeSlideshow" : "false",
                "homeSlideshowSpeed" : "7000",
                "UsernamePlaceholder" : "Username",
                "PasswordPlaceholder" : "Password",
                "enableFitvids" : "true"
            };
        </script>';
}

/*******************************************************************************************************
 3. Setup Widgets to Theme
 *******************************************************************************************************/

add_action('widgets_init', 'mythemeproject_theme_widgets_init');
function mythemeproject_theme_widgets_init()
{
	// khai bao vung quan ly widgets cua Theme danh cho sidebar
	register_sidebar([
		'name'           => __('Primary widget area', 'wordpress_project'),
		'id'             => "primary_widget_area",
		'description'    => __('Primary area for sidebar widgets of my_theme_project', 'wordpress_project'),
		'class'          => '',
		'before_widget'  => '<div id="%1$s" class="sidebar-widget %2$s clr">',
		'after_widget'   => "</div>\n",
		'before_title'   => '<span class="widget-title">',
		'after_title'    => "</span>\n",
		'before_sidebar' => '',
		'after_sidebar'  => '',
		'show_in_rest'   => false,
	]);

	// khai bao vung quan ly widgets cua Theme danh cho top_content
	register_sidebar([
		'name'           => __('Top Content widget area', 'wordpress_project'),
		'id'             => "top_content_widget_area",
		'description'    => __('Area for Top Content widget of my_theme_project', 'wordpress_project'),
		'class'          => '',
		'before_widget'  => '',						// '<div id="%1$s" class="%2$s clr">',
		'after_widget'   => '',						// "</div>\n",
		'before_title'   => '',
		'after_title'    => "",
		'before_sidebar' => '',
		'after_sidebar'  => '',
		'show_in_rest'   => false,
	]);

	// khai bao vung quan ly widgets cua Theme danh cho bottom_content
	register_sidebar([
		'name'           => __('Bottom Content widget area', 'wordpress_project'),
		'id'             => "bottom_content_widget_area",
		'description'    => __('Area for Bottom Content widget of my_theme_project', 'wordpress_project'),
		'class'          => '',
		'before_widget'  => '',						// '<div id="%1$s" class="%2$s clr">',
		'after_widget'   => '',						// "</div>\n",
		'before_title'   => '',
		'after_title'    => "",
		'before_sidebar' => '',
		'after_sidebar'  => '',
		'show_in_rest'   => false,
	]);

	// khai bao vung quan ly widgets cua Theme danh cho Before Footer 1
	register_sidebar([
		'name'           => __('Before Footer widget area 1', 'wordpress_project'),
		'id'             => "before_footer_widget_area_1",
		'description'    => __('Area 1 in Footer of my_theme_project', 'wordpress_project'),
		'class'          => '',
		'before_widget'  => '<div id="%1$s" class="footer-widget %2$s clr">',
		'after_widget'   => "</div>\n",
		'before_title'   => '<span class="widget-title">',
		'after_title'    => "</span>\n",
		'before_sidebar' => '',
		'after_sidebar'  => '',
		'show_in_rest'   => false,
	]);

	// khai bao vung quan ly widgets cua Theme danh cho Before Footer 2
	register_sidebar([
		'name'           => __('Before Footer widget area 2', 'wordpress_project'),
		'id'             => "before_footer_widget_area_2",
		'description'    => __('Area 2 in Footer of my_theme_project', 'wordpress_project'),
		'class'          => '',
		'before_widget'  => '<div id="%1$s" class="footer-widget %2$s clr">',
		'after_widget'   => "</div>\n",
		'before_title'   => '<span class="widget-title">',
		'after_title'    => "</span>\n",
		'before_sidebar' => '',
		'after_sidebar'  => '',
		'show_in_rest'   => false,
	]);

	// khai bao vung quan ly widgets cua Theme danh cho Before Footer 3
	register_sidebar([
		'name'           => __('Before Footer widget area 3', 'wordpress_project'),
		'id'             => "before_footer_widget_area_3",
		'description'    => __('Area 3 in Footer of my_theme_project', 'wordpress_project'),
		'class'          => '',
		'before_widget'  => '<div id="%1$s" class="footer-widget %2$s clr">',
		'after_widget'   => "</div>\n",
		'before_title'   => '<span class="widget-title">',
		'after_title'    => "</span>\n",
		'before_sidebar' => '',
		'after_sidebar'  => '',
		'show_in_rest'   => false,
	]);

	// khai bao vung quan ly widgets cua Theme danh cho Before Footer 4
	register_sidebar([
		'name'           => __('Before Footer widget area 4', 'wordpress_project'),
		'id'             => "before_footer_widget_area_4",
		'description'    => __('Area 4 in Footer of my_theme_project', 'wordpress_project'),
		'class'          => '',
		'before_widget'  => '<div id="%1$s" class="footer-widget %2$s clr">',
		'after_widget'   => "</div>\n",
		'before_title'   => '<span class="widget-title">',
		'after_title'    => "</span>\n",
		'before_sidebar' => '',
		'after_sidebar'  => '',
		'show_in_rest'   => false,
	]);
}


// Setup the Widgets
require_once THEME_WIDGETS_DIRECTORY . '/main.php';
new MyThemeProject_Theme_Widgets_Main();


/*******************************************************************************************************
 4. Setup Theme's supports
 *******************************************************************************************************/
add_action('after_setup_theme', 'mythemeproject_theme_postFormat_thumbnail');
function mythemeproject_theme_postFormat_thumbnail()
{
	// them chuc nang post format
	add_theme_support('post-formats', ['gallery', 'audio', 'video']);	// standard la default, ko can dua vao list

	// them chuc nang feature image
	add_theme_support('post-thumbnails');
}


/*******************************************************************************************************
 5. Setup Theme's Menus Area
 *******************************************************************************************************/
add_action('init', 'mythemeproject_theme_register_menus');
function mythemeproject_theme_register_menus()
{
	register_nav_menus([
		'top_menu'		=> __('Top Menu', 'wordpress_project'),
		'center_menu' 	=> __('Center Menu', 'wordpress_project'),
		'footer_menu' 	=> __('Footer Menu', 'wordpress_project'),
	]);
}

/*******************************************************************************************************
 6. Theme Menu: modify the <a> tag
 *******************************************************************************************************/
add_filter('walker_nav_menu_start_el', 'mythemeproject_theme_menu_modify_aLink', 10, 4);
function mythemeproject_theme_menu_modify_aLink($item_output, $menu_item, $depth, $args)
{
	// hook nay lam viec voi tat ca menus trong theme
	// kiem tra menu la top_menu
	if ($args->theme_location == 'top_menu') {

		// kiem tra xem 1 <a> tag la parent va co children ?  => Features
		$itemClasses = $menu_item->classes;
		if (in_array('menu-item-has-children', $itemClasses) && $menu_item->menu_item_parent == '0') {
			// echo '<pre>';
			// print_r($menu_item);		// chi in ra thong tin cua <a> tag cua Features ma thoi
			// echo $item_output;		// <a href="#">Features</a>
			$item_output = str_replace('</a>', '<i class="fa fa-caret-down nav-arrow"></i></a>', $item_output);
		}

		// modify the <a> cho Login de them icon key va them link login/logout
		if ($menu_item->post_title == 'Login') {
			// echo '<pre>';
			// print_r($menu_item);	// chi co 1 the li cua Login ma thoi

			if (!is_user_logged_in()) {

				// gan link login vao href
				// $loginUrl = home_url('/login-register/');
				$loginUrl = 'href="' . wp_login_url() . '"';
				// <a href="#" class="nav-loginout-link">
				$item_output = preg_replace('/href=\"(.*)\"/', $loginUrl, $item_output);

				// them icon key vao truoc Login
				$item_output = str_replace('Login', '<span class="fa fa-lock"></span> Login', $item_output);

				// kiem tra user login 
			} else {
				// gan link logout vao href		
				$logoutUrl = 'href="' . wp_logout_url() . '"';
				// <a href="#" class="nav-loginout-link">
				$item_output = preg_replace('/href=\"(.*)\"/', $logoutUrl, $item_output);

				// thay the Login bang Logout + icon
				$item_output = str_replace('Login', '<span class="fa fa-lock"></span> Logout', $item_output);
			}
		}
	}

	return $item_output;
}

/*******************************************************************************************************
 7. Theme Menu: modify css class cua the <li>
 *******************************************************************************************************/
add_filter('nav_menu_css_class', 'mythemeproject_theme_menu_modify_css_liTags', 10, 4);
function mythemeproject_theme_menu_modify_css_liTags($classes, $menu_item, $args, $depth)
{
	// hook nay lam viec voi tat ca menus trong theme
	// kiem tra menu la top_menu
	if ($args->theme_location == 'top_menu') {

		// kiem tra xem 1 <a> tag la parent va co children ?  => Features
		$itemClasses = $menu_item->classes;
		if (in_array('menu-item-has-children', $itemClasses) && $menu_item->menu_item_parent == '0') {
			// echo '<pre>';
			// print_r($classes);		// array chua tat ca classes cua <li> Features </li> 

			$classes[] = 'dropdown';
		}
	}

	// kiem tra menu la top_menu de them background css class cho <li> tags
	if ($args->theme_location == 'center_menu') {
		// echo '<pre>';
		// print_r($menu_item);
		$bg_css_class = [
			'Sports'			=> 'menu-item-object-category cat-28 bg_cat_' . $menu_item->object_id,
			'Photography'		=> 'menu-item-object-category cat-5 bg_cat_' . $menu_item->object_id,
			'Travel'			=> 'menu-item-object-category cat-6 bg_cat_' . $menu_item->object_id,
			'Shopping'			=> 'menu-item-object-category cat-3 bg_cat_' . $menu_item->object_id,
			'Nature'			=> 'menu-item-object-category cat-4 bg_cat_' . $menu_item->object_id,
			'News'				=> 'menu-item-object-category cat-27 bg_cat_' . $menu_item->object_id,
			'Videos'			=> 'menu-item-object-category cat-2 bg_cat_' . $menu_item->object_id,
			'Health'			=> 'menu-item-object-category cat-26 bg_cat_' . $menu_item->object_id,
		];

		foreach ($bg_css_class as $cat => $class) {
			if (strtolower($menu_item->title) == strtolower($cat)) {
				$classes[] = $class;
			}
		}
	}

	return $classes;
}


/*******************************************************************************************************
 8. Theme Customize: register and setup the customize of control, options
 *******************************************************************************************************/

// define a class Category ListBox
// if (file_exists(THEME_INCLUDES_DIRECTORY. '/customize/selectMulti.php')) {
// 	require THEME_INCLUDES_DIRECTORY. '/customize/selectMulti.php';
// }

// execute the Control Customize for learning
// if (file_exists(THEME_INCLUDES_DIRECTORY.'/customize/customize.php')) {
// 	require THEME_INCLUDES_DIRECTORY.'/customize/customize.php';
// 	new MyThemeProject_Theme_Customize();
// }

// execute the Control Customize
if (file_exists(THEME_INCLUDES_DIRECTORY . '/customize/customize_control.php')) {
	require THEME_INCLUDES_DIRECTORY . '/customize/customize_control.php';
	new MyThemeProject_Theme_Customize_Control();
}



/*******************************************************************************************************
 9. Theme Pages: add supports for Theme
 *******************************************************************************************************/
// Image handler
if (file_exists(THEME_INCLUDES_DIRECTORY . '/support/image.php')) {
	require THEME_INCLUDES_DIRECTORY . '/support/image.php';
	global $mtp_image_support;
	$mtp_image_support = new MyThemeProject_Image_Support();
}

// Content text handler
if (file_exists(THEME_INCLUDES_DIRECTORY . '/support/content.php')) {
	require THEME_INCLUDES_DIRECTORY . '/support/content.php';
	global $mtp_content_support;
	$mtp_content_support = new MyThemeProject_Content_Support();
}


/*******************************************************************************************************
 10. Comments: function to customize the post comment HTML
 *******************************************************************************************************/
function mythemeproject_comments($comment, $args, $depth)
{
	global $post;	// global $wp_query co gia tri, thi global $post cung vay
	global $wp_query;
	// echo '<pre>';
	// print_r($comment);
	// print_r($args);
	// print_r($depth);
	// print_r($post);

	$post_author_ID = $wp_query->posts[0]->post_author;		// $post->post_author;


	if ($comment->comment_type == '' || $comment->comment_type == 'comment') { ?>
		<li id="li-comment-<?php comment_ID() ?>">
			<article <?php comment_class('clr') ?> id="comment-<?php comment_ID() ?> ">
				<div class="comment-author vcard">
					<?= get_avatar($comment, 60, '', 'user avatar in comment'); ?>
				</div>
				<!-- .comment-author -->
				<div class="comment-details clr ">
					<header class="comment-meta">
						<cite class="fn">
							<?php
							echo get_comment_author_link();

							if ($comment->user_id == $post_author_ID)
								echo '<span class="author-badge">Author</span>';
							?>
						</cite>
						<span class="comment-date">
							<a href="<?php comment_link() ?>">
								<time datetime="2014-03-01T02:08:22+00:00"><?php comment_date() ?></time>
							</a> at <?php comment_time() ?>
						</span>
						<!-- .comment-date -->
					</header>
					<!-- .comment-meta -->

					<div class="comment-content entry clr">
						<?php comment_text(); ?>
					</div>
					<!-- .comment-content -->

					<div class="reply comment-reply-link">
						<?php
						$reply_args = [
							'reply_text'	=> __('Reply to this message', 'mythemeproject'),
							'depth'			=> $depth,
							'max_depth'		=> $args['max_depth'],
						];
						comment_reply_link($reply_args);
						?>
					</div>
					<!-- .reply -->
				</div>
				<!-- .comment-details -->
			</article>
		</li>
<?php
	}
}
?>
<?php

/*******************************************************************************************************
 11. Shortcode: shortcode for Homepage
 *******************************************************************************************************/
add_shortcode('mythemeproject_homepage', 'mythemeproject_homepage_shortcode');
function mythemeproject_homepage_shortcode($attr)
{
	global $mtp_image_support;
	global $mtp_content_support;

	extract($attr);
	if (empty($cats) || empty($number)) return '';

	// arrays of category IDs
	$cats = explode(',', $cats);

	// initiate $output = container div tag
	$output = '<div class="home-cats clr">';

	// initiate the category number for calculating the col- number
	$cat_number = 1;

	// list the category and its posts
	foreach ($cats as $cat) {
		$cat = (int)(trim($cat));
		$col = ($cat_number % 2) ? 1 : 2;

		$query_args = [
			'post_type'			=> 'post',
			'posts_per_page'	=> (int)$number,
			'paged'				=> 1,
			'status'			=> 'publish',
			'ignore_sticky_posts'	=> true,
			'cat'				=> $cat,
			// 'category__in'		=> $cat, // chi lay trong category, ko lay trong child cua no
			// 'order'				=> 'DESC'	// default
		];
		$wpQuery = new WP_Query($query_args);

		$output .= '
			<div class="home-cat-entry clr col-' . $col . '">
				<h2 class="heading">
					<a href="' . get_category_link($cat) . '" title="' . get_cat_name($cat) . '">' . get_cat_name($cat) . '</a>
				</h2>
				<ul>';
		if ($wpQuery->have_posts()) :
			$post_number = 1;
			while ($wpQuery->have_posts()) :
				$wpQuery->the_post();
				$post_content = $wpQuery->post->post_content;
				$imageUrl = $mtp_image_support->handleImage($post_content, $wpQuery->post, 620, 350);
				$exe = get_the_excerpt($wpQuery->post->ID);
				$own_category = get_the_category()[0];		// [1], [2] ... are parent categories

				if ($post_number == 1) {
					$output .= '<li class="home-cat-entry-post-first clr">
						<div class="home-cat-entry-post-first-media clr">
							<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">
								<img src="' . $imageUrl . '" alt="' . get_the_title() . '" width="620" height="350" />
							</a>
							<div class="entry-cat-tag cat-' . $cat . '-bg">
								<a href="' . get_category_link($own_category->cat_ID) . '" title="' . $own_category->name . '">'
						. $own_category->name .
						'</a>
							</div>
							<!-- .entry-cat-tag -->
						</div>
						<h3 class="home-cat-entry-post-first-title">
							<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">'
						. $mtp_content_support->getExcerpt(get_the_title(), 25) .
						'</a>
						</h3>
						<p>' . $mtp_content_support->getExcerpt(get_the_excerpt(), 120) . '</p>
					</li>';
				} else {
					$output .= '<li class="home-cat-entry-post-other clr">
						<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">'
						. $mtp_content_support->getExcerpt(get_the_title(), 25) .
						'</a>
					</li>';
				}

				$post_number++;
			endwhile;
		endif;

		$output .= '
				</ul>
			</div>
		';

		$cat_number++;
	}

	$output .= '</div>';
	return $output;
}

/*******************************************************************************************************
 12. Login: Redirect after logged in
 *******************************************************************************************************/
add_filter('login_redirect', 'my_login_redirect', 10, 3);
function my_login_redirect($redirect_to, $request, $user)
{
	// echo '<pre>';
	// print_r($redirect_to);		// http://wordpress_project.test/login/
	// print_r($request);				// http://wordpress_project.test/login/
	// print_r($user);
	// die;
	//is there a user to check?
	global $user;

	if (isset($user->roles) && is_array($user->roles)) {
		//check for admins
		if (in_array('administrator', $user->roles)) {
			return admin_url();
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}

/*******************************************************************************************************/
// bạn cần phải cho vào file functions.php trong theme trong đoạn code sau để cấu hình lại file /wp-login.php:
add_action('init', 'redirect_login_page');
function redirect_login_page()
{
	$login_page  = home_url('/login-register/');
	$page_viewed = basename($_SERVER['REQUEST_URI']);

	// http://wordpress_project.test/wp-login.php?loggedout=true&wp_lang=en_US
	// echo 'login page: ' . $login_page;		//  login page: http://wordpress_project.test/login/
	// echo '<br>';
	// echo 'Viewed page: ' . $page_viewed;		//  Viewed page: wp-login.php?loggedout=true&wp_lang=en_US
	// echo '<br>';
	// echo $_SERVER['REQUEST_METHOD'];			// GET

	if ( ($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET' ) 
		|| str_contains($page_viewed, 'wp-login.php?loggedout=true') )
	{
		wp_redirect($login_page);
		exit;
	}
}

/*******************************************************************************************************/
// Đó là nếu thông tin đăng nhập sai, bạn sẽ bị đưa về file wp-login.php cùng với thông báo lỗi.
// Để khắc phục, bạn cần đưa đoạn code dưới đây vào file functions.php để thông báo lỗi được hiển thị ngay trên trang đăng nhập:

add_action('wp_login_failed', 'login_failed', 10, 2);
function login_failed($username, $error)
{
	// echo '<pre>';
	// print_r($username);	// gia tri input trong field username
	// print_r($error);   	// $error->errors['invalid_username'][0]
	$response = !empty($error->errors['invalid_username']) ? ($error->errors['invalid_username'][0]) : 
				(!empty($error->errors['incorrect_password']) ? ($error->errors['incorrect_password'][0]) : ''); 
	$error_key = '';

	if (str_contains($response, 'username')) $error_key = 'username';
	if (str_contains($response, 'password')) $error_key = 'password';

	// $login_page  = home_url('/login/');
	$login_page  = home_url('/login-register/');

	wp_redirect($login_page . '?login=failed-' . $error_key);

	exit;
	// Error : The username fzsdfs is not registered on this site. If you are unsure of your username, try your email address instead.
	// Error : The password you entered for the username TrongVU is incorrect.
}


add_filter('authenticate', 'verify_username_password', 11, 3);
function verify_username_password($user, $username, $password)
{	
	// $login_page  = home_url('/login/');
	$login_page  = home_url('/login-register/');

	if (!empty($_POST['wp-submit'])) {

		if ( $username == "" && $password == "" ) {
			wp_redirect($login_page . "?login=empty-all");
			exit;

		} else if ( $username == "" ) {
			wp_redirect($login_page . "?login=empty-username");
			exit;

		} else if ( $password == "" ) {
			wp_redirect($login_page . "?login=empty-password");
			exit;
		}
	} else {
		wp_redirect($login_page);
		exit;
	}
}

/*******************************************************************************************************
 13. Custom register email
 *******************************************************************************************************/
add_filter( 'wp_new_user_notification_email', 'custom_wp_new_user_notification_email', 10, 3 );
function custom_wp_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {

	$user_login = stripslashes( $user->user_login );
	$user_email = stripslashes( $user->user_email );
	$login_url	= wp_login_url();
	
	$message = "Hi <strong style='font-size:14px'>$user_login</strong>, <br /><br />
				Welcome to <strong style='font-size:14px'>".get_option('blogname')."</strong>.<br /><br />
				Here's how to log in: <a href='".wp_login_url()."'>".wp_login_url()."</a><br />
				Username: $user_login <br />
				Email: $user_email <br />
				Password: The one you entered in the registration form. (For security reason, we save encripted password).<br /><br />
				If you have any problems, please contact me at " . get_option('admin_email') .".<br /><br />
				Regard.
	";

	$wp_new_user_notification_email['subject'] = sprintf( '[%s] Your credentials.', $blogname );
	$wp_new_user_notification_email['headers'] = array('Content-Type: text/html; charset=UTF-8');
	$wp_new_user_notification_email['message'] = $message;

	return $wp_new_user_notification_email;
}

	// $message  = __( 'Hi there,' ) . "\r\n\r\n";
	// $message .= sprintf( __( "Welcome to %s! Here's how to log in:" ), get_option('blogname') ) . "\r\n\r\n";
	// $message .= wp_login_url() . "\r\n";
	// $message .= sprintf( __('Username: %s'), $user_login ) . "\r\n";
	// $message .= sprintf( __('Email: %s'), $user_email ) . "\r\n";
	// $message .= __( 'Password: The one you entered in the registration form. (For security reason, we save encripted password)' ) . "\r\n\r\n";
	// $message .= sprintf( __('If you have any problems, please contact me at %s.'), get_option('admin_email') ) . "\r\n\r\n";
	// $message .= __( 'Regard.' );


// Redefine user notification function
function new_user_notification( $user_id, $plaintext_pass = '' ) {
	$user = new WP_User($user_id);

	$user_login = stripslashes($user->user_login);
	$user_email = stripslashes($user->user_email);

	$message  = sprintf(__('New user registration on your blog %s:'), get_option('blogname')) . "rnrn";
	$message .= sprintf(__('Username: %s'), $user_login) . "rnrn";
	$message .= sprintf(__('E-mail: %s'), $user_email) . "rn";

	@wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), get_option('blogname')), $message);

	if ( empty($plaintext_pass) )
		return;

	$message  = __('Hi there,') . "rnrn";
	$message .= sprintf(__("Welcome to %s! Here's how to log in:"), get_option('blogname')) . "rnrn";
	$message .= wp_login_url() . "rn";
	$message .= sprintf(__('Username: %s'), $user_login) . "rn";
	$message .= sprintf(__('Password: %s'), $plaintext_pass) . "rnrn";
	$message .= sprintf(__('If you have any problems, please contact me at %s.'), get_option('admin_email')) . "rnrn";
	$message .= __('Adios!');

	wp_mail($user_email, sprintf(__('[%s] Your username and password'), get_option('blogname')), $message);
}

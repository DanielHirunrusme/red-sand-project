<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function rsp_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => 'primary',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

add_filter( 'nav_menu_link_attributes', 'rsp_menu_atts', 10, 3 );
function rsp_menu_atts( $atts, $item, $args )
{
	$page = $item->type != 'post_type_archive' ? strtolower($item->title) : strtolower($item->object);
	$atts['data-page'] = $page;
	return $atts;
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!
		
        wp_register_script('jquery_321', get_template_directory_uri() . '/js/lib/jquery-3.2.1.min.js', array(), '3.2.1'); // jQuery
        wp_enqueue_script('jquery_321'); // Enqueue it!
		
        wp_register_script('rspvendorscripts', get_template_directory_uri() . '/assets/vendor.min.js', array('jquery_321'), '1.0.0'); // Custom scripts
        wp_enqueue_script('rspvendorscripts'); // Enqueue it!

        wp_register_script('rspscripts', get_template_directory_uri() . '/assets/main.min.js', array('jquery_321'), '1.0.0'); // Custom scripts
        wp_enqueue_script('rspscripts'); // Enqueue it!
		
		rsp_enqueue_scripts();
    }
}


function wpdocs_dequeue_script() {
        wp_dequeue_script( 'jquery' ); 
} 
add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!

    wp_register_style('rsp_css', get_template_directory_uri() . '/assets/main.min.css', array(), '1.0', 'all');
    wp_enqueue_style('rsp_css'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove tags support from posts
function wpse60590_remove_metaboxes() {
    remove_meta_box( 'categorydiv' , 'prints' , 'normal' ); 
	remove_meta_box( 'categorydiv' , 'learn' , 'normal' ); 
	
	remove_meta_box( 'postexcerpt', 'prints', 'normal' );
	
    remove_meta_box( 'tagsdiv-post_tag' , 'prints' , 'normal' ); 
    remove_meta_box( 'tagsdiv-post_tag' , 'learn' , 'normal' ); 

}
add_action( 'admin_menu' , 'wpse60590_remove_metaboxes' );


// Remove featured image div from select posts 
function remove_image_box() {
	remove_meta_box( 'postimagediv', 'prints', 'side' );
}
add_action('do_meta_boxes', 'remove_image_box');

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	WooCommerce Custom Scripts
\*------------------------------------*/

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php).
// Used in conjunction with https://gist.github.com/DanielSantoro/1d0dc206e242239624eb71b2636ab148
// Compatible with 3.0.1+, for lower versions, remove "woocommerce_" from the first mention on Line 4
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
 
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();
	
	?>
	<a class="cart-customlocation" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	
	$fragments['a.cart-customlocation'] = ob_get_clean();
	
	return $fragments;
	
}

function rsp_enqueue_scripts() {
    /**
     * frontend ajax requests.
     */
	
    //wp_register_script('frontend-ajax', get_template_directory_uri() . '/js/frontend-ajax.js', array('jquery_321'), '1.0.0'); // Custom scripts
    wp_enqueue_script('frontend-ajax', get_template_directory_uri() . '/js/frontend-ajax.js', array('jquery_321'), '1.0.0'); // Custom scripts

    wp_localize_script( 'frontend-ajax', 'frontend_ajax_object',
        array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'data_var_1' => 'value 1',
            'data_var_2' => 'value 2',
        )
    );
}


function kia_add_script_to_footer(){
    ?>
	<script type="text/javascript">
	    jQuery(document).ready(function($){
			console.log('ready add script')
	        $('.quantity').on('click', '.plus', function(e) {
	            $input = $(this).prev('input.qty');
	            var val = parseInt($input.val());
	            $input.val( val+1 ).change();
	        });
 
	        $('.quantity').on('click', '.minus', 
	            function(e) {
	            $input = $(this).next('input.qty');
	            var val = parseInt($input.val());
	            if (val > 0) {
	                $input.val( val-1 ).change();
	            } 
	        });
			
	    });
	</script>
<?php 
}
add_action( 'wp_head', 'kia_add_script_to_footer' );

/* refill the cart page */
function my_wc_add_cart_ajax() {
  $product_id = $_POST['product_id'];
  $variation_id = $_POST['variation_id'];
  $quantity = $_POST['quantity'];

  if ($variation_id) {
    WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
  } else {
    WC()->cart->add_to_cart( $product_id, $quantity);
  }

	wc_print_notices();

	do_action( 'woocommerce_before_cart' ); ?>
	
	<div class="woocommerce">
	<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<?php do_action( 'woocommerce_before_cart_table' ); ?>
	
		<!-- inner-cart-container -->
		<div class="inner-cart-container">
		
			<!-- cart-table -->
			<div class="cart-table">
				<h1>Cart</h1>
			
				<!-- cart-headers-->
				<div class="cart-headers">
					<h6 class="product-span"><?php _e( 'Product', 'woocommerce' ); ?></h6>
					<h6 class="price-span"><?php _e( 'Price', 'woocommerce' ); ?></h6>
					<h6 class="quantity-span"><?php _e( 'Quantity', 'woocommerce' ); ?></h6>
					<h6 class="total-span"><?php _e( 'Total', 'woocommerce' ); ?></h6>
				</div>
				<!-- /cart-headers-->
			
				<!-- cart-items-->
				<div class="cart-items">
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>
			
			
				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<!-- cart-item -->
						<div class="cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						
							<!-- product-name -->
							<div class="product-span product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
							
								<?php
									if ( ! $product_permalink ) {
										echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
									} else {
										echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
									}

									// Meta data
									echo WC()->cart->get_item_data( $cart_item );

									// Backorder notification
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
									}
								?>
						
							</div>
							<!-- /product-name -->
						
							<!-- product-price -->
							<div class="price-span product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
								<?php
									echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
								?>
							</div>
							<!-- /product-price -->
						
							<!-- product-quantity -->
							<div class="quantity-span product-quantity"  data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
								<div class="qty-container">
									<?php
										if ( $_product->is_sold_individually() ) {
											$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
										} else {
											$product_quantity = woocommerce_quantity_input( array(
												'input_name'  => "cart[{$cart_item_key}][qty]",
												'input_value' => $cart_item['quantity'],
												'max_value'   => $_product->get_max_purchase_quantity(),
												'min_value'   => '0',
											), $_product, false );
										}

										echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
									?>
								</div>
							</div>
							<!-- /product-quantity -->
						
							<!-- product-subtotal-->
							<div class="total-span">
								<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
								?>
							</div>
							<!-- /product-subtotal -->
						
						
						</div>
						<!-- /cart-item -->
					
						<?php
						/*
							<td class="product-remove">
							
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
										__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									), $cart_item_key );
								?>
							</td>
							<td class="product-thumbnail">
								<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

									if ( ! $product_permalink ) {
										echo $thumbnail;
									} else {
										printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
									}
								?>
							</td>
						*/
						?>

						<?php
					}
				}
				?>	
				
				</div>
				<!-- /cart-items-->
			
				<!-- cart-shipping-->
				<div class="cart-shipping">
				
					<h6>Shipping</h6>
					<div class="shipping-options">
						<div>
							<input id="free-shipping" type="radio" name="shipping[]" />
							<label for="free-shipping">Free Shipping (pending approval)</label>
						</div>
						<div>
							<input id="us-shipping" type="radio" name="shipping[]" />
							<label for="us-shipping">US Shipping cost</label>
						</div>
					</div>
				
				</div>
				<!-- /cart-shipping-->
			
			
				<?php do_action( 'woocommerce_cart_contents' ); ?>



						<?php if ( wc_coupons_enabled() ) { ?>
							<div class="coupon">
								<label for="coupon_code"><?php _e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>" />
								<?php do_action( 'woocommerce_cart_coupon' ); ?>
							</div>
						<?php } ?>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			
				<!-- cart-actions-->
				<div class="cart-actions">
					<?php
						/**
						 * woocommerce_cart_collaterals hook.
						 *
						 * @hooked woocommerce_cross_sell_display
						 * @hooked woocommerce_cart_totals - 10
						 */
					 	do_action( 'woocommerce_cart_collaterals' );
					?>
				
					<input type="submit" class="button global-btn update-cart" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />
				
					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart' ); ?>
				</div>
				<!-- /cart-actions-->
			
			</div>
			<!-- /cart-table-->
		
		</div>
		<!-- /inner-cart-container-->

	
		<?php do_action( 'woocommerce_after_cart_table' ); ?>
	</form>
	<script type="text/javascript">
		
	    jQuery(document).ready(function($){

	        $('.quantity').on('click', '.plus', function(e) {
				console.log('add')
	            $input = $(this).prev('input.qty');
	            var val = parseInt($input.val());
	            $input.val( val+1 ).change();
	        });
 
	        $('.quantity').on('click', '.minus', 
	            function(e) {
	            $input = $(this).next('input.qty');
	            var val = parseInt($input.val());
	            if (val > 0) {
	                $input.val( val-1 ).change();
	            } 
	        });
			
	    });
	</script>
</div>
           

	<?php do_action( 'woocommerce_after_cart' ); ?>
<?php
}

add_action('wp_ajax_my_wc_add_cart', 'my_wc_add_cart_ajax');
add_action('wp_ajax_nopriv_my_wc_add_cart', 'my_wc_add_cart_ajax'); 

// remove all stylesheets for woocommerce
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
//add_action( 'wp_enqueue_scripts', 'rsp_enqueue_scripts' );
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5()
{
    register_taxonomy_for_object_type('category', 'prints'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'prints');
    register_post_type('prints', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Prints', 'prints'), // Rename these to suit
            'singular_name' => __('Prints', 'prints'),
            'add_new' => __('Add New', 'prints'),
            'add_new_item' => __('Add New Prints Post', 'prints'),
            'edit' => __('Edit', 'prints'),
            'edit_item' => __('Edit Prints Post', 'prints'),
            'new_item' => __('New Prints Post', 'posts'),
            'view' => __('View Prints Post', 'posts'),
            'view_item' => __('View Prints Post', 'posts'),
            'search_items' => __('Search Prints Post', 'posts'),
            'not_found' => __('No Prints Posts found', 'posts'),
            'not_found_in_trash' => __('No Prints Posts found in Trash', 'posts')
        ),
        'menu_icon' => 'dashicons-images-alt2',
		'show_in_nav_menus' => true,
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));

    register_taxonomy_for_object_type('category', 'community'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'community');
    register_post_type('community', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Community', 'community'), // Rename these to suit
            'singular_name' => __('Community', 'community'),
            'add_new' => __('Add New', 'community'),
            'add_new_item' => __('Add New Participant', 'community'),
            'edit' => __('Edit', 'community'),
            'edit_item' => __('Edit Participant Post', 'community'),
            'new_item' => __('New Participants Post', 'community'),
            'view' => __('View Participants Post', 'community'),
            'view_item' => __('View Participants Post', 'community'),
            'search_items' => __('Search Participants Post', 'wposts'),
            'not_found' => __('No Participants Posts found', 'posts'),
            'not_found_in_trash' => __('No Participants Posts found in Trash', 'posts')
        ),
        'public' => true,
		'show_in_nav_menus' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));

    register_taxonomy_for_object_type('category', 'learn'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('user_tag', 'learn');
    register_post_type('learn', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Learn', 'learn'), // Rename these to suit
            'singular_name' => __('Learn', 'learn'),
            'add_new' => __('Add New', 'learn'),
            'add_new_item' => __('Add New Learn Post', 'learn'),
            'edit' => __('Edit', 'learn'),
            'edit_item' => __('Edit Learn Post', 'learn'),
            'new_item' => __('New Learn Post', 'learn'),
            'view' => __('View Learn Post', 'learn'),
            'view_item' => __('View Learn Post', 'learn'),
            'search_items' => __('Search Learn Post', 'wposts'),
            'not_found' => __('No Learn Posts found', 'posts'),
            'not_found_in_trash' => __('No Learn Posts found in Trash', 'posts')
        ),
        'public' => true,
		'show_in_nav_menus' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
	
	
    register_taxonomy_for_object_type('category', 'rsp_blog'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('user_tag', 'rsp_blog');
    register_post_type('rsp_blog', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Blog', 'Blog'), // Rename these to suit
            'singular_name' => __('Blog', 'blog post'),
            'add_new' => __('Add New', 'blog post'),
            'add_new_item' => __('Add New Blog Post', 'Blog'),
            'edit' => __('Edit', 'Blog'),
            'edit_item' => __('Edit Blog Post', 'rsp_blog'),
            'new_item' => __('New Blog Post', 'rsp_blog'),
            'view' => __('View Blog Post', 'rsp_blog'),
            'view_item' => __('View Blog Post', 'rsp_blog'),
            'search_items' => __('Search Blog Post', 'wposts'),
            'not_found' => __('No Blog Posts found', 'posts'),
            'not_found_in_trash' => __('No Blog Posts found in Trash', 'posts')
        ),
        'public' => true,
		'show_in_nav_menus' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));

}

function remove_menus(){
  remove_menu_page( 'edit-comments.php' );          //Comments
  
}
add_action( 'admin_menu', 'remove_menus' );

function post_remove ()      //creating functions post_remove for removing menu item
{ 
   remove_menu_page('edit.php');
}

add_action('admin_menu', 'post_remove');   //adding action for triggering function call

add_filter( 'woocommerce_loop_add_to_cart_link', 'quantity_inputs_for_woocommerce_loop_add_to_cart_link', 10, 2 );
function quantity_inputs_for_woocommerce_loop_add_to_cart_link( $html, $product ) {
	if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
		$html = '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="cart" method="post" enctype="multipart/form-data">';
		$html .= woocommerce_quantity_input( array(), $product, false );
		$html .= '<button type="submit" class="button alt">' . esc_html( $product->add_to_cart_text() ) . '</button>';
		$html .= '</form>';
	}
	return $html;
}
//add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

?>

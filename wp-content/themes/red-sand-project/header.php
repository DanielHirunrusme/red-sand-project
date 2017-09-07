<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

	</head>
	<body <?php body_class(); ?> data-module-init="body">
		
		<!-- title-screen -->
		<div class="title-screen">
			
			<!-- logo -->
			<div class="logo">
				<a href="<?php echo home_url(); ?>">
					<!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
					<img src="<?php echo get_template_directory_uri(); ?>/img/RSP_Logo.svg" alt="Logo" class="logo-img">
				</a>
			</div>
			<!-- /logo -->
			
		</div>
		<!-- /title-screen -->
		
		<!-- lat-long -->
		<div id="lat-long">
			<span class="latitude">+32.4498893</span>
			<span class="longitude">-114.6137032</span>
		</div>
		<!-- /lat-long -->
		
		<!-- photo-credit -->
		<div id="photo-credit">
			<span class="photo-credit-label">Photo Credit: </span><span class="photo-credit-name">Jane Doe</span>
		</div>
		<!-- /photo-credit -->
		
		<!-- rsp-line -->
		<div id="rsp-line">
			<svg id="Layer_1" class="line-img" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 4675.71 1768.78"><defs><style>.cls-1,.cls-3{fill:none;}.cls-2{clip-path:url(#clip-path);}.cls-3{stroke:#c9292e;stroke-miterlimit:10;stroke-width:2px;}</style><clipPath id="clip-path" transform="translate(-9.02 -14.02)"><rect class="cls-1" x="9" y="14.1" width="4675.6" height="1768.9"/></clipPath></defs><title>RSP_Line</title><g class="cls-2"><path vector-effect="non-scaling-stroke" class="cls-3" d="M9.1,59.7L596.4,15.1l0.3,48.4,38.5,26.9,824.8,291,659.2,4.3-0.8-116.2,403.7,7.5,30.7,9.9,36,34.1,15.6,34,66.7,34.3,128.7,131.5,41,19.6,51.4,43.9,62.2,121.4,0.4,62.9,41.3,53.5,51.3,34.2,46.3,43.9,71.8,29.5,56.5,39.1,56.3,19.7,40.9,0.3,20.2-38.6,20.2-38.6,45.5-72.3,20.3-24.1,45.9-19.1,40.7-28.8,30.8,19.6,51.2,10,30.6-9.5,66.5,10.1,35.9,14.8,51.5,53.6,46.2,34.2,30.9,34.1,25.8,38.9,20.7,38.9,25.9,48.6,15.6,34,20.8,43.7,20.6,29.2,20.7,34L4057,1226l0.2,29s31,53.4,41.3,58.4,51.3,29.4,51.3,29.4l20.8,48.5,0.3,48.4,0.3,38.7,36.1,48.6,25.9,43.7,25.9,53.4,46.1,19.7s15.4,9.8,30.8,14.7,41.1,24.5,41.1,24.5l51.2,19.7,46.2,29.3,51.1,0.3,40.9,0.3,46.1,19.7,41.1,29.3,30.5-19.2" transform="translate(-9.02 -14.02)"/></g></svg>
			
		</div>
		<!-- /rsp-line -->
		
		<!-- close-button -->
		<button class="close-button">
			<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 5.16 5.16"><defs><style>.cls-1{fill:#c92a2f;}</style></defs><title>Untitled-1</title><polygon class="cls-1" points="3.99 0 2.66 1.95 2.64 1.95 1.27 0 0.21 0 2.04 2.44 0 5.16 1.03 5.16 2.56 3.03 2.58 3.03 4.1 5.16 5.16 5.16 3.19 2.54 5.04 0 3.99 0"/></svg>
		</button>
		<!-- /close-button -->

		<!-- wrapper -->
		<div class="wrapper">
			
			<!-- left-panel -->
			<section id="left-panel">
			
				<!-- logo -->
				<div class="nav-logo">
					<a class="home-link" href="<?php echo home_url(); ?>">
						<!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
						<img src="<?php echo get_template_directory_uri(); ?>/img/RSP_Logo.svg" alt="Logo" class="logo-img">
					</a>
				</div>
				
				<!-- nav -->
				<nav class="nav" role="navigation">
					<?php rsp_nav(); ?>
				</nav>
				<!-- /nav -->
				
				<a class="cart-customlocation cart-link <?php if(WC()->cart->get_cart_contents_count() == 0): ?>disabled<?php endif; ?>" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><span class="cart-title">Cart </span>(<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count()  ?></span>) <?php //echo WC()->cart->get_cart_total(); ?></a>
				
				<!--
				<a class="cart-link" href="/cart">
					
					
					<span class="cart-title">Cart </span><span class="cart-count">(0)</span>
				</a>
					-->
			
				<!-- LOAD THE CONTENT IN HERE -->
				
				<?php get_template_part('templates/content-left'); ?>

			</section>
			<!-- /left-panel -->

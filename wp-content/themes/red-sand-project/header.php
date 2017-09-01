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
	<body <?php body_class(); ?>>
		
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
			<img src="<?php echo get_template_directory_uri(); ?>/img/RSP_Line.svg" alt="Logo" class="line-img">
		</div>
		<!-- /rsp-line -->

		<!-- wrapper -->
		<div class="wrapper">
			
			<!-- left-panel -->
			<section id="left-panel">
			
				<!-- logo -->
				<div class="nav-logo">
					<a href="<?php echo home_url(); ?>">
						<!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
						<img src="<?php echo get_template_directory_uri(); ?>/img/RSP_Logo.svg" alt="Logo" class="logo-img">
					</a>
				</div>
				
				<!-- nav -->
				<nav class="nav" role="navigation">
					<?php rsp_nav(); ?>
				</nav>
				<!-- /nav -->
				
				<a class="cart-link" href="/cart">
					<span class="cart-title">Cart</span><span class="cart-count">(0)</span>
				</a>
			
				<!-- LOAD THE CONTENT IN HERE -->

			</section>
			<!-- /left-panel -->

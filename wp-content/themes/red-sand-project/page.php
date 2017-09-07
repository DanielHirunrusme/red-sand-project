<?php get_header(); ?>
	
	
	<?php get_template_part('templates/content-right'); ?>
	
	<?php if($post->post_content == '[woocommerce_checkout]'): ?>
	<?php get_template_part('templates/checkout'); ?>
	<?php endif; ?>
	
<?php get_footer(); ?>
 
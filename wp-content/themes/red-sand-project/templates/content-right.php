<section id="right-panel">
<main class="main" role="main"><div class="inner-main">
			<?php
			$menu = 'Primary'; // Replace with your menu name
			$items[] = wp_get_nav_menu_items($menu);
			//print_r($items);
			
			if( $items ) {
				
				foreach ( $items as $item ) {
					
					foreach ( $item as $i ) {
						
						//print_r($i);
						
						if ( $i->type == 'post_type' ) {
							
							//echo $i->ID;
		
							global $post;
							$post = get_post($i->object_id);
							setup_postdata($post); 
							?>
							<article class="page-content" data-page-id="<?= get_the_ID() ?>" data-page-title="<?= get_the_title() ?>">
								<div class="inner-content">
									
									<div class="page-inner-content">

										<?php if($image = get_field('featured_image')): ?>
											<?php
												
											$image_size = get_field_object('featured_image_size');
										
											$image_size_value = $image_size['value']; 
											$image_size_value = preg_split("/:/", $image_size_value);
												
											?>
											<img src="<?php echo $image['url']; ?>" class="size-<?= strtolower($image_size_value[0]); ?>" alt="<?php echo $image['alt']; ?>" /> 
											
										<?php endif; ?>
										
									</div>
									<!-- /page-inner-content -->
								</div>
								<!-- /inner-content -->
							<?php wp_reset_postdata(); ?>
							</article>
							
							<?php $children = get_pages( 
							    array(
							        'sort_column' => 'menu_order',
							        'sort_order' => 'ASC',
							        'hierarchical' => 0,
							        'parent' => $i->object_id,
							    ));

							foreach( $children as $post ) { 
							        setup_postdata( $post ); ?>
							    <article class="page-content" data-page-id="<?= get_the_ID() ?>" data-page-title="<?= get_the_title() ?>">								<div class="inner-content">
							
									<div class="page-inner-content">

										<?php if($image = get_field('featured_image')): ?>
											<?php
												
											$image_size = get_field_object('featured_image_size');
										
											$image_size_value = $image_size['value']; 
											$image_size_value = preg_split("/:/", $image_size_value);
												
											?>
											<img src="<?php echo $image['url']; ?>" class="size-<?= strtolower($image_size_value[0]); ?>" alt="<?php echo $image['alt']; ?>" />
											
										<?php endif; ?>
										
									</div>
									<!-- /page-inner-content -->
								</div>
								<!-- /inner-content -->
							    </article>
							<?php wp_reset_postdata(); } ?>
							
							<?php
							/*
							$args = array( 'numberposts' => 5, 'offset'=> 1, 'category' => 1 );
							$myposts = get_posts( $args );
							foreach( $myposts as $post ) :
							  setup_postdata($post); 
							  the_title();
							endforeach; 
							wp_reset_postdata(); ?>
							*/
							
						} elseif ( $i->type == 'post_type_archive' ) {
							
							//print_r($i);
							
							?>
							
							<article class="article-content" data-article-id="" data-article-title="">
								<div class="inner-content">
								<?php
									
									$args = array( 'numberposts' => -1, 'post_type' => $i->object );
									$myposts = get_posts( $args );
									foreach( $myposts as $post ) :
									  setup_postdata($post); 
									  
									  ?>
									  
  									
  									<div class="page-inner-content">
  										<?php //the_content() ?>
  									</div>
									  
									  
									 <?php
									  
									endforeach; 
									wp_reset_postdata(); 
									
								?>
								</div>
							</article>
							
							<?php
							
							//get_template_part('templates/content-archive');
							
						}
						
					}
					
				}
				
	
				
				
				
			}
			
			
			
			
			?>

	</div></main>
	
</section>
<!-- /right-panel -->

<script>
	$(document).ready(function(){
		console.log('test');
	});
</script>
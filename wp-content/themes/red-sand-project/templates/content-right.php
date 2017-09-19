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
							<article class="page-content" data-page-id="<?= get_the_ID() ?>" data-url="<?php the_permalink() ?>" data-page="<?= strtolower(get_the_title()) ?>">
								<div class="inner-content">
									
										<div class="page-inner-content">
										
										<?php

										/*
										* Loop through a repeater field
										*/
									
										if(get_field('page_images')): ?>
									
										    <?php while(the_repeater_field('page_images')): ?>
												
												<?php $image = get_sub_field('image'); ?>
												<?php $image_credit = get_sub_field('image_credit'); ?>
												<?php $image_size = get_sub_field('image_size'); ?>
												
												<div class="page-image <?php if($image_size == 'full_bleed'): ?>full-bleed" style="background-image:url(<?php echo $image['url']; ?>)"<?php else: ?>"<?php endif; ?>">
													
													<?php if($image_size == 'medium'): ?>
											     	   <img src="<?php echo $image['url']; ?>" />
													<?php endif; ?>
												</div>
										    <?php endwhile; ?>

										 <?php endif; ?>
										 
										 
 										<?php if( $i->ID == 167 ): ?>
											
 											<?php

 											/*
 											* Loop through a repeater field
 											*/
									
 											if(get_field('participant')): ?>
											
												<div class="participant-holder" data-module-init="participants">
									
 											    <?php while(the_repeater_field('participant')): ?>
												
 													<?php $image = get_sub_field('participant_image'); ?>
													<?php $name = get_sub_field('participant_name'); ?>
													
 													<button data-name="<?= $name; ?>">
														<img src="<?php echo $image['url']; ?>" />
														<h3><?= $name ?></h3>
													</button>
													
 											    <?php endwhile; ?>
												
												</div>

 											 <?php endif; ?>
											
 										<?php endif; ?>
										 
										</div><!-- /page-inner-content -->
										
									<?php
									/*

										<?php if($image = get_field('featured_image')): ?>
											<?php
												
											$image_size = get_field_object('featured_image_size');
										
											$image_size_value = $image_size['value']; 
											$image_size_value = preg_split("/:/", $image_size_value);
											$image_size_value = strtolower($image_size_value[0]);
											?>
											<?php if($image_size_value != 'large'): ?>
											<img src="<?php echo $image['url']; ?>" class="size-<?= $image_size_value; ?>" alt="<?php echo $image['alt']; ?>" />
											<?php else: ?>
											<div class="image-large-background background-image" style="background-image:url(<?php echo $image['url']; ?>)"></div>
											<?php endif; ?>
										<?php endif; ?>
										*/
									?>
										
						
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
							    <article class="page-content" data-page-id="<?= get_the_ID() ?>" data-url="<?php the_permalink() ?>" data-page="<?= strtolower(get_the_title()) ?>">								<div class="inner-content">
									
									
									
									
									
									<div class="page-inner-content">
									
									<?php

									/*
									* Loop through a repeater field
									*/
								
									if(get_field('page_images')): ?>
								
									    <?php while(the_repeater_field('page_images')): ?>
											
											<?php $image = get_sub_field('image'); ?>
											<?php $image_credit = get_sub_field('image_credit'); ?>
											<?php $image_size = get_sub_field('image_size'); ?>
											
											<div class="page-image <?php if($image_size == 'full_bleed'): ?>full-bleed" style="background-image:url(<?php echo $image['url']; ?>)"<?php else: ?>"<?php endif; ?>">
												
												<?php if($image_size == 'medium'): ?>
										     	   <img src="<?php echo $image['url']; ?>" />
												<?php endif; ?>
											</div>
									    <?php endwhile; ?>

									 <?php endif; ?>
									 
									</div><!-- /page-inner-content -->
									
									
									
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
							
							<?php if($i->object != 'prints'): ?>
								
								<?php
								
									$args = array( 'numberposts' => -1, 'post_type' => $i->object );
									$myposts = get_posts( $args );
									foreach( $myposts as $post ) :
									  setup_postdata($post); 
								  
									  ?>
									  <!--
								<article class="article-content category-content-dummy" data-page="<?= $i->object ?>" data-url="<?php echo site_url(); ?>/<?= $i->object ?>/">asdasdsad</article>
										  -->
								<article class="article-content" data-id="<?php the_id(); ?>" data-page="<?= $i->object ?>" data-url="<?php the_permalink() ?>" data-article-id="" data-article-title="">
									<div class="inner-content">
									
									  	<?php if(get_the_title() != 'Stats'): ?>
											
										<div class="page-inner-content">
									
										<?php

										/*
										* Loop through a repeater field
										*/
								
										if(get_field('page_images')): ?>
								
										    <?php while(the_repeater_field('page_images')): ?>
											
												<?php $image = get_sub_field('image'); ?>
												<?php $image_credit = get_sub_field('image_credit'); ?>
												<?php $image_size = get_sub_field('image_size'); ?>
											
												<div class="page-image <?php if($image_size == 'full_bleed'): ?>full-bleed" style="background-image:url(<?php echo $image['url']; ?>)"<?php else: ?>"<?php endif; ?>">
												
													<?php if($image_size == 'medium'): ?>
											     	   <img src="<?php echo $image['url']; ?>" />
													<?php endif; ?>
												</div>
										    <?php endwhile; ?>

										 <?php endif; ?>
									 
										</div><!-- /page-inner-content -->
										
										<?php else: ?>
  									
	  									<div class="page-inner-content">					
											<div class="map" data-module-init="map"></div>
	  									</div>
										
										<?php endif; ?>
										
									  
									  
										 
									</div>
								</article>
								
									 <?php
								  
									endforeach; 
									wp_reset_postdata(); 
								
								?>
								
								
							<?php else: ?>
							
							<article class="article-content" data-page="<?= $i->object ?>" data-url="<?= $i->url ?>" data-article-id="" data-article-title="">
								<div class="inner-content">
								<?php
									
									$args = array( 'numberposts' => -1, 'post_type' => $i->object );
									$myposts = get_posts( $args );
									foreach( $myposts as $post ) :
									  setup_postdata($post); 
									  
									  ?>
									  
  									
  									<div class="page-inner-content">
										<?php if(get_the_title() == 'Stats'): ?>
											<div class="map"></div>
											<script type="text/javascript">
												$(document).ready(function(){
													$('.map').vectorMap({map: 'world_mill_en'});
												});
											</script>
										<?php endif; ?>
  									</div>
									  
									  
									 <?php
									  
									endforeach; 
									wp_reset_postdata(); 
									
								?>
								</div>
							</article>
							
							<?php endif; ?>
							
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
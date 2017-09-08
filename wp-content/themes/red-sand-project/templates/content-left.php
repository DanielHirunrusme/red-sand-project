	<main class="main" role="main">


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
							<article class="page-content" data-page-id="<?= get_the_ID() ?>" data-page="<?= strtolower(get_the_title()) ?>" data-page-title="<?= get_the_title() ?>">
		
									
									<div class="page-inner-content">
										<?php if(get_field('hide_title') == 0): ?>
											<h1 class="page-title"><?php the_title(); ?></h1>
										<?php endif; ?>
										<?php the_content() ?>
									</div>
	
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
							    <article class="page-content" data-page-id="<?= get_the_ID() ?>" data-page="<?= strtolower(get_the_title()) ?>" data-page-title="<?= get_the_title() ?>">		
									
									
									<div class="page-inner-content">
										<?php if(get_field('hide_title') == 0): ?>
											<h1 class="page-title"><?php the_title(); ?></h1>
										<?php endif; ?>
										<?php the_content() ?>
									</div>
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
								
								
								<article class="article-content article-<?= $i->object ?>" data-id="<?php the_id(); ?>" data-page="<?= $i->object ?>" data-article-id="" data-article-title="">

	  									<div class="page-inner-content">

											<h1 class="page-title"><?php the_title(); ?></h1>
	  										<?php the_content() ?>
	  									</div>
									
								</article>
								
									 <?php
								  
									endforeach; 
									wp_reset_postdata(); 
								
									?>
								
								
							<?php else: ?>
							
							
							<article class="article-content article-<?= $i->object ?>" <?php if($i->object == 'prints'): ?>data-module-init="prints"<?php endif; ?> data-page="<?= $i->object ?>" data-article-id="" data-article-title="">
								<?php if($i->object == 'prints'): ?>
									<div class="article-inner-holder">
								<?php endif; ?>
								
								<?php
									
									$args = array( 'numberposts' => -1, 'post_type' => $i->object );
									$myposts = get_posts( $args );
									foreach( $myposts as $post ) :
									  setup_postdata($post); 
									  
									  ?>
									
									
  									<div class="page-inner-content">
										<?php if($i->object == 'prints'): ?>
											
											<button class="print">
												<h2><?php the_title() ?></h2>
												<div class="print-author"><?php the_field('print_author'); ?></div>
												<div class="print-thumbnail" data-bg="<?php echo get_field('print_image')['url'] ?>" style="background-image:url(<?php echo get_field('print_image')['url'] ?>)"></div>
											</button>
											
										<?php else: ?>
										<h1 class="page-title"><?php the_title(); ?></h1>
  										<?php the_content() ?>
										<?php endif; ?>
  									</div>
									  
									  
									 <?php
									  
									endforeach; 
									wp_reset_postdata(); 
									
								?>
								
								<?php if($i->object == 'prints'): ?>
								</div>
								<!-- /article-inner-holder -->
								<?php endif; ?>
									
							</article>
							
							<?php endif; ?>
							
							<?php
							
							//get_template_part('templates/content-archive');
							
						}
						
					}
					
				}
				
	
				
				
				
			}
			
			
			
			
			?>

	</main>

<?php 
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */
get_header('dashboard');
echo get_template_part( 'template-headers/sidebar-dashboard' );

$User_Id = get_current_user_id();
$args = array(  
    'post_type' => 'work-history-gap',
    'post_status' => 'publish',
    'author' => $User_Id,
);

$loop = new WP_Query( $args ); 
 if ( have_posts() ){  

		$postId = get_the_ID();
        $post_slug = $post->post_name;

    	$imgs = get_post_meta($postId,'license_attachment_id',true);
    	$meta = explode(',', $imgs);
		
        $gap_reson = get_field('gap_reson');
        $gap_additional_comments = get_field('gap_additional_comments');
        $gap_city = get_field('gap_city');
        $gap_state = get_field('gap_state');
        $gap_started_M = get_field('gap_started_M');
        $gap_started_Y = get_field('gap_started_Y');
        $gap_ended_M = get_field('gap_ended_M');
        $gap_ended_Y = get_field('gap_ended_Y');

?>
<div class="content profile_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
		<div id="licenses_<?php echo get_the_ID(); ?>" class="mt-3 p-5">
				 		<!-- <div class="card-header">
					 		<div class="row">
					 		<div class="col-lg-9">
					 		<h5> <?php //echo get_field('licenses_type'); ?></h5>
					 		</div>
					 		<div class="col-lg-3">
								<a class="card-header-link" href="<?php //echo get_the_permalink(); ?>">
								        Details
								        <i class="fal fa-link fa-fw"></i>
								</a>
					 		</div>
					 		</div>
				 		</div> -->
				 		<div class="rows_lists d-flex">

				<span class="row-icon me-2">
				<i class="fal fa-fw fa-calendar"></i>
				</span>
 				<div class="flex-grow-1">
 					<span class="title title-column">
 						<span class="d-flex gap-2">
 							<span class="title-primary">
 								<a href="<?php echo get_site_url();?>/profile/work-history-gap/<?php echo $post_slug ?>"><?php echo $gap_reson; ?></a>
 							</span>
 							<span class="title-secondary"><b><?php echo $gap_started_M.' '.$gap_started_Y.' — '.$gap_ended_M.' '.$gap_ended_Y; ?></b></span>
						</span>
						<div class="Expliantion d-block">
						<b>EXPLANATION OF WHY THERE IS A GAP: </b> <?php if($gap_additional_comments){echo $gap_additional_comments;}?>
						</div>
						
						<div class="Expliantion d-block">
						<b>Address: </b> <?php echo $gap_city.','.$gap_state;?>
						</div>
 					</span>					
 				</div>
 				
 			</div>
		 </div>
		<?php
		}	   
		    wp_reset_postdata(); 
		?>
			</div>
		</div>
	</div>








	
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
    'post_type' => 'skills-checklists',
    'post_status' => 'publish',
    'author' => $User_Id,
);

$loop = new WP_Query( $args ); 
 if ( have_posts() ){  

		$postId = get_the_ID();
    	$imgs = get_post_meta($postId,'skills_attachment_id',true);
    	$meta = explode(',', $imgs);
		
		   if($imgs ){ $count = count($meta); }
		   $post_slug = $post->post_name;

		$skillcheck = get_post_meta( $postId, 'postSorting', true );
		if($imgs ){ $count = count($meta); }
		
		$completed = get_field('completed_date');
		$specciality = get_field('checklists_specialty');

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
				 		<div class="card-body" >
							<div class="row">
								<div class="col-md-8">
								<div class="data-row lic_rows_data" style="display: flex;
    flex-wrap: wrap;
    flex-direction: column;">
									<div class="font-heavyweight">
										<h6>
										<?php echo get_the_title(); ?>
										</h6>
									</div>
								<div class="data-row lic_rows_data">
									<div class="data_label">
									   Speciality:
									</div>
									<div class="data_values">
									   <?php echo $specciality; ?>
									</div>
								</div>
								<div class="data-row lic_rows_data">
									<div class="data_label">
									   Completed date:
									</div>
									<div class="data_values">
									   <?php echo $completed; ?>
									</div>
								</div>

								</div>
								
								
						</div>

						<div class="row">
									<div class="col-12">
										<h5 class="kamana-green-text mt-3 mb-0 h6 font-heavyweight">				
										Attachments										
										</h5>
										<div class="images">
											<ul class="lists_img">
												<?php
												foreach ($meta as $metas) {

											$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
											//$count = count($metas);
											if($attch_name){
											$loopattach = '<li class="attch_path_title d-flex">
														<div class="attach_flex d-flex">
															<i class="mr-2 fal fa-file-image kamana-green-text"></i>
															<div class="attchName">'.$attch_name.'</div>
															</div>
															<div class="action-dropdown dropdown">
												<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
												<i class="fal fa-ellipsis-v-alt"></i></a>

												<ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

												<a class="text-muted dropdown-item" data-bs-target="#" data-bs-toggle="modal" href="#banned_time_expired_delete_modal"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


												<div class="dropdown-divider"></div>
												<a class="kamana-delete-text dropdown-item" data-csrf="YFMNCi42ADYSOz0yJBwKFj9hAWQEAhw_3ekNCS-GQPups-blqRrTBitf" data-method="put" data-to="/profile/licenses/29a9fb49-af67-40fd-b815-bbab26a1cac4/attachments/d7e6fd5e-cda4-49bc-b818-c95aa2d37de2/archive" href="/profile/licenses/29a9fb49-af67-40fd-b815-bbab26a1cac4/attachments/d7e6fd5e-cda4-49bc-b818-c95aa2d37de2/archive" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>

												</ul>
												</div>
														   </li>';
														   echo $loopattach;
											}
											
											
											}
											?>
											</ul>
										</div>
									</div>
								</div>
							</div>
		 </div>
		<?php

$deleteAttach = $_GET['deleteAttach'];
if(isset($deleteAttach)){
	$savedAttach = get_post_meta($postId, 'skills_attachment_id', true);
	$array_this = explode(',',$savedAttach);
	wp_delete_post($deleteAttach);
	$array_without_strawberries = array_diff($array_this, array($deleteAttach));

	//print_r($array_without_strawberries);						
	$ids = implode(',', $array_without_strawberries);
	update_post_meta($postId, 'skills_attachment_id', $ids);
	$url = get_site_url().'/profile';	
	//wp_redirect( $url );
	//exit;
	echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
	
}
		}	   
		    wp_reset_postdata(); 
		?>
			</div>
		</div>
	</div>








	
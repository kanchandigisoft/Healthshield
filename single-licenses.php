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
    'post_type' => 'licenses',
    'post_status' => 'publish',
    'author' => $User_Id,
);

$loop = new WP_Query( $args ); 
 if ( have_posts() ){  

		$postId = get_the_ID();
    	$imgs = get_post_meta($postId,'license_attachment_id',true);
    	$meta = explode(',', $imgs);
		
		   if($imgs ){ $count = count($meta); }
		   $post_slug = $post->post_name;

			$lccompact = get_field('licenses_compact');

			if($lccompact == 1){
			$val_compact = 'Yes';
			}else{
			$val_compact = 'No';
			}	

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
				 		<div class="card-body">
							<div class="row">
								<div class="col-md-8">
									<div class="font-heavyweight">
										<h6>
										<?php echo get_the_title(); ?>
										</h6>
									</div>
								<div class="data-row lic_rows_data">
									
									<div class="data_label">
									   License Number:
									</div>
									<div class="data_values">
									   <?php echo get_field('licenses_number'); ?>
									</div>
								</div>
								<div class="data-row lic_rows_data">
									<div class="data_label">
									   Compact?:
									</div>
									<div class="data_values">
									   <?php echo $val_compact; ?>
									</div>
								</div>
								<div class="data-row lic_rows_data">
									<div class="data_label">
									   Issue Date:
									</div>
									<div class="data_values">
									   <?php the_field('issue_date'); ?>
									</div>
								</div>
								</div>
								<div class="col-md-4">

								<?php 
										    $today = time();												    										
											$dt2 = get_field('expire_date');

											$date2 = date("Y-m-d", strtotime($dt2));

											$newDate = strtotime($date2);

											$diff = $newDate - $today;

											$totaldays = round($diff / (60 * 60 * 24));

												/*$date1=date_create($today);
												$date2=date_create($dt2);
												$diff=date_diff($date1,$date2);

											$totaldays = abs(($today - $date2) / (60 * 60 * 24));
										echo $totaldays;*/

										?>

									<div class="card expertion_date text-center <?php if($totaldays < 0 ){ echo 'bg-danger';}else{ echo 'bg-primary';} ?>">
									<div class="card-body">
									 
										
										 <div class="expiration-profile-days">
										    <div class="expiration-profile-label">
										    Expires in
										    </div>
										  <div>
											  <div class="expires-in-days"><?php echo $totaldays; ?></div>
											  <div class="expires-in-days-label">
											    days
											  </div>
										 </div>
										</div>

										<div class="expiration-profile-date">
											<hr class="expiration-profile-divider">
											<div class="expiration-date-label">on</div>
											    <div class="expiration-date">
											   <?php echo get_field('expire_date'); ?>
											    </div>
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
														<div class="attach_flex d-flex" id="'.$metas.'">
															<i class="mr-2 fal fa-file-image kamana-green-text"></i>
															<div class="attchName">'.$attch_name.'</div>
															</div>
															<div class="action-dropdown dropdown">
												<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
												<i class="fal fa-ellipsis-v-alt"></i></a>

												<ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

												<a class="text-muted dropdown-item" href="'.get_the_permalink(get_the_ID()).'?deleteAttach='.$metas.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>
												
												<div class="dropdown-divider"></div>
												<a class="kamana-delete-text dropdown-item"  data-method="put"  href="#" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>

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
		 </div>
		<?php
		$deleteAttach = $_GET['deleteAttach'];
		if(isset($deleteAttach)){
			$savedAttach = get_post_meta(get_the_ID(), 'license_attachment_id', true);
			$array_this = explode(',',$savedAttach);
			wp_delete_post($deleteAttach);
			$array_without_strawberries = array_diff($array_this, array($deleteAttach));

			//print_r($array_without_strawberries);						
			$ids = implode(',', $array_without_strawberries);
			update_post_meta(get_the_ID(), 'license_attachment_id', $ids);
			$url = get_the_permalink(get_the_ID());
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








	
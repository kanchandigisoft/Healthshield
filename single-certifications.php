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
    'post_type' => 'certifications',
    'post_status' => 'publish',
    'author' => $User_Id,
);

$loop = new WP_Query( $args ); 
 if ( have_posts() ){  

    $cert_type = get_field('certificate_type');
		$cert_number = get_field('certification_number');
		$cert_expire = get_field('certificate_expire_date');
		$cert_issue = get_field('certificate_issue_date');
		
 		$postId = get_the_ID();
		$otherNam = get_post_meta($postId, 'otherNam', true);
 		$imgs = get_post_meta($postId,'certificate_attachment_id',true);
 		$meta = explode(',', $imgs);

        //print_r ($meta);

     $postId = get_the_ID();
     $post_slug = $post->post_name;	

?>
<div class="content profile_content">
    <div class="container pt-5 ps-5 pe-5 pb-1">
        <div class="row">
            <div class="rows_lists d-flex">

                
                <div class="flex-grow-1">
                <span class="title title-column">
                <span>
                
                <!-- <span class="title-secondary"><?php //echo $fcname; ?></span> -->
                </span>
                </span>
                
                <div class="card-body">
 					<div class="row">
 						<div class="col-md-8">
 							<span class="title-primary">
			                   <div class="font-heavyweight"><h6><?php echo get_the_title(); ?></h6></div>
			                </span><br>
							<?php if($otherNam != '' AND $cert_type == 'OTHER'){ ?>
								<div class="data-row lic_rows_data">
									<div class="data_label">
										Other name:
									</div>
									<div class="data_values">
										<?php echo $otherNam; ?>
									</div>
								</div>
							<?php }else{ } ?>
 							<div class="data-row lic_rows_data">
 								<div class="data_label">
 									Certification Number:
 								</div>
 								<div class="data_values">
 									<?php echo $cert_number; ?>
 								</div>
 							</div>

							 <div class="data-row lic_rows_data">
 								<div class="data_label">
 									Issue Date:
 								</div>
 								<div class="data_values">
 									<?php echo $cert_issue; ?>
 								</div>
 							</div>
 							<div class="data-row lic_rows_data">
 								<div class="data_label">
 									Exipre Date:
 								</div>
 								<div class="data_values">
 									<?php echo $cert_expire; ?>
 								</div>
 							</div>
 						</div>
 						<div class="col-md-4">
 							<?php 
 							$today = time();												    										
 							$dt2 = get_field('certificate_expire_date');

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
										<?php echo get_field('certificate_expire_date'); ?>
									</div>
								</div>
							</div>
						</div>

					</div>
						
					</div>
					<div class="row">
						<div class="col-12">
							<h5 class="healthshiled-green-text mt-3 mb-0 h6 font-heavyweight">				
								Attachments										
							</h5>
							<div class="images">
								<ul class="lists_img">
									<?php
									foreach ($meta as $metas) {

								$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                                //echo $attch_name;
								$attach_url = wp_get_attachment_url( $metas );
								//$count = count($metas);
								if($attch_name){
									$loopattach = '<li class="attch_path_title d-flex">
									<div class="attach_flex d-flex" id="'.$metas.'">
									<i class="mr-2 fal fa-file-image healthshiled-green-text"></i>
									<div class="attchName"><a href="'.$attach_url.'" target="_blank" class="attach_url_link">'.$attch_name.'</a></div>
									</div>
									<div class="action-dropdown dropdown">
									<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
									<i class="fal fa-ellipsis-v-alt"></i></a>

									<ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

									<a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttach='.$metas.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


									<div class="dropdown-divider"></div>

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
	$savedAttach = get_post_meta($postId, 'certificate_attachment_id', true);
	$array_this = explode(',',$savedAttach);
	wp_delete_post($deleteAttach);
	$array_without_strawberries = array_diff($array_this, array($deleteAttach));

	//print_r($array_without_strawberries);						
	$ids = implode(',', $array_without_strawberries);
	update_post_meta($postId, 'certificate_attachment_id', $ids);
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
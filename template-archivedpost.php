<?php
if(is_user_logged_in()){
/*
* Template Name: Archived Post
*/

get_header('dashboard');
echo get_template_part( 'template-headers/sidebar-dashboard' );
$current_user = wp_get_current_user();

 /**Check if Member Active**/
$mepr_user = new MeprUser( get_current_user_id() );
if( $mepr_user->is_active() ) {
    //echo 'Active';
}else if($mepr_user->has_expired()) {
    wp_redirect(get_site_url());
  exit;
}else {
    wp_redirect(get_site_url());
  exit;
} 
/************/

$User_Id = get_current_user_id();

?>
<div class="content profile_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
							<?php 
if(is_page(1033)){
					$args = array(  
					    'post_type' => 'licenses',
					    'post_status' => 'draft',
					    'author' => $User_Id,
					);
				    $loop = new WP_Query( $args ); 
				     if ( $loop->have_posts()  ){  
				     
					    while ( $loop->have_posts() ) : $loop->the_post();
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
			<div class="association-card card mb-3">
				<div class="card-header">
					<h6 class="card-header-title">
						<b><?php echo get_field('licenses_state'); ?></b> –
						<a href="<?php echo get_site_url();?>/profile/"><?php echo get_field('licenses_type'); ?></a>
					</h6>
					<a class="btn btn-primary btn-sm mt-2 mt-sm-0" data-method="put"  href="<?php echo get_site_url();?>/profile/archived/?restore=<?php echo $postId; ?>" rel="nofollow"><span><i class="fal fa-fw fa-box-open"></i> Restore</span></a>
				</div>
				<div class="card-body">
					<div class="d-flex flex-row">
						<div class="flex-grow-1">
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
						</div>
						<?php 
								    $today = time();												    										
									$dt2 = get_field('expire_date');

									$date2 = date("Y-m-d", strtotime($dt2));

									$newDate = strtotime($date2);

									$diff = $newDate - $today;

									$totaldays = round($diff / (60 * 60 * 24));
								?>
						<div class="card expiration-profile active text-center <?php if($totaldays < 0 ){ echo 'bg-danger';}else{ echo 'bg-primary';} ?>">
							<div class="card-body">
								
								<div class="expiration-profile-days">
									<div class="expiration-profile-label">
										Expires in
									</div>
									<div>
										<div class="expires-in-days">
											<?php echo $totaldays; ?>
										</div>
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
				</div>
			</div>
			<?php
					$restore = $_GET['restore'];
					if(isset($restore)){
						$postid = $restore;
						$my_post = array(
						'ID'           => $restore,
						'post_status'   => 'publish',
						);
						wp_update_post( $my_post );
						$url = get_site_url().'/profile';
						wp_redirect( $url );
						exit;
					}

					?>

					<?php
						   endwhile;
					     
					  
					    }else{
					    	echo "No found any Archived list.";
					    }
					    wp_reset_postdata(); 

					    }
					?>
		


<!--------------------------certificate archived------------------------------->

<?php 
if(is_page(1040)){


					$args = array(  
					    'post_type' => 'certifications',
					    'post_status' => 'draft',
					    'author' => $User_Id,
					);
					
				    $loop = new WP_Query( $args ); 
				     if ( $loop->have_posts()  ){  
				     	
					    while ( $loop->have_posts() ) : $loop->the_post();
							$cert_type = get_field('certificate_type');
							$cert_number = get_field('certification_number');
							$cert_expire = get_field('certificate_expire_date');
							$postId = get_the_ID();
							$imgs = get_post_meta($postId,'certificate_attachment_id',true);
							$meta = explode(',', $imgs);

							
							   if($imgs ){ $count = count($meta); }
							   $post_slug = $post->post_name;
								
					 	?>
			<div class="association-card card mb-3 px-0">
				<div class="card-header">
					<h6 class="card-header-title">
						<b><?php echo get_field('certificate_hidden'); ?></b> –
						<a href="<?php echo get_site_url();?>/profile/"><?php echo $cert_type; ?></a>
					</h6>
					<a class="btn btn-primary btn-sm mt-2 mt-sm-0" data-method="put"  href="<?php echo get_site_url();?>/profile/archived/?restore=<?php echo $postId; ?>" rel="nofollow"><span><i class="fal fa-fw fa-box-open"></i> Restore</span></a> 					
 				</div>
 				<div class="card-body">
 					<div class="row">
 						<div class="col-md-10">
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
 									Exipre Date:
 								</div>
 								<div class="data_values">
 									<?php echo $cert_expire; ?>
 								</div>
 							</div>
 						</div>
 						<div class="col-md-2">
 							<?php 
								    $today = time();												    										
									$dt2 = get_field('expire_date');

									$date2 = date("Y-m-d", strtotime($dt2));

									$newDate = strtotime($date2);

									$diff = $newDate - $today;

									$totaldays = round($diff / (60 * 60 * 24));
								?>
								<div class="card expiration-profile active text-center <?php if($totaldays < 0 ){ echo 'bg-danger';}else{ echo 'bg-primary';} ?>">
									<div class="card-body">
										
										<div class="expiration-profile-days">
											<div class="expiration-profile-label">
												Expires in
											</div>
											<div>
												<div class="expires-in-days">
													<?php echo $totaldays; ?>
												</div>
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
					$restore = $_GET['restore'];
					if(isset($restore)){
						$postid = $restore;
						$my_post = array(
						'ID'           => $restore,
						'post_status'   => 'publish',
						);
						wp_update_post( $my_post );
						$url = get_site_url().'/profile';
						wp_redirect( $url );
						exit;
					}

					?>

					<?php
						   endwhile;
					     
					   
					    }else{
					    	echo "No found any Archived list.";
					    }
					    wp_reset_postdata(); 


					    }
					?>


<!---------------------education form--------------------------->
<?php 
if(is_page(1043)){
	$args = array(  
					    'post_type' => 'education',
					    'post_status' => 'draft',
					    'author' => $User_Id,
					);
					
				    $loop = new WP_Query( $args ); 
				     if ( $loop->have_posts()  ){  
				     	
					    while ( $loop->have_posts() ) : $loop->the_post();
							$degreetype = get_field('degree_type' );
							$degreename = get_field('name_of_the_degree');
							$schoolName = get_field('name_of_school');
							$started_month = get_field('started_month');
							$started_year = get_field('started_year');
							$enddate_month = get_field('graduation_month');
							$enddate_year = get_field('graduation_year');
							$enrolled = get_field('currently_enrolled');
							$postId = get_the_ID();

							$post_slug = $post->post_name;
								
					 	?>
			<div class="association-card card mb-3 px-0">
				<div class="card-header">
					<h6 class="card-header-title">
						<b><?php echo $degreetype; ?></b> –
					</h6>
					<a class="btn btn-primary btn-sm mt-2 mt-sm-0" data-method="put"  href="<?php echo get_site_url();?>/profile/archived/?restore=<?php echo $postId; ?>" rel="nofollow"><span><i class="fal fa-fw fa-box-open"></i> Restore</span></a> 					
 				</div>
 				<div class="card-body">
 					<div class="row">
 						<div class="col-md-8">
 							<div class="data-row lic_rows_data">
 								<div class="data_label">
 									Degree:
 								</div>
 								<div class="data_values">
 									<?php echo $degreename; ?>
 								</div>
 							</div>
 							<div class="data-row lic_rows_data">
 								<div class="data_label">
 									From:
 								</div>
 								<div class="data_values">
 									<?php echo $schoolName;?>

 								</div>
 							</div>
 							<div class="data-row lic_rows_data">
 								<div class="data_label">
 									Completed in:
 								</div>
 								<div class="data_values">
 									<?php 
 									if($enrolled == 1){
 										echo '(Current Student)';
 									}else{
 										echo $started_month.''.$started_year.'-'.$enddate_month.''.$enddate_year;
 									}
 									?>

 								</div>
 							</div>
 						</div>
 						<div class="col-md-4"></div>
						
					</div>
					
		        </div>
			</div>
			<?php
					$restore = $_GET['restore'];
					if(isset($restore)){
						$postid = $restore;
						$my_post = array(
						'ID'           => $restore,
						'post_status'   => 'publish',
						);
						wp_update_post( $my_post );
						$url = get_site_url().'/profile';
						wp_redirect( $url );
						exit;
					}

					?>

					<?php
						   endwhile;
					     
					   
					    }else{
					    	echo "No found any Archived list.";
					    }
					    wp_reset_postdata(); 
}
?>
<!----------------------------------skills form ---------------------------------->
<?php 
if(is_page(1044)){
					$args = array(  
					    'post_type' => 'skills',
					    'post_status' => 'draft',
					    'author' => $User_Id,
					);
					
				    $loop = new WP_Query( $args ); 
				     if ( $loop->have_posts()  ){  
				     	echo '<ul class="licenses_display_lists display_lists">';
					    while ( $loop->have_posts() ) : $loop->the_post();
							$ehrs = get_field('ehrs' );
							
							$postId = get_the_ID();

							$post_slug = $post->post_name;
								
					 	?>
						<li class="licenses_list list-display">
					 		<div class="rows_lists">
								<span class="row-icon">
								<i class="fal fa-clipboard-check" title="Everything is OK"></i>
								</span>
								<div class="title">
									<div class="lic_state">
										<b><?php echo $ehrs; ?></b>
									</div>
								</div>
								<div class="action-dropdown dropdown">
								<a class="btn btn-primary btn-sm mt-2 mt-sm-0" data-method="put"  href="<?php echo get_site_url();?>/profile/skill-archived/?restore=<?php echo $postId; ?>" rel="nofollow"><span><i class="fal fa-fw fa-box-open"></i> Restore</span></a> 
								</div>					
							</div>
						</li>
					<?php
						$restore = $_GET['restore'];
						if(isset($restore)){
							$postid = $restore;
							$my_post = array(
							'ID'           => $restore,
							'post_status'   => 'publish',
							);
							wp_update_post( $my_post );
							$url = get_site_url().'/profile#addEhrs';
							wp_redirect( $url );
							exit;
						}

					?>

					<?php
						   endwhile;
					     echo '</ul>';
					   
					    }else{
					    	echo "No found any Archived list.";
					    }
					    wp_reset_postdata(); 
}
?>
<!--------------------------------skills checklists------------------------------------------>
<?php
if(is_page(1046)){
					$args = array(  
					    'post_type' => 'skills-checklists',
					    'post_status' => 'draft',
					    'author' => $User_Id,
					);
					
				    $loop = new WP_Query( $args ); 
				     if ( $loop->have_posts()  ){  
				     	
					    while ( $loop->have_posts() ) : $loop->the_post();
							$completed = get_field('completed_date');
							$specciality = get_field('checklists_specialty');

							$postId = get_the_ID();

							$post_slug = $post->post_name;
								
					 	?>
					 	<div class="association-card card mb-3 px-0">
					 		<div class="card-header">
					 			<h6 class="card-header-title">
					 				<b><?php echo $specciality; ?></b> –
					 			</h6>
					 			<a class="btn btn-primary btn-sm mt-2 mt-sm-0" data-method="put"  href="<?php echo get_site_url();?>/profile/checklists-archived/?restore=<?php echo $postId; ?>" rel="nofollow"><span><i class="fal fa-fw fa-box-open"></i> Restore</span></a> 					
					 		</div>
					 		<div class="card-body">
					 			<div class="row">
					 				<div class="col-md-8">
					 					<div class="data-row lic_rows_data">
					 						<div class="data_label">
					 							Completed on
					 						</div>
					 						<div class="data_values">
					 							<?php 
					 							echo $completed;
					 							?>

					 						</div>
					 					</div>
					 				</div>
					 				<div class="col-md-4"></div>

					 			</div>

					 		</div>
					 	</div>
					 	<?php
					 	$restore = $_GET['restore'];
					 	if(isset($restore)){
					 		$postid = $restore;
					 		$my_post = array(
					 			'post_type' => 'skills-checklists',
					 			'ID'           => $restore,
					 			'post_status'   => 'publish',
					 		);
					 		wp_update_post( $my_post );
					 		$url = get_site_url().'/profile#skillChecklists';
					 		wp_redirect( $url );
					 		exit;
					 	}

					 	?>

					 	<?php
					 endwhile;


					}else{
						echo "No found any Archived list.";
					}
					wp_reset_postdata(); 
}
?>
<?php
if(is_page(1047)){
		$args = array(  
		'post_type' => 'additional-documents',
		'post_status' => 'draft',
		'author' => $User_Id,
		);
		  $loop = new WP_Query( $args ); 
				     if ( $loop->have_posts()  ){  
				     	
					    while ( $loop->have_posts() ) : $loop->the_post();
							$documentType = get_field('document_type');
							$documentname = get_field('document_name');
							$documentdesc = get_field('document_description');

							$postId = get_the_ID();

							$post_slug = $post->post_name;
								
					 	?>
					 	<div class="association-card card mb-3 px-0">
					 		<div class="card-header">
					 			<h6 class="card-header-title">
					 				<a href="<?php echo get_site_url();?>/profile/additional-documents/<?php echo $post_slug; ?>"><?php echo $documentname; ?></a>
					 			</h6>
					 			<a class="btn btn-primary btn-sm mt-2 mt-sm-0" data-method="put"  href="<?php echo get_site_url();?>/profile/document-archived/?restore=<?php echo $postId; ?>" rel="nofollow"><span><i class="fal fa-fw fa-box-open"></i> Restore</span></a> 					
					 		</div>
					 		<div class="card-body">
					 			<div class="row">
					 				<div class="col-md-8">
					 					<span class="documenttype"><?php echo $documentType; ?></span>
					 					<div class="data-row lic_rows_data">
					 						<div class="data_label">
					 							Description:
					 						</div>
					 						<div class="data_values">
					 							<?php 
					 							echo $documentdesc;
					 							?>

					 						</div>
					 					</div>
					 				</div>
					 				<div class="col-md-4"></div>

					 			</div>

					 		</div>
					 	</div>
					 	<?php
					 	$restore = $_GET['restore'];
					 	if(isset($restore)){
					 		$postid = $restore;
					 		$my_post = array(
					 			'post_type' => 'additional-documents',
					 			'ID'           => $restore,
					 			'post_status'   => 'publish',
					 		);
					 		wp_update_post( $my_post );
					 		$url = get_site_url().'/profile#additionalDocuments';
					 		wp_redirect( $url );
					 		exit;
					 	}

					 	?>

					 	<?php
					 endwhile;


					}else{
						echo "No found any Archived list.";
					}
					wp_reset_postdata(); 
}
?>
<!--------------------------------------Medical history---------------------------------------------->
<?php if(is_page(1052)){ 
		$args = array(  
		'post_type' => 'medical-history',
		'post_status' => 'draft',
		'author' => $User_Id,
		);
		  $loop = new WP_Query( $args ); 
				     if ( $loop->have_posts()  ){  
				     	
					    while ( $loop->have_posts() ) : $loop->the_post();
							$medicaldate = get_field('medical_date' );

							$postId = get_the_ID();

							$post_slug = $post->post_name;
							$imgs = get_post_meta($postId,'medical_attachment_id',true);
							$meta = explode(',', $imgs);
							if($imgs ){ $count = count($meta); }
					 	?>
	<article id="medical_histories_<?php echo $postId;?>" class="medical-history inactive">
		<div class="fancy-heading">
			<div class="d-flex justify-content-between align-items-start">
				<div class="flex-grow-1">
					<h2 class="flex-heading">
						<span class="font-lightweight">
							Medical History for<br>
							<span class="font-heavyweight">
								<a href="/profile/medical-history/<?php echo $post_slug; ?>"></a>
							</span>
						</span>
					</h2>
					<div class="metadata">
						Obtained on <?php echo $medicaldate; ?>
					</div>
				</div>
				<a class="btn btn-primary btn-sm"  data-method="put" href="/profile/medical-history-archived/?restore=<?php echo $postId; ?>" rel="nofollow"><span><i class="fal fa-fw fa-box-open"></i> Restore</span></a>
			</div>
		</div>

		<section class="profile-section">
			<h2 class="legend">Expirations</h2>

			<ul class="display-list">

				<li class="display-list-item" style="padding-left: 0; padding-right: 0;">
					<div class="alert alert-info flex-grow-1">
						<i class="fad fa-info-circle"></i>
						<span class="alert-content">No expirations have been set by any employers.</span>
					</div>
				</li>

			</ul>

			<h2>
				<span>Attachments</span>
			</h2>

					<ul class="lists_img">
						<?php
						foreach ($meta as $metas) {

						$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
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
		</section>
	</article>
	<?php
	$restore = $_GET['restore'];
	if(isset($restore)){
		$postid = $restore;
		$my_post = array(
			'post_type' => 'medical-history',
			'ID'           => $restore,
			'post_status'   => 'publish',
		);
		wp_update_post( $my_post );
		$url = get_site_url().'/profile';
		wp_redirect( $url );
		exit;
	}

	?>

	<?php
	endwhile;


	}else{
	echo "No found any Archived list.";
	}
	wp_reset_postdata(); 
} ?>
<!--------------------------------------Work history---------------------------------------------->
<?php if(is_page(1050)){ 

	$args = array(  
		'post_type' => 'work-history',
		'post_status' => 'publish',
		'author' => $User_Id,
	);
	$args2 = array(  
		'post_type' => 'work-history-gap',
		'post_status' => 'publish',
		'author' => $User_Id,
	);
	$loop = new WP_Query( $args2 ); 
	if ( $loop->have_posts()  ){  
		
		while ( $loop->have_posts() ) : $loop->the_post();
			$postId = get_the_ID();
			$post_slug = $post->post_name;

				$gap_reson = get_field('gap_reson');
				$gap_additional_comments = get_field('gap_additional_comments');
				$gap_city = get_field('gap_city');
				$gap_state = get_field('gap_state');
				$gap_started_M = get_field('gap_started_M');
				$gap_started_Y = get_field('gap_started_Y');
				$gap_ended_M = get_field('gap_ended_M');
				$gap_ended_Y = get_field('gap_ended_Y');
			?>
		<div class="association-card card mt-3">
			<div class="card-header">
				<h6 class="card-header-title">
					<a href="/profile/work-history-gap/<?php echo $post_slug; ?>"><?php echo $gap_reson; ?></a>
				</h6>
				<a class="btn btn-primary btn-sm mt-2 mt-sm-0" data-method="put"href="/profile/work-history-archived/?restore=<?php echo $postId;?>" rel="nofollow"><span><i class="fal fa-fw fa-box-open"></i> Restore</span></a>
			</div>

			<div class="card-body">
				<div class="d-flex flex-row">
					<div class="flex-grow-1">
						<div class="data-row"><div class="data-column"><span class="data-label">Dates Employed:</span><span class="data-value"><?php echo $gap_started_M.' '.$gap_started_Y.' — '.$gap_ended_M.' '.$gap_ended_Y; ?></span></div></div>
					</div>
				</div>
			</div>
		</div>
		<?php
		$restore = $_GET['restore'];
		if(isset($restore)){
		$postid = $restore;
		$my_post = array(
		'post_type' => 'work-history-gap',
		'ID'           => $restore,
		'post_status'   => 'publish',
		);
		wp_update_post( $my_post );
		$url = get_site_url().'/profile';
		wp_redirect( $url );
		exit;
		}

		?>
	<?php
	endwhile;
	}
	?>
	<?php
	$loop = new WP_Query( $args ); 
	if ( $loop->have_posts()  ){  	
		while ( $loop->have_posts() ) : $loop->the_post();
			$faclityname = get_field('facility_name');
			$spanddept = get_field('work_specialty_department');
			$workcity = get_field('work_city');
			$workstate = get_field('work_state');
			$workprofession = get_field('work_profession');
			$workstartedM = get_field('work_started_on_month');
			$workstrtedY = get_field('work_started_on_year');
			$workendM = get_field('work_ended_on_month');
			$workendY = get_field('work_ended_on_year');
			$currentywork = get_field('work_currently_here');
			$faciltytype = get_field('work_type_Ag_fc');
			$emplymenttype = get_field('work_employment_type');
			$chargeexp = get_field('work_charge_experience');
			$unitbed = get_field('unit_bed_count');
			$niculevel = get_field('nicu_level');
			$tarumalevel = get_field('trauma_level');
			$techhospital = get_field('teaching_hospital');
			$critcalacess = get_field('critical_access_hospital');
			$patientratio = get_field('patient_ratio');
			$ehrused = get_field('work_ehr_used');
			$additioncomments = get_field('additional_notes_and_comments');
			$staffingagency = get_field('work_staffing_agency');

			$postId = get_the_ID();
			$post_slug = $post->post_name;

			
			?>
		<div class="association-card card mt-3">
			<div class="card-header">
				<h6 class="card-header-title">
					<a href="/profile/work-history/<?php echo $post_slug; ?>"><?php
									echo get_the_title(); ?></a>
				</h6>
				<a class="btn btn-primary btn-sm mt-2 mt-sm-0" href="/profile/work-history-archived?restore=<?php echo $postId; ?>" rel="nofollow"><span><i class="fal fa-fw fa-box-open"></i> Restore</span></a>
			</div>
			<div class="card-body">
				<div class="d-flex flex-row">
					<div class="flex-grow-1">
						<div class="data-row"><div class="data-column"><span class="data-label">Department:</span><span class="data-value"><?php echo $spanddept; ?></span></div></div>
						<div class="data-row"><div class="data-column"><span class="data-label">Profession:</span><span class="data-value"><?php echo $workprofession; ?></span></div></div>
						<div class="data-row"><div class="data-column"><span class="data-label">Employed By:</span><span class="data-value"> <?php if($faciltytype == 'Facility'){ ?>
							<?php echo $faclityname; ?> (<?php echo $faciltytype; ?>)
						<?php }else if($faciltytype == 'Agency'){ ?>
							<?php echo $staffingagency; ?> (<?php echo $faciltytype; ?>)
						<?php } ?>
						</span></div></div>
						<div class="data-row"><div class="data-column"><span class="data-label">Employment Type:</span><span class="data-value"><?php if($$emplymenttype){echo $emplymenttype;}else{ echo '—';} ?></span></div></div>
						<div class="data-row"><div class="data-column"><span class="data-label">Dates Employed:</span><span class="data-value"><?php echo $workstartedM.' '.$workstrtedY; ?> — <?php if($currentywork == 1){echo 'Present';}else{ echo $workendM.' '.$workendY;  } ?></span></div></div>
					</div>
				</div>
			</div>
		</div>
	<?php
	$restore = $_GET['restore'];
	if(isset($restore)){
	$postid = $restore;
	$my_post = array(
	'post_type' => 'work-history',
	'ID'           => $restore,
	'post_status'   => 'publish',
	);
	wp_update_post( $my_post );
	$url = get_site_url().'/profile';
	wp_redirect( $url );
	exit;
	}

	?>

	<?php
	endwhile;


	}else{
	echo "No found any Archived list.";
	}
	wp_reset_postdata(); 
	?>
<?php } ?>
<!--------------------------------------References---------------------------------------------->
<?php if(is_page(1053)){ 

	$args = array(  
		'post_type' => 'references',
		'post_status' => 'draft',
		'author' => $User_Id,
	);

	$loop = new WP_Query( $args ); 
	if ( $loop->have_posts()  ){  
		echo '<ul class="refrences_display_lists display_lists">';
		while ( $loop->have_posts() ) : $loop->the_post();
			$enrolled = get_field('currently_enrolled');

			$postId = get_the_ID();
			$post_slug = $post->post_name;

			$refrencename = get_field('references_name');
			$refrenceposition = get_field('references_position');
			$refrenceEmail = get_field('references_email');
			$refrencePhone = get_field('references_phone_number');
			$refrenceWorkentery = get_field('references_work_entery');
			$reverencesknown = get_field('references_known');
			$imgs = get_post_meta($postId,'refrences_attachment_id',true);
			$meta = explode(',', $imgs);

			if($imgs ){ $count = count($meta); }
			?>
			<div class="association-card card mb-3">
			<div class="card-header">
				<h6 class="card-header-title">
			<a href="/profile/references/<?php echo $post_slug; ?>"><?php echo $refrencename; ?></a>
				</h6>
			<a class="btn btn-primary btn-sm mt-2 mt-sm-0" href="/profile/references-archived?restore=<?php echo $postId; ?>" rel="nofollow"><span><i class="fal fa-fw fa-box-open"></i> Restore</span></a>
			</div>
			<div class="card-body">
				<div class="d-flex flex-row">
				<div class="flex-grow-1">
					<h6 class="card-title">
						References Name:
					</h6>
					<h5 class="card-subtitle mb-3">
						<?php echo $refrencename; ?>
					</h5>
					
					<br>
			    <div class="data-row">
					<div class="data-column">
						<span class="data-label">
							Contact Position:
						</span>
						<span class="data-value">
							<?php echo $refrenceposition; ?>
						</span>
					</div>
				</div>
			     <div class="data-row">
					 <div class="data-column">
						 <span class="data-label">
							 Can be emailed at:
						</span>
						<span class="data-value">
							<a href="mailto:<?php echo $refrenceEmail; ?>">
							 <?php echo $refrenceEmail; ?>
							</a>
						</span>
						</div>
					</div>
					<div class="data-row">
					 <div class="data-column">
						 <span class="data-label">
							References Known:
						</span>
						<span class="data-value">
							 <?php echo $reverencesknown; ?>
						</span>
						</div>
					</div>
				</div>
				</div>
			</div>
			</div>
			<?php
			$restore = $_GET['restore'];
			if(isset($restore)){
			$postid = $restore;
			$my_post = array(
			'post_type' => 'references',
			'ID'           => $restore,
			'post_status'   => 'publish',
			);
			wp_update_post( $my_post );
			$url = get_site_url().'/profile';
			wp_redirect( $url );
			exit;
			}

			?>

	<?php
	endwhile;


	}else{
	echo "No found any Archived list.";
	}
	wp_reset_postdata(); 
	
	?>
<?php }?>
<!--------------------------------------Military---------------------------------------------->
<?php if(is_page(1731)){ 
				$args = array(  
				'post_type' => 'military',
				'post_status' => 'draft',
				'author' => $User_Id,
				);
					$loop = new WP_Query( $args ); 
					if ( $loop->have_posts()  ){  

					while ( $loop->have_posts() ) : $loop->the_post();
					$militaryHistory = get_field('military_history');

					$postId = get_the_ID();

					$post_slug = $post->post_name;
					$imgs = get_post_meta($postId,'military_attachment_id',true);
					$meta = explode(',', $imgs);
					if($imgs ){ $count = count($meta); }
				?>
				<article id="military_histories_<?php echo $postId;?>" class="military-history inactive">
					<!--div class="fancy-heading">
							<div class="d-flex justify-content-between align-items-start">
								<div class="flex-grow-1">
									<h2 class="flex-heading">
										<span class="font-lightweight">
											Military History for<br>
											<span class="font-heavyweight">
												<?php //echo $militaryHistory; ?>
											</span>
										</span>
									</h2>
									
								</div>
								<a class="btn btn-primary btn-sm"  data-method="put" href="/profile/military-archived/?restore=<?php echo $postId; ?>" rel="nofollow"><span><i class="fal fa-fw fa-box-open"></i> Restore</span></a>
							</div>
					</div-->
					 <div class="association-card card mb-3">
			<div class="card-header">
				<h6 class="card-header-title"><b>Military History for</b> -
                             <a href="/profile/"><?php echo $militaryHistory; ?></a>
											
										
				</h6>
			<a class="btn btn-primary btn-sm mt-2 mt-sm-0" href="/profile/military-archived?restore=<?php echo $postId; ?>" rel="nofollow"><span><i class="fal fa-fw fa-box-open"></i> Restore</span></a>
			</div>
		</div>
				</article>
			<?php
			$restore = $_GET['restore'];
			if(isset($restore)){
				$postid = $restore;
				$my_post = array(
					'post_type' => 'military',
					'ID'           => $restore,
					'post_status'   => 'publish',
				);
				wp_update_post( $my_post );
				$url = get_site_url().'/profile';
				wp_redirect( $url );
				exit;
			}

			?>

			<?php
			endwhile;


			}else{
			echo "No found any Archived list.";
			}
			wp_reset_postdata();  
			
			} ?>	
<!--------------------------------------Insurance---------------------------------------------->
<?php if(is_page(1735)){ 
				$args = array(  
				'post_type' => 'insurance',
				'post_status' => 'draft',
				'author' => $User_Id,
				);
					$loop = new WP_Query( $args ); 
					if ( $loop->have_posts()  ){  

					while ( $loop->have_posts() ) : $loop->the_post();
					$liability_lists = get_field('liability_insurance');

					$insucompany = get_field('insurance_company');
					$insuaddress = get_field('address_insurance');
					$insuphnnumber = get_field('insurance_phone_number');
					$started_month = get_field('insurance_started_month');
					$started_year = get_field('insurance_started_year');
					$enddate_month = get_field('insurance_ended_month');
					$enddate_year = get_field('insurance_ended_year');

					$postId = get_the_ID();
                 
					$post_slug = $post->post_name;
					$imgs = get_post_meta($postId,'insurance_attachment_id',true);
					$meta = explode(',', $imgs);
					if($imgs ){ $count = count($meta); }
				?>
				<article id="insurance_<?php echo $postId;?>" class="insurance inactive">

             <div class="association-card card mb-3">
			<div class="card-header">
				<h6 class="card-header-title"><b>Professional liability insurance</b> -
                             <a href="/profile/"><?php echo $liability_lists; ?></a>
											
										
				</h6>
			<a class="btn btn-primary btn-sm mt-2 mt-sm-0" href="/profile/insurance-archived?restore=<?php echo $postId; ?>" rel="nofollow"><span><i class="fal fa-fw fa-box-open"></i> Restore</span></a>
			</div>

					<!--div class="fancy-heading">
							<div class="d-flex justify-content-between align-items-start">
								<div class="flex-grow-1">
									<h2 class="flex-heading">
										<span class="font-lightweight">
										  Professional liability insurance:<br>
											<span class="font-heavyweight">
												<?php //echo $liability_lists; ?>
											</span>
										</span>
									</h2>
									
								</div>
								<a class="btn btn-primary btn-sm"  data-method="put" href="/profile/insurance-archived/?restore=<?php echo $postId; ?>" rel="nofollow"><span><i class="fal fa-fw fa-box-open"></i> Restore</span></a>
							</div>
					</div-->
					<div class="card-body">
						<div class="d-flex flex-row">
							<div class="flex-grow-1">
							    <div class="data-row">
									<div class="data-column">
										<span class="data-label">
											Insurance Company:
										</span>
										<span class="data-value">
											<?php echo $insucompany; ?>
										</span>
									</div>

								</div>
								  <div class="data-row">
									<div class="data-column">
										<span class="data-label">
											Address:
										</span>
										<span class="data-value">
											<?php echo $insuaddress; ?>
										</span>
									</div>
									
								</div>
								  <div class="data-row">
									<div class="data-column">
										<span class="data-label">
											Phone Number:
										</span>
										<span class="data-value">
											<?php echo $insuphnnumber; ?>
										</span>
									</div>
									
								</div>
								<div class="data-row">
									<div class="data-column">
										<span class="data-label">
											Insurance Date:
										</span>
										<span class="data-value">
											<?php echo $started_month.' '.$started_year.' - '.$enddate_month.' '.$enddate_year; ?>
										</span>
									</div>
									
								</div>
							</div>
						</div>
					</div>
                   </div>
				</article>
			<?php
			$restore = $_GET['restore'];
			if(isset($restore)){
				$postid = $restore;
				$my_post = array(
					'post_type' => 'insurance',
					'ID'           => $restore,
					'post_status'   => 'publish',
				);
				wp_update_post( $my_post );
				$url = get_site_url().'/profile';
				wp_redirect( $url );
				exit;
			}

			?>

			<?php
			endwhile;


			}else{
			echo "No found any Archived list.";
			}
			wp_reset_postdata();  
			
			} ?>
<!-----------------------------------Case logs------------------------------->


<?php if(is_page(2598)){ 
				$args = array(  
				'post_type' => 'case-logs',
				'post_status' => 'draft',
				'author' => $User_Id,
				);
					$loop = new WP_Query( $args ); 
					if ( $loop->have_posts()  ){  

					while ( $loop->have_posts() ) : $loop->the_post();
					

					$postId = get_the_ID();                
					$post_slug = $post->post_name;

					$fcname = get_field('facility_name_case');
					$agecase = get_field('age_case');
					$gendercase = get_field('gender_case');
					$phystatus = get_field('physical_status_case');
					$traumaemg = get_field('traumaemergency_case');
					$clinicalnot = get_field('clinical_notes_case');
					$peripheral = get_field('peripheral_case');
					$imgs = get_post_meta($postId,'caselogs_attachment_id',true);
					$meta = explode(',', $imgs);

					if($imgs ){ $count = count($meta); }

					$AnesthesiaTypevalues = get_post_meta($postId,'AnesthesiaType_data',true);
					$administartionvalues = get_post_meta($postId,'administration_data',true);
					$Proceduresvalues = get_post_meta($postId,'AnesthesiaProcedures_data',true);
					$AnatomicalCategoryvalues = get_post_meta($postId,'AnatomicalCategory_data',true);

					$va1 = explode(',', $AnesthesiaTypevalues);
					$va2 = explode(',', $administartionvalues);
					$va3 = explode(',', $Proceduresvalues);
					$va4 = explode(',', $AnatomicalCategoryvalues);

				?>
				<article id="caselogs_<?php echo $postId;?>" class="insurance inactive">		
					<div class="association-card card mb-3">
						<div class="card-header">
							<h6 class="card-header-title"><b>Case Logs</b> -
								<a href="<?php echo get_site_url(); ?>/profile/"> <?php echo $fcname; ?></a>					
							</h6>
							<a class="btn btn-primary btn-sm mt-2 mt-sm-0" href="/profile/case-logs-archived?restore=<?php echo $postId; ?>" rel="nofollow"><span><i class="fal fa-fw fa-box-open"></i> Restore</span></a>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="data-row lic_rows_data">
									<div class="data_label">
										Facility Name:
									</div>
									<div class="data_values">
									<?php echo $fcname; ?>
									</div>
								</div>
								<div class="data-row lic_rows_data">
									<div class="data_label">
										Age:
									</div>
									<div class="data_values">
									<?php echo $agecase; ?>
									</div>
								</div>
								<div class="data-row lic_rows_data">
									<div class="data_label">
										Gender:
									</div>
									<div class="data_values">
									<?php echo $gendercase; ?>
									</div>
								</div>
								<div class="data-row lic_rows_data">
									<div class="data_label">
										Physcial Status:
									</div>
									<div class="data_values">
									<?php echo $phystatus; ?>
									</div>
								</div>
								<div class="data-row lic_rows_data">
									<div class="data_label">
										Trauma/Emergency:
									</div>
									<div class="data_values">
									<?php echo $traumaemg; ?>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="data-row lic_rows_data">
									<div class="data_labels">
										<b> Anesthesia Type:</b>

									<ul>
										<?php foreach($va1 as $antype){
											echo '<li>'.$antype.'</li>';
										} ?>
									</ul>
									</div>
								</div>
								<div class="data-row lic_rows_data">
									<div class="data_labels">
										<b>Administration:</b>

									<ul>
										<?php foreach($va2 as $admin){
											echo '<li>'.$admin.'</li>';
										} ?>
									</ul>
									</div>
								</div>
								<div class="data-row lic_rows_data">
									<div class="data_labels">
										<b>Anesthesia Procedures:</b>

									<ul>
										<?php foreach($va3 as $anpro){
											echo '<li>'.$anpro.'</li>';
										} ?>
									</ul>
									</div>
								</div>
								<div class="data-row lic_rows_data">
									<div class="data_labels">
										<b>Anatomical Category:</b>

										<ul>
											<?php foreach($va4 as $ancat){
												echo '<li>'.$ancat.'</li>';
											} ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</article>
			<?php
			$restore = $_GET['restore'];
			if(isset($restore)){
				$postid = $restore;
				$my_post = array(
					'post_type' => 'insurance',
					'ID'           => $restore,
					'post_status'   => 'publish',
				);
				wp_update_post( $my_post );
				$url = get_site_url().'/profile';
				wp_redirect( $url );
				exit;
			}

			?>

			<?php
			endwhile;


			}else{
			echo "No found any Archived list.";
			}
			wp_reset_postdata();  
			
			} ?>

<!--------------------------------------End Archived---------------------------------------------->
		</div>
	</div>
</div>

<?php
get_footer('dashboard');
}else{
	header('Location: ' . get_permalink(1310));
}
?>

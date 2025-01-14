<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-9ZfPnbegQSumzaE7mks2IYgHoayLtuto3AS6ieArECeaR8nCfliJVuLh/GaQ1gyM" crossorigin="anonymous">

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/assest/css/custom.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>	

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<?php
/*
* Template Name: Shared Perview
*/
//$uid = get_current_user_id();
$shid = $_GET['shid'];
if($shid){

}else if($shid == ''){
	wp_redirect(home_url()); 
	exit;	
}
if ( 'publish' == get_post_status ( $shid ) ) {        
$post = get_post( $shid );
$uid = $post->post_author;
$current_user = wp_get_current_user();

$first_name = get_user_meta($uid,'first_name',true);
$last_name =  get_user_meta($uid,'last_name',true);
$fullname = $first_name.' '.$last_name;
$users = get_userdata( $uid );
$email = $users->user_email;


$role = $users->roles;

$author_avatar = get_user_meta($uid,'wp_user_avatar',true);
$authoravatar_url = wp_get_attachment_url( $author_avatar );

$userid_filed = 'user_'.$uid;
$specciality = get_field('specialty', $userid_filed);

$phoneno = get_field('phone_no',$userid_filed);

$yearExp = get_field('year_of_experience',$userid_filed);

$DOB = get_field('date_of_birth',$userid_filed);
$ssn = get_field('ssn',$userid_filed);
$npi = get_field('npi_number',$userid_filed);
$dea = get_field('dea_number',$userid_filed);
$medicare = get_field('medicare',$userid_filed);

$gender = get_field('gender_identity',$userid_filed);


// $postId = $post->ID;

//Emergency Contact..
$emg_contact_name = get_field('emergency_contact_name',$userid_filed);
$emg_contact_phone = get_field('emergency_contact_phone',$userid_filed);
$emg_contact_relationship = get_field('emergency_contact_relationship',$userid_filed);

//Home address
$userstreet = get_field('streetapt',$userid_filed);
$usercity = get_field('city',$userid_filed);
$userstate = get_field('state',$userid_filed);
$userzipcode = get_field('zip_code',$userid_filed);

//Background and Work Auth.
$bgML = get_field('medical_licenses',$userid_filed);
$bgaddExplian = get_field('add_an_explanation',$userid_filed);
$bgaction = get_field('professional_liability_action',$userid_filed);
$bgaddExplian2 = get_field('you_can_add_an_explanation',$userid_filed);
$bgUS = get_field('the_united_states',$userid_filed);
$bgaddExplian3 = get_field('if_not_explanation',$userid_filed);


$shareoverview = get_field('share_level_overview',$shid);
$sharefull = get_field('share_level_full',$shid);

?>
<div class="content shared-perview pt-5 pb-5">
	<div class="container p-4">
		<div class="row profile-page overview">
			<div class="d-none" id="<?php echo $shid; ?>"></div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-3">
						<!--------------User profile section------------->
						<div class="userprofile_img  text-center">
							<?php if($author_avatar){
								?>
								<img class="rounded-circle" src="<?php echo $authoravatar_url; ?>" width="100%"/>
								<?php
								}
								else
								{
								?>
								<i class="fad fa-user-circle circle noavatar w-100 rounded-circle"></i>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-7">
						<div class="username_full">
							<h1 class="myname"><?php echo $fullname; ?></h1>
						</div>
						<div class="roll-and-specialty">
							<div class="profession">
								<?php echo $role[0]; ?>
								<span class="d-none d-sm-inline">| </span>
								<br class="d-sm-none">
								<?php echo $specciality; ?>
							</div>
						</div>
						<div class="yearexp mt-2">
							<h5>Years of Experience: <?php echo $yearExp;?></h5>
						</div>
					</div>
				</div>	
			</div>
			<!--------------end User profile section------------->
			<div class="col-md-4">

				<a href="<?php echo get_site_url(); ?>/profile/share/#mails_ids_<?php echo $shid; ?>" class="access-level" data-toggle="modal">
					<i class="fal fa-lock-alt fa-fw"></i>
					Access Level: <span class="access-level-value"><?php if($shareoverview){ echo 'Overview'; }else if($sharefull){ echo 'Full';} ?></span>
				</a>
			</div>
			<div class="col-12 toolbar mt-5 mb-5">
				<?php if($shareoverview){ echo ''; }else { ?> 
				<a class="btn btn-primary resume_btn mt-2" href="<?php bloginfo('stylesheet_directory') ?>/pdf/pdfcode.php?uID=<?php echo $uid; ?>" target="_blank">
				<i class="fal fa-fw fa-file-pdf"></i>
				Download Resume
				</a>
				<?php  }?>
			</div>

			<div class="profile-relationships col-12">
				<!--------------license section------------->
						<section id="license" class="profile-section">
							<h2>Licenses</h2>
							<?php
							$args = array(  
								'post_type' => 'licenses',
								'post_status' => 'publish',
								'posts_per_page' => -1,
								'author' => $uid,
								'meta_query' => array(
									'relation' => 'OR',
									'postSorting' => array(
										'key' => 'postSorting',
										'compare' => 'EXISTS',
									),
									'postSorting2' => array(
										'key' => 'postSorting',
										'compare' => 'NOT EXISTS',
									), 
								
								
								),
								'orderby' => 'postSorting',
								'order' => 'ASC',
							);
							
							$loop = new WP_Query( $args ); 
							if ( $loop->have_posts()  ){  
								echo '<ul class="licenses_display_lists display_lists">';
								while ( $loop->have_posts() ) : $loop->the_post();
									$postId = get_the_ID();
									$imgs = get_post_meta($postId,'license_attachment_id',true);
									$meta_lc = explode(',', $imgs);
									
									if($imgs ){ $count = count($meta_lc); }
									$post_slug = $post->post_name;

									$lccompact = get_field('licenses_compact');

									if($lccompact == 1){
										$val_compact = 'Yes';
									}else{
										$val_compact = 'No';
									}	
									?>
									<li class="licenses_list list-display">
										<div class="rows_lists">

											<span class="row-icon">
												<i class="fal fa-clipboard-check" title="Everything is OK"></i>
											</span>
											<div class="flex-grow-1">
												<div class="row">
													<div class="col-12 col-md-6">
														<strong class="font-heavyweight">
															<?php echo get_field('licenses_state'); ?>
														</strong>
													</div>
													<div class="col-12 col-md-6">
														<div class="license-type font-heavyweight">
															<strong><?php echo get_field('licenses_type'); ?></strong>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12 col-md-6 secondary">
														<div class="license-number">
															License Number: <?php echo get_field('licenses_number'); ?>
														</div>
													</div>
													<div class="col-12 col-md-6">
														<div class="expires-on">
															Expires: <?php echo get_field('expire_date'); ?>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-12 col-md-6 secondary">
														<div class="issue_date">
															Issue Date: <?php echo get_field('issue_date'); ?>
														</div>
													</div>
													
												</div>
												<div class="row">
													<div class="col-12 col-md-6 secondary">
														<div class="compacture">
															Compact: <?php echo $val_compact; ?>
														</div>
													</div>
													<?php if($shareoverview){ ?>
														<div class="col-12 col-md-6">
															<?php if($imgs) { ?> Attachments: <?php echo $count; ?> <?php }else{ echo 'Attachments: 0'; } ?>
														</div>
													<?php }else if($sharefull){ ?>
													<div class="row">
														<div class="col-12">
															<ul class="display-list">
																<?php 
																if($imgs){
															
																foreach ($meta_lc as $metas_lc) {

																$attch_name = basename( get_attached_file( $metas_lc ) ); // Just the file name;
																$attach_url = wp_get_attachment_url(  $metas_lc );
																//$count = count($metas);
																if($attch_name){
																	$loopattach = '<li class="display-list-item attachment-item">
																		<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																		'.$attch_name.'
																		</a>
																	</li>';
																}
																echo $loopattach;

															} 		
														}?>
															</ul>
														</div>
													</div>
												<?php } ?>
												</div>
												
												
											</div>	
										</div>						 		
									</li>
									<?php
								endwhile;

								echo '</ul>';
							}else{
								echo "Let's add some licenses.";
							}
							wp_reset_postdata(); 
							?>
						</section>
				<!--------------certifications section------------->		
						<section id="certifications" class="profile-section">
								<h2>Certifications</h2>
								<?php
								$args = array(  
									'post_type' => 'certifications',
									'post_status' => 'publish',
									'posts_per_page' => -1,
									'author' => $uid,
									'meta_query' => array(
										'relation' => 'OR',
										'postSorting' => array(
											'key' => 'postSorting',
											'compare' => 'EXISTS',
										),
										'postSorting2' => array(
											'key' => 'postSorting',
											'compare' => 'NOT EXISTS',
										), 
									
									
									),
									'orderby' => 'postSorting',
									'order' => 'ASC',
								);

								$loop = new WP_Query( $args ); 
								if ( $loop->have_posts()  ){  
								echo '<ul class="certificate_display_lists display_lists">';
								while ( $loop->have_posts() ) : $loop->the_post();
									$cert_type = get_field('certificate_type');
									$cert_number = get_field('certification_number');
									$cert_expire = get_field('certificate_expire_date');
									$postId = get_the_ID();
									$imgs = get_post_meta($postId,'certificate_attachment_id',true);
									$otherNam = get_field('otherNam');
									$meta_cr = explode(',', $imgs);

									if($imgs ){ $count = count($meta_cr); }
									$post_slug = $post->post_name;

									?>
									<li class="certificate_list list-display">
										<div class="rows_lists d-flex">

											<span class="row-icon me-2">
												<i class="fal fa-clipboard-check" title="Everything is OK"></i>
											</span>

											<div class="flex-grow-1">
												<div class="row">
													<div class="col-12">
														<span class="font-heavyweight">
															<strong><?php echo get_field('certificate_hidden'); ?></strong>
														</span>

														<span class="font-normal d-block d-md-inline">
															<span class="d-none d-md-inline">—</span>
                                                           
															<?php 
															if( !empty($otherNam) || $otherNam != '' ){echo $cert_type.' ('.$otherNam.')';
															}else { echo $cert_type; }
															 
															?>
															
															
															
														</span>

													</div>
												</div>

												<div class="row">
													<div class="col-12 secondary">
														<div class="certification-number">
															Certification Number: <?php echo $cert_number; ?>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12 secondary">

														<div class="expires-on">
															Expires: <?php echo $cert_expire; ?>
														</div>

													</div>
												</div>

												<?php if($shareoverview){ ?>
													<div class="row">
														<div class="col-12 col-md-6">
															<?php if($imgs) {?>Attachments: <?php echo $count; ?> <?php }else{ echo 'Attachments: 0'; } ?>
														</div>
													</div>
												<?php }else if($sharefull){ ?>
												<div class="row">
													<div class="col-12">
														<ul class="display-list">
															<?php 
															if($imgs){
															foreach ($meta_cr as $metas_cr) {

															$attch_name = basename( get_attached_file($metas_cr ) ); // Just the file name;
															$attach_url = wp_get_attachment_url( $metas_cr );
															//$count = count($metas);
															if($attch_name){
																$loopattach = '<li class="display-list-item attachment-item">
																	<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																	'.$attch_name.'
																	</a>
																</li>';
															}
															echo $loopattach;

															}} ?>
														</ul>
													</div>
												</div>
												<?php }?>
											</div>
												

										</div>
									</li>

							<?php
							endwhile;

							echo '</ul>';
							}else{
							echo "Let's add some certificates.";
							}
							wp_reset_postdata(); 
							?>
						</section>
				<!--------------education section------------->		
						<section id="education" class="profile-section">
							<h2>Education</h2>
							<?php
							$index = $index+1;
							$args = array(  
							'post_type' => 'education',
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'author' => $uid,
							'meta_query' => array(
								'relation' => 'OR',
								'postSorting' => array(
									'key' => 'postSorting',
									'compare' => 'EXISTS',
								),
								'postSorting2' => array(
									'key' => 'postSorting',
									'compare' => 'NOT EXISTS',
								), 
							
							
							),
							'orderby' => 'postSorting',
							'order' => 'ASC',
							);

							$loop = new WP_Query( $args ); 
							if ( $loop->have_posts()  ){  
								echo '<ul class="education_display_lists display_lists">';
									while ( $loop->have_posts() ) : $loop->the_post();
									
									$degreetype = get_field('degree_type' );
									$degreename = get_field('name_of_the_degree');
									$schoolName = get_field('name_of_school');
									$degreeaddress = get_field('address_of_school');
									$degreesub = get_field('add_subject');
									$started_month = get_field('started_month');
									$started_year = get_field('started_year');
									$enddate_month = get_field('graduation_month');
									$enddate_year = get_field('graduation_year');
									$enrolled = get_field('currently_enrolled');

									$postId = get_the_ID();
									$post_slug = $post->post_name;
									$imgs = get_post_meta($postId,'education_attachment_id',true);
									$meta_ed = explode(',', $imgs);
									
									if($imgs ){ $count = count($meta_ed); }

								?>
								<li class="education_list list-display">
									<div class="rows_lists d-flex">

										<span class="row-icon me-2">
											<i class="fal fa-clipboard-check" title="Everything is OK"></i>
										</span>
											<div class="flex-grow-1">
												<div class="row">
												<div class="col-12">
													<span class="font-heavyweight">
														<strong><?php echo $degreetype; ?></strong>
													</span>
												</div>
												</div>

												<div class="row">
												<div class="col-12 col-md-6">
													<div class="degree-type">
													Degree Earned:<?php echo $degreename; ?>
													</div>
												</div>
												<div class="col-12 col-md-6">
													<span>
														<?php echo $schoolName; ?>
													</span>
												</div>
												</div>

												<div class="row">
												<div class="col-12 col-md-6">
													<div class="degree-type">
													Address Of School:<?php echo $degreeaddress; ?>
													</div>
												</div>
												<div class="col-12 col-md-6">
													<div class="degree-type">
														Like Subject: <?php echo $degreeasub; ?>
													</div>
												</div>
												</div>
												<div class="row">
													<div class="col-12 col-md-6">
													<div class="degree-type">
														Degree Type: <?php echo $degreetype; ?>
													</div>
													</div>

													<div class="col-12 col-md-6">
													<div class="year-completed">
														<span>
															<?php
															if($enrolled == 1){
															echo '(Current Student)';
															}else{
															echo $started_month.''.$started_year.'-'.$enddate_month.''.$enddate_year;
															}
															?>
														</span>
													</div>
													</div>
												</div>
												<?php if($shareoverview){ ?>
														<div class="col-12 col-md-6">
															<?php if($imgs) { ?> Attachments: <?php echo $count; ?> <?php }else{ echo 'Attachments: 0'; } ?>
														</div>
													<?php }else if($sharefull){ ?>
												
														<div class="col-12 col-md-6">
															<ul class="display-list">
																<?php 
																if($imgs){
																foreach ($meta_ed as $metas_ed) {

																$attch_name = basename( get_attached_file($metas_ed ) ); // Just the file name;
																$attach_url = wp_get_attachment_url( $metas_ed );
																//$count = count($metas);
																if($attch_name){
																	$loopattach = '<li class="display-list-item attachment-item">
																		<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																		'.$attch_name.'
																		</a>
																	</li>';
																}
																echo $loopattach;

															} }?>
															</ul>
														</div>
													
												<?php } ?>			
												</div>
											</div>
										</li>	
										<?php
									endwhile;

									echo '</ul>';
								}else{
									echo "You studied hard. You earned your degree. Time to flaunt it!";
								}
								wp_reset_postdata(); 
								?>
						</section>
				<!--------------work_history section------------->			
						<section id="work_history" class="profile-section">
							<h2>Work History</h2>
							<?php
							$args = array(  
							'post_type' => 'work-history',
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'author' => $uid,
							'meta_query' => array(
								'relation' => 'OR',
								'postSorting' => array(
									'key' => 'postSorting',
									'compare' => 'EXISTS',
								),
								'postSorting2' => array(
									'key' => 'postSorting',
									'compare' => 'NOT EXISTS',
								), 
							
							
							),
							'orderby' => 'postSorting',
							'order' => 'ASC',
							);
							$args2 = array(  
							'post_type' => 'work-history-gap',
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'author' => $uid,
							'meta_query' => array(
								'relation' => 'OR',
								'postSorting' => array(
									'key' => 'postSorting',
									'compare' => 'EXISTS',
								),
								'postSorting2' => array(
									'key' => 'postSorting',
									'compare' => 'NOT EXISTS',
								), 
							
							
							),
							'orderby' => 'postSorting',
							'order' => 'ASC',
							);
							echo '<ul class="education_display_lists display_lists">';
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
							

							<li class="education_list list-display" id="workentery_id_<?php echo $postId; ?>">
								<div class="rows_lists d-flex">
									<span class="row-icon">
									<i class="fal fa-fw fa-calendar"></i>
									</span>

									<div class="flex-grow-1">
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="font-heavyweight">
													<?php echo $gap_reson; ?>
												</div>

												<div class="location">
													<?php echo $gap_city; ?>, <?php echo $gap_state; ?>
												</div>
												<div>
													<strong class="font-heavyweight date-range">
														<?php echo $gap_started_M.' '.$gap_started_Y.' — '.$gap_ended_M.' '.$gap_ended_Y; ?>
													</strong>
												</div>
											</div>

											
										</div>

										<div class="row my-3">
											<div class="col-12">
												<em class="employment-type d-block text-muted">
												Explanation: <?php echo $gap_additional_comments; ?>
												</em>
											</div>
										</div>

									</div>
								</div>
							</li>
								<?php
								endwhile;
								}
								/***********************************work history*******************************/
								$loop = new WP_Query( $args ); 
								if ( $loop->have_posts()  ){  
								
									while ( $loop->have_posts() ) : $loop->the_post();
									$faclityname = get_field('facility_name');
									$spanddept = get_field('work_specialty_department');
									$workcity = get_field('work_city');
									$workstate = get_field('work_state');
									$workaddress = get_field('work_address');
									$workzipcode = get_field('work_zip_code');
									$workprofession = get_field('work_profession');
									$workstartedM = get_field('work_started_on_month');
									$workstrtedY = get_field('work_started_on_year');
									$workendM = get_field('work_ended_on_month');
									$workendY = get_field('work_ended_on_year');
									$currentywork = get_field('work_currently_here');
									$faciltytype = get_field('work_type_Ag_fc');
									$emplymenttype = get_field('work_employment_type');
									$additioncomments = get_field('additional_notes_and_comments');
									$staffingagency = get_field('work_staffing_agency');
									$contactname = get_field('contact_name');
									$contactemail = get_field('contact_email');
									$contactphnno = get_field('phone_number');
									$contactfaxno = get_field('fax_number');
									$op_facility = get_field('op_facility');
									$op_address = get_field('op_address');

										$postId = get_the_ID();
										$post_slug = $post->post_name;

									
										?>
									<li class="education_list list-display" id="workentery_id_<?php echo $postId; ?>">
										<div class="rows_lists d-flex">
											
											<span class="row-icon me-2">
												<i class="fal fa-clipboard-check" title="Everything is OK"></i>
											</span>
																	
											<div class="flex-grow-1">
												<div class="row">
													<div class="col-12 col-md-6">
														<div class="font-heavyweight">
															<strong>
															<?php
															echo get_the_title(); 
															?>	
															</strong>
														</div>

														<div class="profession">
														<b>Work Profession:</b> <?php echo $workprofession; ?>
														</div>

														<div class="Contact_detials">
															<div class="contact_name">
															<b>Conatct Person Name:</b> <?php echo $contactname; ?>
															</div>
															<div class="contact_email">
															<b>Conatct Email:</b> <?php echo $contactemail; ?>
															</div>
															<div class="phn_number">
															<b>Conatct Phone Number:</b> <?php echo $contactphnno; ?>
															</div>
															<div class="fax_number">
															<b>Conatct Fax number:</b> <?php echo $contactfaxno; ?>
															</div>
														</div>

														<div class="location">
														<b>Address:</b>	<?php echo $workaddress;?>, <?php echo $workcity; ?>, <?php echo $workstate; ?>, <?php echo $workzipcode; ?>
														</div>

														<div class="department-name">
															<b>Department:</b> <?php echo $spanddept; ?>
														</div>
														<div class="employment-type">
															<b>Employment Type:</b> <?php echo $emplymenttype; ?>
														</div>
														<div>
															<strong class="font-heavyweight date-range">
																<?php echo $workstartedM.' '.$workstrtedY; ?> — <?php if($currentywork == 1){echo 'Present';}else{ echo $workendM.' '.$workendY;  } ?>
															</strong>
														</div>

													</div>

											</div>
										</div>
									</li>
									<?php
									endwhile;
														
									}else{
									echo "Where have you worked in the past?";
									}
									echo '</ul>';	
									wp_reset_postdata(); 


									?>
						</section>
				<!--------------Military section------------->			
					<section id="military" class="profile-section">
							<h2>Military</h2>
							<?php
							
							$args2 = array(  
							'post_type' => 'military',
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'author' => $uid,
							'meta_query' => array(
								'relation' => 'OR',
								'postSorting' => array(
									'key' => 'postSorting',
									'compare' => 'EXISTS',
								),
								'postSorting2' => array(
									'key' => 'postSorting',
									'compare' => 'NOT EXISTS',
								), 
							
							
							),
							'orderby' => 'postSorting',
							'order' => 'ASC',
							);
							echo '<ul class="education_display_lists display_lists">';
							$loop = new WP_Query( $args2 ); 
							if ( $loop->have_posts()  ){  
							
							while ( $loop->have_posts() ) : $loop->the_post();
							$postId = get_the_ID();
							$post_slug = $post->post_name;
							$imgs = get_post_meta($postId,'military_attachment_id',true);
							$meta_ml = explode(',', $imgs);

							if($imgs ){ $count = count($meta_ml); }
							$militaryHistory = get_field('military_history');
							
							?>
							

							<li class="military_list list-display" id="military_id_<?php echo $postId; ?>">
								<div class="rows_lists d-flex">
									<span class="row-icon">
									<i class="fal fa-fw fa-calendar"></i>
									</span>

									<div class="flex-grow-1">
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="font-heavyweight">
													Military History: <?php echo $militaryHistory; ?>
												</div>
											</div>
										</div>
										<?php if($shareoverview){ ?>
												<div class="row">
													<div class="col-12 col-md-6">
														<?php if($imgs) {?>Attachments: <?php echo $count; ?> <?php }else{ echo 'Attachments: 0'; } ?>
													</div>
												</div>
										<?php }else if($sharefull){ ?>
												<div class="row">
												<div class="col-12">
													<ul class="display-list">
														<?php 
														if($imgs){
														foreach ($meta_ml as $metas_ml) {

														$attch_name = basename( get_attached_file($metas_ml ) ); // Just the file name;
														$attach_url = wp_get_attachment_url( $metas_ml );
														//$count = count($metas);
														if($attch_name){
															$loopattach = '<li class="display-list-item attachment-item">
																<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																'.$attch_name.'
																</a>
															</li>';
														}
														echo $loopattach;

													}} ?>
													</ul>
												</div>
											</div>
										<?php }?>
									</div>
								</div>
							</li>
							<?php
							endwhile;

							echo '</ul>';
							}else{
							// echo "Please added here your Military history and files!";
							}
							wp_reset_postdata(); 
							?>
					</section>		
				<!--------------skills section------------->		
<!-- 						<section id="skills" class="profile-section">
							<h2>Skills</h2>

							<section id="ehrs" class="profile-sub-section">
								<h3>
									Electronic Health Record Systems
								</h3>
								<?php
								/*$args = array(  
								'post_type' => 'skills',
								'post_status' => 'publish',
								'author' => $uid,
								'meta_query' => array(
									'relation' => 'OR',
									'postSorting' => array(
										'key' => 'postSorting',
										'compare' => 'EXISTS',
									),
									'postSorting2' => array(
										'key' => 'postSorting',
										'compare' => 'NOT EXISTS',
									), 
								
								
								),
								'orderby' => 'postSorting',
								'order' => 'ASC',
								);
							
								$loop = new WP_Query( $args ); 
								if ( $loop->have_posts()  ){  
									echo '<ul class="licenses_display_lists display_lists">';
									while ( $loop->have_posts() ) : $loop->the_post();
										$ehrs_var = get_field('ehrs');
										$skillId = get_the_ID();*/
										?>
										<li class="licenses_list list-display">
										<div class="rows_lists">
											<span class="row-icon">
												<i class="fal fa-clipboard-check" title="Everything is OK"></i>
											</span>
											<span class="title">
												<span class="title-primary">
													<?php //echo $ehrs_var; ?>
												</span>
											</span>
									
										</li>
										<?php
									
								/*endwhile;
								
								echo '</ul>';
								}else{
									echo "Qualify for more opportunities - input EHRs you have experience with.";
								}
								wp_reset_postdata(); */
								?>

							</section>
							<section id="skills_checklists" class="profile-sub-section">
								<h3>
									Skills Checklists
								</h3>
								<?php
								/*$args = array(  
								'post_type' => 'skills-checklists',
								'post_status' => 'publish',
								'author' => $uid,
								'meta_query' => array(
									'relation' => 'OR',
									'postSorting' => array(
										'key' => 'postSorting',
										'compare' => 'EXISTS',
									),
									'postSorting2' => array(
										'key' => 'postSorting',
										'compare' => 'NOT EXISTS',
									), 
								
								
								),
								'orderby' => 'postSorting',
								'order' => 'ASC',
								);

								$loop = new WP_Query( $args ); 
								if ( $loop->have_posts()  ){  
								echo '<ul class="licenses_display_lists display_lists">';
								while ( $loop->have_posts() ) : $loop->the_post();
									$postId = get_the_ID();
									$imgs = get_post_meta($postId,'skills_attachment_id',true);
									$meta_skl = explode(',', $imgs);

									if($imgs ){ $count = count($meta_skl); }
									$post_slug = $post->post_name;
									$completed = get_field('completed_date');
									$specciality = get_field('checklists_specialty');*/
									
									?>
									<li class="licenses_list list-display">
										<div class="rows_lists">
											<span class="row-icon">
											<?php //if($imgs) { ?>
												<i class="fal fa-clipboard-check" title="Everything is OK"></i>
												
											<?php //}else{ ?>
												<i class="fal fa-exclamation-circle" title="Data is missing"></i>
											<?php //} ?>
											</span>

											<div class="flex-grow-1">
												<div class="row">
													<div class="col-12">
														<span class="font-heavyweight">
															<?php //echo $specciality; ?>
														</span>
													</div>
													<?php //if($shareoverview){ ?>
														<div class="col-12 col-md-6">
															<?php //if($imgs) {?>Attachments: <?php //echo $count; ?> <?php //}else{ echo 'Attachments: 0'; } ?>
														</div>
													<?php //}else if($sharefull){ ?>
													<div class="row">
													<div class="col-12">
														<ul class="display-list">
															<?php 
															//if($imgs){
															//foreach ($meta_skl as $metas_skl) {

															/*$attch_name = basename( get_attached_file($metas_skl ) ); // Just the file name;
															$attach_url = wp_get_attachment_url( $metas_skl );
															//$count = count($metas);
															if($attch_name){
																$loopattach = '<li class="display-list-item attachment-item">
																	<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																	'.$attch_name.'
																	</a>
																</li>';
															}
															echo $loopattach;*/

														//} }?>
														</ul>
													</div>
												</div>
												<?php //}?>

												</div>

												<div class="row">
													<div class="col-12">
														<div class="date-completed">
															Date Completed: <?php //echo $completed; ?>
														</div>
													</div>
												</div>
											</div>
											
										</div>

									</li>

									<?php
									/*endwhile;

									echo '</ul>';
									}else{
										echo "Upload recent skills checklist results.";
									}
									wp_reset_postdata(); */
									?>

							</section>
						</section> -->
				<!--------------Insurance section------------->			
					<section id="insurance" class="profile-section">
							<h2>Insurance</h2>
							<?php
							
							$args2 = array(  
							'post_type' => 'insurance',
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'author' => $uid,
							'meta_query' => array(
								'relation' => 'OR',
								'postSorting' => array(
									'key' => 'postSorting',
									'compare' => 'EXISTS',
								),
								'postSorting2' => array(
									'key' => 'postSorting',
									'compare' => 'NOT EXISTS',
								), 
							
							
							),
							'orderby' => 'postSorting',
							'order' => 'ASC',
							);
							echo '<ul class="education_display_lists display_lists">';
							$loop = new WP_Query( $args2 ); 
							if ( $loop->have_posts()  ){  
							
							while ( $loop->have_posts() ) : $loop->the_post();
							$postId = get_the_ID();
							$post_slug = $post->post_name;
							$imgs = get_post_meta($postId,'insurance_attachment_id',true);
							$meta_in = explode(',', $imgs);

							if($imgs ){ $count = count($meta_in); }
							$liability_lists = get_field('liability_insurance');
							
							?>
							

							<li class="insurance_list list-display" id="insurance_id_<?php echo $postId; ?>">
								<div class="rows_lists d-flex">
									<span class="row-icon">
									<i class="fal fa-fw fa-calendar"></i>
									</span>

									<div class="flex-grow-1">
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="font-heavyweight">
												Professional liability insurance: <?php echo $liability_lists; ?>
												</div>
											</div>
										</div>
										<?php if($shareoverview){ ?>
												<div class="row">
													<div class="col-12 col-md-6">
														<?php if($imgs) {?>Attachments: <?php echo $count; ?> <?php }else{ echo 'Attachments: 0'; } ?>
													</div>
												</div>
										<?php }else if($sharefull){ ?>
												<div class="row">
												<div class="col-12">
													<ul class="display-list">
														<?php 
														if($imgs ){
														foreach ($meta_in as $metas_in) {

														$attch_name = basename( get_attached_file($metas_in ) ); // Just the file name;
														$attach_url = wp_get_attachment_url( $metas_in );
														//$count = count($metas);
														if($attch_name){
															$loopattach = '<li class="display-list-item attachment-item">
																<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																'.$attch_name.'
																</a>
															</li>';
														}
														echo $loopattach;

													} }?>
													</ul>
												</div>
											</div>
										<?php }?>
									</div>
								</div>
							</li>
							<?php
							endwhile;

							echo '</ul>';
							}else{
							echo "Please added here your insurance details!";
							}
							wp_reset_postdata(); 
							?>
					</section>		
				<!--------------references section------------->		
						<section id="references" class="profile-section">
							<h2>References</h2>

							
							<?php 
							
							
							$args = array(  
								'post_type' => 'references',
								'post_status' => 'publish',
								'posts_per_page' => -1,
								'author' => $uid,
								'meta_query' => array(
									'relation' => 'OR',
									'postSorting' => array(
										'key' => 'postSorting',
										'compare' => 'EXISTS',
									),
									'postSorting2' => array(
										'key' => 'postSorting',
										'compare' => 'NOT EXISTS',
									), 
								
								
								),
								'orderby' => 'postSorting',
								'order' => 'ASC',
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
									$reverencesknown = get_field('references_known',$rfid);

									$imgs = get_post_meta($postId,'refrences_attachment_id',true);
									$meta_rf = explode(',', $imgs);

									if($imgs ){ $count = count($meta_rf); }

									if($currentywork == 1){
										$comdate = 'Present';
									}else{ 
										$comdate = $workendM.' '.$workendY;
									}
									
										
									?>
									<li class="refrences_list list-display">
										<div class="rows_lists d-flex">

									<span class="row-icon">
										<i class="fal fa-clipboard-check" title="Everything is OK"></i>
									</span>

									<div class="flex-grow-1">
										<div class="row">
											<div class="col-12 col-md-6">
												<span class="font-heavyweight">
													<?php echo $refrencename; ?>
												</span>
												<div class="contact-email">
													Refrences Email : <?php echo $refrenceEmail; ?>
												</div>
											</div>

											<div class="col-12 col-md-6">
												<div class="contact-position">
													Position: <?php echo $refrenceposition; ?>
												</div>
												
												<div class="contact-email">
													Refrences Phone No : <?php echo $refrencePhone; ?>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-6">
												<div class="work-history-name">
												Refrences Known: <?php echo $reverencesknown; ?>
												</div>
											</div>

											<div class="col-12 col-md-6">

											</div>
										</div>

										<?php if($shareoverview){ ?>
											<div class="row">
												<div class="col-12 col-md-6">
													<?php if($imgs) {?>Attachments: <?php echo $count; ?> <?php }else{ echo 'Attachments: 0'; } ?>
												</div>
											</div>
										<?php }else if($sharefull){ ?>
													<div class="row">
													<div class="col-12">
														<ul class="display-list">
															<?php 
															if($imgs ){
															foreach ($meta_rf as $metas_rf) {

															$attch_name = basename( get_attached_file($metas_rf ) ); // Just the file name;
															$attach_url = wp_get_attachment_url( $metas_rf );
															//$count = count($metas);
															if($attch_name){
																$loopattach = '<li class="display-list-item attachment-item">
																	<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																	'.$attch_name.'
																	</a>
																</li>';
															}
															echo $loopattach;

														} }?>
														</ul>
													</div>
												</div>
											<?php }?>
									</div>
								</li>

							<?php
							endwhile;

							echo '</ul>';
							}else{
							echo "Before you can create a Reference,
							you'll need some Work History.";
							}
							wp_reset_postdata(); 
							?>

						</section>
				<!--------------immunizations_history section------------->		
						<section id="immunizations_history" class="profile-section">
							<h2>Immunizations</h2>
							<?php 
							
							$args = array(  
							'post_type' => 'immunizations',
							'posts_per_page' => -1,
							'post_status' => 'publish',
							'author' => $uid,
							'meta_query' => array(
								'relation' => 'OR',
								'postSorting' => array(
									'key' => 'postSorting',
									'compare' => 'EXISTS',
								),
								'postSorting2' => array(
									'key' => 'postSorting',
									'compare' => 'NOT EXISTS',
								), 
							
							
							),
							'orderby' => 'postSorting',
							'order' => 'ASC',
							);


							$loop = new WP_Query( $args ); 
							if ( $loop->have_posts()  ){  
							echo '<ul class="medical_display_lists display_lists">';
							while ( $loop->have_posts() ) : $loop->the_post();
							$postId = get_the_ID();
							$immun_drop = get_field('immunizations_dropdown');
							$hepdatereceived = get_field('hepatitis_date_received');
							$fludatereceived = get_field('flu_date_received');
							$fludateexpire = get_field('flu_date_expire');
							$varicelladatereceived = get_field('varicella_date_recevied');
							$coviddatereceived = get_field('covid_date_recevied');
							$coviddateexpire = get_field('covid_date_expire');
							$tbdatereceived = get_field('tb_date_recevied');
							$tbdateexpire = get_field('tb_date_expire');
							$tdapdate = get_field('tdap_received');
							$mmrdate = get_field('mmr_received');
							$otherinput = get_post_meta($postId,'other_total_count',true);
							$hep = get_post_meta($postId,'hepatitis_attachment_id',true);
							$hepmeta = explode(',', $hep);
							if($hep ){ $hepcount = count($hepmeta); }
					
							$flu = get_post_meta($postId,'flu_attachment_id',true);
							$flumeta = explode(',', $flu);
							if($flu ){ $flucount = count($flumeta); }
					
							$varicella = get_post_meta($postId,'varicella_attachment_id',true);
							$varicellameta = explode(',', $varicella);
							if($varicella ){ $varicellacount = count($varicellameta); }
					
							$covid = get_post_meta($postId,'covid_attachment_id',true);
							$covidmeta = explode(',', $covid);
							if($covid ){ $covidcount = count($covidmeta); }
					
							$tb = get_post_meta($postId,'tb_attachment_id',true);
							$tbmeta = explode(',', $tb);
							if($tb ){ $tbcount = count($tbmeta); }
								
							$tdap = get_post_meta($postId,'tdap_attachment_id',true);
							$tdapmeta = explode(',', $tdap);
							if($tdap ){ $tdapcount = count($tdapmeta); }
					
							$mmr = get_post_meta($postId,'mmr_attachment_id',true);
							$mmrmeta = explode(',', $mmr);
							if($mmr ){ $mmrcount = count($mmrmeta); 
							}

							$irh = get_post_meta($postId,'irh_attachment_id',true);
							$irhmeta = explode(',', $irh);
							if($irh ){ $irhcount = count($irhmeta); 
							}

							$other = get_post_meta($postId,'other_attachment_id',true);
							$othermeta = explode(',', $other);
							if($other ){ $othercount = count($othermeta); }
							

							?>
							<li class="medical_list list-display">
								<div class="rows_lists d-flex">
								<span class="row-icon">
									<i class="fal fa-clipboard-check" title="Everything is OK"></i>
								</span>

							<div class="flex-grow-1">
								<?php if($immun_drop == 'Hepatitis B'){ ?>
									<div class="title d-flex">
										<div class="immunzations_state immunzations_split_text">
											<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
											<?php echo $immun_drop; ?>
											</a>
										</div>
										<div class="data-row lic_rows_data">
											<div class="data_label">
												Date Received:
											</div>
											<div class="data_values">
												<?php echo $hepdatereceived; ?>
											</div>
										</div>
									</div>
									<?php if($shareoverview){ ?>
										<?php if($hep) {?>
											<div class="row">
												<div class="col-12 col-md-6">
													<?php if($hep) {?>Attachments: <?php echo $hepcount; ?> <?php }else{ echo 'Attachments: 0'; } ?>
												</div>
											</div>
										<?php } ?>
									<?php }else if($sharefull){ ?>
													<div class="row">
														<div class="col-12">
															<ul class="display-list">
																<?php 
																if($hep) {
																foreach ($hepmeta as $metas) {

																$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
																$attach_url = wp_get_attachment_url( $metas );
																//$count = count($metas);
																if($attch_name){
																	$loopattach = '<li class="display-list-item attachment-item">
																		<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																		'.$attch_name.'
																		</a>
																	</li>';
																}
																echo $loopattach;

															} }?>
															</ul>
														</div>
													</div>
												<?php }?>

								<?php }else if($immun_drop == 'Flu'){ ?>
									<div class="title d-flex">
										<div class="immunzations_state immunzations_split_text">
											<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
											<?php echo $immun_drop; ?>
											</a>
										</div>
										<div class="data-row lic_rows_data">
											<div class="data_label">
												Date Received:
											</div>
											<div class="data_values">
												<?php echo $fludatereceived; ?>
											</div>
										</div>
										<div class="data-row lic_rows_data">
											<div class="data_label">
												Date Expire:
											</div>
											<div class="data_values">
												<?php echo $fludateexpire; ?>
											</div>
										</div>
									</div>
									<?php if($shareoverview){ ?>
									<?php if($flu) {?>
										<div class="row">
											<div class="col-12 col-md-6">
												<?php if($flu) {?>Attachments: <?php echo $flucount; ?> <?php }else{ echo 'Attachments: 0'; } ?>
											</div>
										</div>
									<?php } ?>
									<?php }else if($sharefull){ ?>
													<div class="row">
														<div class="col-12">
															<ul class="display-list">
																<?php 
																if($flu) {
																foreach ($flumeta as $metas) {

																$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
																$attach_url = wp_get_attachment_url( $metas );
																//$count = count($metas);
																if($attch_name){
																	$loopattach = '<li class="display-list-item attachment-item">
																		<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																		'.$attch_name.'
																		</a>
																	</li>';
																}
																echo $loopattach;

															} }?>
															</ul>
														</div>
													</div>
												<?php }?>

								<?php }else if($immun_drop == 'Varicella'){ ?>
									<div class="title d-flex">
										<div class="immunzations_state immunzations_split_text">
											<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
											<?php echo $immun_drop; ?>
											</a>
										</div>
										<div class="data-row lic_rows_data">
											<div class="data_label">
												Date Received:
											</div>
											<div class="data_values">
												<?php echo $varicelladatereceived; ?>
											</div>
										</div>
										
									</div>
									<?php if($shareoverview){ ?>
									<?php if($varicella) {?>
										<div class="row">
											<div class="col-12 col-md-6">
												<?php if($varicella) {?>Attachments: <?php echo $varicellacount; ?> <?php }else{ echo 'Attachments: 0'; } ?>
											</div>
										</div>
									<?php } ?>
									<?php }else if($sharefull){ ?>
													<div class="row">
														<div class="col-12">
															<ul class="display-list">
																<?php 
																if($varicella) {
																foreach ($varicellameta as $metas) {

																$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
																$attach_url = wp_get_attachment_url( $metas );
																//$count = count($metas);
																if($attch_name){
																	$loopattach = '<li class="display-list-item attachment-item">
																		<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																		'.$attch_name.'
																		</a>
																	</li>';
																}
																echo $loopattach;

															} }?>
															</ul>
														</div>
													</div>
												<?php }?>
								<?php }else if($immun_drop == 'COVID'){ ?>
									<div class="title d-flex">
										<div class="immunzations_state immunzations_split_text">
											<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
											<?php echo $immun_drop; ?>
											</a>
										</div>
										<div class="data-row lic_rows_data">
											<div class="data_label">
												Date Received:
											</div>
											<div class="data_values">
												<?php echo $coviddatereceived; ?>
											</div>
										</div>
										<div class="data-row lic_rows_data">
											<div class="data_label">
												Date Expire:
											</div>
											<div class="data_values">
												<?php echo $coviddateexpire; ?>
											</div>
										</div>
									
									</div>
									<?php if($shareoverview){ ?>
									<?php if($covid) {?>
										<div class="row">
											<div class="col-12 col-md-6">
												<?php if($covid) {?>Attachments: <?php echo $covidcount; ?> <?php }else{ echo 'Attachments: 0'; } ?>
											</div>
										</div>
									<?php } ?>
									<?php }else if($sharefull){ ?>
													<div class="row">
														<div class="col-12">
															<ul class="display-list">
																<?php 
																if($covid) {
																foreach ($covidmeta as $metas) {

																$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
																$attach_url = wp_get_attachment_url( $metas );
																//$count = count($metas);
																if($attch_name){
																	$loopattach = '<li class="display-list-item attachment-item">
																		<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																		'.$attch_name.'
																		</a>
																	</li>';
																}
																echo $loopattach;

															} }?>
															</ul>
														</div>
													</div>
												<?php }?>

								<?php }else if($immun_drop == 'TB'){ ?>
									<div class="title d-flex">
										<div class="immunzations_state immunzations_split_text">
											<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
											<?php echo $immun_drop; ?>
											</a>
										</div>
										<div class="data-row lic_rows_data">
											<div class="data_label">
												Date Received:
											</div>
											<div class="data_values">
												<?php echo $tbdatereceived; ?>
											</div>
										</div>
										<div class="data-row lic_rows_data">
											<div class="data_label">
												Date Expire:
											</div>
											<div class="data_values">
												<?php echo $tbdateexpire; ?>
											</div>
										</div>
										
									</div>
									<?php if($shareoverview){ ?>
									<?php if($tb) {?>
										<div class="row">
											<div class="col-12 col-md-6">
												<?php if($tb) {?>Attachments: <?php echo $tbcount; ?> <?php }else{ echo 'Attachments: 0'; } ?>
											</div>
										</div>
									<?php } ?>
									<?php }else if($sharefull){ ?>
													<div class="row">
														<div class="col-12">
															<ul class="display-list">
																<?php 
																if($tb) {
																foreach ($tbmeta as $metas) {

																$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
																$attach_url = wp_get_attachment_url( $metas );
																//$count = count($metas);
																if($attch_name){
																	$loopattach = '<li class="display-list-item attachment-item">
																		<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																		'.$attch_name.'
																		</a>
																	</li>';
																}
																echo $loopattach;

															} }?>
															</ul>
														</div>
													</div>
												<?php }?>

								<?php } else if($immun_drop == 'Immunization Record/History'){ ?>

									<div class="title d-flex">
										<div class="immunzations_state immunzations_split_text">
											<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
											<?php echo $immun_drop; ?>
											</a>
										</div>
										<?php 
										$i = 0;
										foreach($irhmeta as $vl){ 
										if($vl){
										$i++;
										$docname = get_post_meta($postId,'other_doc_name_'.$i,true);
										if($docname){
										$name2 = $docname;
										}

										?>

										<div class="data-row lic_rows_data">
										<!-- <div class="data_label">
										Attachment name:
										</div> -->
										<div class="data_values">
										<?php echo $name2; ?>
										</div>
										</div>
										<?php } } ?>		
									</div>
									<?php if($shareoverview){ ?>
										<div class="row">
											<div class="col-12 col-md-6">
												<?php if($irh) {?>Attachments: <?php echo $irhrcount; ?> <?php }else{ echo 'Attachments: 0'; } ?>
											</div>
										</div>
									<?php }else if($sharefull){ ?>
													<div class="row">
														<div class="col-12">
															<ul class="display-list">
																<?php 
																if($irh) {
																foreach ($irhmeta as $metas) {

																$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
																$attach_url = wp_get_attachment_url( $metas );
																//$count = count($metas);
																if($attch_name){
																	$loopattach = '<li class="display-list-item attachment-item">
																		<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																		'.$attch_name.'
																		</a>
																	</li>';
																}
																echo $loopattach;

															} }?>
															</ul>
														</div>
													</div>
												<?php }?>

								<?php }else if($immun_drop == 'Other Immunizations'){ ?>
									<div class="title d-flex">
										<div class="immunzations_state immunzations_split_text">
											<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
											<?php echo $immun_drop; ?>
											</a>
										</div>
										<?php 
										$i = 0;
										foreach($othermeta as $vl){ 
										if($vl){
										$i++;
										$docname = get_post_meta($postId,'other_doc_name_'.$i,true);
										if($docname){
										$name2 = $docname;
										}

										?>

										<div class="data-row lic_rows_data">
										<div class="data_label">
										Attachment name:
										</div>
										<div class="data_values">
										<?php echo $name2; ?>
										</div>
										</div>
										<?php } } ?>		
									</div>
									<?php if($shareoverview){ ?>
										<div class="row">
											<div class="col-12 col-md-6">
												<?php if($other) {?>Attachments: <?php echo $othercount; ?> <?php }else{ echo 'Attachments: 0'; } ?>
											</div>
										</div>
									<?php }else if($sharefull){ ?>
													<div class="row">
														<div class="col-12">
															<ul class="display-list">
																<?php 
																if($other) {
																foreach ($othermeta as $metas) {

																$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
																$attach_url = wp_get_attachment_url( $metas );
																//$count = count($metas);
																if($attch_name){
																	$loopattach = '<li class="display-list-item attachment-item">
																		<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																		'.$attch_name.'
																		</a>
																	</li>';
																}
																echo $loopattach;

															} }?>
															</ul>
														</div>
													</div>
												<?php }?>

								<?php }else if($immun_drop == 'TDAP'){?>
									<div class="title d-flex">
										<div class="immunzations_state immunzations_split_text">
											<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
											<?php echo $immun_drop; ?>
											</a>
										</div>
										<div class="data-row lic_rows_data">
											<div class="data_label">
												Date Received:
											</div>
											<div class="data_values">
												<?php echo $tdapdate; ?>
											</div>
										</div>
										
									</div>
									<?php if($shareoverview){ ?>
									<?php if($tdap) {?>
										<div class="row">
											<div class="col-12 col-md-6">
												<?php if($tdap) {?>Attachments: <?php echo $tdapcount; ?> <?php }else{ echo 'Attachments: 0'; } ?>
											</div>
										</div>
									<?php } ?>
									<?php }else if($sharefull){ ?>
													<div class="row">
														<div class="col-12">
															<ul class="display-list">
																<?php 
																if($tdap) {
																foreach ($tdapmeta as $metas) {

																$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
																$attach_url = wp_get_attachment_url( $metas );
																//$count = count($metas);
																if($attch_name){
																	$loopattach = '<li class="display-list-item attachment-item">
																		<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																		'.$attch_name.'
																		</a>
																	</li>';
																}
																echo $loopattach;

															} }?>
															</ul>
														</div>
													</div>
												<?php }?>
								<?php }else if($immun_drop == 'MMR'){ ?>
									<div class="title d-flex">
										<div class="immunzations_state immunzations_split_text">
											<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
											<?php echo $immun_drop; ?>
											</a>
										</div>
										<div class="data-row lic_rows_data">
											<div class="data_label">
												Date Received:
											</div>
											<div class="data_values">
												<?php echo $mmrdate; ?>
											</div>
										</div>
										
									</div>
									<?php if($shareoverview){ ?>
									<?php if($mmr) {?>
										<div class="row">
											<div class="col-12 col-md-6">
												<?php if($mmr) {?>Attachments: <?php echo $mmrcount; ?> <?php }else{ echo 'Attachments: 0'; } ?>
											</div>
										</div>
									<?php } ?>
									<?php }else if($sharefull){ ?>
													<div class="row">
														<div class="col-12">
															<ul class="display-list">
																<?php 
																if($mmr) {
																foreach ($mmrmeta as $metas) {

																$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
																$attach_url = wp_get_attachment_url( $metas );
																//$count = count($metas);
																if($attch_name){
																	$loopattach = '<li class="display-list-item attachment-item">
																		<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																		'.$attch_name.'
																		</a>
																	</li>';
																}
																echo $loopattach;

															} }?>
															</ul>
														</div>
													</div>
												<?php }?>
								<?php } ?>
							</div>
							</div>
							</li>
							<?php
							endwhile;

							echo '</ul>';
							}else{
							echo "Upload your documentation with this information. It’ll save your recruiter — and you — validation time.";
							}
							wp_reset_postdata(); 
							?>

						</section>
							<!-------------------------Case Logs------------------------------>
						<section id="profile_uploads" class="profile-section">
							<h2>Case Logs</h2>

								<?php 
								
								$args = array(  
								'post_type' => 'case-logs',
								'post_status' => 'publish',
								'posts_per_page' => 5,
								'author' => $uid,
								'meta_query' => array(
									'relation' => 'OR',
									'postSorting' => array(
										'key' => 'postSorting',
										'compare' => 'EXISTS',
									),
									'postSorting2' => array(
										'key' => 'postSorting',
										'compare' => 'NOT EXISTS',
									), 
								
								
								),
								'orderby' => 'postSorting',
								'order' => 'ASC',
								);

								$loop = new WP_Query( $args ); 
								$numberOfPosts= $loop->found_posts;

								if ( $loop->have_posts()  ){  
								echo '<ul class="licenses_display_lists display_lists">';
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
								$document_name = get_field('document_name');
								$datecaselog = get_field('case_log_date');

								$AnesthesiaTypevalues = get_post_meta($postId,'AnesthesiaType_data',true);
								$administartionvalues = get_post_meta($postId,'administration_data',true);
								$Proceduresvalues = get_post_meta($postId,'AnesthesiaProcedures_data',true);
								$AnatomicalCategoryvalues = get_post_meta($postId,'AnatomicalCategory_data',true);

								$va1 = explode(',', $AnesthesiaTypevalues);
								$va2 = explode(',', $administartionvalues);
								$va3 = explode(',', $Proceduresvalues);
								$va4 = explode(',', $AnatomicalCategoryvalues);

								$imgs = get_post_meta($postId,'caselogs_attachment_id',true);
								$meta_clog = explode(',', $imgs);
						  
							   if($imgs ){ $count = count($meta_clog); }
								?>

								<li class="licenses_list list-display">
									<div class="rows_lists">
									<span class="row-icon">
										<i class="fal fa-clipboard-check" title="Everything is OK"></i>
									</span>

									<div class="flex-grow-1">
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
												<?php if($document_name) { ?>
												<div class="data-row lic_rows_data">
													<div class="data_label">
														Document Name:
													</div>
													<div class="data_values">
													<?php echo $document_name; ?>
													</div>
												</div>
												<?php } ?>
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
														Date:
													</div>
													<div class="data_values">
													<?php echo $datecaselog; ?>
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
												
												<?php if($shareoverview){ ?>
													<div class="row">
														<div class="col-12 col-md-6">
															<?php if($imgs) {?>Attachments: <?php echo $count; ?> <?php }else{ echo 'Attachments: 0'; } ?>
														</div>
													</div>
												<?php }else if($sharefull){ ?>
													<div class="row">
														<div class="col-12">
															<ul class="display-list 5768">
																<?php 
																if($imgs ){
																foreach ($meta_clog as $metas_clog) {

																$attch_name = basename( get_attached_file($metas_clog ) ); // Just the file name;
																$attach_url = wp_get_attachment_url( $metas_clog );
																//$count = count($metas);
																if($attch_name){
																	$loopattach = '<li class="display-list-item attachment-item">
																		<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																		'.$attch_name.'
																		</a>
																	</li>';
																}
																echo $loopattach;

															} }?>
															</ul>
														</div>
													</div>
												<?php }?>
											</div>
                    						<div class="col-md-6">
												<div class="data-row lic_rows_data">
													<div class="data_labels">
														<b>Anesthesia Type:</b>
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
								</li>

							
								<?php
								endwhile;

								echo '</ul>';
								}else{
									echo "Add your Clinical Information!";
								}
								wp_reset_postdata(); 
								if($numberOfPosts > 4){
									echo '<div class="d-block text-center"><a href="'.get_the_permalink(2248).'" target="_blank" class="caslogsviewall btn btn-info btn-lighter">View All</a></div>';
								}else{
									
								}
								?>
								

						</section>
				<!--------------profile_uploads section------------->		
						<section id="profile_uploads" class="profile-section">
							<h2>Additional Documents</h2>

								<?php 
								
								$args = array(  
								'post_type' => 'additional-documents',
								'posts_per_page' => -1,
								'post_status' => 'publish',
								'author' => $uid,
								'meta_query' => array(
									'relation' => 'OR',
									'postSorting' => array(
										'key' => 'postSorting',
										'compare' => 'EXISTS',
									),
									'postSorting2' => array(
										'key' => 'postSorting',
										'compare' => 'NOT EXISTS',
									), 
								
								
								),
								'orderby' => 'postSorting',
								'order' => 'ASC',
								);

								$loop = new WP_Query( $args ); 
								if ( $loop->have_posts()  ){  
								echo '<ul class="licenses_display_lists display_lists">';
								while ( $loop->have_posts() ) : $loop->the_post();
								$postId = get_the_ID();
								$imgs = get_post_meta($postId,'document_attachment_id',true);
								$meta_ad = explode(',', $imgs);

								if($imgs ){ $count = count($meta_ad); }
								$post_slug = $post->post_name;
								$documentType = get_field('document_type');
								$documentname = get_field('document_name');
								$documentdesc = get_field('document_description');

								?>

								<li class="licenses_list list-display">
									<div class="rows_lists">
									<span class="row-icon">
										<i class="fal fa-clipboard-check" title="Everything is OK"></i>
									</span>

									<div class="flex-grow-1">
										<div class="row">
											<div class="col-12 col-md-6">
												<strong class="font-heavyweight">
													<?php echo $documentType; ?>
												</strong>
											</div>
											<div class="col-12 col-md-6">
												<div class="profile-upload-type">
													<?php echo $documentname?>
												</div>
											</div>
										</div>

										<?php if($shareoverview){ ?>
											<div class="row">
												<div class="col-12 col-md-6">
													<?php if($imgs) {?>Attachments: <?php echo $count; ?> <?php }else{ echo 'Attachments: 0'; } ?>
												</div>
											</div>
										<?php }else if($sharefull){ ?>
													<div class="row">
													<div class="col-12">
														<ul class="display-list 5768">
															<?php 
															if($imgs ){
															foreach ($meta_ad as $metas_ad) {

															$attch_name = basename( get_attached_file($metas_ad ) ); // Just the file name;
															$attach_url = wp_get_attachment_url( $metas_ad );
															//$count = count($metas);
															if($attch_name){
																$loopattach = '<li class="display-list-item attachment-item">
																	<a href="'.$attach_url.'" target="_blank" class="attach_url_link"><i class="fal fa-file-image kamana-green-text"></i>
																	'.$attch_name.'
																	</a>
																</li>';
															}
															echo $loopattach;

														} }?>
														</ul>
													</div>
												</div>
											<?php }?>
										</div>
									</div>
								</li>

							
								<?php
								endwhile;

								echo '</ul>';
								}else{
									echo "(Driver's License, Social Security Card, etc.)";
								}
								wp_reset_postdata(); 
								?>

						</section>

				<!--------------personal_information section------------->		
						<section id="personal_information" class="profile-section personal-information">
							<h2 class="mb-4">Personal Information</h2>
							<div class="data-row"><div class="data-column">
								<span class="data-label">Full Name:</span>
									<span class="data-value">
									<?php echo $fullname; ?>
									</span>
								</div>
							</div>
							<div class="data-row">
								<div class="data-column">
									<span class="data-label">Years of Experience:</span>
									<span class="data-value"><?php echo $yearExp; ?></span>
								</div>
							</div>
							<div class="data-row">
								<div class="data-column">
									<span class="data-label">Email:</span>
									<span class="data-value">
										<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
									</span>
								</div>
							</div>
							<div class="data-row">
							<div class="data-column">
								<span class="data-label">Phone Number:</span>
								<span class="data-value"><a href="tel:<?php echo $phoneno; ?>"><?php echo $phoneno; ?></a>
								</span>
							</div>
							</div>
							<div class="data-row">
								<div class="data-column">
									<span class="data-label">Gender:</span>
									<span class="data-value"><?php if($shareoverview){ echo '—'; }else{ echo $gender; }  ?></span>
								</div>
								</div>
							<div class="data-row">
								<div class="data-column">
									<span class="data-label">SSN:</span>
									<span class="data-value"><?php if($shareoverview){ echo '—'; }else{ if($ssn){$splitnumber = explode('-',$ssn); echo '***-**-'.$splitnumber[2];}else{echo '—';}} ?></span>
								</div>
							</div>
							<div class="data-row">
								<div class="data-column">
									<span class="data-label">Date of Birth:</span>
									<span class="data-value"><?php if($shareoverview){ echo '—'; }else{echo $DOB;} ?></span>
								</div>
							</div>
							<div class="data-row">
								<div class="data-column">
									<span class="data-label">Emergency Contact:</span>
									<span class="data-value"><?php if($shareoverview){ echo '—'; }else{ if($emg_contact_name) { echo $emg_contact_name .'('.$emg_contact_relationship.')'; } }?></span>
								</div>
							</div>
							<?php if($shareoverview){ echo ''; }else{ ?>
								<div class="data-row">
									<div class="data-column">
										<span class="data-label">Emergency Contact Phone:</span>
										<span class="data-value"><?php echo $emg_contact_phone; ?></span>
									</div>
								</div>
							<?php } ?>
							<div class="data-row">
								<div class="data-column">
									<span class="data-label">Tax Home Zip:</span>
									<span class="data-value"><?php echo $userzipcode; ?></span>
								</div>
							</div>
							<div class="data-row">
								<div class="data-column">
									<span class="data-label">NPI Number:</span>
									<span class="data-value"><?php if($shareoverview){ echo '—'; }else{ echo $npi;} ?></span>
								</div>
							</div>
							<div class="data-row">
								<div class="data-column">
									<span class="data-label">DEA Number:</span>
									<span class="data-value"><?php if($shareoverview){ echo '—'; }else{ echo $dea;} ?></span>
								</div>
							</div>
							<div class="data-row">
								<div class="data-column">
									<span class="data-label">Medicare:</span>
									<span class="data-value"><?php if($shareoverview){ echo '—'; }else{ echo $medicare;} ?></span>
								</div>
							</div>
						</section>
				<!--------------background_and_work_auth section------------->		
						<section id="background_and_work_auth" class="profile-section">
							<h2>Background &amp; Work Authorization</h2>

							<div>
								<div class="d-flex justify-content-between my-4">
									<div>
										<div class="font-heavyweight">
											Has action ever been taken against any of your medical licenses?
										</div>

									</div>
									<div>
										<?php if($bgML) {echo $bgML;}else{ ?> Not yet answered <?php } ?>
									</div>
								</div>

								<div class="d-flex justify-content-between mb-4">
									<div>
										<div class="font-heavyweight">
											Have you ever been named as a defendant in a professional liability action?
										</div>

									</div>
									<div>
										<?php if($bgaction) {echo $bgaction;}else{ ?> Not yet answered <?php } ?>
									</div>
								</div>

								<div class="d-flex justify-content-between">
									<div>
										<div class="font-heavyweight">
											Are you legally authorized to work in the United States?
										</div>

									</div>
									<div>
										<?php if($bgUS) {echo $bgUS;}else{ ?> Not yet answered <?php } ?>
									</div>
								</div>
							</div>
						</section>
				<!--------------end of the sections ------------->			
			</div>
		</div>
	</div>
</div>
<?php 

}else{ 
	wp_redirect(home_url()); 
	exit;
} 

?>
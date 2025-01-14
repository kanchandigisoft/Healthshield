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
    'post_type' => 'immunizations',
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
		  if($mmr ){ $mmrcount = count($mmrmeta); }

		  $irh = get_post_meta($postId,'irh_attachment_id',true);
		  $irhmeta = explode(',', $irh);
		  if($irh ){ $irhcount = count($irhmeta); }

		  $other = get_post_meta($postId,'other_attachment_id',true);
		  $othermeta = explode(',', $other);
		  if($other ){ $othercount = count($othermeta); }

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
				<?php if($immun_drop == 'Hepatitis B'){ ?>
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
													Date Received:
												</div>
												<div class="data_values">
													<?php echo $hepdatereceived; ?>
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
													foreach ($hepmeta as $k => $v) {
														if($v){


												$attch_name = basename( get_attached_file($v ) ); // Just the file name;
												$attach_url = wp_get_attachment_url( $v );
												
												if($attch_name){
													$loopattach = '<li class="attch_path_title d-flex">
													<div class="attach_flex d-flex" id="'.$v.'">
													<i class="mr-2 fal fa-file-image healthshiled-green-text"></i>
													<div class="attchName"><a href="'.$attach_url.'" target="_blank" class="attach_url_link">'.$attch_name.'</a></div>
													</div>
													<div class="action-dropdown dropdown">
													<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
													<i class="fal fa-ellipsis-v-alt"></i></a>

													<ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

													<a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttach1='.$v.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


													<div class="dropdown-divider"></div>

													</ul>
													</div>
													</li>';
													echo $loopattach;
												}
												
													}
											}
											?>
												</ul>
											</div>
										</div>
									</div>
								</div>
			    
 				<?php }else if($immun_drop == 'Flu'){ ?>
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
							<div class="col-md-4">
								<?php 
								$today = time();												    										
								$dt2 = $fludateexpire;

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
											<?php echo $fludateexpire; ?>
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
										foreach ($flumeta as $k => $v) {
									if($v){
									$attch_name = basename( get_attached_file($v ) ); // Just the file name;
									$attach_url = wp_get_attachment_url( $v );
									
									if($attch_name){
										$loopattach = '<li class="attch_path_title d-flex">
										<div class="attach_flex d-flex" id="'.$v.'">
										<i class="mr-2 fal fa-file-image healthshiled-green-text"></i>
										<div class="attchName"><a href="'.$attach_url.'" target="_blank" class="attach_url_link">'.$attch_name.'</a></div>
										</div>
										<div class="action-dropdown dropdown">
										<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
										<i class="fal fa-ellipsis-v-alt"></i></a>

										<ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

										<a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttach2='.$v.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


										<div class="dropdown-divider"></div>

										</ul>
										</div>
										</li>';
										echo $loopattach;
									}
									
									}
								}
								?>
							        </ul>
						        </div>
					        </div>
				        </div>
			        </div>
		        

		        <?php }else if($immun_drop == 'Varicella'){ ?>
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
	 									Date Received:
	 								</div>
	 								<div class="data_values">
	 									<?php echo $varicelladatereceived; ?>
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
										foreach ($varicellameta as $k => $v) {
											if($v){
									$attch_name = basename( get_attached_file($v ) ); // Just the file name;
									$attach_url = wp_get_attachment_url( $v );
									
									if($attch_name){
										$loopattach = '<li class="attch_path_title d-flex">
										<div class="attach_flex d-flex" id="'.$v.'">
										<i class="mr-2 fal fa-file-image healthshiled-green-text"></i>
										<div class="attchName"><a href="'.$attach_url.'" target="_blank" class="attach_url_link">'.$attch_name.'</a></div>
										</div>
										<div class="action-dropdown dropdown">
										<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
										<i class="fal fa-ellipsis-v-alt"></i></a>

										<ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

										<a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttach3='.$v.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


										<div class="dropdown-divider"></div>

										</ul>
										</div>
										</li>';
										echo $loopattach;
									}
									
									}
								}
								?>
							        </ul>
						        </div>
					        </div>
				        </div>
			        </div>
		       

		        <?php }else if($immun_drop == 'COVID'){ ?>
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
							<div class="col-md-4">
								<?php 
								$today = time();												    										
								$dt2 = $coviddateexpire;

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
											<?php echo $coviddateexpire; ?>
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
										foreach ($covidmeta as $k => $v) {
												if($v){
									$attch_name = basename( get_attached_file($v ) ); // Just the file name;
									$attach_url = wp_get_attachment_url( $v );
									
									if($attch_name){
										$loopattach = '<li class="attch_path_title d-flex">
										<div class="attach_flex d-flex" id="'.$v.'">
										<i class="mr-2 fal fa-file-image healthshiled-green-text"></i>
										<div class="attchName"><a href="'.$attach_url.'" target="_blank" class="attach_url_link">'.$attch_name.'</a></div>
										</div>
										<div class="action-dropdown dropdown">
										<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
										<i class="fal fa-ellipsis-v-alt"></i></a>

										<ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

										<a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttach4='.$v.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


										<div class="dropdown-divider"></div>

										</ul>
										</div>
										</li>';
										echo $loopattach;
									}
									
									}
								}
								?>
							        </ul>
						        </div>
					        </div>
				        </div>
			        </div>
		        

		        <?php }else if($immun_drop == 'TB'){ ?>
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
							 <div class="col-md-4">
								<?php 
								$today = time();												    										
								$dt2 = $tbdateexpire;

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
											<?php echo $tbdateexpire; ?>
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
										foreach ($tbmeta as $k => $v) {
									if($v){
									$attch_name = basename( get_attached_file($v ) ); // Just the file name;
									$attach_url = wp_get_attachment_url( $v );
									
									if($attch_name){
										$loopattach = '<li class="attch_path_title d-flex">
										<div class="attach_flex d-flex" id="'.$v.'">
										<i class="mr-2 fal fa-file-image healthshiled-green-text"></i>
										<div class="attchName"><a href="'.$attach_url.'" target="_blank" class="attach_url_link">'.$attch_name.'</a></div>
										</div>
										<div class="action-dropdown dropdown">
										<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
										<i class="fal fa-ellipsis-v-alt"></i></a>

										<ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

										<a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttach5='.$v.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


										<div class="dropdown-divider"></div>

										</ul>
										</div>
										</li>';
										echo $loopattach;
									}
									
									}
								}
								?>
							        </ul>
						        </div>
					        </div>
				        </div>
			        </div>
		        
				<?php }else if($immun_drop == 'Immunization Record/History'){?>
					<div class="row">
						<div class="col-md-8">
							<div class="font-heavyweight">
								<h6>
									<?php echo get_the_title(); ?>
								</h6>
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
										foreach ($irhmeta as $k => $v) {
												if($v){
													//echo $v;
									$attch_name = basename( get_attached_file($v ) ); // Just the file name;
									$attach_url = wp_get_attachment_url( $v );
									
									if($attch_name){
										$loopattach = '<li class="attch_path_title d-flex">
										<div class="attach_flex d-flex" id="'.$v.'">
										<i class="mr-2 fal fa-file-image healthshiled-green-text"></i>
										<div class="attchName"><a href="'.$attach_url.'" target="_blank" class="attach_url_link">'.$attch_name.'</a></div>
										</div>
										<div class="action-dropdown dropdown">
										<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
										<i class="fal fa-ellipsis-v-alt"></i></a>

										<ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

										<a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttach6='.$v.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


										<div class="dropdown-divider"></div>

										</ul>
										</div>
										</li>';
										echo $loopattach;
									}
									
									}
								}
								?>
							        </ul>
						        </div>
					        </div>
				        </div>

 		        <?php }else if($immun_drop == 'Other Immunizations'){ ?>
	 				<div class="card-body">
	 					<div class="row">

	 						<div class="col-md-8">
	 							<div class="font-heavyweight">
										<h6>
										<?php echo get_the_title(); ?>
										</h6>
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
						</div>
						<div class="row">
							<div class="col-12">
								<h5 class="healthshiled-green-text mt-3 mb-0 h6 font-heavyweight">				
									Attachments										
								</h5>
								
								<div class="images">
									<ul class="lists_img">
										<?php
										foreach ($othermeta as $k => $v) {
												if($v){
													//echo $v;
									$attch_name = basename( get_attached_file($v ) ); // Just the file name;
									$attach_url = wp_get_attachment_url( $v );
									
									if($attch_name){
										$loopattach = '<li class="attch_path_title d-flex">
										<div class="attach_flex d-flex" id="'.$v.'">
										<i class="mr-2 fal fa-file-image healthshiled-green-text"></i>
										<div class="attchName"><a href="'.$attach_url.'" target="_blank" class="attach_url_link">'.$attch_name.'</a></div>
										</div>
										<div class="action-dropdown dropdown">
										<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
										<i class="fal fa-ellipsis-v-alt"></i></a>

										<ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

										<a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttach7='.$v.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


										<div class="dropdown-divider"></div>

										</ul>
										</div>
										</li>';
										echo $loopattach;
									}
									
									}
								}
								?>
							        </ul>
						        </div>
					        </div>
				        </div>
			        </div>
		        <?php }else if($immun_drop == 'TDAP'){ ?>
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
	 									Date Received:
	 								</div>
	 								<div class="data_values">
	 									<?php echo $tdapdate; ?>
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
										foreach ($tdapmeta as $k => $v) {
									if($v){
									$attch_name = basename( get_attached_file($v ) ); // Just the file name;
									$attach_url = wp_get_attachment_url( $v );
									
									if($attch_name){
										$loopattach = '<li class="attch_path_title d-flex">
										<div class="attach_flex d-flex" id="'.$v.'">
										<i class="mr-2 fal fa-file-image healthshiled-green-text"></i>
										<div class="attchName"><a href="'.$attach_url.'" target="_blank" class="attach_url_link">'.$attch_name.'</a></div>
										</div>
										<div class="action-dropdown dropdown">
										<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
										<i class="fal fa-ellipsis-v-alt"></i></a>

										<ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

										<a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttach8='.$v.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


										<div class="dropdown-divider"></div>

										</ul>
										</div>
										</li>';
										echo $loopattach;
									}
									
									}
								}
								?>
							        </ul>
						        </div>
					        </div>
				        </div>
			        </div>
				<?php }elseif($immun_drop == 'MMR'){ ?>
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
	 									Date Received:
	 								</div>
	 								<div class="data_values">
	 									<?php echo $mmrdate; ?>
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
										foreach ($mmrmeta as $k => $v) {
									if($v){
									$attch_name = basename( get_attached_file($v ) ); // Just the file name;
									$attach_url = wp_get_attachment_url( $v );
									
									if($attch_name){
										$loopattach = '<li class="attch_path_title d-flex">
										<div class="attach_flex d-flex" id="'.$v.'">
										<i class="mr-2 fal fa-file-image healthshiled-green-text"></i>
										<div class="attchName"><a href="'.$attach_url.'" target="_blank" class="attach_url_link">'.$attch_name.'</a></div>
										</div>
										<div class="action-dropdown dropdown">
										<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
										<i class="fal fa-ellipsis-v-alt"></i></a>

										<ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

										<a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttach9='.$v.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


										<div class="dropdown-divider"></div>

										</ul>
										</div>
										</li>';
										echo $loopattach;
									}
									
									}
								}
								?>
							        </ul>
						        </div>
					        </div>
				        </div>
			        </div>
				<?php } ?>
		 </div>
		<?php
				$hepdelete = $_GET['deleteAttach1'];
				$fludelete = $_GET['deleteAttach2'];
				$varicelladelete = $_GET['deleteAttach3'];
				$coviddelete = $_GET['deleteAttach4'];
				$tbdelete = $_GET['deleteAttach5'];
				$irhdelete = $_GET['deleteAttach6'];
				$otherdelete = $_GET['deleteAttach7'];
				$tadpdelete = $_GET['deleteAttach8'];
				$mmrdelete = $_GET['deleteAttach9'];
				
				
				if(isset($hepdelete)){
					echo 'hep';
					$savedAttach = get_post_meta($postId, 'hepatitis_attachment_id', true);
					$array_this = explode(',',$savedAttach);
					wp_delete_post($hepdelete);
					$array_without_strawberries = array_diff($array_this, array($hepdelete));
				
					//print_r($array_without_strawberries);						
					$ids = implode(',', $array_without_strawberries);
					update_post_meta($postId, 'hepatitis_attachment_id', $ids);
					$url = get_site_url().'/profile';
					//wp_redirect( $url );
					//exit;
					echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
					
				}
				if(isset($fludelete)){
					$savedAttach = get_post_meta($postId, 'flu_attachment_id', true);
					$array_this = explode(',',$savedAttach);
					wp_delete_post($fludelete);
					$array_without_strawberries = array_diff($array_this, array($fludelete));
				
					//print_r($array_without_strawberries);						
					$ids = implode(',', $array_without_strawberries);
					update_post_meta($postId, 'flu_attachment_id', $ids);
					$url = get_site_url().'/profile';
					//wp_redirect( $url );
					//exit;
					echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
					
				}
				if(isset($varicelladelete)){
					$savedAttach = get_post_meta($postId, 'varicella_attachment_id', true);
					$array_this = explode(',',$savedAttach);
					wp_delete_post($varicelladelete);
					$array_without_strawberries = array_diff($array_this, array($varicelladelete));
				
					//print_r($array_without_strawberries);						
					$ids = implode(',', $array_without_strawberries);
					update_post_meta($postId, 'varicella_attachment_id', $ids);
					$url = get_site_url().'/profile';
					//wp_redirect( $url );
					//exit;
					echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
					
				}
				if(isset($coviddelete)){
					$savedAttach = get_post_meta($postId, 'covid_attachment_id', true);
					$array_this = explode(',',$savedAttach);
					wp_delete_post($coviddelete);
					$array_without_strawberries = array_diff($array_this, array($coviddelete));
				
					//print_r($array_without_strawberries);						
					$ids = implode(',', $array_without_strawberries);
					update_post_meta($postId, 'covid_attachment_id', $ids);
					$url = get_site_url().'/profile';
					//wp_redirect( $url );
					//exit;
					echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
					
				}
				if(isset($tbdelete)){
					$savedAttach = get_post_meta($postId, 'tb_attachment_id', true);
					$array_this = explode(',',$savedAttach);
					wp_delete_post($tbdelete);
					$array_without_strawberries = array_diff($array_this, array($tbdelete));
				
					//print_r($array_without_strawberries);						
					$ids = implode(',', $array_without_strawberries);
					update_post_meta($postId, 'tb_attachment_id', $ids);
					$url = get_site_url().'/profile';
					//wp_redirect( $url );
					//exit;
					echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
					
				}
				if(isset($otherdelete)){
					$savedAttach = get_post_meta($postId, 'other_attachment_id', true);
					$array_this = explode(',',$savedAttach);
					wp_delete_post($otherdelete);
					$array_without_strawberries = array_diff($array_this, array($otherdelete));
				
					//print_r($array_without_strawberries);						
					$ids = implode(',', $array_without_strawberries);
					update_post_meta($postId, 'other_attachment_id', $ids);
					$url = get_site_url().'/profile';
					//wp_redirect( $url );
					//exit;
					echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
					
				}
				if(isset($tadpdelete)){
					$savedAttach = get_post_meta($postId, 'tdap_attachment_id', true);
					$array_this = explode(',',$savedAttach);
					wp_delete_post($tadpdelete);
					$array_without_strawberries = array_diff($array_this, array($tadpdelete));
				
					//print_r($array_without_strawberries);						
					$ids = implode(',', $array_without_strawberries);
					update_post_meta($postId, 'tdap_attachment_id', $ids);
					$url = get_site_url().'/profile';
					//wp_redirect( $url );
					//exit;
					echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
				}
				if(isset($mmrdelete)){
					$savedAttach = get_post_meta($postId, 'mmr_attachment_id', true);
					$array_this = explode(',',$savedAttach);
					wp_delete_post($mmrdelete);
					$array_without_strawberries = array_diff($array_this, array($_GET['deleteAttachmmr']));
				
					//print_r($array_without_strawberries);						
					$ids = implode(',', $array_without_strawberries);
					update_post_meta($postId, 'mmr_attachment_id', $ids);
					$url = get_site_url().'/profile';
					//wp_redirect( $url );
					//exit;
					echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
				}
				if(isset($irhdelete)){
					$savedAttach = get_post_meta($postId, 'irh_attachment_id', true);
					$array_this = explode(',',$savedAttach);
					wp_delete_post($irhdelete);
					$array_without_strawberries = array_diff($array_this, array($irhdelete));
				
					//print_r($array_without_strawberries);						
					$ids = implode(',', $array_without_strawberries);
					update_post_meta($postId, 'irh_attachment_id', $ids);
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








	
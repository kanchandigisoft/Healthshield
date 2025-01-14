<?php 
if($_GET['empId'])
{
	$User_Id = $_GET['empId'];
}
else
{
	$User_Id = get_current_user_id();
}
 $args = array(  
 	'post_type' => 'immunizations',
 	'post_status' => 'publish',
 	'posts_per_page' => -1,
 	'author' => $User_Id,
 );

 $loop = new WP_Query( $args ); 
 if ( $loop->have_posts()  ){  
 	echo '<ul class="immunizations_display_lists display_lists">';
 	while ( $loop->have_posts() ) : $loop->the_post();
	 $index = $loop->current_post + 1;
		//$immunizationsdate = get_field('immunizations_date');

 		$postId = get_the_ID();
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

		$medsort = get_post_meta( $postId, 'postSorting', true );
 		?>
 		<li class="immunizations_list list-display <?php if($tbdateexpire or $coviddateexpire or $fludateexpire ){echo 'expiredateDiv';} ?>" data-post-id="<?php echo $postId; ?>" id="<?php if($medsort){echo $medsort;}else{ echo $index;} ?>">
 			<div class="rows_lists d-flex">

 				<span class="row-icon me-2">
 					<i class="fal fa-clipboard-check" title="Everything is OK"></i>
 				</span>
					<div class="d-flex flex-grow-1">
						<?php if($immun_drop == 'Hepatitis B'){ ?>
							<div class="title d-flex">
								<div class="immunzations_state immunzations_split_text">
									<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
									<?php echo $immun_drop; ?>
									</a>
								</div>
								</div>
								<?php
								$totalhpcount  = '';
								foreach ($hepmeta as $metas) {
								if($metas){
									$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
									if($attch_name){
										$totalhpcount =  '<i class="fal fa-paperclip"></i>'.$hepcount;
									}
								}
								}?>
								<div class="licattcahments">
								<?php echo $totalhpcount; ?>
								</div>
						<?php }else if($immun_drop == 'Flu'){ ?>
							<div class="title d-flex">
								<div class="immunzations_state immunzations_split_text">
									<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
									<?php echo $immun_drop; ?>
									</a>
								</div>
							
							</div>
							<?php
								$totalflucount  = '';
								foreach ($flumeta as $metas) {
								if($metas){
									$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
									if($attch_name){
										$totalflucount =  '<i class="fal fa-paperclip"></i>'.$flucount;
									}
								}
								}?>
								<div class="licattcahments">
									<?php echo $totalflucount; ?>
								</div>
							
					    <?php }else if($immun_drop == 'Varicella'){ ?>
							<div class="title d-flex">
								<div class="immunzations_state immunzations_split_text">
									<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
									<?php echo $immun_drop; ?>
									</a>
								</div>
								
							</div>
							<?php
								$totalvercount  = '';
								foreach ($varicellameta as $metas) {
								if($metas){
									$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
									if($attch_name){
										$totalvercount =  '<i class="fal fa-paperclip"></i>'.$varicellacount;
									}
								}
								}?>
								<div class="licattcahments">
									<?php echo $totalvercount; ?>
								</div>
						<?php }else if($immun_drop == 'COVID'){ ?>
							<div class="title d-flex">
								<div class="immunzations_state immunzations_split_text">
									<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
									<?php echo $immun_drop; ?>
									</a>
								</div>
							
							</div>
							<?php
								$totalcovcount  = '';
								foreach ($covidmeta as $metas) {
								if($metas){
									$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
									if($attch_name){
										$totalcovcount =  '<i class="fal fa-paperclip"></i>'.$covidcount;
									}
								}
								}?>
								<div class="licattcahments">
									<?php echo $totalcovcount; ?>
								</div>
						<?php }else if($immun_drop == 'TB'){ ?>
							<div class="title d-flex">
								<div class="immunzations_state immunzations_split_text">
									<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
									<?php echo $immun_drop; ?>
									</a>
								</div>
								
							</div>
							<?php
								$totaltbcount  = '';
								foreach ($tbmeta as $metas) {
								if($metas){
									$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
									if($attch_name){
										$totaltbcount =  '<i class="fal fa-paperclip"></i>'.$tbcount;
									}
								}
								}?>
								<div class="licattcahments">
									<?php echo $totaltbcount; ?>
								</div>
							
						<?php } else if($immun_drop == 'TDAP'){ ?>

							<div class="title d-flex">
								<div class="immunzations_state immunzations_split_text">
									<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
									<?php echo $immun_drop; ?>
									</a>
								</div>
								
							</div>
							<?php
								$totaltdapcount  = '';
								foreach ($tdapmeta as $metas) {
								if($metas){
									$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
									if($attch_name){
										$totaltdapcount =  '<i class="fal fa-paperclip"></i>'.$tdapcount;
									}
								}
								}?>
								<div class="licattcahments">
								<?php echo $totaltdapcount; ?>
								</div>
							

						<?php } else if($immun_drop == 'MMR'){ ?>

							<div class="title d-flex">
								<div class="immunzations_state immunzations_split_text">
									<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
									<?php echo $immun_drop; ?>
									</a>
								</div>
								
							</div>
							<?php
								$totalmmrcount  = '';
								foreach ($mmrmeta as $metas) {
								if($metas){
									$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
									if($attch_name){
										$totalmmrcount =  '<i class="fal fa-paperclip"></i>'.$mmrcount;
									}
								}
								}?>
								<div class="licattcahments">
								<?php echo $totalmmrcount; ?>
								</div>

						<?php } else if($immun_drop == 'Immunization Record/History'){ ?>

							<div class="title d-flex">
								<div class="immunzations_state immunzations_split_text">
									<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
									<?php echo $immun_drop; ?>
									</a>
								</div>
								
							</div>
							<?php
								$totalirhcount  = '';
								foreach ($irhmeta as $metas) {
								if($metas){
									$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
									if($attch_name){
										$totalirhcount =  '<i class="fal fa-paperclip"></i>'.$irhcount;
									}
								}
								}?>
								<div class="licattcahments">
								<?php echo $totalirhcount; ?>
								</div>

						<?php } else if($immun_drop == 'Other Immunizations'){ ?>
							<div class="title d-flex">
								<div class="immunzations_state immunzations_split_text">
									<a data-bs-toggle="collapse" data-bs-target="#immunzations_<?php echo get_the_ID(); ?>" href="#"> 
									<?php echo $immun_drop; ?>
									</a>
								</div>		
							</div>
							<?php
								$totalothercount  = '';
								foreach ($othermeta as $metas) {
								if($metas){
									$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
									if($attch_name){
										$totalothercount =  '<i class="fal fa-paperclip"></i>'.$othercount;
									}
								}
								}?>
								<div class="licattcahments">
								<?php echo $totalothercount; ?>
								</div>
						<?php } ?>
					</div>
 				<div class="action-dropdown dropdown">
 					<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger_<?php echo get_the_ID(); ?>" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu"><i class="fal fa-ellipsis-v-alt"></i></a>
 					
					 <ul aria-labelledby="action_menu_trigger_<?php echo get_the_ID(); ?>" class="dropdown-menu dropdown-menu-right">						
 						<a class="dropdown-item" id="<?php echo get_the_ID(); ?>" href="<?php echo get_site_url();?>/profile/immunizations-new?mUID=<?php echo get_the_ID(); ?>">
 							<i class="fal fa-fw fa-pencil"></i> Edit
 						</a>
 						<div class="dropdown-divider"></div>
 						<a class="dropdown-item"  href="<?php echo get_site_url();?>/profile/?archived=<?php echo $postId; ?>" data-method="put" id="archived_post" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>
 						<div class="dropdown-divider"></div>
 						<a class="dropdown-item" rel="nofollow" id="<?php echo get_the_ID(); ?>" onclick="delete_entry(<?php echo get_the_ID(); ?>)"><span class="red-icon"><i class="fa fa-trash" aria-hidden="true"></i> Delete</span>
 						</a>
 					</ul>

 				</div>
 			</div>
 			<div id="immunzations_<?php echo get_the_ID(); ?>" class="collapse card mt-3">
 				<div class="card-header">
 					<div class="row">
 						<div class="col-lg-9">
 							<h5> <?php echo get_the_title(); ?></h5>
 						</div>
 						<div class="col-lg-3">
 							<a class="card-header-link" href="<?php echo get_site_url(); ?>/immunizations/<?php echo $post_slug; ?>">
 								Details
 								<i class="fal fa-link fa-fw"></i>
 							</a>
 						</div>
 					</div>
 				</div>
 				<?php if($immun_drop == 'Hepatitis B'){ ?>
	 				<div class="card-body">
	 					<div class="row">

	 						<div class="col-md-8">
	 							
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
								<div class="card expertion_date text-center <?php if($totaldays < 62 || $totaldays > -1 && $totaldays == -0){ echo 'bg-danger';}else{ echo 'bg-primary';} ?>">
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
								<div class="card expertion_date text-center <?php if($totaldays < 62 || $totaldays > -1 && $totaldays == -0 ){ echo 'bg-danger';}else{ echo 'bg-primary';} ?>">
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
								<div class="card expertion_date text-center <?php if($totaldays < 62 || $totaldays > -1 && $totaldays == -0 ){ echo 'bg-danger';}else{ echo 'bg-primary';} ?>">
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
		        

		        <?php }else if($immun_drop == 'Other Immunizations'){ ?>
	 				<div class="card-body">
	 					<div class="row">

	 						<div class="col-md-8">

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
			        </div>
		        <?php }else if($immun_drop == 'TDAP'){ ?>
					<div class="card-body">
	 					<div class="row">

	 						<div class="col-md-8">
	 							
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

										<a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttachtdap='.$v.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


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
				<?php }else if($immun_drop == 'MMR'){?>
						<div class="card-body">
	 					<div class="row">

	 						<div class="col-md-8">
	 							
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

										<a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttachmmr='.$v.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


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
				<?php	}else if($immun_drop = 'Immunization Record/History'){ ?>
					<div class="card-body">
	 					<div class="row">
	 						<div class="col-md-8">		
	 							<div class="data-row lic_rows_data">
	 								<div class="data_values">
									 Immunization Record/History
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
										foreach ($irhmeta as $k => $v) {
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

										<a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttachirh='.$v.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


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
		</li>
<?php
$arch = $_GET['archived'];
if(isset($arch)){
	$postid = $arch;
	$my_post = array(
		'ID'           => $arch,
		'post_status'   => 'draft',
	);
	wp_update_post( $my_post );
	$url = get_site_url().'/profile';
	// wp_redirect( $url );
	// exit;
	echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
} 
$hepdelete = $_GET['deleteAttach1'];
$fludelete = $_GET['deleteAttach2'];
$varicelladelete = $_GET['deleteAttach3'];
$coviddelete = $_GET['deleteAttach4'];
$tbdelete = $_GET['deleteAttach5'];
$otherdelete = $_GET['deleteAttach6'];
$tadpdelete = $_GET['deleteAttachtdap'];


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
if(isset($_GET['deleteAttachmmr'])){
	$savedAttach = get_post_meta($postId, 'mmr_attachment_id', true);
	$array_this = explode(',',$savedAttach);
	wp_delete_post($_GET['deleteAttachmmr']);
	$array_without_strawberries = array_diff($array_this, array($_GET['deleteAttachmmr']));

	//print_r($array_without_strawberries);						
	$ids = implode(',', $array_without_strawberries);
	update_post_meta($postId, 'mmr_attachment_id', $ids);
	$url = get_site_url().'/profile';
	//wp_redirect( $url );
	//exit;
	echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
}
if(isset($_GET['deleteAttachirh'])){
	$savedAttach = get_post_meta($postId, 'irh_attachment_id', true);
	$array_this = explode(',',$savedAttach);
	wp_delete_post($_GET['deleteAttachirh']);
	$array_without_strawberries = array_diff($array_this, array($_GET['deleteAttachirh']));

	//print_r($array_without_strawberries);						
	$ids = implode(',', $array_without_strawberries);
	update_post_meta($postId, 'irh_attachment_id', $ids);
	$url = get_site_url().'/profile';
	//wp_redirect( $url );
	//exit;
	echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
}

?>

<?php
endwhile;

echo '</ul>';
}else{
	echo "Upload your documentation with this information. It’ll save your recruiter — and you — validation time.";
}
wp_reset_postdata(); 
?>


<script type="text/javascript">
jQuery('#saveOrderimm').click(function(){
	var splashArray = new Array();
	var postid = jQuery('.immunizations_list').attr('data-post-id');
	jQuery( ".user_profile_all_deatils_info ul.immunizations_display_lists .immunizations_list" ).each(function( index ) {

		var menuPos = index;
		var metaKey = jQuery( this ).attr('data-id');
		var postID = jQuery( this ).attr('data-post-id');
		splashArray.push(menuPos+'/'+postID);

	});

	var form_data = new FormData();
	form_data.append('action', 'reOrderData');
	form_data.append('changedData', splashArray);

	jQuery.ajax({
        url: '<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php',
        method: 'POST',
        data: form_data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(results) {
            if (results.status == 'success') {
            	location.reload();
            	console.log(results.msg);
            } else {
                console.log('result is wrong');
            }

        },
        error: function(error) {
            console.log('success not happens');
        }
    });
});


$(function() {
    $( ".user_profile_all_deatils_info ul.immunizations_display_lists" ).sortable();
  });

  jQuery(document).ready(function(){
    /*****************Reorder****************/       
    var divList = jQuery("ul.immunizations_display_lists.display_lists .immunizations_list");
    divList.sort(function(a, b){ return jQuery(a).attr("id")-jQuery(b).attr("id")});
    jQuery("ul.immunizations_display_lists.display_lists").html(divList);

});	

</script>
<script type="text/javascript">
	function delete_entry(id){
     //alert(id);
    var form_data = new FormData();
	form_data.append('action', 'deleteItem');
	form_data.append('item_id', id);

	jQuery.ajax({
        url: '<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php',
        method: 'POST',
        data: form_data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(results) {
            if (results.status == 'success') {
            	location.reload();
            	console.log(results.msg);
            } else {
                console.log('result is wrong');
            }

        },
        error: function(error) {
            console.log('success not happens');
        }
    });


	}
	

	


</script>

<?php
/*
* Template Name: Author Profile
*/
if(is_user_logged_in()){

get_header('dashboard');
echo get_template_part( 'template-headers/sidebar-dashboard' );
global $post, $wpdb;
$current_user = wp_get_current_user();
$role = $current_user->roles;



/**Getting Associated Agency Info***/
$User_Id = get_current_user_id();
$finalAgency = array();
if($role[0] == 'facility')
{
$emps = $wpdb->get_results("SELECT * FROM $wpdb->usermeta WHERE (meta_key = 'selected_facilities')");
}	
if($role[0] == 'CRNA')
{
$emps = $wpdb->get_results("SELECT * FROM $wpdb->usermeta WHERE (meta_key = 'selected_employees')");
}
foreach($emps as $newEmp)
{
	$otherEmpList = $newEmp->meta_value;

	$Savedempoyees = explode(',', $otherEmpList);

	if (in_array($User_Id, $Savedempoyees))
	  {
	  		$finalAgency[] = $newEmp->user_id;
	  }

}

$havingAgency = count($finalAgency);

/****/





if($role[0] == 'Provider' || $role[0] == 'facility'){

}else{
/**Check if Member Active**/
$mepr_user = new MeprUser( get_current_user_id() );
if( $mepr_user->is_active() || $havingAgency > 0) {
    //echo 'Active';
}else if($mepr_user->has_expired()) {
    wp_redirect(get_site_url());
	exit;
}else {

	echo "<script> 
	Swal.fire({
		title: 'Alert!',
		text: 'You have to purchase the membership first to view the Profile',
		icon: 'info',
		showConfirmButton: true,
		allowOutsideClick: true,
		allowEscapeKey: false,
		confirmButtonColor: '#40BFB9',
		});
	</script>";
    wp_redirect(get_the_permalink(5726));
	exit;
} 
}


/************/
$User_Id = get_current_user_id();
$userid_filed = 'user_'.$User_Id;


$middlename = get_field('middle_name',$userid_filed);
$nomiddlename = get_field('no_middle_name',$userid_filed);


$first_name = $current_user->first_name;
$last_name =  $current_user->last_name;

if($middlename){
	if($nomiddlename == 1){
		$fullname = $first_name.' '.$last_name;
	}else{
	$fullname = $first_name.' '.$middlename.' '.$last_name;
	}
}else{

	$fullname = $first_name.' '.$last_name;
}

// $fullname = $first_name.' '.$last_name;
$email = $current_user->user_email;
$userlink_name = $current_user->user_nicename;
$author_avatar = get_user_meta($User_Id,'wp_user_avatar',true);
$authoravatar_url = wp_get_attachment_url( $author_avatar );
$specciality = get_field('specialty', $userid_filed);
$phoneno = get_field('phone_no',$userid_filed);
$yearExp = get_field('year_of_experience',$userid_filed);
$DOB = get_field('date_of_birth',$userid_filed);
$ssn = get_field('ssn',$userid_filed);
$npi = get_field('npi_number',$userid_filed);
$dea = get_field('dea_number',$userid_filed);
$medicare = get_field('medicare',$userid_filed);
$gender = get_field('gender_identity',$userid_filed);
$eni = get_field('einno',$userid_filed);
$site_contact = get_field('site_contact',$userid_filed);
$userstreet = get_field('streetapt',$userid_filed);
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
$middlename = get_field('middle_name',$userid_filed);
$nomiddlename = get_field('no_middle_name',$userid_filed);


if($nomiddlename == 1){
	$nomiddlename = 'Yes';
}else{
	$nomiddlename = 'No';
}
$User_Id = get_current_user_id();
$args = array(  
'post_type' => 'memberpressproduct',
'post_status' => 'publish',
'author' => $User_Id,
);

$loop = new WP_Query( $args ); 
if ( $loop->have_posts()  ){  

while ( $loop->have_posts() ) : $loop->the_post();
	$membertitle = get_the_title();
	$memberID = get_the_ID();	
endwhile;
}

/***************************if Provider **************/
if($role[0] == 'Provider'){ ?>
<div class="content profile_content mainUserProfile">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
			<div class="col-md-4 col-lg-4 col-sm-12 col-12">
				<section class="profile_summery">
					<!-- Logo of provider user -->
					<div class="row">
						<div class="col-lg-12">
							<div class="userprofile_img  text-center providerImg">
								<?php if($author_avatar){ ?>

									<img class="rounded-circle" src="<?php echo $authoravatar_url; ?>" width="100%"/>
									<a class="profile-avatar-remove-button rounded-circle" data-bs-confirm="Are you sure?" data-bs-method="delete" rel="nofollow" href="<?php echo get_site_url();?>/profile?delete=<?php echo $User_Id;?>"><i class="fal fa-trash-alt"></i></a>
								
								<?php }else{ ?>
									<i class="fad fa-user-circle circle noavatar rounded-circle"></i>

								<?php } ?>

								<?php
								$old_avatars = $author_avatar;
								$upload_path = wp_upload_dir();
								$deleteid = $_GET['delete'];
								if(isset($_GET['delete'])){

								if ( is_array($old_avatars) ) {
								foreach ($old_avatars as $old_avatar ) {
								$old_avatar_path = str_replace( $upload_path['baseurl'], $upload_path['basedir'], $old_avatar );
								@unlink( $old_avatar_path );    
								}
								}

								delete_user_meta( $deleteid, 'wp_user_avatar' );
								$url = get_site_url().'/profile';
								echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
								//wp_redirect( $url );
								//exit;
								}

								$provider_agency = get_user_meta($User_Id, 'provider_agency', true);
								?>
							</div>
						</div>
					</div>
				</section>
			</div>
			<div class="col-md-8 col-lg-8 col-sm-12 col-12">
				<!-- Info of provider user -->
				<section class="personal_info mt-3 employerProfile" id="personal_information">
				    <div class="row">
						<div class="col-lg-10">
							<h2>Personal Information</h2>
							<div class="table_row">
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Full Name:</strong></div>
									<div class="data-value ms-1"><?php if($fullname){ echo $fullname; }else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Email:</strong></div>
									<div class="data-value ms-1"><?php if($email){ echo'<a href="mailto:'.$email.'">'.$email.'</a>'; }else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Phone Number:</strong></div>
									<div class="data-value ms-1"><?php if($phoneno){echo'<a href="tel:'.$phoneno.'">'.$phoneno.'</a>';}else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Agency Name:</strong></div>
									<div class="data-value ms-1"><?php if($provider_agency){echo $provider_agency; }else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Address:</strong></div>
									<div class="data-value ms-1"><?php if($userstreet && $usercity && $userstate && 
										$userzipcode){ echo $userstreet.' '.$usercity.' '.$userstate.' '.$userzipcode;}
										else if($userstreet){
											echo $userstreet;
										}else{
											echo '—';
										}
										?></div>
								</div>
								<?php  if($eni){ ?>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>EIN:</strong></div>
									<div class="data-value ms-1"><?php  if($eni){ echo $eni;  }else{ echo '—'; } ?></div>
								</div>
								<?php } ?>
								<?php  if($site_contact){ ?>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Site Contact:</strong></div>
									<div class="data-value ms-1">
										<?php  if($site_contact){ echo $site_contact;  }else{ echo '—'; } ?>
									</div>
								</div>
								<?php } ?>

								</div>
						</div>
						<div class="col-lg-2">
							<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/info-edit"><i class="fal fa-pencil"></i></a>
						</div>
					</div>	
				</section>				
			</div>
		</div>
		<section class="bottom_provider_buttons">
			<div class="row">
				<div class="col-md-4 col-lg-4 col-sm-12 col-12">
					<a href="<?php echo get_site_url();?>/profile/provider" class="btn btn-medium providerBtn bottomBigbtn">Provider</a>
				</div>
				<div class="col-md-4 col-lg-4 col-sm-12 col-12">
					<a href="<?php echo get_site_url();?>/profile/facilities" class="btn btn-medium facilitiesBtn bottomBigbtn">Facilities/contracts</a>
				</div>
				<div class="col-md-4 col-lg-4 col-sm-12 col-12">
					<a href="<?php echo get_site_url();?>/profile/task-complete" class="btn btn-medium taskBtn bottomBigbtn">Expirables</a>
				</div>
			</div>
		</section>
	</div>
</div>

<?php
} else if( $role[0] == 'facility' ){ ?>


<div class="content profile_content mainUserProfile">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
			<div class="col-md-4 col-lg-4 col-sm-12 col-12">
				<section class="profile_summery facility">
					<!-- Logo of provider user -->
					<div class="row">
						<div class="col-lg-12">
							<div class="userprofile_img  text-center providerImg">
								<?php if($author_avatar){ ?>

									<img class="rounded-circle" src="<?php echo $authoravatar_url; ?>" width="100%"/>
									<a class="profile-avatar-remove-button rounded-circle" data-bs-confirm="Are you sure?" data-bs-method="delete" rel="nofollow" href="<?php echo get_site_url();?>/profile?delete=<?php echo $User_Id;?>"><i class="fal fa-trash-alt"></i></a>
								
								<?php }else{ ?>
									<i class="fad fa-user-circle circle noavatar rounded-circle"></i>

								<?php } ?>

								<?php
								$old_avatars = $author_avatar;
								$upload_path = wp_upload_dir();
								$deleteid = $_GET['delete'];
								if(isset($_GET['delete'])){

								if ( is_array($old_avatars) ) {
								foreach ($old_avatars as $old_avatar ) {
								$old_avatar_path = str_replace( $upload_path['baseurl'], $upload_path['basedir'], $old_avatar );
								@unlink( $old_avatar_path );    
								}
								}

								delete_user_meta( $deleteid, 'wp_user_avatar' );
								$url = get_site_url().'/profile';
								echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
								//wp_redirect( $url );
								//exit;
								}
								?>
							</div>
						</div>
					</div>
				</section>
			</div>
			<div class="col-md-8 col-lg-8 col-sm-12 col-12">
				<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/info-edit"><i class="fal fa-pencil"></i></a>
				<!-- Info of provider user -->				
			</div>
			<div class="col-md-12 col-lg-12 col-sm-12 col-12">

				<div class="auth_tabs tab_providers">
						<nav>
                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="true">Profile</button>
                            <button class="nav-link" id="nav-payor-tab" data-bs-toggle="tab" data-bs-target="#nav-payor" type="button" role="tab" aria-controls="nav-payor" aria-selected="false">Employees</button>
                            <button class="nav-link" id="nav-verification-tab" data-bs-toggle="tab" data-bs-target="#nav-verification" type="button" role="tab" aria-controls="nav-verification" aria-selected="false">Contract</button>
                            <button class="nav-link" id="nav-docs-tab" data-bs-toggle="tab" data-bs-target="#nav-docs" type="button" role="tab" aria-controls="nav-docs" aria-selected="false">Important Documents</button>
                        </div>
                    </nav>

							<div class="tab-content" id="nav-tabContent">
                        	<div class="tab-pane fade active show" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        		

							<h2 class="facilityProfile">Personal Information</h2>
							<div class="table_row">
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Full Name:</strong></div>
									<div class="data-value ms-1"><?php if($fullname){ echo $fullname; }else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Email:</strong></div>
									<div class="data-value ms-1"><?php if($email){ echo'<a href="mailto:'.$email.'">'.$email.'</a>'; }else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Phone Number:</strong></div>
									<div class="data-value ms-1"><?php if($phoneno){echo'<a href="tel:'.$phoneno.'">'.$phoneno.'</a>';}else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Address:</strong></div>
									<div class="data-value ms-1"><?php if($userstreet){
											echo $userstreet;
										}else{
											echo '—';
										}
										?></div>
								</div>
								
								<?php  if($site_contact){ ?>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Site Contact:</strong></div>
									<div class="data-value ms-1">
										<?php  if($site_contact){ echo $site_contact;  }else{ echo '—'; } ?>
									</div>
								</div>
								<?php } ?>

								</div>
								<?php
									$usermeta = get_user_meta($User_Id);
								// 	echo '<pre>';
								// 	print_r($usermeta);
								// 	echo '</pre>';
								// ?>

						</div>
					
					<div class="tab-pane fade" id="nav-payor" role="tabpanel" aria-labelledby="nav-payor-tab">
                            <div class="payorDetails py-5">

                            </div>
                        </div>
                        <div class="tab-pane fade " id="nav-verification" role="tabpanel" aria-labelledby="nav-verification-tab">
                            <?php //include('providers/provider-verification.php'); ?>
                        </div>
                        <div class="tab-pane fade " id="nav-docs" role="tabpanel" aria-labelledby="nav-docs-tab">
                            <?php //include('providers/provider-verification.php'); ?>
                        </div>
                    </div>
                    </div>
			</div>
		</div>
	</div>
</div>

<?php } else { ?>
<div class="content profile_content mainUserProfile membershiptype_<?php echo $membertitle.''.$memberID;?>" >
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
			<div class="col-md-6 col-lg-6 col-sm-12 col-12">
				<section class="profile-summery">
					<div class="row">
						<div class="col-lg-3">
							<div class="userprofile_img  text-center">
								<?php if($author_avatar){
									?>
									<img class="rounded-circle" src="<?php echo $authoravatar_url; ?>" width="100%"/>
									<a class="profile-avatar-remove-button rounded-circle" data-bs-confirm="Are you sure?" data-bs-method="delete" rel="nofollow" href="<?php echo get_site_url();?>/profile?delete=<?php echo $User_Id;?>"><i class="fal fa-trash-alt"></i></a>
									<?php
								}else{
									?>
								   <i class="fad fa-user-circle circle noavatar rounded-circle"></i>
								<?php } ?>
								<?php
									$old_avatars = $author_avatar;
									$upload_path = wp_upload_dir();
									$deleteid = $_GET['delete'];
									if(isset($_GET['delete'])){

										if ( is_array($old_avatars) ) {
										foreach ($old_avatars as $old_avatar ) {
										$old_avatar_path = str_replace( $upload_path['baseurl'], $upload_path['basedir'], $old_avatar );
										@unlink( $old_avatar_path );    
										}
										}

										delete_user_meta( $deleteid, 'wp_user_avatar' );
										$url = get_site_url().'/profile';
										echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
										//wp_redirect( $url );
										//exit;
									}
									 ?>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="username_full">
								<h1 class="myname"><?php echo $fullname; ?></h1>
							</div>
							<div class="roll-and-specialty">
								<h2><?php echo $role[0]; ?></h2>
								<h2><?php echo $specciality; ?><h2>
							</div>
						</div>
						<div class="col-lg-2">
							<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/edit"><i class="fal fa-pencil"></i></a>
						</div>
					</div>
				</section>
				<section class="personal_info mt-3 EmployeeProfile" id="personal_information">
					<div class="row">
						<div class="col-lg-10">
							<h2>Personal Information</h2>
							<div class="table_row">
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Full Name:</strong></div>
									<div class="data-value ms-1"><?php if($fullname){ echo $fullname; }else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Years of Experience:</strong></div>
									<div class="data-value ms-1"><?php if($yearExp){echo $yearExp;}else{echo'—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Email:</strong></div>
									<div class="data-value ms-1"><?php if($email){ echo'<a href="mailto:'.$email.'">'.$email.'</a>'; }else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Phone Number:</strong></div>
									<div class="data-value ms-1"><?php if($phoneno){echo'<a href="tel:'.$phoneno.'">'.$phoneno.'</a>';}else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Gender:</strong></div>
									<div class="data-value ms-1"><?php if($gender){ echo $gender;}else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>SSN:</strong></div>
									<div class="data-value ms-1"><?php if($ssn){ $splitnumber = explode('-',$ssn); echo '***-**-'.$splitnumber[2];}else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Date of Birth:</strong></div>
									<div class="data-value ms-1"><?php if($DOB){ echo $DOB;}else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Tax Home Address:</strong></div>
									<div class="data-value ms-1"><?php if($userstreet && $usercity && $userstate && 
										$userzipcode){ echo $userstreet.' '.$usercity.' '.$userstate.' '.$userzipcode;}else{echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Emergency Contact:</strong></div>
									<div class="data-value ms-1"><?php if($emg_contact_name && $emg_contact_relationship){echo $emg_contact_name .' ('.$emg_contact_relationship.')';}else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Emergency Contact Phone:</strong></div>
									<div class="data-value ms-1"><?php if($emg_contact_phone){echo'<a href="tel:'.$emg_contact_phone.'">'.$emg_contact_phone.'</a>';}else{echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>NPI Number:</strong></div>
									<div class="data-value ms-1"><?php if($npi){echo $npi;}else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>DEA Number:</strong></div>
									<div class="data-value ms-1"><?php if($dea){echo $dea;}else{ echo '—';} ?></div>
								</div>
								<div class="data-flex d-flex">
									<div class="data-label"><strong>Medicare:</strong></div>
									<div class="data-value ms-1"><?php if($medicare){echo $medicare;}else{ echo '—';} ?></div>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/edit"><i class="fal fa-pencil"></i></a>
						</div>
					</div>
				</section>
				<hr>
				<section style="display: none;" id="agencies_profile" class="profile-section agencies_profile-list mt-4">
					<div class="row">
						<div class="col-12 col-lg-10">
							<h2>Agencies List</h2>	
							<?php
							$args = array(
								'role' => 'Provider',
								'orderby' => 'user_nicename',
								'order' => 'ASC'
								);
							$agencieslist = get_users($args);
						?>
						 <form name="agencyForm" id="agencyForm" method="post" enctype="multipart/form-data" autocomplete="off">
							<input type="hidden" id="userid" name="userid" value="<?php echo $User_Id; ?>">
							<select name="provider_agency" id="agency_list_id">
								<option value="">Select agency</option>
								<?php foreach ($agencieslist as $user) {	
									$selectedagency = get_user_meta($User_Id,'user_agency_name',true);
									if($selectedagency == $user->display_name){
									 	$clSelected = 'selected';
									}else{
									 	$clSelected = '';
									}
									?>
								<option value="<?php echo $user->display_name; ?>" <?php echo $clSelected; ?>><?php echo $user->display_name; ?></option>
								<?php } ?>
							</select>

							<div class="form-group mt-3 mb-3">
								<button class="btn btn-primary agencysaveForm" name="agencysaveForm" type="submit">Save Changes</button>
							</div>
						</form>
						</div>						

						<div class="col-12"></div>

						<?php
						if(isset($_POST['agencysaveForm'])){
							$userid = $_POST['userid'];
							$agencynames = $_POST['provider_agency'];
							update_user_meta($userid,'user_agency_name', $agencynames);
						}
						
						?>
					</div>
				</section>
			</div>
			<div class="col-md-6 col-lg-6 col-sm-12 col-12">
				<div class="user_profile_all_deatils_info profileattachments">	


				<?php	
					$user_id = get_current_user_id();
					$workHistory = get_user_meta( $user_id, 'workHistory', true );
					$education = get_user_meta( $user_id, 'education', true );
					$licenses = get_user_meta( $user_id, 'licenses', true );
					$military = get_user_meta( $user_id, 'military', true );
					$certifications = get_user_meta( $user_id, 'certifications', true );
					$immunizations = get_user_meta( $user_id, 'immunizations', true );
					$skills = get_user_meta( $user_id, 'skills-and-checklists', true );
					$malpractice = get_user_meta( $user_id, 'malpractice-insurance', true );
					$registrations = get_user_meta( $user_id, 'registrations', true );
					$legal = get_user_meta( $user_id, 'legal-documents', true );
					$references = get_user_meta( $user_id, 'references', true );
					$case = get_user_meta( $user_id, 'case-logs', true );
					$additionalDocuments = get_user_meta( $user_id, 'additionalDocuments', true );
					$authorization = get_user_meta( $user_id, 'authorization', true );


            	?>
	<!--------------------------------------education section start -------------------------------------------------->

				<section id="education" data-id="<?php echo $education; ?>" class="profile-section-types">
					<div class="dragndropsec">
						<div class="row">
							<div class="col-lg-8">
								<h2>
							<span>
							Education
							<small class="header-link-sm"><a href="<?php echo get_site_url();?>/profile/education/archived">View Archived</a></small>
							</span>
							
							</h2>
							</div>
							<div class="col-lg-4 text-end d-flex gap-1">
								<input type="hidden" id="row_order" name="row_order">
								<a id="saveOrder" class="btn btn-floating btn-primary text-white savorder">Save Order</a>
								<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/education/new"><i class="fal fa-plus"></i></a>
							</div>
						</div>
						<?php echo get_template_part('template-part/education-posts'); ?>
					</div>
				</section>

	<!--------------------------------------workHistory section start -------------------------------------------------->

				<section id="workHistory" data-id="<?php echo $workHistory; ?>" class="profile-section-types">
					<div class="dragndropsec">
						<div class="row">
							<div class="col-lg-8">
								<h2>
							<span>
							Work History
							<small class="header-link-sm"><a href="<?php echo get_site_url();?>/profile/work-history-archived">View Archived</a></small>
							</span>
							
							</h2>
							</div>
							<div class="col-lg-4 text-end d-flex gap-1">
							<input type="hidden" id="row_order" name="row_order">
								<a id="saveOrderworkhistory" class="btn btn-floating btn-primary text-white savorder">Save Order</a>
								<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/work-history-new"><i class="fal fa-plus"></i></a>
							</div>
						</div>
						<?php echo get_template_part('template-part/work-posts'); ?>
					</div>
				</section>
<!--------------------------------------Military section start -------------------------------------------------->
				<section id="military" data-id="<?php echo $military; ?>" class="profile-section-types">
					<div class="dragndropsec">
						<div class="row">
							<div class="col-lg-8">
								<h2>
							<span>
							Military
							<small class="header-link-sm"><a href="<?php echo get_site_url();?>/profile/military-archived">View Archived</a></small>
							</span>
							
							</h2>
							</div>
							<div class="col-lg-4 text-end d-flex gap-1">
							<input type="hidden" id="row_order" name="row_order">
								<a id="saveOrderMil" class="btn btn-floating btn-primary text-white savorder">Save Order</a>
								<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/military-new"><i class="fal fa-plus"></i></a>
							</div>
						</div>
						<?php 
						$User_Id = get_current_user_id();
						$args = array(  
						'post_type' => 'military',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'author' => $User_Id,
						);

						$loop = new WP_Query( $args ); 
						if ( $loop->have_posts()  ){  
						echo '<ul class="military_display_lists display_lists">';
						while ( $loop->have_posts() ) : $loop->the_post();
						$index = $loop->current_post + 1;
						$militaryHistory = get_field('military_history' );

						$postId = get_the_ID();
						$milsort = get_post_meta( $postId, 'postSorting', true );
						$post_slug = $post->post_name;
						$imgs = get_post_meta($postId,'military_attachment_id',true);
						$meta = explode(',', $imgs);

						if($imgs ){ $count = count($meta); }

						?>
						<li class="military_list list-display" data-post-id="<?php echo $postId; ?>" id="<?php if($milsort){echo $milsort;}else{ echo $index;} ?>">
						<div class="rows_lists d-flex">

						<span class="row-icon me-2">
						<i class="fal fa-clipboard-check" title="Everything is OK"></i>
						</span>

						<div class="title d-flex">
						<div class="military_state military_split_text">
						<a href="<?php get_site_url();?>/military/<?php echo $post_slug; ?>"> 
						<?php echo $militaryHistory; ?>
						</a>
						</div>

						</div>
						<?php
						$totalcount  = '';
						foreach ($meta as $metas) {
							if($metas){
								$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
								if($attch_name){
									$totalcount =  '<i class="fal fa-paperclip"></i>'.$count;
								}
							}
						}?>
						<div class="licattcahments">
							<?php echo $totalcount; ?>
						</div>
						<div class="action-dropdown dropdown">
						<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger_<?php echo get_the_ID(); ?>" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu"><i class="fal fa-ellipsis-v-alt"></i></a>
						<ul aria-labelledby="action_menu_trigger_<?php echo get_the_ID(); ?>" class="dropdown-menu dropdown-menu-right">
						<h6 class="dropdown-header military_split_text"><?php echo $militaryHistory; ?></h6>	
							<a class="dropdown-item" href="<?php echo get_site_url();?>/profile/military-new?mlid=<?php echo $postId; ?>&attch=attachments">
							<i class="fal fa-fw fa-plus"></i> Add Attachment
						</a>
											
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" id="<?php $postId; ?>" href="<?php echo get_site_url();?>/profile/military-new?mlid=<?php echo $postId; ?>">
							<i class="fal fa-fw fa-pencil"></i> Edit
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item"  href="<?php echo get_site_url();?>/profile/?archived=<?php echo $postId; ?>" data-method="put" id="archived_post" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" rel="nofollow" id="<?php echo get_the_ID(); ?>" onclick="delete_entry_ed(<?php echo get_the_ID(); ?>)"><span class="red-icon"><i class="fa fa-trash" aria-hidden="true"></i> Delete</span></a>
 			
					</ul>

						</div>
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
						//wp_redirect( $url );
						//exit;
						echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
						}
						$deleteAttach1 = $_GET['deleteAttach'];
						if(isset($deleteAttach1)){
						$savedAttach = get_post_meta($postId, 'military_attachment_id', true);
						$array_this = explode(',',$savedAttach);
						wp_delete_post($deleteAttach1);
						$array_without_strawberries = array_diff($array_this, array($deleteAttach1));

						//print_r($array_without_strawberries);						
						$ids = implode(',', $array_without_strawberries);
						update_post_meta($postId, 'military_attachment_id', $ids);
						$url = get_site_url().'/profile';	
						//wp_redirect( $url );
						//exit;
						echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
						}
						endwhile;

						echo '</ul>';
						}else{
						echo "Please add your military history and files here!";
						}
						wp_reset_postdata(); 
						?>
						<script type="text/javascript">
						jQuery('#saveOrderMil').click(function(){
							var splashArray = new Array();
							var postid = jQuery('.military_list').attr('data-post-id');
							jQuery( ".user_profile_all_deatils_info ul.military_display_lists .military_list" ).each(function( index ) {

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
							$( ".user_profile_all_deatils_info ul.military_display_lists" ).sortable();
						});

						jQuery(document).ready(function(){
							/*****************Reorder****************/       
							var divList = jQuery("ul.military_display_lists.display_lists .military_list");
							divList.sort(function(a, b){ return jQuery(a).attr("id")-jQuery(b).attr("id")});
							jQuery("ul.military_display_lists.display_lists").html(divList);

						});	

						</script>
					</div>
				</section>
				
	<!--------------------------------------licenses section start -------------------------------------------------->				
				<section id="licenses" data-id="<?php echo $licenses; ?>" class="profile-section-types">
					<div class="dragndropsec">
						<div class="row">
							<div class="col-lg-8">
							<h2>
								<span>
								Licenses
								<small class="header-link-sm"><a href="<?php echo get_site_url();?>/profile/licenses/archived">View Archived</a></small>
								</span>
							</h2>
							</div>
							<?php 
							
							$args = array(  
								'post_type' => 'licenses',
								'post_status' => 'publish',
								'posts_per_page' => -1,
								'author' => $User_Id,
							);
							$loop = new WP_Query( $args );
							$numberOfPosts= $loop->found_posts;

							if($membertitle == 'Elite'){
								if($numberOfPosts < '3'){ ?>
									<div class="col-lg-4 text-end d-flex gap-1">
									<input type="hidden" id="row_order" name="row_order">
									<a id="saveOrderlc" class="btn btn-floating btn-primary text-white savorder">Save Order</a>
									<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/licenses/licenses-new"><i class="fal fa-plus"></i></a>
									</div>
									<script type="text/javascript">
							jQuery('#saveOrderlc').click(function(){
							var splashArray = new Array();
							var postid = jQuery('.licenses_list').attr('data-post-id');
							jQuery( ".user_profile_all_deatils_info ul.licenses_display_lists .licenses_list" ).each(function( index ) {

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
							$( ".user_profile_all_deatils_info ul.licenses_display_lists" ).sortable();
							});

							jQuery(document).ready(function(){
							/*****************Reorder****************/       
							var divList = jQuery("ul.licenses_display_lists.display_lists .licenses_list");
							divList.sort(function(a, b){ return jQuery(a).attr("id")-jQuery(b).attr("id")});
							jQuery("ul.licenses_display_lists.display_lists").html(divList);

							});	

							</script>
								<?php }else{

								}

							}else{ ?>	
								<div class="col-lg-4 text-end d-flex gap-1">
								<input type="hidden" id="row_order" name="row_order">
								<a id="saveOrderlc" class="btn btn-floating btn-primary text-white savorder">Save Order</a>
								<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/licenses/licenses-new"><i class="fal fa-plus"></i></a>
								</div>
								<script type="text/javascript">
							jQuery('#saveOrderlc').click(function(){
							var splashArray = new Array();
							var postid = jQuery('.licenses_list').attr('data-post-id');
							jQuery( ".user_profile_all_deatils_info ul.licenses_display_lists .licenses_list" ).each(function( index ) {

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
							$( ".user_profile_all_deatils_info ul.licenses_display_lists" ).sortable();
							});

							jQuery(document).ready(function(){
							/*****************Reorder****************/       
							var divList = jQuery("ul.licenses_display_lists.display_lists .licenses_list");
							divList.sort(function(a, b){ return jQuery(a).attr("id")-jQuery(b).attr("id")});
							jQuery("ul.licenses_display_lists.display_lists").html(divList);

							});	

							</script>
							<?php } ?>

							<!-- <div class="col-lg-2 text-end">
								<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/licenses/licenses-new"><i class="fal fa-plus"></i></a>
							</div> -->
						</div>
						<?php 


							$args = array(  
								'post_type' => 'licenses',
								'post_status' => 'publish',
								'posts_per_page' => -1,
								'author' => $User_Id,
							);
							
							$loop = new WP_Query( $args ); 
							if ( $loop->have_posts()  ){  
								echo '<ul class="licenses_display_lists display_lists">';
								while ( $loop->have_posts() ) : $loop->the_post();
								$index = $loop->current_post + 1;
									$postId = get_the_ID();
									$imgs = get_post_meta($postId,'license_attachment_id',true);
									$meta = explode(',', $imgs);
									$licsort = get_post_meta( $postId, 'postSorting', true );
									if($imgs ){ $count = count($meta); }
									$post_slug = $post->post_name;

										$lccompact = get_field('licenses_compact');
										$lcIssue = get_field('issue_date');
										if($lccompact == 1){
										$val_compact = 'Yes';
										}else{
										$val_compact = 'No';
										}	
								?>
								<li class="licenses_list list-display" data-post-id="<?php echo $postId; ?>" id="<?php if($licsort){echo $licsort;}else{ echo $index;} ?>">
									<div class="rows_lists">
										
											<span class="row-icon">
												<i class="fal fa-clipboard-check" title="Everything is OK"></i>
											</span>
										
											<div class="title d-flex">
												<div class="lic_state">
												<a data-bs-toggle="collapse" data-bs-target="#licenses_<?php echo get_the_ID(); ?>" href="#"> <?php echo get_field('licenses_state'); ?>
												</a>
												<?php 
								$verified = get_field('verified__unverified');
	 							 if ($verified == 'Verified') {
									  ?> 
								 
								<div class="verified_icon">
									<svg height="15" width="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g fill="none" fill-rule="evenodd"><path d="M256 472.153L176.892 512l-41.725-81.129-86.275-16.654 11.596-91.422L0 256l60.488-66.795-11.596-91.422 86.275-16.654L176.892 0 256 39.847 335.108 0l41.725 81.129 86.275 16.654-11.596 91.422L512 256l-60.488 66.795 11.596 91.422-86.275 16.654L335.108 512z" fill="#4285f4"/><path d="M211.824 284.5L171 243.678l-36 36 40.824 40.824-.063.062 36 36 .063-.062.062.062 36-36-.062-.062L376.324 192l-36-36z" fill="#fff"/></g></svg>
								</div>
								<?php } ?>
													
												</div>
												<div class="lic_type"> <?php echo get_field('licenses_type'); ?> </div>
											</div>
												<?php
												$totalcount  = '';
												foreach ($meta as $metas) {
													if($metas){
														$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
														if($attch_name){
															$totalcount =  '<i class="fal fa-paperclip"></i>'.$count;
														}
													}
												}?>
												<div class="licattcahments">
													<?php echo $totalcount; ?>
												</div>
											<div class="action-dropdown dropdown">
												<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger_<?php echo get_the_ID(); ?>" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu"><i class="fal fa-ellipsis-v-alt"></i></a>
												<ul aria-labelledby="action_menu_trigger_<?php echo get_the_ID(); ?>" class="dropdown-menu dropdown-menu-right">
												<h6 class="dropdown-header"> <?php echo get_field('licenses_state'); ?></h6>
												<a class="dropdown-item" href="<?php echo get_site_url();?>/profile/licenses/licenses-new?lid=<?php echo $postId; ?>&attch=attachments">
												<i class="fal fa-fw fa-plus"></i> Add Attachment
												</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" id="<?php $postId; ?>" href="<?php echo get_site_url();?>/profile/licenses/licenses-new?lid=<?php echo $postId; ?>">
												<i class="fal fa-fw fa-pencil"></i> Edit
												</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item"  href="<?php echo get_site_url();?>/profile/?archivedlIc=<?php echo $postId; ?>" data-method="put" id="archived_post" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" rel="nofollow" id="<?php echo get_the_ID(); ?>" onclick="delete_entry_ed(<?php echo get_the_ID(); ?>)"><span class="red-icon"><i class="fa fa-trash" aria-hidden="true"></i> Delete</span></a>
 			
											</ul>
										
										</div>
									</div>
									<div id="licenses_<?php echo get_the_ID(); ?>" class="collapse card mt-3">
										<div class="card-header">
											<div class="row">
											<div class="col-lg-9">
											<h5> <?php echo get_field('licenses_type'); ?></h5>
											</div>
											<div class="col-lg-3">
												<a class="card-header-link" href="<?php echo get_site_url(); ?>/licenses/<?php echo $post_slug; ?>">
														Details
														<i class="fal fa-link fa-fw"></i>
												</a>
											</div>
											</div>
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-md-8">
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
													<?php echo $lcIssue; ?>
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
															<?php echo get_field('expire_date'); ?>
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
															if($metas){
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
																	<a class="healthshiled-delete-text dropdown-item" data-method="put" href="#" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>

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
										</div>
									</div>
								</li>

							<?php

								$arch = $_GET['archivedlIc'];
								if(isset($arch)){
									$postid = $arch;
									$my_post = array(
									'ID'           => $arch,
									'post_status'   => 'draft',
									);
									wp_update_post( $my_post );
									$url = get_site_url().'/profile';
									echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
									//wp_redirect( $url );
									//exit;
								}
								$deleteAttach = $_GET['deleteAttach'];
								if(isset($deleteAttach)){
									$savedAttach = get_post_meta($postId, 'license_attachment_id', true);
									$array_this = explode(',',$savedAttach);
									wp_delete_post($deleteAttach);
									$array_without_strawberries = array_diff($array_this, array($deleteAttach));

									//print_r($array_without_strawberries);						
									$ids = implode(',', $array_without_strawberries);
									update_post_meta($postId, 'license_attachment_id', $ids);
									$url = get_site_url().'/profile';
									//wp_redirect( $url );
									//exit;
									echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
								}
								endwhile;
								
								echo '</ul>';
								
								}else{
									echo "Let's add some licenses.";
								}
								wp_reset_postdata(); 
							?>
						</div>
				</section>			
	
	<!--------------------------------------Board and Professional Certifications section start -------------------------------------------------->			
				<section id="certifications" data-id="<?php echo $certifications; ?>" class="profile-section-types">
					<div class="dragndropsec">
						<div class="row">
							<div class="col-lg-8">
								<h2>
							<span>
							Board and Professional Certifications
							<small class="header-link-sm"><a href="<?php echo get_site_url();?>/profile/certifications/archived">View Archived</a></small>
							</span>
							
							</h2>
							</div>
							<?php
							$args = array(  
								'post_type' => 'certifications',
								'post_status' => 'publish',
								'author' => $User_Id,
							);
							$loop = new WP_Query( $args );
							$numberOfPosts= $loop->found_posts;
							
							if($membertitle == 'Elite'){
								if($numberOfPosts < '3'){ ?>
								<div class="col-lg-4 text-end d-flex gap-1">
								<input type="hidden" id="row_order" name="row_order">
								<a id="saveOrdercer" class="btn btn-floating btn-primary text-white savorder">Save Order</a>
									<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/certifications/new"><i class="fal fa-plus"></i></a>
								</div>
								<?php }else{

								}

							}else{ ?>	
								<div class="col-lg-4 text-end d-flex gap-1">
								<input type="hidden" id="row_order" name="row_order">
								<a id="saveOrdercer" class="btn btn-floating btn-primary text-white savorder">Save Order</a>
								<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/certifications/new"><i class="fal fa-plus"></i></a>
								</div>
							<?php } ?>
							
						</div>
						<?php echo get_template_part('template-part/certificate-posts'); ?>
					</div>
				</section>
	<!--------------------------------------Immunizations section start -------------------------------------------------->			
				<section id="immunizations" data-id="<?php echo $immunizations; ?>" class="profile-section-types">
					<div class="dragndropsec">
						<div class="row">
							<div class="col-lg-8">
								<h2>
							<span>
							Immunizations
							<small class="header-link-sm"><a href="<?php echo get_site_url();?>/profile/immunizations-archived">View Archived</a></small>
							</span>
							
							</h2>
							</div>
							<div class="col-lg-4 text-end d-flex gap-1">
							<input type="hidden" id="row_order" name="row_order">
								<a id="saveOrderimm" class="btn btn-floating btn-primary text-white savorder">Save Order</a>
								<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/immunizations-new"><i class="fal fa-plus"></i></a>
							</div>
						</div>
						<?php echo get_template_part('template-part/medical-posts'); ?>
					</div>
				</section>			
	<!------------------------skills-and-checklists section start ------------------------------>

				<section id="skills-and-checklists" data-id="<?php echo $skills; ?>" class="profile-section-types" style="display: none;">
					<div class="dragndropsec">
						<h2>Skills</h2>
						<section id="addEhrs" clas="skills_cl">
							<div class="row">
								<div class="col-lg-8">
								<h3>
									<span>
									Electronic Health Record Systems
									<small class="header-link-sm"><a href="<?php echo get_site_url();?>/profile/skill-archived/">View Archived</a></small>
									</span>

								</h3>
								</div>
								<div class="col-lg-4 text-end d-flex gap-1">
								<input type="hidden" id="row_order" name="row_order">
								<a id="saveOrderskillcl" class="btn btn-floating btn-primary text-white savorder">Save Order</a>
								<a class="btn btn-floating healthshiled-new" data-bs-target="#add_ehr_modal" data-bs-toggle="modal"href="#add_ehr_modal"><i class="fal fa-plus"></i></a>
								</div>
							</div>
								<?php
								$args = array(  
								'post_type' => 'skills',
								'post_status' => 'publish',
								'posts_per_page' => -1,
								'author' => $User_Id,
								);
							
							$loop = new WP_Query( $args ); 
							if ( $loop->have_posts()  ){  
								echo '<ul class="skill_display_lists display_lists">';
								while ( $loop->have_posts() ) : $loop->the_post();
								$index = $loop->current_post + 1;
									$ehrs_var = get_field('ehrs');
									$skillId = get_the_ID();
									$sksort = get_post_meta( $skillId, 'postSorting', true );
									?>
									<li class="skill_list list-display" data-post-id="<?php echo $skillId; ?>" id="<?php if($sksort){echo $sksort;}else{ echo $index;} ?>">
									<div class="rows_lists">
										
											<span class="row-icon">
												<i class="fal fa-clipboard-check" title="Everything is OK"></i>
											</span>
										
											<div class="title">
												<div class="lic_state">
													<b><?php echo $ehrs_var; ?></b>
													
												</div>
												
											</div>
											
											<div class="action-dropdown dropdown">
												<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger_<?php echo get_the_ID(); ?>" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu"><i class="fal fa-ellipsis-v-alt"></i></a>
												<ul aria-labelledby="action_menu_trigger_<?php echo get_the_ID(); ?>" class="dropdown-menu dropdown-menu-right">										
												
													<a class="dropdown-item"  href="<?php echo get_site_url();?>/profile/?ehrarchived=<?php echo $skillId; ?>" data-method="put" id="archived_post" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>
												</ul>
										
										</div>
									</div>
								
								</li>
									<?php
									$ehr = $_GET['ehrarchived'];
									if(isset($ehr)){
									$postid = $ehr;
									$my_post = array(
									'post_type' => 'skills',
									'ID'           => $ehr,
									'post_status'   => 'draft',
									);
									wp_update_post( $my_post );
									$url = get_site_url().'/profile#addEhrs';
									//wp_redirect( $url );
									//exit;
									echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
									}

								endwhile;
								
								echo '</ul>';
								}else{
									echo "Qualify for more opportunities - input EHRs you have experience with.";
								}
								wp_reset_postdata(); 
								?>
								<script type="text/javascript">
								jQuery('#saveOrderskillcl').click(function(){
									var splashArray = new Array();
									var postid = jQuery('.skill_list').attr('data-post-id');
									jQuery( ".user_profile_all_deatils_info ul.skill_display_lists .skill_list" ).each(function( index ) {

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
									$( ".user_profile_all_deatils_info ul.skill_display_lists" ).sortable();
								});

								jQuery(document).ready(function(){
									/*****************Reorder****************/       
									var divList = jQuery("ul.skill_display_lists.display_lists .skill_list");
									divList.sort(function(a, b){ return jQuery(a).attr("id")-jQuery(b).attr("id")});
									jQuery("ul.skill_display_lists.display_lists").html(divList);

								});	

								</script>
							<!-- Skill Modal -->
							<div class="modal fade" id="add_ehr_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<form  method="post">
									<input name="_csrf_token" type="hidden" value="">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="add_ehr_modal_title">Add EHR</h4>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<?php 
												$ehrs_var = get_field('ehrs');
											?>
											<div class="modal-body">
												<p>Select an EHR you would like to add.</p>
												<div class="form-group">
												<label for="known_ehr_ehr_id">EHR</label>
												<div class="select-wrapper flex-grow-1 ">
													<select class="ehrKnowcl" id="known_ehr_ehr_id" name="known_ehr_id" required="">
														<option value=""></option>
														<option value="75Health">75Health</option>
														<option value="ABELMed">ABELMed</option>
														<option value="Care360">Care360</option>
														<option value="Casamba">Casamba</option>
														<option value="Cerner">Cerner</option>
														<option value="Devero">Devero</option>
														<option value="EPIC">EPIC</option>
														<option value="Wellsoft">Wellsoft</option>
														<option value="Xper IM (Xper Information Management)">Xper IM (Xper Information Management)</option>

													</select>
												</div>
												</div>
											</div>

											<div class="modal-footer">
												<button type="button" id="cancel_ehr_add" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
												<button class="btn btn-primary" name="ehrSubmit" id="rhrSubmit" type="submit" >Save Changes</button>
											</div>
										</div>
									</div>
									</form>
									<?php
										if(isset($_POST['ehrSubmit'])){

											$EHR = $_POST['known_ehr_id'];

											$postid = wp_insert_post(array (
											'post_type' => 'skills',
											'post_title' => $EHR,
											'post_status' => 'publish',
											'meta_input' => array(
											'ehrs' => $EHR,
											),
											));										
											$url = get_site_url().'/profile#addEhrs';
											wp_redirect( $url );
											exit;
										}

									?>
							</div>
						</section>
						<section id="checklists" class="checklists_cl">
							<div class="row">
								<div class="col-lg-8">
								<h3>
									<span>
									Skills Checklists
									<small class="header-link-sm"><a href="<?php echo get_site_url();?>/profile/checklists-archived/">View Archived</a></small>
									</span>

								</h3>
								</div>
								<div class="col-lg-4 text-end d-flex gap-1">
									<input type="hidden" id="row_order" name="row_order">
									<a id="saveOrderskillcheck" class="btn btn-floating btn-primary text-white savorder">Save Order</a>
									<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/skills/checklists-new"><i class="fal fa-plus"></i></a>
								</div>
								<div class="col-md-12 col-lg-12 col-12">
									<?php echo get_template_part('template-part/checklists-posts'); ?>
								</div>
							</div>
						</section>
					</div>	
				</section>
	<!--------------------------------------Malpractice Insurance section start -------------------------------------------------->			
				<section id="malpractice-insurance" data-id="<?php echo $malpractice; ?>" class="profile-section-types">
					<div class="dragndropsec">
						<div class="row">
							<div class="col-lg-8">
								<h2>
							<span>
							Malpractice Insurance
							<small class="header-link-sm"><a href="<?php echo get_site_url();?>/profile/insurance-archived">View Archived</a></small>
							</span>
							
							</h2>
							</div>
							<div class="col-lg-4 text-end d-flex gap-1">
								<input type="hidden" id="row_order" name="row_order">
								<a id="saveOrderinsu" class="btn btn-floating btn-primary text-white savorder">Save Order</a>
								<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/insurance-new"><i class="fal fa-plus"></i></a>
							</div>
						</div>
						<?php echo get_template_part('template-part/insurance-posts'); ?>
					</div>
				</section>				
	<!------------------------references section start ------------------------------>
			
				<section id="references" data-id="<?php echo $references; ?>" class="profile-section-types">
					<div class="dragndropsec">
						<div class="row">
							<div class="col-lg-8">
								<h2>
							<span>
							References
							<small class="header-link-sm"><a href="<?php echo get_site_url();?>/profile/references-archived">View Archived</a></small>
							</span>
							
							</h2>
							</div>
							<div class="col-lg-4 text-end d-flex gap-1">
							<input type="hidden" id="row_order" name="row_order">
								<a id="saveOrderref" class="btn btn-floating btn-primary text-white savorder">Save Order</a>
								<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile//references-new/"><i class="fal fa-plus"></i></a>
							</div>
						</div>
						<?php echo get_template_part('template-part/references-posts'); ?>
					</div>
				</section>
				
	<!--------------------------------------Case Logs section start -------------------------------------------------->			
				<section id="case-logs" data-id="<?php echo $case; ?>" class="profile-section-types">
					<div class="dragndropsec">
						<div class="row">
							<div class="col-lg-8">
								<h2>
							<span>
							Case Logs
							<small class="header-link-sm"><a href="<?php echo get_site_url();?>/profile/case-logs/archived">View Archived</a></small>
							</span>
							
							</h2>
							</div>
							<div class="col-lg-4 text-end d-flex gap-1">
							<input type="hidden" id="row_order" name="row_order">
								<a id="saveOrderclog" class="btn btn-floating btn-primary text-white savorder">Save Order</a>
								<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/case-logs"><i class="fal fa-plus"></i></a>
							</div>
						</div>
						<?php echo get_template_part('template-part/caseLogs-posts'); ?>
					</div>		
				</section>			
				
	<!------------------------additionalDocuments section start ------------------------------>

				<section id="additionalDocuments" data-id="<?php echo $additionalDocuments; ?>" class="profile-section-types">
					<div class="dragndropsec">
						<div class="row">
							<div class="col-lg-8">
								<h2>
							<span>
							Additional Documents
							<small class="header-link-sm"><a href="<?php echo get_site_url();?>/profile/document-archived">View Archived</a></small>
							</span>
							
							</h2>
							</div>
							<div class="col-lg-4 text-end d-flex gap-1">
							<input type="hidden" id="row_order" name="row_order">
								<a id="saveOrderadddoc" class="btn btn-floating btn-primary text-white savorder">Save Order</a>
								<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/document-new"><i class="fal fa-plus"></i></a>
							</div>
						</div>
						<?php echo get_template_part('template-part/document-posts'); ?>
					</div>
				</section>

	<!------------------------backgriund & Work authorization section start ------------------------------>
				<section id="authorization" data-id="<?php echo $authorization; ?>" class="profile-section-types">
					<div class="dragndropsec">
						<div class="row">
							<div class="col-lg-10">
								<h2>
							<span>
							Background & Work Authorization					
							</span>
							
							</h2>
							</div>
							<div class="col-lg-2 text-end">
							<a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/edit#background-and-work-auth"><i class="fal fa-plus"></i></a>
							</div>
						</div>
						<div class="allquesanshere">
							<div class="row mb-3">
								<div class="bwaQues col-md-10">
									<b>Has action ever been taken against any of your medical licenses?</b>
									<?php if($bgaddExplian){echo $bgaddExplian;} ?>
								</div>
								<div class="bwaAns col-md-2 text-end">
									<?php if($bgML){echo $bgML;}else{echo 'Not yet answered';} ?>
								</div>
							</div>
							<div class="row mb-3">
								<div class="bwaQues col-md-10 ">
									<b>Have you ever been named as a defendant in a professional liability action?</b>
									<?php if($bgaddExplian2){echo $bgaddExplian2;} ?>
								</div>
								<div class="bwaAns col-md-2 text-end">
									<?php if($bgaction){echo $bgaction;}else{echo 'Not yet answered';} ?>
								</div>
							</div>
							<div class="row mb-3">
								<div class="bwaQues col-md-10">
									<b>Are you legally authorized to work in the United States?</b>
									<?php if($bgaddExplian3){echo $bgaddExplian3;} ?>
								</div>
								<div class="bwaAns col-md-2 text-end">
									<?php if($bgUS){echo $bgUS;}else{echo 'Not yet answered';} ?>
								</div>
							</div>

						</div>
					</div>	
				</section>
				
				</div>
				<!-- <input type="hidden" id="row_order" name="row_order">
				<a id="saveOrder" class="btn btn-primary mb-5 text-white">Save Order</a> -->
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery('#saveOrder').click(function(){
	var splashArray = new Array();
	jQuery( ".user_profile_all_deatils_info ul.education_display_lists .education_list" ).each(function( index ) {

		var menuPos = index;
		var metaKey = jQuery( this ).attr('data-id');
		splashArray.push(menuPos);

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
    $( ".user_profile_all_deatils_info ul.education_display_lists" ).sortable();
  });


</script>
<?php
}	
		get_footer('dashboard');

}else{
    header('Location: ' . get_permalink(1310));
}
?>
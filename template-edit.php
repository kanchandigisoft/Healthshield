<?php
if(is_user_logged_in()){
/*
* Template name: User Profile edit
*/ 
get_header('dashboard');

echo get_template_part( 'template-headers/sidebar-dashboard' );

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

$current_user = wp_get_current_user();
$first_name = $current_user->first_name;
$last_name =  $current_user->last_name;
$fullname = $first_name.' '.$last_name;
$email = $current_user->user_email;

$role = $current_user->roles;
$userlink_name = $current_user->user_nicename;
$userID = $current_user->ID;
$userBIO = $current_user->description;
 $profileImg = get_avatar($userID);
//Personal Detials
 $uid = get_current_user_id();
$userid_filed = 'user_'. $uid;
$specciality = get_field('specialty', $userid_filed);

$phoneno = get_field_object('phone_no',$userid_filed);

$phoneno = get_field('phone_no',$userid_filed);

$yearExp = get_field('year_of_experience',$userid_filed);

$DOB = get_field('date_of_birth',$userid_filed);
$ssn = get_field('ssn',$userid_filed);
$npi = get_field('npi_number',$userid_filed);
$dea = get_field('dea_number',$userid_filed);
$medicare = get_field('medicare',$userid_filed);

$gender = get_field('gender_identity',$userid_filed);


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
?>
<div class="content edit_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
			 <form name="editform" id="editform" method="post" enctype="multipart/form-data" autocomplete="off">
			 	<input type="hidden" name="usid" value="<?php echo $userID; ?>" id="usid">
				<section class="fieldset coreinformation">
					<h5 class="legend">Core Information</h5>
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="profile_profession_id">PROFESSION</label>
								<div class="select-wrapper">
									
									<select class="users_roles w-100" id="profile_profession_id" name="profileprofession" required>
										<option value=""></option>
										<?php
										global $wp_roles;
										$roles = $wp_roles->roles;
										
										foreach ( $wp_roles->roles as $key=>$value ) {
											if($role[0] == $key){
											$selected2 = 'selected';
										}else{
											$selected2 = '';
										}
										?>
										<option <?php echo $selected2; ?> value="<?php echo $key; ?>"><?php echo $value['name']; ?></option>
										<?php
										}
										 ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="profile_spectalty_id">PRIMARY SPECIALTY</label>
								<div class="select-wrapper">
									<select class="users_spectalty w-100" id="profile_spectalty_id" name="profilespectalty" required>
										<option value=""></option>
										<option <?php if($specciality == 'Anesthesiology'){ echo 'selected';}?> value="Anesthesiology">Anesthesiology</option>
										<option <?php if($specciality == 'Critical Care'){ echo 'selected';}?> value="Critical Care">Critical Care</option>
										<option <?php if($specciality == 'Medical Surgical'){ echo 'selected';}?> value="Medical Surgical">Medical Surgical</option>
										<option <?php if($specciality == 'Oncology'){ echo 'selected';}?> value="Oncology">Oncology</option>
										<option <?php if($specciality == 'Neonatal'){ echo 'selected';}?> value="Neonatal">Neonatal</option>
										<option <?php if($specciality == 'Cardiac'){ echo 'selected';}?> value="Cardiac">Cardiac</option>
										<option <?php if($specciality == 'Home Health'){ echo 'selected';}?> value="Home Health">Home Health</option>
										<option <?php if($specciality == 'Pediatric'){ echo 'selected';}?> value="Pediatric">Pediatric</option>
										<option <?php if($specciality == 'Nurse Case Manager'){ echo 'selected';}?> value="Nurse Case Manager">Nurse Case Manager</option>
										<option <?php if($specciality == 'Hospice'){ echo 'selected';}?> value="Hospice">Hospice</option>
										<option <?php if($specciality == 'Midwife'){ echo 'selected';}?> value="Midwife">Midwife</option>
										<option <?php if($specciality == 'Emergency'){ echo 'selected';}?> value="Emergency">Emergency</option>
										<option <?php if($specciality == 'Operating Room'){ echo 'selected';}?> value="Operating Room">Operating Room</option>
										<option <?php if($specciality == 'EP lab'){ echo 'selected';}?> value="EP lab">EP lab</option>
										<option <?php if($specciality == 'Dialysis'){ echo 'selected';}?> value="Dialysis">Dialysis </option>
										<option <?php if($specciality == 'Psychiatric'){ echo 'selected';}?> value="Psychiatric">Psychiatric</option>
										<option <?php if($specciality == 'OB/GYN'){ echo 'selected';}?> value="OB/GYN">OB/GYN </option>
										<option <?php if($specciality == 'Dental'){ echo 'selected';}?> value="Dental">Dental</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="profile_year_experience_id">YEARS OF EXPERIENCE</label>
								<div class="select-wrapper">
									<select class="users_experience w-100" id="profile_year_experience_id" name="profileexperience" required>
										<option value=""></option>
										<option <?php if($yearExp == 'Less than one year' ){echo 'selected';}?> value="0">Less than one year</option>
										<option <?php if($yearExp == '1' ){echo 'selected';}?> value="1">1</option>
										<option <?php if($yearExp == '2' ){echo 'selected';}?> value="2">2</option>
										<option <?php if($yearExp == '3' ){echo 'selected';}?> value="3">3</option>
										<option <?php if($yearExp == '4' ){echo 'selected';}?> value="4">4</option>
										<option <?php if($yearExp == '5' ){echo 'selected';}?> value="5">5</option>
										<option <?php if($yearExp == '6' ){echo 'selected';}?> value="6">6</option>
										<option <?php if($yearExp == '7' ){echo 'selected';}?> value="7">7</option>
										<option <?php if($yearExp == '8' ){echo 'selected';}?> value="8">8</option>
										<option <?php if($yearExp == '9' ){echo 'selected';}?> value="9">9</option>
										<option <?php if($yearExp == '10' ){echo 'selected';}?> value="10">10</option>
										<option <?php if($yearExp == '11' ){echo 'selected';}?> value="11">11</option>
										<option <?php if($yearExp == '12' ){echo 'selected';}?> value="12">12</option>
										<option <?php if($yearExp == '13' ){echo 'selected';}?> value="13">13</option>
										<option <?php if($yearExp == '14' ){echo 'selected';}?> value="14">14</option>
										<option <?php if($yearExp == '15' ){echo 'selected';}?> value="15">15</option>
										<option <?php if($yearExp == '16' ){echo 'selected';}?> value="16">16</option>
										<option <?php if($yearExp == '17' ){echo 'selected';}?> value="17">17</option>
										<option <?php if($yearExp == '18' ){echo 'selected';}?> value="18">18</option>
										<option <?php if($yearExp == '19' ){echo 'selected';}?> value="19">19</option>
										<option <?php if($yearExp == '20' ){echo 'selected';}?> value="20">20</option>
										<option <?php if($yearExp == '20 years or more' ){echo 'selected';}?> value="20">20 years or more</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section class="fieldset personalinformation mt-3" id="personalinformation">
					<h5 class="lagend">Personal Information</h5>
					<div class="row">
						<div class="col-12 col-lg-4">
							<div class="form-group">
								<label for="profile_first_name_id">First Name</label>
								<input autocomplete="section-talent given-name" class="form-control" id="profile_first_name_id" name="profile_first_name" type="text" value="<?php echo $first_name; ?>">
							</div>
						</div>
						<div class="col-12 col-lg-4">
							<div class="form-group">
								<label for="profile_mid_name_id">Middle Name</label>
								<input autocomplete="section-talent given-name" class="form-control" id="profile_mid_name_id" name="profile_mid_name" type="text" value="<?php echo $middlename; ?>">
							</div>
							<div class="form-group">
								
								<input type="checkbox" name="nomiddle_name" id="check_no_middle_name" value="<?php if($nomiddlename){echo $nomiddlename;}else{echo 'No';} ?>" <?php if($nomiddlename == 'Yes'){echo 'checked';}else{echo '';} ?>>
								<label for="check_no_middle_name">No Middle Name</label>
							</div>
						</div>
						<div class="col-12 col-lg-4">
							<div class="form-group">
								<label for="profile_last_name_id">Last Name</label>
								<input autocomplete="section-talent given-name" class="form-control" id="profile_last_name_id" name="profile_last_name" type="text" value="<?php echo $last_name; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-lg-6">
							<div class="form-group">
								<label for="profile_email_id">Email</label>
								<input autocomplete="section-talent given-email" class="form-control" id="profile_email_id" name="profile_email" type="text" value="<?php echo $email; ?>">
							</div>
						</div>
						<div class="col-12 col-lg-6">
							<div class="form-group">
								<label for="profile_phone_id">Phone No.</label>
								<input autocomplete="section-talent given-email" class="form-control" id="profile_phone_id" name="profile_phone" type="tel" value="<?php echo $phoneno; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-lg-6">
							<div class="form-group">
								<label for="profile_gender_id">GENDER IDENTITY</label>
								<select id="profile_gender_id" class="w-100" name="profilegender">
									<option value=""></option>
									<option <?php if($gender == 'Female'){echo 'selected';} ?> value="Female">Female</option>
									<option <?php if($gender == 'Male'){echo 'selected';} ?> value="Male">Male</option>
									<option <?php if($gender == 'Non-binary'){echo 'selected';} ?> value="Non-binary">Non-binary</option>
									<option <?php if($gender == 'Transgender'){echo 'selected';} ?> value="Transgender">Transgender</option>
									<option <?php if($gender == 'Other'){echo 'selected';} ?> value="Other">Other</option>
									<option <?php if($gender == 'Choose not to disclose'){echo 'selected';} ?> value="Choose not to disclose">Choose not to disclose</option>
								</select>
							</div>
						</div>
						<div class="col-12 col-lg-6">
							<div class="form-group">
								<label for="profile_ssn_id">SSN</label>
								<input aria-describedby="ssn_help_block" class="form-control" id="profile_ssn_id" name="profile_ssn" title="Please enter a valid SSN... xxx-xx-xxxx" value="<?php if($ssn){echo $ssn;} ?>">
								<small id="ssn_help_block" class="form-text text-muted">Without dashes or spaces</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-lg-6">
							<div class="form-group">
								<label for="profile_dbo_id">DATE OF BIRTH</label>
								<input autocomplete="section-talent bday" class="form-control DOB" id="profile_dbo_id" name="profile_date_of_birth" type="text" value="<?php echo $DOB;?>">
								
							</div>
						</div>
						<div class="col-12 col-lg-6">
							<div class="form-group">
								<label for="profile_npi_id">NPI NUMBER</label>
								<input class="form-control" id="profile_npi_id" name="profile_npi_number" type="number" value="<?php if($npi){echo $npi; } ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-lg-6">
							<div class="form-group">
								<label for="profile_dea_id">DEA NUMBER</label>
								<input class="form-control" id="profile_dea_id" name="profile_dea_number" type="number" value="<?php if($dea){echo $dea; } ?>">
							</div>
						</div>
						<div class="col-12 col-lg-6">
							<div class="form-group">
								<label for="profile_medicare_id">Medicare</label>
								<input class="form-control" id="profile_medicare_id" name="profile_medicare" type="text" value="<?php if($medicare){echo $medicare; } ?>">
							</div>
						</div>
						<div class="col-12 col-lg-6">
							<div class="form-group">
								<label for="profile_bio_id">Short Bio</label>
								<textarea class="character-counter form-control" data-length="255" id="profile_bio" name="profile_bio" placeholder="Share some information about yourself." rows="4" maxlength="255"><?php if($userBIO){echo $userBIO;} ?></textarea>
							</div>
						</div>
						
					</div>
				</section>
				<section class="fieldset profileavatar mt-3" id="profileavatar">
					<h6 class="legend">Profile Image</h6>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="profile_avatar_id">Choose Profile Image</label>
								<input type="file" name="profilepicture" value=" " id="profile_avatar_id" class="profileavatar_cl"> 
							</div>
						</div>
					</div>
				</section>
				<section class="fieldset emergencyContact mt-3" id="emergencyContact">
					<h5 class="legend">Emergency Contact</h5>
					<div class="row">
						<div class="col-12  col-lg-4">
							<div class="form-group">
								<label for="profile_emg_contact_name_id">Emergency Contact Name</label>
								<input class="emg_contact_name" id="profile_emg_contact_name_id" value="<?php if($emg_contact_name){echo $emg_contact_name;} ?>" name="EmgContactname" type="text">
								<small id="emergency_contact_name_help" class="form-text text-muted">
								Enter the name of a person to contact in case of emergency.
								</small>
							</div>
						</div>
						<div class="col-12 col-lg-4">
							<div class="form-group">
								<label for="profile_emg_contact_no_id">EMERGENCY CONTACT PHONE</label>
								<input type="tel" name="EmgContactPhone" id="profile_emg_contact_no_id" class="emg_contact_no" value="<?php if($emg_contact_phone){echo $emg_contact_phone;} ?>">
								<small class="form-text text-muted">Enter first area code and then number only</small>
							</div>
						</div>
						<div class="col-12 col-lg-4">
							<div class="form-group">
								<label for="profile_emg_contact_relationship_id">EMERGENCY CONTACT RELATIONSHIP</label>
								<input value="<?php if($emg_contact_relationship){echo $emg_contact_relationship;} ?>" type="text" id="profile_emg_contact_relationship_id" name="EmgContactrealtion" class="emg_contact_relationship">
								<small id="emergency_contact_relationship_help" class="form-text text-muted">
								How do you know your emergency contact?
								</small>
							</div>
						</div>
					</div>
				</section>
				<section class="texhomeaddress filedset mt-3" id="texhomeaddress">
					<h5 class="legend">Tax Home Address</h5>
					<div class="row">
						<div class="col-12 col-md-6 col-lg-3">
							<div class="form-group">
								<label for="profile_street_id">Street/Apt.</label>
								<input type="text" id="profile_street_id" name="profilestreet" class="profilestreet" 
								value="<?php if($userstreet){echo $userstreet;} ?>">
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-3">
							<div class="form-group">
								<label for="profile_city_id">City</label>
								<input type="text" id="profile_city_id" name="profilecity" class="profilecity" value="<?php if($usercity){echo $usercity;} ?>">
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-3">
							<div class="form-group">
								<label for="profile_state_id">State</label>
								<select id="profile_state_id" name="profilestate" class="profilestate">
									<option vlaue=""></option>
									<option <?php if($userstate =='Alabama'){echo 'selected';} ?> value="Alabama">Alabama</option>
									<option <?php if($userstate =='Alaska'){echo 'selected';} ?> value="Alaska">Alaska</option>
									<option <?php if($userstate =='Arizona'){echo 'selected';} ?> value="Arizona">Arizona</option>
									<option <?php if($userstate =='American Samoa'){echo 'selected';} ?> value="American Samoa">American Samoa</option>
									<option <?php if($userstate =='Arkansas'){echo 'selected';} ?> value="Arkansas">Arkansas</option>
									<option <?php if($userstate =='California'){echo 'selected';} ?> value="California">California</option>
									<option <?php if($userstate =='Colorado'){echo 'selected';} ?> value="Colorado">Colorado</option>
									<option <?php if($userstate =='Connecticut'){echo 'selected';} ?> value="Connecticut">Connecticut</option>
									<option <?php if($userstate =='Delaware'){echo 'selected';} ?>  value="Delaware">Delaware</option>
									<option <?php if($userstate =='District Of Columbia'){echo 'selected';} ?>  value="District Of Columbia">District Of Columbia</option>
									<option <?php if($userstate =='Florida'){echo 'selected';} ?> value="Florida">Florida</option>
									<option <?php if($userstate =='Georgia'){echo 'selected';} ?> value="Georgia">Georgia</option>
									<option <?php if($userstate =='Guam'){echo 'selected';} ?> value="Guam">Guam</option>
									<option <?php if($userstate =='Hawaii'){echo 'selected';} ?> value="Hawaii">Hawaii</option>
									<option <?php if($userstate =='Idaho'){echo 'selected';} ?> value="Idaho">Idaho</option>
									<option <?php if($userstate =='Illinois'){echo 'selected';} ?> value="Illinois">Illinois</option>
									<option <?php if($userstate =='Indiana'){echo 'selected';} ?> value="Indiana">Indiana</option>
									<option <?php if($userstate =='Iowa'){echo 'selected';} ?> value="Iowa">Iowa</option>
									<option <?php if($userstate =='Kansas'){echo 'selected';} ?> value="Kansas">Kansas</option>
									<option <?php if($userstate =='Kentucky'){echo 'selected';} ?> value="Kentucky">Kentucky</option>
									<option <?php if($userstate =='Louisiana'){echo 'selected';} ?> value="Louisiana">Louisiana</option>
									<option <?php if($userstate =='Maine'){echo 'selected';} ?> value="Maine">Maine</option>
									<option <?php if($userstate =='Maryland'){echo 'selected';} ?> value="Maryland">Maryland</option>
									<option <?php if($userstate =='Massachusetts'){echo 'selected';} ?> value="Massachusetts">Massachusetts</option>
									<option <?php if($userstate =='Michigan'){echo 'selected';} ?> value="Michigan">Michigan</option>
									<option <?php if($userstate =='Minnesota'){echo 'selected';} ?> value="Minnesota">Minnesota</option>
									<option <?php if($userstate =='Mississippi'){echo 'selected';} ?> value="Mississippi">Mississippi</option>
									<option <?php if($userstate =='Missouri'){echo 'selected';} ?> value="Missouri">Missouri</option>
									<option <?php if($userstate =='Montana'){echo 'selected';} ?> value="Montana">Montana</option>
									<option <?php if($userstate =='Nebraska'){echo 'selected';} ?> value="Nebraska">Nebraska</option>
									<option <?php if($userstate =='Nevada'){echo 'selected';} ?> value="Nevada">Nevada</option>
									<option <?php if($userstate =='New Hampshire'){echo 'selected';} ?> value="New Hampshire">New Hampshire</option>
									<option <?php if($userstate =='New Jersey'){echo 'selected';} ?> value="New Jersey">New Jersey</option>
									<option <?php if($userstate =='New Mexico'){echo 'selected';} ?> value="New Mexico">New Mexico</option>
									<option <?php if($userstate =='New York'){echo 'selected';} ?> value="New York">New York</option>
									<option <?php if($userstate =='North Carolina'){echo 'selected';} ?> value="North Carolina">North Carolina</option>
									<option <?php if($userstate =='North Dakota'){echo 'selected';} ?> value="North Dakota">North Dakota</option>
									<option <?php if($userstate =='Northern Mariana Islands'){echo 'selected';} ?> value="Northern Mariana Islands">Northern Mariana Islands</option>
									<option <?php if($userstate =='Ohio'){echo 'selected';} ?> value="Ohio">Ohio</option>
									<option <?php if($userstate =='Oklahoma'){echo 'selected';} ?> value="Oklahoma">Oklahoma</option>
									<option <?php if($userstate =='Oregon'){echo 'selected';} ?> value="Oregon">Oregon</option>
									<option <?php if($userstate =='Pennsylvania'){echo 'selected';} ?> value="Pennsylvania">Pennsylvania</option>
									<option <?php if($userstate =='Puerto Rico'){echo 'selected';} ?> value="Puerto Rico">Puerto Rico</option>
									<option <?php if($userstate =='Rhode Island'){echo 'selected';} ?> value="Rhode Island">Rhode Island</option>
									<option <?php if($userstate =='South Carolina'){echo 'selected';} ?> value="South Carolina">South Carolina</option>
									<option <?php if($userstate =='South Dakota'){echo 'selected';} ?> value="South Dakota">South Dakota</option>
									<option <?php if($userstate =='Tennessee'){echo 'selected';} ?> value="Tennessee">Tennessee</option>
									<option <?php if($userstate =='Texas'){echo 'selected';} ?> value="Texas">Texas</option>
									<option <?php if($userstate =='United States Minor Outlying Islands'){echo 'selected';} ?> value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
									<option <?php if($userstate =='Utah'){echo 'selected';} ?> value="Utah">Utah</option>
									<option <?php if($userstate =='Vermont'){echo 'selected';} ?> value="Vermont">Vermont</option>
									<option <?php if($userstate =='Virgin Islands'){echo 'selected';} ?> value="Virgin Islands">Virgin Islands</option>
									<option <?php if($userstate =='Virginia'){echo 'selected';} ?> value="Virginia">Virginia</option>
									<option <?php if($userstate =='Washington'){echo 'selected';} ?> value="Washington">Washington</option>
									<option <?php if($userstate =='West Virginia'){echo 'selected';} ?> value="West Virginia">West Virginia</option>
									<option <?php if($userstate =='Wisconsin'){echo 'selected';} ?> value="Wisconsin">Wisconsin</option>
									<option <?php if($userstate =='Wyoming'){echo 'selected';} ?> value="Wyoming">Wyoming</option>

								</select>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-3">
							<div class="form-group">
								<label for="profile_zip_code_id">Zip code</label>
								<input type="text" name="profilezipcode" id="profile_zip_code_id" class="profilezipcode" value="<?php if($userzipcode){echo $userzipcode;} ?>">
							</div>
						</div>
					</div>

				</section>
				<section class="filedset background-and-work-auth mt-3" id="background-and-work-auth">
					<h5 class="legend">Background & Work Authorization</h5>
					<div class="row">
						<div class="col-12 col-lg-12 col-md-12">
							<div class="form-group">
								<label for="profile_medical_licenses_id">Has action ever been taken against any of your medical licenses?</label>
								<select id="profile_medical_licenses_id" name="profilemedicallicenses" class="profilemedicallicenses">
									<option value=""></option>
									<option <?php if($bgML =='Yes'){echo 'selected';} ?> value="Yes">Yes</option>
									<option <?php if($bgML =='No'){echo 'selected';} ?> value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-12 col-lg-12 col-md-12">
							<div class="form-group">
								<label for="profile_add_explation_id">If so, you can add an explanation</label>				
								<textarea id="profile_add_explation_id" class="profileaddexplation" 
								name="profileaddexplation" value="" row="5"><?php if($bgaddExplian){echo $bgaddExplian;} ?></textarea>
							</div>
						</div>
						<div class="col-12 col-lg-12 col-md-12">
							<div class="form-group">
								<label for="profile_liability_action_id">Have you ever been named as a defendant in a professional liability action?</label>
								<select id="profile_liability_action_id" name="profileliabilityaction" class="profile_liability_action">
									<option value=""></option>
									<option <?php if($bgaction =='Yes'){echo 'selected';} ?> value="Yes">Yes</option>
									<option <?php if($bgaction =='No'){echo 'selected';} ?> value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-12 col-lg-12 col-md-12">
							<div class="form-group">
								<label for="profile_liability_add_explation_id">If so, you can add an explanation</label>
								<textarea id="profile_liability_add_explation_id" name="profileliabilityaddexplation" class="profile_liability_add_explation" value="" row="5"><?php if($bgaddExplian2){echo $bgaddExplian2;} ?></textarea>
							</div>
						</div>
						<div class="col-12 col-lg-12 col-md-12">
							<div class="form-group">
								<label for="profile_United_States_id">Are you legally authorized to work in the United States?</label>
								<select id="profile_United_States_id" name="profileUnitedStates" class="profile_United_States">
									<option value=""></option>
									<option <?php if($bgUS =='Yes'){echo 'selected';} ?> value="Yes">Yes</option>
									<option <?php if($bgUS =='No'){echo 'selected';} ?> value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-12 col-lg-12 col-md-12">
							<div class="form-group">
								<label for="profile_United_States_add_id">If not, you can add an explanation</label>
								<textarea name="profileUnitedStatesadd" id="profile_United_States_add_id" class="profile_United_States_add" value="" row="5"><?php if($bgaddExplian3){echo $bgaddExplian3;} ?></textarea>
							</div>
						</div>
					</div>
				</section>
				<div class="form-group mt-3 mb-3">
					<button class="btn btn-primary submitFormProfil userSaveChanges" name="userSaveChanges" type="submit">Save Changes</button>
					<a class="btn btn-cancel" href="/profile#personal_information">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</div>


<?php 
if(isset($_POST['userSaveChanges'])){
global $wpdb, $blog_id;
$UID = get_current_user_id();

    //Personal Information.....
    $profileprofession = $_POST['profileprofession'];
    $profilespectalty = $_POST['profilespectalty'];
    $profileexperience = $_POST['profileexperience'];
    $FirstName = $_POST['profile_first_name'];
    $LastName = $_POST['profile_last_name'];
    $profile_email = $_POST['profile_email'];
    $profile_phone = $_POST['profile_phone'];
    $profilegender = $_POST['profilegender'];
    $profile_ssn = $_POST['profile_ssn'];
    $profile_date_of_birth = $_POST['profile_date_of_birth'];
    $profile_npi_number = $_POST['profile_npi_number'];
    $profile_dea_number = $_POST['profile_dea_number'];
	$profile_medicare = $_POST['profile_medicare'];
    $profile_bio = $_POST['profile_bio'];

    //Emgerncy Contact..
    $EmgContactname = $_POST['EmgContactname'];
    $EmgContactPhone = $_POST['EmgContactPhone'];
    $EmgContactrealtion = $_POST['EmgContactrealtion'];

    //Home Address..
    $profilestreet = $_POST['profilestreet'];
    $profilecity = $_POST['profilecity'];
    $profilestate = $_POST['profilestate'];
    $profilezipcode = $_POST['profilezipcode'];

    //Background & work auth...
    $profilemedicallicenses = $_POST['profilemedicallicenses'];
    $profileaddexplation = $_POST['profileaddexplation'];
    $profileliabilityaction = $_POST['profileliabilityaction'];
    $profileliabilityaddexplation = $_POST['profileliabilityaddexplation'];
    $profileUnitedStates = $_POST['profileUnitedStates'];
    $profileUnitedStatesadd = $_POST['profileUnitedStatesadd'];
    
    $midname = $_POST['profile_mid_name'];
    $nomidname = $_POST['nomiddle_name'];
    if($nomidname == 'Yes'){
    	$nomidname = 1;
    }else{
    	$nomidname = 0;
    }
	$user_data = array(
		'ID' => $UID,
		'user_email' => $profile_email,
	);
	wp_update_user($user_data);

    update_user_meta($UID,'first_name',$FirstName);
    update_user_meta($UID,'last_name',$LastName);
    update_user_meta($UID, 'description',$profile_bio );
    update_user_meta($UID,'specialty',$profilespectalty);
    update_user_meta($UID,'phone_no',$profile_phone);
    update_user_meta($UID,'gender_identity',$profilegender);
    update_user_meta($UID,'ssn',$profile_ssn);
    update_user_meta($UID,'date_of_birth',$profile_date_of_birth);
    update_user_meta($UID,'npi_number',$profile_npi_number);
    update_user_meta($UID,'dea_number',$profile_dea_number);
	update_user_meta($UID,'medicare',$profile_medicare);
    update_user_meta($UID,'year_of_experience',$profileexperience);
    update_user_meta($UID,'medical_licenses',$profilemedicallicenses);
    update_user_meta($UID,'add_an_explanation',$profileaddexplation);
    update_user_meta($UID,'professional_liability_action',$profileliabilityaction);
    update_user_meta($UID,'you_can_add_an_explanation',$profileliabilityaddexplation);
    update_user_meta($UID,'the_united_states',$profileUnitedStates);
    update_user_meta($UID,'if_not_explanation',$profileUnitedStatesadd);
    update_user_meta($UID,'streetapt',$profilestreet);
    update_user_meta($UID,'city',$profilecity);
    update_user_meta($UID,'state',$profilestate);
    update_user_meta($UID,'zip_code',$profilezipcode);
    update_user_meta($UID,'emergency_contact_name',$EmgContactname);
    update_user_meta($UID,'emergency_contact_phone',$EmgContactPhone);
    update_user_meta($UID,'emergency_contact_relationship',$EmgContactrealtion);
    update_user_meta($UID,'middle_name',$midname);
    update_user_meta($UID,'no_middle_name',$nomidname);

    if($profileprofession == 'administrator' && $profileprofession == 'subscriber'){

    }else{
        wp_update_user( array( 'ID' => $UID, 'role' => $profileprofession ) );
    }

//User Avatar..
   $wordpress_upload_dir = wp_upload_dir();
        $i = 1;
        $profilepicture = $_FILES['profilepicture'];
        if ($profilepicture['name'] != '') {
            $new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
            $new_file_mime = mime_content_type($profilepicture['tmp_name']);
            while (file_exists($new_file_path)) {
                $i++;
                $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $profilepicture['name'];
            }
            if (move_uploaded_file($profilepicture['tmp_name'], $new_file_path)) {
                $upload_id = wp_insert_attachment(array(
                    'guid' => $new_file_path,
                    'post_mime_type' => $new_file_mime,
                    'post_title' => preg_replace('/\.[^.]+$/', '', $profilepicture['name']),
                    'post_content' => '',
                    'post_status' => 'inherit'
                ), $new_file_path);
                require_once(ABSPATH . 'wp-admin/includes/image.php');
            }

            $pro_pic = wp_get_attachment_url($upload_id);
            update_user_meta($UID, 'wp_user_avatar', $upload_id);
        }
		echo "<script> 
		Swal.fire({
			title: 'success!',
			text: 'Your data has been saved!',
			icon: 'success',
			showConfirmButton: true,
			allowOutsideClick: true,
			allowEscapeKey: false,
			confirmButtonColor: '#40BFB9',
			});
		</script>";
 }
?>

<?php
get_footer('dashboard');
}else{
header('Location: ' . get_permalink(1310));
}
?>

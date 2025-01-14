<?php
if(is_user_logged_in()){
/*
* Template name: Info Profile edit
*/ 
get_header('dashboard');
echo get_template_part( 'template-headers/sidebar-dashboard' );

$current_user = wp_get_current_user();
$first_name = $current_user->first_name;
$last_name =  $current_user->last_name;
$fullname = $first_name.' '.$last_name;
$email = $current_user->user_email;

$role = $current_user->roles;
$userlink_name = $current_user->user_nicename;
$userID = $current_user->ID;

$profileImg = get_avatar($userID);

//Personal Detials
$uid = get_current_user_id();
$userid_filed = 'user_'. $uid;
$phoneno = get_field('phone_no',$userid_filed);
$eino = get_field('einno',$userid_filed);

//Home address
$userstreet = get_field('streetapt',$userid_filed);
$usercity = get_field('city',$userid_filed);
$userstate = get_field('state',$userid_filed);
$userzipcode = get_field('zip_code',$userid_filed);

//$streetapt = get_field('streetapt',$userid_filed);
$sitecontact = get_field('site_contact',$userid_filed);

$provider_agency = get_user_meta($uid, 'provider_agency', true);


$userMeta = get_user_meta($uid);
//print_r($userMeta);

?>
<div class="content edit_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
			 <form name="infoeditform" id="infoeditform" method="post" enctype="multipart/form-data" autocomplete="off">
             <input type="hidden" name="usid" value="<?php echo $userID; ?>" id="usid">
             <section class="fieldset personalinformation mt-3" id="personalinformation">
					<h5 class="lagend">Personal Information</h5>
					<div class="row">
						<div class="col-12 col-lg-6 col-md-6">
							<div class="form-group">
								<label for="profile_first_name_id">First Name</label>
								<input autocomplete="section-talent given-name" class="form-control" id="profile_first_name_id" name="profile_first_name" type="text" value="<?php echo $first_name; ?>">
							</div>
						</div>
						<div class="col-12 col-lg-6 col-md-6">
							<div class="form-group">
								<label for="profile_last_name_id">Last Name</label>
								<input autocomplete="section-talent given-name" class="form-control" id="profile_last_name_id" name="profile_last_name" type="text" value="<?php echo $last_name; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 <?php if( $role[0] == 'facility' ){ echo 'col-lg-6 col-md-6'; } else { ?> col-lg-4 col-md-4 <?php } ?>">
							<div class="form-group">
								<label for="profile_email_id">Email</label>
								<input autocomplete="section-talent given-email" class="form-control" id="profile_email_id" name="profile_email" type="text" value="<?php echo $email; ?>">
							</div>
						</div>
						<div class="col-12 <?php if( $role[0] == 'facility' ){ echo 'col-lg-6 col-md-6';} else { ?> col-lg-4 col-md-4 <?php } ?>">
							<div class="form-group">
								<label for="profile_phone_id">Phone No.</label>
								<input autocomplete="section-talent given-email" class="form-control" id="profile_phone_id" name="profile_phone" type="tel" value="<?php echo $phoneno; ?>">
							</div>
						</div>
						<?php if( $role[0] != 'facility' ){  ?>
                        <div class="col-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="profile_npi_id">EIN</label>
                                <input class="form-control" id="profile_ein_id" name="profile_ein_number" type="number" value="<?php if($eino){echo $eino; } ?>">
                            </div>
                        </div>
                    	<?php } ?>
					</div>

					</div>
				</section>
				<div class="agencyName">
					<label for="profile_npi_id">Agency Name</label>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<input type="text" name="agency_name" value="<?php echo $provider_agency; ?>" id="agency_name" class="agency_name"> 
							</div>
						</div>
					</div>
				</div>
				<?php //if( $role[0] != 'facility' ){  ?>
				<section class="fieldset profileavatar mt-3" id="profileavatar">
					<h6 class="legend">Profile Image</h6>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="profile_avatar_id">Choose Profile Image</label>
								<input type="file" name="profilepicture2" value=" " id="profile_avatar_id" class="profileavatar_cl"> 
							</div>
						</div>
					</div>
				</section>
				<?php //} 
				if( $role[0] == 'facility' ){ ?>
					<div class="form-group">
                        <label for="profile_address">Address</label>
                        <input class="form-control" id="profile_ein_id" name="profilestreet" type="text" value="<?php if($userstreet){echo $userstreet; } ?>">
                    </div>
                    <div class="form-group">
                        <label for="profile_address">Site Contact</label>
                        <input class="form-control" id="profile_site_contact" name="profile_site_contact" type="text" value="<?php if($sitecontact){echo $sitecontact; } ?>">
                    </div>
				<?php } else { ?>
				<section class="texhomeaddress filedset mt-3" id="texhomeaddress">
					<h5 class="legend">Address</h5>
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
				<?php } ?>

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
    $FirstName = $_POST['profile_first_name'];
    $LastName = $_POST['profile_last_name'];
    $profile_email = $_POST['profile_email'];
    $profile_phone = $_POST['profile_phone'];
    $profile_ein_number = $_POST['profile_ein_number'];
    $profile_site_contact = $_POST['profile_site_contact'];

    //Home Address..
    $profilestreet = $_POST['profilestreet'];
    $profilecity = $_POST['profilecity'];
    $profilestate = $_POST['profilestate'];
    $profilezipcode = $_POST['profilezipcode'];


    $agency_name = $_POST['agency_name'];




	$user_data = array(
		'ID' => $UID,
		'user_email' => $profile_email,
	);
	wp_update_user($user_data);

    update_user_meta($UID,'first_name',$FirstName);
    update_user_meta($UID,'last_name',$LastName);
    update_user_meta($UID,'phone_no',$profile_phone);
    update_user_meta($UID,'streetapt',$profilestreet);
    update_user_meta($UID,'site_contact',$profile_site_contact);

    update_user_meta($UID,'einno',$profile_ein_number);    
    update_user_meta($UID,'city',$profilecity);
    update_user_meta($UID,'state',$profilestate);
    update_user_meta($UID,'zip_code',$profilezipcode);

    update_user_meta($UID,'provider_agency',$agency_name);

//User Avatar..
   $wordpress_upload_dir = wp_upload_dir();
        $i = 1;
        $profilepicture = $_FILES['profilepicture2'];
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
			}).then(function() {
                        window.location = '/profile/info-edit/';
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
<?php
if(is_user_logged_in()){
/*
* Template name: Profile Providers
*/ 
get_header('dashboard');

echo get_template_part( 'template-headers/sidebar-dashboard' );

$userID = $_GET['proId'];

$uid = get_current_user_id();
$provideUser = get_userdata($uid);
$providerName = $provideUser->display_name;

$userid_filed = 'user_'.$userID;
$middlename = get_field('middle_name',$userid_filed);
$nomiddlename = get_field('no_middle_name',$userid_filed);
$first_name = get_user_meta($userID, "first_name", true);
$last_name =  get_user_meta($userID, "last_name", true);

$revoke_key = 'revoke_status_'.$uid;
$access = get_user_meta($userID, $revoke_key, true);

$currentuser = get_userdata($userID);

$role = $currentuser->roles;

if($middlename){
	if($nomiddlename == 1){
		$fullname = $first_name.' '.$last_name;
	}else{
	$fullname = $first_name.' '.$middlename.' '.$last_name;
	}
}else{

	$fullname = $first_name.' '.$last_name;
}

$email = $currentuser->user_email;
$userlink_name = $currentuser->user_nicename;

$author_avatar = get_user_meta($userID,'wp_user_avatar',true);
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

//Home address
$userstreet = get_field('streetapt',$userid_filed);
$usercity = get_field('city',$userid_filed);
$userstate = get_field('state',$userid_filed);
$userzipcode = get_field('zip_code',$userid_filed);

$address =  $userstreet.' '.$usercity.' '.$userstate.' '.$userzipcode;

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
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="profile_provider">
                    <div class="data-flex d-flex">
                        <div class="providers_img">
                            <?php if($author_avatar){ ?>
                              <img class="rounded-circle" src="<?php echo $authoravatar_url; ?>" width="100%"/>
                            <?php }else{ ?>
                              <i class="fad fa-user-circle circle noavatar rounded-circle"></i>
                            <?php } ?>
                        </div>
                        <div class="provider_name ms-1 d-flex"><?php if($fullname){ echo $fullname; }else{ echo '';} ?>, <?php echo $role[0]; ?></div>
                    </div>
                </div>
            </div> 
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-end">
                <!-- <div class="providers_btns">
                    <a href="#" class="btn ntn-medium inviteBtn"><i class="fal fa-plus"></i>Payor</a>
                </div> -->
            </div>
            <div class="mt-5 tab-section col-md-12 col-lg-12 col-12 col-sm-12">
                <div class="tab_providers">
                    <nav>
                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="true">Profile</button>
                            <button class="nav-link" id="nav-payor-tab" data-bs-toggle="tab" data-bs-target="#nav-payor" type="button" role="tab" aria-controls="nav-payor" aria-selected="false">Payors</button>
                            <button class="nav-link" id="nav-verification-tab" data-bs-toggle="tab" data-bs-target="#nav-verification" type="button" role="tab" aria-controls="nav-verification" aria-selected="false">Verification</button>
                            <button class="nav-link" id="nav-facilities-tab" data-bs-toggle="tab" data-bs-target="#nav-facilities" type="button" role="tab" aria-controls="nav-facilities" aria-selected="false">Facilities</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="profileTable py-5">
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
                                <div class="data-flex d-flex">
                                    <a class="viewThisProfile" href="<?php echo get_the_permalink(5835).'?empId='.$userID; ?>">View Full Profile</a>
                                </div>
                                <div class="data-flex d-flex revokeAccess">
                                    <form name="revokeAccess" method="post">
                                       <input type="radio" name="revoke" <?php if($access == 'yes'){echo 'checked';} ?> value="yes"> Yes
                                       <input type="radio" name="revoke" <?php if($access == 'no'){echo 'checked';} ?> value="no"> No
                                       <input type="submit" name="revoke_btn" value="Access">
                                    </form>
                                </div>
                                <?php
                                // $meta = get_user_meta($userID);
                                // echo '<pre>';
                                // print_r($meta);
                                // echo '<pre>';
                                ?>

							</div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-payor" role="tabpanel" aria-labelledby="nav-payor-tab">
                            <div class="payorDetails py-5">
                            <?php
                                $args = array(  
                                    'post_type' => 'insurance',
                                    'post_status' => 'publish',
                                    'author' => $userID,
                                   'posts_per_page' => -1,
                                );
                               
                                $loop = new WP_Query( $args );
                                if ( $loop->have_posts()  ){ ?> 
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>State</th>
                                                <th>Date enrolled</th>
                                                <th>Expiry date</th>
                                                <th>Upload proof</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ( $loop->have_posts() ) : $loop->the_post(); 
                                                $insurancelibility = get_field('liability_insurance' );
                                                $insucompany = get_field('insurance_company');
                                                $insuaddress = get_field('address_insurance');
                                                $insuphnnumber = get_field('insurance_phone_number');
                                                $started_month = get_field('insurance_started_month');
                                                $started_year = get_field('insurance_started_year');
                                                $enddate_month = get_field('insurance_ended_month');
                                                $enddate_year = get_field('insurance_ended_year');
                                                $postId = get_the_ID();
                                                $imgs = get_post_meta($postId,'insurance_attachment_id',true);
                                                $meta = explode(',', $imgs);
                                            ?>
                                                <tr>
                                                <td><?php echo $insurancelibility; ?></td>
                                                <td><?php echo $insuaddress; ?></td>
                                                <td><?php echo $started_month.' '.$started_year; ?></td>
                                                <td><?php echo $enddate_month.' '.$enddate_year; ?></td>
                                                <td>
                                                    <?php foreach ($meta as $metas) {
                                                        $attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                                                        $attach_url = wp_get_attachment_url( $metas );
                                                        echo '<a href="'.$attach_url.'" target="_blank" class="attach_url_link">'.$attch_name.'</a>';
                                                    } 
                                                ?></td>
                                                </tr>
                                            <?php 
                                            endwhile;
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                } 
                            ?>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="nav-verification" role="tabpanel" aria-labelledby="nav-verification-tab">
                            <?php include('providers/provider-verification.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="nav-facilities" role="tabpanel" aria-labelledby="nav-facilities-tab">
                            <?php include('providers/provider-facilities.php'); ?>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<?php
if(isset($_POST['revoke_btn']))
{
    global $user, $wpdb;
   $revoke = $_POST['revoke'];     
   $user_info = get_userdata($userID);
   $user_email = $user_info->user_email;

    $revoke_key = 'revoke_status_'.$uid;
   
                if($revoke == 'no')
                {
                    update_user_meta($userID, $revoke_key, 'no');
                    
                    $msg = 'Our records indicate that your HeathShield Credentialing account owned by the agency you were working for has been terminated. <br><br>You have a 7-day grace period to convert to your account to an individual account, so you don’t lose access to your uploaded secure documents and other featuresHealthShield offers.<br><br>HOW TO CONVERT YOUR ACCOUNT
                        In order to convert your account, XXXXX<br>If you experience any issues or have any questions, please reach out.';
                    $subject = 'We would hate to see you go';
                }
                else
                {
                    update_user_meta($userID, $revoke_key, 'yes');

                    $msg = 'Great news! Your HealthShield Credentialing account has been renewed with '.$providerName.'. Please login to your dashboard and update your profile at your convenience.<br><br>Thank you for allowing us to simplify your credentialing process. Be sure to contact us if you have any questions.';
                    $subject = 'Your account with '.$providerName.' has been renewed';
                }
                $to = $user_email;
                $subject = $subject;
                $body = '<html><body style="background:#efefef;">';
                $body .= '<table cellspacing="0" cellpadding="20" style="font-size: 14px; font-family: sans-serif">';
                $body .= '<tbody>
                <tr><td style="font-size: 16px; font-weight: bold; color: #015084;">Hi '.$fullname.'</td></tr>
                <tr>
                <td style="font-size: 16px; font-weight: bold; color: #015084;">
                '.$msg.'
                </td>
                    <tr>
                    <td style="font-size: 16px; font-weight: bold; color: #015084;">Thank you in advance, <br>
                        HealthShield Credentialing<br>
                        T: <a href="tel:(864) 326-5399">(864) 326-5399</a> <br>
                        E: <a href="mailto:hscredentialing@gmail.com">hscredentialing@gmail.com</a> <br>
                        W: <a href="http://healthshieldcredentialing.com/">http://healthshieldcredentialing.com/</a><br>
                            
                        </td>
                    </tr>
                </tr>
                </tbody>
                </table></body></html>'; 
                $headers = array(); 
                $headers[] = 'Content-Type: text/html; charset=UTF-8';
                $emailsent = wp_mail($to, $subject, $body, $headers);

    
    echo "<script>
        Swal.fire({
          icon: 'alert',  
          title: 'Success!',
          text: 'Data Saved Successfully',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Ok'
        }).then(function() {
            window.location = '/profile/provider/';
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
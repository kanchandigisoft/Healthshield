<?php
if(is_user_logged_in()){
/*
* Template name: Profile Facilities
*/ 
get_header('dashboard');

echo get_template_part( 'template-headers/sidebar-dashboard' );

$userID = $_GET['faciId'];

$uid = get_current_user_id();
$provideUser = get_userdata($uid);
$providerName = $provideUser->display_name;

$userid_filed = 'user_'.$userID;
$middlename = get_field('middle_name',$userid_filed);
$nomiddlename = get_field('no_middle_name',$userid_filed);
$first_name = get_user_meta($userID, "first_name", true);
$last_name =  get_user_meta($userID, "last_name", true);

$revoke_key = 'facility_revoke_status_'.$uid;

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
$phoneno = get_field('phone_no',$userid_filed);

//Home address
$userstreet = get_field('streetapt',$userid_filed);

$address =  $userstreet.' '.$usercity.' '.$userstate.' '.$userzipcode;
$site_contact = get_field('site_contact',$userid_filed);

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
                            <button class="nav-link" id="nav-payor-tab" data-bs-toggle="tab" data-bs-target="#nav-payor" type="button" role="tab" aria-controls="nav-payor" aria-selected="false">Employees</button>
                            <button class="nav-link" id="nav-verification-tab" data-bs-toggle="tab" data-bs-target="#nav-verification" type="button" role="tab" aria-controls="nav-verification" aria-selected="false">Contract</button>
                            <button class="nav-link" id="nav-docs-tab" data-bs-toggle="tab" data-bs-target="#nav-docs" type="button" role="tab" aria-controls="nav-docs" aria-selected="false">Important Documents</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                

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
                                

                                <div class="data-flex d-flex revokeAccess">
                                    <form name="revokeAccess" method="post">
                                       <input type="radio" name="revoke" <?php if($access == 'yes'){echo 'checked';} ?> value="yes"> Yes
                                       <input type="radio" name="revoke" <?php if($access == 'no'){echo 'checked';} ?> value="no"> No
                                       <input type="submit" name="revoke_btn" value="Access">
                                    </form>
                                </div>

                                </div>
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

<?php
if(isset($_POST['revoke_btn']))
{
    global $user, $wpdb;
   $revoke = $_POST['revoke'];     
   $user_info = get_userdata($userID);
   $user_email = $user_info->user_email;

    $revoke_key = 'facility_revoke_status_'.$uid;

    $checkStatus = get_user_meta($userID, $key2, true);

    // print_r($checkStatus) ;
    // exit(); 


    if ( metadata_exists( 'user', $userID, $revoke_key ) ) {
            // echo 'hello exits';
            // exit();
    
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
    $url = get_site_url().'/profile/facilities/';
    wp_redirect($url);
    } else {
        echo 'not exists';
    }
}
?>        
<?php
get_footer('dashboard');
}else{
header('Location: ' . get_permalink(1310));
}
?>
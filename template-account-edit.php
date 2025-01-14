<?php
if(is_user_logged_in()){
/*
* Template name: Account Edit
*/
get_header('dashboard');
ob_start();
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
$User_Id = get_current_user_id();
$first_name = $current_user->first_name;
$last_name =  $current_user->last_name;

$email = $current_user->user_email;
$role = $current_user->roles;
$userlink_name = $current_user->user_nicename;

$middlename = get_user_meta($User_Id,'middle_name',true);
$nomiddlename = get_user_meta($User_Id,'no_middle_name',true);

if($middlename){
	if($nomiddlename == 1){
		$fullname = $first_name.' '.$last_name;
	}else{
	$fullname = $first_name.' '.$middlename.' '.$last_name;
	}
}else{

	$fullname = $first_name.' '.$last_name;
}

if (is_singular()) :
	$current_url = get_permalink(get_the_ID());
else :
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") $pageURL .= "s";
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	else $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	$current_url = $pageURL;
endif;      
$redirect = $current_url;

?>
<div class="content licenses_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
				<form  method="post" enctype="multipart/form-data" autocomplete="off">
					<?php echo pippin_show_error_messages();?>
					<input name="_method" type="hidden" value="put">

					<div class="form-group">
						<label for="user_email">Login Email</label>
						<input class="form-control" id="user_email" name="user_email" type="email" value="<?php echo $email; ?>">
					</div>
					<div class="form-group">
						<label for="pippin_user_pass"><?php _e('New Password', 'rcp'); ?></label>
						<input name="pippin_user_pass" id="pippin_user_pass" class="required" type="password"/>
					</div>
					<div class="form-group">
						<label for="pippin_user_pass_confirm"><?php _e('Password Confirm', 'rcp'); ?></label>
						<input name="pippin_user_pass_confirm" id="pippin_user_pass_confirm" class="required" type="password"/>
					</div>
					<div class="form-group text-center">
						<input type="hidden" name="pippin_action" value="reset-password"/>
						<input type="hidden" name="pippin_redirect" value="<?php echo $redirect; ?>"/>
						<input id="pippin_edit_submit" type="submit" class="my-3 text-center" value="<?php _e('Save Changes'); ?>"/>
						<a class="btn btn-cancel" href="<?php echo get_site_url(); ?>/my-account">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php
 if(isset($_POST['pippin_edit_submit']) && $_POST['pippin_action'] == 'reset-password') {
	$User_Id = get_current_user_id();

		if($_POST['pippin_user_pass'] == '' || $_POST['pippin_user_pass_confirm'] == '') {
			// password(s) field empty
			pippin_errors()->add('password_empty', __('Please enter a password, and confirm it', 'pippin'));
		}
		if($_POST['pippin_user_pass'] != $_POST['pippin_user_pass_confirm']) {
			// passwords do not match
			pippin_errors()->add('password_mismatch', __('Passwords do not match', 'pippin'));
		}

		// retrieve all error messages, if any
		$errors = pippin_errors()->get_error_messages();

		if(empty($errors)) {
			// change the password here
			$user_data = array(
				'ID' => $User_Id,
				'user_pass' => $_POST['pippin_user_pass'],
				'user_email' => $_POST['user_email'],
			);
			wp_update_user($user_data);
			// send password change email here (if WP doesn't)
			wp_redirect(add_query_arg('password-reset', 'true', $_POST['pippin_redirect']));
			exit;
		}
}  


get_footer('dashboard');
}else{
    header('Location: ' . get_permalink(1310));
}
?>
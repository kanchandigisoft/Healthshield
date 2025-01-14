<?php
if(is_user_logged_in()){
/*
* Template name: Account New
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

?>
<div class="content profile_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
			<div class="fancy-heading fancy-heading-flex fancy-heading-flex-column">
				<h2 class="font-lightweight flex-heading d-flex">
					<span>
						My Account
					</span>
					<a class="btn btn-floating healthshield-new" href="<?php echo get_site_url();?>/my-account/edit"><i class="fal fa-pencil"></i></a>
				</h2>
				<div class="divider"></div>
			</div>
			<div class="data-row"><div class="data-column"><span class="data-label">Name:</span> <span class="data-value"><?php echo $fullname; ?></span></div></div>
			<div class="data-row"><div class="data-column"><span class="data-label">Email:</span> <span class="data-value"><?php echo $email; ?></span></div></div>
			<div class="data-row"><div class="data-column"><span class="data-label">Profession:</span> <span class="data-value"><?php echo $role[0]; ?></span></div></div>
		</div>
	</div>
</div>


      <?php
get_footer('dashboard');
}else{
	header('Location: ' . home_url());
}
?>
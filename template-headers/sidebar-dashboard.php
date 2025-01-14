<?php
/*
* display dashbaord sidebar
*/
global $post, $wpdb;

$current_user = wp_get_current_user();
$role = $current_user->roles;

$checkAccess = get_user_meta(get_current_user_id(),'revoke_status', true);


$User_Id = get_current_user_id();
/**Getting Associated Agency Info***/
$finalAgency = array();

$emps = $wpdb->get_results("SELECT * FROM $wpdb->usermeta WHERE (meta_key = 'selected_employees')");
foreach($emps as $newEmp)
{
	$otherEmpList = $newEmp->meta_value;

	$Savedempoyees = explode(',', $otherEmpList);

	if (in_array($User_Id, $Savedempoyees))
	  {
	  		$finalAgency[] = $newEmp->user_id;
	  }

}

foreach($finalAgency as $finalAgencyId)
{

	$revoke_key = 'revoke_status_'.$finalAgencyId;
	$checkStatus = get_user_meta($User_Id, $revoke_key, true);
	if($checkStatus == 'yes')
	{
		echo '<style>div#SharingOption{display:none}</style>';
	}
	else
	{
		echo '<style>.agencyBox{display:none}</style>';
	}
}


/****/

if($role[0] == 'Provider' || $role[0] == 'CRNA'){
	/* Getting membership ids of current user */
	if(class_exists('MeprUtils')) {
	  $user = MeprUtils::get_currentuserinfo();
	  
	  if($user !== false && isset($user->ID)) {
	    //Returns an array of Membership ID's that the current user is active on
	    $active_prodcuts = $user->active_product_subscriptions('ids');
	    //print_r($active_prodcuts);
	  }
	}
}

 ?>
 <section class="sidebar bg-dark menu-bar d-none d-lg-block py-4 px-0">
 	
<?php
// wp_nav_menu( array(
//     'menu'           => 'dashboard_menu', // Do not fall back to first non-empty menu.
//     'theme_location' => '__no_such_location',
//     'fallback_cb'    => false, 
//     'walker' => ''
// ) );
?>
<?php if($role[0] == 'Provider'){ ?>
	<div class="menu-bar-item <?php if(is_page('profile')){echo 'active';} ?>">
		<a href="<?php echo get_site_url();?>/profile">
			<i class="fad circle fa-analytics"></i>
			<span class="menu-bar-item-name">Dashboard</span>
		</a>
	</div>
	<div class="menu-bar-divider"></div>
<?php } else { ?>
	
<div class="menu-bar-item <?php if(is_page('dashboard')){echo 'active';} ?>">
<a href="<?php echo get_site_url();?>/dashboard">
	<i class="fad circle fa-analytics"></i>
	<span class="menu-bar-item-name">Dashboard</span>
</a>
</div>
<div class="menu-bar-divider"></div>

<div class="menu-bar-item <?php if(is_page('profile')){echo 'active';}  ?> ">
<a href="<?php echo get_site_url();?>/profile">
	<i class="fad fa-user-circle circle"></i>
	<span class="menu-bar-item-name">Profile</span> 
</a>
</div>

<?php if(!empty($active_prodcuts)) { ?>
<div class="menu-bar-divider"></div>

<div class="menu-bar-item <?php if(is_page('my-account')){echo 'active';} ?>">
	<a href="<?php echo get_site_url();?>/my-account">
		<i class="fas fa-user-md"></i>
		<span class="menu-bar-item-name">My Account</span>
	</a>
</div>
<?php } ?>

<div class="menu-bar-divider"></div> 

 <?php } ?>

<?php if($role[0] == 'Provider'){ ?>

<div class="menu-bar-item <?php if(is_page('provider')){echo 'active';} ?>">
	<a href="<?php echo get_site_url();?>/profile/provider">
		<i class="fas fa-user-md"></i>
		<span class="menu-bar-item-name">Provider</span>
	</a>
</div>
<div class="menu-bar-divider"></div>

<div class="menu-bar-item <?php if(is_page('facilities')){echo 'active';} ?>">
	<a href="<?php echo get_site_url();?>/profile/facilities">
		<i class="fas fa-file-contract"></i>
		<span class="menu-bar-item-name">Facilities</span>
	</a>
</div>
<div class="menu-bar-divider"></div>

<div class="menu-bar-item <?php if(is_page('task-complete')){echo 'active';} ?>">
	<a href="<?php echo get_site_url();?>/profile/task-complete">
		<i class="fas fa-tasks"></i>
		<span class="menu-bar-item-name">Expirables</span>
	</a>
</div>

<?php if(!empty($active_prodcuts)) { ?>
<div class="menu-bar-divider"></div>

<div class="menu-bar-item <?php if(is_page('my-account')){echo 'active';} ?>">
	<a href="<?php echo get_site_url();?>/my-account">
		<i class="fas fa-user-md"></i>
		<span class="menu-bar-item-name">My Account</span>
	</a>
</div>
<?php } }else{
	if($role[0] == 'CRNA' || $role[0] == 'administrator')
	{
 ?>
<div class="menu-bar-item <?php if(is_page('share')){echo 'active';} ?>" id="SharingOption">
	<a href="<?php echo get_site_url();?>/profile/share">
		<i class="fad fa-paper-plane circle"></i>
		<span class="menu-bar-item-name">Sharing</span>
	</a>
</div>

<?php
} } ?>

 </section>

 
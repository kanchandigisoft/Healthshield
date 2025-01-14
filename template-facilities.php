<?php
if(is_user_logged_in()){
/*
* Template name: Facilities template
*/ 
get_header('dashboard');

echo get_template_part( 'template-headers/sidebar-dashboard' );


	/* Getting membership ids of current user */
	if(class_exists('MeprUtils')) {
	  $user = MeprUtils::get_currentuserinfo();
	  
	  if($user !== false && isset($user->ID)) {
	    //Returns an array of Membership ID's that the current user is active on
	    $active_prodcuts = $user->active_product_subscriptions('ids');
	    //print_r($active_prodcuts);
	  }
	}

?>
<div class="content edit_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
			<?php
			if($_GET['action'] && $_GET['action'] == 'add_new')
			{
				?>
				<h2 class="facilityTitle">Add Facility</h2>
				<form name="facilityform" id="facilityform" method="post" enctype="multipart/form-data" autocomplete="off">
					<div class="row">
		 			<div class="col-md-6 col-lg-6 col-12">
		 				<div class="form-group">
		 					<label for="facilityName">Facility Name</label>
		 					<input type="text" name="facilityName" autocapitalize="characters" id="facilityName" value="" required>	
		 				</div>
		 			</div>
		 			<div class="col-md-6 col-lg-6 col-12">
		 				<div class="form-group">
		 					<label for="facilityAddrs">Address</label>
		 					<input type="text" name="facilityAddrs" autocapitalize="characters" id="facilityAddrs" value="" required>			 					
		 				</div>
		 			</div>			
		 		</div>
		 		<div class="row">
		 			<div class="col-md-6 col-lg-6 col-12">
		 				<div class="form-group">
		 					<label for="siteContact">Site Contact</label>
		 					<input type="text" name="siteContact" autocapitalize="characters" id="siteContact" value="" required>	
		 				</div>
		 			</div>
		 			<div class="col-md-6 col-lg-6 col-12">
		 				<div class="form-group">
		 					<label for="phoneNum">Phone Number</label>
		 					<input type="text" name="phoneNum" autocapitalize="characters" id="phoneNum" value="" required>			 					
		 				</div>
		 			</div>			
		 		</div>
		 		<div class="row">
		 			<div class="col-md-12 col-lg-12 col-12">
		 				<div class="form-group">
		 					<label for="faciltyEmail">Email</label>
		 					<input type="text" name="faciltyEmail" autocapitalize="characters" id="faciltyEmail" value="" required>	
		 				</div>
		 			</div>		
		 		</div>
		 		<div class="row">
		 			<div class="col-md-12 col-lg-12 col-12">
		 				<div class="form-group">
		 					<input type="submit" name="saveFacility" autocapitalize="characters" id="saveFacility" value="Save Facility">	
		 				</div>
		 			</div>		
		 		</div>
				</form>
			<?php 

			if(isset($_POST['saveFacility']))
			{

				global $post, $wpdb;

				$facilityName = $_POST['facilityName'];
				$facilityAddrs = $_POST['facilityAddrs'];
				$siteContact = $_POST['siteContact'];
				$phoneNum = $_POST['phoneNum'];
				$faciltyEmail = $_POST['faciltyEmail'];
				$postid = wp_insert_post(array (
					   'post_type' => 'facility',
					   'post_title' => $facilityName,
					   'post_status' => 'publish',
					   'meta_input' => array(
					      'address' => $facilityAddrs,
					      'site_contact' => $siteContact,
					      'phone_number' => $phoneNum,
					      'email' => $faciltyEmail,

					      
					    ),
				));

				if(!is_wp_error($post_id)){
				  echo "<script> 
					Swal.fire({
						title: 'success!',
						text: 'Facility added successfully',
						icon: 'success',
						showConfirmButton: true,
						allowOutsideClick: true,
						allowEscapeKey: false,
						confirmButtonColor: '#40BFB9',
						});
					</script>";
					/*$url = get_site_url().'/profile/facilities';
					wp_redirect( $url );*/
				}else{
				  //there was an error in the post insertion, 
				  echo $post_id->get_error_message();
				}

			}

			exit;




			} /**if adding facility**/
			else
			{
			?>
			<h2 class="facilityTitle">Facilities <span>
				<?php $role = $current_user->roles;
            		if($role[0] == 'Provider'){
						if(!empty($active_prodcuts)) {
				?>
					<!-- <a href="<?php //echo get_site_url().'/profile/facilities/?action=add_new'; ?>">Add New</a> -->
					<a href="<?php echo get_site_url(); ?>/invite-facility/" class="btn ntn-medium inviteBtn"><i class="fal fa-plus"></i> Invite Facility</a>

				<?php } 
				} 
				?>
			</span></h2>


			<?php
			$uid = get_current_user_id();
			$savedFacility = get_user_meta($uid, 'selected_facilities', true);
			$savedFacilityData = explode(',', $savedFacility);


			//if($savedFacility){
				if(!empty($active_prodcuts)) {
					if($savedFacility){
			?>

			<table>
			<thead>
				<tr>
					<th>Facility Name</th>
					<th>Address</th>
					<th>Site Contact</th>
					<th>Phone Number</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>	
			<?php 
			foreach($savedFacilityData as $NewFacilityData) 
			{ 	
				$user_infos = get_user_meta($NewFacilityData);
				$user_info = get_userdata( $NewFacilityData ); //for some userdata like user email
				$facility_name = $user_infos['facility_name'][0];
				$facility_address = $user_infos['streetapt'][0];
				$site_contact = $user_infos['site_contact'][0];
				$phone_nm = $user_infos['phone_no'][0];
				$user_email = $user_info->user_email;


				$agencyId = get_user_meta($NewFacilityData, 'agency_id', true);
				// if ($uid == $agencyId)
				// 	{
				  //print_r($agencyId);
				  $key2 = 'facility_request_status_'.$uid;

				  $checkStatus = get_user_meta($NewFacilityData, $key2, true);
				  //print_r($checkStatus);
				  if($checkStatus == 0)
				  {
				  	$status = 'not accepted';
				  }
				  else
				  {
				  	$status = 'accepted';
				  }
					// }
					// else
					// {
					// 	$status = 'Nothing Matched';
					// }
				if($checkStatus == 1)
                {
			?>
 			 <tr>
 			 	<td><a href="<?php echo get_site_url(); ?>/profile/facilities/profile-facilities?faciId=<?php echo $NewFacilityData; ?>"><?php echo $facility_name; ?></a></td>
 			 	<td><?php echo $facility_address; ?></td>
 			 	<td><?php echo $site_contact; ?></td>
 			 	<td><?php echo $phone_nm; ?></td>
 			 	<td><?php echo $user_email; ?></td>
 			 </tr>

			<?php 
				}
			//endwhile;
			}
			?>
		</tbody>
		</table>
	  	<?php } } else {
	  		echo '<h2 class="purch_subs"><a href="'.get_the_permalink(5752).'">Please purchase subscription</a></h2>';
	  	} 
	  //} else {
	  	// echo '<h2 class="purch_subs"><a href="'.get_the_permalink(5512).'">Please purchase subscription</a></h2>';
	  //}


	  } ?>
        </div>
    </div>
</div>  
<style>
h2.facilityTitle span a {
    border: 1px solid #40BFB9;
    color: #40BFB9;
    font-size: 20px;
    padding: 5px 10px;
    text-decoration: none;
}
h2.facilityTitle span a:hover
{
    color: #fff;
    background: #40BFB9;
}
</style>      
<?php
get_footer('dashboard');
}else{
header('Location: ' . get_permalink(1310));
}
?>
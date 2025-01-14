<?php
/*
Template Name: Invite Provider
*/
if(is_user_logged_in() && current_user_can('Provider'))
{
get_header('dashboard');
echo get_template_part( 'template-headers/sidebar-dashboard' );
$uid = get_current_user_id();
$savedEmp = get_user_meta($uid, 'selected_employees', true);

$savedEmpData = explode(',', $savedEmp);
//delete_user_meta($uid, 'selected_employees');
//print_r($savedEmp);

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
<h2>Invite Employees</h2>	
<form name="inviteProviderForm" class="inviteProviderForm" method="post">
        <!-- <select name="selectProvider[]" multiple="multiple" class="js-example-basic-multiple selectProvider" required>
            <option value="">Select Provider</option> -->
            <?php 
            /*$args1 = array(
             'role' => 'CRNA',
             'orderby' => 'user_nicename',
             'order' => 'ASC'
            );
             $providers = get_users($args1);
            foreach($providers as $providerList) 
            { 
                  $id = $providerList->ID; 
                  $first_name = $providerList->first_name;
                  $last_name = $providerList->last_name;
                  $fullName = $first_name.' '.$last_name;
                  if (!in_array($id, $savedEmpData))
                  {
                  	echo '<option value="'.$id.'">'.$fullName.'</option>';
              	  }
            }*/
            ?>
        <!-- </select> -->
        <input type="email" name="empEmail" required="required" placeholder="Enter Email">
        <br /><br />
        <?php 
        $basicplan_ids = array(5415, 5417);
        $eliteplan_ids = array(5448, 5449);
        $unlimit_ids = array(5452, 5453);

        if (array_intersect($basicplan_ids, $active_prodcuts)){
        	if(count($savedEmpData) == 25){
        		echo '<div class="inv_lmt">Invitation limit reached</div>';
        	} else {
        		echo '<input type="submit" name="inviteProvider" value="Invite">';
        	}
        } elseif (array_intersect($eliteplan_ids, $active_prodcuts)){ 
        	if(count($savedEmpData) == 100){
        		echo '<div class="inv_lmt">Invitation limit reached</div>';
        	} else {
        		echo '<input type="submit" name="inviteProvider" value="Invite">';
        	} 
        } /*elseif (array_intersect($unlimit_ids, $active_prodcuts)){ 
        	if(count($savedEmpData) >= 250){
        		echo '<div class="inv_lmt">Invitation limit reached</div>';
        	} else {
        		echo '<input type="submit" name="inviteProvider" value="Invite">';
        	}
        } */		
		?>		
        <!-- <input type="submit" name="inviteProvider" value="Invite"> -->
        </form>
 
<?php if($savedEmp){ ?>       
<h2>Invited Employees</h2>	
<table border="1">
<tr>
	<th>Name</th>
	<th>Email</th>
	<th>Status</th>
	<th>Action</th>
</tr>
<?php foreach($savedEmpData as $NewEmpData) 
{ 
	  $user_info = get_userdata($NewEmpData);
	  $first_name = $user_info->first_name;
      $last_name = $user_info->last_name;
      $fullName = $first_name.' '.$last_name;
      $user_email = $user_info->user_email;  

	  $key2 = 'request_status_'.$uid;
	  
      $checkStatus = get_user_meta($NewEmpData, $key2, true);

      if($checkStatus == 0)
      {
      	$status = 'not accepted';
      }
      else
      {
      	$status = 'accepted';
      }
	?>
	<tr>
		<td><?php echo $fullName; ?></td>
		<td><?php echo $user_email; ?></td>
		<td><?php echo $status; ?></td>
		<td>
			<form name="deleteProviderForm" method="post" class="deleteProviderForm">
			<input type="hidden" value="<?php echo $NewEmpData; ?>" name="provider_id">
			<input type="submit" name="deleteProvider" value="Delete" class="deleteProvider">
			</form>
		</td>
	</tr>
<?php } ?>	
</table> 
<?php } ?>
 <?php
/**Save Provider**/ 
if(isset($_POST['inviteProvider']))
{
    global $user, $post;
    $uid = get_current_user_id();

    $provider_agency = get_user_meta($uid, 'provider_agency', true);

    $provideUser = get_userdata($uid);
    $providerName = $provideUser->display_name;

    //$selectedProvider = $_POST['selectProvider'];

    $empEmail = $_POST['empEmail'];

    $providerInString = implode(",", $selectedProvider);

    /*if($savedEmp)
    {
    	$newSave = $savedEmp.','.$providerInString;
    	update_user_meta($uid, 'selected_employees', $newSave);
    }
    else
    {
    	update_user_meta($uid, 'selected_employees', $providerInString);
    }

    foreach($selectedProvider as $providerId)
    {*/
    	$requestUrl = get_site_url().'/signup/?pId='.$uid;

    	/*$user_info = get_userdata($providerId);
    	$user_email = $user_info->user_email;
    	$user_name = $user_info->display_name;*/
    	
	    $to = $empEmail;
	    $subject = 'Agency has invited you to create a profile';
	    $body = '<html><body style="background:#efefef;">';
	    $body .= '<table cellspacing="0" cellpadding="20" style="font-size: 14px; font-family: sans-serif">';
	    $body .= '<tbody>
	    <tr><td style="font-size: 16px; font-weight: bold; color: #015084;">Hi '.$empEmail.'</td></tr>
	    <tr>
	    <td style="font-size: 16px; font-weight: bold; color: #015084;">
	    Great news! '.$provider_agency.' has invited you to create a profile with HealthShield Credentialing. <br>
	    <br><br>
		Please login and create your profile at your convenience. Once your profile is completed, you will receive automated reminders for documents expiring and your agency will have access to your profile and documents in real time. 
		<br><br>
		Or if you already have an account then please login into account first and <a href="'.$requestUrl.'" target="_blank"><u>click here</u></a> to accept the request.

		<br><br>
		Thank you for allowing us to simplify your credentialing process. Be sure to contact us if you have any questions.   
	    </td>
	        <tr>
	        <td style="font-size: 16px; font-weight: bold; color: #015084;">Thank you,<br>
	            HealthShield Credentialing<br>
	            T: <a href="tel:(864) 326-5399">(864) 326-5399</a> <br>
	            E: <a href="mailto:admin@healthshieldcredentialing.com">admin@healthshieldcredentialing.com</a> <br>
	            W: <a href="http://healthshieldcredentialing.com">http://healthshieldcredentialing.com/</a><br>
	                
	            </td>
	        </tr>
	    </tr>
	    </tbody>
	    </table></body></html>'; 

	    $headers = array(); 
	    $headers[] = 'Content-Type: text/html; charset=UTF-8';
	    $mailSent = wp_mail($to, $subject, $body, $headers);
		if($mailSent)
		{
	    echo "<script>
        Swal.fire({
	          icon: 'alert',  
	          title: 'Congrats!',
	          text: 'Invitation Sent Successfully',
	          confirmButtonColor: '#3085d6',
	          confirmButtonText: 'Ok'
	        }).then(function() {
	            window.location = '/invite-provider/';
	        });
    	</script>";
	    }

}

/**Delete Provider**/
if(isset($_POST['deleteProvider']))
{
	global $user, $post;
    $uid = get_current_user_id();
    $savedEmp = get_user_meta($uid, 'selected_employees', true);
	$savedEmpData = explode(',', $savedEmp);
    $provider_id = $_POST['provider_id'];

    if (($key = array_search($provider_id, $savedEmpData)) !== false) 
    {
		unset($savedEmpData[$key]);
		$newArray = implode(',',$savedEmpData);
		update_user_meta($uid, 'selected_employees', $newArray);

		$key1 = 'request_status_'.$uid;
    	delete_user_meta($provider_id, $key1);
    	delete_user_meta($provider_id, 'agency_id');
    	update_user_meta($provider_id, 'revoke_status_'.$uid, 'yes');

	}
    wp_redirect(get_the_permalink(5110));
}
?>   
</div>
</div>
</div> 
<script>
jQuery(document).ready(function() {
    jQuery('.js-example-basic-multiple').select2();
});

/*jQuery('.inviteProviderForm input[type="submit"][name="inviteProvider"]').click(function(){
	var data = jQuery('.selectProvider').val();
	if(data == null || data == ''){
		Swal.fire({
	      icon: 'alert',  
	      title: 'Not sent',
	      text: "Please select member to send invitation!",
	      confirmButtonColor: '#3085d6',
	      confirmButtonText: 'Ok'
	    })
	} else {
		Swal.fire({
	      icon: 'success',  
	      title: 'Success!',
	      text: "Invitation sent successfully.",
	      confirmButtonColor: '#3085d6',
	      confirmButtonText: 'Ok'
	    })
	}
});*/

jQuery('.deleteProviderForm [name="deleteProvider"]').click(function(){
	Swal.fire({
      icon: 'error',  
      title: 'Deleted!',
      text: "Deleted successfully.",
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ok'
    })
});
</script>   
<?php
get_footer('dashboard');
}
else{
header('Location: '. get_permalink(1310));
}
?>
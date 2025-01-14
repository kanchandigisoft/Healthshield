<?php
global $user, $post, $wpdb;

$facilityId =  get_user_meta($_GET['proId'], 'saved_facility', true);
$facilityUser = get_userdata($facilityId);
$facilityName = $facilityUser->display_name;
$first_name = $facilityUser->first_name;
$last_name =  $facilityUser->last_name;
$fullname = $first_name.' '.$last_name;
$email = $facilityUser->user_email;
$phone_no = get_user_meta($facilityId, 'phone_no', true);
$site_contact = get_user_meta($facilityId, 'site_contact', true);
$facility_name = get_user_meta($facilityId, 'facility_name', true);
$address = get_user_meta($facilityId, 'streetapt', true);
?>
<table class="facilifyFullInfo" border="1">
	<tr>
		<th>Facility Name</th>
		<td><?php echo $facility_name; ?></td>
	</tr>
	<tr>
		<th>Full Name</th>
		<td><?php echo $fullname; ?></td>
	</tr>
	<tr>
		<th>Email</th>
		<td><?php echo $email; ?></td>
	</tr>
	<tr>
		<th>Phone Number</th>
		<td><?php echo $phone_no; ?></td>
	</tr>
	<tr>
		<th>Address</th>
		<td><?php echo $address; ?></td>
	</tr>
	<tr>
		<th>Site Contact</th>
		<td><?php echo $site_contact; ?></td>
	</tr>
</table>

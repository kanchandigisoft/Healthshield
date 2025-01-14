<?php
if(is_user_logged_in()){
/*
* Template Name: Licenses
*/
get_header('dashboard');

echo get_template_part( 'template-headers/sidebar-dashboard' );
ob_start();
global $post;
$post_id = $_GET['lid'];
$attach_new = $_GET['attch'];

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
$LiType = get_field('licenses_type',$post_id);
$lcstate = get_field('licenses_state',$post_id);
$lcnumber = get_field('licenses_number',$post_id);
$lcExpire = get_field('expire_date',$post_id);
$lcIssue = get_field('issue_date',$post_id);
$titleP = get_the_title($post_id);
$lccompact = get_field('licenses_compact',$post_id);

if($lccompact == 1){
$val_compact = 'Yes';
}else{
$val_compact = 'No';
}

if($attach_new == 'attachments')
{
	echo '<style type="text/css">section.filedset.licensesforms{display:none !important}</style>';
}
$User_Id = get_current_user_id();
$args = array(  
	'post_type' => 'memberpressproduct',
	'post_status' => 'publish',
	'author' => $User_Id,
	);
	
	$loop = new WP_Query( $args ); 
	if ( $loop->have_posts()  ){  
	
	while ( $loop->have_posts() ) : $loop->the_post();
		$membertitle = get_the_title();
		$memberID = get_the_ID();	
	endwhile;
	}						
	$args = array(  
		'post_type' => 'licenses',
		'post_status' => 'publish',
		'author' => $User_Id,
	);
	$loop = new WP_Query( $args );
	$numberOfPosts= $loop->found_posts;

?>
<div class="content licenses_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
			 <form name="licensesform" id="licensesform" method="post" enctype="multipart/form-data" autocomplete="off">
             <input type="hidden" id="lid" name="lid" value="<?php echo $post_id;  ?>">
			 	<section class="filedset licensesforms">
		 		<div class="row">
		 			<div class="col-md-12 col-lg-12 col-12">
		 				<div class="form-group">
		 					<label for="license_type_id">License type</label>
		 					<select id="license_type_id" name="licenseType" class="license_type_cl" <?php if($attach_new){}else{echo 'required';}?>>
								<option value=""></option>
								<option <?php if($LiType == 'CRNA'){echo 'selected';} ?> value="CRNA">CRNA</option>
								<option <?php if($LiType == 'MD'){echo 'selected';} ?> value="MD">MD</option>
								<option <?php if($LiType == 'NP'){echo 'selected';} ?> value="NP">NP</option>
								<option <?php if($LiType == 'PA'){echo 'selected';} ?> value="PA">PA</option>
								<option <?php if($LiType == 'RN'){echo 'selected';} ?> value="RN">RN</option>
							</select>
		 				</div>
		 				<div class="form-group">
		 					<label for="license_state_id">STATE OF LICENSE</label>
		 					<select id="license_state_id" name="licenseState" class="license_state_cl" <?php if($attach_new){}else{echo 'required';}?>>
								<option value=""></option>
								<option <?php if($lcstate =='Alabama'){echo 'selected';} ?> value="Alabama">Alabama</option>
								<option <?php if($lcstate =='Alaska'){echo 'selected';} ?> value="Alaska">Alaska</option>
								<option <?php if($lcstate =='Arizona'){echo 'selected';} ?> value="Arizona">Arizona</option>
								<option <?php if($lcstate =='American Samoa'){echo 'selected';} ?> value="American Samoa">American Samoa</option>
								<option <?php if($lcstate =='Arkansas'){echo 'selected';} ?> value="Arkansas">Arkansas</option>
								<option <?php if($lcstate =='California'){echo 'selected';} ?>value="California">California</option>
								<option <?php if($lcstate =='Colorado'){echo 'selected';} ?> value="Colorado">Colorado</option>
								<option <?php if($lcstate =='Connecticut'){echo 'selected';} ?> value="Connecticut">Connecticut</option>
								<option <?php if($lcstate =='Delaware'){echo 'selected';} ?>  value="Delaware">Delaware</option>
								<option <?php if($lcstate =='District Of Columbia'){echo 'selected';} ?>  value="District Of Columbia">District Of Columbia</option>
								<option <?php if($lcstate =='Florida'){echo 'selected';} ?> value="Florida">Florida</option>
								<option <?php if($lcstate =='Georgia'){echo 'selected';} ?> value="Georgia">Georgia</option>
								<option <?php if($lcstate =='Guam'){echo 'selected';} ?> value="Guam">Guam</option>
								<option <?php if($lcstate =='Hawaii'){echo 'selected';} ?> value="Hawaii">Hawaii</option>
								<option <?php if($lcstate =='Idaho'){echo 'selected';} ?> value="Idaho">Idaho</option>
								<option <?php if($lcstate =='Illinois'){echo 'selected';} ?> value="Illinois">Illinois</option>
								<option <?php if($lcstate =='Indiana'){echo 'selected';} ?> value="Indiana">Indiana</option>
								<option <?php if($lcstate =='Iowa'){echo 'selected';} ?> value="Iowa">Iowa</option>
								<option <?php if($lcstate =='Kansas'){echo 'selected';} ?> value="Kansas">Kansas</option>
								<option <?php if($lcstate =='Kentucky'){echo 'selected';} ?> value="Kentucky">Kentucky</option>
								<option <?php if($lcstate =='Louisiana'){echo 'selected';} ?> value="Louisiana">Louisiana</option>
								<option <?php if($lcstate =='Maine'){echo 'selected';} ?> value="Maine">Maine</option>
								<option <?php if($lcstate =='Maryland'){echo 'selected';} ?> value="Maryland">Maryland</option>
								<option <?php if($lcstate =='Massachusetts'){echo 'selected';} ?> value="Massachusetts">Massachusetts</option>
								<option <?php if($lcstate =='Michigan'){echo 'selected';} ?> value="Michigan">Michigan</option>
								<option <?php if($lcstate =='Minnesota'){echo 'selected';} ?> value="Minnesota">Minnesota</option>
								<option <?php if($lcstate =='Mississippi'){echo 'selected';} ?> value="Mississippi">Mississippi</option>
								<option <?php if($lcstate =='Missouri'){echo 'selected';} ?> value="Missouri">Missouri</option>
								<option <?php if($lcstate =='Montana'){echo 'selected';} ?> value="Montana">Montana</option>
								<option <?php if($lcstate =='Nebraska'){echo 'selected';} ?> value="Nebraska">Nebraska</option>
								<option <?php if($lcstate =='Nevada'){echo 'selected';} ?> value="Nevada">Nevada</option>
								<option <?php if($lcstate =='New Hampshire'){echo 'selected';} ?> value="New Hampshire">New Hampshire</option>
								<option <?php if($lcstate =='New Jersey'){echo 'selected';} ?> value="New Jersey">New Jersey</option>
								<option <?php if($lcstate =='New Mexico'){echo 'selected';} ?> value="New Mexico">New Mexico</option>
								<option <?php if($lcstate =='New York'){echo 'selected';} ?> value="New York">New York</option>
								<option <?php if($lcstate =='North Carolina'){echo 'selected';} ?> value="North Carolina">North Carolina</option>
								<option <?php if($lcstate =='North Dakota'){echo 'selected';} ?> value="North Dakota">North Dakota</option>
								<option <?php if($lcstate =='Northern Mariana Islands'){echo 'selected';} ?> value="Northern Mariana Islands">Northern Mariana Islands</option>
								<option <?php if($lcstate =='Ohio'){echo 'selected';} ?> value="Ohio">Ohio</option>
								<option <?php if($lcstate =='Oklahoma'){echo 'selected';} ?> value="Oklahoma">Oklahoma</option>
								<option <?php if($lcstate =='Oregon'){echo 'selected';} ?> value="Oregon">Oregon</option>
								<option <?php if($lcstate =='Pennsylvania'){echo 'selected';} ?> value="Pennsylvania">Pennsylvania</option>
								<option <?php if($lcstate =='Puerto Rico'){echo 'selected';} ?> value="Puerto Rico">Puerto Rico</option>
								<option <?php if($lcstate =='Rhode Island'){echo 'selected';} ?> value="Rhode Island">Rhode Island</option>
								<option <?php if($lcstate =='South Carolina'){echo 'selected';} ?> value="South Carolina">South Carolina</option>
								<option <?php if($lcstate =='South Dakota'){echo 'selected';} ?> value="South Dakota">South Dakota</option>
								<option <?php if($lcstate =='Tennessee'){echo 'selected';} ?> value="Tennessee">Tennessee</option>
								<option <?php if($lcstate =='Texas'){echo 'selected';} ?> value="Texas">Texas</option>
								<option <?php if($lcstate =='United States Minor Outlying Islands'){echo 'selected';} ?> value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
								<option <?php if($lcstate =='Utah'){echo 'selected';} ?> value="Utah">Utah</option>
								<option <?php if($lcstate =='Vermont'){echo 'selected';} ?> value="Vermont">Vermont</option>
								<option <?php if($lcstate =='Virgin Islands'){echo 'selected';} ?> value="Virgin Islands">Virgin Islands</option>
								<option <?php if($lcstate =='Virginia'){echo 'selected';} ?> value="Virginia">Virginia</option>
								<option <?php if($lcstate =='Washington'){echo 'selected';} ?> value="Washington">Washington</option>
								<option <?php if($lcstate =='West Virginia'){echo 'selected';} ?> value="West Virginia">West Virginia</option>
								<option <?php if($lcstate =='Wisconsin'){echo 'selected';} ?> value="Wisconsin">Wisconsin</option>
								<option <?php if($lcstate =='Wyoming'){echo 'selected';} ?> value="Wyoming">Wyoming</option>
		 					</select>
		 				</div>
		 				<div class="form-group">
		 					<label for="license_number_id">License Number</label>
		 					<input type="text" name="licenseName" autocapitalize="characters" id="license_number_id" value="<?php if($lcnumber){echo get_the_title($post_id);} ?>" <?php if($attach_new){}else{echo 'required';}?>>			 					
		 				</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" id="license_compact" name="licenseCompact" type="checkbox" value="<?php echo $val_compact;?>" <?php if($val_compact == 'Yes'){echo'checked';} ?>>
								<label class="custom-control-label" for="license_compact">License is Compact</label>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="license_issue_on">Issue Date</label>
									<input type="text" value="<?php echo $lcIssue; ?>" name="licensesissueDate" id="license_issue_on" class="issuedatePicker" <?php if($attach_new){}else{echo 'required';}?>>
								</div>
							</div>
							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="license_expires_on">Expiration Date</label>
									<input type="text" value="<?php echo $lcExpire; ?>" name="licensesExpireDate" id="license_expires_on" class="userdatePicker" <?php if($attach_new){}else{echo 'required';}?>>
								</div>
							</div>	
						</div>
		 			</div>
		 		</div>
		 	</section>
		 	<section class="filedset attachemnts">
				
		 		<div class="row">
		 			<div class="col-12 col-md-12 col-lg-12">
					<div class="row mb-3">
						<div class="col-lg-10">
							<h5 class="mt-0">Attachments</h5>
						</div>
						<div class="col-lg-2 text-end">
							<a id="add_attachment" href="#" class="btn btn-floating kamana-new" data-type="license"><i class="fal fa-plus"></i></a>
						</div>				
					</div>
						<div class="card bg-light mb-2">
							<div class="card-body">
								Have an attachment?  Click the "+" sign above.
							</div>
						</div>
		 			</div>
		 		</div>
		 		<div class="attachments_lists">
					<?php
					$imgs = get_post_meta($post_id,'license_attachment_id',true);
					$meta = explode(',', $imgs);
					$i = 0;

					foreach ($meta as $metas) {

					$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
					//$count = count($metas);
					if($attch_name){
					$loopattach = '<input id="license_attachments_'.$i.'_id" name="upload_file['.$i.'][id]" type="hidden" value="'.$metas.'">
					<div class="card form-group">
					<div class="d-flex attchments_posts"><i class="fal fa-file-image healthshield-green-text"></i>
					<div class="attchName">'.$attch_name.'</div></div>
					</div>';
					echo $loopattach;
					}
					
					$i++;
					}
					?>

					
				
		 		</div>
		 	</section>
			
				<div class="form-group Licsubmitbuttons">
					<button class="btn btn-primary submitFormProfil" name="licenseSubmit" id="licenseSubmit" type="submit">Save Changes</button>
					<a class="btn btn-cancel" href="<?php echo get_site_url(); ?>/profile#licenses">Cancel</a>
				</div>
			 </form>
		</div>

		<?php 

if(isset($_POST['licenseSubmit'])){

$Licencetype = $_POST['licenseType'];
$Licencestate = $_POST['licenseState'];
$Licencenumber = $_POST['licenseName'];
$Licencecompact = $_POST['licenseCompact'];
$Licencdate = $_POST['licensesExpireDate'];
$Licencissuedate = $_POST['licensesissueDate'];

$LicCompact = $_POST['licenseCompact'];
	if($LicCompact == 'Yes'){
	$LicCompact = 1;
	}else{
	$LicCompact = 0;
	}
$lid = $_POST['lid'];

require_once( ABSPATH . 'wp-admin/includes/image.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once( ABSPATH . 'wp-admin/includes/media.php' );
$result = array();

if($lid == '')
{
$postid = wp_insert_post(array (
   'post_type' => 'licenses',
   'post_title' => $Licencenumber,
   'post_status' => 'publish',
   'meta_input' => array(
      'licenses_type' => $Licencetype,
      'licenses_state' => $Licencestate,
      'licenses_number' => $Licencenumber,
      'expire_date' => $Licencdate,
      'issue_date' => $Licencissuedate,
      'licenses_compact' => $LicCompact,
      
    ),
));
$files = $_FILES["upload_file"];
if($files)
{
    foreach ($files['name'] as $key => $value) 
    {
        if ($files['name'][$key]) 
        {
            $file = array(
                'name' => $files['name'][$key],
                'type' => $files['type'][$key],
                'tmp_name' => $files['tmp_name'][$key],
                'error' => $files['error'][$key],
                'size' => $files['size'][$key]
            );
            $_FILES = array("upload_file" => $file);
            $attachment_id = media_handle_upload("upload_file", $postid);
            $result[] = $attachment_id;
        }
    } 

  	 $Ids = implode(",",$result);
	 $savedAttach = get_post_meta($postid, 'license_attachment_id', true);	    
	 //echo $savedAttach;
	 if($savedAttach){
			$new_val = $Ids.','.$savedAttach;
			update_post_meta($postid, 'license_attachment_id', $new_val); 
	 }
	 else
	 {
     	update_post_meta($postid, 'license_attachment_id', $Ids);   
	 }
}
$url = get_site_url().'/profile';
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
if($membertitle == 'Elite'){
	if($numberOfPosts < '2'){ 
		
	}else{
		echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
	}
}else{
	
}
}
else
{
$postid = $lid;
$my_post = array(
  'ID'           => $postid,
  'post_title'   => $Licencenumber,
	);
	wp_update_post( $my_post );
	update_post_meta($lid, 'licenses_type', $Licencetype);
	update_post_meta($lid, 'licenses_state', $Licencestate);
	update_post_meta($lid, 'licenses_number', $Licencenumber);
	update_post_meta($lid, 'expire_date', $Licencdate);
	update_post_meta($lid, 'issue_date', $Licencissuedate);
	update_post_meta($lid, 'licenses_compact', $LicCompact);
	
$files = $_FILES["upload_file"];
if($files)
{
    foreach ($files['name'] as $key => $value) 
    {
        if ($files['name'][$key]) 
        {
            $file = array(
                'name' => $files['name'][$key],
                'type' => $files['type'][$key],
                'tmp_name' => $files['tmp_name'][$key],
                'error' => $files['error'][$key],
                'size' => $files['size'][$key]
            );
            $_FILES = array("upload_file" => $file);
            $attachment_id = media_handle_upload("upload_file", $postid);
            $result[] = $attachment_id;
        }
    } 

  	 $Ids = implode(",",$result);
	 $savedAttach = get_post_meta($postid, 'license_attachment_id', true);	    
	 //echo $savedAttach;
	 if($savedAttach){
			$new_val = $Ids.','.$savedAttach;
			update_post_meta($postid, 'license_attachment_id', $new_val); 
	 }
	 else
	 {
     	update_post_meta($postid, 'license_attachment_id', $Ids);   
	 }
}

$url = get_site_url().'/profile';
wp_redirect( $url );
exit;
}

}
?>
		
	</div>
</div>



<?php
get_footer('dashboard');

}else{
	header('Location: ' . get_permalink(1310));
}
?>
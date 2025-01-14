<?php
if(is_user_logged_in()){
/*
* Template Name: Certifications
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

$post_id = $_GET['cid'];
$attach_new = $_GET['attch'];
 $cert_type = get_field('certificate_type',$post_id);
 $cert_number = get_field('certification_number',$post_id);
 $cert_expire = get_field('certificate_expire_date',$post_id);
 $cert_issue = get_field('certificate_issue_date',$post_id);
 $cert_hidden = get_field('certificate_hidden',$post_id);
 $otherNam = get_post_meta($post_id, 'otherNam', true);

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
		'post_type' => 'certifications',
		'post_status' => 'publish',
		'author' => $User_Id,
	);
	$loop = new WP_Query( $args );
	$numberOfPosts= $loop->found_posts;
?>

<div class="content licenses_content">
<div class="container pt-5 ps-5 pe-5 pb-1">
	<div class="row">

		<form name="certificateform" id="certificateform" method="post" enctype="multipart/form-data" autocomplete="off">
			<input type="hidden" id="cid" name="cid" value="<?php echo $post_id; ?>">
			<input type="hidden" id="certificate_hidden" name="certificatehidden" value="<?php if($cert_hidden){echo $cert_hidden;} ?>">


            <section class="filedset licensesforms">
		 		<div class="row">
		 			<div class="col-md-12 col-lg-12 col-12">
		 				<div class="form-group">
		 					<label for="certificate_type_id">Certification Type</label>
							<select id="certificate_type_id" name="certificatetype" class="Certificatetype" <?php if($attach_new){}else{echo 'required';} ?>>
								<option value=""></option>
								<option <?php if($cert_type == 'ACLS'){ echo 'selected'; } ?> value="ACLS">Advanced Cardiac Life Support (ACLS)</option>
								<option <?php if($cert_type == 'PALS'){ echo 'selected'; } ?> value="PALS">Pediatric Advanced Life Support (PALS)</option>
								<option <?php if($cert_type == 'BLS'){ echo 'selected'; } ?> value="BLS">Basic Life Support (BLS)</option>
								<option <?php if($cert_type == 'NBCRNA'){ echo 'selected'; } ?> value="NBCRNA">National Board of Certification and Recertification for Nurse Anesthetists (NBCRNA)</option>
								<option <?php if($cert_type == 'TNCC'){ echo 'selected'; } ?> value="TNCC">Trauma Nursing Core Course (TNCC)</option>
								<option <?php if($cert_type == 'ATLS'){ echo 'selected'; } ?> value="ATLS">Advanced Trauma Life Support (ATLS)</option>
								<option <?php if($cert_type == 'CCRN'){ echo 'selected'; } ?> value="CCRN">Certified Critical Care Registered Nurse (CCRN)</option>
								<option <?php if($cert_type == 'OTHER'){ echo 'selected'; } ?> value="OTHER">Other</option>
							</select>
							<!-----
		 					<input type="text" name="certificatetype" id="certificate_type_id" class="Certificatetype"  autofocus spellcheck="false" autocomplete="off" data-key="certificate_autocaomplte_type" value="<?php if($cert_type){echo $cert_type;} ?>" data-input-val="" <?php if($attach_new){}else{echo 'required';} ?>>
		 					<div class="autocomplete-certificate-dropdown-menu dropdown-menu"></div>
							------->
		 				</div>
		 				<?php
		 				if($otherNam != '' AND $cert_type == 'OTHER')
		 				{
		 				?>
		 				<div class="form-group" id="otherNam">
		 				<label for="certificate_issue_on">Enter Name</label>
		 				<input type="text" value="<?php echo $otherNam; ?>" name="otherNam" class="other_name" placeholder="Enter Name">
		 				</div>	
		 				<?php }
		 				else
		 				{
		 				?>
		 				<div class="form-group" id="otherNam" style="display: none;">
		 				<label for="certificate_issue_on">Enter Name</label>
		 				<input type="text" value="<?php echo $otherNam; ?>" name="otherNam" class="other_name" placeholder="Enter Name">
		 				</div>
		 				<?php
		 				}
		 				?>

						 <div class="form-group">
							<label for="certificate_issue_on">Issue Date</label>
							<input type="text" value="<?php if($cert_issue){echo $cert_issue;} ?>" name="certificateissueDate" id="certificate_issue_on" class="issuedatePicker" <?php if($attach_new){}else{echo 'required';} ?>>
						</div>
		 				<div class="form-group">
							<label for="certificate_expires_on">Expiration Date</label>
							<input type="text" value="<?php if($cert_expire){echo $cert_expire;} ?>" name="certificateExpireDate" id="certificate_expires_on" class="userdatePicker" <?php if($attach_new){}else{echo 'required';} ?>>
						</div>
		 				<div class="form-group">
		 					<label for="certificate_number_id">Certification Number (If applicable)</label>
		 					<input type="text" name="certificateNumber" autocapitalize="characters" id="certificate_number_id" value="<?php if($cert_number ){echo $cert_number ;} ?>">			 					
		 				</div>						
						
		 			</div>
		 		</div>
		 	</section>
		 	<section class="filedset attachemnts mb-2">
				
		 		<div class="row">
		 			<div class="col-12 col-md-12 col-lg-12">
					<div class="row mb-3">
						<div class="col-lg-10">
							<h5 class="mt-0">Attachments</h5>
						</div>
						<div class="col-lg-2 text-end">
							<a id="add_attachment" href="#" class="btn btn-floating healthshiled-new" data-type="certificate"><i class="fal fa-plus"></i></a>
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
					$imgs = get_post_meta($post_id,'certificate_attachment_id',true);
					$meta = explode(',', $imgs);
					$i = 0;

					foreach ($meta as $metas) {

					$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
					//$count = count($metas);
					if($attch_name){
					$loopattach = '<input id="certificate_attachment_'.$i.'_id" name="upload_file['.$i.'][id]" type="hidden" value="'.$metas.'">
					<div class="card form-group">
					<div class="d-flex attchments_posts"><i class="fal fa-file-image healthshiled-green-text"></i>
					<div class="attchName">'.$attch_name.'</div></div>
					</div>';
					echo $loopattach;
					}
					
					$i++;
					}
					?>
		 		</div>
		 	</section>

			<div class="form-group">
				<button class="btn btn-primary submitFormProfile" name="certificateSubmit" id="certificateSubmit" type="submit">Save Changes</button>
				<a class="btn btn-cancel" href="<?php echo get_site_url(); ?>/profile#certifications">Cancel</a>
			</div>
			
		</form>


	</div>
</div>
</div>


<?php 
if(isset($_POST['certificateSubmit'])){

$lid = $_POST['cid'];

$certificatetype = $_POST['certificatetype'];
$certificatenumber = $_POST['certificateNumber'];
$certificatedate = $_POST['certificateExpireDate'];
$certificateissuedate = $_POST['certificateissueDate'];
$certificatehidden = $_POST['certificatehidden'];
$otherNam = $_POST['otherNam'];

require_once( ABSPATH . 'wp-admin/includes/image.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once( ABSPATH . 'wp-admin/includes/media.php' );
$result = array();

if($lid == '')
{

$postid = wp_insert_post(array (
   'post_type' => 'certifications',
   'post_title' => $certificatenumber,
   'post_status' => 'publish',
   'meta_input' => array(
      'certificate_type' => $certificatetype,  
      'certification_number' => $certificatenumber,
      'certificate_expire_date' => $certificatedate,
      'certificate_hidden' => $certificatehidden,
	  'certificate_issue_date' => $certificateissuedate,     
    ),
));

if($otherNam != '' && $certificatetype == 'OTHER')
{
	update_post_meta($postid, 'otherNam', $otherNam);  
}

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
	 $savedAttach = get_post_meta($postid, 'certificate_attachment_id', true);	    
	 //echo $savedAttach;
	 if($savedAttach){
			$new_val = $Ids.','.$savedAttach;
			update_post_meta($postid, 'certificate_attachment_id', $new_val); 
	 }
	 else
	 {
     	update_post_meta($postid, 'certificate_attachment_id', $Ids);   
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
		echo '<style> #certificateSubmit{display:none;} </style>';
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
  'post_title'   => $certificatenumber,
	);
	wp_update_post( $my_post );
	update_post_meta($lid, 'certificate_type', $certificatetype);
	update_post_meta($lid, 'certification_number', $certificatenumber);
	update_post_meta($lid, 'certificate_expire_date', $certificatedate);
	update_post_meta($lid, 'certificate_hidden',$certificatehidden);
	update_post_meta($lid, 'certificate_issue_date',$certificateissuedate);
	if($otherNam != '' && $certificatetype == 'OTHER')
	{
		update_post_meta($lid, 'otherNam',$otherNam);
	}
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
			$savedAttach = get_post_meta($postid, 'certificate_attachment_id', true);	    
			//echo $savedAttach;
			if($savedAttach){
					$new_val = $Ids.','.$savedAttach;
					update_post_meta($postid, 'certificate_attachment_id', $new_val); 
			}
			else
			{
				update_post_meta($postid, 'certificate_attachment_id', $Ids);   
			}
		}


	$url = get_site_url().'/profile';
	wp_redirect( $url );
	exit;
}


}


?>
<script>
jQuery(document).ready(function(){
  jQuery("select#certificate_type_id").change(function(){
    var val = jQuery(this).val();
    if(val == 'OTHER')
    {
    	jQuery('#otherNam').show();
    }
    else
    {
    	jQuery('#otherNam').hide();
    }
  });
});
</script>
<?php
get_footer('dashboard');
}else{
	header('Location: ' . get_permalink(1310));
}
?>

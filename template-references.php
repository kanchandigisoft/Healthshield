<?php 
if(is_user_logged_in()){
/*
* Template Name: References
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
$uid = get_current_user_id();
$rfid = $_GET['rfid'];
$attachment = $_GET['attch'];
$refrencename = get_field('references_name',$rfid);
$refrenceposition = get_field('references_position',$rfid);
$refrenceEmail = get_field('references_email',$rfid);
$refrencePhone = get_field('references_phone_number',$rfid);
$refrenceWorkentery = get_field('references_work_entery',$rfid);
$reverencesknown = get_field('references_known',$rfid);

if($attachment == 'attachments'){
	echo '<style>form .refrencesforms{display:none;}</style>';
}else{
	
}

?>
<div class="topSuccessMsg">
	<div class="alert alert-success fade hide submitsave" role="alert">
	Your data is Saved!
	</div>
</div>
<div class="topfailedMsg">
	<div class="alert alert-danger fade hide submitfail" role="alert">
	Your data is not saved!
	</div>
</div>
<div class="content licenses_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">

			<form name="refrencesform" id="refrencesform" method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" id="rfid" name="rfid" value="<?php echo $rfid; ?>">

		        <section class="filedset refrencesforms">
					<div class="row">
			 		  	<div class="col-12 col-md-6">
			 		  		<div class="form-group">
			 		  			<label for="reference_name">Name of Reference</label>
			 		  			<input autocorrect="off" class="form-control" id="reference_name" name="reference_name"  type="text" value="<?php if($refrencename){echo $refrencename;} ?>" <?php if($attachment){}else{echo 'required';} ?>>

			 		  		</div>
			 		  	</div>

			 		  	<div class="col-12 col-md-6">
			 		  		<div class="form-group">
			 		  			<label for="reference_contact_position">Position Held by Reference</label>
			 		  			<input class="form-control" id="reference_contact_position" name="reference_contact_position"  type="text" value="<?php if($refrenceposition){echo $refrenceposition;} ?>" <?php if($attachment){}else{echo 'required';} ?>>

			 		  		</div>
			 		  	</div>
			 		  </div>

			 		  <div class="row">
			 		  	<div class="col-12 col-md-6">
			 		  		<div class="form-group">
			 		  			<label for="reference_contact_email">Email Address of Reference</label>
			 		  			<input autocapitalize="none" class="form-control" id="reference_contact_email" name="reference_contact_email" type="email" value="<?php if($refrenceEmail){echo $refrenceEmail;} ?>">
			 		  			<small class="form-text text-muted">You must provide an email address, a phone number, or both.</small>
			 		  		</div>
			 		  	</div>

			 		  	<div class="col-12 col-md-6">
			 		  		<div class="form-group">
			 		  			<label for="reference_contact_phone_number">Phone Number of Reference</label>
			 		  			<input autocapitalize="none" class="form-control" id="reference_contact_phone_number" maxlength="14" minlength="10" name="reference_contact_phone_number" title="Only valid US phone numbers are currently accepted." type="tel" value="<?php if($refrencePhone){echo $refrencePhone;} ?>">

			 		  			<small class="form-text text-muted">You must provide an email address, a phone number, or both.</small>
			 		  		</div>
			 		  	</div>
			 		  </div>
					  <div class="form-group">
						<label for="reference_long_known_id">How long you’ve known the reference </label>
						<input type="text" id="reference_long_known_id" name="reference_long_known_id" value="<?php if($reverencesknown){echo $reverencesknown;} ?>" <?php if($attachment){}else{echo 'required';} ?>>
					  </div>
			 	</section>
			 	<section class="filedset attachemnts mb-4">
					
			 		<div class="row">
			 			<div class="col-12 col-md-12 col-lg-12">
						<div class="row mb-3">
							<div class="col-lg-10">
								<h5 class="mt-0">Attachments</h5>
							</div>
							<div class="col-lg-2 text-end">
								<a id="add_attachment" href="#" class="btn btn-floating healthshield-new" data-type="license"><i class="fal fa-plus"></i></a>
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
						$imgs = get_post_meta($post_id,'refrences_attachment_id',true);
						$meta = explode(',', $imgs);
						$i = 0;

						foreach ($meta as $metas) {

						$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
						//$count = count($metas);
						if($attch_name){
						$loopattach = '<input id="refrences_attachments_'.$i.'_id" name="upload_file['.$i.'][id]" type="hidden" value="'.$metas.'">
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
					<button class="btn btn-primary submitFormProfil" name="refrencesSubmit" id="refrencesSubmit" type="submit">Save Changes</button>
					<a class="btn btn-cancel" href="<?php echo get_site_url(); ?>/profile#refrences">Cancel</a>
				</div>
				
			</form>
		</div>
	</div>
</div>

<?php 
if(isset($_POST['refrencesSubmit'])){

$reference_work_history = $_POST['reference_work_history'];
$reference_name = $_POST['reference_name'];
$reference_contact_position = $_POST['reference_contact_position'];
$reference_contact_email = $_POST['reference_contact_email'];
$reference_contact_phone_number = $_POST['reference_contact_phone_number'];
$reference_long_known_id = $_POST['reference_long_known_id'];

$rfid = $_POST['rfid'];

require_once( ABSPATH . 'wp-admin/includes/image.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once( ABSPATH . 'wp-admin/includes/media.php' );
$result = array();

if($rfid == '')
{
$postid = wp_insert_post(array (
'post_type' => 'references',
'post_title' => $reference_name,
'post_status' => 'publish',
'meta_input' => array(
  'references_name' => $reference_name,
  'references_position' => $reference_contact_position,
  'references_email' => $reference_contact_email,
  'references_phone_number' => $reference_contact_phone_number,
  'references_work_entery' => $reference_work_history,
  'references_known' => $reference_long_known_id,
  
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
 $savedAttach = get_post_meta($postid, 'refrences_attachment_id', true);	    
 //echo $savedAttach;
 if($savedAttach){
		$new_val = $Ids.','.$savedAttach;
		update_post_meta($postid, 'refrences_attachment_id', $new_val); 
 }
 else
 {
 	update_post_meta($postid, 'refrences_attachment_id', $Ids);   
 }
}

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

}
else
{
$postid = $rfid;
$my_post = array(
'ID'           => $postid,
'post_title'   => $reference_name,
);
wp_update_post( $my_post );

update_post_meta($rfid, 'references_name', $reference_name);
update_post_meta($rfid, 'references_position', $reference_contact_position);
update_post_meta($rfid, 'references_email', $reference_contact_email);
update_post_meta($rfid, 'references_phone_number', $reference_contact_phone_number);
update_post_meta($rfid, 'references_work_entery', $reference_work_history);
update_post_meta($rfid, 'references_known', $reference_long_known_id);
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
 $savedAttach = get_post_meta($postid, 'refrences_attachment_id', true);	    
 //echo $savedAttach;
 if($savedAttach){
		$new_val = $Ids.','.$savedAttach;
		update_post_meta($postid, 'refrences_attachment_id', $new_val); 
 }
 else
 {
 	update_post_meta($postid, 'refrences_attachment_id', $Ids);   
 }
}

$url = get_site_url().'/profile';
wp_redirect( $url );
exit;
}


}

?>

<?php
get_footer('dashboard');
}else{
	header('Location: ' . get_permalink(1310));
}
?>
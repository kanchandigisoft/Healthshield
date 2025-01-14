<?php
if(is_user_logged_in()){
/*
* Template Name: Additional Documents
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

global $post;
$post_id = $_GET['adid'];
$attach_new = $_GET['adattch'];

$current_user = wp_get_current_user();
$documentType = get_field('document_type',$post_id);
$documentname = get_field('document_name',$post_id);
$documentdesc = get_field('document_description',$post_id);

if($attach_new == 'attachments')
{
	echo '<style type="text/css">section.filedset.licensesforms{display:none !important}</style>';
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

		<form name="documentform" id="documentform" method="post" enctype="multipart/form-data" autocomplete="off">
			<input type="hidden" id="adid" name="adid" value="<?php echo $post_id;  ?>">


            <section class="filedset licensesforms">
		 		<div class="row">
		 			<div class="col-md-12 col-lg-12 col-12">
		 				<div class="form-group">
		 					<label for="document_type_id">Document type</label>
		 					<select id="document_type_id" name="documentType" class="document_type_cl" <?php if($attach_new){}else{echo 'required';} ?>>

	 						<option value=""></option>
							<option <?php if($documentType == 'CAQH ProView Profile Information'){echo 'selected';} ?> value="CAQH ProView Profile Information">CAQH ProView Profile Information</option>
							<option <?php if($documentType == 'Drivers License'){echo 'selected';} ?>  value="Drivers License">Drivers License</option>
							<option <?php if($documentType == 'Other Document'){echo 'selected';} ?> value="Other Document">Other Document</option>
							<option <?php if($documentType == 'Previous Addresses'){echo 'selected';} ?>  value="Previous Addresses">Previous Addresses</option>
							<option <?php if($documentType == 'Resume/CV'){echo 'selected';} ?>  value="Resume/CV">Resume/CV</option>
							<option <?php if($documentType == 'Social Security Card'){echo 'selected';} ?> valiue="Social Security Card">Social Security Card</option>
							<option <?php if($documentType == 'Voided Check'){echo 'selected';} ?> value="Voided Check">Voided Check</option>
							<option <?php if($documentType == 'W-9'){echo 'selected';} ?>  value="W-9">W-9</option>
							</select>
		 				</div>
		 				<div class="form-group">
		 					<label for="document_name_id">Document Name</label>
		 					<input type="text" class="document_name_cl" id="document_name_id" name="documentname" <?php if($attach_new){}else{echo 'required';} ?> value="<?php if($documentname){echo $documentname;} ?>">
		 					
		 				</div>
		 				<div class="form-group">
		 					<label for="document_description_id">Description (Optional)</label>
		 					<textarea name="documentdescription" id="document_description_id" maxlength="500" data-bs-length="500"><?php if($documentdesc){echo $documentdesc; } ?></textarea>
		 					<small class="form-text text-muted">Visible to people you share your profile with.</small>		 					
		 				</div>
						
		 			</div>
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
							<a id="add_attachment" href="#" class="btn btn-floating healthshiled-new" data-type="license"><i class="fal fa-plus"></i></a>
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
					$imgs = get_post_meta($post_id,'document_attachment_id',true);
					$meta = explode(',', $imgs);
					$i = 0;

					foreach ($meta as $metas) {

					$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
					//$count = count($metas);
					if($attch_name){
					$loopattach = '<input id="license_attachments_'.$i.'_id" name="upload_file['.$i.'][id]" type="hidden" value="'.$metas.'">
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
				<button class="btn btn-primary submitFormProfil" name="documentSubmit" id="documentSubmit" type="submit">Save Changes</button>
				<a class="btn btn-cancel" href="<?php echo get_site_url(); ?>/profile#additionalDocuments">Cancel</a>
			</div>
			
		</form>


	</div>
</div>
</div>


<?php 
if(isset($_POST['documentSubmit'])){

$documenttype = $_POST['documentType'];
$documentname = $_POST['documentname'];
$documentdescription = $_POST['documentdescription'];


$lid = $_POST['adid'];

require_once( ABSPATH . 'wp-admin/includes/image.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once( ABSPATH . 'wp-admin/includes/media.php' );


if($lid == '')
{
$postid = wp_insert_post(array (
   'post_type' => 'additional-documents',
   'post_title' => $documentname,
   'post_status' => 'publish',
   'meta_input' => array(
      'document_type' => $documenttype,
      'document_name' => $documentname,
      'document_description' => $documentdescription,

      
    ),
));
$files = $_FILES["upload_file"];

if($files)
{
	$result = [];
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

  	 $Ids = implode(",", $result);
	 $savedAttach = get_post_meta($postid, 'document_attachment_id', true);	    
	 //echo $savedAttach;
	 if($savedAttach){
			$new_val = $Ids.','.$savedAttach;
			update_post_meta($postid, 'document_attachment_id', $new_val); 
	 }
	 else
	 {
     	update_post_meta($postid, 'document_attachment_id', $Ids);   
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
	$url = get_site_url().'/profile';
	wp_redirect( $url );
	exit;
}
else
{
$postid = $lid;
$my_post = array(
  'ID'           => $postid,
  'post_title'   => $documentname,
	);
	wp_update_post( $my_post );
	update_post_meta($lid, 'document_type', $documenttype);
	update_post_meta($lid, 'document_description', $documentdescription);
	update_post_meta($lid, 'document_name', $documentname);
	$files = $_FILES["upload_file"];
	
if($files)
{
	$result = [];
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

  	 $Ids = implode(",", $result);
	 $savedAttach = get_post_meta($postid, 'document_attachment_id', true);	    
	 //echo $savedAttach;
	 if($savedAttach){
			$new_val = $Ids.','.$savedAttach;
			update_post_meta($postid, 'document_attachment_id', $new_val); 
	 }
	 else
	 {
     	update_post_meta($postid, 'document_attachment_id', $Ids);   
	 }
}
echo "<script> 
Swal.fire({
	title: 'success!',
	text: 'Your data has been updated!',
	icon: 'success',
	showConfirmButton: true,
	allowOutsideClick: true,
	allowEscapeKey: false,
	confirmButtonColor: '#40BFB9',
	});
</script>";
$url = get_site_url().'/profile';
wp_redirect( $url );
exit;


}


}


?>

<script>
	// jQuery("#documentform").on('submit', function() {
	// 	setTimeout(function(){
	// 		window.location.reload();
	// 		}, 3500);
		
	// });
	// jQuery(document).ready(function(){
	// 	setTimeout(function(){
	// 	if( localStorage.getItem("file_submitted") ){
	// 		localStorage.removeItem("file_submitted");
	// 		setTimeout(function(){
	// 			location.reload();
	// 		}, 1000);
	// 	}
	// 	}, 1000);
	// });
	
	
</script>
<?php
get_footer('dashboard');
}else{
	header('Location: ' . get_permalink(1310));
}
?>

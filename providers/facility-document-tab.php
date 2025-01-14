<?php
/*
Template Name: Add Important Document
*/
get_header('dashboard');
echo get_template_part( 'template-headers/sidebar-dashboard' );
if(!is_user_logged_in())
{
    wp_redirect(get_site_url());
  exit;
}
$user_id = get_current_user_id();
if($_GET['fid'])
{
?>
<div class="content profile_content">
    <div class="container pt-5 ps-5 pe-5 pb-1">
        <div class="row">
	<h2 class="facilityTitle">Add Document <span><a href="<?php echo get_the_permalink($_GET['fid']); ?>">View All</a></span></h2>
	<form name="documentform" id="documentform" method="post" enctype="multipart/form-data" autocomplete="off">
            <section class="filedset licensesforms">
		 		<div class="row">
		 			<div class="col-md-12 col-lg-12 col-12">
		 				<div class="form-group">
		 					<label for="document_name_id">Document Name*</label>
		 					<input type="text" class="document_name_cl" id="document_name_id" name="documentname" required>
		 					
		 				</div>
		 				<div class="form-group">
		 					<label for="document_description_id">Description (Optional)</label>
		 					<textarea name="documentdescription" id="document_description_id" maxlength="500" data-bs-length="500"></textarea>
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
if(isset($_POST['documentSubmit']))
{

$documentname = $_POST['documentname'];
$documentdescription = $_POST['documentdescription'];

require_once( ABSPATH . 'wp-admin/includes/image.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once( ABSPATH . 'wp-admin/includes/media.php' );


$postid = wp_insert_post(array (
   'post_type' => 'facility-document',
   'post_title' => $documentname,
   'post_status' => 'publish',
   'meta_input' => array(
      'document_description' => $documentdescription, 
      'parentFacility' => $_GET['fid'],     
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
		text: 'Document saved successfully!',
		icon: 'success',
		showConfirmButton: true,
		allowOutsideClick: true,
		allowEscapeKey: false,
		confirmButtonColor: '#40BFB9',
		});
	</script>";
	exit;

}
?>
<?php } ?>

<?php 
get_footer('dashboard');
?>			
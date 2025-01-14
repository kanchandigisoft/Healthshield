<?php
/*
* Template Name: Skills Checklists
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

$post_id  = $_GET['checkid'];
$attach_new = $_GET['attch'];
$completed = get_field('completed_date',$post_id );
$specciality = get_field_object('checklists_specialty', $post_id);
$value2 = $specciality['value'];

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

		<form name="checklistsform" id="checklistsform" method="post" enctype="multipart/form-data" autocomplete="off">
			<input type="hidden" id="checkid" name="checkid" value="<?php echo $post_id; ?>">
   
           <section class="filedset licensesforms mb-3">
		 		<div class="row">
		 			<div class="col-md-12 col-lg-12 col-12">
		 				<div class="form-group">
		 					<label for="Specialty_id">Specialty</label>
		 					<select class="Specialtyid" id="Specialty_id" name="skillspectalty" <?php if($attach_new){}else{echo 'required';} ?>>
										<option value=""></option>
										<option <?php if($value2 == 'Acute Care Surgery'){ echo 'selected';}?> value="Acute Care Surgery">Acute Care Surgery</option>
										<option <?php if($value2 == 'Administration/Management'){ echo 'selected';}?> value="Administration/Management">Administration/Management</option>
										<option <?php if($value2 == 'Assisted Living Facility'){ echo 'selected';}?> value="Assisted Living Facility">Assisted Living Facility</option>
										<option <?php if($value2 == 'Audiology'){ echo 'selected';}?> value="Audiology">Audiology</option>
										<option <?php if($value2 == 'Behavioral Health'){ echo 'selected';}?> value="Behavioral Health">Behavioral Health</option>
										<option <?php if($value2 == 'Cardiovascular Intensive Care Unit'){ echo 'selected';}?> value="Cardiovascular Intensive Care Unit">Cardiovascular Intensive Care Unit</option>
										<option <?php if($value2 == 'Education'){ echo 'selected';}?> value="Education">Education</option>
									</select>
		 					
		 				</div>
		 			</div>
		 			
	 				<div class="form-group">
	 					<label for="complete_date_id">Comeplete Date</label>
	 					<input type="text" name="completeDate" autocapitalize="characters" id="complete_date_id" 
	 					value="<?php if($completed){echo $completed; } ?>" class="complete_date_id" <?php if($attach_new){}else{echo 'required';} ?>>			 					
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
					$imgs = get_post_meta($post_id,'skills_attachment_id',true);
					$meta = explode(',', $imgs);
					$i = 0;

					foreach ($meta as $metas) {

					$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
					//$count = count($metas);
					if($attch_name){
					$loopattach = '<input id="skills_attachments_'.$i.'_id" name="upload_file['.$i.'][id]" type="hidden" value="'.$metas.'">
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
				<button class="btn btn-primary submitFormProfile" name="checklistsSubmit" id="checklistsSubmit" type="submit">Save Changes</button>
				<a class="btn btn-cancel" href="<?php echo get_site_url(); ?>/profile#skillChecklists">Cancel</a>
			</div>
			
		</form>


	</div>
</div>
</div>


<?php 
if(isset($_POST['checklistsSubmit'])){

$skillspectalty = $_POST['skillspectalty'];
$completeDate = $_POST['completeDate'];



$lid = $_POST['checkid'];

require_once( ABSPATH . 'wp-admin/includes/image.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once( ABSPATH . 'wp-admin/includes/media.php' );
$result = array();

if($lid == '')
{
$postid = wp_insert_post(array (
   'post_type' => 'skills-checklists',
   'post_title' => $skillspectalty,
   'post_status' => 'publish',
   'meta_input' => array(
      'checklists_specialty' => $skillspectalty,
      'completed_date' => $completeDate,
  
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
	 $savedAttach = get_post_meta($postid, 'skills_attachment_id', true);	    
	 //echo $savedAttach;
	 if($savedAttach){
			$new_val = $Ids.','.$savedAttach;
			update_post_meta($postid, 'skills_attachment_id', $new_val); 
	 }
	 else
	 {
     	update_post_meta($postid, 'skills_attachment_id', $Ids);   
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
$postid = $lid;
$my_post = array(
  'ID'           => $postid,
  'post_title'   => $skillspectalty,
	);
	wp_update_post( $my_post );
	update_post_meta($lid, 'checklists_specialty', $skillspectalty);
	update_post_meta($lid, 'completed_date', $completeDate);
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
	 $savedAttach = get_post_meta($postid, 'skills_attachment_id', true);	    
	 //echo $savedAttach;
	 if($savedAttach){
			$new_val = $Ids.','.$savedAttach;
			update_post_meta($postid, 'skills_attachment_id', $new_val); 
	 }
	 else
	 {
     	update_post_meta($postid, 'skills_attachment_id', $Ids);   
	 }
}
$url = get_site_url().'/profile#skillChecklists';
wp_redirect( $url );
exit;
}




}

?>

<?php
get_footer('dashboard');
?>

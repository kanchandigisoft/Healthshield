<?php
if(is_user_logged_in()){
/*
* Template Name: Education
*/
get_header('dashboard');
ob_start();
echo get_template_part( 'template-headers/sidebar-dashboard' );

$post_id = $_GET['eid'];
$attach = $_GET['attach'];

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

$degreetype = get_field('degree_type',$post_id );
$degreename = get_field('name_of_the_degree',$post_id );
$schoolName = get_field('name_of_school',$post_id );
$degreeaddress = get_field('address_of_school',$post_id );
$degreesub = get_field('add_subject',$post_id );
$started_month = get_field('started_month',$post_id );
$started_year = get_field('started_year',$post_id );
$enddate_month = get_field('graduation_month',$post_id );
$enddate_year = get_field('graduation_year',$post_id );
$enrolled = get_field('currently_enrolled',$post_id );

if($enrolled == 1){
$val_enrolled = 'Yes';
}else{
$val_enrolled = 'No';
}
if($attach == 'attachments'){
	echo '<style>form .educationforms{display:none;}</style>';	
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
<div class="content licenses_content fgfcg">
<div class="container pt-5 ps-5 pe-5 pb-1">
	<div class="row">

		<form name="educationform" id="educationform" method="post" enctype="multipart/form-data" autocomplete="off">
			<input type="hidden" id="eid" name="eid" value="<?php echo $post_id; ?>">
   
           <section class="filedset educationforms mb-3">
		 		<div class="row">
		 			<div class="col-md-6 col-lg-6 col-12">
		 				<div class="form-group">
		 					<label for="degree_type_id">DEGREE TYPE</label>
		 					<select name="degreetype" id="degree_type_id" class="DegreeType" <?php if($attach == 'attachments'){}else{ echo 'required'; } ?> >
		 						<option value=""></option>
		 						
		 							<option <?php if($degreetype == 'High School Diploma'){echo 'selected';} ?> value="High School Diploma">High School Diploma</option>
		 							<option <?php if($degreetype == 'Certificate Program'){echo 'selected';} ?> value="Certificate Program">Certificate Program</option>
		 							<option <?php if($degreetype == "Associate's"){echo 'selected';} ?> value="Associate's">Associate's</option>
		 							<option <?php if($degreetype == "Bachelor's"){echo 'selected';} ?> value="Bachelor's">Bachelor's</option>
		 							<option <?php if($degreetype == "Master's"){echo 'selected';} ?> value="Master's">Master's</option>		 						
		 							<option <?php if($degreetype == 'Doctorate'){echo 'selected';} ?> value="Doctorate">Doctorate</option>	
		 							<option <?php if($degreetype == 'Fellowship'){echo 'selected';} ?> value="Fellowship">Fellowship</option>	 						
		 					</select>
		 					
		 				</div>
		 			</div>
		 			<div class="col-md-6 col-lg-6 col-12">
		 				<div class="form-group">
		 					<label for="degree_name_id">Degree Earned</label>
		 					<input type="text" name="degreename" autocapitalize="characters" id="degree_name_id" value="<?php if($degreename){echo $degreename;} ?>" >			 					
		 				</div>
		 			</div>			
		 		</div>
				<div class="row">
		 			<div class="col-md-6 col-lg-6 col-12">
		 				<div class="form-group">
		 					<label for="degree_subject_id">Subject</label>
		 					<input type="text" name="degreesub" autocapitalize="characters" id="degree_subject_id" value="<?php if($degreesub){echo $degreesub;} ?>">			 					
		 				</div>
		 			</div>
		 			<div class="col-md-6 col-lg-6 col-12">
					    <div class="form-group">
							<label for="name_of_school_id">NAME OF SCHOOL</label>
							<input type="text" value="<?php if($schoolName){echo $schoolName;} ?>" name="nameofschool" id="name_of_school_id" class="NameOfSchool" <?php if($attach == 'attachments'){}else{ echo 'required'; } ?>>
						</div>	
		 			</div>			
		 		</div>
				<div class="row">
		 			<div class="col-md-12 col-lg-12 col-12">
					    <div class="form-group">
		 					<label for="degree_address_id">School Address</label>
		 					<input type="text" name="degreeaddress" autocapitalize="characters" id="degree_address_id" value="<?php if($degreeaddress){echo $degreeaddress;} ?>" <?php if($attach == 'attachments'){}else{ echo 'required'; } ?>>			 					
		 				</div>		
		 			</div>
		 		</div>
				
		 		
		 		<div class="row">
		 			<div class="col-md-6 col-lg-6">
		 			<div class="form-group">
		 				<label for="started_month_year">Started (Optional)</label>
		 				<div class="row">
		 					<div class="col-md-6 col-lg-6">
		 						<select name="startedmonth" id="started_month_year" class="started_month">
		 							<option value="">Month</option>
		 							<?php 

									for($m=1; $m<=12; ++$m){

									    $monthsdate = date('F', mktime(0, 0, 0, $m, 1));
									    	if( $monthsdate == $started_month){
									    		$selected = 'selected';
									    	}else{
									    		$selected = '';
									    	}
									    echo '<option '.$selected.' value="'.$monthsdate.'">'.$monthsdate.'</option>';
									}

		 							?>
		 							
		 						</select>
		 					</div>
		 					<div class="col-md-6 col-lg-6">
		 						<select name="startedyear" id="started_month_year" class="started_year">
		 							<option value="">Year</option>
		 							<?php 
										$year = date('Y');
										$min = $year - 52;
										$max = $year + 8;;
										for( $i=$max; $i>=$min; $i-- ) {
											if($i == $started_year){
												$selected = 'selected';
											}else{
												$selected = '';
											}
										echo '<option '.$selected.' value='.$i.'>'.$i.'</option>';
										}
		 							?>
		 						</select>
		 					</div>
		 				</div>
		 			</div>
		 			</div>
		 			<div class="col-md-6 col-lg-6">
		 			<div class="form-group">	
		 				<label for="graduation_month_year">End (Or Expected End Date)</label>
		 				<div class="row">
		 					<div class="col-md-6 col-lg-6">
		 						<select name="graduationmonth" id="graduation_month_year" class="graduation_month">
		 							<option value="">Month</option>
		 							<?php 
									for($m=1; $m<=12; ++$m){
									    $monthsdate = date('F', mktime(0, 0, 0, $m, 1));
									    if($monthsdate == $enddate_month){
									    	$selected = 'selected';
									    }else{
									    	$selected = '';
									    }
									    echo '<option '.$selected.' value="'.$monthsdate.'">'.$monthsdate.'</option>';
									}

		 							?>
		 						</select>
		 					</div>
		 					<div class="col-md-6 col-lg-6">
		 						<select name="graduationyear" id="graduation_month_year" class="graduation_year">
		 							<option value="">Year</option>
		 							<?php 
										$year = date('Y');
										$min = $year - 52;
										$max = $year + 8;
										for( $i=$max; $i>=$min; $i-- ) {
											if($i == $enddate_year){
									    	$selected = 'selected';
									    	}else{
									    		$selected = '';
									    	}
										echo '<option '.$selected.' value='.$i.'>'.$i.'</option>';
										}
		 							?>
		 						</select>

		 						
		 					</div>
		 				</div>
		 			</div>
		 			<div class="form-group">
	 				    <div class="custom-control custom-checkbox">
							<input class="custom-control-input" id="degree_currently_enrolled" name="degreecurrentlyenrolled" type="checkbox" value="<?php echo $val_enrolled;?>" <?php if($val_enrolled == 'Yes'){echo'checked';} ?>>
							<label class="custom-control-label" for="degree_currently_enrolled">I am currently enrolled</label>
						</div>

							<small class="error d-none">Graduation date is in the past, but you selected "I am currently enrolled"</small>

		 			</div>
		 		</div>
		 	</div>
		 	</section>
		 	<section class="filedset attachemnts mb-2">
				
		 		<div class="row">
		 			<div class="col-12 col-md-12 col-lg-12">
					<div class="row mb-3">
						<div class="col-lg-10">
							<h5 class="mt-0">Upload Diploma, Certificate, or Fellowship Document</h5>
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
					$imgs = get_post_meta($post_id,'education_attachment_id',true);
					$meta = explode(',', $imgs);
					$i = 0;

					foreach ($meta as $metas) {

					$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
					//$count = count($metas);
					if($attch_name){
					$loopattach = '<input id="education_attachment_'.$i.'_id" name="upload_file['.$i.'][id]" type="hidden" value="'.$metas.'">
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
				<button class="btn btn-primary submitFormProfil" name="educationSubmit" id="educationSubmit" type="submit">Save Changes</button>
				<a class="btn btn-cancel" href="<?php echo get_site_url(); ?>/profile#education">Cancel</a>
			</div>		
		</form>
	</div>
</div>
</div>


<?php 
if(isset($_POST['educationSubmit'])){

	$eid = $_POST['eid'];
	$degree_type = $_POST['degreetype'];
	$degreename = $_POST['degreename'];
	$degreeaddress = $_POST['degreeaddress'];
	$degreesub = $_POST['degreesub'];
	$nameofschool = $_POST['nameofschool'];
	$startedmonth = $_POST['startedmonth'];
	$startedyear = $_POST['startedyear'];
	$graduationmonth = $_POST['graduationmonth'];
	$graduationyear = $_POST['graduationyear'];
	$degreecurrentlyenrolled = $_POST['degreecurrentlyenrolled'];
	
	if($degreecurrentlyenrolled == 'Yes'){
		$degreecurrentlyenrolled = 1;
	}else{
		$degreecurrentlyenrolled = 0;
	}
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );
	$result = array();

		
		if($eid == '')
		{

			$postid = wp_insert_post(array (
			'post_type' => 'education',
			'post_title' => $degreename,
			'post_status' => 'publish',
			'meta_input' => array(
					'degree_type' => $degree_type,
					'name_of_the_degree'	=>		$degreename ,
					'name_of_school'	=>		$nameofschool,
					'address_of_school'	=>		$degreeaddress,
					'add_subject'	=>		$degreesub,
					'started_month'	=>		$startedmonth,
					'started_year'	=>		$startedyear,
					'graduation_month'	=>		$graduationmonth,
					'graduation_year'	=>		$graduationyear,
					'currently_enrolled'	=>		$degreecurrentlyenrolled,

				
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
				$savedAttach = get_post_meta($postid, 'education_attachment_id', true);	    
				//echo $savedAttach;
				if($savedAttach){
						$new_val = $Ids.','.$savedAttach;
						update_post_meta($postid, 'education_attachment_id', $new_val); 
				}
				else
				{
					update_post_meta($postid, 'education_attachment_id', $Ids);   
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

			$postid = $eid;
			$my_post = array(
			'ID'           => $postid,
			'post_title'   => $certificatenumber,
				);
			wp_update_post( $my_post );
			update_post_meta($eid, 'degree_type', $degree_type);
			update_post_meta($eid,'name_of_the_degree',$degreename);
			update_post_meta($eid,'name_of_school',$nameofschool);
			update_post_meta($eid,'address_of_school',$degreeaddress);
			update_post_meta($eid,'add_subject',$degreesub);
			update_post_meta($eid,'started_month',$startedmonth);
			update_post_meta($eid,'started_year',$startedyear);
			update_post_meta($eid,'graduation_month',$graduationmonth);
			update_post_meta($eid,'graduation_year',$graduationyear);
			update_post_meta($eid,'currently_enrolled',$degreecurrentlyenrolled);

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
				$savedAttach = get_post_meta($postid, 'education_attachment_id', true);	    
				//echo $savedAttach;
				if($savedAttach){
						$new_val = $Ids.','.$savedAttach;
						update_post_meta($postid, 'education_attachment_id', $new_val); 
				}
				else
				{
					update_post_meta($postid, 'education_attachment_id', $Ids);   
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

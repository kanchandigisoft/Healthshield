<?php
/*
Template Name: Add contract
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
	<h2 class="facilityTitle">Add Contract <span><a href="<?php echo get_the_permalink($_GET['fid']); ?>">View All</a></span></h2>
	<form name="contractform" id="contractform" method="post" enctype="multipart/form-data" autocomplete="off">
					<div class="row">

					<div class="row">
		 			<div class="col-md-12 col-lg-12 col-12">
		 				<div class="form-group">
		 					<label for="contractName">Contract Name*</label>
		 					<input type="text" name="contractName" autocapitalize="characters" id="contractName" value="" required>	
		 				</div>
		 			</div>		
		 			</div>

		 			<div class="col-md-6 col-lg-6 col-12">
		 				<div class="form-group">
		 					<label for="contractStartDate">Start Date*</label>
		 					<input class="userdatePicker" type="text" name="contractStartDate" autocapitalize="characters" id="contractStartDate" value="" required>	
		 				</div>
		 			</div>
		 			<div class="col-md-6 col-lg-6 col-12">
		 				<div class="form-group">
		 					<label for="contractEndDate">End Date*</label>
		 					<input class="userdatePicker" type="text" name="contractEndDate" autocapitalize="characters" id="contractEndDate" value="" required>			 					
		 				</div>
		 			</div>			
		 		</div>
		 		<div class="row">
		 			<div class="col-md-6 col-lg-6 col-12">
		 				<div class="form-group">
		 					<label for="contractAgreed">Agreed Upon Rate($)*</label>
		 					<input type="text" name="contractAgreed" autocapitalize="characters" id="contractAgreed" value="" required>	
		 				</div>
		 			</div>
		 			<div class="col-md-6 col-lg-6 col-12">
		 				<div class="form-group">
		 					<label for="serviceProvided">Services Provided*</label>
		 					<input type="text" name="serviceProvided" autocapitalize="characters" id="serviceProvided" value="" required>			 					
		 				</div>
		 			</div>			
		 		</div>
		 		<div class="row">
		 			<div class="col-md-12 col-lg-12 col-12">
		 				<div class="form-group">
		 					<label for="generalNote">General Notes*</label>
		 					<input type="text" name="generalNote" autocapitalize="characters" id="generalNote" value="" required>	
		 				</div>
		 			</div>		
		 		</div>
		 		<div class="row">
		 			<div class="col-md-12 col-lg-12 col-12">
		 				<div class="form-group">
		 					<input type="submit" name="saveContract" autocapitalize="characters" id="saveContract" value="Save Contract">	
		 				</div>
		 			</div>		
		 		</div>
			</form>
		</div>
	</div>
</div>

<?php
}
else
{
	wp_redirect(get_site_url().'/profile/facilities/');
}
if(isset($_POST['saveContract']))
{

				global $post, $wpdb;

				$contractName = $_POST['contractName'];
				$contractStartDate = $_POST['contractStartDate'];
				$contractEndDate = $_POST['contractEndDate'];
				$contractAgreed = $_POST['contractAgreed'];
				$serviceProvided = $_POST['serviceProvided'];
				$generalNote = $_POST['generalNote'];
				$postid = wp_insert_post(array (
					   'post_type' => 'facility-contract',
					   'post_title' => $contractName,
					   'post_status' => 'publish',
					   'meta_input' => array(
					      'contract_start_date' => $contractStartDate,
					      'contract_end_date' => $contractEndDate,
					      'agreed_rate' => $contractAgreed,
					      'services_provided' => $serviceProvided,
					      'general_note' => $generalNote,
					      'parentFacility' => $_GET['fid'],
					      
					    ),
				));


				if(!is_wp_error($post_id)){
				  echo "<script> 
					Swal.fire({
						title: 'success!',
						text: 'Contract saved successfully',
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

				exit;

}

			
?>
<?php 
get_footer('dashboard');
?>			
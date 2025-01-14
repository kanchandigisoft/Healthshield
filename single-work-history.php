<?php 
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */
get_header('dashboard');
echo get_template_part( 'template-headers/sidebar-dashboard' );

$User_Id = get_current_user_id();
$args = array(  
    'post_type' => 'work-history',
    'post_status' => 'publish',
    'author' => $User_Id,
);

$loop = new WP_Query( $args ); 
 if ( have_posts() ){  

    $faclityname = get_field('facility_name');
    $spanddept = get_field('work_specialty_department');
    $workcity = get_field('work_city');
    $workstate = get_field('work_state');
    $workprofession = get_field('work_profession');
    $workstartedM = get_field('work_started_on_month');
    $workstrtedY = get_field('work_started_on_year');
    $workendM = get_field('work_ended_on_month');
    $workendY = get_field('work_ended_on_year');
    $currentywork = get_field('work_currently_here');
    $faciltytype = get_field('work_type_Ag_fc');
    $emplymenttype = get_field('work_employment_type');
    $additioncomments = get_field('additional_notes_and_comments');
    $staffingagency = get_field('work_staffing_agency');
    $workaddress = get_field('work_address');
    $workzipcode = get_field('work_zip_code');
    $contactname = get_field('contact_name');
    $contactemail = get_field('contact_email');
    $contactphnno = get_field('phone_number');
    $contactfaxno = get_field('fax_number');
	$op_facility = get_field('op_facility');
	$op_address = get_field('op_address');

     $postId = get_the_ID();
     $post_slug = $post->post_name;	

?>
<div class="content profile_content">
    <div class="container pt-5 ps-5 pe-5 pb-1">
        <div class="row">
            <div class="rows_lists d-flex">
											
											<span class="row-icon me-2">
												<i class="fal fa-clipboard-check" title="Everything is OK"></i>
											</span>
																	
											<div class="flex-grow-1">
												<div class="row">
													<div class="col-12 col-md-6">
														<div class="font-heavyweight">
															<h6>
															<?php
															echo get_the_title(); 
															?>	
															</h6>
														</div>

														<div class="profession">
														<b>Work Profession:</b> <?php echo $workprofession; ?>
														</div>

														<div class="Contact_detials">
															<div class="contact_name">
															<b>Conatct Person Name:</b> <?php echo $contactname; ?>
															</div>
															<div class="contact_email">
															<b>Conatct Email:</b> <?php echo $contactemail; ?>
															</div>
															<div class="phn_number">
															<b>Conatct Phone Number:</b> <?php echo $contactphnno; ?>
															</div>
															<div class="fax_number">
															<b>Conatct Fax number:</b> <?php echo $contactfaxno; ?>
															</div>
														</div>

														<div class="location">
															<?php echo $workaddress;?>, <?php echo $workcity; ?>, <?php echo $workstate; ?>, <?php echo $workzipcode; ?>
														</div>

														<div class="department-name">
															<b>Department:</b> <?php echo $spanddept; ?>
														</div>

														<div class="employed-by">
															<b>Employed By:</b>
															<?php if($faciltytype == 'Facility'){ ?>
															<?php echo $faciltytype; ?>
															<?php }else if($faciltytype == 'Agency'){ ?>
															<?php echo $faciltytype; ?>
															<?php }else if($faciltytype == 'Anesthesia Group'){
																echo $faciltytype;
															} ?>

														</div>

														<div class="employment-type">
															<b>Employment Type:</b> <?php echo $emplymenttype; ?>
														</div>
														<div>
															<strong class="font-heavyweight date-range">
																<?php echo $workstartedM.' '.$workstrtedY; ?> — <?php if($currentywork == 1){echo 'Present';}else{ echo $workendM.' '.$workendY;  } ?>
															</strong>
														</div>

													</div>
														<div class="col-12 col-md-6">
																	<h6>Additional Information</h6>

																	<div class="op_facility">
																	<b>Facility:</b> <?php echo $op_facility; ?>
																	</div>


																	<div class="op_address">
																	<b>Address:</b> <?php echo $op_address; ?>
																	</div>

																
															<?php 
															$facaddCount = get_post_meta($postId,'fac_address_count',true);
															for($i=1; $i<=$facaddCount; $i++){
																$fac = get_post_meta($postId, 'opfacility_'.$i, true);
																$addressnew = get_post_meta($postId, 'opaddress_'.$i, true);
																
																?>																	
																	<div class="op_facility">
																		<b>Facility <?php echo $i; ?>:</b> <?php echo $fac; ?>
																	</div>


																	<div class="op_address">
																		<b>Address <?php echo $i; ?>:</b> <?php echo $addressnew; ?>
																	</div>															
															<?php	
																}
															?>
														</div>
													
												</div>

												<div class="row my-3">
													<div class="col-12">
														<em class="employment-type d-block text-muted">
														<b>Comments:</b> <?php echo $additioncomments; ?>
														</em>
													</div>
												</div> 

											</div>
										</div>

        <?php
		}	   
		    wp_reset_postdata(); 
		?>
		</div>
	</div>
</div>
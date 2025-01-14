<?php 
if(is_user_logged_in()){
/*
* Template Name: Work History
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

$role = $current_user->roles;

$whid = $_GET['whid'];

$faclityname = get_field('facility_name',$whid);
$spanddept = get_field('work_specialty_department',$whid);
$workcity = get_field('work_city',$whid);
$workaddress = get_field('work_address',$whid);
$workzipcode = get_field('work_zip_code',$whid);
$workstate = get_field('work_state',$whid);
$workprofession = get_field('work_profession',$whid);
$workstartedM = get_field('work_started_on_month',$whid);
$workstartedY = get_field('work_started_on_year',$whid);
$workendM = get_field('work_ended_on_month',$whid);
$workendY = get_field('work_ended_on_year',$whid);
$currentywork = get_field('work_currently_here',$whid);
$faciltytype = get_field('work_type_Ag_fc',$whid);
$emplymenttype = get_field('work_employment_type',$whid);
$additioncomments = get_field('additional_notes_and_comments',$whid);
$staffingagency = get_field('work_staffing_agency',$whid);
$contactname = get_field('contact_name',$whid);
$contactemail = get_field('contact_email',$whid);
$contactphnno = get_field('phone_number',$whid);
$contactfaxno = get_field('fax_number',$whid);
$op_facility = get_field('op_facility',$whid);
$op_address = get_field('op_address',$whid);

if($currentywork == 1){
$currentywork = 'true';
}else{
$currentywork = 'false';
}

if($chargeexp == 1){
$chargeexp = 'true';
}else{
$chargeexp = 'false';
}

if($techhospital == 1){
$techhospital = 'true';
}else{
$techhospital = 'false';
}

if($critcalacess == 1){
$critcalacess = 'true';
}else{
$critcalacess = 'false';
}
$facaddCount = get_post_meta($whid,'fac_address_count',true);
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
			<form id="new_work_history_form" class="new_work_history_form" method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" value="<?php echo $whid; ?>" name="whid" id="$whid">
				<input type="hidden" value="<?php if($facaddCount){ echo $facaddCount; }else{ echo '0'; } ?>" name="countfcaddress" id="countfcaddress">
			   <h4 class="form-heading">
			      Core Information
			   </h4>
			   <div class="row">
			      <div class="col-12 col-md-6">
			         <div class="form-group">
			            <label for="work_history_facility_id">Facility or Group Name</label>
						<input class=" autocomplete" id="work_history_facility_id" name="work_history_facility_id" spellcheck="false" type="text" value="<?php if($faclityname){echo get_the_title($whid);} ?>" required>	
			        	</div>
			         </div>
			      <div class="col-12 col-md-6">
			         <div class="form-group">
			            <label for="work_department_id">Specialty/Department</label>
			           <input id="work_department_id" name="work_department_id" type="text" value="<?php if($spanddept){echo $spanddept;} ?>">			               
			         </div>
			      </div>
			   </div>
			   <div class="row">
			   <div class="col-12 col-md-3">
			         <div class="form-group">
			            <label for="work_address">Address</label>
			            <input autocomplete="address-level3" class="" id="work_address" name="work_address" type="text" value="<?php if($workaddress){echo $workaddress;} ?>" required>
			         </div>
			      </div>
			      <div class="col-12 col-md-3">
			         <div class="form-group">
			            <label for="work_city">City</label>
			            <input autocomplete="address-level2" class="" id="work_city" name="work_city" type="text" value="<?php if($workcity){echo $workcity;} ?>" required>
			         </div>
			      </div>				  
			      <div class="col-12 col-md-3">
			         <div class="form-group">
			            <label for="work_history_province_id">State</label>
			            <div class="select-wrapper flex-grow-1 ">
			               <select autocomplete="address-level1" class="" id="work_history_province_id" name="work_history_province_id" required="">
			                <option value=""></option>
			                <option <?php if($workstate =='Alabama'){echo 'selected';} ?> value="Alabama">Alabama</option>
							<option <?php if($workstate =='Alaska'){echo 'selected';} ?> value="Alaska">Alaska</option>
							<option <?php if($workstate =='Arizona'){echo 'selected';} ?> value="Arizona">Arizona</option>
							<option <?php if($workstate =='American Samoa'){echo 'selected';} ?> value="American Samoa">American Samoa</option>
							<option <?php if($workstate =='Arkansas'){echo 'selected';} ?> value="Arkansas">Arkansas</option>
							<option <?php if($workstate =='California'){echo 'selected';} ?>value="California">California</option>
							<option <?php if($workstate =='Colorado'){echo 'selected';} ?> value="Colorado">Colorado</option>
							<option <?php if($workstate =='Connecticut'){echo 'selected';} ?> value="Connecticut">Connecticut</option>
							<option <?php if($workstate =='Delaware'){echo 'selected';} ?>  value="Delaware">Delaware</option>
							<option <?php if($workstate =='District Of Columbia'){echo 'selected';} ?>  value="District Of Columbia">District Of Columbia</option>
							<option <?php if($workstate =='Florida'){echo 'selected';} ?> value="Florida">Florida</option>
							<option <?php if($workstate =='Georgia'){echo 'selected';} ?> value="Georgia">Georgia</option>
							<option <?php if($workstate =='Guam'){echo 'selected';} ?> value="Guam">Guam</option>
							<option <?php if($workstate =='Hawaii'){echo 'selected';} ?> value="Hawaii">Hawaii</option>
							<option <?php if($workstate =='Idaho'){echo 'selected';} ?> value="Idaho">Idaho</option>
							<option <?php if($workstate =='Illinois'){echo 'selected';} ?> value="Illinois">Illinois</option>
							<option <?php if($workstate =='Indiana'){echo 'selected';} ?> value="Indiana">Indiana</option>
							<option <?php if($workstate =='Iowa'){echo 'selected';} ?> value="Iowa">Iowa</option>
							<option <?php if($workstate =='Kansas'){echo 'selected';} ?> value="Kansas">Kansas</option>
							<option <?php if($workstate =='Kentucky'){echo 'selected';} ?> value="Kentucky">Kentucky</option>
							<option <?php if($workstate =='Louisiana'){echo 'selected';} ?> value="Louisiana">Louisiana</option>
							<option <?php if($workstate =='Maine'){echo 'selected';} ?> value="Maine">Maine</option>
							<option <?php if($workstate =='Maryland'){echo 'selected';} ?> value="Maryland">Maryland</option>
							<option <?php if($workstate =='Massachusetts'){echo 'selected';} ?> value="Massachusetts">Massachusetts</option>
							<option <?php if($workstate =='Michigan'){echo 'selected';} ?> value="Michigan">Michigan</option>
							<option <?php if($workstate =='Minnesota'){echo 'selected';} ?> value="Minnesota">Minnesota</option>
							<option <?php if($workstate =='Mississippi'){echo 'selected';} ?> value="Mississippi">Mississippi</option>
							<option <?php if($workstate =='Missouri'){echo 'selected';} ?> value="Missouri">Missouri</option>
							<option <?php if($workstate =='Montana'){echo 'selected';} ?> value="Montana">Montana</option>
							<option <?php if($workstate =='Nebraska'){echo 'selected';} ?> value="Nebraska">Nebraska</option>
							<option <?php if($workstate =='Nevada'){echo 'selected';} ?> value="Nevada">Nevada</option>
							<option <?php if($workstate =='New Hampshire'){echo 'selected';} ?> value="New Hampshire">New Hampshire</option>
							<option <?php if($workstate =='New Jersey'){echo 'selected';} ?> value="New Jersey">New Jersey</option>
							<option <?php if($workstate =='New Mexico'){echo 'selected';} ?> value="New Mexico">New Mexico</option>
							<option <?php if($workstate =='New York'){echo 'selected';} ?> value="New York">New York</option>
							<option <?php if($workstate =='North Carolina'){echo 'selected';} ?> value="North Carolina">North Carolina</option>
							<option <?php if($workstate =='North Dakota'){echo 'selected';} ?> value="North Dakota">North Dakota</option>
							<option <?php if($workstate =='Northern Mariana Islands'){echo 'selected';} ?> value="Northern Mariana Islands">Northern Mariana Islands</option>
							<option <?php if($workstate =='Ohio'){echo 'selected';} ?> value="Ohio">Ohio</option>
							<option <?php if($workstate =='Oklahoma'){echo 'selected';} ?> value="Oklahoma">Oklahoma</option>
							<option <?php if($workstate =='Oregon'){echo 'selected';} ?> value="Oregon">Oregon</option>
							<option <?php if($workstate =='Pennsylvania'){echo 'selected';} ?> value="Pennsylvania">Pennsylvania</option>
							<option <?php if($workstate =='Puerto Rico'){echo 'selected';} ?> value="Puerto Rico">Puerto Rico</option>
							<option <?php if($workstate =='Rhode Island'){echo 'selected';} ?> value="Rhode Island">Rhode Island</option>
							<option <?php if($workstate =='South Carolina'){echo 'selected';} ?> value="South Carolina">South Carolina</option>
							<option <?php if($workstate =='South Dakota'){echo 'selected';} ?> value="South Dakota">South Dakota</option>
							<option <?php if($workstate =='Tennessee'){echo 'selected';} ?> value="Tennessee">Tennessee</option>
							<option <?php if($workstate =='Texas'){echo 'selected';} ?> value="Texas">Texas</option>
							<option <?php if($workstate =='United States Minor Outlying Islands'){echo 'selected';} ?> value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
							<option <?php if($workstate =='Utah'){echo 'selected';} ?> value="Utah">Utah</option>
							<option <?php if($workstate =='Vermont'){echo 'selected';} ?> value="Vermont">Vermont</option>
							<option <?php if($workstate =='Virgin Islands'){echo 'selected';} ?> value="Virgin Islands">Virgin Islands</option>
							<option <?php if($workstate =='Virginia'){echo 'selected';} ?> value="Virginia">Virginia</option>
							<option <?php if($workstate =='Washington'){echo 'selected';} ?> value="Washington">Washington</option>
							<option <?php if($workstate =='West Virginia'){echo 'selected';} ?> value="West Virginia">West Virginia</option>
							<option <?php if($workstate =='Wisconsin'){echo 'selected';} ?> value="Wisconsin">Wisconsin</option>
							<option <?php if($workstate =='Wyoming'){echo 'selected';} ?> value="Wyoming">Wyoming</option>
			               </select>
			            </div>
			         </div>
			      </div>
				  <div class="col-12 col-md-3">
			         <div class="form-group">
			            <label for="work_zip_code">Zip Code</label>
			            <input autocomplete="address-level4" class="" id="work_zip_code" name="work_zip_code" type="text" value="<?php if($workzipcode){echo $workzipcode;} ?>" required>
			         </div>
			      </div>
			   </div>
			   
			   <div class="row">
				   <div class="col-12 col-lg-6">
					   <div class="form-group">
						  <label for="work_history_contact_name">Contact Person Name</label>
						  <input type="text" id="work_history_contact_name" name="work_history_contact_name" value="<?php if($contactname){ echo $contactname;} ?>" >
					   </div>
				   </div>
				   <div class="col-12 col-lg-6">
					   <div class="form-group">
						  <label for="work_history_contact_email">Email</label>
						  <input type="text" id="work_history_contact_email" name="work_history_contact_email" value="<?php if($contactemail){ echo $contactemail;} ?>" >
					   </div>
				   </div>
				</div>
				<div class="row">
				   <div class="col-12 col-lg-6">
					   <div class="form-group">
						  <label for="work_history_phone_number">Phone Number</label>
						  <input type="text" oninput="process(this)" id="work_history_phone_number" name="work_history_phone_number" value="<?php if($contactphnno){ echo $contactphnno;} ?>" >
					   </div>
				   </div>
				   <div class="col-12 col-lg-6">
					   <div class="form-group">
						  <label for="work_history_fax_number">Fax Number</label>
						  <input type="text" id="work_history_fax_number" name="work_history_fax_number" value="<?php if($contactfaxno){ echo $contactfaxno;} ?>" >
					   </div>
				   </div>
			   </div>
			   <div class="form-group">
			      <label for="work_history_profession_id">Position</label>
			      <input type="text" id="work_history_profession_id" name="work_history_profession_id" value="<?php if($workprofession){ echo $workprofession;} ?>" >
			   </div>
			   <div class="row">
			      <div class="col-12 col-md-6">
				         	<div class="form-group row">
				         		<label for="work_history_started_on">Started</label>
				         		<div class="col-12 col-md-6">

						            <div class="select-wrapper date-select-wrapper">
						               <select class=" date-select month-select" id="work_history_started_on_month" name="work_started_on_month" required>
						                  <option value="">Month</option>
						                <?php 

										for($m=1; $m<=12; ++$m){

										    $monthsdate = date('F', mktime(0, 0, 0, $m, 1));
										    	if( $monthsdate == $workstartedM){
										    		$selected = 'selected';
										    	}else{
										    		$selected = '';
										    	}
										    echo '<option '.$selected.' value="'.$monthsdate.'">'.$monthsdate.'</option>';
										}

			 							?>
						               </select>
						            </div>
						        </div>
						        <div class="col-12 col-md-6">
						            <div class="select-wrapper date-select-wrapper">
						               <select class=" date-select month-select" id="work_history_started_on_year" name="work_started_on_year" required>
						                  <option value="">Year</option>
						                  <?php 
											$year = date('Y');
											$min = $year - 60;
											$max = $year;
											for( $i=$max; $i>=$min; $i-- ) {
												if($i == $workstartedY){
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
				    <div class="col-12 col-md-6">
				         <div class="form-group row">
				         	 <label for="work_history_ended_on">Ended</label>
				         	<div class="col-12 col-md-6">
					           
					            <div class="select-wrapper date-select-wrapper">
					               <select class=" date-select month-select" id="work_history_ended_on_month" name="work_ended_on_month">
					                  <option value="">Month</option>
										<?php 

										for($m=1; $m<=12; ++$m){

										    $monthsdate = date('F', mktime(0, 0, 0, $m, 1));
										    	if( $monthsdate == $workendM){
										    		$selected = 'selected';
										    	}else{
										    		$selected = '';
										    	}
										    echo '<option '.$selected.' value="'.$monthsdate.'">'.$monthsdate.'</option>';
										}

											?>
					               </select>
					            </div>
				        	</div>
					        <div class="col-12 col-md-6">
					            <div class="select-wrapper date-select-wrapper">
					               <select class=" date-select month-select" id="work_history_ended_on_year" name="work_ended_on_year">
					                  <option value="">Year</option>
					                   <?php 
												$year = date('Y');
												$min = $year - 60;
												$max = $year + 13;
												for( $i=$max; $i>=$min; $i-- ) {
													if($i == $workendY){
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
				               <input name="work_currently_work_here" type="hidden" value="false">
				               <input class="custom-control-input" id="work_history_currently_work_here" name="work_currently_work_here" type="checkbox" value="<?php echo $currentywork ?>" <?php if($currentywork == 'true'){echo 'checked';} ?>>
				               <label class="custom-control-label" for="work_history_currently_work_here">I currently work here</label>
				            </div>
				        </div>
				    </div>
			   </div>   
			      <div class="form-group">
			         <label>
			         I was/am employed:
			         </label>
			        <div class="form-group worktyperadio row">
			         	<div class="col-md-8 col-12">
			         		<div class="row">

			         			<div class="col-md-4">
						            <div class="custom-control custom-radio custom-control-inline">
						               <input class="custom-control-input" id="work_history_employer_type_Facility" name="work_employer_type" type="radio" value="Facility" <?php if($faciltytype == 'Facility'){echo 'checked';}else if($faciltytype == 'Agency'){echo '';}else{ echo 'checked';} ?>>
						               <label class="custom-control-label" for="work_history_employer_type_Facility">directly by the facility</label>
						            </div>
						        </div>  	
				        		<div class="col-md-4">
					        		<div class="custom-control custom-radio custom-control-inline" >
						               <input class="custom-control-input" id="work_history_employer_type_Agency" name="work_employer_type" type="radio" value="Agency" <?php if($faciltytype == 'Agency'){echo 'checked';}else{ echo '';} ?>>
						               <label class="custom-control-label" for="work_history_employer_type_Agency">by a staffing agency</label>
						            </div>
					            </div>
								<div class="col-md-4">
					        		<div class="custom-control custom-radio custom-control-inline" >
						               <input class="custom-control-input" id="work_history_employer_type_group" name="work_employer_type" type="radio" value="Anesthesia Group" <?php if($faciltytype == 'Anesthesia Group'){echo 'checked';}else{ echo '';} ?>>
						               <label class="custom-control-label" for="work_history_employer_type_group">By Anesthesia Group</label>
						            </div>
					            </div>
				        	</div>
				        </div>
			        	<div class="col-md-6 col-12"></div>

			        </div>
					<?php if($faciltytype == 'Agency'){
						echo '<style>.agencystaffinginput{display:block !important;}</style>';

					}else if($facilitytyp == 'Anesthesia Group'){
						echo '<style>.agencystaffinginput{display:none !important;}</style>';
					}?>
			        <div class="form-group agencystaffinginput">
			      	<label for="work_history_staffing_agency_id">Staffing agency</label>
			      	<input type="text" id="work_history_staffing_agency_id" name="work_history_staffing_agency_id" class="work_history_staffing_agency_id" value="<?php if($staffingagency){echo $staffingagency;} ?>">
			      	<small class="form-text text-muted">
			      		<a data-bs-toggle="modal" data-bs-target="#dont_see_my_staffing_agency_modal" href="#">Don't see your staffing agency?</a>
			      	</small>
			      </div>
			      </div>
			     
			   <div class="form-group">
			      <label for="work_history_employment_type">Employment Type</label>
			      <div class="select-wrapper flex-grow-1 ">
			         <select class="" id="work_history_employment_type" name="work_employment_type" required>
			            <option value=""></option>
			            <option <?php if($emplymenttype == 'Full Time'){ echo 'selected';} ?> value="Full Time">Full Time</option>
			            <option <?php if($emplymenttype == 'Part Time'){ echo 'selected';} ?> value="Part Time">Part Time</option>
			            <option <?php if($emplymenttype == 'Travel Contract'){ echo 'selected';} ?> value="Travel Contract">Travel Contract</option>
			            <option <?php if($emplymenttype == 'Per Diem'){ echo 'selected';} ?> value="Per Diem">Per Diem</option>
			         </select>       
			      </div>
			   </div>
			   <div class="optional-fields-card card mb-4">
			      <div class="card-header expanding-card-header">
					<div class="row">
						<div class="col-sm-8">
							<h5 class="mb-0 kamana-green-text" id="expandaddtional"  role="button" data-bs-toggle="collapse" data-bs-target="#optional_fields">
								<i class="fad fa-fw fa-expand-arrows-alt"></i> Additional Information
								<small class="text-muted ml-3">
								(Tap to Expand)
								</small>
							</h5>
						</div>
						<div class="col-sm-4 text-end">
							<a id="add_facaddress" href="#" class="btn btn-floating healthshiled-new" title="Add more Address and facility" data-type="workHistory">
								<i class="fal fa-plus"></i>
							</a>
						</div>
					</div>
			      </div>
			      <div id="optional_fields" class="collapse">
			         <div class="card-body">
						<div class="row fac-address">
							<div class="col-md-6">
								<div class="form-group">
									<label for="op_facility_id">Facility</label>
									<input type="text" name="op_facility_name_0" id="op_facility_id" value="<?php if($op_facility){ echo $op_facility; }else{ } ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="op_address_id">Address</label>
									<textarea class="character-counter" data-length="200" id="op_address_id" maxlength="200" name="op_address_name_0"><?php if($op_address){ echo $op_address; }else{ } ?></textarea>
								</div>
							</div>
						</div>
						
						<div class="address_facility_new">
							<?php
							if($whid){
								$facaddCount = get_post_meta($whid,'fac_address_count',true);
								for($i=1; $i<=$facaddCount; $i++){
									$fac = get_post_meta($whid, 'opfacility_'.$i, true);
									$addressnew = get_post_meta($whid, 'opaddress_'.$i, true);
									?>
									<div class="row fac-address<?php echo $i; ?>">
										<div class="col-md-6">
											<div class="form-group">
												<label for="op_facility_id_<?php echo $i; ?>">Facility <?php echo $i; ?></label>
												<input type="text" name="op_facility_name_<?php echo $i; ?>" id="op_facility_id_<?php echo $i; ?>" value="<?php if($fac){ echo $fac; }else{ } ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="op_address_id_<?php echo $i; ?>">Address <?php echo $i; ?></label>
												<textarea class="character-counter" data-length="200" id="op_address_id_<?php echo $i; ?>" maxlength="200" name="op_address_name_<?php echo $i; ?>"><?php if($addressnew){echo $addressnew;}else{} ?></textarea>
											</div>
										</div>
									</div>
									<?php
								}
							}
							?>
						</div>

			            <div class="form-group">
			               <label for="work_history_additional_comments">Additional Notes/Comments</label>
							<textarea class=" character-counter" data-length="2000" id="work_history_additional_comments" maxlength="2000" name="work_additional_comments" placeholder="Other units floated to..
Patient populations..." rows="4"><?php echo $additioncomments; ?></textarea>
			            </div>
			         </div>
			         <!-- .card-body -->
			      </div>
			      <!-- .collapse -->
			   </div>
			   <!-- .card -->
			   <div class="form-group form-actions">
			      <button class="btn btn-primary submitFormProfil" id="workhistorysubmit" name="workhistorysubmit" type="submit">Save Changes</button>
			      <a class="btn btn-cancel" href="<?php echo get_site_url(); ?>/profile#workHistory">Cancel</a>
			   </div>
			</form>
<!-- 
			<div class="modal fade kamana-modal" id="dont_see_my_staffing_agency_modal" tabindex="-1" role="dialog" aria-labelledby="dont_see_my_staffing_agency_modal_title" aria-hidden="true">  
				<form id="missing_item_staffing" method="post" enctype="multipart/form-data" autocomplete="off">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="dont_see_my_staffing_agency_modal_title">Tell us what's missing.</h4>
								<button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>

							<div class="modal-body">
								<input id="request_type" name="request_type" type="hidden" value="missing_item">
								<input id="return_path" name="return_path" type="hidden" value="<?php echo get_site_url();?>/profile/work-history-new">
								<input id="category" name="category" type="hidden" value="Missing staffing agency">
								<input id="email" name="email" type="hidden" value="<?php echo $current_user->email; ?>">
								<div class="form-group">
									<label for="details">What staffing agency(s) would you like to add?</label>
									<input autofocus="" class="form-control" id="details" name="details" required="" type="text">
								</div>

								<p class="d-flex align-items-center">
									<i class="fad fa-fw mr-1 text-info fa-info-circle"></i>
									<small class="text-muted">
										You will receive an email once the missing item has been added.
									</small>
								</p>
							</div>

							<div class="modal-footer">
								<a class="btn btn-light" data-bs-dismiss="modal" href="#">Close</a>
								<button class="btn btn-primary" type="submit">Let Us Know</button>
							</div>
						</div>
					</div>
				</form>
			</div> -->
		</div>
	</div>
</div>
<?php 
if(isset($_POST['workhistorysubmit'])){

$whid = $_POST['whid'];

$facility_search = $_POST['work_history_facility_id'];
$work_department_id = $_POST['work_department_id'];
$work_city = $_POST['work_city'];
$work_address = $_POST['work_address'];
$work_zipcode = $_POST['work_zip_code'];
$work_history_province_id = $_POST['work_history_province_id'];
$work_history_profession_id = $_POST['work_history_profession_id'];
$work_started_on_month = $_POST['work_started_on_month'];
$work_started_on_year = $_POST['work_started_on_year'];
$work_ended_on_month = $_POST['work_ended_on_month'];
$work_ended_on_year = $_POST['work_ended_on_year'];
$work_currently_work_here = $_POST['work_currently_work_here'];
$work_employer_type = $_POST['work_employer_type'];
$work_staffing_agency_id = $_POST['work_staffing_agency_id'];
$work_employment_type = $_POST['work_employment_type'];
$work_additional_comments = $_POST['work_additional_comments'];
$work_contact_name = $_POST['work_history_contact_name'];
$work_contact_email = $_POST['work_history_contact_email'];
$work_phone_number = $_POST['work_history_phone_number'];
$work_fax_number = $_POST['work_history_fax_number'];
$op_facility_name = $_POST['op_facility_name_0'];
$op_address_name = $_POST['op_address_name_0'];


if($work_currently_work_here == 'true'){
	$work_currently_work_here = 1;
	}else{
	$work_currently_work_here = 0;
	}
if($work_charge_experience == 'true'){
	$work_charge_experience = 1;
}else{
	$work_charge_experience = 0;
}
if($work_teaching_hospital == 'true'){
	$work_teaching_hospital = 1;
}else{
	$work_teaching_hospital = 0;
}
if($work_critical_access_hospital == 'true'){
	$work_critical_access_hospital = 1;
}else{
	$work_critical_access_hospital = 0;
}
$locCount = $_POST['countfcaddress'];
/*if($work_started_on_year && $work_ended_on_year =='' ){
	echo '<script>alert(End date is balnk please select date else select "I am currently work here"");</script>';
	exit;
}else{*/

	if($whid == ''){
		$postid = wp_insert_post(array (
	   'post_type' => 'work-history',
	   'post_title' => $facility_search,
	   'post_status' => 'publish',
	   'meta_input' => array(
			'facility_name' =>  $facility_search,
			'work_specialty_department' => $work_department_id,
			'work_city' => $work_city,
			'work_address' => $work_address,
			'work_zip_code' => $work_zipcode,
			'work_state' => $work_history_province_id,
			'work_profession' => $work_history_profession_id,
			'work_started_on_month' => $work_started_on_month,
			'work_started_on_year' => $work_started_on_year,
			'work_ended_on_month' => $work_ended_on_month,
			'work_ended_on_year' => $work_ended_on_year,
			'work_currently_here' => $work_currently_work_here,
			'work_type_Ag_fc' => $work_employer_type,
			'work_staffing_agency' => $work_staffing_agency_id,
			'work_employment_type' =>  $work_employment_type, 
			'additional_notes_and_comments' => $work_additional_comments,
			'contact_name' => $work_contact_name,
			'contact_email' => $work_contact_email,
			'phone_number' => $work_phone_number,
			'fax_number' => $work_fax_number,
			'op_facility' => $op_facility_name,
			'op_address' => $op_address_name,
	    ),
	));
	
	for($i=1; $i<=$locCount; $i++){
		$facinx = $_POST['op_facility_name_'.$i];
		$addressinx = $_POST['op_address_name_'.$i];
		 
		update_post_meta($postid, 'opfacility_'.$i, $facinx);
		update_post_meta($postid, 'opaddress_'.$i, $addressinx);
		update_post_meta($postid,'fac_address_count',$i);
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
	$postid = $whid;
	$my_post = array(
	  'ID'           => $postid,
		);
		wp_update_post( $my_post );

		update_post_meta($whid, 'facility_name', $facility_search);
		update_post_meta($whid, 'work_specialty_department', $work_department_id);
		update_post_meta($whid, 'work_city', $work_city);
		update_post_meta($whid, 'work_address', $work_address);
		update_post_meta($whid, 'work_zip_code', $work_zipcode);
		update_post_meta($whid, 'work_state', $work_history_province_id);
		update_post_meta($whid, 'work_profession', $work_history_profession_id);
		update_post_meta($whid, 'work_started_on_month', $work_started_on_month);
		update_post_meta($whid, 'work_started_on_year', $work_started_on_year);
		update_post_meta($whid, 'work_ended_on_month', $work_ended_on_month);
		update_post_meta($whid, 'work_ended_on_year', $work_ended_on_year);
		update_post_meta($whid, 'work_currently_here', $work_currently_work_here);
		update_post_meta($whid, 'work_type_Ag_fc', $work_employer_type);
		update_post_meta($whid, 'work_staffing_agency', $work_staffing_agency_id);
		update_post_meta($whid, 'work_employment_type', $work_employment_type);
		update_post_meta($whid, 'additional_notes_and_comments', $work_additional_comments);
		update_post_meta($whid, 'contact_name', $work_contact_name);
		update_post_meta($whid, 'contact_email', $work_contact_email);
		update_post_meta($whid, 'phone_number', $work_phone_number);
		update_post_meta($whid, 'fax_number', $work_fax_number);
		update_post_meta($whid, 'op_facility', $op_facility_name);
		update_post_meta($whid, 'op_address', $op_address_name);

		for($i=1; $i<=$locCount; $i++){
			$facinx = $_POST['op_facility_name_'.$i];
			$addressinx = $_POST['op_address_name_'.$i];
			 
			update_post_meta($postid, 'opfacility_'.$i, $facinx);
			update_post_meta($postid, 'opaddress_'.$i, $addressinx);
			update_post_meta($postid,'fac_address_count',$i);
		}

		$url = get_site_url().'/profile';
		wp_redirect( $url );
		exit;

	}


	//}
}
?>

<script>
	function process(input){
		let value = input.value;
		let numbers = value.replace(/[^(\d+-?)+\d+$]/g, "");
		input.value = numbers;
	}
</script>
<?php
get_footer('dashboard');
}else{
    header('Location: ' . get_permalink(1310));
}
?>

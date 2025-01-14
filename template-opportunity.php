<?php
if(is_user_logged_in()){
/*
* Template Name: Opportunity
*/
get_header('dashboard');
ob_start();
echo get_template_part( 'template-headers/sidebar-dashboard' );
$oppid = $_GET['oppid'];

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

$shift_preference_days = get_field('shift_preference_days',$oppid);
$shift_preference_mids = get_field('shift_preference_mids',$oppid);
$shift_preference_nights = get_field('shift_preference_nights',$oppid);


$weekly_hours = get_field('weekly_hours',$oppid);
$availability = get_field('availability',$oppid);
$assignment_length = get_field('assignment_length',$oppid);
$desired_pay = get_field('desired_pay',$oppid);
$name_these_preferences = get_field('name_these_preferences',$oppid);


// $specific_city_City = get_post_meta($oppid,'specific_city_City',true);
// $specific_city_state = get_post_meta($oppid,'specific_city_state',true);
// $specific_city_distance = get_post_meta($oppid,'specific_city_distance',true);
// $anywhere_in_state = get_post_meta($oppid,'anywhere_in_state',true);
// $anywhere = get_post_meta($oppid,'anywhere',true);


$total_conut = get_post_meta($oppid,'Location_total_count',true);
$values[] = $values;


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
	  		<form id="new_opportunity_form" class="new_opportunity_form" method="post" enctype="multipart/form-data" autocomplete="off">
  			<input type="hidden" name="oppid" value="<?php echo $oppid; ?>">

			   <section class="fieldset">
			      <h5 class="legend">
			         Locations
			      </h5>
			      <div class="row">
			         <div class="col-12">
			            <p>
			               If you don't care where you go, select the "Anywhere" choice.
			            </p>
			         </div>
			      </div>
			      <div class="row">
			         <div class="col-12">
			         	<input type="hidden" name="locCount" id="locCount" value="<?php if($total_conut){ echo $total_conut;}else{ echo '1';}  ?>">

			            <div id="location_rows" class="locations">
							<?php if($oppid){ 
								$loccount = get_post_meta( $oppid,'Location_total_count',true);
								for ($i=1; $i <=$loccount ; $i++) { 
									
									$name = get_post_meta($oppid,'location_name_'.$i,true);

									$city = get_post_meta($oppid,'specific_city_City_'.$i,true);
									$state = get_post_meta($oppid,'specific_city_state_'.$i,true);
									$distance = get_post_meta($oppid,'specific_city_distance_'.$i,true);

									$asstate = get_post_meta($oppid,'anywhere_in_state_'.$i,true);
									$anywhere = get_post_meta($oppID,'anywhere',true);
echo $name.'<br>';
									/*if($name == 'SC'){
										$checkedbox = 'checked';
									}else if($name == 'AS'){
										$checkedbox = 'checked';
									}*/
								?>
						<div class="opportunity-preference-location-fields-row-<?php echo $i;?>">
			                  <div class="col-12">
			                     <div class="toolbar">
			                        <span class="d-none d-sm-inline mr-auto">
			                        Specify the details of your desired location
			                        </span>
			                        <span class="d-md-none mr-auto">
			                        Location Details
			                        </span>
			                        <a href="#remove" class=" <?php if($i == 1){ ?> d-none<?php } ?> remove-op-location-link-<?php echo $i;?> healthshield-red-text text-end text-red">
			                        <i class="fad fa-minus-circle fa-fw"></i>
			                        Remove
			                        </a>
			                     </div>
			                  </div>
			                  <div class="col-12">
			                    <section class="within-x-miles">
			                        <div class="row">
			                           <div class="col-12">
			                              <div class="form-group">
			                                 <div class="custom-control custom-radio">
			                                    <input class="toggle-location custom-control-input" data-type="radius" id="opportunity_preferences_locations_0_type_Radius" name="opportunity_preferences_locations_type_<?php echo $i;?>" type="radio" <?php if($name == 'SC'){ echo 'checked';} ?>  value="SC">
			                                    <label class="custom-control-label" for="opportunity_preferences_locations_0_type_Radius" id="opportunity_preferences_locations_0_type_Radius_label">
			                                    Specific City
			                                    </label>
			                                 </div>
			                              </div>
			                           </div>
			                        </div>
			                        <div class="field-wrapper">
			                           <div class="row">
			                              <div class="col-12 col-md-6 col-lg-4">
			                                 <div class="form-group">
			                                    <label class="destination-field-label" for="opportunity_preferences_locations_0_destination">City</label>
			                                    <input class="destination-field " id="opportunity_preferences_locations_0_destination" name="SC_destination_<?php echo $i;?>" placeholder="Richmond" type="text" value="<?php if($city){echo $city; } ?>">
			                                 </div>
			                              </div>
			                              <div class="col-12 col-md-6 col-lg-4">
			                                 <div class="form-group">
			                                    <label class="radius-state-field-label" for="opportunity_preferences_locations_0_province_id">State</label>
			                                    <div class="select-wrapper flex-grow-1 ">
			                                       <select class="browser-default radius-state-field select-css" id="opportunity_preferences_locations_0_province_id" name="SC_province_id_<?php echo $i;?>" >
			                                         	<option value=""></option>
														<option <?php if($state =='Alabama'){echo 'selected';} ?> value="Alabama">Alabama</option>
														<option <?php if($state =='Alaska'){echo 'selected';} ?> value="Alaska">Alaska</option>
														<option <?php if($state =='Arizona'){echo 'selected';} ?> value="Arizona">Arizona</option>
														<option <?php if($state =='American Samoa'){echo 'selected';} ?> value="American Samoa">American Samoa</option>
														<option <?php if($state =='Arkansas'){echo 'selected';} ?> value="Arkansas">Arkansas</option>
														<option <?php if($state =='California'){echo 'selected';} ?> value="California">California</option>
														<option <?php if($state =='Colorado'){echo 'selected';} ?> value="Colorado">Colorado</option>
														<option <?php if($state =='Connecticut'){echo 'selected';} ?> value="Connecticut">Connecticut</option>
														<option <?php if($state =='Delaware'){echo 'selected';} ?>  value="Delaware">Delaware</option>
														<option <?php if($state =='District Of Columbia'){echo 'selected';} ?>  value="District Of Columbia">District Of Columbia</option>
														<option <?php if($state =='Florida'){echo 'selected';} ?> value="Florida">Florida</option>
														<option <?php if($state =='Georgia'){echo 'selected';} ?> value="Georgia">Georgia</option>
														<option <?php if($state =='Guam'){echo 'selected';} ?> value="Guam">Guam</option>
														<option <?php if($state =='Hawaii'){echo 'selected';} ?> value="Hawaii">Hawaii</option>
														<option <?php if($state =='Idaho'){echo 'selected';} ?> value="Idaho">Idaho</option>
														<option <?php if($state =='Illinois'){echo 'selected';} ?> value="Illinois">Illinois</option>
														<option <?php if($state =='Indiana'){echo 'selected';} ?> value="Indiana">Indiana</option>
														<option <?php if($state =='Iowa'){echo 'selected';} ?> value="Iowa">Iowa</option>
														<option <?php if($state =='Kansas'){echo 'selected';} ?> value="Kansas">Kansas</option>
														<option <?php if($state =='Kentucky'){echo 'selected';} ?> value="Kentucky">Kentucky</option>
														<option <?php if($state =='Louisiana'){echo 'selected';} ?> value="Louisiana">Louisiana</option>
														<option <?php if($state =='Maine'){echo 'selected';} ?> value="Maine">Maine</option>
														<option <?php if($state =='Maryland'){echo 'selected';} ?> value="Maryland">Maryland</option>
														<option <?php if($state =='Massachusetts'){echo 'selected';} ?> value="Massachusetts">Massachusetts</option>
														<option <?php if($state =='Michigan'){echo 'selected';} ?> value="Michigan">Michigan</option>
														<option <?php if($state =='Minnesota'){echo 'selected';} ?> value="Minnesota">Minnesota</option>
														<option <?php if($state =='Mississippi'){echo 'selected';} ?> value="Mississippi">Mississippi</option>
														<option <?php if($state =='Missouri'){echo 'selected';} ?> value="Missouri">Missouri</option>
														<option <?php if($state =='Montana'){echo 'selected';} ?> value="Montana">Montana</option>
														<option <?php if($state =='Nebraska'){echo 'selected';} ?> value="Nebraska">Nebraska</option>
														<option <?php if($state =='Nevada'){echo 'selected';} ?> value="Nevada">Nevada</option>
														<option <?php if($state =='New Hampshire'){echo 'selected';} ?> value="New Hampshire">New Hampshire</option>
														<option <?php if($state =='New Jersey'){echo 'selected';} ?> value="New Jersey">New Jersey</option>
														<option <?php if($state =='New Mexico'){echo 'selected';} ?> value="New Mexico">New Mexico</option>
														<option <?php if($state =='New York'){echo 'selected';} ?> value="New York">New York</option>
														<option <?php if($state =='North Carolina'){echo 'selected';} ?> value="North Carolina">North Carolina</option>
														<option <?php if($state =='North Dakota'){echo 'selected';} ?> value="North Dakota">North Dakota</option>
														<option <?php if($state =='Northern Mariana Islands'){echo 'selected';} ?> value="Northern Mariana Islands">Northern Mariana Islands</option>
														<option <?php if($state =='Ohio'){echo 'selected';} ?> value="Ohio">Ohio</option>
														<option <?php if($state =='Oklahoma'){echo 'selected';} ?> value="Oklahoma">Oklahoma</option>
														<option <?php if($state =='Oregon'){echo 'selected';} ?> value="Oregon">Oregon</option>
														<option <?php if($state =='Pennsylvania'){echo 'selected';} ?> value="Pennsylvania">Pennsylvania</option>
														<option <?php if($state =='Puerto Rico'){echo 'selected';} ?> value="Puerto Rico">Puerto Rico</option>
														<option <?php if($state =='Rhode Island'){echo 'selected';} ?> value="Rhode Island">Rhode Island</option>
														<option <?php if($state =='South Carolina'){echo 'selected';} ?> value="South Carolina">South Carolina</option>
														<option <?php if($state =='South Dakota'){echo 'selected';} ?> value="South Dakota">South Dakota</option>
														<option <?php if($state =='Tennessee'){echo 'selected';} ?> value="Tennessee">Tennessee</option>
														<option <?php if($state =='Texas'){echo 'selected';} ?> value="Texas">Texas</option>
														<option <?php if($state =='United States Minor Outlying Islands'){echo 'selected';} ?> value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
														<option <?php if($state =='Utah'){echo 'selected';} ?> value="Utah">Utah</option>
														<option <?php if($state =='Vermont'){echo 'selected';} ?> value="Vermont">Vermont</option>
														<option <?php if($state =='Virgin Islands'){echo 'selected';} ?> value="Virgin Islands">Virgin Islands</option>
														<option <?php if($state =='Virginia'){echo 'selected';} ?> value="Virginia">Virginia</option>
														<option <?php if($state =='Washington'){echo 'selected';} ?> value="Washington">Washington</option>
														<option <?php if($state =='West Virginia'){echo 'selected';} ?> value="West Virginia">West Virginia</option>
														<option <?php if($state =='Wisconsin'){echo 'selected';} ?> value="Wisconsin">Wisconsin</option>
														<option <?php if($state =='Wyoming'){echo 'selected';} ?> value="Wyoming">Wyoming</option>
			                                          
			                                       </select>
			                                      
			                                    </div>
			                                 </div>
			                              </div>
			                              <div class="col-12 col-lg-4">
			                                 <div class="form-group">
			                                    <label class="radius-field-label" for="opportunity_preferences_locations_0_radius">Max Distance</label>
			                                    <div class="select-wrapper flex-grow-1 ">
			                                       <select class=" radius-field" id="opportunity_preferences_locations_0_radius" name="SC_radius_<?php echo $i;?>" >
			                                       	<option value=""></option>
			                                          <option <?php if($distance == '10'){ echo 'selected'; } ?> value="10">10</option>
			                                          <option <?php if($distance == '25'){ echo 'selected'; } ?> value="25">25</option>
			                                          <option <?php if($distance == '50'){ echo 'selected'; } ?> value="50">50</option>
			                                          <option <?php if($distance == '100'){ echo 'selected'; } ?> value="100">100</option>
			                                       </select>			                                     
			                                    </div>
			                                 </div>
			                              </div>
			                           </div>
			                        </div>
			                        <!-- indented fields -->
			                    </section>
			                    <section class="anywhere-in-state">
			                        <div class="row">
			                           <div class="col-12">
			                              <div class="form-group">
			                                 <div class="custom-control custom-radio">
			                                    <input class="toggle-location custom-control-input" data-type="province" id="opportunity_preferences_locations_0_type_Province" name="opportunity_preferences_locations_type_<?php echo $i;?>" type="radio" value="AS" <?php if($name == 'AS'){ echo 'checked';} ?>>
			                                    <label class="custom-control-label" for="opportunity_preferences_locations_0_type_Province" id="opportunity_preferences_locations_0_type_Province_label">
			                                    Anywhere in State
			                                    </label>
			                                 </div>
			                              </div>
			                           </div>
			                        </div>
			                        <div class="field-wrapper">
			                           <div class="row">
			                              <div class="col s12">
			                                 <div class="form-group">
			                                    <label class="state-field-label d-none" for="opportunity_preferences_locations_0_province_id_as">State</label>
			                                    <div class="select-wrapper flex-grow-1 ">
			                                       <select class="browser-default  select-css state-field" id="opportunity_preferences_locations_0_province_id_as" name="AS_province_id_<?php echo $i;?>">
			                                          	<option value=""></option>
													  	<option <?php if($asstate =='Alabama'){echo 'selected';} ?> value="Alabama">Alabama</option>
														<option <?php if($asstate =='Alaska'){echo 'selected';} ?> value="Alaska">Alaska</option>
														<option <?php if($asstate =='Arizona'){echo 'selected';} ?> value="Arizona">Arizona</option>
														<option <?php if($asstate =='American Samoa'){echo 'selected';} ?> value="American Samoa">American Samoa</option>
														<option <?php if($asstate =='Arkansas'){echo 'selected';} ?> value="Arkansas">Arkansas</option>
														<option <?php if($asstate =='California'){echo 'selected';} ?> value="California">California</option>
														<option <?php if($asstate =='Colorado'){echo 'selected';} ?> value="Colorado">Colorado</option>
														<option <?php if($asstate =='Connecticut'){echo 'selected';} ?> value="Connecticut">Connecticut</option>
														<option <?php if($asstate =='Delaware'){echo 'selected';} ?>  value="Delaware">Delaware</option>
														<option <?php if($asstate =='District Of Columbia'){echo 'selected';} ?>  value="District Of Columbia">District Of Columbia</option>
														<option <?php if($asstate =='Florida'){echo 'selected';} ?> value="Florida">Florida</option>
														<option <?php if($asstate =='Georgia'){echo 'selected';} ?> value="Georgia">Georgia</option>
														<option <?php if($asstate =='Guam'){echo 'selected';} ?> value="Guam">Guam</option>
														<option <?php if($asstate =='Hawaii'){echo 'selected';} ?> value="Hawaii">Hawaii</option>
														<option <?php if($asstate =='Idaho'){echo 'selected';} ?> value="Idaho">Idaho</option>
														<option <?php if($asstate =='Illinois'){echo 'selected';} ?> value="Illinois">Illinois</option>
														<option <?php if($asstate =='Indiana'){echo 'selected';} ?> value="Indiana">Indiana</option>
														<option <?php if($asstate =='Iowa'){echo 'selected';} ?> value="Iowa">Iowa</option>
														<option <?php if($asstate =='Kansas'){echo 'selected';} ?> value="Kansas">Kansas</option>
														<option <?php if($asstate =='Kentucky'){echo 'selected';} ?> value="Kentucky">Kentucky</option>
														<option <?php if($asstate =='Louisiana'){echo 'selected';} ?> value="Louisiana">Louisiana</option>
														<option <?php if($asstate =='Maine'){echo 'selected';} ?> value="Maine">Maine</option>
														<option <?php if($asstate =='Maryland'){echo 'selected';} ?> value="Maryland">Maryland</option>
														<option <?php if($asstate =='Massachusetts'){echo 'selected';} ?> value="Massachusetts">Massachusetts</option>
														<option <?php if($asstate =='Michigan'){echo 'selected';} ?> value="Michigan">Michigan</option>
														<option <?php if($asstate =='Minnesota'){echo 'selected';} ?> value="Minnesota">Minnesota</option>
														<option <?php if($asstate =='Mississippi'){echo 'selected';} ?> value="Mississippi">Mississippi</option>
														<option <?php if($asstate =='Missouri'){echo 'selected';} ?> value="Missouri">Missouri</option>
														<option <?php if($asstate =='Montana'){echo 'selected';} ?> value="Montana">Montana</option>
														<option <?php if($asstate =='Nebraska'){echo 'selected';} ?> value="Nebraska">Nebraska</option>
														<option <?php if($asstate =='Nevada'){echo 'selected';} ?> value="Nevada">Nevada</option>
														<option <?php if($asstate =='New Hampshire'){echo 'selected';} ?> value="New Hampshire">New Hampshire</option>
														<option <?php if($asstate =='New Jersey'){echo 'selected';} ?> value="New Jersey">New Jersey</option>
														<option <?php if($asstate =='New Mexico'){echo 'selected';} ?> value="New Mexico">New Mexico</option>
														<option <?php if($asstate =='New York'){echo 'selected';} ?> value="New York">New York</option>
														<option <?php if($asstate =='North Carolina'){echo 'selected';} ?> value="North Carolina">North Carolina</option>
														<option <?php if($asstate =='North Dakota'){echo 'selected';} ?> value="North Dakota">North Dakota</option>
														<option <?php if($asstate =='Northern Mariana Islands'){echo 'selected';} ?> value="Northern Mariana Islands">Northern Mariana Islands</option>
														<option <?php if($asstate =='Ohio'){echo 'selected';} ?> value="Ohio">Ohio</option>
														<option <?php if($asstate =='Oklahoma'){echo 'selected';} ?> value="Oklahoma">Oklahoma</option>
														<option <?php if($asstate =='Oregon'){echo 'selected';} ?> value="Oregon">Oregon</option>
														<option <?php if($asstate =='Pennsylvania'){echo 'selected';} ?> value="Pennsylvania">Pennsylvania</option>
														<option <?php if($asstate =='Puerto Rico'){echo 'selected';} ?> value="Puerto Rico">Puerto Rico</option>
														<option <?php if($asstate =='Rhode Island'){echo 'selected';} ?> value="Rhode Island">Rhode Island</option>
														<option <?php if($asstate =='South Carolina'){echo 'selected';} ?> value="South Carolina">South Carolina</option>
														<option <?php if($asstate =='South Dakota'){echo 'selected';} ?> value="South Dakota">South Dakota</option>
														<option <?php if($asstate =='Tennessee'){echo 'selected';} ?> value="Tennessee">Tennessee</option>
														<option <?php if($asstate =='Texas'){echo 'selected';} ?> value="Texas">Texas</option>
														<option <?php if($asstate =='United States Minor Outlying Islands'){echo 'selected';} ?> value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
														<option <?php if($asstate =='Utah'){echo 'selected';} ?> value="Utah">Utah</option>
														<option <?php if($asstate =='Vermont'){echo 'selected';} ?> value="Vermont">Vermont</option>
														<option <?php if($asstate =='Virgin Islands'){echo 'selected';} ?> value="Virgin Islands">Virgin Islands</option>
														<option <?php if($asstate =='Virginia'){echo 'selected';} ?> value="Virginia">Virginia</option>
														<option <?php if($asstate =='Washington'){echo 'selected';} ?> value="Washington">Washington</option>
														<option <?php if($asstate =='West Virginia'){echo 'selected';} ?> value="West Virginia">West Virginia</option>
														<option <?php if($asstate =='Wisconsin'){echo 'selected';} ?> value="Wisconsin">Wisconsin</option>
														<option <?php if($asstate =='Wyoming'){echo 'selected';} ?> value="Wyoming">Wyoming</option>
			                                          
			                                       </select>
			                                      
			                                    </div>
			                                 </div>
			                              </div>
			                           </div>
			                        </div>
			                     </section>
			                     <?php if($i == 1){ ?>
			                     <section class="anywhere">
			                        <div class="row">
			                           <div class="col-12">
			                              <div class="form-group">
			                                 <div class="custom-control custom-radio">
			                                    <input class="toggle-location custom-control-input" data-type="anywhere" id="opportunity_preferences_locations_0_type_Anywhere" name="opportunity_preferences_locations_type_1" type="radio" value="Anywhere">
			                                    <label class="custom-control-label" for="opportunity_preferences_locations_0_type_Anywhere" id="opportunity_preferences_locations_0_type_Anywhere_label">
			                                    Anywhere
			                                    </label>
			                                 </div>
			                              </div>
			                           </div>
			                        </div>
			                    </section>
			                    <?php }else{

			                    } ?>
			                </div>
			            </div>
			        <?php }
			    	}else{ 

			    	?>
						<div class="opportunity-preference-location-fields-row-1">
			                  <div class="col-12">
			                     <div class="toolbar">
			                        <span class="d-none d-sm-inline mr-auto">
			                        Specify the details of your desired location
			                        </span>
			                        <span class="d-md-none mr-auto">
			                        Location Details
			                        </span>
			                        <a href="#remove" class="d-none remove-op-location-link healthshield-red-text text-end text-red">
			                        <i class="fad fa-minus-circle fa-fw"></i>
			                        Remove
			                        </a>
			                     </div>
			                  </div>
			                  <div class="col-12">
			                    <section class="within-x-miles">
			                        <div class="row">
			                           <div class="col-12">
			                              <div class="form-group">
			                                 <div class="custom-control custom-radio">
			                                    <input checked class="toggle-location custom-control-input" data-type="radius" id="opportunity_preferences_locations_0_type_Radius" name="opportunity_preferences_locations_type_1" type="radio" value="SC" >
			                                    <label class="custom-control-label" for="opportunity_preferences_locations_0_type_Radius" id="opportunity_preferences_locations_0_type_Radius_label">
			                                    Specific City
			                                    </label>
			                                 </div>
			                              </div>
			                           </div>
			                        </div>
			                        <div class="field-wrapper">
			                           <div class="row">
			                              <div class="col-12 col-md-6 col-lg-4">
			                                 <div class="form-group">
			                                    <label class="destination-field-label" for="opportunity_preferences_locations_0_destination">City</label>
			                                    <input class="destination-field " id="opportunity_preferences_locations_0_destination" name="SC_destination_1" placeholder="Richmond" type="text" value="">
			                                 </div>
			                              </div>
			                              <div class="col-12 col-md-6 col-lg-4">
			                                 <div class="form-group">
			                                    <label class="radius-state-field-label" for="opportunity_preferences_locations_0_province_id">State</label>
			                                    <div class="select-wrapper flex-grow-1 ">
			                                       <select class="browser-default radius-state-field select-css" id="opportunity_preferences_locations_0_province_id" name="SC_province_id_1" >
														<option value=""></option>
														<option  value="Alabama">Alabama</option>
														<option  value="Alaska">Alaska</option>
														<option  value="Arizona">Arizona</option>
														<option  value="American Samoa">American Samoa</option>
														<option  value="Arkansas">Arkansas</option>
														<option  value="California">California</option>
														<option  value="Colorado">Colorado</option>
														<option  value="Connecticut">Connecticut</option>
														<option  value="Delaware">Delaware</option>
														<option  value="District Of Columbia">District Of Columbia</option>
														<option  value="Florida">Florida</option>
														<option  value="Georgia">Georgia</option>
														<option  value="Guam">Guam</option>
														<option  value="Hawaii">Hawaii</option>
														<option  value="Idaho">Idaho</option>
														<option  value="Illinois">Illinois</option>
														<option  value="Indiana">Indiana</option>
														<option  value="Iowa">Iowa</option>
														<option  value="Kansas">Kansas</option>
														<option  value="Kentucky">Kentucky</option>
														<option  value="Louisiana">Louisiana</option>
														<option  value="Maine">Maine</option>
														<option  value="Maryland">Maryland</option>
														<option  value="Massachusetts">Massachusetts</option>
														<option  value="Michigan">Michigan</option>
														<option  value="Minnesota">Minnesota</option>
														<option  value="Mississippi">Mississippi</option>
														<option  value="Missouri">Missouri</option>
														<option  value="Montana">Montana</option>
														<option  value="Nebraska">Nebraska</option>
														<option  value="Nevada">Nevada</option>
														<option  value="New Hampshire">New Hampshire</option>
														<option  value="New Jersey">New Jersey</option>
														<option  value="New Mexico">New Mexico</option>
														<option  value="New York">New York</option>
														<option  value="North Carolina">North Carolina</option>
														<option  value="North Dakota">North Dakota</option>
														<option  value="Northern Mariana Islands">Northern Mariana Islands</option>
														<option  value="Ohio">Ohio</option>
														<option  value="Oklahoma">Oklahoma</option>
														<option  value="Oregon">Oregon</option>
														<option  value="Pennsylvania">Pennsylvania</option>
														<option  value="Puerto Rico">Puerto Rico</option>
														<option  value="Rhode Island">Rhode Island</option>
														<option  value="South Carolina">South Carolina</option>
														<option  value="South Dakota">South Dakota</option>
														<option  value="Tennessee">Tennessee</option>
														<option  value="Texas">Texas</option>
														<option  value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
														<option  value="Utah">Utah</option>
														<option  value="Vermont">Vermont</option>
														<option  value="Virgin Islands">Virgin Islands</option>
														<option  value="Virginia">Virginia</option>
														<option  value="Washington">Washington</option>
														<option  value="West Virginia">West Virginia</option>
														<option  value="Wisconsin">Wisconsin</option>
														<option  value="Wyoming">Wyoming</option>
			                                          
			                                       </select>
			                                      
			                                    </div>
			                                 </div>
			                              </div>
			                              <div class="col-12 col-lg-4">
			                                 <div class="form-group">
			                                    <label class="radius-field-label" for="opportunity_preferences_locations_0_radius">Max Distance</label>
			                                    <div class="select-wrapper flex-grow-1 ">
			                                       <select class=" radius-field" id="opportunity_preferences_locations_0_radius" name="SC_radius_1" >
			                                       	  <option value=""></option>
			                                          <option value="10">10</option>
			                                          <option value="25">25</option>
			                                          <option value="50">50</option>
			                                          <option value="100">100</option>
			                                       </select>			                                     
			                                    </div>
			                                 </div>
			                              </div>
			                           </div>
			                        </div>
			                        <!-- indented fields -->
			                    </section>
			                    <section class="anywhere-in-state">
			                        <div class="row">
			                           <div class="col-12">
			                              <div class="form-group">
			                                 <div class="custom-control custom-radio">
			                                    <input class="toggle-location custom-control-input" data-type="province" id="opportunity_preferences_locations_0_type_Province" name="opportunity_preferences_locations_type_1" type="radio" value="AS" >
			                                    <label class="custom-control-label" for="opportunity_preferences_locations_0_type_Province" id="opportunity_preferences_locations_0_type_Province_label">
			                                    Anywhere in State
			                                    </label>
			                                 </div>
			                              </div>
			                           </div>
			                        </div>
			                        <div class="field-wrapper">
			                           <div class="row">
			                              <div class="col s12">
			                                 <div class="form-group">
			                                    <label class="state-field-label d-none" for="opportunity_preferences_locations_0_province_id_as">State</label>
			                                    <div class="select-wrapper flex-grow-1 ">
			                                       <select class="browser-default  select-css state-field" id="opportunity_preferences_locations_0_province_id_as" name="AS_province_id_1">
												   		<option value=""></option>
														<option  value="Alabama">Alabama</option>
														<option  value="Alaska">Alaska</option>
														<option  value="Arizona">Arizona</option>
														<option  value="American Samoa">American Samoa</option>
														<option  value="Arkansas">Arkansas</option>
														<option  value="California">California</option>
														<option  value="Colorado">Colorado</option>
														<option  value="Connecticut">Connecticut</option>
														<option  value="Delaware">Delaware</option>
														<option  value="District Of Columbia">District Of Columbia</option>
														<option  value="Florida">Florida</option>
														<option  value="Georgia">Georgia</option>
														<option  value="Guam">Guam</option>
														<option  value="Hawaii">Hawaii</option>
														<option  value="Idaho">Idaho</option>
														<option  value="Illinois">Illinois</option>
														<option  value="Indiana">Indiana</option>
														<option  value="Iowa">Iowa</option>
														<option  value="Kansas">Kansas</option>
														<option  value="Kentucky">Kentucky</option>
														<option  value="Louisiana">Louisiana</option>
														<option  value="Maine">Maine</option>
														<option  value="Maryland">Maryland</option>
														<option  value="Massachusetts">Massachusetts</option>
														<option  value="Michigan">Michigan</option>
														<option  value="Minnesota">Minnesota</option>
														<option  value="Mississippi">Mississippi</option>
														<option  value="Missouri">Missouri</option>
														<option  value="Montana">Montana</option>
														<option  value="Nebraska">Nebraska</option>
														<option  value="Nevada">Nevada</option>
														<option  value="New Hampshire">New Hampshire</option>
														<option  value="New Jersey">New Jersey</option>
														<option  value="New Mexico">New Mexico</option>
														<option  value="New York">New York</option>
														<option  value="North Carolina">North Carolina</option>
														<option  value="North Dakota">North Dakota</option>
														<option  value="Northern Mariana Islands">Northern Mariana Islands</option>
														<option  value="Ohio">Ohio</option>
														<option  value="Oklahoma">Oklahoma</option>
														<option  value="Oregon">Oregon</option>
														<option  value="Pennsylvania">Pennsylvania</option>
														<option  value="Puerto Rico">Puerto Rico</option>
														<option  value="Rhode Island">Rhode Island</option>
														<option  value="South Carolina">South Carolina</option>
														<option  value="South Dakota">South Dakota</option>
														<option  value="Tennessee">Tennessee</option>
														<option  value="Texas">Texas</option>
														<option  value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
														<option  value="Utah">Utah</option>
														<option  value="Vermont">Vermont</option>
														<option  value="Virgin Islands">Virgin Islands</option>
														<option  value="Virginia">Virginia</option>
														<option  value="Washington">Washington</option>
														<option  value="West Virginia">West Virginia</option>
														<option  value="Wisconsin">Wisconsin</option>
														<option  value="Wyoming">Wyoming</option>
			                                          
			                                       </select>
			                                      
			                                    </div>
			                                 </div>
			                              </div>
			                           </div>
			                        </div>
			                     </section>
			                     <section class="anywhere">
			                        <div class="row">
			                           <div class="col-12">
			                              <div class="form-group">
			                                 <div class="custom-control custom-radio">
			                                    <input class="toggle-location custom-control-input" data-type="anywhere" id="opportunity_preferences_locations_0_type_Anywhere" name="opportunity_preferences_locations_type_1" type="radio" value="Anywhere">
			                                    <label class="custom-control-label" for="opportunity_preferences_locations_0_type_Anywhere" id="opportunity_preferences_locations_0_type_Anywhere_label">
			                                    Anywhere
			                                    </label>
			                                 </div>
			                              </div>
			                           </div>
			                        </div>
			                    </section>
			                </div>
			            </div>
			           <?php } ?>
			            </div>
			         </div>
			      </div>
			      <div class="row">
			         <div class="col-12">
			            <div class="location-actions">
			               <a class="add-op-location-link btn btn-floating btn-small healthshield-new" href="#add-location"><i class="fal fa-plus"></i></a>
			               <a class="add-op-location-link healthshield-edit-text" id="add-op-location-link" href="#add-location">
			               Add another desired location
			               </a>
			            </div>
			         </div>
			      </div>
			   </section>
			   <section class="fieldset">
			      <h5 class="legend">Shift Preference</h5>
			      <div class="row label-row">
			         <div class="col s12">
			            What time of day would you like to work?
			         </div>
			      </div>
			      <div class="row">
			         <div class="col-12 d-flex gap-3">

					<div class="custom-control custom-checkbox custom-control-inline">
						
						<input class="custom-control-input" id="opportunity_preferences_shift_days" name="opportunity_preferences_shift_days" type="checkbox" value="<?php if($shift_preference_days){echo $shift_preference_days;} ?>" <?php if($shift_preference_days == 'Days' ){ echo 'checked';} ?>>
						<label class="custom-control-label" for="opportunity_preferences_shift_days">Days</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
						
						<input class="custom-control-input" id="opportunity_preferences_shift_mids" name="opportunity_preferences_shift_mids" type="checkbox" value="<?php if($shift_preference_mids){echo $shift_preference_mids;} ?>" <?php if($shift_preference_mids == 'Mids' ){ echo 'checked';} ?>>
						<label class="custom-control-label" for="opportunity_preferences_shift_mids">Mids</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
						<input class="custom-control-input" id="opportunity_preferences_shift_nights" name="opportunity_preferences_shift_nights" type="checkbox" value="<?php if($shift_preference_nights){echo $shift_preference_nights;} ?>" <?php if($shift_preference_nights == 'Nights' ){ echo 'checked';}?>>
						<label class="custom-control-label" for="opportunity_preferences_shift_nights">Nights</label>
						</div>

			         </div>
			      </div>
			   </section>
			   <section class="fieldset">
			      <h5 class="legend">Weekly Hours</h5>
			      <div class="row label-row">
			         <div class="col-12">
			            How many hours would you like to work each week?
			         </div>
			      </div>
			      <div class="row">
			         <div class="col-12">
			            <label class="sr-only" for="opportunity_preferences_hours_per_week">How many hours would you like to work each week?</label>
			            <div class="select-wrapper flex-grow-1 ">
			               <select class="" id="opportunity_preferences_hours_per_week" name="opportunity_preferences_hours_per_week" required>
			                  <option value=""></option>
			                  <option <?php if($weekly_hours == '8'){echo 'selected';} ?> value="8">8</option>
			                  <option <?php if($weekly_hours == '12'){echo 'selected';} ?> value="12">12</option>
			                  <option <?php if($weekly_hours == '16'){echo 'selected';} ?> value="16">16</option>
			                  <option <?php if($weekly_hours == '24'){echo 'selected';} ?> value="24">24</option>
			                  <option <?php if($weekly_hours == '32'){echo 'selected';} ?> value="32">32</option>
			                  <option <?php if($weekly_hours == '36'){echo 'selected';} ?> value="36">36</option>
			                  <option <?php if($weekly_hours == '40'){echo 'selected';} ?> value="40">40</option>
			                  <option <?php if($weekly_hours == '48'){echo 'selected';} ?> value="48">48</option>
			                  <option <?php if($weekly_hours == '56'){echo 'selected';} ?> value="56">56</option>
			                  <option <?php if($weekly_hours == '58'){echo 'selected';} ?> value="58">58</option>
			                  <option <?php if($weekly_hours == '60'){echo 'selected';} ?> value="60">60</option>
			               </select>
			              
			            </div>
			         </div>
			      </div>
			   </section>
			   <section class="fieldset">
			      <h5 class="legend">Availability</h5>
			      <div class="row label-row">
			         <div class="col-12">
			            When are you able to start?
			         </div>
			      </div>
			      <div class="row">
			         <div class="col-12" style="position: relative;">
			            <div class="form-group">
			               <label class="sr-only" for="opportunity_preferences_available_on">When are you able to start?</label>
			               <input class="flatpickr-from-today input userdatePicker_today" placeholder="" tabindex="0"  name="opportunity_preferences_available_on" id="opportunity_preferences_available_on" type="text" readonly="readonly" value="<?php if($availability){ echo $availability;} ?>" required>
			            </div>
			         </div>
			      </div>
			   </section>
			   <section class="fieldset">
			      <h5 class="legend">Assignment Length</h5>
			      <div class="row label-row">
			         <div class="col-12">
			            What is your max desired work length (weeks)?
			         </div>
			      </div>
			      <div class="row">
			         <div class="col-12">
			            <div class="form-group">
			               <label class="sr-only" for="opportunity_preferences_desired_contract_length">What is your max desired work length?</label>
			               <div class="select-wrapper flex-grow-1 ">
			                  <select class="browser-default  select-css" id="opportunity_preferences_desired_contract_length" name="opportunity_preferences_desired_contract_length" required>
			                     <option value="">Select weeks...</option>
			                     <option <?php if($assignment_length == '1'){echo 'selected';} ?> value="1">1</option>
			                     <option <?php if($assignment_length == '2'){echo 'selected';} ?> value="2">2</option>
			                     <option <?php if($assignment_length == '3'){echo 'selected';} ?> value="3">3</option>
			                     <option <?php if($assignment_length == '4'){echo 'selected';} ?> value="4">4</option>
			                     <option <?php if($assignment_length == '5'){echo 'selected';} ?> value="5">5</option>
			                     <option <?php if($assignment_length == '6'){echo 'selected';} ?> value="6">6</option>
			                     <option <?php if($assignment_length == '7'){echo 'selected';} ?> value="7">7</option>
			                     <option <?php if($assignment_length == '8'){echo 'selected';} ?> value="8">8</option>
			                     <option <?php if($assignment_length == '9'){echo 'selected';} ?> value="9">9</option>
			                     <option <?php if($assignment_length == '10'){echo 'selected';} ?> value="10">10</option>
			                     <option <?php if($assignment_length == '11'){echo 'selected';} ?> value="11">11</option>
			                     <option <?php if($assignment_length == '12'){echo 'selected';} ?> value="12">12</option>
			                     <option <?php if($assignment_length == '13'){echo 'selected';} ?> value="13">13</option>
			                     <option <?php if($assignment_length == '14'){echo 'selected';} ?> value="14">14</option>
			                     <option <?php if($assignment_length == '15'){echo 'selected';} ?> value="15">15</option>
			                     <option <?php if($assignment_length == '16'){echo 'selected';} ?> value="16">16</option>
			                     <option <?php if($assignment_length == '17'){echo 'selected';} ?> value="17">17</option>
			                     <option <?php if($assignment_length == '18'){echo 'selected';} ?> value="18">18</option>
			                     <option <?php if($assignment_length == '19'){echo 'selected';} ?> value="19">19</option>
			                     <option <?php if($assignment_length == '20'){echo 'selected';} ?> value="20">20</option>
			                     <option <?php if($assignment_length == '21'){echo 'selected';} ?> value="21">21</option>
			                     <option <?php if($assignment_length == '22'){echo 'selected';} ?> value="22">22</option>
			                     <option <?php if($assignment_length == '23'){echo 'selected';} ?> value="23">23</option>
			                     <option <?php if($assignment_length == '24'){echo 'selected';} ?> value="24">24</option>
			                     <option <?php if($assignment_length == '25'){echo 'selected';} ?> value="25">25</option>
			                     <option <?php if($assignment_length == '26'){echo 'selected';} ?> value="26">26</option>
			                  </select>
			                  
			               </div>
			            </div>
			         </div>
			      </div>
			   </section>
			   <section class="fieldset">
			      <h5 class="legend">Desired Pay</h5>
			      <div class="row label-row">
			         <div class="col-12">
			            Your minimum acceptable weekly gross pay:
			         </div>
			      </div>
			      <div class="row">
			         <div class="col-12">
			            <div class="form-group">
			               <label class="sr-only" for="opportunity_preferences_minimum_weekly_gross_pay">Your minimum acceptable weekly gross pay:</label>
			               <input class="" id="opportunity_preferences_minimum_weekly_gross_pay" name="opportunity_preferences_minimum_weekly_gross_pay" placeholder="$0 to $15,000" type="number" value="<?php if($desired_pay){echo $desired_pay;} ?>" required>
			               <small class="form-text text-muted">To see all results, leave your preference at $0.</small>
			            </div>
			         </div>
			      </div>
			   </section>
			   <section class="fieldset">
			      <div class="row">
			         <div class="col-12">
			            <div class="form-group">
			               <label for="opportunity_preferences_name">Name these Preferences</label>
			               <input class=" character-counter" data-length="255" id="opportunity_preferences_name" name="opportunity_preferences_name" type="text" value="<?php if($name_these_preferences){echo $name_these_preferences;}else{echo 'First Preferences'; } ?>" maxlength="255">
			            </div>
			         </div>
			      </div>
			      <div class="row">
			         <div class="col-12">
			            <button class="btn btn-primary submitFormProfil perfrenceSubmit" name="perfrenceSubmit" id="perfrenceSubmit" type="submit">Save Changes</button>
			            <a class="btn btn-cancel" href="<?php echo get_site_url(); ?>/profile#opportunity_preferences">Cancel</a>
			         </div>
			      </div>
			   </section>
			</form>
	  	</div>
	 </div>
</div>
<?php 
if(isset($_POST['perfrenceSubmit'])){
		$pid = $_GET['oppid'];

		$shift_days = $_POST['opportunity_preferences_shift_days'];
		$shift_mids = $_POST['opportunity_preferences_shift_mids'];
		$shift_nights = $_POST['opportunity_preferences_shift_nights'];

		$weeklyhours = $_POST['opportunity_preferences_hours_per_week'];
		$available = $_POST['opportunity_preferences_available_on'];
		$contract_length  = $_POST['opportunity_preferences_desired_contract_length'];
		$desiredpay = $_POST['opportunity_preferences_minimum_weekly_gross_pay'];
		$prefrencename = $_POST['opportunity_preferences_name'];

// if($shift_days =='' && $shift_days =='' && $shift_days ==''){
// 	echo '<script>alert("Please select your any shift preference.");</script>';
// 	$url = get_permalink(1054);
// 	wp_redirect( $url );
// 	exit;
// }else{

	if($pid == ''){
			$oppPostId = wp_insert_post(array(
					'post_type' => 'opportunities',
				'post_title' => $prefrencename,
				'post_status' => 'publish',
				'meta_input' => array(
					'shift_preference_days' => $shift_days,
					'shift_preference_mids' => $shift_mids,
					'shift_preference_nights' => $shift_nights,
					'availability' => $available,
					'weekly_hours' => $weeklyhours,
					'assignment_length' => $contract_length,
					'desired_pay'=> $desiredpay,
					'name_these_preferences' => $prefrencename,

					),
				));

			$locCount = $_POST['locCount'];
				for($i=1; $i<=$locCount; $i++)
				{

				$nameLoc = $_POST['opportunity_preferences_locations_type_'.$i];

				if($nameLoc == 'SC'){
				$sc_city = $_POST['SC_destination_'.$i];
				$sc_state = $_POST['SC_province_id_'.$i];
				$sc_distance = $_POST['SC_radius_'.$i];
				$Locname = $_POST['opportunity_preferences_locations_type_'.$i];

				$postid = wp_insert_post(array (
				'post_type' => 'locations',
				'post_title' => $nameLoc,
				'post_status' => 'publish',
				'meta_input' => array(
					'specific_city_City' => $sc_state,
					'specific_city_state' => $sc_city,
					'specific_city_distance' => $sc_distance,

					),
					));

					update_post_meta($oppPostId,'location_name_'.$i,$Locname);
					update_post_meta($oppPostId,'specific_city_City_'.$i,$sc_city);
					update_post_meta($oppPostId,'specific_city_state_'.$i,$sc_state);
					update_post_meta($oppPostId,'specific_city_distance_'.$i,$sc_distance);

				}else if($nameLoc == 'AS'){
					$Locname = $_POST['opportunity_preferences_locations_type_'.$i];
					$as_state = $_POST['AS_province_id_'.$i];
					$postid = wp_insert_post(array (
				'post_type' => 'locations',
				'post_title' => $nameLoc,
				'post_status' => 'publish',
				'meta_input' => array(
					'anywhere_in_state' => $as_state,
					),
					));
					update_post_meta($oppPostId,'location_name_'.$i,$Locname);
					update_post_meta($oppPostId,'anywhere_in_state_'.$i,$as_state);
					

				}else if($nameLoc == 'Anywhere'){
					$Locname = $_POST['opportunity_preferences_locations_type_'.$i];
					$postid = wp_insert_post(array (
					'post_type' => 'locations',
					'post_title' => $nameLoc,
					'post_status' => 'publish',
					'meta_input' => array(
					'anywhere' => 'Anywhere',
					),
					));
					update_post_meta($oppPostId,'anywhere',$Locname);
				}else{

				}
				//$postid[] = $postid;
				update_post_meta($oppPostId,'Location_total_count',$i);
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
			$postid = $pid;
			$my_post = array(
				'ID'           => $postid,
				'post_title'   => $prefrencename,
			);
			wp_update_post( $my_post );

				update_post_meta($pid,'shift_preference_days',$shift_days);
				update_post_meta($pid,'shift_preference_mids',$shift_mids);
				update_post_meta($pid,'shift_preference_nights',$shift_nights);
				update_post_meta($pid,'availability',$available);
				update_post_meta($pid,'weekly_hours',$weeklyhours);
				update_post_meta($pid,'assignment_length',$contract_length);
				update_post_meta($pid,'desired_pay',$desiredpay);
				update_post_meta($pid,'name_these_preferences',$prefrencename);
				$url = get_site_url().'/profile';
				wp_redirect( $url );
				exit;
		}			


	// }

}
?>
<?php
get_footer('dashboard');
}else{
	header('Location: ' . get_permalink(1310));
}
?>
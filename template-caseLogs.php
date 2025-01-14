<?php
if(is_user_logged_in()){
/*
* Template Name: Case logs
*/
get_header('dashboard');
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

$caseid = $_GET['caseid'];

$fcname = get_field('facility_name_case',$caseid);
$agecase = get_field('age_case',$caseid);
$gendercase = get_field('gender_case',$caseid);
$phystatus = get_field('physical_status_case',$caseid);
$traumaemg = get_field('traumaemergency_case',$caseid);
$clinicalnot = get_field('clinical_notes_case',$caseid);

$peripheral = get_field('peripheral_case',$caseid);

$document_name = get_field('document_name',$caseid);
$datecaselog = get_field('case_log_date', $caseid);

$bulkupload = get_field('bulk_upload', $caseid);

$day = get_post_meta($caseid, 'day', true);
$month = get_post_meta($caseid, 'month', true);
$year = get_post_meta($caseid, 'year', true);

//echo $day.'-'.$month.'-'.$year;

$AnesthesiaTypevalues = get_post_meta($caseid,'AnesthesiaType_data',true);
$administartionvalues = get_post_meta($caseid,'administration_data',true);
$Proceduresvalues = get_post_meta($caseid,'AnesthesiaProcedures_data',true);
$AnatomicalCategoryvalues = get_post_meta($caseid,'AnatomicalCategory_data',true);

$faciAge = get_post_meta($caseid, 'faciAge', true);

// print_r($AnesthesiaTypevalues);

$va1 = explode(',', $AnesthesiaTypevalues);
$va2 = explode(',', $administartionvalues);
$va3 = explode(',', $Proceduresvalues);
$va4 = explode(',', $AnatomicalCategoryvalues);

$peripheralArrayVal = explode(',', $peripheral);

?>
<div class="content profile_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
            <form name="caselogForm" id="caselogForm" method="post" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="caseid" id="caseid" value="<?php echo $caseid; ?>">
                <section class="caslelogsec" id="CaseLogs">
                    <h5 class="legend">Clinical Information</h5>
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="facilityname">Facility Name (Document Name)</label>
                                        <input type="text" name="facilityname" id="facilityname" value="<?php echo $fcname; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="facilityage">Age </label>
                                        <select name="faciAge" id="faciAge">
                                            <option value="Neonate" <?php if($faciAge == 'Neonate'){ echo 'selected'; } ?>>Neonate (less than 4 weeks)</option>
                                            <option value="Pediatric1" <?php if($faciAge == 'Pediatric1'){ echo 'selected'; } ?>>Pediatric (5 weeks - 2 years)</option>
                                            <option value="Pediatric2" <?php if($faciAge == 'Pediatric2'){ echo 'selected'; } ?>>Pediatric (2 to 17 years)</option>
                                            <option value="Adult" <?php if($faciAge == 'Adult'){ echo 'selected'; } ?>>Adult (18 - 64)</option>
                                            <option value="Geriatric" <?php if($faciAge == 'Geriatric'){ echo 'selected'; } ?>>Geriatric (65+ years)</option>
                                        </select>
                                        <!-- <input type="text" name="facilityage" id="facilityage" value="<?php //echo $agecase; ?>"> -->
                                        <!-- <div class="birthBox">
                                    <div>
                                        <select name="caseDay">
                                            <option value=""></option>
                                            <?php //for($i = 0; $i<=31; $i++){ ?>
                                            <option value="<?php //echo $i; ?>" <?php //if($day == $i){echo 'selected';} ?>><?php //echo $i; ?></option>
                                            <?php //} ?>
                                        </select>
                                        <label>Days</label>    
                                    </div>
                                    <div> 
                                        <select name="caseMonth">
                                            <option value=""></option>
                                            <?php //for($j = 0; $j<=12; $j++){ ?>
                                            <option value="<?php //echo $j; ?>" <?php //if($month == $j){echo 'selected';} ?>><?php //echo $j; ?></option>
                                            <?php //} ?>
                                        </select>
                                        <label>Months</label>
                                    </div>
                                    <div>
                                        <input type="number" name="caseYear" placeholder="" value="<?php //echo $year; ?>">
                                        <label>Years</label> 
                                    </div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="facilitygender">Gender</label>
                                        <select name="facilitygender" id="facilitygender">
                                            <option value=""></option>
                                            <option <?php if($gendercase == 'Female'){echo 'selected';} ?> value="Female">Female</option>
                                            <option <?php if($gendercase == 'Male'){echo 'selected'; } ?> value="Male">Male</option>
                                            <option <?php if($gendercase == 'Non-binary'){echo 'selected'; } ?> value="Non-binary">Non-binary</option>
                                            <option <?php if($gendercase == 'Transgender'){echo 'selected'; } ?> value="Transgender">Transgender</option>
                                            <option <?php if($gendercase == 'Other'){echo 'selected'; } ?> value="Other">Other</option>
                                            <option <?php if($gendercase == 'Choose not to disclose'){echo 'selected'; } ?> value="Choose not to disclose">Choose not to disclose</option>
                                        </select>
                                        
                                    </div>
                                </div>  
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="facilityPhysical">Physical Status</label>
                                        <select name="facilityPhysical" id="facilityPhysical">
                                            <option value=""></option>
                                            <option <?php if($phystatus == '1'){echo 'selected';} ?> value="1">1</option>
                                            <option <?php if($phystatus == '2'){echo 'selected';} ?> value="2">2</option>
                                            <option <?php if($phystatus == '3'){echo 'selected';} ?> value="3">3</option>
                                            <option <?php if($phystatus == '4'){echo 'selected';} ?> value="4">4</option>
                                            <option <?php if($phystatus == '5'){echo 'selected';} ?> value="5">5</option>
                                            <option <?php if($phystatus == '6'){echo 'selected';} ?> value="6">6</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="caselogdate">Date</label>
                                        <input type="text" id="caselogdate" value="<?php echo $datecaselog; ?>" name="caselogdate" class="caselogdate datepickerCaselog">
                                    </div>
                                </div>
                                <div class="form-group emetraumacl d-flex align-items-center">
                                    <label for="facilityemergency" class="me-3">Trauma/Emergency</label>
                                    <input type="checkbox" name="facilityemergency" id="facilityemergency" value="<?php if($traumaemg == '1'){echo '1';}else{echo '0';} ?>" <?php if($traumaemg == '1'){echo 'checked';}else{echo '';} ?>>
                                    <span class="ms-1">Yes</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </section>
                <section class="checkboxSec mt-3" id="AnesthesiaType">
                    <h5 class="legend">Anesthesia Type</h5>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaType[]" id="AnesthesiaType" value="General Anesthesia" <?php  if(in_array('General Anesthesia',$va1)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaType">General Anesthesia</label>
                            </div> 
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaType[]" id="AnesthesiaType" value="Monitored Anesthesia Care" <?php if(in_array('Monitored Anesthesia Care',$va1)){echo 'checked';}else {} ?>>
                                <label for="monanesthesia">Monitored Anesthesia Care</label>
                            </div> 
                            <span class="mb-3 d-block"><b>Regional Techniques:</b></span>
                            <div class="form-group">
                                
                                <input type="checkbox" name="administration[]" id="administration" value="Administration - Spinal" <?php if(in_array('Administration - Spinal',$va2)){echo 'checked';}else {} ?>>
                                <label for="administration">Administration - Spinal</label>
                            </div>
                             <div class="form-group">                               
                                <input type="checkbox" name="administration[]" id="administration" value="Administration - Caudal" <?php if(in_array('Administration - Caudal',$va2)){echo 'checked';}else {} ?>>
                                <label for="administration">Administration - Caudal</label>
                            </div>
                            <div class="form-group">
                               
                                <input type="checkbox" name="administration[]" id="administration" value="Administration - Epidural" <?php if(in_array('Administration - Epidural',$va2)){echo 'checked';}else {} ?>>
                                <label for="administration">Administration - Epidural</label>
                            </div>
                            <div class="form-group">                                
                                <input type="checkbox" name="administration[]" id="administration" class="administrationpe" value="Administration - Peripheral" <?php if(in_array('Administration - Peripheral',$va2)){echo 'checked';}else {} ?>>
                                <label for="administration">Administration - Peripheral</label>
                            </div>
                           
                            <div id="periheralID" class=" <?php if(in_array('Administration - Peripheral',$va2)){echo 'd-block';}else {} ?>">
                                <div class="form-group">
                                    <select name="perheraltext[]" id="perheraltext" class="perheraltext js-example-basic-multiple" multiple="multiple">
                                        <option <?php if(in_array('Adductor Canal',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Adductor Canal">Adductor Canal</option>
                                        <option <?php if(in_array('Ankle',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Ankle">Ankle</option>
                                        <option <?php if(in_array('Airway',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Airway">Airway</option>
                                    <option <?php if(in_array('Axillary',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Axillary">Axillary</option>
                                        <option <?php if(in_array('Cervical Plexus',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Cervical Plexus">Cervical Plexus</option>
                                        <option <?php if(in_array('Digital Finger',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Digital Finger">Digital Finger</option>
                                        <option <?php if(in_array('Digital Foot',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Digital Foot">Digital Foot</option>
                                        <option <?php if(in_array('Erector Spinea Plane',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Erector Spinea Plane">Erector Spinea Plane</option>
                                        <option <?php if(in_array('Fascia Iliaca',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Fascia Iliaca">Fascia Iliaca</option>
                                        <option <?php if(in_array('Femoral',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Femoral">Femoral</option>
                                        <option <?php if(in_array('Genicular',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Genicular">Genicular</option>
                                        <option <?php if(in_array('Illioinguinal and Illioypogastric TAP',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Illioinguinal and Illioypogastric TAP">Illioinguinal and Illioypogastric TAP</option>
                                        <option <?php if(in_array('Infraclavicular',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Infraclavicular">Infraclavicular</option>
                                        <option <?php if(in_array('Intercostal',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Intercostal">Intercostal</option>
                                        <option <?php if(in_array('Interscalene',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Interscalene">Interscalene</option>
                                        <option <?php if(in_array('Intrapec',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Intrapec">Intrapec</option>
                                        <option <?php if(in_array('IPACK',$peripheralArrayVal)){echo 'selected';}else {} ?> value="IPACK">IPACK</option>
                                        <option <?php if(in_array('Median Nerve',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Median Nerve">Median Nerve</option>
                                        <option <?php if(in_array('Lateral Femoral Cutaneous',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Lateral Femoral Cutaneous">Lateral Femoral Cutaneous</option>
                                        <option <?php if(in_array('Paravertebral',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Paravertebral">Paravertebral</option>
                                        <option <?php if(in_array('PECS 1',$peripheralArrayVal)){echo 'selected';}else {} ?> value="PECS 1">PECS 1</option>
                                        <option <?php if(in_array('PECS 2',$peripheralArrayVal)){echo 'selected';}else {} ?> value="PECS 2">PECS 2</option>
                                        <option <?php if(in_array('PENG',$peripheralArrayVal)){echo 'selected';}else {} ?> value="PENG">PENG</option>
                                        <option <?php if(in_array('Popliteal',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Popliteal">Popliteal</option>
                                        <option <?php if(in_array('Quadratus Lumborum',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Quadratus Lumborum">Quadratus Lumborum</option>
                                        <option <?php if(in_array('Rectus Sheath',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Rectus Sheath">Rectus Sheath</option>
                                        <option <?php if(in_array('Saphenous',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Saphenous">Saphenous</option>
                                        <option <?php if(in_array('Scalp',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Scalp">Scalp</option>
                                        <option <?php if(in_array('Sciatic',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Sciatic">Sciatic</option>
                                        <option <?php if(in_array('Supraclavicular',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Supraclavicular">Supraclavicular</option>
                                        <option <?php if(in_array('TAP',$peripheralArrayVal)){echo 'selected';}else {} ?> value="TAP">TAP</option>
                                        <option <?php if(in_array('Wrist',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Wrist">Wrist</option>
                                        <option <?php if(in_array('Bier block',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Bier block">Bier block</option>
                                        <option <?php if(in_array('Other',$peripheralArrayVal)){echo 'selected';}else {} ?> value="Other">Other</option>                                  
                                    </select>
                                    <!-- <textarea name="perheraltext" id="perheraltext" class="perheraltext" col="4" row="5"><?php //echo $peripheral; ?></textarea> --> 
                                </div>
                            </div>
                          
                            <div class="form-group">                                
                                <input type="checkbox" name="AnesthesiaType[]" id="AnesthesiaType" value="Ultrasound Use for block" <?php if(in_array('Ultrasound Use for block',$va1)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaType">Ultrasound Use for block</label>
                            </div>

                            <span class="my-3 d-block"><b>Induction, Maintenance & Emergence:</b></span>
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaType[]" id="AnesthesiaType" value="Intravenous induction" <?php if(in_array('Intravenous induction',$va1)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaType">Intravenous induction</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaType[]" id="AnesthesiaType" value="Inhalation Induction" <?php if(in_array('Inhalation Induction',$va1)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaType">Inhalation Induction</label>
                            </div>
                            <div class="form-group">
                                
                                <input type="checkbox" name="AnesthesiaType[]" id="AnesthesiaType" value="Mask Management" <?php if(in_array('Mask Management',$va1)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaType">Mask Management</label>
                            </div>
                            <div class="form-group">
                                
                                <input type="checkbox" name="AnesthesiaType[]" id="AnesthesiaType" value="Laryngeal Mask Airway (or similar)" <?php if(in_array('Laryngeal Mask Airway (or similar)',$va1)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaType">Laryngeal Mask Airway (or similar)</label>
                            </div>
                            <div class="form-group">
                                
                                <input type="checkbox" name="AnesthesiaType[]" id="AnesthesiaType" value="Tracheal Intubation - oral" <?php if(in_array('Tracheal Intubation - oral',$va1)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaType">Tracheal Intubation - oral</label>
                            </div>
                            <div class="form-group">
                               
                                <input type="checkbox" name="AnesthesiaType[]" id="AnesthesiaType" value="Tracheal Intubation - Nasal" <?php if(in_array('Tracheal Intubation - Nasal',$va1)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaType">Tracheal Intubation - Nasal</label>
                            </div>
                            <div class="form-group">
                                
                                <input type="checkbox" name="AnesthesiaType[]" id="AnesthesiaType" value="Total Intravenous Anesthesia" <?php if(in_array('Total Intravenous Anesthesia',$va1)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaType">Total Intravenous Anesthesia</label>
                            </div>
                            <div class="form-group">
                               
                                <input type="checkbox" name="AnesthesiaType[]" id="AnesthesiaType" value="Fiberoptic Technique" <?php if(in_array('Fiberoptic Technique',$va1)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaType">Fiberoptic Technique</label>
                            </div>
                            <div class="form-group">
                                
                                <input type="checkbox" name="AnesthesiaType[]" id="AnesthesiaType" value="Cricothyrotomy" <?php if(in_array('Cricothyrotomy',$va1)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaType">Cricothyrotomy </label>
                            </div>
                            <div class="form-group">                                
                                <input type="checkbox" name="AnesthesiaType[]" id="AnesthesiaType" value="One Lung Ventilation" <?php if(in_array('One Lung Ventilation',$va1)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaType">One Lung Ventilation </label>
                            </div>
                            <div class="form-group">                                
                                <input type="checkbox" name="AnesthesiaType[]" id="AnesthesiaType" value="Deliberate Hypotensive Technique" <?php if(in_array('Deliberate Hypotensive Technique',$va1)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaType">Deliberate Hypotensive Technique</label>
                            </div>
                            <div class="form-group">                                
                                <input type="checkbox" name="AnesthesiaType[]" id="AnesthesiaType" value="Deliberate Hypothermia Technique" <?php if(in_array('Deliberate Hypothermia Technique',$va1)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaType">Deliberate Hypothermia Technique</label>
                            </div>

                        </div>
                        <div class="col-md-6 col-12">
                            
                            
                            
                        </div>
                    </div>
                </section>
                <section class="checkboxSec mt-3" id="AnesthesiaProcedures">
                    <h5 class="legend">Anesthesia Procedures</h5>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaProcedures[]" id="AnesthesiaProcedures" value="Arterial Insertion" <?php if(in_array('Arterial Insertion',$va3)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaProcedures">Arterial Insertion</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaProcedures[]" id="AnesthesiaProcedures" value="Arterial BP Monitoring" <?php if(in_array('Arterial BP Monitoring',$va3)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaProcedures">Arterial BP Monitoring</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaProcedures[]" id="AnesthesiaProcedures" value="Central Line Insertion" <?php if(in_array('Central Line Insertion',$va3)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaProcedures">Central Line Insertion</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaProcedures[]" id="AnesthesiaProcedures" value="CVP Monitoring" <?php if(in_array('CVP Monitoring',$va3)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaProcedures">CVP Monitoring</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaProcedures[]" id="AnesthesiaProcedures" value="Fiberoptic bronchoscopy" <?php if(in_array('Fiberoptic bronchoscopy',$va3)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaProcedures">Fiberoptic bronchoscopy</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaProcedures[]" id="AnesthesiaProcedures" value="Cardiopulmonary Resuscitation" <?php if(in_array('Cardiopulmonary Resuscitation',$va3)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaProcedures">Cardiopulmonary Resuscitation (CPR)</label>
                            </div>
                           
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaProcedures[]" id="AnesthesiaProcedures" value="Pulmonary Artery Catheter Insertion" <?php if(in_array('Pulmonary Artery Catheter Insertion',$va3)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaProcedures">Pulmonary Artery Catheter Insertion</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaProcedures[]" id="AnesthesiaProcedures" value="Ultrasound for arterial access" <?php if(in_array('Ultrasound for arterial access',$va3)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaProcedures">Ultrasound for arterial access</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaProcedures[]" id="AnesthesiaProcedures" value="Ultrasound for venous access" <?php if(in_array('Ultrasound for venous access',$va3)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaProcedures">Ultrasound for venous access</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaProcedures[]" id="AnesthesiaProcedures" value="Epidural Blood Patch" <?php if(in_array('Epidural Blood Patch',$va3)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaProcedures">Epidural Blood Patch</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaProcedures[]" id="AnesthesiaProcedures" value="Diagnostic spinal tap" <?php if(in_array('Diagnostic spinal tap',$va3)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaProcedures">Diagnostic spinal tap</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnesthesiaProcedures[]" id="AnesthesiaProcedures" value="Preoperative Evaluation" <?php if(in_array('Preoperative Evaluation',$va3)){echo 'checked';}else {} ?>>
                                <label for="AnesthesiaProcedures">Preoperative Evaluation</label>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="checkboxSec mt-3" id="AnatomicalCategory">
                    <h5 class="legend">Anatomical Category</h5>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Intra-abdominal" <?php if(in_array('Intra-abdominal',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Intra-abdominal</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Extrathoracic" <?php if(in_array('Extrathoracic',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Extrathoracic</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Orthapaedic" <?php if(in_array('Orthapaedic',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Orthapaedic</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Urology" <?php if(in_array('Urology',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Urology</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Head – Extracranial" <?php if(in_array('Head – Extracranial',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Head – Extracranial</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Head – Oropharyngeal" <?php if(in_array('Head – Oropharyngeal',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Head – Oropharyngeal </label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Intrathoracic - Heart" <?php if(in_array('Intrathoracic - Heart',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Intrathoracic - Heart</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Intrathoracic - Lung" <?php if(in_array('Intrathoracic - Lung',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Intrathoracic - Lung</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Dental" <?php if(in_array('Dental',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Dental</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="GI" <?php if(in_array('GI',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">GI</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Eye" <?php if(in_array('Eye',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Eye</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Cardioversion" <?php if(in_array('Cardioversion',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Cardioversion</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Cath Lab" <?php if(in_array('Cath Lab',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Cath Lab</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Intrathoracic - Other" <?php if(in_array('Intrathoracic - Other',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Intrathoracic - Other</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Neck" <?php if(in_array('Neck',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Neck</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Neuroskeletal" <?php if(in_array('Neuroskeletal',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Neuroskeletal</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Vascular" <?php if(in_array('Vascular',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Vascular</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Other" <?php if(in_array('Other',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Other</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Obstetrical Management" <?php if(in_array('Obstetrical Management',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Obstetrical Management</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Cesarean delivery" <?php if(in_array('Cesarean delivery',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Cesarean delivery</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Analgesia for labor" <?php if(in_array('Analgesia for labor',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Analgesia for labor</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="GYN" <?php if(in_array('GYN',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">GYN</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="Plastics" <?php if(in_array('Plastics',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">Plastics</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="General" <?php if(in_array('General',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">General</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="AnatomicalCategory[]" id="AnatomicalCategory" value="ENT" <?php if(in_array('ENT',$va4)){echo 'checked';}else {} ?>>
                                <label for="AnatomicalCategory">ENT</label>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="textareaClinicalnot" id="ClinicalNotes">
                    <h5 class="lagend">Clinical Notes</h5>
                    <div class="row">
                        <div class="cl-md-12 col-12">
                            <div class="form-group">
                            <textarea class="clinicalnotes" id="clinicalnotesid" name="clinicalnotesid" placeholder="" col="10" row="5"><?php echo $clinicalnot; ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                </section>
                
                <!-- Upload -->
                <section class="filedset attachemnts">
				
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                   <div class="row mb-3">
                       <div class="col-lg-10">
                           <h5 class="mt-0">Attachments</h5>
                            <label for="bulkupload" class="me-3">Upload Bulk Files</label>
                            <input type="checkbox" name="bulkupload" id="bulkupload" value="<?php echo $bulkupload; ?>" <?php if($bulkupload == '1'){echo 'checked';}else{echo '';} ?>>
                            <span class="ms-1">Yes</span>
                       </div>
                       <div class="col-lg-2 text-end">
                           <a id="add_attachment" href="#" class="btn btn-floating healthshield-new" data-type="insurance"><i class="fal fa-plus"></i></a>
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
                   $imgs = get_post_meta($caseid,'caselogs_attachment_id',true);
                   $meta = explode(',', $imgs);
                   $i = 0;

                   foreach ($meta as $metas) {

                   $attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                   //$count = count($metas);
                   if($attch_name){
                   $loopattach = '<input id="insurance_attachments_'.$i.'_id" name="upload_file['.$i.'][id]" type="hidden" value="'.$metas.'">
                   <div class="card form-group">
                   <div class="d-flex attchments_posts"><i class="fal fa-file-image healthshield-green-text"></i>
                   <div class="attchName">'.$attch_name.'</div></div>
                   </div>';
                   echo $loopattach;
                   }
                  
                   $i++;
                   }
                   ?>
                </div>
            </section>

                <div class="form-group mt-3 mb-3">
                    <button class="btn btn-primary submitFormProfile" name="caselogSubmit" id="caselogSubmit" type="submit">Save Changes</button>
                    <a class="btn btn-cancel" href="<?php echo get_site_url(); ?>/profile/#case-logs">Cancel</a>
                </div>
                
                </div>
            </form>
            <?php 
                if(isset($_POST['caselogSubmit'])){

                $caseid = $_GET['caseid'];

                $facName = $_POST['facilityname'];
                $faciAge = $_POST['faciAge'];
                $facage = $_POST['facilityage'];
                $facgender = $_POST['facilitygender'];
                $facphy = $_POST['facilityPhysical'];
                $clinicalnots = $_POST['clinicalnotesid'];
                $perheralArray = $_POST['perheraltext'];
                $perheraltext = implode(",", $perheralArray);
                $traumaemg = $_POST['facilityemergency'];
                $bulkupload = $_POST['bulkupload'];
                $caselogdate = $_POST['caselogdate'];
                $AnesthesiaType = array();
                $administration = array();
                $AnesthesiaProcedures = array();
                $AnatomicalCategory = array();

                $day = $_POST['caseDay'];
                if($day)
                {
                    $day = $day;
                }
                else
                {
                    $day = '';
                }
                $month = $_POST['caseMonth'];
                if($month)
                {
                    $month = $month;
                }
                else
                {
                    $month = '';
                }
                $year = $_POST['caseYear'];
                if($year)
                {
                    $year = $year;
                }
                else
                {
                    $year = '';
                }

                if( $traumaemg == 1){
                    $traumaemg = 1;
                }else{
                    $traumaemg = 0;
                }
                
                if($bulkupload == 1)
                {
                    $bulkupload = 1;
                }
                else
                {
                    $bulkupload = 0;
                }


                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                $result = array();

                if($caseid == '')
                {

                $postid = wp_insert_post(array (
                'post_type' => 'case-logs',
                'post_title' => $facName,
                'post_status' => 'publish',
                'meta_input' => array(
                    'facility_name_case' => $facName,  
                    'faciAge' => $faciAge, 
                    'age_case' => $facage,
                    'day' => $day,
                    'month' => $month,
                    'year' => $year,
                    'physical_status_case' => $facphy,
                    'gender_case' => $facgender,
                    'traumaemergency_case' => $traumaemg,
                    'bulk_upload' => $bulkupload,
                    'clinical_notes_case' => $clinicalnots,
                    'peripheral_case' => $perheraltext,
                    'case_log_date' => $caselogdate,

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
                $savedAttach = get_post_meta($postid, 'caselogs_attachment_id', true);	    
                //echo $savedAttach;
                if($savedAttach){
                    $new_val = $Ids.','.$savedAttach;
                    update_post_meta($postid, 'caselogs_attachment_id', $new_val); 
                }
                else
                {
                update_post_meta($postid, 'caselogs_attachment_id', $Ids);   
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

                if($_POST['AnesthesiaType']){
                    foreach($_POST['AnesthesiaType'] as $k=>$val)
                    {
                    $AnesthesiaType[] = $val;
                    $Ids = implode(",",$AnesthesiaType);
                    }
                    

                    $savedAttach = get_post_meta($postid, 'AnesthesiaType_data', true);	    
                    //echo $savedAttach;
                    if($savedAttach){
                    $new_val = $Ids.','.$savedAttach;
                    update_post_meta($postid, 'AnesthesiaType_data', $new_val); 
                    }
                    else
                    {
                    update_post_meta($postid, 'AnesthesiaType_data', $Ids);   
                    }
                }
                if($_POST['administration']){
                    foreach($_POST['administration'] as $k=>$val)
                    {
                    $administration[] = $val;
                    $Ids = implode(",",$administration);
                    }
                    
                   
                    $savedAttach = get_post_meta($postid, 'administration_data', true);     
                    //echo $savedAttach;
                    if($savedAttach){
                    $new_val = $Ids.','.$savedAttach;
                    update_post_meta($postid, 'administration_data', $new_val); 
                    }
                    else
                    {
                    update_post_meta($postid, 'administration_data', $Ids);   
                    }
                }
                if($_POST['AnesthesiaProcedures']){
                    foreach($_POST['AnesthesiaProcedures'] as $k=>$val)
                    {
                    $AnesthesiaProcedures[] = $val;
                    $Ids = implode(",",$AnesthesiaProcedures);
                    }
                    
                   
                    $savedAttach = get_post_meta($postid, 'AnesthesiaProcedures_data', true);     
                    //echo $savedAttach;
                    if($savedAttach){
                    $new_val = $Ids.','.$savedAttach;
                    update_post_meta($postid, 'AnesthesiaProcedures_data', $new_val); 
                    }
                    else
                    {
                    update_post_meta($postid, 'AnesthesiaProcedures_data', $Ids);   
                    }
                }
                if($_POST['AnatomicalCategory']){
                    foreach($_POST['AnatomicalCategory'] as $k=>$val)
                    {
                    $AnatomicalCategory[] = $val;
                    $Ids = implode(",",$AnatomicalCategory);
                    }
                    
                   
                    $savedAttach = get_post_meta($postid, 'AnatomicalCategory_data', true);     
                    //echo $savedAttach;
                    if($savedAttach){
                    $new_val = $Ids.','.$savedAttach;
                    update_post_meta($postid, 'AnatomicalCategory_data', $new_val); 
                    }
                    else
                    {
                    update_post_meta($postid, 'AnatomicalCategory_data', $Ids);   
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
                $postid = $caseid;
                $my_post = array(
                'ID'           => $postid,
                'post_title'   => $facName,
                    );
                    wp_update_post( $my_post );
                    update_post_meta($caseid,'facility_name_case',$facName);
                    update_post_meta($caseid, 'faciAge', $faciAge);
                    update_post_meta($caseid,'age_case',$facage);
                    update_post_meta($caseid,'day',$day);
                    update_post_meta($caseid,'month',$month);
                    update_post_meta($caseid,'year',$year);
                    update_post_meta($caseid,'physical_status_case',$facphy);
                    update_post_meta($caseid,'gender_case',$facgender);
                    update_post_meta($caseid,'traumaemergency_case',$traumaemg);
                    update_post_meta($caseid, 'bulk_upload', $bulkupload);
                    update_post_meta($caseid,'clinical_notes_case',$clinicalnots);
                    update_post_meta($caseid,'peripheral_case',$perheraltext);
                    update_post_meta($caseid,'case_log_date',$caselogdate);

                    
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
                    $savedAttach = get_post_meta($postid, 'caselogs_attachment_id', true);	    
                    //echo $savedAttach;
                    if($savedAttach){
                        $new_val = $Ids.','.$savedAttach;
                        update_post_meta($postid, 'caselogs_attachment_id', $new_val); 
                    }
                    else
                    {
                    update_post_meta($postid, 'caselogs_attachment_id', $Ids);   
                    }
                    }

                    if($_POST['AnesthesiaType']){
                    foreach($_POST['AnesthesiaType'] as $k=>$val)
                    {
                    $AnesthesiaType[] = $val;
                    $Ids = implode(",",$AnesthesiaType);
                    }
                    
                   
                    $savedAttach = get_post_meta($caseid, 'AnesthesiaType_data', true);     
                    //echo $savedAttach;
                    if($savedAttach){
                          update_post_meta($caseid, 'AnesthesiaType_data', $Ids);   
                    } else {
                       update_post_meta($caseid, 'AnesthesiaType_data', $Ids); 
                    }
                }
                if($_POST['administration']){
                    foreach($_POST['administration'] as $k=>$val)
                    {
                    $administration[] = $val;
                    $Ids = implode(",",$administration);
                    }
                    
                   
                    $savedAttach = get_post_meta($caseid, 'administration_data', true);     
                    //echo $savedAttach;
                    if($savedAttach){
                    update_post_meta($caseid, 'administration_data', $Ids);   
                    }
                }
                if($_POST['AnesthesiaProcedures']){
                    foreach($_POST['AnesthesiaProcedures'] as $k=>$val)
                    {
                    $AnesthesiaProcedures[] = $val;
                    $Ids = implode(",",$AnesthesiaProcedures);
                    }
                    
                   
                    $savedAttach = get_post_meta($caseid, 'AnesthesiaProcedures_data', true);     
                    //echo $savedAttach;
                    if($savedAttach){
                         update_post_meta($caseid, 'AnesthesiaProcedures_data', $Ids);   
                    } else {
                        update_post_meta($caseid, 'AnesthesiaProcedures_data', $Ids);
                    }
                }
                if($_POST['AnatomicalCategory']){
                    foreach($_POST['AnatomicalCategory'] as $k=>$val)
                    {
                    $AnatomicalCategory[] = $val;
                    $Ids = implode(",",$AnatomicalCategory);
                    }
                    
                   
                    $savedAttach = get_post_meta($caseid, 'AnatomicalCategory_data', true);     
                    //echo $savedAttach;
                    if($savedAttach){
                    update_post_meta($caseid, 'AnatomicalCategory_data', $Ids);   
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
                    }).then(function() {
                        window.location = '/profile';
                    });
                </script>";
               
                    // $url = get_site_url().'/profile';
                    // wp_redirect( $url );
                    // exit;
                }


                }


                ?>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function(){  
    jQuery("#bulkupload").change(function(){  
        if(jQuery('#bulkupload').is(':checked'))
        {
          jQuery(this).val(1);
        }
        else
        {
         jQuery(this).val(0);
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
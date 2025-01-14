<?php
if(is_user_logged_in()){
    
}else{
    echo '<style>.dashbaord-header,body.page-template-archive-case-logs .sidebar{display:none !important;}.content.profile_content{height: auto !important;}</style>';
}
    /* Template Name: Case Logs Archive Custom */

get_header('dashboard');

echo get_template_part( 'template-headers/sidebar-dashboard' );

?>

<div class="content profile_content">
    <div class="container pt-5 ps-5 pe-5 pb-1">
        <div class="row">
         <div class="col-md-9">         
            <?php
              global $wpdb;
                $User_Id = get_current_user_id();

                //$posts = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key = 'AnesthesiaProcedures_data' AND  user_id = $User_Id", ARRAY_A);
                


                $args = array(  
                'post_type' => 'case-logs',
                'post_status' => 'publish',
                'orderby'=> 'date', 
                'author' => $User_Id,
                'posts_per_page' => -1
                );
                $loop = new WP_Query( $args ); 
                if ( $loop->have_posts()  ){  
                    echo '<ul id="arch_caselog" class="caselogs_display_lists display_lists">';
                    //echo '<h2>Case Logs All</h2>';
                ?>
                
                <?php    
                while ( $loop->have_posts() ) : $loop->the_post();
                    $postId = get_the_ID();
                    $post_slug = $post->post_name;
                    $fcname = get_field('facility_name_case');
                    $agecase = get_field('age_case');
                    $gendercase = get_field('gender_case');
                    $phystatus = get_field('physical_status_case');
                    $traumaemg = get_field('traumaemergency_case');
                    $clinicalnot = get_field('clinical_notes_case');
                    $peripheral = get_field('peripheral_case');
                    $document_name = get_field('document_name');
                    $datecselog = get_field('case_log_date');

                    $faciAge = get_post_meta($postId, 'faciAge', true);
                    if($faciAge == 'Neonate')
                    {
                        $label = 'Neonate (less than 4 weeks)';
                    }
                    else if($faciAge == 'Pediatric1')
                    {
                        $label = 'Pediatric ( 5 weeks - 2 years)';
                    }
                    else if($faciAge == 'Pediatric2')
                    {
                        $label = 'Pediatric 2 to 17 years';
                    }
                    else if($faciAge == 'Adult')
                    {
                        $label  = 'Adult 18-64';
                    }
                    else if($faciAge == 'Geriatric')
                    {
                        $label = 'Geriatric 65+ years';
                    }
                    else
                    {
                        $label = '';
                    }

                    $AnesthesiaTypevalues = get_post_meta($postId,'AnesthesiaType_data',true);
                    $administartionvalues = get_post_meta($postId,'administration_data',true);
                    $Proceduresvalues = get_post_meta($postId,'AnesthesiaProcedures_data',true);
                    $AnatomicalCategoryvalues = get_post_meta($postId,'AnatomicalCategory_data',true);
                    $imgs = get_post_meta($postId,'caselogs_attachment_id',true);
                    $va1 = explode(',', $AnesthesiaTypevalues);
                    $va2 = explode(',', $administartionvalues);
                    $va3 = explode(',', $Proceduresvalues);
                    $va4 = explode(',', $AnatomicalCategoryvalues);

                    $day = get_post_meta($postId, 'day', true);
                    $month = get_post_meta($postId, 'month', true);
                    $year = get_post_meta($postId, 'year', true);

                    if($day)
                    {
                        $day = $day.' Days';
                    }
                    else
                    {
                        $day = '';
                    }

                    if($month)
                    {
                        $month = $month.' Months';
                    }
                    else
                    {
                        $month = '';
                    }

                    if($year)
                    {
                        $year = $year.' Years';
                    }
                    else
                    {
                        $year = '';
                    }

                    $fullAge = $year.' '.$month.' '.$day;

                    $vaules1 = array_unique($va1);
                    $vaules2 = array_unique($va2);
                    $vaules3 = array_unique($va3);
                    $vaules4 = array_unique($va4);
            ?>
                <li class="caselogs_list list-display">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5><?php echo $fcname; ?></h5>
                            </div>
                            <div class="col-lg-6 text-end">
                                <a class="editcaselog btn" href="<?php echo get_site_url(); ?>/profile/case-logs/?caseid=<?php echo $postId; ?>">Edit</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="data-row lic_rows_data">
                                    <div class="data_label">
                                        Facility Name:
                                    </div>
                                    <div class="data_values">
                                    <?php echo $fcname; ?>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_label">
                                        Age :
                                    </div>
                                    <div class="data_values">
                                    <?php echo $label; ?>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_label">
                                        Gender:
                                    </div>
                                    <div class="data_values">
                                    <?php echo $gendercase; ?>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_label">
                                        Date:
                                    </div>
                                    <div class="data_values">
                                    <?php echo $datecselog; ?>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_label">
                                        Physcial Status:
                                    </div>
                                    <div class="data_values">
                                    <?php echo $phystatus; ?>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_label">
                                        Trauma/Emergency:
                                    </div>
                                    <div class="data_values">
                                    <?php echo $traumaemg; ?>
                                    </div>
                                </div>
                                <?php if($imgs){ ?>
                                <div class="attachments">
                                    <div class="data_label">
                                        <h3>Attachments:</h3>
                                    </div>
                                    <?php                                    
                                    $meta = explode(',', $imgs);
                                    foreach ($meta as $metas) {
                                        $attch_name = basename( get_attached_file($metas ) );
                                        echo '<a target="_blank" href="'.wp_get_attachment_url($metas).'">'.$attch_name.'</a><br>';
                                    }
                                    ?>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-6">
                                <div class="data-row lic_rows_data">
                                    <div class="data_labels">
                                    <b> Anesthesia Type:</b>

                                    <ul>
                                        <?php foreach($vaules1 as $antype){
                                            echo '<li>'.$antype.'</li>';
                                        } ?>
                                    </ul>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_labels">
                                        <b>Administration:</b>

                                    <ul>
                                        <?php foreach($vaules2 as $admin){
                                            if($admin == 'Administration - Peripheral')
                                            {

                                            if($peripheral) { $peripheral = '('.$peripheral.')';  }    
                                            echo '<li>'.$admin.' '.$peripheral.'</li>';
                                            }
                                            else
                                            {
                                            echo '<li>'.$admin.'</li>';
                                            }
                                        } ?>
                                    </ul>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_labels">
                                        <b>Anesthesia Procedures:</b>

                                    <ul>
                                        <?php foreach($vaules3 as $anpro){
                                            echo '<li>'.$anpro.'</li>';
                                        } ?>
                                    </ul>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_labels">
                                        <b>Anatomical Category:</b>

                                        <ul>
                                            <?php foreach($vaules4 as $ancat){
                                                echo '<li>'.$ancat.'</li>';
                                            } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </li>
            <?php
            endwhile;
            echo '</ul>';
            }/*else{
                echo "Add your Clinical Information!";
            }	*/
            ?>
        </div>
        <div class="col-md-3">
            <div class="csl_search"> 
            <h5 class="legend">Search By Name</h5>   
            <input type="text" id="keyword" placeholder="Enter Name">
            <h5 class="legend">Search By Age</h5> 
            <div class="ageSearchBox">
            <ul>
                <li><label for="Neonate"><input type="checkbox" name="searchAge" class="searchAge" value="Neonate" id="Neonate">Neonate (less than 4 weeks)</label></li>    
                <li><label for="Pediatric1"><input type="checkbox" name="searchAge" class="searchAge" value="Pediatric1" id="Pediatric1">Pediatric (5 weeks - 2 years)</label></li>
                <li><label for="Pediatric2"><input type="checkbox" name="searchAge" class="searchAge" value="Pediatric2" id="Pediatric2">Pediatric (2 to 17 years)</label></li>
                <li><label for="Adult"><input type="checkbox" name="searchAge" class="searchAge" value="Adult" id="Adult">Adult (18 - 64)</label></li>
                <li><label for="Geriatric"><input type="checkbox" name="searchAge" class="searchAge" value="Geriatric" id="Geriatric">Geriatric (65+ years)</label></li>
            </ul>
            </div>

            <h5 class="legend">Search by Date</h5>
            <strong>From : </strong>
            <input type="text" class="caselogdate" name="caselogdateFrom" id="caselogdateFrom" autocomplete="off">
            <strong>To : </strong>
            <input type="text" class="caselogdate" name="caselogdateTo" id="caselogdateTo" autocomplete="off">

            <br /><br />

            <h5 class="legend">Anesthesia Procedures</h5>
            <ul>
                <li><input type="checkbox" name="ap" class="ap" value="Arterial Insertion"> Arterial Insertion</li>
                <li><input type="checkbox" name="ap" class="ap" value="Arterial BP Monitoring"> Arterial BP Monitoring</li>
                <li><input type="checkbox" name="ap" class="ap" value="Central Line Insertion"> Central Line Insertion</li>
                <li><input type="checkbox" name="ap" class="ap" value="CVP Monitoring"> CVP Monitoring</li>
                <li><input type="checkbox" name="ap" class="ap" value="Epidural Blood Patch"> Epidural Blood Patch</li>
                <li><input type="checkbox" name="ap" class="ap" value="Pulmonary Artery Catheter Insertion"> Pulmonary Artery Catheter Insertion</li>
                <li><input type="checkbox" name="ap" class="ap" value="Ultrasound for arterial access"> Ultrasound for arterial access</li>
                <li><input type="checkbox" name="ap" class="ap" value="Ultrasound for venous access"> Ultrasound for venous access</li>
                <li><input type="checkbox" name="ap" class="ap" value="Fiberoptic bronchoscopy"> Fiberoptic bronchoscopy</li>
                <li><input type="checkbox" name="ap" class="ap" value="Cardiopulmonary Resuscitation"> Cardiopulmonary Resuscitation (CPR)</li>
                <li><input type="checkbox" name="ap" class="ap" value="Diagnostic spinal tap"> Diagnostic spinal tap</li>
                <li><input type="checkbox" name="ap" class="ap" value="Preoperative Evaluation"> Preoperative Evaluation</li>
            </ul>
            <h5 class="legend">Anatomical Category</h5>
            <ul>
                <li><input type="checkbox" name="ac" class="ac" value="Intra-abdominal"> Intra Abdominal</li>
                <li><input type="checkbox" name="ac" class="ac" value="Extrathoracic"> Extrathoracic</li>
                <li><input type="checkbox" name="ac" class="ac" value="Orthapaedic"> Orthapaedic</li>
                <li><input type="checkbox" name="ac" class="ac" value="Urology"> Urology</li>
                <li><input type="checkbox" name="ac" class="ac" value="Head – Extracranial"> Head – Extracranial</li>
                <li><input type="checkbox" name="ac" class="ac" value="Head – Oropharyngeal"> Head – Oropharyngeal</li>
                <li><input type="checkbox" name="ac" class="ac" value="Intrathoracic - Heart"> Intrathoracic - Heart</li>
                <li><input type="checkbox" name="ac" class="ac" value="Intrathoracic - Lung"> Intrathoracic - Lung</li>
                <li><input type="checkbox" name="ac" class="ac" value="Dental"> Dental</li>
                <li><input type="checkbox" name="ac" class="ac" value="GI"> GI</li>
                <li><input type="checkbox" name="ac" class="ac" value="Eye"> Eye</li>
                <li><input type="checkbox" name="ac" class="ac" value="Cardioversion"> Cardioversion</li>
                <li><input type="checkbox" name="ac" class="ac" value="Cath Lab"> Cath Lab</li>
                <li><input type="checkbox" name="ac" class="ac" value="Intrathoracic - Other"> Intrathoracic - Other</li>
                <li><input type="checkbox" name="ac" class="ac" value="Neck"> Neck</li>
                <li><input type="checkbox" name="ac" class="ac" value="Neuroskeletal"> Neuroskeletal</li>
                <li><input type="checkbox" name="ac" class="ac" value="Vascular"> Vascular</li>
                <li><input type="checkbox" name="ac" class="ac" value="Other"> Other</li>
                <li><input type="checkbox" name="ac" class="ac" value="Obstetrical Management"> Obstetrical Management</li>
                <li><input type="checkbox" name="ac" class="ac" value="Cesarean delivery"> Cesarean delivery</li>
                <li><input type="checkbox" name="ac" class="ac" value="Analgesia for labor"> Analgesia for labor</li>
                <li><input type="checkbox" name="ac" class="ac" value="GYN"> GYN</li>
                <li><input type="checkbox" name="ac" class="ac" value="Plastics"> Plastics</li>
                <li><input type="checkbox" name="ac" class="ac" value="General"> General</li>
                <li><input type="checkbox" name="ac" class="ac" value="ENT"> ENT</li>
            </ul>
            <h5 class="legend">Anesthesia Type</h5>
            <ul>
                <li><input type="checkbox" name="at" class="at" value="General Anesthesia"> General Anesthesia</li>
                <li><input type="checkbox" name="at" class="at" value="Monitored Anesthesia Care"> Monitored Anesthesia Care</li>
                <li><input type="checkbox" name="at" class="at" value="Ultrasound Use for block"> Ultrasound Use for block</li>
                <li><input type="checkbox" name="at" class="at" value="Intravenous induction"> Intravenous induction</li>
                <li><input type="checkbox" name="at" class="at" value="Inhalation Induction"> Inhalation Induction</li>
                <li><input type="checkbox" name="at" class="at" value="Mask Management"> Mask Management</li>
                <li><input type="checkbox" name="at" class="at" value="Laryngeal Mask Airway (or similar)"> Laryngeal Mask Airway</li>
                <li><input type="checkbox" name="at" class="at" value="Tracheal Intubation - oral"> Tracheal Intubation - oral</li>
                <li><input type="checkbox" name="at" class="at" value="Tracheal Intubation - Nasal"> Tracheal Intubation - Nasal</li>
                <li><input type="checkbox" name="at" class="at" value="Total Intravenous Anesthesia"> Total Intravenous Anesthesia</li>
                <li><input type="checkbox" name="at" class="at" value="Fiberoptic Technique"> Fiberoptic Technique</li>
                <li><input type="checkbox" name="at" class="at" value="Cricothyrotomy"> Cricothyrotomy</li>
                <li><input type="checkbox" name="at" class="at" value="One Lung Ventilation"> One Lung Ventilation</li>
            </ul>
            <h5 class="legend">Administration</h5>
            <ul class="administration">
                <li><input type="checkbox" name="ad" class="ad" value="Administration - Spinal"> Administration - Spinal</li>
                <li><input type="checkbox" name="ad" class="ad" value="Administration - Caudal"> Administration - Caudal</li>
                <li><input type="checkbox" name="ad" class="ad" value="Administration - Epidural"> Administration - Epidural</li>
                <li><input type="checkbox" name="ad" class="ad" value="Administration - Peripheral"> Administration - Peripheral</li>
            </ul>
                          <div id="periheralID" class=" <?php if(in_array('Administration - Peripheral',$va2)){echo 'd-block';}else {} ?>">
                            <div class="form-group">
                                <select name="perheraltext" id="perheraltext" class="perheraltext js-example-basic-multiple" multiple="multiple">
                                        <option value="Adductor Canal">Adductor Canal</option>
                                        <option value="Ankle">Ankle</option>
                                        <option value="Airway">Airway</option>
                                        <option value="Axillary">Axillary</option>
                                        <option value="Cervical Plexus">Cervical Plexus</option>
                                        <option value="Digital Finger">Digital Finger</option>
                                        <option value="Digital Foot">Digital Foot</option>
                                        <option value="Erector Spinea Plane">Erector Spinea Plane</option>
                                        <option value="Fascia Iliaca">Fascia Iliaca</option>
                                        <option value="Femoral">Femoral</option>
                                        <option value="Genicular">Genicular</option>
                                        <option value="Illioinguinal and Illioypogastric TAP">Illioinguinal and Illioypogastric TAP</option>
                                        <option value="Infraclavicular">Infraclavicular</option>
                                        <option value="Intercostal">Intercostal</option>
                                        <option value="Interscalene">Interscalene</option>
                                        <option value="Intrapec">Intrapec</option>
                                        <option value="IPACK">IPACK</option>
                                        <option value="Median Nerve">Median Nerve</option>
                                        <option value="Lateral Femoral Cutaneous">Lateral Femoral Cutaneous</option>
                                        <option value="Paravertebral">Paravertebral</option>
                                        <option value="PECS 1">PECS 1</option>
                                        <option value="PECS 2">PECS 2</option>
                                        <option value="PENG">PENG</option>
                                        <option value="Popliteal">Popliteal</option>
                                        <option value="Quadratus Lumborum">Quadratus Lumborum</option>
                                        <option value="Rectus Sheath">Rectus Sheath</option>
                                        <option value="Saphenous">Saphenous</option>
                                        <option value="Scalp">Scalp</option>
                                        <option value="Sciatic">Sciatic</option>
                                        <option value="Supraclavicular">Supraclavicular</option>
                                        <option value="TAP">TAP</option>
                                        <option value="Wrist">Wrist</option>
                                        <option value="Bier block">Bier block</option>
                                        <option value="Other">Other</option>                                       
                                </select>
                            </div>
                            </div>
            <button class="caselog_search" id="caselog_search" >Search</button> <a class="resetBtn" href="<?php echo get_the_permalink(2248); ?>">RESET</a>
            </div> 
            <div class="bulkPdfs">
                <h5 class="legend">Bulk Case Log Files</h5>
                <?php
                while ( $loop->have_posts() ) : $loop->the_post();
                    $bulkupload = get_field('bulk_upload', get_the_ID());
                    if($bulkupload == 1)
                    {
                        $imgs = get_post_meta(get_the_ID(),'caselogs_attachment_id',true);
                        $meta = explode(',', $imgs);
                        if($meta)
                        {
                            foreach ($meta as $metas) 
                            {
                                 $attch_name = basename( get_attached_file($metas ) );
                                 $attach_url = wp_get_attachment_url( $metas );
                                 if($attch_name)
                                 {
                                    echo '<a href="'.$attach_url.'" class="bulkFiles">'.$attch_name.'</a>';
                                 }
                            }
                        }
                    }

                endwhile;
                ?>
            </div>
        </div>
<!--------------Repeat table------------------->
<?php
 if ( $loop->have_posts()  ){  
                echo '<div id="pdf">';    
           ?>
                
                <?php    
                while ( $loop->have_posts() ) : $loop->the_post();
                    $postId = get_the_ID();
                    $post_slug = $post->post_name;
                    $fcname = get_field('facility_name_case');
                    $agecase = get_field('age_case');
                    $gendercase = get_field('gender_case');
                    $phystatus = get_field('physical_status_case');
                    $traumaemg = get_field('traumaemergency_case');
                    $clinicalnot = get_field('clinical_notes_case');
                    $peripheral = get_field('peripheral_case');
                    $document_name = get_field('document_name');
                    $datecselog = get_field('case_log_date');

                    $AnesthesiaTypevalues = get_post_meta($postId,'AnesthesiaType_data',true);
                    $administartionvalues = get_post_meta($postId,'administration_data',true);
                    $Proceduresvalues = get_post_meta($postId,'AnesthesiaProcedures_data',true);
                    $AnatomicalCategoryvalues = get_post_meta($postId,'AnatomicalCategory_data',true);

                    $day = get_post_meta($postId, 'day', true);
        $month = get_post_meta($postId, 'month', true);
        $year = get_post_meta($postId, 'year', true);

        if($day > 0)
        {
            $day = $day;
        }
        else
        {
            $day = '';
        }

        if($month > 0)
        {
            if($month == 1)
            {
                $month = "Jan";

            }
            else if($month == 2)
            {
                $month = "Feb";

            }
            else if($month == 3)
            {
                $month = "Mar";

            }
            else if($month == 4)
            {
                $month = "Apr";

            }
            else if($month == 5)
            {
                $month = "May";

            }
            else if($month == 6)
            {
                $month = "Jun";

            }
            else if($month == 7)
            {
                $month = "Jul";

            }
            else if($month == 8)
            {
                $month = "Aug";

            }
            else if($month == 9)
            {
                $month = "Sep";

            }
            else if($month == 10)
            {
                $month = "Oct";

            }
            else if($month == 11)
            {
                $month = "Nov";

            }
            else if($month == 12)
            {
                $month = "Dec";

            }
        }
        else
        {
            $month = '';
        }

        if($year > 0)
        {
            $year = $year;
        }
        else
        {
            $year = '';
        }

        $fullAge = $day.' '.$month.' '.$year;

                    $va1 = explode(',', $AnesthesiaTypevalues);
                    $va2 = explode(',', $administartionvalues);
                    $va3 = explode(',', $Proceduresvalues);
                    $va4 = explode(',', $AnatomicalCategoryvalues);
            ?>

                <table border="1" cellpadding="4" cellspacing="4" id="myTab" class="table table-striped" width="100%" style="margin-bottom: 20px;">
                    <colgroup>
                        <col width="50%">
                            <col width="50%">
                    </colgroup>
                    <thead>
                        <tr class='warning'>
                            <th colspan="2" align="left" style="padding-left: 10px; text-transform: uppercase; font-size: 16px;"><?php echo $fcname; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>Facility Name:</strong><?php echo $fcname; ?><br>
                        <strong>DOB (Date of Birth) :</strong><?php echo $fullAge; ?><br>
                        <strong>Gender:</strong><?php echo $gendercase; ?><br>
                        <strong>Date:</strong><?php echo $datecselog; ?><br>
                        <strong>Physcial Status:</strong><?php echo $phystatus; ?><br>
                        <strong>Trauma/Emergency:</strong><?php echo $traumaemg; ?><br>
                            </td>
                              <td>
                                <strong>Anesthesia Type:</strong><?php foreach($va1 as $antype){
                                            echo $antype.'<br>';
                                        } ?>
                                     <strong>Administration:</strong>
                                        <?php foreach($va2 as $admin){
                                            echo $admin.'<br>';
                                        } ?>
                                    <strong>Anesthesia Procedures:</strong>
                                        <?php foreach($va3 as $anpro){
                                            echo $anpro.'<br>';
                                        } ?>
                                    <strong>Anatomical Category:</strong>
                                        <?php foreach($va4 as $anpro){
                                            echo $anpro.'<br>';
                                        } ?>
                                    
                              </td>
                        </tr>
                    </tbody>
                </table>
           <?php
            endwhile;
           echo '</div>';
            }

?>


<!-----For PDF Generate---------->            

            

            <div class="printBtns" style="display:flex; justify-content: space-between;">
            <button onclick="printDiv('pdf','Title')">PRINT PDF</button>

            </div>
            <script>
                jQuery('#caselog_search').click(function(){
                    jQuery('.ApWait').show();
                    fetch();
                    fetchTable();
                });
            </script>
        </div>
    </div>
</div>
<div class="ApWait" style="display: none;">
  <div class="loader_child">
    <div id="loading-bar-spinner" class="spinner">
      <div class="spinner-icon"></div>
    </div>
  </div>
</div>
<style type="text/css">
    #myTab{display: none;}
    #case-log-title{
        font-size:30px;

    }
    /*loading icon start*/
    .ApWait{display: none;width: 100%;height: 100%;border: 0 solid black;
       position: fixed;top: 0;left: 0;padding: 2px;
       box-shadow: inset 0 0 0 8000px rgba(0, 0, 0, 0.30);
       z-index: 99999;}
       .loader_child{position:absolute;top:50%;left:50%;padding:15px;
       -webkit-transform:translate(-50%,-50%);
       -moz-transform:translate(-50%,-50%);
       -o-transform:translate(-50%,-50%);
       transform:translate(-50%,-50%);
       }
       #loading-bar-spinner.spinner {
       left: 50%;margin-left: -20px;top: 50%;margin-top: -20px;
       position: absolute;
       animation: loading-bar-spinner 500ms linear infinite;
       }
       #loading-bar-spinner.spinner .spinner-icon {
       width: 40px;height: 40px;border:  solid 4px transparent;
       border-top-color:  #2695FF;
       border-left-color: #2695FF;
       border-radius: 50%;
       -webkit-animation: initial;
       animation: initial;
       }
       @keyframes loading-bar-spinner {
       0%   { transform: rotate(0deg);   transform: rotate(0deg); }
       100% { transform: rotate(360deg); transform: rotate(360deg); }
       }
/*loading icon end*/
</style>
<script>
jQuery(document).ready(function(){
    /*jQuery( ".caselogdate" ).datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true, 
        yearRange : '1900:+0',       
    }); */


    jQuery("input#caselogdateFrom").datepicker({
        numberOfMonths: 1,
        dateFormat: "yy-mm-dd",
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            jQuery("input#caselogdateTo").datepicker("option", "minDate", dt);
        }
    });
    jQuery("input#caselogdateTo").datepicker({
        numberOfMonths: 1,
        dateFormat: "yy-mm-dd",
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() - 1);
            jQuery("input#caselogdateFrom").datepicker("option", "maxDate", dt);
        }
    });

});    
</script>

<script type="text/javascript">
function fetch(){

    var periVal, newperiVal, at, newat, ap, newap, ac, newac, ad, newad, searchAge, newsearchAge, fromDate, toDate;

    fromDate = jQuery('input#caselogdateFrom').val();
    if(fromDate)
    {
        fromDate = fromDate;
    }
    else
    {
        fromDate = '';
    }

    toDate = jQuery('input#caselogdateTo').val();
    if(toDate)
    {
        toDate = toDate;
    }
    else
    {
        toDate = '';
    }

    periVal = jQuery('#perheraltext').val();
    if(periVal)
    {
        newperiVal = periVal.toString();
    }
    else
    {
        newperiVal = '';
    }

    at = [];
    jQuery(".at:checked").each(function(){
         at.push($(this).val());
    });

    if(at)
    {
        newat = at.toString();
    }
    else
    {
        newat = '';
    }

    ap = [];
    jQuery(".ap:checked").each(function(){
         ap.push($(this).val());
    });

    if(ap)
    {
        newap = ap.toString();
    }
    else
    {
        newap = '';
    }

    ac = [];
    jQuery(".ac:checked").each(function(){
         ac.push($(this).val());
    });

    if(ac)
    {
        newac = ac.toString();
    }
    else
    {
        newac = '';
    }

    ad = [];
    jQuery(".ad:checked").each(function(){
         ad.push($(this).val());
    });

    if(ad)
    {
        newad = ad.toString();
    }
    else
    {
        newad = '';
    }

    searchAge = [];
    jQuery(".searchAge:checked").each(function(){
         searchAge.push(jQuery(this).val());
    });

    if(searchAge)
    {
        newsearchAge = searchAge.toString();
    }
    else
    {
        newsearchAge = '';
    }




    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'data_fetch', keyword: jQuery('#keyword').val(), ap: newap, ac: newac, at: newat, ad: newad, perheraltext: newperiVal, searchAge: newsearchAge, fromDate: fromDate, toDate: toDate},
        success: function(data) {
            jQuery('.ApWait').hide();
            jQuery('#arch_caselog').html( data );
        }
    });

}

function fetchTable(){

    var periVal, newperiVal, at, newat, ap, newap, ac, newac, ad, newad, searchAge, newsearchAge, fromDate, toDate;

    fromDate = jQuery('input#caselogdateFrom').val();
    if(fromDate)
    {
        fromDate = fromDate;
    }
    else
    {
        fromDate = '';
    }

    toDate = jQuery('input#caselogdateTo').val();
    if(toDate)
    {
        toDate = toDate;
    }
    else
    {
        toDate = '';
    }

    periVal = jQuery('#perheraltext').val();
    if(periVal)
    {
        newperiVal = periVal.toString();
    }
    else
    {
        newperiVal = '';
    }

    at = [];
    jQuery(".at:checked").each(function(){
         at.push($(this).val());
    });

    if(at)
    {
        newat = at.toString();
    }
    else
    {
        newat = '';
    }

    ap = [];
    jQuery(".ap:checked").each(function(){
         ap.push($(this).val());
    });

    if(ap)
    {
        newap = ap.toString();
    }
    else
    {
        newap = '';
    }

    ac = [];
    jQuery(".ac:checked").each(function(){
         ac.push($(this).val());
    });

    if(ac)
    {
        newac = ac.toString();
    }
    else
    {
        newac = '';
    }

    ad = [];
    jQuery(".ad:checked").each(function(){
         ad.push($(this).val());
    });

    if(ad)
    {
        newad = ad.toString();
    }
    else
    {
        newad = '';
    }

    searchAge = [];
    jQuery(".searchAge:checked").each(function(){
         searchAge.push(jQuery(this).val());
    });

    if(searchAge)
    {
        newsearchAge = searchAge.toString();
    }
    else
    {
        newsearchAge = '';
    }

    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'data_fetch_pdf_table', keyword: jQuery('#keyword').val(), ap: newap, ac: newac, at: newat, ad: newad, perheraltext: newperiVal, searchAge: newsearchAge, fromDate: fromDate, toDate: toDate },
        success: function(data) {
            jQuery('.ApWait').hide();
            jQuery('#pdf').html( data );
        }
    });

}

function printDiv(divId,title) {

  let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');
  mywindow.document.write(`<html><head><title>Case Logs</title>`);
  mywindow.document.write('</head><body>');
  mywindow.document.write(document.getElementById(divId).innerHTML);
  mywindow.document.write('</body></html>');

  mywindow.document.close(); // necessary for IE >= 10
  mywindow.focus(); // necessary for IE >= 10*/

  mywindow.print();
  mywindow.close();

  return true;
}

</script>
<?php
if(is_user_logged_in()){
    get_footer('dashboard');
}else{

}
?>
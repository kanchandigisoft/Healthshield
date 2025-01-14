<?php
/*
* Template Name: Immunizations
*/
get_header('dashboard');
ob_start();
echo get_template_part( 'template-headers/sidebar-dashboard' );

if(is_user_logged_in()){

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


$mUID= $_GET['mUID'];

$immun_drop = get_field('immunizations_dropdown',$mUID);
$hepdatereceived = get_field('hepatitis_date_received',$mUID);
$fludatereceived = get_field('flu_date_received',$mUID);
$fludateexpire = get_field('flu_date_expire',$mUID);
$varicelladatereceived = get_field('varicella_date_recevied',$mUID);
$coviddatereceived = get_field('covid_date_recevied',$mUID);
$coviddateexpire = get_field('covid_date_expire',$mUID);
$tbdatereceived = get_field('tb_date_recevied',$mUID);
$tbdateexpire = get_field('tb_date_expire',$mUID);
$tdapdate = get_field('tdap_received',$mUID);
$mmrdate = get_field('mmr_received',$mUID);
$irhdate = get_field('irh_received',$mUID);
$otherinput = get_post_meta($mUID,'other_total_count',true);


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
      <div class="fancy-heading">
         <h2>
            Add a Immunizations Details
         </h2>
      </div>
      <form id="immunizations_form" action="" class="immunizations_form" method="post" enctype="multipart/form-data" autocomplete="off">
         <input type="hidden" name="immunizations_id" id="immunizations_id" value="<?php echo $mUID; ?>">
         <input type="hidden" name="otherinput_id" id="otherinput_id" value="<?php if($otherinput){ echo $otherinput;}else{ echo '0';} ?>">
         <section class="MediaclDropdown" >
            <div class="form-group">
               <label for="dropId">Immunizations</label>
               <select name="dropId" id="dropId" class="dropdownid">
                  <option value=""></option>
                  <option <?php if($immun_drop == 'Hepatitis B' ){echo 'selected';} ?> value="Hepatitis B" id="hepatitis">Hepatitis B</option>
                  <option <?php if($immun_drop == 'Flu' ){echo 'selected';} ?> value="Flu" id="flu">Flu</option>
                  <option <?php if($immun_drop == 'Varicella' ){echo 'selected';} ?> value="Varicella" id="varicella">Varicella</option>
                  <option <?php if($immun_drop == 'COVID' ){echo 'selected';} ?> value="COVID" id="covid">COVID</option>
                  <option <?php if($immun_drop == 'TB' ){echo 'selected';} ?> value="TB" id="tb">TB</option>
                  <option <?php if($immun_drop == 'TDAP' ){echo 'selected';} ?> value="TDAP" id="tdap">TDAP</option>
                  <option <?php if($immun_drop == 'MMR' ){echo 'selected';} ?> value="MMR" id="mmr">MMR</option>
                  <option <?php if($immun_drop == 'Immunization Record/History' ){echo 'selected';} ?> value="Immunization Record/History" id="irh">Immunization Record/History</option>
                  <option <?php if($immun_drop == 'Other Immunizations' ){echo 'selected';} ?> value="Other Immunizations" id="otherdocuments">Other Immunizations</option>
               </select>
            </div>
         </section>
         <section class="dropdownalldata">
            <div class="Hepatitis <?php if($immun_drop == 'Hepatitis B' ){echo 'd-block';}else{echo 'd-none';} ?>" id="hepatitis" >
               <div class="form-group">
                  <label for="hep_id">Date Received</label>
                  <input type="text" name="hep_id" id="hep_id" class="userdatePicker_received" value="<?php if($hepdatereceived){ echo $hepdatereceived;} ?>">
                  <section class="filedset attachemnts mt-3">
                     <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                           <div class="row mb-3">
                              <div class="col-lg-10">
                                 <h5 class="mt-0">Upload Proof of Immunization or Titer</h5>
                              </div>
                              <div class="col-lg-2 text-end">
                                 <a id="hepatitis_add_attachment" href="#" class="btn btn-floating healthshield-new" data-type="license"><i class="fal fa-plus"></i></a>
                              </div>
                           </div>
                           <div class="card bg-light mb-2">
                              <div class="card-body">
                                 Have an attachment?  Click the "+" sign above.
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="hepatitis_attachments_lists">
                        <?php
                           $imgs = get_post_meta($mUID,'hepatitis_attachment_id',true);
                           $meta = explode(',', $imgs);
                           $i = 0;
                           
                           foreach ($meta as $metas) {
                           
                           $attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                              $i++;
                           //$count = count($metas);
                           if($attch_name){
                           $loopattach = '<input id="hepatitis_attachments_'.$i.'_id" name="hep_file['.$i.'][id]" type="hidden" value="'.$metas.'">
                           <div class="card form-group">
                           <div class="d-flex attchments_posts"><i class="fal fa-file-image healthshield-green-text"></i>
                           <div class="attchName">'.$attch_name.'</div></div>
                           </div>';
                           echo $loopattach;
                           }
                           
                           
                           }
                           ?>
                     </div>
                  </section>
               </div>
            </div>
            <div class="Flu <?php if($immun_drop == 'Flu' ){echo 'd-block';}else{echo 'd-none';} ?>" id="flu"  >
               <div class="form-group">
                  <div class="row">
                        <div class="col-md-6 col-12">
                           <label for="flu_id">Date Received</label>
                           <input type="text" name="flu_id" id="flu_id" class="userdatePicker_received" value="<?php if($fludatereceived){ echo $fludatereceived;} ?>">
                        </div>
                        <div class="col-md-6 col-12">
                           <label for="flu_id2">Expiration Date</label>
                           <input type="text" name="flu_id2" id="flu_id2" class="userdatePicker_today" value="<?php if($fludateexpire){ echo $fludateexpire;} ?>">
                        </div>
                     </div>
                  <section class="filedset attachemnts mt-3">
                     <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                           <div class="row mb-3">
                              <div class="col-lg-10">
                                 <h5 class="mt-0">Upload Proof of Immunization or Titer</h5>
                              </div>
                              <div class="col-lg-2 text-end">
                                 <a id="flu_add_attachment" href="#" class="btn btn-floating healthshield-new" data-type="license"><i class="fal fa-plus"></i></a>
                              </div>
                           </div>
                           <div class="card bg-light mb-2">
                              <div class="card-body">
                                 Have an attachment?  Click the "+" sign above.
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="flu_attachments_lists">
                        <?php
                           $imgs = get_post_meta($mUID,'flu_attachment_id',true);
                           $meta = explode(',', $imgs);
                           $i = 0;
                           
                           foreach ($meta as $metas) {
                           
                           $attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                           $i++;
                           //$count = count($metas);
                           if($attch_name){
                           $loopattach = '<input id="flu_attachments_'.$i.'_id" name="flu_file['.$i.'][id]" type="hidden" value="'.$metas.'">
                           <div class="card form-group">
                           <div class="d-flex attchments_posts"><i class="fal fa-file-image healthshield-green-text"></i>
                           <div class="attchName">'.$attch_name.'</div></div>
                           </div>';
                           }
                           echo $loopattach;
                           
                           }
                           ?>
                     </div>
                  </section>
               </div>
            </div>
            <div class="Varicella <?php if($immun_drop == 'Varicella' ){echo 'd-block';}else{echo 'd-none';} ?>" id="varicella"  >
               <div class="form-group">
                  <label for="varicella_id">Date Received</label>
                  <input type="text" name="varicella_id" id="varicella_id" class="userdatePicker_received" value="<?php if($varicelladatereceived){ echo $varicelladatereceived;} ?>">
                  <section class="filedset attachemnts mt-3">
                     <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                           <div class="row mb-3">
                              <div class="col-lg-10">
                                 <h5 class="mt-0">Upload Proof of Immunization or Titer</h5>
                              </div>
                              <div class="col-lg-2 text-end">
                                 <a id="varicella_add_attachment" href="#" class="btn btn-floating healthshield-new" data-type="license"><i class="fal fa-plus"></i></a>
                              </div>
                           </div>
                           <div class="card bg-light mb-2">
                              <div class="card-body">
                                 Have an attachment?  Click the "+" sign above.
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="varicella_attachments_lists">
                        <?php
                           $imgs = get_post_meta($mUID,'varicella_attachment_id',true);
                           $meta = explode(',', $imgs);
                           $i = 0;
                           
                           foreach ($meta as $metas) {
                           
                           $attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                           $i++;
                           //$count = count($metas);
                           if($attch_name){
                           $loopattach = '<input id="varicella_attachments_'.$i.'_id" name="varicella_file['.$i.'][id]" type="hidden" value="'.$metas.'">
                           <div class="card form-group">
                           <div class="d-flex attchments_posts"><i class="fal fa-file-image healthshield-green-text"></i>
                           <div class="attchName">'.$attch_name.'</div></div>
                           </div>';
                           echo $loopattach;
                           }
                           
                           
                           }
                           ?>
                     </div>
                  </section>
               </div>
            </div>
            <div class="COVID <?php if($immun_drop == 'COVID' ){echo 'd-block';}else{echo 'd-none';} ?>" id="covid"  >
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-6 col-12">
                        <label for="covid_id">Date Received</label>
                        <input type="text" name="covid_id" id="covid_id" class="userdatePicker_received" value="<?php if($coviddatereceived){ echo $coviddatereceived;} ?>">
                     </div>
                     <div class="col-md-6 col-12">
                        <label for="covid_id2">Expiration Date</label>
                        <input type="text" name="covid_id2" id="covid_id2" class="userdatePicker_today" value="<?php if($coviddateexpire){ echo $coviddateexpire;} ?>">
                     </div>
                  </div>
                  
                     <section class="filedset attachemnts mt-3">
                     <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                           <div class="row mb-3">
                              <div class="col-lg-10">
                                 <h5 class="mt-0">Upload Proof of Immunization or Titer</h5>
                              </div>
                              <div class="col-lg-2 text-end">
                                 <a id="covid_add_attachment" href="#" class="btn btn-floating healthshield-new" data-type="license"><i class="fal fa-plus"></i></a>
                              </div>
                           </div>
                           <div class="card bg-light mb-2">
                              <div class="card-body">
                                 Have an attachment?  Click the "+" sign above.
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="covid_attachments_lists">
                        <?php
                           $imgs = get_post_meta($mUID,'covid_attachment_id',true);
                           $meta = explode(',', $imgs);
                           $i = 0;
                           
                           foreach ($meta as $metas) {
                           
                           $attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                              $i++;
                           //$count = count($metas);
                           if($attch_name){
                           $loopattach = '<input id="covid_attachments_'.$i.'_id" name="covid_file['.$i.'][id]" type="hidden" value="'.$metas.'">
                           <div class="card form-group">
                           <div class="d-flex attchments_posts"><i class="fal fa-file-image healthshield-green-text"></i>
                           <div class="attchName">'.$attch_name.'</div></div>
                           </div>';
                           echo $loopattach;
                           }
                           
                           }
                           ?>
                     </div>
                  </section>
               </div>
            </div>
            <div class="TB <?php if($immun_drop == 'TB' ){echo 'd-block';}else{echo 'd-none';} ?>" id="tb"  >
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-6 col-12">
                        <label for="tb_id">Date Received</label>
                        <input type="text" name="tb_id" id="tb_id" class="userdatePicker_received" value="<?php if($tbdatereceived){ echo $tbdatereceived;} ?>">
                     </div>
                     <div class="col-md-6 col-12">
                        <label for="tb_id2">Expiration Date</label>
                        <input type="text" name="tb_id2" id="tb_id2" class="userdatePicker_today" value="<?php if($tbdateexpire){ echo $tbdateexpire;} ?>">
                     </div>
                  </div>
                     <section class="filedset attachemnts mt-3">
                     <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                           <div class="row mb-3">
                              <div class="col-lg-10">
                                 <h5 class="mt-0">Upload Proof of Immunization or Titer</h5>
                              </div>
                              <div class="col-lg-2 text-end">
                                 <a id="tb_add_attachment" href="#" class="btn btn-floating healthshield-new" data-type="license"><i class="fal fa-plus"></i></a>
                              </div>
                           </div>
                           <div class="card bg-light mb-2">
                              <div class="card-body">
                                 Have an attachment?  Click the "+" sign above.
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tb_attachments_lists">
                        <?php
                           $imgs = get_post_meta($mUID,'tb_attachment_id',true);
                           $meta = explode(',', $imgs);
                           $i = 0;
                           
                           foreach ($meta as $metas) {
                              
                           $attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                           $i++;
                           //$count = count($metas);
                           if($attch_name){
                           $loopattach = '<input id="tb_attachments_'.$i.'_id" name="tb_file['.$i.'][id]" type="hidden" value="'.$metas.'">
                           <div class="card form-group">
                           <div class="d-flex attchments_posts"><i class="fal fa-file-image healthshield-green-text"></i>
                           <div class="attchName">'.$attch_name.'</div></div>
                           </div>';
                           echo $loopattach;
                           }
                           
                        
                           }
                           ?>
                     </div>
                  </section>
               </div>
            </div>
            <div class="TDAP <?php if($immun_drop == 'TDAP' ){echo 'd-block';}else{echo 'd-none';} ?>" id="tdap" >
               <div class="form-group">
                  <label for="tdap_id">Date Received</label>
                  <input type="text" name="tdap_id" id="tdap_id" class="userdatePicker_received" value="<?php if($tdapdate){ echo $tdapdate;} ?>">
                  <section class="filedset attachemnts mt-3">
                     <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                           <div class="row mb-3">
                              <div class="col-lg-10">
                                 <h5 class="mt-0">Upload Proof of Immunization or Titer</h5>
                              </div>
                              <div class="col-lg-2 text-end">
                                 <a id="tdap_add_attachment" href="#" class="btn btn-floating healthshield-new" data-type="license"><i class="fal fa-plus"></i></a>
                              </div>
                           </div>
                           <div class="card bg-light mb-2">
                              <div class="card-body">
                                 Have an attachment?  Click the "+" sign above.
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tdap_attachments_lists">
                        <?php
                           $imgs = get_post_meta($mUID,'tdap_attachment_id',true);
                           $meta = explode(',', $imgs);
                           $i = 0;
                           
                           foreach ($meta as $metas) {
                           
                           $attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                              $i++;
                           //$count = count($metas);
                           if($attch_name){
                           $loopattach = '<input id="tdap_attachments_'.$i.'_id" name="tdap_file['.$i.'][id]" type="hidden" value="'.$metas.'">
                           <div class="card form-group">
                           <div class="d-flex attchments_posts"><i class="fal fa-file-image healthshield-green-text"></i>
                           <div class="attchName">'.$attch_name.'</div></div>
                           </div>';
                           echo $loopattach;
                           }
                           
                           
                           }
                           ?>
                     </div>
                  </section>
               </div>
            </div>
            <div class="MMR <?php if($immun_drop == 'MMR' ){echo 'd-block';}else{echo 'd-none';} ?>" id="mmr" >
               <div class="form-group">
                  <label for="mmr_id">Date Received</label>
                  <input type="text" name="mmr_id" id="mmr_id" class="userdatePicker_received" value="<?php if($mmrdate){ echo $mmrdate;} ?>">
                  <section class="filedset attachemnts mt-3">
                     <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                           <div class="row mb-3">
                              <div class="col-lg-10">
                                 <h5 class="mt-0">Upload Proof of Immunization or Titer</h5>
                              </div>
                              <div class="col-lg-2 text-end">
                                 <a id="mmr_add_attachment" href="#" class="btn btn-floating healthshield-new" data-type="license"><i class="fal fa-plus"></i></a>
                              </div>
                           </div>
                           <div class="card bg-light mb-2">
                              <div class="card-body">
                                 Have an attachment?  Click the "+" sign above.
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="mmr_attachments_lists">
                        <?php
                           $imgs = get_post_meta($mUID,'mmr_attachment_id',true);
                           $meta = explode(',', $imgs);
                           $i = 0;
                           
                           foreach ($meta as $metas) {
                           
                           $attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                              $i++;
                           //$count = count($metas);
                           if($attch_name){
                           $loopattach = '<input id="mmr_attachments_'.$i.'_id" name="mmr_file['.$i.'][id]" type="hidden" value="'.$metas.'">
                           <div class="card form-group">
                           <div class="d-flex attchments_posts"><i class="fal fa-file-image healthshield-green-text"></i>
                           <div class="attchName">'.$attch_name.'</div></div>
                           </div>';
                           echo $loopattach;
                           }
                          
                           
                           }
                           ?>
                     </div>
                  </section>
               </div>
            </div>

            <div class="IRH <?php if($immun_drop == 'Immunization Record/History' ){echo 'd-block';}else{echo 'd-none';} ?>" id="irh" >
               <div class="form-group">
                  <!-- <label for="irh_id">Date Received</label> -->
                  <!-- <input type="text" name="irh_id" id="irh_id" class="userdatePicker_received" value="<?php if($irhdate){ echo $irhdate;} ?>"> -->
                  <section class="filedset attachemnts mt-3">
                     <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                           <div class="row mb-3">
                              <div class="col-lg-10">
                                 <h5 class="mt-0">Upload Proof of Immunization Record/History</h5>
                              </div>
                              <div class="col-lg-2 text-end">
                                 <a id="irh_add_attachment" href="#" class="btn btn-floating healthshield-new" data-type="license"><i class="fal fa-plus"></i></a>
                              </div>
                           </div>
                           <div class="card bg-light mb-2">
                              <div class="card-body">
                                 Have an attachment?  Click the "+" sign above.
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="irh_attachments_lists">
                        <?php
                           $imgs = get_post_meta($mUID,'irh_attachment_id',true);
                           $meta = explode(',', $imgs);
                           $i = 0;
                           
                           foreach ($meta as $metas) {
                           
                           $attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                              $i++;
                           //$count = count($metas);
                           if($attch_name){
                           $loopattach = '<input id="irh_attachments_'.$i.'_id" name="irh_file['.$i.'][id]" type="hidden" value="'.$metas.'">
                           <div class="card form-group">
                           <div class="d-flex attchments_posts"><i class="fal fa-file-image healthshield-green-text"></i>
                           <div class="attchName">'.$attch_name.'</div></div>
                           </div>';
                           echo $loopattach;
                           }
                           
                           
                           }
                           ?>
                     </div>
                  </section>
               </div>
            </div>

         <div class="otherdoucments <?php if($immun_drop == 'Other Immunizations' ){echo 'd-block';}else{echo 'd-none';} ?>" id="otherdocuments">
            <div class="row">
            <section class="filedset attachemnts mt-3">
                     <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                           <div class="row mb-3">
                              <div class="col-lg-10">
                                 <h5 class="mt-0">Upload Proof of Immunization or Titer</h5>
                              </div>
                              <div class="col-lg-2 text-end">
                                 <a id="other_add_attachment" href="#" class="btn btn-floating healthshield-new" data-type="license"><i class="fal fa-plus"></i></a>
                              </div>
                           </div>
                           <div class="card bg-light mb-2">
                              <div class="card-body">
                                 Have an attachment?  Click the "+" sign above.
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="other_attachments_lists">
                        <?php
                           $imgs = get_post_meta($mUID,'other_attachment_id',true);	                              
                           $meta = explode(',', $imgs);
                           $i = 1;                               
                           foreach ($meta as $metas) {
                           
                           
                           $attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                           //$count = count($metas);
                           
                              $docname = get_post_meta($mUID,'other_doc_name_'.$i,true);
                              if($docname){
                                 $name2 = $docname;
                              }
                              $i++;
                           if($attch_name){
                           $loopattach = '<div class="allattachmentsOther"><input id="other_attachments_'.$i.'_id" name="other_file['.$i.'][id]" type="hidden" value="'.$metas.'">
                           <div class="card form-group">
                           <div class="d-flex attchments_posts"><i class="fal fa-file-image healthshield-green-text"></i>
                           <div class="attachname_with d-flex"><strong>'.$name2.':</strong><div class="attchName"> '.$attch_name.'</div></div></div>
                           </div></div>';
                           echo $loopattach;
                           }
                           
                           
                           }
                           ?>
                     </div>
                  </section>
            </div>
         </div>
         </section>
         <div class="form-group">
            <button  class="btn btn-primary submitFormProfil" name="immunizationsSubmit" id="immunizationsSubmit_2" type="submit">Save Changes</button>
            <a class="btn btn-cancel" href="<?php echo get_site_url(); ?>/profile#immunizations">Cancel</a>
         </div>
      </form>
      <!--------------------------------submit function--------------------------------->
      <?php

      if(isset($_POST['immunizationsSubmit'])){

         $mUID = $_GET['mUID'];
         $dropostid = $_POST['dropId'];
         $hep_id = $_POST['hep_id'];
         $flu_id = $_POST['flu_id'];
         $flu_id2 = $_POST['flu_id2'];
         $varicella_id = $_POST['varicella_id'];
         $covid_id = $_POST['covid_id'];
         $covid_id2 = $_POST['covid_id2'];
         $tb_id = $_POST['tb_id'];
         $tb_id2 = $_POST['tb_id2'];
         $tdap_id = $_POST['tdap_id'];
         $mmr_id = $_POST['mmr_id'];
         //$irh_id = $_POST['irh_id'];
         $otherinput = $_POST['otherinput_id'];


         
      require_once( ABSPATH . 'wp-admin/includes/image.php' );
      require_once( ABSPATH . 'wp-admin/includes/file.php' );
      require_once( ABSPATH . 'wp-admin/includes/media.php' );
      $result = array();

      $hep = $_FILES["hep_file"];
      $flu = $_FILES["flu_file"];
      $varicella = $_FILES["varicella_file"];
      $covid = $_FILES["covid_file"];
      $tb = $_FILES["tb_file"];
      $tdap = $_FILES["tdap_file"];
      $mmr = $_FILES["mmr_file"];
      $irh = $_FILES["irh_file"];
      $other = $_FILES["other_file"];

         if($mUID == '')
         {
      // Add the content of the form to $post as an array
      $postid = wp_insert_post(array(
         'post_title'    => $dropostid,       
         'post_status'   => 'publish',           // Choose: publish, preview, future, draft, etc.
         'post_type' => 'immunizations',
         'meta_input' => array(
         'immunizations_dropdown' => $dropostid,
         'hepatitis_date_received' => $hep_id,
         'flu_date_received' => $flu_id,
         'flu_date_expire' => $flu_id2,
         'varicella_date_recevied' => $varicella_id,
         'covid_date_recevied' => $covid_id,
         'covid_date_expire' => $covid_id2,
         'tb_date_recevied' => $tb_id,
         'tb_date_expire' => $tb_id2,
         'tdap_received' => $tdap_id,
         'mmr_received' => $mmr_id,
         //'irh_received' => $irh_id,

         )  //'post',page' or use a custom post type if you want to
      ));
      //save the new post
   

      for($i=0; $i<=$otherinput; $i++){
         $docname = $_POST['documents_name_id_'.$i];
         if($docname){
            update_post_meta($postid,'other_doc_name_'.$i , $docname);
         }			
         update_post_meta($postid,'other_total_count',$i);
      }
   //Hepatitis B
   if($hep)
   {
   
      foreach ($hep['name'] as $key => $value) 
      {
         if ($hep['name'][$key]) 
         {
            $file = array(
               'name' => $hep['name'][$key],
               'type' => $hep['type'][$key],
               'tmp_name' => $hep['tmp_name'][$key],
               'error' => $hep['error'][$key],
               'size' => $hep['size'][$key]
            );
            $_FILES = array("hep_file" => $file);
            $attachment_id = media_handle_upload("hep_file", $postid );
            $result[] = $attachment_id;     
         }
      }

      $Ids = implode(",",$result);
      $savedAttach = get_post_meta($postid , 'hepatitis_attachment_id', true);	    
      //echo $savedAttach;
      if($savedAttach)
      {
            $new_val = $Ids.','.$savedAttach;
            update_post_meta($postid , 'hepatitis_attachment_id', $new_val); 
      }
      else
      {
         update_post_meta($postid , 'hepatitis_attachment_id', $Ids);   
      }
   }
   //Flu
   if($flu)
   {
   
      foreach ($flu['name'] as $key => $value) 
      {
         if ($flu['name'][$key]) 
         {
            $file2 = array(
               'name' => $flu['name'][$key],
               'type' => $flu['type'][$key],
               'tmp_name' => $flu['tmp_name'][$key],
               'error' => $flu['error'][$key],
               'size' => $flu['size'][$key]
            );
            $_FILES = array("flu_file" => $file2);
            $attachment_id2 = media_handle_upload("flu_file", $postid );
            $result[] = $attachment_id2;     
         }
      }

      $Ids2 = implode(",",$result);
      $savedAttach2 = get_post_meta($postid , 'flu_attachment_id', true);	    
      //echo $savedAttach;
      if($savedAttach2)
      {
            $new_val2 = $Ids2.','.$savedAttach2;
            update_post_meta($postid , 'flu_attachment_id', $new_val2); 
      }
      else
      {
         update_post_meta($postid , 'flu_attachment_id', $Ids2);   
      }
   }
   //Varicella
   if($varicella)
   {

      foreach ($varicella['name'] as $key => $value) 
      {
         if ($varicella['name'][$key]) 
         {
            $file3 = array(
               'name' => $varicella['name'][$key],
               'type' => $varicella['type'][$key],
               'tmp_name' => $varicella['tmp_name'][$key],
               'error' => $varicella['error'][$key],
               'size' => $varicella['size'][$key]
            );
            $_FILES = array("varicella_file" => $file3);
            $attachment_id3 = media_handle_upload("varicella_file", $postid );
            $result[] = $attachment_id3;     
         }
      }

      $Ids3 = implode(",",$result);
      $savedAttach3 = get_post_meta($postid , 'varicella_attachment_id', true);	    
      //echo $savedAttach;
      if($savedAttach3)
      {
            $new_val3 = $Ids3.','.$savedAttach3;
            update_post_meta($postid , 'varicella_attachment_id', $new_val3); 
      }
      else
      {
         update_post_meta($postid , 'varicella_attachment_id', $Ids3);   
      }
   }

   //COVID
   if($covid)
   {

      foreach ($covid['name'] as $key => $value) 
      {
         if ($covid['name'][$key]) 
         {
            $file4 = array(
               'name' => $covid['name'][$key],
               'type' => $covid['type'][$key],
               'tmp_name' => $covid['tmp_name'][$key],
               'error' => $covid['error'][$key],
               'size' => $covid['size'][$key]
            );
            $_FILES = array("covid_file" => $file4);
            $attachment_id4 = media_handle_upload("covid_file", $postid );
            $result[] = $attachment_id4;     
         }
      }

      $Ids4 = implode(",",$result);
      $savedAttach4 = get_post_meta($postid , 'covid_attachment_id', true);	    
      //echo $savedAttach;
      if($savedAttach4)
      {
            $new_val4 = $Ids4.','.$savedAttach4;
            update_post_meta($postid , 'covid_attachment_id', $new_val4); 
      }
      else
      {
         update_post_meta($postid , 'covid_attachment_id', $Ids4);   
      }
   }

   //TB
   if($tb)
   {

      foreach ($tb['name'] as $key => $value) 
      {
         if ($tb['name'][$key]) 
         {
            $file5 = array(
               'name' => $tb['name'][$key],
               'type' => $tb['type'][$key],
               'tmp_name' => $tb['tmp_name'][$key],
               'error' => $tb['error'][$key],
               'size' => $tb['size'][$key]
            );
            $_FILES = array("tb_file" => $file5);
            $attachment_id5 = media_handle_upload("tb_file", $postid );
            $result[] = $attachment_id5;     
         }
      }
      //print_r($result);

      $Ids5 = implode(",",$result);
      $savedAttach5 = get_post_meta($postid , 'tb_attachment_id', true);	    
      //echo $savedAttach;
      if($savedAttach5)
      {
            $new_val5 = $Ids5.','.$savedAttach5;
            update_post_meta($postid , 'tb_attachment_id', $new_val5); 
      }
      else
      {
         update_post_meta($postid , 'tb_attachment_id', $Ids5);   
      }
   }
    //TDAP
    if($tdap)
    {
 
       foreach ($tdap['name'] as $key => $value) 
       {
          if ($tdap['name'][$key]) 
          {
             $file6 = array(
                'name' => $tdap['name'][$key],
                'type' => $tdap['type'][$key],
                'tmp_name' => $tdap['tmp_name'][$key],
                'error' => $tdap['error'][$key],
                'size' => $tdap['size'][$key]
             );
             $_FILES = array("tdap_file" => $file6);
             $attachment_id6 = media_handle_upload("tdap_file", $postid );
             $result[] = $attachment_id6;     
          }
       }
 
       $Ids6 = implode(",",$result);
       $savedAttach6 = get_post_meta($postid , 'tdap_attachment_id', true);	    
       //echo $savedAttach;
       if($savedAttach6)
       {
             $new_val6 = $Ids6.','.$savedAttach6;
             update_post_meta($postid , 'tdap_attachment_id', $new_val6); 
       }
       else
       {
          update_post_meta($postid , 'tdap_attachment_id', $Ids6);   
       }
    }
     //MMR
   if($mmr)
   {

      foreach ($mmr['name'] as $key => $value) 
      {
         if ($mmr['name'][$key]) 
         {
            $file7 = array(
               'name' => $mmr['name'][$key],
               'type' => $mmr['type'][$key],
               'tmp_name' => $mmr['tmp_name'][$key],
               'error' => $mmr['error'][$key],
               'size' => $mmr['size'][$key]
            );
            $_FILES = array("mmr_file" => $file7);
            $attachment_id7 = media_handle_upload("mmr_file", $postid );
            $result[] = $attachment_id7;     
         }
      }

      $Ids7 = implode(",",$result);
      $savedAttach7 = get_post_meta($postid , 'mmr_attachment_id', true);	    
      //echo $savedAttach;
      if($savedAttach7)
      {
            $new_val7 = $Ids7.','.$savedAttach7;
            update_post_meta($postid , 'mmr_attachment_id', $new_val7); 
      }
      else
      {
         update_post_meta($postid , 'mmr_attachment_id', $Ids7);   
      }
   }

   //OTHER
   if($other)
   {

      foreach ($other['name'] as $key => $value) 
      {
         if ($other['name'][$key]) 
         {
            $file8 = array(
               'name' => $other['name'][$key],
               'type' => $other['type'][$key],
               'tmp_name' => $other['tmp_name'][$key],
               'error' => $other['error'][$key],
               'size' => $other['size'][$key]
            );
            $_FILES = array("other_file" => $file8);
            $attachment_id8 = media_handle_upload("other_file", $postid );
            $result[] = $attachment_id8;     
         }
      }

      $Ids8 = implode(",",$result);
      $savedAttach6 = get_post_meta($postid , 'other_attachment_id', true);	    
      //echo $savedAttach;
      if($savedAttach8)
      {
            $new_val8 = $Ids8.','.$savedAttach8;
            update_post_meta($postid , 'other_attachment_id', $new_val8); 
      }
      else
      {
         update_post_meta($postid , 'other_attachment_id', $Ids8);   
      }
   }

   //IRH
   if($irh){

      foreach ($irh['name'] as $key => $value) 
      {
         if ($irh['name'][$key]) 
         {
            $file9 = array(
               'name' => $irh['name'][$key],
               'type' => $irh['type'][$key],
               'tmp_name' => $irh['tmp_name'][$key],
               'error' => $irh['error'][$key],
               'size' => $irh['size'][$key]
            );
            $_FILES = array("irh_file" => $file9);
            $attachment_id9 = media_handle_upload("irh_file", $postid );
            $result[] = $attachment_id9;     
         }
      }

      $Ids9 = implode(",",$result);
      $savedAttach9 = get_post_meta($postid , 'irh_attachment_id', true);      
      //echo $savedAttach;
      if($savedAttach9)
      {
            $new_val9 = $Ids9.','.$savedAttach9;
            update_post_meta($postid , 'irh_attachment_id', $new_val9); 
      }
      else
      {
         update_post_meta($postid , 'irh_attachment_id', $Ids9);   
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

// show all list bottom
$User_Id = get_current_user_id(); 
$args = array(  
   'post_type' => 'immunizations',
   'post_status' => 'publish',
   'author' => $User_Id,
   );
   $loop = new WP_Query( $args ); 
   if ( $loop->have_posts()  ){  
   echo '<ul class="military_display_lists display_lists"> <span><b>Immunizations</b></span>';
   while ( $loop->have_posts() ) : $loop->the_post();
   $postId = get_the_ID();
  
   $immun_drop = get_field('immunizations_dropdown');
   $hepdatereceived = get_field('hepatitis_date_received');
   $fludatereceived = get_field('flu_date_received');
   $fludateexpire = get_field('flu_date_expire');
   $varicelladatereceived = get_field('varicella_date_recevied');
   $coviddatereceived = get_field('covid_date_recevied');
   $coviddateexpire = get_field('covid_date_expire');
   $tbdatereceived = get_field('tb_date_recevied');
   $tbdateexpire = get_field('tb_date_expire');
   $tdapdate = get_field('tdap_received');
   $mmrdate = get_field('mmr_received');
   $irhdate = get_field('irh_received');
   $otherinput = get_post_meta($postId,'other_total_count',true);

   ?>
   <li class="card lists p-2">
       
       <div class="row">
         <?php if($immun_drop == 'Hepatitis B'){ ?>
         <div class="title d-flex">
         <div class="immunzations_state immunzations_split_text">									
         <?php echo $immun_drop; ?>
         <span>Date Received: <?php echo $hepdatereceived; ?></span>
         </div>
         </div>


         <?php }else if($immun_drop == 'Flu'){ ?>
         <div class="title d-flex">
         <div class="immunzations_state immunzations_split_text">									
         <?php echo $immun_drop; ?>	
         <span>Date Received: <?php echo $fludatereceived; ?></span>	
         <span>Expiretion Date: <?php echo $fludateexpire; ?></span>								
         </div>

         </div>

         <?php }else if($immun_drop == 'Varicella'){ ?>
         <div class="title d-flex">
         <div class="immunzations_state immunzations_split_text">									
         <?php echo $immun_drop; ?>
         <span>Date Received: <?php echo $varicelladatereceived; ?></span>		
         </div>

         </div>

         <?php }else if($immun_drop == 'COVID'){ ?>
         <div class="title d-flex">
         <div class="immunzations_state immunzations_split_text">
         <?php echo $immun_drop; ?>	
         <span>Date Received: <?php echo $coviddatereceived; ?></span>	
         <span>Expiretion Date: <?php echo $coviddateexpire; ?></span>		
         </div>

         </div>

         <?php }else if($immun_drop == 'TB'){ ?>
         <div class="title d-flex">
         <div class="immunzations_state immunzations_split_text"> 
         <?php echo $immun_drop; ?>
         <span>Date Received: <?php echo $tbdatereceived; ?></span>	
         <span>Expiretion Date: <?php echo $tbdateexpire; ?></span>		
         </div>

         </div>

         <?php }else if($immun_drop == 'Other Immunizations'){ ?>
         <div class="title d-flex">
         <div class="immunzations_state immunzations_split_text">
         <?php echo $immun_drop; ?>	
         </div>		
         </div>	
         <?php }else if($immun_drop == 'TDAP'){?>
         <div class="title d-flex">
         <div class="immunzations_state immunzations_split_text">
         <?php echo $immun_drop; ?>
         <span>Date Received: <?php echo $tdapdate; ?></span>	
         </div>		
         </div>
        <?php }else if($immun_drop == 'MMR'){ ?>
         <div class="title d-flex">
         <div class="immunzations_state immunzations_split_text">
         <?php echo $immun_drop; ?>	
         <span>Date Received: <?php echo $mmrdate; ?></span>
         </div>		
         </div>
       <?php }else if($immun_drop == 'Immunization Record/History'){ ?>
         <div class="title d-flex">
         <div class="immunzations_state immunzations_split_text">
         <?php echo $immun_drop; ?> 
         <!-- <span>Uploaded <?php //echo $mmrdate; ?></span> -->
         </div>      
         </div>
       <?php } ?>
       </div>
   </li>
   <?php
   endwhile;
   echo '</ul>';
   }
   wp_reset_postdata(); 

}
else
{
   $postid = $mUID;
   $my_post = array(
   'ID'           => $postid,
   'post_title'   => $dropostid,
   );
   wp_update_post( $my_post );
   update_post_meta($mUID, 'immunizations_dropdown', $dropostid);
   update_post_meta($mUID, 'hepatitis_date_received', $hep_id);
   update_post_meta($mUID, 'flu_date_received', $flu_id);
   update_post_meta($mUID, 'flu_date_expire', $flu_id2);
   update_post_meta($mUID, 'varicella_date_recevied', $varicella_id);
   update_post_meta($mUID, 'covid_date_recevied', $covid_id);
   update_post_meta($mUID, 'covid_date_expire', $covid_id2);
   update_post_meta($mUID, 'tb_date_recevied', $tb_id);
   update_post_meta($mUID, 'tb_date_expire', $tb_id2);
   update_post_meta($mUID, 'tdap_received', $tdap_id);	
   update_post_meta($mUID, 'mmr_received', $mmr_id);
   //update_post_meta($mUID, 'irh_received', $irh_id);

   for($i=0; $i<=$otherinput; $i++){
      $docname = $_POST['documents_name_id_'.$i];
      if($docname){
      update_post_meta($mUID,'other_doc_name_'.$i , $docname);
      }
      update_post_meta($mUID,'other_total_count',$i);
   }

      //Hepatitis B
      if($hep)
      {
      
         foreach ($hep['name'] as $key => $value) 
         {
            if ($hep['name'][$key]) 
            {
               $file = array(
                  'name' => $hep['name'][$key],
                  'type' => $hep['type'][$key],
                  'tmp_name' => $hep['tmp_name'][$key],
                  'error' => $hep['error'][$key],
                  'size' => $hep['size'][$key]
               );
               $_FILES = array("hep_file" => $file);
               $attachment_id = media_handle_upload("hep_file", $postid );
               $result[] = $attachment_id;     
            }
         }
   
         $Ids = implode(",",$result);
         $savedAttach = get_post_meta($postid , 'hepatitis_attachment_id', true);	    
         //echo $savedAttach;
         if($savedAttach)
         {
               $new_val = $Ids.','.$savedAttach;
               update_post_meta($postid , 'hepatitis_attachment_id', $new_val); 
         }
         else
         {
            update_post_meta($postid , 'hepatitis_attachment_id', $Ids);   
         }
      }
      //Flu
      if($flu)
      {
      
         foreach ($flu['name'] as $key => $value) 
         {
            if ($flu['name'][$key]) 
            {
               $file2 = array(
                  'name' => $flu['name'][$key],
                  'type' => $flu['type'][$key],
                  'tmp_name' => $flu['tmp_name'][$key],
                  'error' => $flu['error'][$key],
                  'size' => $flu['size'][$key]
               );
               $_FILES = array("flu_file" => $file2);
               $attachment_id2 = media_handle_upload("flu_file", $postid );
               $result[] = $attachment_id2;     
            }
         }
   
         $Ids2 = implode(",",$result);
         $savedAttach2 = get_post_meta($postid , 'flu_attachment_id', true);	    
         //echo $savedAttach;
         if($savedAttach2)
         {
               $new_val2 = $Ids2.','.$savedAttach2;
               update_post_meta($postid , 'flu_attachment_id', $new_val2); 
         }
         else
         {
            update_post_meta($postid , 'flu_attachment_id', $Ids2);   
         }
      }
      //Varicella
      if($varicella)
      {
   
         foreach ($varicella['name'] as $key => $value) 
         {
            if ($varicella['name'][$key]) 
            {
               $file3 = array(
                  'name' => $varicella['name'][$key],
                  'type' => $varicella['type'][$key],
                  'tmp_name' => $varicella['tmp_name'][$key],
                  'error' => $varicella['error'][$key],
                  'size' => $varicella['size'][$key]
               );
               $_FILES = array("varicella_file" => $file3);
               $attachment_id3 = media_handle_upload("varicella_file", $postid );
               $result[] = $attachment_id3;     
            }
         }
   
         $Ids3 = implode(",",$result);
         $savedAttach3 = get_post_meta($postid , 'varicella_attachment_id', true);	    
         //echo $savedAttach;
         if($savedAttach3)
         {
               $new_val3 = $Ids3.','.$savedAttach3;
               update_post_meta($postid , 'varicella_attachment_id', $new_val3); 
         }
         else
         {
            update_post_meta($postid , 'varicella_attachment_id', $Ids3);   
         }
      }
   
      //COVID
      if($covid)
      {
   
         foreach ($covid['name'] as $key => $value) 
         {
            if ($covid['name'][$key]) 
            {
               $file4 = array(
                  'name' => $covid['name'][$key],
                  'type' => $covid['type'][$key],
                  'tmp_name' => $covid['tmp_name'][$key],
                  'error' => $covid['error'][$key],
                  'size' => $covid['size'][$key]
               );
               $_FILES = array("covid_file" => $file4);
               $attachment_id4 = media_handle_upload("covid_file", $postid );
               $result[] = $attachment_id4;     
            }
         }
   
         $Ids4 = implode(",",$result);
         $savedAttach4 = get_post_meta($postid , 'covid_attachment_id', true);	    
         //echo $savedAttach;
         if($savedAttach4)
         {
               $new_val4 = $Ids4.','.$savedAttach4;
               update_post_meta($postid , 'covid_attachment_id', $new_val4); 
         }
         else
         {
            update_post_meta($postid , 'covid_attachment_id', $Ids4);   
         }
      }
   
      //TB
      if($tb)
      {
   
         foreach ($tb['name'] as $key => $value) 
         {
            if ($tb['name'][$key]) 
            {
               $file5 = array(
                  'name' => $tb['name'][$key],
                  'type' => $tb['type'][$key],
                  'tmp_name' => $tb['tmp_name'][$key],
                  'error' => $tb['error'][$key],
                  'size' => $tb['size'][$key]
               );
               $_FILES = array("tb_file" => $file5);
               $attachment_id5 = media_handle_upload("tb_file", $postid );
               $result[] = $attachment_id5;     
            }
         }
   
         $Ids5 = implode(",",$result);
         $savedAttach5 = get_post_meta($postid , 'tb_attachment_id', true);	    
         //echo $savedAttach;
         if($savedAttach5)
         {
               $new_val5 = $Ids5.','.$savedAttach5;
               update_post_meta($postid , 'tb_attachment_id', $new_val5); 
         }
         else
         {
            update_post_meta($postid , 'tb_attachment_id', $Ids5);   
         }
      }
   //TDAP
   if($tdap)
   {

      foreach ($tdap['name'] as $key => $value) 
      {
         if ($tdap['name'][$key]) 
         {
            $file6 = array(
               'name' => $tdap['name'][$key],
               'type' => $tdap['type'][$key],
               'tmp_name' => $tdap['tmp_name'][$key],
               'error' => $tdap['error'][$key],
               'size' => $tdap['size'][$key]
            );
            $_FILES = array("tdap_file" => $file6);
            $attachment_id6 = media_handle_upload("tdap_file", $postid );
            $result[] = $attachment_id6;     
         }
      }

      $Ids6 = implode(",",$result);
      $savedAttach6 = get_post_meta($postid , 'tdap_attachment_id', true);	    
      //echo $savedAttach;
      if($savedAttach6)
      {
            $new_val6 = $Ids6.','.$savedAttach6;
            update_post_meta($postid , 'tdap_attachment_id', $new_val6); 
      }
      else
      {
         update_post_meta($postid , 'tdap_attachment_id', $Ids6);   
      }
   }
    //MMR
  if($mmr)
  {

     foreach ($mmr['name'] as $key => $value) 
     {
        if ($mmr['name'][$key]) 
        {
           $file7 = array(
              'name' => $mmr['name'][$key],
              'type' => $mmr['type'][$key],
              'tmp_name' => $mmr['tmp_name'][$key],
              'error' => $mmr['error'][$key],
              'size' => $mmr['size'][$key]
           );
           $_FILES = array("mmr_file" => $file7);
           $attachment_id7 = media_handle_upload("mmr_file", $postid );
           $result[] = $attachment_id7;     
        }
     }

     $Ids7 = implode(",",$result);
     $savedAttach7 = get_post_meta($postid , 'mmr_attachment_id', true);	    
     //echo $savedAttach;
     if($savedAttach7)
     {
           $new_val7 = $Ids7.','.$savedAttach7;
           update_post_meta($postid , 'mmr_attachment_id', $new_val7); 
     }
     else
     {
        update_post_meta($postid , 'mmr_attachment_id', $Ids7);   
     }
  }
  //OTHER
  if($other)
  {

     foreach ($other['name'] as $key => $value) 
     {
        if ($other['name'][$key]) 
        {
           $file8 = array(
              'name' => $other['name'][$key],
              'type' => $other['type'][$key],
              'tmp_name' => $other['tmp_name'][$key],
              'error' => $other['error'][$key],
              'size' => $other['size'][$key]
           );
           $_FILES = array("other_file" => $file8);
           $attachment_id8 = media_handle_upload("other_file", $postid );
           $result[] = $attachment_id8;     
        }
     }

     $Ids8 = implode(",",$result);
     $savedAttach6 = get_post_meta($postid , 'other_attachment_id', true);	    
     //echo $savedAttach;
     if($savedAttach8)
     {
           $new_val8 = $Ids8.','.$savedAttach8;
           update_post_meta($postid , 'other_attachment_id', $new_val8); 
     }
     else
     {
        update_post_meta($postid , 'other_attachment_id', $Ids8);   
     }
  }

$url = get_site_url().'/profile/';
wp_redirect($url);
exit;

}




} 



?>


   </div>
</div>
</div>




<?php
get_footer('dashboard');
}else{
header('Location: ' . get_permalink(1310));
}
?>

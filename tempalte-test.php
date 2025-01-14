<?php 
if(is_user_logged_in()){
/*
* Template Name: Test page
*/
get_header('dashboard');
echo get_template_part( 'template-headers/sidebar-dashboard' );

$uid = get_current_user_id();
$shareid = $_GET['shareid'];
$shid = $_GET['shid'];

$current_user = wp_get_current_user();

$first_name = $current_user->first_name;
$last_name =  $current_user->last_name;
$fullname = $first_name.' '.$last_name;


$reciptname = get_field('receipt_name',$shareid);
$shareemail = get_field('shares_email',$shareid);
$shareoverview = get_field('share_level_overview',$shareid);
$sharefull = get_field('share_level_full',$shareid);
$sharenote = get_field('private_note',$shareid);
$sharemsg = get_field('personal_message',$shareid);
$share_status = get_field('share_status',$shareid);



/***********************get certifications attachment url*****************************/
$args=array(
  'post_type' => 'certifications',
  'post_status' => 'published',
  'posts_per_page' => -1,
  'author' => $uid
);                       

   $wp_query = new WP_Query($args);
   $certi_array=array();
//print_r($certi_array);
while( $wp_query->have_posts() ) : $wp_query->the_post(); 


$key_1_value = get_post_meta( $wp_query->post->ID, 'certificate_attachment_id', true );
//echo "****".$key_1_value."****"; 
array_push($certi_array,$key_1_value);
endwhile;
//print_r($certi_array);
$new_certi=array();
$str1 = ""; 

foreach($certi_array as $k => $v){
if($v != ""){
  $var=$v.',';
  $str1 .=$var;
}
  
  //array_push($new_certi,$v);
  //$str = implode(",", $v);
}
$str_arr = explode (",", $str1); 
$str2 = ""; 
foreach($str_arr as $key => $val){
if($val != ""){
$url=wp_get_attachment_url($val).',';
$str2 .=$url;
}
}  
//echo $str2;
/***********************get licences attachment url*****************************/
$args2=array(
  'post_type' => 'licenses',
  'post_status' => 'published',
  'posts_per_page' => -1,
  'author' => $uid
);                       

   $wp_query2 = new WP_Query($args2);
   $certi_array2=array();

while( $wp_query2->have_posts() ) : $wp_query2->the_post(); 

$key_1_value2 = get_post_meta( $wp_query2->post->ID, 'license_attachment_id', true );

array_push($certi_array2,$key_1_value2);
endwhile;
//print_r($certi_array2);
$new_certi2=array();
$str1_2 = ""; 

foreach($certi_array2 as $k2 => $v2){
if($v2 != ""){
  $var2=$v2.',';
   $str1_2 .=$var2;
}
 
 
}
$str_arr2 = explode (",", $str1_2); 
//print_r($str_arr2);die();
foreach($str_arr2 as $key => $val){
if($val != ""){
$url2=wp_get_attachment_url($val).',';
$str2 .=$url2;
}
}  


/***********************get education attachment url*****************************/
$args3=array(
  'post_type' => 'education',
  'post_status' => 'published',
  'posts_per_page' => -1,
  'author' => $uid
);                       

   $wp_query3 = new WP_Query($args3);
   $certi_array3=array();

while( $wp_query3->have_posts() ) : $wp_query3->the_post(); 

$key_value3 = get_post_meta( $wp_query3->post->ID, 'education_attachment_id', true );

array_push($certi_array3,$key_value3);
endwhile;
//print_r($certi_array3);
$new_certi3=array();
$str_3 = ""; 

foreach($certi_array3 as $k3 => $v3){
if($v3 != ""){
  $var3=$v3.',';
  $str_3 .=$var3;
}
  
 
}
$str_arr3 = explode (",", $str_3); 
//print_r($str_arr2);die();
foreach($str_arr3 as $key => $val){
if($val != ""){
$url3=wp_get_attachment_url($val).',';
$str2 .=$url3;
}
}  
//echo $str2;

/***********************get immunizations attachment url*****************************/
$args4=array(
  'post_type' => 'immunizations',
  'post_status' => 'published',
  'posts_per_page' => -1,
  'author' => $uid
);                       

   $wp_query4 = new WP_Query($args4);
   $certi_array4=array();

while( $wp_query4->have_posts() ) : $wp_query4->the_post(); 

$key_value4 = get_post_meta( $wp_query4->post->ID, 'hepatitis_attachment_id', true );

array_push($certi_array4,$key_value4);
endwhile;
//print_r($certi_array4);
$new_certi4=array();
$str_4 = ""; 

foreach($certi_array4 as $k4 => $v4){
if($v4 != ""){
  $var4=$v4.',';
  $str_4 .=$var4;
} 
}
//echo $str_4;die();
$str_arr4 = explode (",", $str_4); 
//print_r($str_arr4);die();
foreach($str_arr4 as $key => $val){
if($val != ""){
$url4=wp_get_attachment_url($val).',';
$str2 .=$url4;
}
}  



/***********************get skills-checklist attachment url*****************************/
$args5=array(
  'post_type' => 'skills-checklists',
  'post_status' => 'published',
  'posts_per_page' => -1,
  'author' => $uid
);                       

   $wp_query5 = new WP_Query($args5);
   $certi_array5=array();

while( $wp_query5->have_posts() ) : $wp_query5->the_post(); 

$key_value5 = get_post_meta( $wp_query5->post->ID, 'skills_attachment_id', true );

array_push($certi_array5,$key_value5);
endwhile;
//print_r($certi_array4);
$new_certi5=array();
$str_5 = ""; 

foreach($certi_array5 as $k5 => $v5){
if($v5 != ""){
  $var5=$v5.',';
  $str_5 .=$var5;
} 
}

$str_arr5 = explode (",", $str_5); 

foreach($str_arr5 as $key5 => $val5){
if($val5 != ""){
$url5=wp_get_attachment_url($val5).',';
$str2 .=$url5;
}
}  



/***********************get insurance attachment url*****************************/
$args6=array(
  'post_type' => 'insurance',
  'post_status' => 'published',
  'posts_per_page' => -1,
  'author' => $uid
);                       

   $wp_query6 = new WP_Query($args6);
   $certi_array6=array();

while( $wp_query6->have_posts() ) : $wp_query6->the_post(); 

$key_value6 = get_post_meta( $wp_query6->post->ID, 'insu_attachment_id', true );

array_push($certi_array6,$key_value6);
endwhile;
//print_r($certi_array4);
$new_certi6=array();
$str_6 = ""; 

foreach($certi_array6 as $k6 => $v6){
if($v6 != ""){
  $var6=$v6.',';
  $str_6 .=$var6;
} 
}

$str_arr6 = explode (",", $str_6); 

foreach($str_arr6 as $key6 => $val6){
if($val6 != ""){
$url6 =wp_get_attachment_url($val6).',';
$str2 .=$url6;
}
}  
//echo $str2;


/***********************get references attachment url*****************************/
$args7=array(
  'post_type' => 'references',
  'post_status' => 'published',
  'posts_per_page' => -1,
  'author' => $uid
);                       

   $wp_query7 = new WP_Query($args7);
   $certi_array7=array();

while( $wp_query7->have_posts() ) : $wp_query7->the_post(); 

$key_value7 = get_post_meta( $wp_query7->post->ID, 'refrences_attachment_id', true );

array_push($certi_array7,$key_value7);
endwhile;
//print_r($certi_array4);
$new_certi7=array();
$str_7 = ""; 

foreach($certi_array7 as $k7 => $v7){
if($v7 != ""){
  $var7=$v7.',';
  $str_7 .=$var7;
} 
}

$str_arr7 = explode (",", $str_7); 

foreach($str_arr7 as $key7 => $val7){
if($val7 != ""){
$url7 =wp_get_attachment_url($val7).',';
$str2 .=$url7;
}
}  
//echo $str2;

/***********************get military attachment url*****************************/
$args8=array(
  'post_type' => 'military',
  'post_status' => 'published',
  'posts_per_page' => -1,
  'author' => $uid
);                       

   $wp_query8 = new WP_Query($args8);
   $certi_array8=array();

while( $wp_query8->have_posts() ) : $wp_query8->the_post(); 

$key_value8 = get_post_meta( $wp_query8->post->ID, 'military_attachment_id', true );

array_push($certi_array8,$key_value8);
endwhile;
//print_r($certi_array4);
$new_certi8=array();
$str_8 = ""; 

foreach($certi_array8 as $k8 => $v8){
if($v8 != ""){
  $var8=$v8.',';
  $str_8 .=$var8;
} 
}

$str_arr8 = explode (",", $str_8); 

foreach($str_arr8 as $key8 => $val8){
if($val8 != ""){
$url8 =wp_get_attachment_url($val8).',';
$str2 .=$url8;
}
}  
//echo $str2;


/***********************get additional-documents attachment url*****************************/
$args9=array(
  'post_type' => 'additional-documents',
  'post_status' => 'published',
  'posts_per_page' => -1,
  'author' => $uid
);                       

   $wp_query9 = new WP_Query($args9);
   $certi_array9=array();

while( $wp_query9->have_posts() ) : $wp_query9->the_post(); 

$key_value9 = get_post_meta( $wp_query9->post->ID, 'document_attachment_id', true );

array_push($certi_array9,$key_value9);
endwhile;
//print_r($certi_array4);
$new_certi9=array();
$str_9 = ""; 

foreach($certi_array9 as $k9 => $v9){
if($v9 != ""){
  $var9 = $v9.',';
  $str_9 .=$var9;
} 
}

$str_arr9 = explode (",", $str_9); 

foreach($str_arr9 as $key9 => $val9){
if($val9 != ""){
$url9 =wp_get_attachment_url($val9).',';
$str2 .=$url9;
}
}  
//echo $str2;
//$asd = explode(',', $str2);
//echo '<pre>';
//print_r($asd);


?>
<div class="content profile_content">
    <div class="container pt-5 ps-5 pe-5 pb-1">
        <div class="row">
          <form id="sharenew" class="sharenew" method="post" enctype="multipart/form-data" autocomplete="off" >

                <input type="hidden" name="shareid" value="<?php echo $shareid; ?>" id="shareid">
                <input type ="hidden" value="<?php echo $shid; ?>" name="shid" id="shid">

            <div class="row">
              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label for="profile_recipient_id">Name of Recipient</label>
                  <input type="text" name="recipientname" required class="" id="profile_recipient_id" value="<?php echo $reciptname; ?>">
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-sm-12"></div>
            </div>
                <fieldset id="delivery_method" class="mt-4">
                <legend class="h5">Delivery Method</legend>

                <div class="form-group">
                  <div class="custom-control custom-radio">
                    <input  class="custom-control-input" id="profile_share_delivery_method_email" name="profile_share_delivery_method" phx-click="change_delivery_method" type="radio" value="email" <?php if($emailcheckbox == 'email'){echo 'checked';}else if($linkcheckbox == 'link'){ echo ''; }else{echo 'checked';} ?>>
                    <label class="custom-control-label" for="profile_share_delivery_method_email">Email</label>
                  </div>
                  <?php if($linkcheckbox == 'link'){ ?>
                      
                    <?php }else { ?>
                    <div class="form-group d-block email_input">
                        <label for="profile_share_email">Email Address of Recipient</label>
                        <input autocapitalize="none" class="form-control" id="profile_share_email" name="profile_share_email" type="email" value="<?php echo $shareemail; ?>" required>
                        <span class="alert-danger showmail_msg"></span>                      
                      </div>

                    <?php  } ?>
                </div>


                <div class="form-group">
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" id="profile_share_delivery_method_link" name="profile_share_delivery_method" phx-click="change_delivery_method" type="radio" value="link" <?php if($linkcheckbox == 'link'){echo 'checked';}else if(
                        $emailcheckbox == 'email'){echo '';}?>>
                    <label class="custom-control-label" for="profile_share_delivery_method_link">Link Only (I’ll copy/paste myself)</label>
                  </div>
                </div>
                </fieldset>

                <fieldset id="share_level" class="mt-4">
                <legend class="h5">Share Level</legend>

                <div class="form-group">
                  <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" id="profile_share_level_overview" name="profile_share_level" type="radio" value="overview"  <?php if($shareoverview == 'overview'){ echo 'checked';}else if($sharefull == 'full'){echo '';}else{ echo 'checked';} ?>>
                        <label class="custom-control-label" for="profile_share_level_overview">
                        <span class="label-text d-inline-block">
                          Overview
                        </span>

                        <a href="#" class="inline-help-trigger pl-2" data-toggle="modal" data-target="#overview_explanation_modal">
                          <i class="fal fa-question-circle"></i>
                        </a>
                        </label>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" id="profile_share_level_full" name="profile_share_level" type="radio" value="full" <?php if($sharefull == 'full'){ echo 'checked';}else if($shareoverview == 'overview'){ echo '';} ?>>
                        <label class="custom-control-label" for="profile_share_level_full">
                         <span class="label-text d-inline-block">
                          Full
                        </span>

                        <a href="#" class="inline-help-trigger pl-2" data-toggle="modal" data-target="#full_explanation_modal">
                          <i class="fal fa-question-circle"></i>
                        </a>
                        </label>
                    </div>
                  </div>
                </div>
                </fieldset>

                <fieldset id="private_note" class="mt-4">
                <legend class="h5 mb-0">Private Note (optional)</legend>

                  <div class="form-group">
                    <textarea class="form-control character-counter" data-length="500" id="profile_share_private_note" name="profile_share_private_note"><?php echo $sharenote; ?></textarea>

                    <small class="form-text text-muted">
                      You meet a lot of people in this line of work. Jot down your own private
                      reminders — who they are, where you met, why you should stay in touch, etc.
                    </small>
                  </div>

                </fieldset>

                <section class="message-form mt-5 mb-4 d-block msg_personal">
                <header class="mb-4">
                  <div class="fancy-heading">
                    <h2>Add a personal message if you'd like</h2>
                  </div>
                </header>

                <div class="form-group">
                    <label for="profile_share_personal_message">Personal Message (optional)</label>
                    <textarea class="form-control" id="profile_share_personal_message" name="profile_share_personal_message"><?php if($sharemsg){echo $sharemsg;}else{} ?> </textarea>
                   <small class="form-text text-muted">
                    Include a personal message to build a faster connection.
                  </small>
                </div>
                </section>

                <div class="form-group">

                <button class="btn btn-primary send_profile" name="shareprofileform" id="shareprofileform" type="submit">
                    <?php if($emailcheckbox){?>
                    <i class="fad fa-paper-plane"></i>
                   <?php }else if($linkcheckbox){ ?>
                     <i class="fad fa-link"></i>
                  <?php }else{ ?>
                     <i class="fad fa-paper-plane"></i>
                 <?php  } ?> Send Profile Now
                </button>

                <a class="cancle_link" href="/profile/share">Cancel</a>
                </div>
          </form>
        </div>
    </div>
</div><?php 
$time = date("Y_m_d_H_i_s");

//echo $str2;
$files123 = array('https://healthshieldcredentialing.com/wp-content/uploads/2022/04/shop_ss.png','https://healthshieldcredentialing.com/wp-content/uploads/2022/05/dummy-1-6.jpg','https://healthshieldcredentialing.com/wp-content/uploads/2022/05/woman-1.webp',);
//echo '<pre>';
//print_r($files123);
//echo '<br><br><br>';
//print_r($array_final);
//$arr234 = array_values($array_final);

    //$files = array();
   //explode(',', $str2);
   $files = array($str2);

   $myfiles = explode(',', $files);
   //print_r($myfiles);
   //die();
    # create new zip opbject
    //$zip = new ZipArchive();
    //$zipname = 'attachments_'.$time.'.zip';
    # create a temp file & open it
    //$tmp_file = tempnam('.','');
    //echo $tmp_file;die();
    //$zip->open($zipname, ZIPARCHIVE::CREATE);
  
    //foreach($myfiles as $nFiles)
    // {
    	
    // 	echo $nFiles.'<br>';
    // 	$download_file = file_get_contents($nFiles);
    // 	//$zip->addFromString(basename($nFiles),$download_file);
    // }
    $zip = new ZipArchive();
    $zipname = 'attachments_'.$time.'.zip';
    $zip->open($zipname, ZipArchive::CREATE);
    foreach($myfiles as $nFiles)
     {
    	
    	echo $nFiles.'<br>';
    	$download_file = file_get_contents($nFiles);
    	$zip->addFromString(basename($nFiles),$download_file);
      }
    
  	 $zip->close();
  
die();
   
    # close zip
   

    # send the file to the browser as a download
    header('Content-disposition: attachment; filename='.$zipname);
    header('Content-type: application/zip');
    readfile($zipname);
   
    //header('Content-Type: application/zip');
    //header("Content-Disposition: attachment; filename=" . $zipname);
    //header('Content-Length: ' . filesize($zipname));
    //header("Location: " . $zipname);
    //rename($zipname, "wp-content/uploads/2022/05/".$zipname);
    //move_uploaded_file($tmpName, "wp-content/uploads/2022/05/" . $zipname);
//echo readfile($tmp_file);

//print_r($tmp_file);
//unlink($tmp_file);


if(isset($_POST['shareprofileform'])){
// $time = date("Y_m_d_H_i_s");
// $zipname = 'attachments_'.$time.'.zip';
// $zip = new ZipArchive();

// # create a temp file & open it
// //$tmp_file = tempnam('.', '');
// $zip->open($zipname, ZipArchive::CREATE);

// # loop through each file
// foreach ($array_final as $file) {
//     # download file
//     $download_file = file_get_contents($file);

//     #add it to the zip
//     $zip->addFromString(basename($file), $download_file);
// }
// $zip->close();
// header('Content-Type: application/zip');
// header("Content-Disposition: attachment; filename=" . $zipname);
// header('Content-Length: ' . filesize($zipname));



    // // (A) LOAD EXISTING ZIP ARCHIVE
    // $time = date("Y_m_d_H_i_s");

    // $zipname = 'attachments_'.$time.'.zip';

    // $zip = new ZipArchive();
    // if ($zip->open($zipname, ZipArchive::CREATE) === true) {
    //   foreach ($array_final as $file) {
    //   // (C) ADD FILE INTO FOLDER IN ZIP
    //   $zip->addFile($zipname, "/wp_content/uploads/mailattachments/".$zipname);
        
    //   }
    // // (D) CLOSE ZIP
    // $zip->close()
    //   ? "Zip archive closed" : "Error closing zip archive" ;
    // }

    // // (E) FAILED TO OPEN/CREATE ZIP FILE
    // else { echo "Failed to open/create $zipname"; }



    $reciptname = $_POST['recipientname'];
    $sharemethod = $_POST['profile_share_delivery_method'];
    //$sharemail = $_POST['profile_share_email'];
    $sharelevel = $_POST['profile_share_level'];
    $privatenote = $_POST['profile_share_private_note'];
    $persoanlmsg = $_POST['profile_share_personal_message'];
    $shareId = $_POST['shareid'];
    $satusshare = $_POST['satusshare'];

    if($sharemethod == 'email'){
        $sharemail = $_POST['profile_share_email'];
    }else{
      
    }

        if($sharemethod == 'email'){
        $emailmethod = 'email';

        }else{
           $emailmethod = ''; 
        }

        if($sharemethod == 'link'){
        $emailmethod2 = 'link';

        }else{
              $emailmethod2 = '';

        }

        if( $sharelevel == 'full'){
        $method = 'full';
        }else{
        $method = '';
        }
        if($sharelevel == 'overview'){
        $method2 = 'overview';
        }else{
        $method2 = ''; 
        }


   $args = array(
    'post_type' => 'my-shares',
    'post_status'      => 'publish',
    'meta_query' => array(
        array(
            'key'     => 'shares_email',
            'value'   => $sharemail,
            'compare' => '==',
        ),
    ),
);

 $enterprise_posts = get_posts( $args );

if ($enterprise_posts){ 
echo'<script>jQuery(".showmail_msg").text("You have already shared this profile to this email address");jQuery(".alert-danger").addClass("show");</script>';  
  exit; 
}else { 


    if($shareId == '')
    {
    $postid = wp_insert_post(array (
       'post_type' => 'my-shares',
       'post_title' => $reciptname,
       'post_status' => 'publish',
       'meta_input' => array(
          'receipt_name' => $reciptname,
          'shares_email' => $sharemail,
          'share_level_overview' => $method2,
          'share_level_full' => $method,
          'private_note' => $privatenote,
          'personal_message' => $persoanlmsg,
          'share_status' => $satusshare,
          'check_email_box' => $emailmethod,
          'check_link_box' => $emailmethod2,
          
        ),
    ));

    echo "<script> 
    Swal.fire({
      title: 'success!',
      text: 'Profile Sent!',
      icon: 'success',
      showConfirmButton: true,
      allowOutsideClick: true,
      allowEscapeKey: false,
      confirmButtonColor: '#40BFB9',
      });
    </script>";



    $sharedid = $postid; 
    $to = $sharemail;

    if($persoanlmsg == ''){  
     
    }else{
      $msg = '<tr>
      <td>
        <span style="font-weight: bold; color: #40BFB9">
          A personal message from '.$first_name.':
        </span>
        <span>
        '.$persoanlmsg.'
        </span>
      </td>
    </tr>';
    }

    if($privatenote){
      $note = ' <tr>
      <td>
        <span style="font-weight: bold; color: #40BFB9">
          A Private note from '.$first_name.':
        </span>
        <span>
        '.$privatenote.'
        </span>
      </td>
    </tr>';
    }else{

    }

    $subject = $fullname.' shared their profile.';

    $body = '<html><body style="background:#efefef;">';
    $body .= '<table cellspacing="0" cellpadding="20" style="font-size: 14px; font-family: sans-serif">';
    $body .= '<tbody><tr>
        <td style="font-size: 18px; font-weight: bold; color: #40BFB9;">
    '.$fullname.' invited you to view their HealthShield Credentialing profile!
        </td>
      </tr>

      <tr>
        <td>
          Within their profile you can view desired job preferences, qualifications
          and professional history, and securely download documentation for onboarding
          (licenses, certs, medical history records, skills checklists, and more).
        </td>
      </tr>

      <tr>
        <td>
          <table cellspacing="0" cellpadding="10" style="font-size: 12px">
            <tbody><tr>
              <td bgcolor="#40BFB9" style="color: #fff">
                <a href="'.get_site_url().'/profile/shared/?shid='.$sharedid.'" style="text-decoration: none; color: rgba(255, 255, 255, 1); font-family: sans-serif">
                  View HealthShield Credentialing Profile
                </a>
              </td>
              <td></td>
            </tr>
          </tbody></table>
        </td>
      </tr>
     '.$msg.'
     <br>
     '.$note.'
      <tr>
        <td>
          To contact '.$first_name.', view their contact
          information within the Personal Information section, or simply reply to
          this email. Have questions about HealthShield Credentialing?
          <a href="'.get_site_url().'/contact-us/" style="color: #40BFB9;">Learn about our employer platform here.</a>
        </td>
      </tr>

      <tr>
        <td bgcolor="#e8e8e8" style="word-break: break-all">
          <span style="color: rgba(140, 140, 140, 1)">
            If the above link does not work, you may copy and paste the following url into your favorite web browser:
          </span>
          <br>
          '.get_site_url().'/profile/shared/?shid='.$sharedid.'
        </td>
      </tr>
    </tbody>
    </table></body></html>';        
    $headers = array(); 
    $headers[] = 'From: Profile Share from HealthShield Credentialing <hscredentialing@gmail.com>';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    // $attachments = array(WP_CONTENT_DIR . '/uploads/mailattachments/'.$zipname);
    $emailsent = wp_mail($to, $subject, $body, $headers);
    // if($method2){
    //   //$emailsent = wp_mail($to, $subject, $body, $headers);
    // }else if($method){
    //   //$emailsent = wp_mail($to, $subject, $body, $headers, $attachments);
    // }
    return $emailsent;

    }
    else
    {
    $postid = $shareId;
    $my_post = array(
      'ID'           => $postid,
      'post_title'   => $reciptname,
        );
        wp_update_post( $my_post );
        update_post_meta($shareId, 'receipt_name', $reciptname);
        update_post_meta($shareId, 'shares_email', $sharemail);
        update_post_meta($shareId, 'share_level_overview', $method2);
        update_post_meta($shareId, 'share_level_full', $method);
        update_post_meta($shareId, 'private_note', $privatenote);
        update_post_meta($shareId, 'personal_message', $persoanlmsg);
        update_post_meta($shareId, 'share_status', $satusshare);
        update_post_meta($shareId, 'check_email_box', $emailmethod);
        update_post_meta($shareId, 'check_link_box', $emailmethod2);
          
    $url = get_permalink(842);
    wp_redirect( $url );
    exit;
    }
       
}

}                       

?>
<?php
get_footer('dashboard');
}else{
  header('Location: ' . get_permalink(1310));
}
?>
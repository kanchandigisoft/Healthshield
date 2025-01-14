<?php
if(is_user_logged_in()){
/*
* Template Name: Insurance
*/
get_header('dashboard');

echo get_template_part( 'template-headers/sidebar-dashboard' );
$inid = $_GET['inid'];
$liability_lists = get_field('liability_insurance',$inid);
$insucompany = get_field('insurance_company',$inid);
$insuaddress = get_field('address_insurance',$inid);
$insuphnnumber = get_field('insurance_phone_number',$inid);
$started_month = get_field('insurance_started_month',$inid);
$started_year = get_field('insurance_started_year',$inid);
$enddate_month = get_field('insurance_ended_month',$inid);
$enddate_year = get_field('insurance_ended_year',$inid);

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
<div class="content insurance_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
        <form name="insuranceform" id="insuranceform" method="post" enctype="multipart/form-data" autocomplete="off">
             <input type="hidden" id="inid_id" name="inid_id" value=" <?php echo $inid; ?>">
             <section class="filedset formlists mb-3">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <label for="liability_lists_id">Document Name</label>
                            <input type="text" name="liability_lists_id" id="liability_lists_id" class="liability_lists_cl" value="<?php if($liability_lists){ echo $liability_lists;} ?>">
                        </div>
                    </div>
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <label for="liability_insucom_id">Insurance Company</label>
                            <input type="text" name="liability_insucom_id" id="liability_insucom_id" class="liability_insucom_cl" value="<?php if($insucompany){ echo $insucompany;} ?>">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="liability_address_id">Address</label>
                            <input type="text" name="liability_address_id" id="liability_address_id" class="liability_address_cl" value="<?php if($insuaddress){ echo $insuaddress;} ?>">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="liability_phnnumber_id">Phone Number</label>
                            <input type="tel" name="liability_phnnumber_id" id="liability_phnnumber_id" class="liability_phnnumber_cl" value="<?php if($insuphnnumber){ echo $insuphnnumber;} ?>">
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="started_month_year">Issue date(Optional)</label>
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
                            <label for="ended_month_year">Expire Date</label>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <select name="endedmonth" id="ened_month_year" class="ended_month">
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
                                    <select name="endedyear" id="ended_month_year" class="ended_year">
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
                    </div>
                </div>
            </section>
            <section class="filedset attachemnts">
				
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                   <div class="row mb-3">
                       <div class="col-lg-10">
                           <h5 class="mt-0">Attachments</h5>
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
                   $imgs = get_post_meta($inid,'insurance_attachment_id',true);
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
            <div class="form-group mt-3">
				<button class="btn btn-primary submitFormProfil" name="insurancesubmit" id="insurancesubmit" type="submit">Save Changes</button>
				<a class="btn btn-cancel" href="<?php echo get_site_url(); ?>/profile#insurance">Cancel</a>
			</div>
        </form>
        <?php 
        if(isset($_POST['insurancesubmit'])){

            $inid = $_GET['inid'];

            $liability_lists_id = $_POST['liability_lists_id'];
            $liability_insucom_id = $_POST['liability_insucom_id'];
            $liability_address_id = $_POST['liability_address_id'];
            $liability_phnumber_id = $_POST['liability_phnnumber_id'];
            $startedmonth = $_POST['startedmonth'];
            $startedyear = $_POST['startedyear'];
            $endedmonth = $_POST['endedmonth'];
            $endedyear = $_POST['endedyear'];


        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );
        $result = array();
        
        if($inid == '')
        {

                $postid = wp_insert_post(array (
                'post_type' => 'insurance',
                'post_title' => $liability_lists_id,
                'post_status' => 'publish',
                'meta_input' => array(
                'liability_insurance' => $liability_lists_id,  
                'insurance_company' => $liability_insucom_id,  
                'address_insurance' => $liability_address_id,  
                'insurance_phone_number' => $liability_phnumber_id,  
                'insurance_started_month' => $startedmonth,  
                'insurance_started_year' => $startedyear,  
                'insurance_ended_month' => $endedmonth,  
                'insurance_ended_year' => $endedyear,  
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
                $savedAttach = get_post_meta($postid, 'insurance_attachment_id', true);	    
                //echo $savedAttach;
                if($savedAttach){
                    $new_val = $Ids.','.$savedAttach;
                    update_post_meta($postid, 'insurance_attachment_id', $new_val); 
                }
                else
                {
                update_post_meta($postid, 'insurance_attachment_id', $Ids);   
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

                $User_Id = get_current_user_id();
                $args = array(  
                'post_type' => 'insurance',
                'post_status' => 'publish',
                'author' => $User_Id,
                );
                $loop = new WP_Query( $args ); 
                if ( $loop->have_posts()  ){  
                    echo '<ul class="military_display_lists display_lists"> <span><b>List Of Insurance:</b></span>';
                        while ( $loop->have_posts() ) : $loop->the_post();
                            $postId = get_the_ID();
                            $militaryf = get_field('liability_insurance');
                            $imgs = get_post_meta($postId,'insurance_attachment_id',true);
                            $meta = explode(',', $imgs);
                            if($imgs ){ $count = count($meta); }

                            ?>
                            <li class="card lists p-2">
                                
                                <div class="row">
                                    <div class="col-md-6">
                                    <span><?php echo $militaryf; ?></span>
                                    </div>
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
                $postid = $inid;
                $my_post = array(
                'ID'           => $postid,
                'post_title'   => $liability_lists_id,
                );
                wp_update_post( $my_post );
                update_post_meta($inid, 'liability_insurance', $liability_lists_id);
                update_post_meta($inid, 'insurance_company', $liability_insucom_id);
                update_post_meta($inid, 'address_insurance', $liability_address_id);
                update_post_meta($inid, 'insurance_phone_number', $liability_phnumber_id);
                update_post_meta($inid, 'insurance_started_month', $startedmonth);
                update_post_meta($inid, 'insurance_started_year', $startedyear);
                update_post_meta($inid, 'insurance_ended_month', $endedmonth);
                update_post_meta($inid, 'insurance_ended_year', $endedyear);
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
                $savedAttach = get_post_meta($postid, 'insurance_attachment_id', true);	    
                //echo $savedAttach;
                if($savedAttach){
                    $new_val = $Ids.','.$savedAttach;
                    update_post_meta($postid, 'insurance_attachment_id', $new_val); 
                }
                else
                {
                update_post_meta($postid, 'insurance_attachment_id', $Ids);   
                }
                }
        
                $url = get_site_url().'/profile';
                wp_redirect( $url );
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
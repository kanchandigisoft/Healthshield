<?php
if(is_user_logged_in()){
/*
* Template Name: Military
*/
get_header('dashboard');

echo get_template_part( 'template-headers/sidebar-dashboard' );
$milid = $_GET['mlid'];
$attch = $_GET['attch'];
$militaryHistory = get_field('military_history',$milid);
if($attch){
    echo '<style>form .formlists{display:none;}</style>';
}

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
<div class="content military_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
        <form name="Miltaryform" id="Miltaryform" method="post" enctype="multipart/form-data" autocomplete="off">
             <input type="hidden" id="milid" name="milid" value="<?php echo $milid; ?>">
             <section class="filedset formlists mb-3">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <label for="military_lists_id">Please list any US military or government service history if applicable. Enter current information first, then previous.</label>
                            <input type="text" name="military_lists_id" id="military_lists_id" class="military_lists_cl" <?php if($attch){}else{echo 'required';} ?> value="<?php if($militaryHistory){ echo $militaryHistory; } ?>">
                        </div>
                    </div>
                </div>
             </section>
        <section class="filedset attachemnts">
				
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                   <div class="row mb-3">
                       <div class="col-lg-10">
                           <h5 class="mt-0">Please upload a copy of Form DD214</h5>
                       </div>
                       <div class="col-lg-2 text-end">
                           <a id="add_attachment" href="#" class="btn btn-floating healthshield-new" data-type="military"><i class="fal fa-plus"></i></a>
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
                   $imgs = get_post_meta($milid,'military_attachment_id',true);
                   $meta = explode(',', $imgs);
                   $i = 0;

                   foreach ($meta as $metas) {

                   $attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                   //$count = count($metas);
                   if($attch_name){
                   $loopattach = '<input id="military_attachments_'.$i.'_id" name="upload_file['.$i.'][id]" type="hidden" value="'.$metas.'">
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
				<button class="btn btn-primary submitFormProfil" name="militarysubmit" id="militarysubmit" type="submit">Save Changes</button>
				<a class="btn btn-cancel" href="<?php echo get_site_url(); ?>/profile#military">Cancel</a>
			</div>
        </form>
        <?php 
        if(isset($_POST['militarysubmit'])){

        $mlid = $_GET['mlid'];

        $military_lists_id = $_POST['military_lists_id'];


        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );
        $result = array();
        $files = $_FILES["upload_file"];

        if($mlid == '')
        {

            $postid = wp_insert_post(array (
            'post_type' => 'military',
            'post_title' => $military_lists_id,
            'post_status' => 'publish',
            'meta_input' => array(
            'military_history' => $military_lists_id,  
            ),
            ));

        
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
            $savedAttach = get_post_meta($postid, 'military_attachment_id', true);	    
            //echo $savedAttach;
            if($savedAttach){
                $new_val = $Ids.','.$savedAttach;
                update_post_meta($postid, 'military_attachment_id', $new_val); 
            }
            else
            {
            update_post_meta($postid, 'military_attachment_id', $Ids);   
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
            'post_type' => 'military',
            'post_status' => 'publish',
            'author' => $User_Id,
            );
            $loop = new WP_Query( $args ); 
            if ( $loop->have_posts()  ){  
            echo '<ul class="military_display_lists display_lists"> <span><b>List of Military or Government Service History:</b></span>';
            while ( $loop->have_posts() ) : $loop->the_post();
            $postId = get_the_ID();
            $militaryf = get_field('military_history');
            $imgs = get_post_meta($postId,'military_attachment_id',true);
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
            $postid = $mlid;
            $my_post = array(
            'ID'           => $postid,
            'post_title'   => $military_lists_id,
            );
            wp_update_post( $my_post );
            update_post_meta($mlid, 'military_history', $military_lists_id);
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
            $savedAttach = get_post_meta($postid, 'military_attachment_id', true);	    
            //echo $savedAttach;
            if($savedAttach){
                $new_val = $Ids.','.$savedAttach;
                update_post_meta($postid, 'military_attachment_id', $new_val); 
            }
            else
            {
            update_post_meta($postid, 'military_attachment_id', $Ids);   
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
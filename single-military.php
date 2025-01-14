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
 	'post_type' => 'military',
 	'post_status' => 'publish',
 	'author' => $User_Id,
 );
?>
<div class="content profile_content">
    <div class="container pt-5 ps-5 pe-5 pb-1">
        <div class="row">
            <?php
        $loop = new WP_Query( $args ); 
 if ( $loop->have_posts()  ){  
	    $index = $loop->current_post + 1;
		$militaryHistory = get_field('military_history' );
 		$postId = get_the_ID();
 		$post_slug = $post->post_name;
		 $imgs = get_post_meta($postId,'military_attachment_id',true);
 		$meta = explode(',', $imgs);

 		if($imgs ){ $count = count($meta); }
?>
<div class="rows_lists d-flex">

    <span class="row-icon me-2">
    <i class="fal fa-clipboard-check" title="Everything is OK"></i>
    </span>
    <div class="flex-grow-1">
        <span class="title title-column">
            <span>
                <span class="title-primary">
                    <h6><?php echo get_the_title(); ?></h6>
                </span>
            </span>
        </span>
        <div class="row">
        <div class="col-12">
            <h5 class="healthshiled-green-text mt-3 mb-0 h6 font-heavyweight">				
            Attachments										
            </h5>
            <div class="images">
                <ul class="lists_img">
                    <?php
                    foreach ($meta as $metas) {

                $attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                $attach_url = wp_get_attachment_url( $metas );
                //$count = count($metas);
                if($attch_name){
                $loopattach = '<li class="attch_path_title d-flex">
                            <div class="attach_flex d-flex" id="'.$metas.'">
                                <i class="mr-2 fal fa-file-image healthshiled-green-text"></i>
                                <div class="attchName">'.$attch_name.'</div>
                                </div>
                                <div class="action-dropdown dropdown">
                    <a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
                    <i class="fal fa-ellipsis-v-alt"></i></a>

                    <ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

                    <a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttach='.$metas.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


                    <div class="dropdown-divider"></div>
                    <a class="healthshiled-delete-text dropdown-item" data-csrf="YFMNCi42ADYSOz0yJBwKFj9hAWQEAhw_3ekNCS-GQPups-blqRrTBitf" data-method="put" data-to="/profile/licenses/29a9fb49-af67-40fd-b815-bbab26a1cac4/attachments/d7e6fd5e-cda4-49bc-b818-c95aa2d37de2/archive" href="/profile/licenses/29a9fb49-af67-40fd-b815-bbab26a1cac4/attachments/d7e6fd5e-cda4-49bc-b818-c95aa2d37de2/archive" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>

                    </ul>
                    </div>
                </li>';
                echo $loopattach;
                }
                
                
                }
                ?>
                </ul>
            </div>
        </div>
    </div>
    </div>
   
</div>
  <?php 
    }else{
        echo "Please added here your Military history and files!";
    }

    $deleteAttach = $_GET['deleteAttach'];
    if(isset($deleteAttach)){
    $savedAttach = get_post_meta($postId, 'military_attachment_id', true);
    $array_this = explode(',',$savedAttach);
	wp_delete_post($deleteAttach);
    $array_without_strawberries = array_diff($array_this, array($deleteAttach));

    //print_r($array_without_strawberries);						
    $ids = implode(',', $array_without_strawberries);
    update_post_meta($postId, 'military_attachment_id', $ids);
    $url = get_site_url().'/profile';	
    //wp_redirect( $url );
    //exit;
    echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
    }
        ?>
        </div>
    </div>
</div>
<?php
get_footer('dashboard');
?>
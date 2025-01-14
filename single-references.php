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
    'post_type' => 'references',
    'post_status' => 'publish',
    'author' => $User_Id,
);

$loop = new WP_Query( $args ); 
 if ( have_posts() ){  

    $postId = get_the_ID();
    $post_slug = $post->post_name;

    $refrencename = get_field('references_name');
    $refrenceposition = get_field('references_position');
    $refrenceEmail = get_field('references_email');
    $refrencePhone = get_field('references_phone_number');
    $refrenceWorkentery = get_field('references_work_entery');
    $reverencesknown = get_field('references_known');
    $imgs = get_post_meta($postId,'refrences_attachment_id',true);
    $meta = explode(',', $imgs);

    if($imgs ){ $count = count($meta); }

?>
<div class="content profile_content">
    <div class="container pt-5 ps-5 pe-5 pb-1">
        <div class="row">
            <div class="rows_lists d-flex">


                <div class="flex-grow-1">
                <span class="title title-column">
                <span>
                
                <!-- <span class="title-secondary"><?php //echo $fcname; ?></span> -->
                </span>
                </span>
                
                <div class="card-body">
 					<div class="row">
 						<span class="title-primary">
                    <h6><?php
                    echo get_the_title(); ?></h6>
                </span><br>
 						<div class="col-md-8">
 							<div class="data-row lic_rows_data">
 								<div class="data_label">
 									Contact Position:
 								</div>
 								<div class="data_values">
 									<?php echo $refrenceposition; ?>
 								</div>
 							</div>
 							<div class="data-row lic_rows_data">
 								<div class="data_label">
 									Can be called at:
 								</div>
 								<div class="data_values">
 									<?php echo $refrencePhone; ?>
 								</div>
 							</div>
 							<div class="data-row lic_rows_data">
 								<div class="data_label">
 									Can be emailed at:
 								</div>
 								<div class="data_values">
 									<?php echo $refrenceEmail; ?>
 								</div>
 							</div>
 							<div class="data-row lic_rows_data">
								<div class="data_label">
								How long you’ve known the reference:
								</div>
								<div class="data_values">
									<?php echo $reverencesknown; ?>
				 				</div>
 							</div>
 						</div>
 						<div class="col-md-4"></div>
						
					</div>
					<?php if($imgs) {?>
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
									<div class="attchName"><a href="'.$attach_url.'" target="_blank" class="attach_url_link">'.$attch_name.'</a></div>
									</div>
									<div class="action-dropdown dropdown">
									<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
									<i class="fal fa-ellipsis-v-alt"></i></a>

									<ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

									<a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttach='.$metas.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


									<div class="dropdown-divider"></div>

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
					<?php } ?>
		        </div>

        <?php

$deleteAttach = $_GET['deleteAttach'];
if(isset($deleteAttach)){
	$savedAttach = get_post_meta($postId, 'refrences_attachment_id', true);
	$array_this = explode(',',$savedAttach);
	wp_delete_post($deleteAttach);
	$array_without_strawberries = array_diff($array_this, array($deleteAttach));

	//print_r($array_without_strawberries);						
	$ids = implode(',', $array_without_strawberries);
	update_post_meta($postId, 'refrences_attachment_id', $ids);
	$url = get_site_url().'/profile';	
	//wp_redirect( $url );
	//exit;
	echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
	
}
		}	   
		    wp_reset_postdata(); 
		?>
		</div>
	</div>
</div>
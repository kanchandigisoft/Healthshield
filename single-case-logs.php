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
    'post_type' => 'case-logs',
    'post_status' => 'publish',
    'author' => $User_Id,
);

$loop = new WP_Query( $args ); 
 if ( have_posts() ){  

    $postId = get_the_ID();
    $post_slug = $post->post_name;
    $fcname = get_field('facility_name_case');
    $agecase = get_field('age_case');
    $gendercase = get_field('gender_case');
    $phystatus = get_field('physical_status_case');
    $traumaemg = get_field('traumaemergency_case');
    $clinicalnot = get_field('clinical_notes_case');
    $peripheral = get_field('peripheral_case');
    $datecaselog = get_field('case_log_date');
    $imgs = get_post_meta($postId,'caselogs_attachment_id',true);
    $meta = explode(',', $imgs);

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

    if($imgs ){ $count = count($meta); }

     $AnesthesiaTypevalues = get_post_meta($postId,'AnesthesiaType_data',true);
     $administartionvalues = get_post_meta($postId,'administration_data',true);
     $Proceduresvalues = get_post_meta($postId,'AnesthesiaProcedures_data',true);
     $AnatomicalCategoryvalues = get_post_meta($postId,'AnatomicalCategory_data',true);

     $va1 = explode(',', $AnesthesiaTypevalues);
     $va2 = explode(',', $administartionvalues);
     $va3 = explode(',', $Proceduresvalues);
     $va4 = explode(',', $AnatomicalCategoryvalues);

     $postId = get_the_ID();
     $post_slug = $post->post_name;	

?>
<div class="content profile_content">
    <div class="container pt-5 ps-5 pe-5 pb-1">
        <div class="row">
            <div class="rows_lists d-flex">

                
                
                <div class="card-body">
                    <div class="row">
                        <div class="flex-grow-1">
                            <span class="title title-column">
                                <span>
                                    <span class="title-primary">
                                        <h6><?php echo get_the_title(); ?></h6>
                                    </span><br>
                                <!-- <span class="title-secondary"><?php //echo $fcname; ?></span> -->
                                </span>
                            </span>
                        </div>
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
                                    Age:
                                </div>
                                <div class="data_values">
                                <?php echo $fullAge; ?>
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
                                    <?php echo $datecaselog; ?>
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
                        </div>
                        <div class="col-md-6">
                            <div class="data-row lic_rows_data">
                                <div class="data_labels">
                                <b> Anesthesia Type:</b>

                                <ul>
                                    <?php foreach($va1 as $antype){
                                        echo '<li>'.$antype.'</li>';
                                    } ?>
                                </ul>
                                </div>
                            </div>
                            <div class="data-row lic_rows_data">
                                <div class="data_labels">
                                    <b>Administration:</b>

                                <ul>
                                    <?php foreach($va2 as $admin){
                                        echo '<li>'.$admin.'</li>';
                                    } ?>
                                </ul>
                                </div>
                            </div>
                            <div class="data-row lic_rows_data">
                                <div class="data_labels">
                                    <b>Anesthesia Procedures:</b>

                                <ul>
                                    <?php foreach($va3 as $anpro){
                                        echo '<li>'.$anpro.'</li>';
                                    } ?>
                                </ul>
                                </div>
                            </div>
                            <div class="data-row lic_rows_data">
                                <div class="data_labels">
                                    <b>Anatomical Category:</b>

                                    <ul>
                                        <?php foreach($va4 as $ancat){
                                            echo '<li>'.$ancat.'</li>';
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
						<div class="col-12">
                            <?php if($meta){ ?>
							<h5 class="healthshiled-green-text mt-3 mb-0 h6 font-heavyweight">				
								Attachments										
							</h5>
                            <?php } ?>
							<div class="images">
								<ul class="lists_img">
									<?php
                                    if($meta){
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
                            }
                                ?>
						        </ul>
					        </div>
				        </div>
			        </div>
                </div>
                
            </div>

        <?php

        
$deleteAttach = $_GET['deleteAttach'];
if(isset($deleteAttach)){
	$savedAttach = get_post_meta($postId, 'caselogs_attachment_id', true);
	$array_this = explode(',',$savedAttach);
	wp_delete_post($deleteAttach);
	$array_without_strawberries = array_diff($array_this, array($deleteAttach));

	//print_r($array_without_strawberries);						
	$ids = implode(',', $array_without_strawberries);
	update_post_meta($postId, 'caselogs_attachment_id', $ids);
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
<?php
get_footer('dashboard');
?>
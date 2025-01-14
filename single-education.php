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
 	'post_type' => 'education',
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
                 $degreetype = get_field('degree_type' );
                 $degreename = get_field('name_of_the_degree');
                 $schoolName = get_field('name_of_school');
                 $started_month = get_field('started_month');
                 $started_year = get_field('started_year');
                 $enddate_month = get_field('graduation_month');
                 $enddate_year = get_field('graduation_year');
                 $enrolled = get_field('currently_enrolled');
                 $degreeaddress = get_field('address_of_school');
                 $degreesub = get_field('add_subject');
         
                  $postId = get_the_ID();
                  $post_slug = $post->post_name;
                  $imgs = get_post_meta($postId,'education_attachment_id',true);
                  $meta = explode(',', $imgs);
         
                  if($imgs ){ $count = count($meta); }

                ?>

					<div id="education_<?php echo get_the_ID(); ?>" class="card mt-3">
					<div class="card-header">
					<div class="row">
					<div class="col-lg-12">
					<h5> <?php echo $degreename; ?></h5>
					</div>

					</div>
					</div>
					<div class="card-body">
					<div class="row">
					<div class="col-md-12">
					<div class="data-row lic_rows_data">
					<div class="data_label">
					Degree Type:
					</div>
					<div class="data_values">
					<?php echo $degreetype; ?>
					</div>
					</div>
					<div class="data-row lic_rows_data">
					<div class="data_label">
					Degree name:
					</div>
					<div class="data_values">
					<?php echo $degreename; ?>
					</div>
					</div>
					<div class="data-row lic_rows_data">
					<div class="data_label">
					School Address:
					</div>
					<div class="data_values">
					<?php echo $degreeaddress; ?>
					</div>
					</div>
					<div class="data-row lic_rows_data">
					<div class="data_label">
					Subject:
					</div>
					<div class="data_values">
					<?php echo $degreesub; ?>
					</div>
					</div>
					<div class="data-row lic_rows_data">
					<div class="data_label">
					From:
					</div>
					<div class="data_values">
					<?php echo $schoolName; ?>
					</div>
					</div>

					<div class="data-row lic_rows_data">
					<div class="data_label">
					Completed in:
					</div>
					<div class="data_values">
					<?php 
					if($started_month && $started_year && $enrolled == 1 && $enddate_month == '' && $enddate_year == ''){

					echo $started_month.' '.$started_year.' - (Current Student)';

					}else if($started_month && $started_year && $enddate_month && $enddate_year && $enrolled == 1 ){

					echo $started_month.' '.$started_year.' - '.$enddate_month.' '.$enddate_year.' (Current Student)';
					}else{
					if($started_month && $started_year && $enddate_month && $enddate_year)
					{
					echo $started_month.' '.$started_year.' - '.$enddate_month.' '.$enddate_year;
					}
					else if($started_month && $started_year)
					{
					echo $started_month.' '.$started_year;

					}else{

					}
					}
					?>
					</div>
					</div>
					</div>

					</div>
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
					<i class="mr-2 fal fa-file-image healthshield-green-text"></i>
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

					</div>
					</div>
                <?php
				$deleteAttach = $_GET['deleteAttach'];
				if(isset($deleteAttach)){
					$savedAttach = get_post_meta($postId, 'education_attachment_id', true);
					$array_this = explode(',',$savedAttach);
					wp_delete_post($deleteAttach);
					$array_without_strawberries = array_diff($array_this, array($deleteAttach));
				
					//print_r($array_without_strawberries);						
					$ids = implode(',', $array_without_strawberries);
					update_post_meta($postId, 'education_attachment_id', $ids);
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
<?php 

 $args = array(  
 	'post_type' => 'education',
 	'post_status' => 'publish',
 	'author' => $User_Id,
 );

 $loop = new WP_Query( $args ); 
 if ( $loop->have_posts()  ){  
 	echo '<ul class="education_display_lists display_lists">';
 	while ( $loop->have_posts() ) : $loop->the_post();
		$degreetype = get_field('degree_type' );
		$degreename = get_field('name_of_the_degree');
		$schoolName = get_field('name_of_school');
		$started_month = get_field('started_month');
		$started_year = get_field('started_year');
		$enddate_month = get_field('graduation_month');
		$enddate_year = get_field('graduation_year');
		$enrolled = get_field('currently_enrolled');

 		$postId = get_the_ID();
 		$post_slug = $post->post_name;

 		?>
 		<li class="education_list list-display">
 			<div class="rows_lists d-flex">

 				<span class="row-icon me-2">
 					<i class="fal fa-clipboard-check" title="Everything is OK"></i>
 				</span>

 				<div class="title d-flex">
 					<div class="certificate_state certificate_split_text">
						<a data-bs-toggle="collapse" data-bs-target="#education_<?php echo get_the_ID(); ?>" href="#"> 
						<?php echo $degreetype; ?>
						</a>
 					</div>
 				 <div class="certificate_type"> <?php echo $schoolName; ?> </div>
 				</div>
 				<div class="action-dropdown dropdown">
 					<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger_<?php echo get_the_ID(); ?>" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu"><i class="fal fa-ellipsis-v-alt"></i></a>
 					<ul aria-labelledby="action_menu_trigger_<?php echo get_the_ID(); ?>" class="dropdown-menu dropdown-menu-right">
 						<h6 class="dropdown-header certificate_split_text"><?php echo $degreetype; ?></h6>						
 						<div class="dropdown-divider"></div>
 						<a class="dropdown-item" id="<?php $postId; ?>" href="<?php echo get_site_url();?>/profile/education/new?eid=<?php echo $postId; ?>">
 							<i class="fal fa-fw fa-pencil"></i> Edit
 						</a>
 						<div class="dropdown-divider"></div>
 						<a class="dropdown-item"  href="<?php echo get_site_url();?>/profile/?archived=<?php echo $postId; ?>" data-method="put" id="archived_post" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>
 					</ul>

 				</div>
 			</div>
 			<div id="education_<?php echo get_the_ID(); ?>" class="collapse card mt-3">
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
 									if($enrolled == 1){
 										echo '(Current Student)';
 									}else{
 										echo $started_month.''.$started_year.'-'.$enddate_month.''.$enddate_year;
 									}
 									?>
 								</div>
 							</div>
 						</div>
						
					</div>
					
		        </div>
	        </div>
		</li>
<?php
$arch = $_GET['archived'];
if(isset($arch)){
	$postid = $arch;
	$my_post = array(
		'ID'           => $arch,
		'post_status'   => 'draft',
	);
	wp_update_post( $my_post );
	$url = get_site_url().'/profile';
	wp_redirect( $url );
	exit;
}
$deleteAttach = $_GET['deleteAttach'];
if(isset($deleteAttach)){
	$savedAttach = get_post_meta($postId, 'certificate_attachment_id', true);
	$array_this = explode(',',$savedAttach);
	
	$array_without_strawberries = array_diff($array_this, array($deleteAttach));

	//print_r($array_without_strawberries);						
	$ids = implode(',', $array_without_strawberries);
	update_post_meta($postId, 'certificate_attachment_id', $ids);
	$url = get_site_url().'/profile';
	
}
?>

<?php
endwhile;

echo '</ul>';
}else{
	echo "You studied hard. You earned your degree. Time to flaunt it!";
}
wp_reset_postdata(); 
?>

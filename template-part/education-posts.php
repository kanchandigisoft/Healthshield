<?php 
if($_GET['empId'])
{
	$User_Id = $_GET['empId'];
}
else
{
	$User_Id = get_current_user_id();
}
 $args = array(  
 	'post_type' => 'education',
 	'post_status' => 'publish',
 	'posts_per_page' => -1,
 	'author' => $User_Id,
 );

 $loop = new WP_Query( $args ); 
 if ( $loop->have_posts()  ){  
 	echo '<ul class="education_display_lists display_lists">';
 	while ( $loop->have_posts() ) : $loop->the_post();
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
		$verified = get_field('verified__unverified');
 		$postId = get_the_ID();
		$education = get_post_meta( $postId, 'postSorting', true );
 		$post_slug = $post->post_name;
		$imgs = get_post_meta($postId,'education_attachment_id',true);
 		$meta = explode(',', $imgs);

 		if($imgs ){ $count = count($meta); }

 		?>
 		<li class="education_list list-display" data-post-id="<?php echo $postId; ?>" data-id="Education" id="<?php if($education){echo $education;}else{ echo $index;} ?>">
 			<div class="rows_lists d-flex">

 				<span class="row-icon me-2">
 					<i class="fal fa-clipboard-check" title="Everything is OK"></i>
 				</span>

 				<div class="title d-flex">
 					<div class="certificate_state certificate_split_text">
						<a data-bs-toggle="collapse" data-bs-target="#education_<?php echo get_the_ID(); ?>" href="#"> 
						<?php echo $degreetype; ?>
						</a>
						
						<?php 
	 							 if ($verified == 'Verified') {
									  ?> 
								 
								<div class="verified_icon">
									<svg height="15" width="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g fill="none" fill-rule="evenodd"><path d="M256 472.153L176.892 512l-41.725-81.129-86.275-16.654 11.596-91.422L0 256l60.488-66.795-11.596-91.422 86.275-16.654L176.892 0 256 39.847 335.108 0l41.725 81.129 86.275 16.654-11.596 91.422L512 256l-60.488 66.795 11.596 91.422-86.275 16.654L335.108 512z" fill="#4285f4"/><path d="M211.824 284.5L171 243.678l-36 36 40.824 40.824-.063.062 36 36 .063-.062.062.062 36-36-.062-.062L376.324 192l-36-36z" fill="#fff"/></g></svg>
								</div>
								<?php } ?>
						
 					</div>
 				 <div class="certificate_type"> <?php echo $schoolName; ?> </div>
 				</div>
				 <?php
					$totalcount  = '';
					foreach ($meta as $metas) {
						if($metas){
							$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
							if($attch_name){
								$totalcount =  '<i class="fal fa-paperclip"></i>'.$count;
							}
						}
					}?>
					<div class="licattcahments">
						<?php echo $totalcount; ?>
					</div>
 				<div class="action-dropdown dropdown">
 					<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger_<?php echo get_the_ID(); ?>" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu"><i class="fal fa-ellipsis-v-alt"></i></a>
 					<ul aria-labelledby="action_menu_trigger_<?php echo get_the_ID(); ?>" class="dropdown-menu dropdown-menu-right">
 						<h6 class="dropdown-header certificate_split_text"><?php echo $degreetype; ?></h6>						
						<a class="dropdown-item" href="<?php echo get_site_url();?>/profile/education/new?eid=<?php echo $postId; ?>&attach=attachments">
							<i class="fal fa-fw fa-plus"></i> Add Attachment
						</a>
						 <div class="dropdown-divider"></div>
 						<a class="dropdown-item" id="<?php $postId; ?>" href="<?php echo get_site_url();?>/profile/education/new?eid=<?php echo $postId; ?>">
 							<i class="fal fa-fw fa-pencil"></i> Edit
 						</a>
 						<div class="dropdown-divider"></div>
 						<a class="dropdown-item"  href="<?php echo get_site_url();?>/profile/?archived=<?php echo $postId; ?>" data-method="put" id="archived_post" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>
 						<div class="dropdown-divider"></div>
 						<a class="dropdown-item" rel="nofollow" id="<?php echo get_the_ID(); ?>" onclick="delete_entry_ed(<?php echo get_the_ID(); ?>)"><span class="red-icon"><i class="fa fa-trash" aria-hidden="true"></i> Delete</span>
 						</a>
 					</ul>

 				</div>
 			</div>
 			<div id="education_<?php echo get_the_ID(); ?>" class="collapse card mt-3">
 				<div class="card-header">
 					<div class="row">
 						<div class="col-lg-9">
 							<h5> <?php echo $degreename; ?></h5>
 						</div>
						 <div class="col-lg-3">
 							<a class="card-header-link" href="<?php echo get_site_url(); ?>/education/<?php echo $post_slug; ?>">
 								Details
 								<i class="fal fa-link fa-fw"></i>
 							</a>
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

 										}
 										else if($enddate_month && $enddate_year)
 										{
 										echo $enddate_month.' '.$enddate_year;

 										}
 										else{

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
											if($metas){
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
										}
									?>
						        </ul>
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
	// wp_redirect( $url );
	// exit;
	echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
}
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
endwhile;

echo '</ul>';
}else{
	echo "You studied hard. You earned your degree. Time to flaunt it!";
}
wp_reset_postdata(); 
?>
<script type="text/javascript">
jQuery('#saveOrder').click(function(){
	var splashArray = new Array();
	var postid = jQuery('.education_list').attr('data-post-id');
	jQuery( ".user_profile_all_deatils_info ul.education_display_lists .education_list" ).each(function( index ) {

		var menuPos = index;
		var metaKey = jQuery( this ).attr('data-id');
		var postID = jQuery( this ).attr('data-post-id');
		splashArray.push(menuPos+'/'+postID);

	});

	var form_data = new FormData();
	form_data.append('action', 'reOrderData');
	form_data.append('changedData', splashArray);

	jQuery.ajax({
        url: '<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php',
        method: 'POST',
        data: form_data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(results) {
            if (results.status == 'success') {
            	location.reload();
            	console.log(results.msg);
            } else {
                console.log('result is wrong');
            }

        },
        error: function(error) {
            console.log('success not happens');
        }
    });
});


$(function() {
    $( ".user_profile_all_deatils_info ul.education_display_lists" ).sortable();
  });


</script>
<script type="text/javascript">
	function delete_entry_ed(id){
     //alert(id);
    var form_data = new FormData();
	form_data.append('action', 'deleteItem');
	form_data.append('item_id', id);

	jQuery.ajax({
        url: '<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php',
        method: 'POST',
        data: form_data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(results) {
            if (results.status == 'success') {
            	location.reload();
            	console.log(results.msg);
            } else {
                console.log('result is wrong');
            }

        },
        error: function(error) {
            console.log('success not happens');
        }
    });


	}
	
	jQuery(document).ready(function(){
    /*****************Reorder****************/       
    var divList = jQuery("ul.education_display_lists.display_lists .education_list");
    divList.sort(function(a, b){ return jQuery(a).attr("id")-jQuery(b).attr("id")});
    jQuery("ul.education_display_lists.display_lists").html(divList);

});	
	


</script>
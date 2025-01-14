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
 	'post_type' => 'certifications',
 	'post_status' => 'publish',
 	'posts_per_page' => -1,
 	'author' => $User_Id,
 );
 $loop = new WP_Query( $args ); 
 if ( $loop->have_posts()  ){  
 	echo '<ul class="certificate_display_lists display_lists">';
 	while ( $loop->have_posts() ) : $loop->the_post();
	 $index = $loop->current_post + 1;
		$cert_type = get_field('certificate_type');
		$cert_number = get_field('certification_number');
		$cert_expire = get_field('certificate_expire_date');
		$cert_issue = get_field('certificate_issue_date');
	    $verified = get_field('verified__unverified');
 		$postId = get_the_ID();
 		$imgs = get_post_meta($postId,'certificate_attachment_id',true);
 		$otherNam = get_post_meta($postId, 'otherNam', true);
 		$meta = explode(',', $imgs);
		$certifi = get_post_meta( $postId, 'postSorting', true );
 		if($imgs ){ $count = count($meta); }
 		$post_slug = $post->post_name;

 		if($cert_type == 'OTHER' && $otherNam != '')
 		{
 			$otherNam = $otherNam;
 		}
 		else
 		{
 			$otherNam = $cert_type;
 		}

 		?>
 		<li class="certificate_list list-display" data-post-id="<?php echo $postId; ?>" id="<?php if($certifi){echo $certifi;}else{ echo $index;} ?>">
 			<div class="rows_lists d-flex">

 				<span class="row-icon me-2">
 					<i class="fal fa-clipboard-check" title="Everything is OK"></i>
 				</span>

 				<div class="title d-flex">
 					<div class="certificate_state certificate_split_text">
						<a data-bs-toggle="collapse" id="onhovertoggle" data-bs-target="#certificate_<?php echo get_the_ID(); ?>" href="#"> 
						<?php echo $otherNam; ?>
						</a>
						<?php 
	 							 if ($verified == 'Verified') {
									  ?> 
								 
								<div class="verified_icon">
									<svg height="15" width="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g fill="none" fill-rule="evenodd"><path d="M256 472.153L176.892 512l-41.725-81.129-86.275-16.654 11.596-91.422L0 256l60.488-66.795-11.596-91.422 86.275-16.654L176.892 0 256 39.847 335.108 0l41.725 81.129 86.275 16.654-11.596 91.422L512 256l-60.488 66.795 11.596 91.422-86.275 16.654L335.108 512z" fill="#4285f4"/><path d="M211.824 284.5L171 243.678l-36 36 40.824 40.824-.063.062 36 36 .063-.062.062.062 36-36-.062-.062L376.324 192l-36-36z" fill="#fff"/></g></svg>
								</div>
								<?php } ?>
 					</div>
 				<!-- <div class="certificate_type"> <?php //echo $cert_type; ?> </div> -->
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
 						<h6 class="dropdown-header certificate_split_text"><?php echo get_field('certificate_hidden'); ?></h6>
 						<a class="dropdown-item" href="<?php echo get_site_url();?>/profile/certifications/new?cid=<?php echo $postId; ?>&attch=attachments">
 							<i class="fal fa-fw fa-plus"></i> Add Attachment
 						</a>
 						<div class="dropdown-divider"></div>
 						<a class="dropdown-item" id="<?php $postId; ?>" href="<?php echo get_site_url();?>/profile/certifications/new?cid=<?php echo $postId; ?>">
 							<i class="fal fa-fw fa-pencil"></i> Edit
 						</a>
 						<div class="dropdown-divider"></div>
 						<a class="dropdown-item"  href="<?php echo get_site_url();?>/profile/?archived=<?php echo $postId; ?>" data-method="put" id="archived_post" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>
						 <div class="dropdown-divider"></div>
						<a class="dropdown-item" rel="nofollow" id="<?php echo get_the_ID(); ?>" onclick="delete_entry_ed(<?php echo get_the_ID(); ?>)"><span class="red-icon"><i class="fa fa-trash" aria-hidden="true"></i> Delete</span></a>
 			
					</ul>

 				</div>
 			</div>
 			<div id="certificate_<?php echo get_the_ID(); ?>" class="collapse card mt-3">
 				<div class="card-header">
 					<div class="row">
 						<div class="col-lg-9">
 							<h5> <?php echo $otherNam; ?></h5>
 						</div>
 						<div class="col-lg-3">
 							<a class="card-header-link" href="<?php echo get_site_url(); ?>/certifications/<?php echo $post_slug; ?>">
 								Details
 								<i class="fal fa-link fa-fw"></i>
 							</a>
 						</div>
 					</div>
 				</div>
 				<div class="card-body">
 					<div class="row">
 						<div class="col-md-8">
 							<div class="data-row lic_rows_data">
 								<div class="data_label">
 									Certification Number:
 								</div>
 								<div class="data_values">
 									<?php echo $cert_number; ?>
 								</div>
 							</div>
							 <div class="data-row lic_rows_data">
 								<div class="data_label">
 									Issue Date:
 								</div>
 								<div class="data_values">
 									<?php echo $cert_issue; ?>
 								</div>
 							</div>
 							<div class="data-row lic_rows_data">
 								<div class="data_label">
 									Exipre Date:
 								</div>
 								<div class="data_values">
 									<?php echo $cert_expire; ?>
 								</div>
 							</div>
 						</div>
 						<div class="col-md-4">
 							<?php 
 							$today = time();												    										
 							$dt2 = get_field('certificate_expire_date');

 							$date2 = date("Y-m-d", strtotime($dt2));

 							$newDate = strtotime($date2);

 							$diff = $newDate - $today;

 							$totaldays = round($diff / (60 * 60 * 24));

							/*$date1=date_create($today);
							$date2=date_create($dt2);
							$diff=date_diff($date1,$date2);

							$totaldays = abs(($today - $date2) / (60 * 60 * 24));
							echo $totaldays;*/

							?>
							<div class="card expertion_date text-center <?php if($totaldays < 62 || $totaldays > -1 && $totaldays == -0 ){ echo 'bg-danger';}else{ echo 'bg-primary';} ?>">
							<div class="card-body">


								<div class="expiration-profile-days">
									<div class="expiration-profile-label">
										Expires in
									</div>
									<div>
										<div class="expires-in-days"><?php echo $totaldays; ?></div>
										<div class="expires-in-days-label">
											days
										</div>
									</div>
								</div>

								<div class="expiration-profile-date">
									<hr class="expiration-profile-divider">
									<div class="expiration-date-label">on</div>
									<div class="expiration-date">
										<?php echo get_field('certificate_expire_date'); ?>
									</div>
								</div>
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
		</li>
<?php
endwhile;

echo '</ul>';
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
	$savedAttach = get_post_meta($postId, 'certificate_attachment_id', true);
	$array_this = explode(',',$savedAttach);
	wp_delete_post($deleteAttach);
	$array_without_strawberries = array_diff($array_this, array($deleteAttach));

	//print_r($array_without_strawberries);						
	$ids = implode(',', $array_without_strawberries);
	update_post_meta($postId, 'certificate_attachment_id', $ids);
	$url = get_site_url().'/profile';
	//wp_redirect( $url );
	//exit;
	echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
	
}
}else{
	echo "Upload all your certifications here.";
}
wp_reset_postdata(); 

$loop = new WP_Query( $args );
$numberOfPosts= $loop->found_posts;

$args2 = array(  
	'post_type' => 'memberpressproduct',
	'post_status' => 'publish',
	'author' => $User_Id,
	);
	
	$loop = new WP_Query( $args2 ); 
	if ( $loop->have_posts()  ){  
	
	while ( $loop->have_posts() ) : $loop->the_post();
		$membertitle = get_the_title();
		$memberID = get_the_ID();	
	endwhile;
	}

	if($membertitle == 'Elite'){
		if($numberOfPosts < '3'){
?>

<script type="text/javascript">
jQuery('#saveOrdercer').click(function(){
	var splashArray = new Array();
	var postid = jQuery('.certificate_list').attr('data-post-id');
	jQuery( ".user_profile_all_deatils_info ul.certificate_display_lists .certificate_list" ).each(function( index ) {

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
    $( ".user_profile_all_deatils_info ul.certificate_display_lists" ).sortable();
  });

  jQuery(document).ready(function(){
    /*****************Reorder****************/       
    var divList = jQuery("ul.certificate_display_lists.display_lists .certificate_list");
    divList.sort(function(a, b){ return jQuery(a).attr("id")-jQuery(b).attr("id")});
    jQuery("ul.certificate_display_lists.display_lists").html(divList);

});	

</script>

<?php }else{
	
}
 }else{ ?>
	
<script type="text/javascript">
jQuery('#saveOrdercer').click(function(){
	var splashArray = new Array();
	var postid = jQuery('.certificate_list').attr('data-post-id');
	jQuery( ".user_profile_all_deatils_info ul.certificate_display_lists .certificate_list" ).each(function( index ) {

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
    $( ".user_profile_all_deatils_info ul.certificate_display_lists" ).sortable();
  });

  jQuery(document).ready(function(){
    /*****************Reorder****************/       
    var divList = jQuery("ul.certificate_display_lists.display_lists .certificate_list");
    divList.sort(function(a, b){ return jQuery(a).attr("id")-jQuery(b).attr("id")});
    jQuery("ul.certificate_display_lists.display_lists").html(divList);

});	

</script>
<?php
}?>
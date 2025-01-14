<?php 
if($_GET['empId'])
{
	$User_Id = $_GET['empId'];
}
else
{
	$User_Id = get_current_user_id();
}

/*************************References******************************/
 $args = array(  
 	'post_type' => 'references',
 	'post_status' => 'publish',
 	'posts_per_page' => -1,
 	'author' => $User_Id,
 );

 $loop = new WP_Query( $args ); 
 if ( $loop->have_posts()  ){  
 	echo '<ul class="refrences_display_lists display_lists">';
 	while ( $loop->have_posts() ) : $loop->the_post();
	 $index = $loop->current_post + 1;
		$enrolled = get_field('currently_enrolled');

 		$postId = get_the_ID();
 		$post_slug = $post->post_name;
		$refsort = get_post_meta( $postId, 'postSorting', true );
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
 		<li class="refrences_list list-display"  data-post-id="<?php echo $postId; ?>" id="<?php if($refsort){echo $refsort;}else{ echo $index;} ?>">
 			<div class="rows_lists d-flex">

 				<span class="row-icon me-2">
 					<i class="fal fa-clipboard-check" title="Everything is OK"></i>
 				</span>

 				<div class="title d-flex">
 					<div class="certificate_state certificate_split_text">
						<a data-bs-toggle="collapse" data-bs-target="#refrences_<?php echo get_the_ID(); ?>" href="#"> 
						<?php echo $refrencename; ?>
						</a>
 					</div>
 				 <div class="certificate_type"> <?php echo $refrenceposition; ?> </div>
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
 						<a class="dropdown-item" href="<?php echo get_site_url();?>/profile/references-new?rfid=<?php echo $postId; ?>&attch=attachments">
 							<i class="fal fa-fw fa-plus"></i> Add Attachment
 						</a>
 						<div class="dropdown-divider"></div>
 						<a class="dropdown-item" id="<?php $postId; ?>" href="<?php echo get_site_url();?>/profile/references-new?rfid=<?php echo $postId; ?>">
 							<i class="fal fa-fw fa-pencil"></i> Edit
 						</a>
 						<div class="dropdown-divider"></div>
 						<a class="dropdown-item"  href="<?php echo get_site_url();?>/profile/?archived=<?php echo $postId; ?>" data-method="put" id="archived_post" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>
 					</ul>

 				</div>
 			</div>
 			<div id="refrences_<?php echo get_the_ID(); ?>" class="collapse card mt-3">
 				<div class="card-header">
 					<div class="row">
 						<div class="col-lg-9">
 							<h5> <?php echo $refrencename; ?></h5>
 						</div>
 						<div class="col-lg-3">
 							<a class="card-header-link" href="<?php echo get_site_url(); ?>/references/<?php echo $post_slug; ?>">
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
					<?php } ?>
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
?>

<?php
endwhile;

echo '</ul>';
}else{
	echo "Before you can create a Reference,
you'll need some Work History.";
}
wp_reset_postdata(); 
?>

<script type="text/javascript">
jQuery('#saveOrderref').click(function(){
	var splashArray = new Array();
	var postid = jQuery('.refrences_list').attr('data-post-id');
	jQuery( ".user_profile_all_deatils_info ul.refrences_display_lists .refrences_list" ).each(function( index ) {

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
    $( ".user_profile_all_deatils_info ul.refrences_display_lists" ).sortable();
  });

  jQuery(document).ready(function(){
    /*****************Reorder****************/       
    var divList = jQuery("ul.refrences_display_lists.display_lists .refrences_list");
    divList.sort(function(a, b){ return jQuery(a).attr("id")-jQuery(b).attr("id")});
    jQuery("ul.refrences_display_lists.display_lists").html(divList);

});	

</script>
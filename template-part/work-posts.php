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
 	'post_type' => 'work-history',
 	'post_status' => 'publish',
 	'posts_per_page' => -1,
 	'author' => $User_Id,
 );
 $args2 = array(  
 	'post_type' => 'work-history-gap',
 	'post_status' => 'publish',
 	'posts_per_page' => -1,
 	'author' => $User_Id,
 );
 echo '<ul class="workHistory_display_lists display_lists">';
 /***********************************work gap***********************************************/
 $loop = new WP_Query( $args2 ); 
 if ( $loop->have_posts()  ){  
 	
 	while ( $loop->have_posts() ) : $loop->the_post();
	 $index = $loop->current_post + 1;
		$postId = get_the_ID();
 		$post_slug = $post->post_name;
		$gapsort = get_post_meta( $postId, 'postSorting', true );
		$gap_reson = get_field('gap_reson');
		$gap_additional_comments = get_field('gap_additional_comments');
		$gap_city = get_field('gap_city');
		$gap_state = get_field('gap_state');
		$gap_started_M = get_field('gap_started_M');
		$gap_started_Y = get_field('gap_started_Y');
		$gap_ended_M = get_field('gap_ended_M');
		$gap_ended_Y = get_field('gap_ended_Y');
 		?>
 		<li class="workHistory_list list-display" data-post-id="<?php echo $postId; ?>" id="<?php if($gapsort){echo $gapsort;}else{ echo $index;} ?>">
 			<div class="rows_lists d-flex">

				<span class="row-icon me-2">
				<i class="fal fa-fw fa-calendar"></i>
				</span>
 				<div class="flex-grow-1">
 					<span class="title title-column tt">
 						<span class="d-flex gap-2">
 							<span class="title-primary">
 								<a href="<?php echo get_site_url();?>/work-history-gap/<?php echo $post_slug ?>"><?php echo $gap_reson; ?></a>
 							</span>
 							<span class="title-secondary"><b><?php echo $gap_started_M.' '.$gap_started_Y.' — '.$gap_ended_M.' '.$gap_ended_Y; ?></b></span>
 						</span>
 					</span>					
 				</div>
 				<div class="action-dropdown dropdown">
 					<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger_<?php echo get_the_ID(); ?>" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu"><i class="fal fa-ellipsis-v-alt"></i></a>
 					<ul aria-labelledby="action_menu_trigger_<?php echo get_the_ID(); ?>" class="dropdown-menu dropdown-menu-right">
 												
 						<a class="dropdown-item" id="<?php $postId; ?>" href="<?php echo get_site_url();?>/profile/work-history-gaps-new?gapid=<?php echo $postId; ?>">
 							<i class="fal fa-fw fa-pencil"></i> Edit
 						</a>
 						<div class="dropdown-divider"></div>
 						<a class="dropdown-item"  href="<?php echo get_site_url();?>/profile/?archived=<?php echo $postId; ?>" data-method="put" id="archived_post" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>
						 <div class="dropdown-divider"></div>
						 <a class="dropdown-item" rel="nofollow" id="<?php echo get_the_ID(); ?>" onclick="delete_entry(<?php echo get_the_ID(); ?>)"><span class="red-icon"><i class="fa fa-trash" aria-hidden="true"></i> Delete</span>
 						</a>
 					</ul>

 				</div>
 			</div>
		</li>
 	<?php
 		endwhile;
 	}
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
?>

 <?php
 	/***********************************work history*******************************/
 $loop = new WP_Query( $args ); 
 if ( $loop->have_posts()  ){  	
 	while ( $loop->have_posts() ) : $loop->the_post();
		$faclityname = get_field('facility_name');
		$spanddept = get_field('work_specialty_department');
		$workcity = get_field('work_city');
		$workstate = get_field('work_state');
		$workprofession = get_field('work_profession');
		$workstartedM = get_field('work_started_on_month');
		$workstrtedY = get_field('work_started_on_year');
		$workendM = get_field('work_ended_on_month');
		$workendY = get_field('work_ended_on_year');
		$currentywork = get_field('work_currently_here');
		$faciltytype = get_field('work_type_Ag_fc');
		$emplymenttype = get_field('work_employment_type');
		$additioncomments = get_field('additional_notes_and_comments');
		$staffingagency = get_field('work_staffing_agency');
		$workaddress = get_field('work_address');
		$workzipcode = get_field('work_zip_code');
		$contactname = get_field('contact_name');
		$contactemail = get_field('contact_email');
		$contactphnno = get_field('phone_number');
		$contactfaxno = get_field('fax_number');
		$op_facility = get_field('op_facility');
		$op_address = get_field('op_address');
		$verified = get_field('verified__unverified');
 		$postId = get_the_ID();
 		$post_slug = $post->post_name;
		$index = $loop->current_post + 1;
		$whsort = get_post_meta( $postId, 'postSorting', true );
 		?>
 		<li class="workHistory_list list-display"  data-post-id="<?php echo $postId; ?>" id="<?php if($whsort){echo $whsort;}else{ echo $index;} ?>">
 			<div class="rows_lists d-flex">

 				<span class="row-icon me-2">
 					<i class="fal fa-clipboard-check" title="Everything is OK"></i>
 				</span>
 				<div class="flex-grow-1">
 					<span class="title title-column ttt">
 						<span>
 							<span class="title-primary">
 								<a href="<?php echo get_site_url();?>/work-history/<?php echo $post_slug ?>"><?php
 								echo get_the_title(); ?></a>
								
								<?php 
	 							 if ($verified == 'Verified') {
									  ?> 
								 
								<div class="verified_icon">
									<svg height="15" width="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g fill="none" fill-rule="evenodd"><path d="M256 472.153L176.892 512l-41.725-81.129-86.275-16.654 11.596-91.422L0 256l60.488-66.795-11.596-91.422 86.275-16.654L176.892 0 256 39.847 335.108 0l41.725 81.129 86.275 16.654-11.596 91.422L512 256l-60.488 66.795 11.596 91.422-86.275 16.654L335.108 512z" fill="#4285f4"/><path d="M211.824 284.5L171 243.678l-36 36 40.824 40.824-.063.062 36 36 .063-.062.062.062 36-36-.062-.062L376.324 192l-36-36z" fill="#fff"/></g></svg>
								</div>
								<?php } ?>
 							</span>
 							<span class="title-secondary"><?php echo $spanddept; ?></span>
 						</span>
 					</span>
 					<!-- <?php //if($faciltytype == 'Facility'){ ?>
 					<p class="mb-0">
 						<?php //echo $faclityname; ?> (<?php //echo $faciltytype; ?>)
 					</p>
 					 <?php// }else if($faciltytype == 'Agency'){ ?>
 					 <p class="mb-0">
 						<?php //echo $staffingagency; ?> (<?php// echo $faciltytype; ?>)
 					</p>
 					<?php //} ?> -->
 					
 					<p class="mb-0">
 						<strong><?php echo $workstartedM.' '.$workstrtedY; ?> — <?php if($currentywork == 1){echo 'Present';}else{ echo $workendM.' '.$workendY;  } ?></strong>
 					</p>
 				</div>
 				<div class="action-dropdown dropdown">
 					<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger_<?php echo get_the_ID(); ?>" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu"><i class="fal fa-ellipsis-v-alt"></i></a>
 					<ul aria-labelledby="action_menu_trigger_<?php echo get_the_ID(); ?>" class="dropdown-menu dropdown-menu-right">
 												
 						<a class="dropdown-item" id="<?php $postId; ?>" href="<?php echo get_site_url();?>/profile/work-history-new?whid=<?php echo $postId; ?>">
 							<i class="fal fa-fw fa-pencil"></i> Edit
 						</a>
 						<div class="dropdown-divider"></div>
 						
 						<a class="dropdown-item"  href="<?php echo get_site_url();?>/profile/?archived=<?php echo $postId; ?>" data-method="put" id="archived_post" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" rel="nofollow" id="<?php echo get_the_ID(); ?>" onclick="delete_entry(<?php echo get_the_ID(); ?>)"><span class="red-icon"><i class="fa fa-trash" aria-hidden="true"></i> Delete</span>
 						</a>

 					</ul>

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

endwhile;

}else{
	echo "Where have you worked in the past?";
}
echo '</ul>';
if ( $loop->have_posts()  ){  
echo '<a class="d-block mt-4" id="gapButton" href="'.get_site_url().'/profile/work-history-gaps-new">
<i class="fad fa-plus-circle mr-1"></i>
Add Gap in Employment
</a>';
}else{
	echo "Where have you worked in the past?";
}
wp_reset_postdata(); 
?>
<script type="text/javascript">
jQuery('#saveOrderworkhistory').click(function(){
	var splashArray = new Array();
	var postid = jQuery('.workHistory_list').attr('data-post-id');
	jQuery( ".user_profile_all_deatils_info ul.workHistory_display_lists .workHistory_list" ).each(function( index ) {

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
    $( ".user_profile_all_deatils_info ul.workHistory_display_lists" ).sortable();
  });

  jQuery(document).ready(function(){
    /*****************Reorder****************/       
    var divList = jQuery("ul.workHistory_display_lists.display_lists .workHistory_list");
    divList.sort(function(a, b){ return jQuery(a).attr("id")-jQuery(b).attr("id")});
    jQuery("ul.workHistory_display_lists.display_lists").html(divList);

});	

</script>
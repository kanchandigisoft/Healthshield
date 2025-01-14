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
	'post_type' => 'skills-checklists',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'author' => $User_Id,
);

$loop = new WP_Query( $args ); 
if ( $loop->have_posts()  ){  
	echo '<ul class="skillChecklists_display_lists display_lists">';
	while ( $loop->have_posts() ) : $loop->the_post();
	$index = $loop->current_post + 1;
		$postId = get_the_ID();
		$imgs = get_post_meta($postId,'skills_attachment_id',true);
		$meta = explode(',', $imgs);
		$skillcheck = get_post_meta( $postId, 'postSorting', true );
		if($imgs ){ $count = count($meta); }
		$post_slug = $post->post_name;
		$completed = get_field('completed_date');
		$specciality = get_field('checklists_specialty');
		
		?>
		<li class="skillChecklists_list list-display" data-post-id="<?php echo $postId; ?>" id="<?php if($skillcheck){echo $skillcheck;}else{ echo $index;} ?>">
			<div class="rows_lists">
				
				<span class="row-icon">
					<i class="fal fa-clipboard-check" title="Everything is OK"></i>
				</span>

				<div class="title">
					<div class="lic_state">
						<a class="title-primary" href="<?php echo get_site_url(); ?>/skills-checklists/<?php echo $post_slug; ?>"> <?php echo $specciality; ?>
					</a></div>
					<div class="lic_type"> <?php echo $completed; ?> </div>
				</div>
				<?php  if($imgs){ ?>
						<div class="licattcahments">
							<?php echo $count; ?>
						</div>
					<?php } ?>
				<div class="action-dropdown dropdown">
					<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger_<?php echo get_the_ID(); ?>" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu"><i class="fal fa-ellipsis-v-alt"></i></a>
					<ul aria-labelledby="action_menu_trigger_<?php echo get_the_ID(); ?>" class="dropdown-menu dropdown-menu-right">
						<h6 class="dropdown-header"><?php echo $specciality; ?></h6>
						<a class="dropdown-item" href="<?php echo get_site_url();?>/profile/skills/checklists-new?checkid=<?php echo $postId; ?>&attch=attachments">
							<i class="fal fa-fw fa-plus"></i> Add Attachment
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" id="<?php $postId; ?>" href="<?php echo get_site_url();?>/profile/skills/checklists-new?checkid=<?php echo $postId; ?>">
							<i class="fal fa-fw fa-pencil"></i> Edit
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item"  href="<?php echo get_site_url();?>/profile/?checkArchived=<?php echo $postId; ?>" data-method="put" id="archived_post" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>
					</ul>

				</div>
			</div>

		</li>
			<?php
			$checkarch = $_GET['checkArchived'];
			if(isset($checkarch)){
				$postid = $checkarch;
				$my_post = array(
					'post_type' => 'skills-checklists',
					'ID'           => $checkarch,
					'post_status'   => 'draft',
				);
				wp_update_post( $my_post );
				$url = get_site_url().'/profile';
				//wp_redirect( $url );
				//exit;
				echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
			}
			// $deleteAttach = $_GET['deleteAttach'];
			// if(isset($deleteAttach)){
			// 	$savedAttach = get_post_meta($postId, 'skills_attachment_id', true);
			// 	$array_this = explode(',',$savedAttach);

			// 	$array_without_strawberries = array_diff($array_this, array($deleteAttach));

			// //print_r($array_without_strawberries);						
			// 	$ids = implode(',', $array_without_strawberries);
			// 	update_post_meta($postId, 'skills_attachment_id', $ids);
			// 	$url = get_site_url().'/profile';
			//echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';

			// }
			?>

			<?php
			endwhile;

			echo '</ul>';
			}else{
				echo "Upload recent skills checklist results.";
			}
			wp_reset_postdata(); 
			?>
			<script type="text/javascript">
jQuery('#saveOrderskillcheck').click(function(){
	var splashArray = new Array();
	var postid = jQuery('.skillChecklists_list').attr('data-post-id');
	jQuery( ".user_profile_all_deatils_info ul.skillChecklists_display_lists .skillChecklists_list" ).each(function( index ) {

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
    $( ".user_profile_all_deatils_info ul.skillChecklists_display_lists" ).sortable();
  });

  jQuery(document).ready(function(){
    /*****************Reorder****************/       
    var divList = jQuery("ul.skillChecklists_display_lists.display_lists .skillChecklists_list");
    divList.sort(function(a, b){ return jQuery(a).attr("id")-jQuery(b).attr("id")});
    jQuery("ul.skillChecklists_display_lists.display_lists").html(divList);

});	

</script>
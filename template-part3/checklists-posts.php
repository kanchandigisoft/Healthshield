<?php 
$args = array(  
	'post_type' => 'skills-checklists',
	'post_status' => 'publish',
	'author' => $User_Id,
);

$loop = new WP_Query( $args ); 
if ( $loop->have_posts()  ){  
	echo '<ul class="licenses_display_lists display_lists">';
	while ( $loop->have_posts() ) : $loop->the_post();
		$postId = get_the_ID();
		$imgs = get_post_meta($postId,'skills_attachment_id',true);
		$meta = explode(',', $imgs);

		if($imgs ){ $count = count($meta); }
		$post_slug = $post->post_name;
		$completed = get_field('completed_date');
		$specciality = get_field('checklists_specialty');
		
		?>
		<li class="licenses_list list-display">
			<div class="rows_lists">
				
				<span class="row-icon">
					<i class="fal fa-clipboard-check" title="Everything is OK"></i>
				</span>

				<div class="title">
					<div class="lic_state">
						<a class="title-primary" href="<?php echo get_site_url(); ?>/profile/skills-checklists/<?php echo $post_slug; ?>"> <?php echo $specciality; ?>
					</a></div>
					<div class="lic_type"> <?php echo $completed; ?> </div>
				</div>
				<?php if($imgs) {?>
					<div class="licattcahments">
						<i class="fal fa-paperclip"></i>
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
				wp_redirect( $url );
				exit;
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
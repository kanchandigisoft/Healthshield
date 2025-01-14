<?php 
$args = array(  
	'post_type' => 'additional-documents',
	'post_status' => 'publish',
	'author' => $User_Id,
);

$loop = new WP_Query( $args ); 
if ( $loop->have_posts()  ){  
	echo '<ul class="licenses_display_lists display_lists">';
	while ( $loop->have_posts() ) : $loop->the_post();
		$postId = get_the_ID();
		$imgs = get_post_meta($postId,'document_attachment_id',true);
		$meta = explode(',', $imgs);

		if($imgs ){ $count = count($meta); }
		$post_slug = $post->post_name;
		$documentType = get_field('document_type');
		$documentname = get_field('document_name');
		$documentdesc = get_field('document_description');
		
		?>
		<li class="licenses_list list-display">
			<div class="rows_lists">
				
				<span class="row-icon">
					<i class="fal fa-clipboard-check" title="Everything is OK"></i>
				</span>

				<div class="title">
					<div class="lic_state">
						<a class="title-primary" href="<?php echo get_site_url(); ?>/profile/additional-documents/<?php echo $post_slug; ?>"> <?php echo $documentname; ?>
					</a></div>
					<div class="lic_type"> <?php echo $documentType; ?> </div>
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
						<a class="dropdown-item" href="<?php echo get_site_url();?>/profile/document-new?adid=<?php echo $postId; ?>&adattch=attachments">
							<i class="fal fa-fw fa-plus"></i> Add Attachment
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" id="<?php $postId; ?>" href="<?php echo get_site_url();?>/profile/document-new?adid=<?php echo $postId; ?>">
							<i class="fal fa-fw fa-pencil"></i> Edit
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item"  href="<?php echo get_site_url();?>/profile/?adArchived=<?php echo $postId; ?>" data-method="put" id="archived_post" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>
					</ul>

				</div>
			</div>


		</li>
			<?php
			$adarch = $_GET['adArchived'];
			if(isset($adarch)){
				$postid = $adarch;
				$my_post = array(
					'post_type' => 'additional-documents',
					'ID'           => $adarch,
					'post_status'   => 'draft',
				);
				wp_update_post( $my_post );
				$url = get_site_url().'/profile';
				wp_redirect( $url );
				exit;
			}
			$deleteAttach = $_GET['deleteAttach'];
			if(isset($deleteAttach)){
				$savedAttach = get_post_meta($postId, 'document_attachment_id', true);
				$array_this = explode(',',$savedAttach);

				$array_without_strawberries = array_diff($array_this, array($deleteAttach));

			//print_r($array_without_strawberries);						
				$ids = implode(',', $array_without_strawberries);
				update_post_meta($postId, 'document_attachment_id', $ids);
				$url = get_site_url().'/profile';

			}
			?>

			<?php
			endwhile;

			echo '</ul>';
			}else{
				echo "(Driver's License, Social Security Card, etc.)";
			}
			wp_reset_postdata(); 
			?>
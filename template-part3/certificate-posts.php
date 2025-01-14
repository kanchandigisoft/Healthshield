<?php 

 $args = array(  
 	'post_type' => 'certifications',
 	'post_status' => 'publish',
 	'author' => $User_Id,
 );

 $loop = new WP_Query( $args ); 
 if ( $loop->have_posts()  ){  
 	echo '<ul class="certificate_display_lists display_lists">';
 	while ( $loop->have_posts() ) : $loop->the_post();
		$cert_type = get_field('certificate_type');
		$cert_number = get_field('certification_number');
		$cert_expire = get_field('certificate_expire_date');
 		$postId = get_the_ID();
 		$imgs = get_post_meta($postId,'certificate_attachment_id',true);
 		$meta = explode(',', $imgs);

 		if($imgs ){ $count = count($meta); }
 		$post_slug = $post->post_name;

 		?>
 		<li class="certificate_list list-display">
 			<div class="rows_lists d-flex">

 				<span class="row-icon me-2">
 					<i class="fal fa-clipboard-check" title="Everything is OK"></i>
 				</span>

 				<div class="title d-flex">
 					<div class="certificate_state certificate_split_text">
						<a data-bs-toggle="collapse" data-bs-target="#certificate_<?php echo get_the_ID(); ?>" href="#"> 
						<?php echo get_field('certificate_hidden'); ?>
						</a>
 					</div>
 				 <div class="certificate_type"> <?php echo $cert_type; ?> </div>
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
 					</ul>

 				</div>
 			</div>
 			<div id="certificate_<?php echo get_the_ID(); ?>" class="collapse card mt-3">
 				<div class="card-header">
 					<div class="row">
 						<div class="col-lg-9">
 							<h5> <?php echo $cert_type; ?></h5>
 						</div>
 						<div class="col-lg-3">
 							<a class="card-header-link" href="<?php echo get_site_url(); ?>/profile/certifications/<?php echo $post_slug; ?>">
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
 									Exipre Date:
 								</div>
 								<div class="data_values">
 									<?php echo $cert_expire; ?>
 								</div>
 							</div>
 						</div>
 						<div class="col-md-4"></div>
						
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
								}
								echo $loopattach;
								
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
	echo "Let's add some certificates.";
}
wp_reset_postdata(); 
?>

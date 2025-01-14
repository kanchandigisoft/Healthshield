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
    'post_type' => 'additional-documents',
    'post_status' => 'publish',
    'author' => $User_Id,
);

$loop = new WP_Query( $args ); 
 if ( have_posts() ){  

		$postId = get_the_ID();
    	$imgs = get_post_meta($postId,'document_attachment_id',true);
    	$meta = explode(',', $imgs);
		
		if($imgs ){ $count = count($meta); }
		$post_slug = $post->post_name;
		$documentType = get_field('document_type');
		$documentname = get_field('document_name');
		$documentdesc = get_field('document_description');

?>
<div class="content profile_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
		<div id="licenses_<?php echo get_the_ID(); ?>" class="mt-3 p-5">
				 		<!-- <div class="card-header">
					 		<div class="row">
					 		<div class="col-lg-9">
					 		<h5> <?php //echo get_field('licenses_type'); ?></h5>
					 		</div>
					 		<div class="col-lg-3">
								<a class="card-header-link" href="<?php //echo get_the_permalink(); ?>">
								        Details
								        <i class="fal fa-link fa-fw"></i>
								</a>
					 		</div>
					 		</div>
				 		</div> -->
			<div class="rows_lists">
				
				

				<div class="title">
					<div class="lic_state">
						<h6><?php echo $documentname; ?></h6>
					</a></div>
					<div class="lic_type"> <?php echo $documentType; ?> </div>
				</div>
			
			</div>

            <div class="row">
									<div class="col-12">
										<h5 class="kamana-green-text mt-3 mb-0 h6 font-heavyweight">				
										Attachments										
										</h5>
										<div class="images">
											<ul class="lists_img">
												<?php
												foreach ($meta as $metas) {
													if($metas){
                                                    $atch_url =  wp_get_attachment_url( $metas );
											$attch_name = basename( get_attached_file($metas ) ); // Just the file name;
											//$count = count($metas);
											if($attch_name){
											$loopattach = '<li class="attch_path_title d-flex">
														<div class="attach_flex d-flex">
															<i class="mr-2 fal fa-file-image kamana-green-text"></i>
															<div class="attchName"><a href="'.$atch_url.'" target="_blank">'.$attch_name.'</a></div>
															</div>
															<div class="action-dropdown dropdown">
												<a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
												<i class="fal fa-ellipsis-v-alt"></i></a>

												<ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

												<a class="text-muted dropdown-item" href="'.get_the_permalink(get_the_ID()).'?deleteAttach='.$metas.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


												<div class="dropdown-divider"></div>
												<a class="kamana-delete-text dropdown-item" data-method="put"  href="#" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>

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
				// wp_redirect( $url );
				// exit;
				echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
			}
			$deleteAttach = $_GET['deleteAttach'];
			if(isset($deleteAttach)){
				$savedAttach = get_post_meta($postId, 'document_attachment_id', true);
				$array_this = explode(',',$savedAttach);
				wp_delete_post($deleteAttach);
				$array_without_strawberries = array_diff($array_this, array($deleteAttach));

			//print_r($array_without_strawberries);						
				$ids = implode(',', $array_without_strawberries);
				update_post_meta($postId, 'document_attachment_id', $ids);
				$url = get_site_url().'/profile';
				echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';

			}
			

			}else{
				echo "(Driver's License, Social Security Card, etc.)";
			}
			   
		    wp_reset_postdata(); 
		?>
			</div>
		</div>
	</div>








	
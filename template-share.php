<?php
if(is_user_logged_in()){

    /*
    Template Name: Share
    */ 
    get_header('dashboard');
    echo get_template_part( 'template-headers/sidebar-dashboard' );
    $uid = get_current_user_id();

 /**Check if Member Active**/
$mepr_user = new MeprUser( get_current_user_id() );
if( $mepr_user->is_active() ) {
    //echo 'Active';
}else if($mepr_user->has_expired()) {
    wp_redirect(get_site_url());
  exit;
}else {
    wp_redirect(get_site_url());
  exit;
} 
/************/

    ?>
    <div class="content profile_content">
        <div class="container pt-5 ps-5 pe-5 pb-1">
            <div class="row">
                <section class="featuredPro">
                    <div class="">
                    <h3>You're in control.</h3>
                    </div>
                </section>
                <section class="Profilesharing mb-5">
                    <div class="row">
                        <div class="col-lg-10">
                            <h2>Profile Sharing</h2>
                        </div>
                        <div class="col-lg-2 text-end">
                            <a class="btn btn-floating healthshiled-new" href="<?php echo get_site_url();?>/profile/share/share-new"><i class="fal fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <p>Share a link to your Profile with anyone outside your Employer Network who needs access to your credentials or professional resume. You choose what to share, and can turn off access any time. <a href="#">Here's how it works.</a></p>

                        <?php 
                        
                        $uid = get_current_user_id();
                        $args = array(  
                        'post_type' => 'my-shares',
                        'post_status' => 'publish',
                        'author' => $uid,
                        );

                        $loop = new WP_Query( $args ); 
                        if ( $loop->have_posts()  ){ 
                        echo '<section class="profile-shares mt-5">
                        <div class="fancy-heading">
                            <h4>My Shares</h4>
                        </div>';                    
                            while ( $loop->have_posts() ) : $loop->the_post();
                            $post_id = get_the_ID();
                            $post_slug = $post->post_name;

                                $reciptname = get_field('receipt_name');
                                $shareemail = get_field('shares_email');
                                $shareoverview = get_field('share_level_overview');
                                $sharefull = get_field('share_level_full');
                                $sharenote = get_field('private_note');
                                $sharemsg = get_field('personal_message');
                                $share_status = get_field('share_status');
                                $emailcheckbox = get_field('check_email_box');
                                $linkcheckbox = get_field('check_link_box');

                        ?>
                        <div id="mails_ids_<?php echo $post_id; ?>" class="profile-share card mb-3 " data-slug="<?php echo $post_slug; ?>">
                            <div class="card-body">
                                <h3 class="card-title h6 mb-0 d-flex justify-content-between">
                                    <span class="flex-grow-1">
                                        <?php if($emailcheckbox){
                                            echo '<i class="fad fa-fw fa-envelope-open-text"></i>';
                                        }else if($linkcheckbox){
                                            echo ' <i class="fad fa-fw fa-link"></i>';
                                        } ?>
                                        
                                    
                                        <span><?php echo $reciptname; ?></span>
                                    </span>

                                    <div class="action-dropdown dropdown">
                                        <a class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger_id" role="button" title="Toggle Action Menu"><i class="fal fa-ellipsis-v-alt"></i></a>
                                        <ul aria-labelledby="action_menu_trigger_id" class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item clipboard-link" data-clipboard-target="<?php echo get_site_url(); ?>/profile/shared/?shid=<?php echo $post_id; ?>" href="#">
                                            <span>
                                                <i class="fal fa-fw fa-copy"></i>Copy Link to Clipboard</span>
                                            </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item preview_share" data-post-id="<?php echo $post_id ?>" href="<?php echo get_site_url(); ?>/profile/shared/?shid=<?php echo $post_id; ?>" target="_blank">
                                            <span><i class="fal fa-fw fa-eye"></i>Preview Share</span>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?php echo get_site_url(); ?>/profile/share/share-new?shareid=<?php echo $post_id; ?>">
                                            <span><i class="fal fa-fw fa-pencil"></i>Edit</span>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item kamana-delete-text" data-confirm="Are you sure? <?php echo $shareemail; ?> will no longer be able to see your profile." data-method="delete"href="<?php echo get_site_url(); ?>/profile/share/?unshare=<?php echo $post_id; ?>" rel="nofollow">
                                            <span class="text-red"><i class="fal fa-fw fa-minus-octagon"></i>Unshare</span>
                                        </a>
                                    </ul>
                                </div>

                                </h3>
                                <p class="card-text">
                                    <small class="text-muted"><a href="mailto:<?php echo $shareemail; ?>"><?php echo $shareemail; ?></a></small>
                                </p>
                                <?php if($sharenote){ ?>
                                    <p class="card-text text-muted">
                                    <i class="fad fa-fw mr-1 fa-comment-alt-lines"></i>
                                    <?php echo $sharenote; ?>
                                    </p>
                                <?php }else{ ?>
                                    <p class="card-text text-muted">
                                    <i class="fad fa-fw mr-1 fa-comment-alt-lines"></i>
                                    Private Note
                                    </p>

                                <?php }?>

                                <?php if($sharemsg){ ?>
                                    <p class="card-text text-muted">
                                    <i class="fad fa-fw mr-1 fa-comment-alt-lines"></i>
                                    <?php echo $sharemsg; ?>
                                    </p>
                                <?php }else if($sharemsg == ''){ ?>
                                    <p class="card-text text-muted">
                                    <i class="fad fa-fw mr-1 fa-comment-alt-lines"></i>
                                        Personal Message
                                    </p>
                                <?php }?>

                                <p class="card-text text-muted">
                                    <small>
                                        Created on <?php echo get_the_date( 'd M Y' ); ?>
                                    </small>
                                    <small class="text-right">
                                        <br class="d-sm-none"><span class="d-none d-sm-inline">•&nbsp;</span><span>Sent on <?php echo get_the_modified_date('d M Y'); ?></span>
                                    </small>
                                </p>

                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div class="flex-grow-1">
                                    <span class="badge badge-dark badge-pill bg-dark">
                                    <?php $views = get_post_meta($post_id,'post_views_count',true);
                                    if($views){
                                        echo $views.' Views';
                                    }else{

                                    echo '0 Views';
                                    }
                                    ?>
                                    </span>

                                    <span class="badge badge-light bg-white text-dark">
                                        <?php  if($sharefull == 'full'){echo 'Full';}else{ echo 'Overview';} ?>
                                    </span>
                                </div>

                                <div class="flex-grow-0">
                                    <small class="text-right">
                                        <?php if($emailcheckbox){
                                            echo '';
                                        }else if($linkcheckbox){
                                            echo ' <span><a class="clipboard-link" data-clipboard-target="'.get_site_url().'/profile/shared/?shid='.$post_id.'" href="#" id="copytoclicpboard"><span><i class="fal fa-fw fa-copy"></i>Copy Link</span></a></span>';
                                        } ?>
                                    
                                    </small>
                                </div>

                            </div>
                        </div>
                        <?php 
                            endwhile;
                            echo '</section>';
                        }  
                        ?>

                    </section>         
                </section>
                <section class="exposrtresume mb-5">
                    <h2>Export Resume</h2>
                    <p>Download a PDF of your Resume.</p>
                    <a class="btn btn-primary resume_btn" href="<?php bloginfo('stylesheet_directory') ?>/pdf/pdfcode.php?uID=<?php echo $uid; ?>" target="_blank"><i class="fal fa-fw mr-1 fa-file-pdf"></i>Download Resume</a>
                </section>
            </div>
        </div>
    </div>
    
    <?php
    $unshare = $_GET['unshare'];
    if(isset($_GET['unshare'])){
    wp_delete_post($unshare);
    $url = get_site_url().'/profile/share/';
    // wp_redirect( $url );
    // exit;
    echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';

    }
    ?>


<?php
		get_footer('dashboard');
}else{
    header('Location: ' . get_permalink(1310));
}
?>
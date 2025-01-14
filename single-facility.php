<?php 
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */
get_header('dashboard');
echo get_template_part( 'template-headers/sidebar-dashboard' );
if(!is_user_logged_in())
{
    wp_redirect(get_site_url());
  exit;
}
$user_id = get_current_user_id();
$pageId = get_the_ID();
?>
<div class="content profile_content">
    <div class="container pt-5 ps-5 pe-5 pb-1">
        <div class="row">
            <ul class="nav nav-pills mb-3" id="provider-facility-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#profile" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Profile</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#employee" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Employees</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#contract" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contract</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#importantDoc" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Important Documents</button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="pills-home-tab">
                  <h2><?php echo get_the_title(); ?></h2>
                  <ul>
                    <li><strong>Address : </strong><?php echo get_field('address', get_the_ID()); ?></li>
                    <li><strong>Site Contact : </strong><?php echo get_field('site_contact', get_the_ID()); ?></li>
                    <li><strong>Phone Number : </strong><?php echo get_field('phone_number', get_the_ID()); ?></li>
                    <li><strong>Email : </strong><?php echo get_field('email', get_the_ID()); ?></li>
                  </ul>
              </div>
              <div class="tab-pane fade" id="employee" role="tabpanel" aria-labelledby="pills-profile-tab">
                <?php
                $agencieslist = get_users();
                echo '<ol class="pList">';
                foreach($agencieslist as $list)
                {
                        $uId = $list->ID;
                        $facilityId =  get_user_meta($uId, 'saved_facility', true);
                        if($facilityId == get_the_ID())
                        {
                            $userUrl = get_site_url().'/profile/provider/profile-providers/?proId='.$uId;
                            $user_info = get_userdata($uId);
                            $first_name = $user_info->first_name;
                            $last_name = $user_info->last_name;
                            $fullName = $first_name.' '.$last_name;
                            echo '<li><a href="'.$userUrl.'">'.$fullName.'</a></li>';
                        }
                }
                echo '</ol>';

                ?>
              </div>
              <div class="tab-pane fade" id="contract" role="tabpanel" aria-labelledby="pills-contact-tab">
                <h2 class="facilityTitle">Contracts <span><a href="<?php echo get_the_permalink(4882).'?fid='.get_the_ID(); ?>">Add New</a></span></h2>
                <?php
                $args = array(  
                            'post_type' => 'facility-contract',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                            'meta_query' => array(
                                array(
                                    'key'   => 'parentFacility',
                                    'value' => get_the_ID(),
                                    'compare' => '=',
                                ),
                            )
                         );
                     $loop = new WP_Query( $args ); 
                     if ( $loop->have_posts()  )
                     { 
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Contract Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Agreed Rate($)</th>
                            <th>Services Provided</th>
                            <th>General Note</th>
                        </tr>
                    </thead>
                    <tbody> 
                    <?php 
                     while ( $loop->have_posts() ) : $loop->the_post();

                        $title = get_the_title();
                        $contract_start_date = get_field('contract_start_date');
                        $contract_end_date = get_field('contract_end_date');
                        $agreed_rate = get_field('agreed_rate');
                        $services_provided = get_field('services_provided');
                        $general_note = get_field('general_note');
                     ?>
                     <tr>
                        <td><?php echo get_the_title(); ?></td>
                        <td><?php echo $contract_start_date; ?></td>
                        <td><?php echo $contract_end_date; ?></td>
                        <td><?php echo $agreed_rate; ?></td>
                        <td><?php echo $services_provided; ?></td>
                        <td><?php echo $general_note; ?></td>
                     </tr>

                    <?php 
                    endwhile;
                    ?>
                </tbody>
                </table>
                <?php } else {
                    echo '<p>No Contract available Yet</p>';
                } ?>
              </div>
              <div class="tab-pane fade" id="importantDoc" role="tabpanel" aria-labelledby="pills-contact-tab">
                  <h2 class="facilityTitle">Documents <span><a href="<?php echo get_the_permalink(4890).'?fid='.$pageId; ?>">Add New</a></span></h2>
                <?php
                $args = array(  
                            'post_type' => 'facility-document',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                            'meta_query' => array(
                                array(
                                    'key'   => 'parentFacility',
                                    'value' => $pageId,
                                    'compare' => '=',
                                ),
                            )
                         );
                     $loop = new WP_Query( $args ); 
                     if ( $loop->have_posts()  )
                     { 
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Document Name</th>
                            <th>Description</th>
                            <th>Attachments</th>
                        </tr>
                    </thead>
                    <tbody> 
                    <?php 
                     while ( $loop->have_posts() ) : $loop->the_post();

                        $title = get_the_title();
                        $description = get_field('document_description');
                        $savedAttach = get_post_meta(get_the_ID(), 'document_attachment_id', true); 
                        $getAttachment = explode(',', $savedAttach);
                     ?>
                     <tr>
                        <td><?php echo get_the_title(); ?></td>
                        <td><?php echo $description; ?></td>
                        <td>
                           <?php 
                           foreach($getAttachment as $getAttachmentId)
                           {
                                $attch_name = basename( get_attached_file($getAttachmentId ) ); // Just the file name;
                                $attch_url = wp_get_attachment_url($getAttachmentId);
                                echo '<a href="'.$attch_url.'">'.$attch_name.'</a><br>';
                           }
                           ?> 
                        </td>
                     </tr>

                    <?php 
                    endwhile;
                    ?>
                </tbody>
                </table>
            <?php } else{
                echo '<p>No document available yet.</p>';
            } ?>
              </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    div#profile h2 {
    text-transform: capitalize;
}
    ul#provider-facility-tab button.nav-link {
        color: #000;
        border: 1px solid;
        margin-right: 20px;
    }
    ul#provider-facility-tab button.nav-link:hover
    {
        color: #fff;
        background: #015084;
    }
    ul#provider-facility-tab button.nav-link.active
    {
        color: #fff;
        background: #015084;
    }
</style>
<?php 
get_footer('dashboard');
?>
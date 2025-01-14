<?php
if(is_user_logged_in()){
/*
* Template name: Provider template
*/ 
get_header('dashboard');

echo get_template_part( 'template-headers/sidebar-dashboard' );

$current_user = wp_get_current_user();
$username = $current_user->user_login;
$uid = get_current_user_id();
$uList = array();

/* Getting membership ids of current user */
    if(class_exists('MeprUtils')) {
      $user = MeprUtils::get_currentuserinfo();
      
      if($user !== false && isset($user->ID)) {
        //Returns an array of Membership ID's that the current user is active on
        $active_prodcuts = $user->active_product_subscriptions('ids');
        //print_r($active_prodcuts);
      }
    }

?>
<div class="content edit_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">

            <?php if(!empty($active_prodcuts)) { ?>

            <div class="col-md-6 col-lg-6 col-sm-12 col-12">
                    <h2>Providers</h2> 
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-12 text-end">
                <a href="<?php echo get_site_url(); ?>/invite-provider/" class="btn ntn-medium inviteBtn"><i class="fal fa-plus"></i> Invite Providers</a>
                <a href="#" class="btn ntn-medium assignFac inviteBtn" data-bs-toggle="modal" data-bs-target="#assignModal"><i class="fal fa-plus"></i> Assign / Update Facility</a> 
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-12 mt-5">
            <?php
            $saved = get_user_meta($uid, 'selected_employees', true);
                    $savedEmp = get_user_meta($uid, 'selected_employees', true);
                    $savedEmpData = explode(',', $savedEmp);
                    if($savedEmp)
                    { 
                     ?>
                    <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>NPI#</th>
                            <th>DEA#</th>
                            <th>States</th>
                            <th>Access</th>
                            <th>Facility</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php foreach ($savedEmpData as $user) 
                     { 
                            //$nameagency = get_user_meta($user->ID, 'user_agency_name', true);
                            /*if($nameagency == $username)
                            {*/ 

                                $user_info = get_userdata($user);

                                $access = get_user_meta($user, 'revoke_status_'.$uid, true);

                                $uList[] = $user;

                                $agencyId = get_user_meta($user, 'agency_id', true);
                                $key2 = 'request_status_'.$agencyId;
                                $checkStatus = get_user_meta($user, $key2, true);
                                /*if($checkStatus == 1)
                                {*/
                        ?>
                       
                        <tr id="<?php echo $user; ?>">
                            <td><a href="<?php echo get_site_url(); ?>/profile/provider/profile-providers?proId=<?php echo $user; ?>"><?php echo $user_info->first_name.' '.$user_info->last_name; ?></a></td>
                            <td><?php echo $user_info->roles[0] ?></td>
                            <td><?php echo $user_info->npi_number; ?></td>
                            <td><?php echo $user_info->dea_number; ?></td>
                            <td><?php echo $user_info->state; ?></td>
                            <td><?php if($access){ echo $access; } else { echo 'no'; } ?></td>
                            <td>
                                <?php 
                                $facilityId =  get_user_meta($user, 'saved_facility', true);
                                if($facilityId)
                                {
                                    $facility_info = get_userdata($facilityId);
                                    echo $facility_info->display_name;
                                }
                                else
                                {
                                    echo 'No facility assigned yet.';
                                }

                                 ?>
                            </td>
                        </tr>
                         <?php //}
                        } ?>
                        </tbody>
                </table>

                        <?php } else { ?>
                            <div class="no-result">No Record Available.</div>

                        <?php }?>  
            </div>
        <?php } else { ?>
            <div class="col-md-6 col-lg-6 col-sm-12 col-12">
                <h2>Providers</h2>
                <?php echo '<h2 class="purch_subs"><a href="'.get_the_permalink(5752).'">Please purchase subscription</a></h2>'; ?>
            </div>
        <?php } ?>
        </div>
    </div>
</div>

<!-- Assign Modal -->
<div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assignModalLabel">Assign / Update Facility</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="updateFac" method="post">
            <select name="availFacility">
            <option value="">Select Facility</option>
            <?php 
            $facilityUsers = get_users( array( 'role__in' => array( 'Facility') ) );
            foreach($facilityUsers as $NewfacilityUsers) 
            { 
                $user_info = get_userdata( $NewFacilityData );
                echo '<option value="'.$NewfacilityUsers->ID.'">'.$NewfacilityUsers->display_name.'</option>';
            }
        ?>
        </select>
        <br />
        <select name="availProvider">
            <option value="">Select Provider</option>
            <?php foreach($uList as $userList) 
            { 
                 $user_info = get_userdata($userList);
                  $first_name = $user_info->first_name;
                  $last_name = $user_info->last_name;
                  $fullName = $first_name.' '.$last_name;
                echo '<option value="'.$userList.'">'.$fullName.'</option>';
            }
            ?>
        </select>
        <br />
        <input type="submit" name="updateFacBtn" value="Assign Facility">
        </form>
      </div>
    </div>
  </div>
</div>  
<?php
if(isset($_POST['updateFacBtn']))
{
    global $user, $post;
    $selectedFacility = $_POST['availFacility'];
    $selectedProvider = $_POST['availProvider'];
    $updated = update_user_meta($selectedProvider, 'saved_facility', $selectedFacility);
    if($updated)
    {
        echo "<script> 
                Swal.fire({
                    title: 'success!',
                    text: 'Facility assigned successfully',
                    icon: 'success',
                    showConfirmButton: true,
                    allowOutsideClick: true,
                    allowEscapeKey: false,
                    confirmButtonColor: '#40BFB9',
                    }).then((result) => {
                      location.reload();
                    });
                </script>";
    }
}


?>    
<?php
get_footer('dashboard');
}else{
header('Location: ' . get_permalink(1310));
}
?>
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
    'post_type' => 'opportunities',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'author' => $User_Id,
 );

 $loop = new WP_Query( $args ); 
 if ( $loop->have_posts()  ){  
    echo '<ul class="opportunity_display_lists display_lists pt-3">';
    while ( $loop->have_posts() ) : $loop->the_post();
    $index = $loop->current_post + 1;
        $oppID = get_the_ID();
         $days = get_field('shift_preference_days');
         $mids = get_field('shift_preference_mids');
         $nights = get_field('shift_preference_nights');
         $loccount = get_post_meta( $oppID,'Location_total_count',true)
        ?>
<li id="<?php echo $index; ?>" class="opportunity-preferences row col-12 mb-2" >
   <h4 class="lightfont"><?php echo get_the_title(); ?></h4>
   <div class="flow-grow-1 d-flex">
   <section class="opportunity-preferences-body col-12 col-lg-10">
      <div class="data-row">
         <div class="data-column">
            <span class="data-label"><b>Locations:</b></span>
            <span class="data-value data-value-block">
               <?php for($i=1; $i<=$loccount; $i++){
               $name = get_post_meta($oppID,'location_name_'.$i,true);

               $city = get_post_meta($oppID,'specific_city_City_'.$i,true);
               $state = get_post_meta($oppID,'specific_city_state_'.$i,true);
               $distance = get_post_meta($oppID,'specific_city_distance_'.$i,true);

               $asstate = get_post_meta($oppID,'anywhere_in_state_'.$i,true);

               $anywhere = get_post_meta($oppID,'anywhere',true);



               if($name == 'SC'){ ?>
               <span class="d-block"><span class="grey-text text-lighten-1">•&nbsp;&nbsp;</span>Within <?php echo $distance; ?> miles of <?php echo $city;?>, <?php echo $state;?></span>
               <?php  }else if($name == 'AS'){ ?>
               <span class="d-block"><span class="grey-text text-lighten-1">•&nbsp;&nbsp;</span>Anywhere in <?php echo $asstate;?></span>
               <?php }else if($name == 'SC' or $name == 'AS'){ ?>
               <span class="d-block"><span class="grey-text text-lighten-1">•&nbsp;&nbsp;</span>Anywhere in <?php echo $asstate;?></span>
               <span class="d-block"><span class="grey-text text-lighten-1">•&nbsp;&nbsp;</span>Within <?php echo $distance; ?> miles of <?php echo $city;?>, <?php echo $state;?></span>
               <?php }  ?>
               <?php if($anywhere){ ?>
               <span class="d-block"><span class="grey-text text-lighten-1">•&nbsp;&nbsp;</span>Anywhere</span>
               <?php } }?>
            </span>
        </div>
      </div>
      <div class="data-row">
         <div class="data-column">
            <span class="data-label"><b>Shifts:</b></span>
            <span class="data-value"><?php if($days && $mids && $nights){echo $days.', '.$mids.', '.$nights;}else if($days && $mids){echo $days.', '.$mids;}else if($days && $nights){echo $days.', '.$nights;}else if($days){ echo $days; }else if($mids){ echo $mids; }else if($nights){ echo $nights; }else{}  ?></span>
        </div>
      </div>
      <div class="data-row">
         <div class="data-column">
            <span class="data-label"><b>Hours Per Week:</b></span>
            <span class="data-value"><?php echo get_field('weekly_hours'); ?></span>
        </div>
      </div>
      <div class="data-row">
         <div class="data-column">
            <span class="data-label"><b>Available:</b></span>
            <span class="data-value"><?php echo get_field('availability'); ?></span>
        </div>
      </div>
      <div class="data-row">
         <div class="data-column">
            <span class="data-label"><b>Assignment Length:</b></span>
            <span class="data-value"><?php echo get_field('assignment_length'); ?> Weeks</span>
        </div>
      </div>
      <div class="data-row">
         <div class="data-column">
            <span class="data-label"><b>Minimum Gross Pay:</b></span>
            <span class="data-value">$<?php echo get_field('desired_pay'); ?>.00</span>
        </div>
      </div>
   </section>
   <div class="action-dropdown dropdown col-12 col-lg-2 text-end">
      <a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger_f6c65cfd-363a-4d04-a180-3d7a7cd0abc1" role="button" title="Toggle Action Menu"><i class="fal fa-ellipsis-v-alt"></i></a>
      <ul aria-labelledby="action_menu_trigger_f6c65cfd-363a-4d04-a180-3d7a7cd0abc1" class="dropdown-menu dropdown-menu-right">
         <h6 class="dropdown-header"><?php echo get_the_title(); ?></h6>
         <a class="dropdown-item" href="<?php echo get_site_url(); ?>/preferences/opportunity-new/?oppid=<?php echo $oppID; ?>">
         <i class="fal fa-fw fa-pencil"></i> Edit
         </a>
         <div class="dropdown-divider"></div>
         <a class="dropdown-item kamana-delete-text" data-bs-confirm="Are you sure?" data-bs-method="delete"  href="<?php echo get_site_url(); ?>/profile/?delete=<?php echo $oppID; ?>" rel="nofollow">
         <i class="fal fa-fw fa-trash-alt"></i> Delete
         </a>
      </ul>
   </div>
</div>
</li>

<?php
    endwhile;
}else{
   echo '<span class="blank-slate-sentence">
                     Stop repeating where (and when) you want to work.<br>
                     Display your preferred locations, shifts, pay, and more - then share
                     to find opportunities that truly meet your needs.
                     </span>';
}
$unshare = $_GET['delete'];
if(isset($_GET['delete'])){
wp_delete_post($unshare);
$url = get_site_url().'/profile';
// wp_redirect( $url );
// exit;
echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
}
?>


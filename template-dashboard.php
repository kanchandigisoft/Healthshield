<?php
/*
Template Name: Dashboard
*/ 
if(is_user_logged_in()){
get_header('dashboard');
echo get_template_part( 'template-headers/sidebar-dashboard' );
$current_user = wp_get_current_user();
$role = $current_user->roles;
global $wpdb;

$User_Id = get_current_user_id();
$finalAgency = array();
$emps = $wpdb->get_results("SELECT * FROM $wpdb->usermeta WHERE (meta_key = 'selected_employees')");
foreach($emps as $newEmp)
{
	$otherEmpList = $newEmp->meta_value;

	$Savedempoyees = explode(',', $otherEmpList);

	if (in_array($User_Id, $Savedempoyees))
	  {
	  		$finalAgency[] = $newEmp->user_id;
	  }

}

$havingAgency = count($finalAgency);

if($role[0] == 'Provider' || $role[0] == 'facility'){

}else{
	/**Check if Member Active**/
	$mepr_user = new MeprUser( get_current_user_id() );
	if( $mepr_user->is_active() || $havingAgency > 0 ) {
		//echo 'Active';
	}else if($mepr_user->has_expired()) {
		wp_redirect(get_site_url());
		exit;
	}else {

		echo "<script> 
		Swal.fire({
			title: 'Alert!',
			text: 'You have to purchase the membership first to view the Profile',
			icon: 'info',
			showConfirmButton: true,
			allowOutsideClick: true,
			allowEscapeKey: false,
			confirmButtonColor: '#40BFB9',
			});
		</script>";
		wp_redirect(get_the_permalink(5726));
		exit;
	} 
} 
/************/

$User_Id = get_current_user_id();
$userid_filed = 'user_'.$User_Id;


$middlename = get_field('middle_name',$userid_filed);
$nomiddlename = get_field('no_middle_name',$userid_filed);


$first_name = $current_user->first_name;
$last_name =  $current_user->last_name;

if($middlename){
	if($nomiddlename == 1){
		$fullname = $first_name.' '.$last_name;
	}else{
	$fullname = $first_name.' '.$middlename.' '.$last_name;
	}
}else{

	$fullname = $first_name.' '.$last_name;
}
$email = $current_user->user_email;
$userlink_name = $current_user->user_nicename;
$userid_filed = 'user_'.$current_user->ID;
$specciality = get_field_object('specialty', $userid_filed);
$value = $specciality['value'];

$finalAgency = array();
if($role[0] == 'facility')
{
$emps = $wpdb->get_results("SELECT * FROM $wpdb->usermeta WHERE (meta_key = 'selected_facilities')");
}	
if($role[0] == 'CRNA')
{
$emps = $wpdb->get_results("SELECT * FROM $wpdb->usermeta WHERE (meta_key = 'selected_employees')");
}
foreach($emps as $newEmp)
{
	$otherEmpList = $newEmp->meta_value;

	$Savedempoyees = explode(',', $otherEmpList);

	if (in_array($User_Id, $Savedempoyees))
	  {
	  		$finalAgency[] = $newEmp->user_id;
	  }

}

$totalAgency = count($finalAgency);

?>
<div class="content dashboard_content">
	<div class="container pt-5">
		<div class="row">
			<div class="col-md-6 col-lg-6 col-sm-12 col-12">
				<div class="profile_box py-4 px-3 my-3">
					<div class="userdetials">
						<div class="username_full">
							<h1><?php echo $fullname; ?></h1>
						</div>
						<div class="roll-and-specialty">
							<h2><?php echo $role[0]; ?> <span>|</span> <?php echo $value; ?></h2>
						</div>
					</div>
					<div class="user_profile_link">
						<a class="btn btn-info btn-lighter d-lg-block btn-block-always" href="<?php echo get_site_url().'/profile/'.$user_info->user_login; ?>">View profile</a>
					</div>
				</div>
				<?php if($totalAgency > 0) { ?>
				<div class="agencyBox">
					<h3>Agency Associated</h3>
					<ul>
					<?php 
					foreach($finalAgency as $finalAgencyId)
					{
						$agencyInfo = get_userdata($finalAgencyId);
						$agencyName = $agencyInfo->display_name;

						echo '<li>'.$agencyName.'</li>';
			
					}
					?>
				</ul>
				</div>
				<?php } ?>
			</div>
			<div class="col-md-6 col-lg-6 col-sm-12 col-12">
				<div class="expiring-credentials-card card dashboard-widget my-3">
					<div class="card-body">

						<h5 class="card-title mb-0 font-lightweight">
							<?php if(in_array("0", $fine)){  echo '<i class="fad fa-fw fa-exclamation-triangle" style="color: #469BA8;"></i>'; } else { 
						echo '<i class="fad fa-check-circle" style="color: #469BA8;"></i>';
							 } ?>
						&nbsp; Expiring Credentials
						</h5>

						<?php
							$User_Id = get_current_user_id();
							$args = array();
							$today = time();
							$fine = array();
								
							$args_certifications = array(  
								'post_type' => 'certifications',
								'post_status' => 'publish',
							
								'author' => $User_Id,
							);
							$args_licenses = array(  
								'post_type' => 'licenses',
								'post_status' => 'publish',
								
								'author' => $User_Id,
							);
							$args_immunizations = array(  
								'post_type' => 'immunizations',
								'post_status' => 'publish',
								
								'author' => $User_Id,
							);


							$loop_ct = new WP_Query( $args_certifications ); 
							if( $loop_ct->have_posts() ) {
								while( $loop_ct->have_posts() ): $loop_ct->the_post();
								
								$cert_type = get_field('certificate_type');												    										
 								$dt2 = get_field('certificate_expire_date');
 								$date2 = date("Y-m-d", strtotime($dt2));
 								$newDate = strtotime($date2);
 								$diff =  $newDate - $today ;
 								//echo $newDate. '-' .$today. '='  .$diff;
 								//$j = round($diff / (60 * 60 * 24));
 								//echo '<br><br>'.$j;
 								$totaldays = round($diff / (60 * 60 * 24));
 								if ( $totaldays == -0){
 									$totaldays = 0;
 								}
								$postId = get_the_ID();
								$sendmail = get_post_meta( $postId, 'expiremailsend', true );
								
								if( $totaldays < 62   ){ 
									//array_push($fine, 0);
									$fine[] = 0;
								
								?>
									<p class="card-text mt-1 notif_red certfi">
										<?php echo '<span><i class="fal fa-fw fa-file-medical"></i></span>
										<span><a href="'. get_the_permalink(get_the_id()).'">'.$cert_type.'</a></span>
										<span style="color: #B36D7B;">  in '.$totaldays.' days</span>'; ?>
									</p>
								<?php 
							} else { $fine[] = 1; } ?>
								<?php 

								endwhile;
							wp_reset_postdata();
							} 

							$loop_ls = new WP_Query( $args_licenses ); 
							if( $loop_ls->have_posts() ) {
								while( $loop_ls->have_posts() ): $loop_ls->the_post();
								$cert_type = get_field('licenses_type');												    										
 								$dt2 = get_field('expire_date');
								
 								$date2 = date("Y-m-d", strtotime($dt2));
 								$newDate = strtotime($date2);
 								$diff = $newDate - $today;
 								$totaldays = round($diff / (60 * 60 * 24));
 								if ( $totaldays == -0){
 									$totaldays = 0;
 								}
								$postId = get_the_ID();
								$sendmail = get_post_meta( $postId, 'expiremailsend', true );
								
								if( $totaldays < 62  ){ 
									$fine[] = 0;
								
									?>
									<p class="card-text mt-1 notif_red lic">
									<?php echo '<span><i class="fal fa-fw fa-file-medical"></i></span>
									<span><a href="'. get_the_permalink(get_the_id()).'">'.$cert_type.'</a></span>
									<span style="color: #B36D7B;"> in '.$totaldays.' days</span>'; ?>
									</p>
								<?php 
							} else { $fine[] = 1; } ?>
								<?php 

								endwhile;
							wp_reset_postdata();
							}
							

							$loop_imz = new WP_Query( $args_immunizations ); 
							if( $loop_imz->have_posts() ) {
								while( $loop_imz->have_posts() ): $loop_imz->the_post();
								$cert_type = get_field('immunizations_dropdown');												    										
								$dt2 = get_field('flu_date_expire');
								$dt3 = get_field('covid_date_expire');
								$dt4 = get_field('tb_date_expire');
								// $count = count($args_immunizations);
								// echo $count;

								if($cert_type == 'Flu'){
									$date2 = date("Y-m-d", strtotime($dt2));
								}else if($cert_type == 'COVID'){
									$date2 = date("Y-m-d", strtotime($dt3));
								}else if($cert_type == 'TB'){
									$date2 = date("Y-m-d", strtotime($dt4));
								}

 								$newDate = strtotime($date2);
 								$diff = $newDate - $today;
 								$totaldays = round($diff / (60 * 60 * 24));
 								if ( $totaldays == -0){
 									$totaldays = 0;
 								}
								$postId = get_the_ID();
								$sendmail = get_post_meta( $postId, 'expiremailsend', true );
							
								if( $totaldays < 62  ){ 
									$fine[] = 0;
								
									if($cert_type == 'Flu'){
									
									?>
									<p class="card-text mt-1 notif_red immun">
									<?php echo '<span><i class="fal fa-fw fa-file-medical"></i></span>
									<span><a href="'. get_the_permalink(get_the_id()).'">'.$cert_type.'</a></span>
									<span style="color: #B36D7B;"> in '.$totaldays.' days</span>'; ?>
									</p>
								<?php
									}else if($cert_type == 'COVID'){
									
										?>
									<p class="card-text mt-1 notif_red immun">
									<?php echo '<span><i class="fal fa-fw fa-file-medical"></i></span>
									<span><a href="'. get_the_permalink(get_the_id()).'">'.$cert_type.'</a></span>
									<span style="color: #B36D7B;"> in '.$totaldays.' days</span>'; ?>
									</p>
								<?php
									}else if($cert_type == 'TB'){
									
										?>
									<p class="card-text mt-1 notif_red immun">
									<?php echo '<span><i class="fal fa-fw fa-file-medical"></i></span>
									<span><a href="'. get_the_permalink(get_the_id()).'">'.$cert_type.'</a></span>
									<span style="color: #B36D7B;"> in '.$totaldays.' days</span>'; ?>
									</p>
								<?php
									}else{

									}

							} else { 
									$fine[] = 1; } 
									?>
								<?php 

								endwhile;
							wp_reset_postdata();
							}

							//print_r($fine);

							if(in_array("0", $fine)){ 
								echo "<style>.page-template-template-dashboard-php h5.card-title.mb-0.font-lightweight {
									border-bottom: rgba(0,0,0,.125) 1px solid; padding-bottom: 10px; 
								}</style>";
							} else { ?>
								<p class="card-text mt-1">
								All clear!  Your credentials are in good standing!
								</p>
							<?php }
								
							

						?>

						
						
					</div>
				</div>
			</div>
		</div>

	</div>

</div>
<?php

	get_footer('dashboard');
}else{
	header('Location: ' . get_permalink(1310));
}
?>
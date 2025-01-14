<?php 
/**Provider Facilities**/
/****Education******/
$Eduargs = array(  
 	'post_type' => 'education',
 	'post_status' => 'publish',
 	'posts_per_page' => -1,
 	'author' => $userID,
 );
 $Eduloop = new WP_Query( $Eduargs ); 
if ( $Eduloop->have_posts()  ){ 
echo '<h3>Education</h3>';	
echo '<ul class="education_display_lists display_lists">';
while ( $Eduloop->have_posts() ) : $Eduloop->the_post();
		$degreetype = get_field('degree_type' );
		$degreename = get_field('name_of_the_degree');
		$schoolName = get_field('name_of_school');
		$started_month = get_field('started_month');
		$started_year = get_field('started_year');
		$enddate_month = get_field('graduation_month');
		$enddate_year = get_field('graduation_year');
		$enrolled = get_field('currently_enrolled');
		$degreeaddress = get_field('address_of_school');
		$degreesub = get_field('add_subject');
		$verified = get_field('verified__unverified');
 		$postId = get_the_ID();
		$education = get_post_meta( $postId, 'postSorting', true );
 		$post_slug = $post->post_name;
		$imgs = get_post_meta($postId,'education_attachment_id',true);
 		$meta = explode(',', $imgs);
 		?>
<li> 		
<?php echo $degreetype; ?>
<?php
if ($verified == 'Verified') 
  {
	echo '<div class="verified_icon verified">Verified</div>';
  } 
  else 
  {
  	echo '<div class="verified_icon not_verified"> Not verified</div>';
  } 
?>	
</li>						
<?php 		
endwhile;
echo '</ul>';
 }

/******License******/ 
$Licenseargs = array(  
	'post_type' => 'licenses',
	'post_status' => 'publish',
	'author' => $userID,
	'posts_per_page' => -1,
);
$Licloop = new WP_Query( $Licenseargs );
if ( $Licloop->have_posts()  ){ 
echo '<h3>Licenses</h3>';	
echo '<ul class="education_display_lists display_lists">';
while ( $Licloop->have_posts() ) : $Licloop->the_post();
	$Licverified = get_field('verified__unverified');
?>
<li> 		
<?php echo get_field('licenses_state').' '; ?><span><?php echo get_field('licenses_type'); ?></span>
<?php
if ($Licverified == 'Verified') 
  {
	echo '<div class="verified_icon verified">Verified</div>';
  } 
  else 
  {
  	echo '<div class="verified_icon not_verified"> Not verified</div>';
  } 
?>
</li>
<?php	
endwhile;	
echo '</ul>';
}

/******Board and Certificate******/ 
$Boardargs = array(  
	'post_type' => 'certifications',
	'post_status' => 'publish',
	'author' => $userID,
	'posts_per_page' => -1,
);
$Boardloop = new WP_Query( $Boardargs );
if ( $Boardloop->have_posts()  ){ 
echo '<h3>Board and Professional Certifications</h3>';	
echo '<ul class="education_display_lists display_lists">';
while ( $Boardloop->have_posts() ) : $Boardloop->the_post();
	$Boardverified = get_field('verified__unverified');
	$cert_type = get_field('certificate_type');
	if($cert_type == 'OTHER' && $otherNam != '')
 		{
 			$otherNam = $otherNam;
 		}
 		else
 		{
 			$otherNam = $cert_type;
 		}
?>
<li> 		
<?php echo $otherNam; ?>
<?php
if ($Boardverified == 'Verified') 
  {
	echo '<div class="verified_icon verified">Verified</div>';
  } 
  else 
  {
  	echo '<div class="verified_icon not_verified"> Not verified</div>';
  } 
?>
</li>
<?php	
endwhile;	
echo '</ul>';
}

/******Malware Insurance******/ 
$Insargs = array(  
	'post_type' => 'insurance',
	'post_status' => 'publish',
	'author' => $userID,
	'posts_per_page' => -1,
);
$Insloop = new WP_Query( $Insargs );
if ( $Insloop->have_posts()  ){ 
echo '<h3>Malware Insurance</h3>';	
echo '<ul class="education_display_lists display_lists">';
while ( $Insloop->have_posts() ) : $Insloop->the_post();
	$insurancelibility = get_field('liability_insurance' );
	$Insverified = get_field('verified__unverified');
?>
<li> 		
<?php echo $insurancelibility; ?>
<?php
if ($Insverified == 'Verified') 
  {
	echo '<div class="verified_icon verified">Verified</div>';
  } 
  else 
  {
  	echo '<div class="verified_icon not_verified"> Not verified</div>';
  } 
?>
</li>
<?php	
endwhile;	
echo '</ul>';
}
?>
<style>
.verified_icon.not_verified {
    border: 1px solid;
    background: #015084;
    color: #fff;
    font-size: 12px;
    padding: 2px 8px;
    border-radius: 5px;
}
.verified_icon.verified {
    border: 1px solid;
    font-size: 12px;
    background: green;
    color: #fff;
    padding: 2px 8px;
    border-radius: 5px;
}
div#nav-verification ul.education_display_lists.display_lists li {
    margin-bottom: 10px;
}
</style>
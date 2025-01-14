<?php

include('fpdf.php');
include('pdfCodeGenerator.php');
require_once("../../../../wp-load.php");
global $wpdb;
$user_id = $_GET['uID'];

$user_info = get_userdata( $user_id );
$role = $user_info->roles;
$first_name = get_user_meta($user_id,'first_name',true);
$last_name =  get_user_meta($user_id,'last_name',true);
$fullname = $first_name.' '.$last_name;

$userid_filed = 'user_'.$user_id;
$specciality = get_field('specialty', $userid_filed);
$phoneno = get_field('phone_no',$userid_filed);

//Home address
$userstreet = get_field('streetapt',$userid_filed);
$usercity = get_field('city',$userid_filed);
$userstate = get_field('state',$userid_filed);
$userzipcode = get_field('zip_code',$userid_filed);	
$yearExp = get_field('year_of_experience',$userid_filed);



$html = '<div class="usercontentMeta"><h1 style="font-size:50px; font-weight:bold;"><b>'.$fullname.'</b></h1><br>';
$html .= '<p>'.$specciality.'</p><br>'.$role[0];
$html .= '<br><br><p>'.$user_info->user_email.'</p>';
$html .= '<br><p>'.$phoneno.'</p>';
$html .= '<br><p>'.$userstreet.','.$usercity.','.$userstate.','.$userzipcode.'</p>';
$html .= '</div>';
$args = array(  
'post_type' => 'licenses',
'post_status' => 'publish',
'author' => $user_id,
);

$loop = new WP_Query( $args ); 
if ( $loop->have_posts()  ){  
	$html .='<br><br><ul class="licenses_display_lists display_lists"><h1 style="font-size:50px; font-weight:bold;"><b>Licenses</b></h1><br>';
while ( $loop->have_posts() ) : $loop->the_post();
	$postId = get_the_ID();
	$typeL = get_field('licenses_type');
	$lccompact = get_field('licenses_compact');
	$numberL = get_field('licenses_number');
	$stateL = get_field('licenses_state');
	$dt2 = get_field('expire_date');

	if($lccompact == 1){
	$val_compact = 'Yes';
	}else{
	$val_compact = 'No';
	};
		
	$html .= '<br><li style="list-style:disc;">'.$typeL.','.$stateL.', Expires '.$dt2.','.$numberL.'</li><br>';

	endwhile;				     
    $html .='</ul>';
    }else{	
    }

	$args2 = array(  
	'post_type' => 'certifications',
	'post_status' => 'publish',
	'author' => $user_id,
	);

	$loop = new WP_Query( $args2 ); 
	if ( $loop->have_posts()  ){  
	$html .='<br><br><ul class="licenses_display_lists display_lists"><h1 style="font-size:50px; font-weight:bold;"><b>Certifications</b></h1><br>';
	while ( $loop->have_posts() ) : $loop->the_post();
	$postId = get_the_ID();
	$cert_type = get_field('certificate_type');
	$cert_number = get_field('certification_number');
	$cert_expire = get_field('certificate_expire_date');

	$html .= '<br> <li>'.$cert_type.', Expires '.$cert_expire.'</li><br>';

	endwhile;				     
	$html .='</ul>';
	}else{	
	}

	$args3 = array(  
	'post_type' => 'work-history',
	'post_status' => 'publish',
	'author' => $user_id,
	);

	$loop = new WP_Query( $args3 ); 
	if ( $loop->have_posts()  ){  
	$html .='<br><br><ul class="licenses_display_lists display_lists"><h1 style="font-size:50px; font-weight:bold;"><b>Work History</b></h1><span>('.$yearExp.' Year of experience)<span><br>';
	while ( $loop->have_posts() ) : $loop->the_post();
	$postId = get_the_ID();
	$faclityname = get_field('facility_name');
	$spanddept = get_field('work_specialty_department');
	$workcity = get_field('work_city');
	$workstate = get_field('work_state');
	$workprofession = get_field('work_profession');
	$workstartedM = get_field('work_started_on_month');
	$workstrtedY = get_field('work_started_on_year');
	$workendM = get_field('work_ended_on_month');
	$workendY = get_field('work_ended_on_year');
	$currentywork = get_field('work_currently_here');
	$faciltytype = get_field('work_type_Ag_fc');
	$emplymenttype = get_field('work_employment_type');
	$chargeexp = get_field('work_charge_experience');
	$unitbed = get_field('unit_bed_count');
	$niculevel = get_field('nicu_level');
	$tarumalevel = get_field('trauma_level');
	$techhospital = get_field('teaching_hospital');
	$critcalacess = get_field('critical_access_hospital');
	$patientratio = get_field('patient_ratio');
	$ehrused = get_field('work_ehr_used');
	$additioncomments = get_field('additional_notes_and_comments');
	$staffingagency = get_field('work_staffing_agency');
	if($currentywork == 1){
	 $endDate = 'Present';
	}else{
		$enddate = $workendM.' '.$workendY;
	}

	if($chargeexp == 1){
		$chargeexp = 'Yes';
	}else{
		$chargeexp = 'No';
	}
	if($techhospital == 1){
		$techhospital = 'Yes';
	}else{
		$techhospital = 'No';
	}
	$html .= '<br><li><b>'.$faclityname.'</b><br><b>'.$workstartedM.' '.$workstrtedY.' - '.$enddate.'</b><br>'.$spanddept.'<br> '.$workcity.', '.$workstate.'<br>'.$emplymenttype.', Employed by '.$faciltytype.'<br> Charge Experience: '.$chargeexp.'<br>Additional Comments: '.$additioncomments.'<br> Teaching Hospital: '.$techhospital.'<br>Patient Ratio: '.$patientratio.':1<br> Unit Bed Count: '.$unitbed.'<br>Trauma Level: '.$tarumalevel.'<br>NICU Level: '.$niculevel.'<br> EHR: '.$ehrused.'</li><br>';

	endwhile;				     
	$html .='</ul>';
	}else{	
	}

	$args2 = array(  
	'post_type' => 'work-history-gap',
	'post_status' => 'publish',
	'author' => $user_id,
	);

	$loop = new WP_Query( $args2 ); 
	if ( $loop->have_posts()  ){  
	$html .='<br><ul class="licenses_display_lists display_lists"><br>';
	while ( $loop->have_posts() ) : $loop->the_post();
	$postId = get_the_ID();
	$gap_reson = get_field('gap_reson');
	$gap_additional_comments = get_field('gap_additional_comments');
	$gap_city = get_field('gap_city');
	$gap_state = get_field('gap_state');
	$gap_started_M = get_field('gap_started_M');
	$gap_started_Y = get_field('gap_started_Y');
	$gap_ended_M = get_field('gap_ended_M');
	$gap_ended_Y = get_field('gap_ended_Y');
	$gapdate = $gap_started_M.' '.$gap_started_Y.' - '.$gap_ended_M.' '.$gap_ended_Y;

	$html .= '<br><li><b>'.$gap_reson.'</b><br><b>'.$gapdate.'</b><br><br> Additional Comments:'.$gap_additional_comments.'</li><br>';

	endwhile;				     
	$html .='</ul>';
	}else{	
	}


$args4 = array(  
	'post_type' => 'education',
	'post_status' => 'publish',
	'author' => $user_id,
	);

	$loop = new WP_Query( $args4 ); 
	if ( $loop->have_posts()  ){  
	$html .='<br><br><ul class="licenses_display_lists display_lists"><h1 style="font-size:50px; font-weight:bold;"><b>Education
</b></h1><br>';
	while ( $loop->have_posts() ) : $loop->the_post();
	$postId = get_the_ID();
	$degreetype = get_field('degree_type' );
	$degreename = get_field('name_of_the_degree');
	$schoolName = get_field('name_of_school');
	$started_month = get_field('started_month');
	$started_year = get_field('started_year');
	$enddate_month = get_field('graduation_month');
	$enddate_year = get_field('graduation_year');
	$enrolled = get_field('currently_enrolled');


if($started_month && $started_year && $enrolled == 1 && $enddate_month == '' && $enddate_year == ''){

$eduDate =  $started_month.' '.$started_year.' - (Current Student)';

}else if($started_month && $started_year && $enddate_month && $enddate_year && $enrolled == 1 ){

$eduDate = $started_month.' '.$started_year.' - '.$enddate_month.' '.$enddate_year.' (Current Student)';
}else{
	if($started_month && $started_year && $enddate_month && $enddate_year)
	{
	$eduDate = $started_month.' '.$started_year.' - '.$enddate_month.' '.$enddate_year;
	}
	else if($started_month && $started_year)
	{
	$eduDate = $started_month.' '.$started_year;

	}else{
	$eduDate = '';
	}
}

	$html .= '<br><li>'.$degreename.' '.$degreetype.', '.$schoolName.', '.$eduDate.'</li><br>';

	endwhile;				     
	$html .='</ul>';
	}else{	
	}


	$pdf = new PDF();
	// First page
	$pdf->AddPage();
	$pdf->SetFont('Helvetica', '', 12);
	$link = $pdf->AddLink();
	$pdf->WriteHTML($html);
	$pdf->Output('I');
	 //$pdf->Output('D'/);

?>


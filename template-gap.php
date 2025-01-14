<?php
if(is_user_logged_in()){
/*
* Template Name: Work History Gap
*/

get_header('dashboard');
ob_start();
echo get_template_part( 'template-headers/sidebar-dashboard' );

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

$current_user = wp_get_current_user();
$uid = get_current_user_id();
$gapid = $_GET['gapid'];
$gap_reson = get_field('gap_reson',$gapid);
$gap_additional_comments = get_field('gap_additional_comments',$gapid);
$gap_city = get_field('gap_city',$gapid);
$gap_state = get_field('gap_state',$gapid);
$gap_started_M = get_field('gap_started_M',$gapid);
$gap_started_Y = get_field('gap_started_Y',$gapid);
$gap_ended_M = get_field('gap_ended_M',$gapid);
$gap_ended_Y = get_field('gap_ended_Y',$gapid);

?>
<div class="topSuccessMsg">
	<div class="alert alert-success fade hide submitsave" role="alert">
	Your data is Saved!
	</div>
</div>
<div class="topfailedMsg">
	<div class="alert alert-danger fade hide submitfail" role="alert">
	Your data is not saved!
	</div>
</div>
<div class="content licenses_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
			<form id="gap_work_history_form" class="gap_work_history_form" method="post" enctype="multipart/form-data" autocomplete="off" method="post">
   			<input name="gapid" type="hidden" id="gapid" value="<?php echo $gapid; ?>">
   			<input type="hidden" name="work_gap_name" value="" id="work_gap_name">
   			
			<h4 class="form-heading">
			  Gap In Employment
			</h4>
			<div class="row">
			  <div class="col-12 col-md-12">
			     <div class="form-group">
			        <label for="work_history_name">Reason</label>
			        <div class="select-wrapper flex-grow-1 ">
			           <select autofocus="" class="gapwork_name" id="work_history_name" maxlength="255" name="work_history_name" required="">
			              <option value=""></option>
						  <option <?php if($gap_reson == 'Attending School'){echo 'selected';} ?> value="attending_school">Attending School</option>
			              <option <?php if($gap_reson == 'Family Commitment'){echo 'selected';} ?> value="family_commitment">Family Commitment</option>
			              <option <?php if($gap_reson == 'Mission Trip'){echo 'selected';} ?> value="mission_trip">Mission Trip</option>
			              <option <?php if($gap_reson == 'Non-Clinical Employment'){echo 'selected';} ?> value="non_clinical_employment">Non-Clinical Employment</option>
			              <option <?php if($gap_reson == 'Personal Time Off'){echo 'selected';} ?> value="personal_time_off">Personal Time Off</option>
			              <option <?php if($gap_reson == 'Vacation'){echo 'selected';} ?> value="vacation">Vacation</option>
			           </select>
			         
			        </div>
			     </div>
			  </div>
			  <div class="col-12 col-md-12">
			     <div class="form-group">
			        <label for="work_history_additional_comments">Explanation of why there is a gap</label>
			        <textarea class="character-counter" data-length="500" id="work_history_additional_comments" name="work_additional_comments" rows="4" maxlength="500"><?php if($gap_additional_comments){ echo $gap_additional_comments;} ?></textarea>			         
			     </div>
			  </div>
			</div>
			<div class="row">
			  <div class="col-12 col-md-6">
			     <div class="form-group">
			        <label for="work_history_city">City (optional)</label>
			        <input autocomplete="address-level2" class="form-control" id="work_history_city" name="work_history_city" type="text" value="<?php if($gap_city){echo $gap_city;} ?>">
			     </div>
			  </div>
			  <div class="col-12 col-md-6">
			     <div class="form-group">
			        <label for="work_history_province_id">State (optional)</label>
			        <div class="select-wrapper flex-grow-1 ">
			           <select autocomplete="address-level1" class="" id="work_history_province_id" name="work_history_province_id">
						<option value=""></option>
						<option <?php if($gap_state =='Alabama'){echo 'selected';} ?> value="Alabama">Alabama</option>
						<option <?php if($gap_state =='Alaska'){echo 'selected';} ?> value="Alaska">Alaska</option>
						<option <?php if($gap_state =='Arizona'){echo 'selected';} ?> value="Arizona">Arizona</option>
						<option <?php if($gap_state =='American Samoa'){echo 'selected';} ?> value="American Samoa">American Samoa</option>
						<option <?php if($gap_state =='Arkansas'){echo 'selected';} ?> value="Arkansas">Arkansas</option>
						<option <?php if($gap_state =='California'){echo 'selected';} ?>value="California">California</option>
						<option <?php if($gap_state =='Colorado'){echo 'selected';} ?> value="Colorado">Colorado</option>
						<option <?php if($gap_state =='Connecticut'){echo 'selected';} ?> value="Connecticut">Connecticut</option>
						<option <?php if($gap_state =='Delaware'){echo 'selected';} ?>  value="Delaware">Delaware</option>
						<option <?php if($gap_state =='District Of Columbia'){echo 'selected';} ?>  value="District Of Columbia">District Of Columbia</option>
						<option <?php if($gap_state =='Florida'){echo 'selected';} ?> value="Florida">Florida</option>
						<option <?php if($gap_state =='Georgia'){echo 'selected';} ?> value="Georgia">Georgia</option>
						<option <?php if($gap_state =='Guam'){echo 'selected';} ?> value="Guam">Guam</option>
						<option <?php if($gap_state =='Hawaii'){echo 'selected';} ?> value="Hawaii">Hawaii</option>
						<option <?php if($gap_state =='Idaho'){echo 'selected';} ?> value="Idaho">Idaho</option>
						<option <?php if($gap_state =='Illinois'){echo 'selected';} ?> value="Illinois">Illinois</option>
						<option <?php if($gap_state =='Indiana'){echo 'selected';} ?> value="Indiana">Indiana</option>
						<option <?php if($gap_state =='Iowa'){echo 'selected';} ?> value="Iowa">Iowa</option>
						<option <?php if($gap_state =='Kansas'){echo 'selected';} ?> value="Kansas">Kansas</option>
						<option <?php if($gap_state =='Kentucky'){echo 'selected';} ?> value="Kentucky">Kentucky</option>
						<option <?php if($gap_state =='Louisiana'){echo 'selected';} ?> value="Louisiana">Louisiana</option>
						<option <?php if($gap_state =='Maine'){echo 'selected';} ?> value="Maine">Maine</option>
						<option <?php if($gap_state =='Maryland'){echo 'selected';} ?> value="Maryland">Maryland</option>
						<option <?php if($gap_state =='Massachusetts'){echo 'selected';} ?> value="Massachusetts">Massachusetts</option>
						<option <?php if($gap_state =='Michigan'){echo 'selected';} ?> value="Michigan">Michigan</option>
						<option <?php if($gap_state =='Minnesota'){echo 'selected';} ?> value="Minnesota">Minnesota</option>
						<option <?php if($gap_state =='Mississippi'){echo 'selected';} ?> value="Mississippi">Mississippi</option>
						<option <?php if($gap_state =='Missouri'){echo 'selected';} ?> value="Missouri">Missouri</option>
						<option <?php if($gap_state =='Montana'){echo 'selected';} ?> value="Montana">Montana</option>
						<option <?php if($gap_state =='Nebraska'){echo 'selected';} ?> value="Nebraska">Nebraska</option>
						<option <?php if($gap_state =='Nevada'){echo 'selected';} ?> value="Nevada">Nevada</option>
						<option <?php if($gap_state =='New Hampshire'){echo 'selected';} ?> value="New Hampshire">New Hampshire</option>
						<option <?php if($gap_state =='New Jersey'){echo 'selected';} ?> value="New Jersey">New Jersey</option>
						<option <?php if($gap_state =='New Mexico'){echo 'selected';} ?> value="New Mexico">New Mexico</option>
						<option <?php if($gap_state =='New York'){echo 'selected';} ?> value="New York">New York</option>
						<option <?php if($gap_state =='North Carolina'){echo 'selected';} ?> value="North Carolina">North Carolina</option>
						<option <?php if($gap_state =='North Dakota'){echo 'selected';} ?> value="North Dakota">North Dakota</option>
						<option <?php if($gap_state =='Northern Mariana Islands'){echo 'selected';} ?> value="Northern Mariana Islands">Northern Mariana Islands</option>
						<option <?php if($gap_state =='Ohio'){echo 'selected';} ?> value="Ohio">Ohio</option>
						<option <?php if($gap_state =='Oklahoma'){echo 'selected';} ?> value="Oklahoma">Oklahoma</option>
						<option <?php if($gap_state =='Oregon'){echo 'selected';} ?> value="Oregon">Oregon</option>
						<option <?php if($gap_state =='Pennsylvania'){echo 'selected';} ?> value="Pennsylvania">Pennsylvania</option>
						<option <?php if($gap_state =='Puerto Rico'){echo 'selected';} ?> value="Puerto Rico">Puerto Rico</option>
						<option <?php if($gap_state =='Rhode Island'){echo 'selected';} ?> value="Rhode Island">Rhode Island</option>
						<option <?php if($gap_state =='South Carolina'){echo 'selected';} ?> value="South Carolina">South Carolina</option>
						<option <?php if($gap_state =='South Dakota'){echo 'selected';} ?> value="South Dakota">South Dakota</option>
						<option <?php if($gap_state =='Tennessee'){echo 'selected';} ?> value="Tennessee">Tennessee</option>
						<option <?php if($gap_state =='Texas'){echo 'selected';} ?> value="Texas">Texas</option>
						<option <?php if($gap_state =='United States Minor Outlying Islands'){echo 'selected';} ?> value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
						<option <?php if($gap_state =='Utah'){echo 'selected';} ?> value="Utah">Utah</option>
						<option <?php if($gap_state =='Vermont'){echo 'selected';} ?> value="Vermont">Vermont</option>
						<option <?php if($gap_state =='Virgin Islands'){echo 'selected';} ?> value="Virgin Islands">Virgin Islands</option>
						<option <?php if($gap_state =='Virginia'){echo 'selected';} ?> value="Virginia">Virginia</option>
						<option <?php if($gap_state =='Washington'){echo 'selected';} ?> value="Washington">Washington</option>
						<option <?php if($gap_state =='West Virginia'){echo 'selected';} ?> value="West Virginia">West Virginia</option>
						<option <?php if($gap_state =='Wisconsin'){echo 'selected';} ?> value="Wisconsin">Wisconsin</option>
						<option <?php if($gap_state =='Wyoming'){echo 'selected';} ?> value="Wyoming">Wyoming</option>
			           </select>
			          
			        </div>
			     </div>
			  </div>
			</div>
			<div class="row">
			  <div class="col-12 col-md-6">
			    <div class="form-group row">     	
			    <label for="work_history_started_on" style="display: block;">Started</label>
			    <div class="col-12 col-md-6">
			        <div class="select-wrapper date-select-wrapper">
			           <select class="date-select month-select gap_month_start" id="work_history_started_on_month" name="work_history_started_on_month" required>
			              <option value="">Month</option>
						<?php 

							for($m=1; $m<=12; ++$m){

							    $monthsdate = date('F', mktime(0, 0, 0, $m, 1));
							    	if( $monthsdate == $gap_started_M){
							    		$selected = 'selected';
							    	}else{
							    		$selected = '';
							    	}
							    echo '<option '.$selected.' value="'.$monthsdate.'">'.$monthsdate.'</option>';
							}

								?>
			           </select>
			           
			        </div>
			    </div>
			    <div class="col-12 col-md-6">
			        <div class="select-wrapper date-select-wrapper">
			            <select class="date-select month-select gap_year_start" id="work_history_started_on_year" name="work_history_started_on_year" required>
			              <option value="">Year</option>
			              <?php 
											$year = date('Y');
											$min = $year - 60;
											$max = $year;
											for( $i=$max; $i>=$min; $i-- ) {
												if($i == $gap_started_Y){
													$selected = 'selected';
												}else{
													$selected = '';
												}
											echo '<option '.$selected.' value='.$i.'>'.$i.'</option>';
											}
			 							?>
			            </select>  
			        </div>
			     </div>
			    </div>
			</div>
			<div class="col-12 col-md-6">
			    <div class="form-group row">
			    <label for="work_history_ended_on" style="display: block;">Ended</label>
			    <div class="col-12 col-md-6">
			        <div class="select-wrapper date-select-wrapper">
			           <select class="date-select month-select gap_month_end" id="work_history_ended_on_month" name="work_history_ended_on_month" required>
			              <option value="">Month</option>
			              <?php 

										for($m=1; $m<=12; ++$m){

										    $monthsdate = date('F', mktime(0, 0, 0, $m, 1));
										    	if( $monthsdate == $gap_ended_M){
										    		$selected = 'selected';
										    	}else{
										    		$selected = '';
										    	}
										    echo '<option '.$selected.' value="'.$monthsdate.'">'.$monthsdate.'</option>';
										}

											?>
			           </select>
			           
			        </div>
			    </div>
			    <div class="col-12 col-md-6">
			        <div class="select-wrapper date-select-wrapper">
			            <select class="date-select month-select gap_year_end" id="work_history_ended_on_year" name="work_history_ended_on_year" required>
			              <option value="">Year</option>
			               <?php 
												$year = date('Y');
												$min = $year - 60;
												$max = $year;
												for( $i=$max; $i>=$min; $i-- ) {
													if($i == $gap_ended_Y){
														$selected = 'selected';
													}else{
														$selected = '';
													}
												echo '<option '.$selected.' value='.$i.'>'.$i.'</option>';
												}
				 							?>
			            </select>
			        </div>
			    </div>
			    </div>
			  </div>
			</div>
			<div class="form-group form-actions">
			  <button class="btn btn-primary submitFormProfil" name="gapsubmit" id="gapsubmit" type="submit">Save Changes</button>
			  <a class="btn btn-cancel" href="<?php echo get_site_url(); ?>/profile#workHistory">Cancel</a>
			</div>
			</form>
		</div>
	</div>
</div>
<?php
if(isset($_POST['gapsubmit'])){
	$gapid = $_POST['gapid'];
	$work_history_name  = $_POST['work_gap_name'];
	$work_additional_comments = $_POST['work_additional_comments'];
	$work_history_city = $_POST['work_history_city'];
	$work_history_province_id = $_POST['work_history_province_id'];
	$work_history_started_on_month = $_POST['work_history_started_on_month'];
	$work_history_started_on_year = $_POST['work_history_started_on_year'];
	$work_history_ended_on_month = $_POST['work_history_ended_on_month'];
	$work_history_ended_on_year = $_POST['work_history_ended_on_year'];

if($work_started_on_year && $work_ended_on_year =='' ){
	echo '<script>alert(End date is balnk please select date else select "I am currently work here"");</script>';
	exit;
}else{
		if($gapid == ''){
			$postid = wp_insert_post(array (
		   'post_type' => 'work-history-gap',
		   'post_title' => $work_history_name,
		   'post_status' => 'publish',
		   'meta_input' => array(
				'gap_reson' =>  $work_history_name,
				'gap_additional_comments' => $work_additional_comments,
				'gap_city' => $work_history_city,
				'gap_state' => $work_history_province_id,
				'gap_started_M' => $work_history_started_on_month,
				'gap_started_Y' => $work_history_started_on_year,
				'gap_ended_M' => $work_history_ended_on_month,
				'gap_ended_Y' => $work_history_ended_on_year,
				
		    ),
		));
		echo "<script> 
		Swal.fire({
			title: 'success!',
			text: 'Your data has been saved!',
			icon: 'success',
			showConfirmButton: true,
			allowOutsideClick: true,
			allowEscapeKey: false,
			confirmButtonColor: '#40BFB9',
			});
		</script>";

		}
		else
		{
		$postid = $gapid;
		$my_post = array(
		  'ID'           => $postid,
		  'post_title' => $work_history_name,
			);
			wp_update_post( $my_post );

			update_post_meta($gapid, 'gap_reson', $work_history_name);
			update_post_meta($gapid, 'gap_additional_comments', $work_additional_comments);
			update_post_meta($gapid, 'gap_city', $work_history_city);
			update_post_meta($gapid, 'gap_state', $work_history_province_id);
			update_post_meta($gapid, 'gap_started_M', $work_history_started_on_month);
			update_post_meta($gapid, 'gap_started_Y', $work_history_started_on_year);
			update_post_meta($gapid, 'gap_ended_M', $work_history_ended_on_month);
			update_post_meta($gapid, 'gap_ended_Y', $work_history_ended_on_year);
			$url = get_site_url().'/profile';
			wp_redirect( $url );
			exit;
		}


	}
}
?>
<?php
get_footer('dashboard');
}else{
	header('Location: ' . get_permalink(1310));
}
?>
<?php
if(is_user_logged_in()){
/*
* Template name: Tasks complete template
*/ 
get_header('dashboard');

echo get_template_part( 'template-headers/sidebar-dashboard' );

$current_user = wp_get_current_user();
$username = $current_user->user_login;
$query_args = array(
    'relation' => 'OR',
        array(
            'key'     => 'user_agency_name',
            'value'   =>   $username,              
            'compare' => '='
        ),
        array(
            'key'     => 'user_agency_name', 
            'value'   =>   $username,                 
            'compare' => 'NOT EXISTS'
        )
);

    $meta_query = new WP_Meta_Query($query_args);

    $args = array(
    'order' => 'ASC',
    'meta_key' => 'user_agency_name',
    'meta_query' => $meta_query
    );
$agencieslist = get_users($args);
 $author_ids = array();
foreach ($agencieslist as $user) 
{ 
	if($user)
	{
		array_push($author_ids, $user->ID);
	}
}
?>
<div class="content edit_content">
	<div class="container pt-5 ps-5 pe-5 pb-1">
		<div class="row">
			<h3>Payors</h3>
			<?php
			$args = array(  
                'post_type' => 'insurance',
                'post_status' => 'publish',
               'posts_per_page' => -1,
               'meta_key' => 'insurance_ended_year',
               'orderby' => 'meta_value_num',
               'order' => 'DESC',
               'author__in' => $author_ids,
            );
            $loop = new WP_Query( $args );
            if ( $loop->have_posts()  ){
            ?>	
            <table>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Date enrolled</th>
                                                <th>Expiry date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            	$today = date("F-m");
                                            	while ( $loop->have_posts() ) : $loop->the_post(); 
                                                $insurancelibility = get_field('liability_insurance' );
                                                $insucompany = get_field('insurance_company');
                                                $insuaddress = get_field('address_insurance');
                                                $insuphnnumber = get_field('insurance_phone_number');
                                                $started_month = get_field('insurance_started_month');
                                                $started_year = get_field('insurance_started_year');
                                                $enddate_month = get_field('insurance_ended_month');
                                                $enddate_year = get_field('insurance_ended_year');
                                                $postId = get_the_ID();
                                                $imgs = get_post_meta($postId,'insurance_attachment_id',true);
                                                $meta = explode(',', $imgs);

                                                $expireDate = $enddate_year.'-'.$enddate_month;
                                                if(strtotime($expireDate) < strtotime($today) && $enddate_month != '' && $enddate_year != '')
                                                {
                                            ?>
                                                <tr>
                                                <td><?php echo $insurancelibility; ?></td>
                                                <td><?php echo $insuaddress; ?></td>
                                                <td><?php echo $started_month.' '.$started_year; ?></td>
                                                <td><?php echo $enddate_month.' '.$enddate_year; ?></td>
                                                </tr>
                                            <?php 
                                        		}
                                            endwhile;
                                            ?>
                                        </tbody>
                                    </table>

            <?php }
            else{
            	echo 'No data available.';
            }	
			?>

			<h3>Facilities/Contract</h3>
			<?php
			$args2 = array(  
                'post_type' => 'work-history',
                'post_status' => 'publish',
               'posts_per_page' => -1,
               'meta_key' => 'work_ended_on_year',
               'orderby' => 'meta_value_num',
               'order' => 'DESC',
               'author__in' => $author_ids,
            );
            $loop2 = new WP_Query( $args2 );
            if ( $loop2->have_posts()  ){
            ?>	
            <table>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Date enrolled</th>
                                                <th>Expiry date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            	$today = date("y-F");
                                            	while ( $loop2->have_posts() ) : $loop2->the_post(); 
                     

                     							$workstartedM = get_field('work_started_on_month');
												$workstrtedY = get_field('work_started_on_year');
                                                $workendM = get_field('work_ended_on_month');
												$workendY = get_field('work_ended_on_year');

												$workcity = get_field('work_city');
												$workstate = get_field('work_state');
												$workaddress = get_field('work_address');
												$workzipcode = get_field('work_zip_code');
												if($workaddress)
												{
													$workaddress = $workaddress.', ';
												}
												if($workcity)
												{
													$workcity = $workcity.', ';
												}
												if($workstate)
												{
													$workstate = $workstate.', ';
												}
												if($workzipcode)
												{
													$workzipcode = $workzipcode;
												}

												$fullAddress = $workaddress.$workcity.$workstate.$workzipcode; 
      

                                                $expireDate = $workendY.'-'.$workendM;
                                                if(strtotime($expireDate) < strtotime($today) && $workendM != '' && $workendY != '')
                                                {
                                            ?>
                                                <tr>
                                                <td><?php echo get_the_title(); ?></td>
                                                <td><?php echo $fullAddress; ?></td>
                                                <td><?php echo $workstartedM.' '.$workstrtedY; ?></td>
                                                <td><?php echo $workendM.' '.$workendY; ?></td>
                                                </tr>
                                            <?php 
                                        		}
                                            endwhile;
                                            ?>
                                        </tbody>
                                    </table>

            <?php }
            else{
            	echo 'No data available.';
            }	
			?>

        </div>
    </div>
</div>        
<?php
get_footer('dashboard');
}else{
header('Location: ' . get_permalink(1310));
}
?>
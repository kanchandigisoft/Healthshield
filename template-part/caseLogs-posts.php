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
 	'post_type' => 'case-logs',
 	'post_status' => 'publish',
    'posts_per_page' => 5,
 	'author' => $User_Id,
 );

 $loop = new WP_Query( $args ); 
 $numberOfPosts= $loop->found_posts;
 if ( $loop->have_posts()  ){  
 	echo '<ul id="datafetch" class="caselogs_display_lists display_lists">';
 	while ( $loop->have_posts() ) : $loop->the_post();
     $index = $loop->current_post + 1;
     $postId = get_the_ID();

     $caselogs = get_post_meta( $postId, 'postSorting', true );

     $day = get_post_meta($postId, 'day', true);
     $month = get_post_meta($postId, 'month', true);
     $year = get_post_meta($postId, 'year', true);

     if($day)
    {
        $day = $day.' Days';
    }
    else
    {
        $day = '';
    }

    if($month)
    {
        $month = $month.' Months';
    }
    else
    {
        $month = '';
    }

    if($year)
    {
        $year = $year.' Years';
    }
    else
    {
        $year = '';
    }

    $fullAge = $year.' '.$month.' '.$day;
                    
     $post_slug = $post->post_name;
     $fcname = get_field('facility_name_case');
     $agecase = get_field('age_case');
     $gendercase = get_field('gender_case');
     $phystatus = get_field('physical_status_case');
     $traumaemg = get_field('traumaemergency_case');
     $clinicalnot = get_field('clinical_notes_case');
     $peripheral = get_field('peripheral_case');
     $document_name = get_field('document_name');
     $datecaselog = get_field('case_log_date');
     $imgs = get_post_meta($postId,'caselogs_attachment_id',true);
 	 $meta = explode(',', $imgs);

     if($imgs ){ $count = count($meta); }

     $AnesthesiaTypevalues = get_post_meta($postId,'AnesthesiaType_data',true);
     $administartionvalues = get_post_meta($postId,'administration_data',true);
     $Proceduresvalues = get_post_meta($postId,'AnesthesiaProcedures_data',true);
     $AnatomicalCategoryvalues = get_post_meta($postId,'AnatomicalCategory_data',true);

     $va1 = explode(',', $AnesthesiaTypevalues);
     $va2 = explode(',', $administartionvalues);
     $va3 = explode(',', $Proceduresvalues);
     $va4 = explode(',', $AnatomicalCategoryvalues);

     $vaules1 = array_unique($va1);
     $vaules2 = array_unique($va2);
     $vaules3 = array_unique($va3);
     $vaules4 = array_unique($va4);

     ?>
    <li class="caselogs_list list-display" data-post-id="<?php echo $postId; ?>" id="<?php if($caselogs){echo $caselogs;}else{ echo $index;} ?>">
        <div class="rows_lists d-flex">
            <span class="row-icon me-2">
                <i class="fal fa-clipboard-check" title="Everything is OK"></i>
            </span>

            <div class="title d-flex">
                <div class="caselogs_state caselogs_split_text">
                    <a data-bs-toggle="collapse" data-bs-target="#caselogs_<?php echo get_the_ID(); ?>" href="#"> 
                         <?php echo $fcname; ?>
                    </a>
                </div>
            </div>
            <?php
            $totalcount  = '';
             foreach ($meta as $metas) {
                if($metas){
                    $attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                    if($attch_name){
                        $totalcount =  '<i class="fal fa-paperclip"></i>'.$count;
                    }
                }
             }?>
            <div class="licattcahments">
                <?php echo $totalcount; ?>
            </div>
            <div class="action-dropdown dropdown">
                <a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger_<?php echo get_the_ID(); ?>" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu"><i class="fal fa-ellipsis-v-alt"></i></a>
                <ul aria-labelledby="action_menu_trigger_<?php echo get_the_ID(); ?>" class="dropdown-menu dropdown-menu-right">
                    <h6 class="dropdown-header caselogs_split_text"><?php echo $fcname; ?></h6>
                    <a class="dropdown-item" id="<?php $postId; ?>" href="<?php echo get_site_url();?>/profile/case-logs?caseid=<?php echo $postId; ?>">
                        <i class="fal fa-fw fa-pencil"></i> Edit
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"  href="<?php echo get_site_url();?>/profile/?archived=<?php echo $postId; ?>" data-method="put" id="archived_post" rel="nofollow"><span><i class="fal fa-fw fa-box"></i> Archive</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" rel="nofollow" id="<?php echo get_the_ID(); ?>" onclick="delete_entry(<?php echo get_the_ID(); ?>)"><span class="red-icon"><i class="fa fa-trash" aria-hidden="true"></i> Delete</span>
 					</a>
                </ul>

            </div>
        </div>
        <div id="caselogs_<?php echo get_the_ID(); ?>" class="card mt-3 collapse" style="">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-9">
                        <h5><?php echo $fcname; ?></h5>
                    </div>
                    <div class="col-lg-3">
                        <a class="card-header-link" href="<?php echo get_site_url(); ?>/case-logs/<?php echo $post_slug; ?>">
                        Details
                        <i class="fal fa-link fa-fw"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="data-row lic_rows_data">
                            <div class="data_label">
                                Facility Name:
                            </div>
                            <div class="data_values">
                            <?php echo $fcname; ?>
                            </div>
                        </div>
                        <!-- <div class="data-row lic_rows_data">
                            <div class="data_label">
                                Document Name:
                            </div>
                            <div class="data_values">
                            <?php //echo $document_name; ?>
                            </div>
                        </div> -->
                        <div class="data-row lic_rows_data">
                            <div class="data_label">
                                Age:
                            </div>
                            <div class="data_values">
                            <?php echo $fullAge; ?>
                            </div>
                        </div>
                        <div class="data-row lic_rows_data">
                            <div class="data_label">
                                Gender:
                            </div>
                            <div class="data_values">
                            <?php echo $gendercase; ?>
                            </div>
                        </div>
                        <div class="data-row lic_rows_data">
                            <div class="data_label">
                                Date:
                            </div>
                            <div class="data_values">
                            <?php echo $datecaselog; ?>
                            </div>
                        </div>
                        <div class="data-row lic_rows_data">
                            <div class="data_label">
                                Physcial Status:
                            </div>
                            <div class="data_values">
                            <?php echo $phystatus; ?>
                            </div>
                        </div>
                        <div class="data-row lic_rows_data">
                            <div class="data_label">
                                Trauma/Emergency:
                            </div>
                            <div class="data_values">
                            <?php echo $traumaemg; ?>
                            </div>
                        </div>

                        <div class="attachemnt_list">
                            <div class="data_label">
                                Attachments:
                            </div>
							<div class="data_values">
                             <?php
                                foreach ($meta as $metas) {
                                    if($metas){
                                        $attch_name = basename( get_attached_file($metas ) ); // Just the file name;
                                        $attach_url = wp_get_attachment_url( $metas );
                                        //$count = count($metas);
                                        if($attch_name){
                                            $loopattach = '<div class="d-flex">
                                                <div class="attach_flex d-flex" id="'.$metas.'">
                                                <i class="mr-2 fal fa-file-image healthshiled-green-text"></i>
                                                <div class="attchName"><a href="'.$attach_url.'" target="_blank" class="attach_url_link">'.$attch_name.'</a></div>
                                                </div>
                                                <div class="action-dropdown dropdown">
                                                <a aria-haspopup="true" aria-expanded="false" class="dropdown-toggle action-dropdown-trigger" data-bs-toggle="dropdown" href="#" id="action_menu_trigger" role="button" title="Toggle Action Menu">
                                                <i class="fal fa-ellipsis-v-alt"></i></a>

                                                <ul aria-labelledby="action_menu_trigger" class="dropdown-menu dropdown-menu-right" style="">

                                                <a class="text-muted dropdown-item" id="deleteAttach_id" href="'.get_site_url().'/profile/?deleteAttach='.$metas.'"><span><i class="fal fa-fw fa-ban"></i>Delete</span></a>


                                                <div class="dropdown-divider"></div>

                                                </ul>
                                                </div></div>';
                                            echo $loopattach;
                                        }
                                    }
                                }
                                ?>
					        </div>
				        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="data-row lic_rows_data">
                            <div class="data_labels">
                               <b> Anesthesia Type:</b>

                            <ul>
                                <?php foreach($vaules1 as $antype){
                                    echo '<li>'.$antype.'</li>';
                                } ?>
                            </ul>
                            </div>
                        </div>
                        <div class="data-row lic_rows_data">
                            <div class="data_labels">
                                <b>Administration:</b>

                            <ul>
                                <?php foreach($vaules2 as $admin){
                                    echo '<li>'.$admin.'</li>';
                                } ?>
                            </ul>
                            </div>
                        </div>
                        <div class="data-row lic_rows_data">
                            <div class="data_labels">
                                <b>Anesthesia Procedures:</b>

                            <ul>
                                <?php foreach($vaules3 as $anpro){
                                    echo '<li>'.$anpro.'</li>';
                                } ?>
                            </ul>
                            </div>
                        </div>
                        <div class="data-row lic_rows_data">
                            <div class="data_labels">
                                <b>Anatomical Category:</b>

                                <ul>
                                    <?php foreach($vaules4 as $ancat){
                                        echo '<li>'.$ancat.'</li>';
                                    } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>

<?php
    endwhile;
    echo '</ul>';
}else{
	echo "Add your Clinical Information!";
}
wp_reset_postdata(); 
if($numberOfPosts > 4){
    echo '<div class="d-block text-center" id="viewAllCase"><a href="'.get_the_permalink(2248).'" class="caslogsviewall btn btn-info btn-lighter">View All</a></div>';
}else{
    
}

$arch = $_GET['archived'];
if(isset($arch)){
$postid = $arch;
$my_post = array(
'ID'           => $arch,
'post_status'   => 'draft',
);
wp_update_post( $my_post );
$url = get_site_url().'/profile';
wp_redirect( $url );
exit;
//echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
}

$deleteAttach = $_GET['deleteAttach'];
if(isset($deleteAttach)){
	$savedAttach = get_post_meta($postId, 'caselogs_attachment_id', true);
	$array_this = explode(',',$savedAttach);
	wp_delete_post($deleteAttach);
	$array_without_strawberries = array_diff($array_this, array($deleteAttach));

	//print_r($array_without_strawberries);						
	$ids = implode(',', $array_without_strawberries);
	update_post_meta($postId, 'caselogs_attachment_id', $ids);
	$url = get_site_url().'/profile';	
	//wp_redirect( $url );
	//exit;
	echo '<script type="text/javascript">window.location.href="'.$url.'"</script>';
	
}

?>

<script type="text/javascript">
jQuery('#saveOrderclog').click(function(){
	var splashArray = new Array();
	var postid = jQuery('.caselogs_list').attr('data-post-id');
	jQuery( ".user_profile_all_deatils_info ul.caselogs_display_lists .caselogs_list" ).each(function( index ) {

		var menuPos = index;
		var metaKey = jQuery( this ).attr('data-id');
		var postID = jQuery( this ).attr('data-post-id');
		splashArray.push(menuPos+'/'+postID);

	});

	var form_data = new FormData();
	form_data.append('action', 'reOrderData');
	form_data.append('changedData', splashArray);

	jQuery.ajax({
        url: '<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php',
        method: 'POST',
        data: form_data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(results) {
            if (results.status == 'success') {
            	location.reload();
            	console.log(results.msg);
            } else {
                console.log('result is wrong');
            }

        },
        error: function(error) {
            console.log('success not happens');
        }
    });
});


$(function() {
    $( ".user_profile_all_deatils_info ul.caselogs_display_lists" ).sortable();
  });

  jQuery(document).ready(function(){
    /*****************Reorder****************/       
    var divList = jQuery("ul.caselogs_display_lists.display_lists .caselogs_list");
    divList.sort(function(a, b){ return jQuery(a).attr("id")-jQuery(b).attr("id")});
    jQuery("ul.caselogs_display_lists.display_lists").html(divList);

});	

</script>
<script type="text/javascript">
function fetch(){

    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'data_fetch', keyword: jQuery('#keyword').val() },
        success: function(data) {
            jQuery('#datafetch').html( data );
        }
    });

}

</script>
<?php
/*
* Display footer dashbaord
*/
?>
<footer class="bottom-nav d-lg-none no-print">
    <a class="bottom-nav-link <?php if(is_page('dashboard')){echo 'active';} ?> " href="<?php echo get_site_url();?>/dashboard">
    <i class="fad fa-analytics"></i>
        <span>
        Dashboard
        </span>
    </a>
    <a class="bottom-nav-link <?php if(is_page('profile')){echo 'active';} ?>" href="<?php echo get_site_url();?>/profile">
        <i class="fad fa-user-circle"></i>
        <span>Profile</span>
    </a>

    <a class="bottom-nav-link <?php if(is_page('share')){echo 'active';} ?>" href="<?php echo get_site_url();?>/profile/share">
        <i class="fad fa-paper-plane"></i>
        <span>Sharing</span>
    </a>
</footer>
</main>
<script>
	jQuery(function(){
    var dateToday = new Date();

    jQuery( "#certificate_expires_on,#license_expires_on" ).datepicker({   
        dateFormat: 'dd MM yy',
        autoclose: true,
        changeMonth: true,
        changeYear: true, 
        yearRange : '+0:+30',  
    });


    jQuery(".userdatePicker").datepicker({
        dateFormat: "dd MM yy",
        changeMonth: true,
        changeYear: true,
         yearRange : '1900:+0',        
            
    });
    jQuery(".DOB,.datepickerCaselog").datepicker({
        dateFormat: "dd MM yy",
        changeMonth: true,
        changeYear: true, 
        yearRange : '1900:+0',       
    });

    jQuery(".userdatePicker_received").datepicker({
        dateFormat: "dd MM yy",
        changeMonth: true,
        changeYear: true,        
        yearRange : '1900:+0',  
    });

    jQuery('.userdatePicker_today').datepicker({
        dateFormat: 'dd MM yy',
        autoclose: true,
        changeMonth: true,
        changeYear: true, 
        yearRange : '+0:+30',  
    });
    jQuery('.flatpickr-to-today-iso,.complete_date_id,.issuedatePicker').datepicker({
        dateFormat: "dd MM yy",
        changeMonth: true,
        changeYear: true,
        yearRange : '1900:+0',  
        onSelect: function(i){
            var values = $(this).val();
            //alert(values);
            if(values){
            jQuery('#saverecord_medical').attr('disabled', false);
            }else{
            jQuery('#saverecord_medical').attr('disabled', true);
            }
        }
    });
});


/********************************************/

        jQuery("#add_attachment").click(function(e) {
            e.preventDefault();
            var wrapper = '<div class="card form-group"><div class="custom_file"><input type="file" name="upload_file[]" accept=".jpg, .png, .pdf, .docx, .xlsx, .doc, .jpeg" value="" id="attchmnet_key_id" class="attachments_cl"><label for="attchmnet_key_id">Choose File (PDF, JPG or PNG, DOCX, DOC, XLSX)</label></div></div>';
            jQuery('.attachments_lists').append(wrapper);
        });

        jQuery("#license_compact").change(function() {
        if(this.checked) {
            jQuery(this).val('Yes');      
        }else{
            jQuery(this).val('No');
        }
        });

        jQuery("#degree_currently_enrolled").change(function() {
        if(this.checked) {
            jQuery(this).val('Yes');      
        }else{
            jQuery(this).val('No');
        }

        });

        jQuery("input#work_history_currently_work_here").change(function() {
        if(this.checked) {
            jQuery(this).val('true');      
        }else{
            jQuery(this).val('false');
        }

        });

        jQuery('#check_no_middle_name').change(function(){
         if(this.checked) {
            jQuery(this).val('Yes');      
        }else{
            jQuery(this).val('No');
        }
        });
             jQuery("#opportunity_preferences_shift_days").click(function() {
    if(this.checked) {
        jQuery(this).val('Days');      
    }else{
        jQuery(this).val(' ');
    }
});   
 jQuery("#opportunity_preferences_shift_mids").click(function() {
    if(this.checked) {
        jQuery(this).val('Mids');      
    }else{
        jQuery(this).val(' ');
    }
});
     jQuery("#opportunity_preferences_shift_nights").click(function() {
    if(this.checked) {
        jQuery(this).val('Nights');      
    }else{
        jQuery(this).val(' ');
    }
});
/*********************************************Facility Name Dropdown***************************************************/
    jQuery(document).ready(function(){

        var dropMenu2 = jQuery('.workfaciltydropdown');
        var html = '';
        html +='<a class="dropdown-item" href="#" data-value-facility-name="366th Medical Group - Mountain Home Air Force Base" style="line-height: 1.2rem;">366th Medical Group - Mountain Home Air Force Base<br><small class="text-muted" style="opacity: .9">Mountain Home Afb, ID</small></a>';
        html +='<a class="dropdown-item" href="#" data-value-facility-name="60th Medical Group - Travis AFB (AKA David Grant USAF Medical Center)" style="line-height: 1.2rem;">60th Medical Group - Travis AFB (AKA David Grant USAF Medical Center)<br><small class="text-muted" style="opacity: .9">Travis Afb, CA</small></a>';
        html +='<a class="dropdown-item" href="#" data-value-facility-name="673d Medical Group - Joint Base Elmendorf-Richardson" style="line-height: 1.2rem;">673d Medical Group - Joint Base Elmendorf-Richardson<br><small class="text-muted" style="opacity: .9">Elmendorf Afb, AK</small></a>';
        html +='<a class="dropdown-item" href="#" data-value-facility-name="Barton Memorial Hospital (AKA Barton Health)" style="line-height: 1.2rem;">Barton Memorial Hospital (AKA Barton Health)<br><small class="text-muted" style="opacity: .9">South Lake Tahoe, CA</small></a>';
        html +='<a class="dropdown-item" href="#" data-value-facility-name="Bascom Palmer Eye Institute (FKA Anne Bates Leach Eye Hospital)" style="line-height: 1.2rem;">Bascom Palmer Eye Institute (FKA Anne Bates Leach Eye Hospital)<br><small class="text-muted" style="opacity: .9">Miami, FL</small></a>';
        html +='<a class="dropdown-item" href="#" data-value-facility-name="Bassett Army Community Hospital" style="line-height: 1.2rem;">Bassett Army Community Hospital<br><small class="text-muted" style="opacity: .9">Fort Wainwright, AK</small></a>';
        html +='<a class="dropdown-item" href="#" data-value-facility-name="Zale Lipshy Pavilion - William P Clements Jr University Hospital (AKA Zale Lipshy University Hospital)" style="line-height: 1.2rem;">Zale Lipshy Pavilion - William P Clements Jr University Hospital (AKA Zale Lipshy University Hospital)<br> <small class="text-muted" style="opacity: .9">Dallas, TX </small></a>';

        var alldatadrop2 = jQuery(dropMenu2).html(html);
        var name_type = jQuery('.workfaciltydropdown a.dropdown-item').text();

        jQuery('.workfaciltydropdown a.dropdown-item').click(function(e){
            e.preventDefault();
            var addval = jQuery(this).attr('data-value-facility-name');
           jQuery(this).addClass('click-value').siblings().removeClass('click-value');
           jQuery('#work_history_facility_name').val(addval);
          
            setTimeout(function() {
                jQuery('.workfaciltydropdown').hide();
                
            }, 100);
           

        });
        jQuery("#work_history_facility_name").keyup(function(e) {
            e.preventDefault();
            jQuery(alldatadrop2);
            var val = jQuery(this).val();

            filter(val.toLowerCase().toString());
        });

        jQuery("#work_history_facility_name").on("paste", function() {
            jQuery(alldatadrop2);  
            var element = this;
            setTimeout(function() {
                var text = jQuery(element).val().toLowerCase().toString();
                filter(text);
            }, 100);
        });

        function filter(x) {
            var isMatch = false;
            jQuery(dropMenu2).each(function(i) {
            var content = jQuery(this).html();

            if (content.toLowerCase().toString().indexOf(x) == 0) {
                jQuery(this).hide();
            } else {
                jQuery(this).show();
                isMatch = true;
            }
            });

            var ccs = jQuery(dropMenu2).filter(function() {
            return jQuery(this).css('display') !== 'none';
            }).length;


            console.log(isMatch);
            //jQuery(".cc").toggle(isMatch);
        }

        var ccs = jQuery(dropMenu2).filter(function() {
        return jQuery(this).css('display') !== 'none';
        }).length;

    });
/*************************************Medical image uploder************************************************/
 jQuery('input#medicalcustomFile:file').change(function(){
        if (jQuery(this).val()) {
           jQuery('.file_next').attr('disabled',false);
        }else{
            jQuery('.file_next').attr('disabled',true); 
        } 
         readIMG(this);
    });
function readIMG(input) {
    html = '';
        var files = input.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;

          // jQuery("<span class=\"pip\">" +
          //   "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
          //   "<br/><span class=\"remove\">Remove image</span>" +
          //   "</span>").insertAfter(".medical_attachment");

            var fsize = Math.round(f.size / 1024)+'KB';
        html = '<div class="attachment-card card mb-2 p-2 d-flex justify-content-between"><div class="d-flex justify-content-between"><div class="image-preview flex-grow-0"><img width="80" id="perview_img" src="'+e.target.result+'"></div><div class="attachment-details flex-grow-1 d-flex flex-column ms-2"><div class="name">'+f.name+'</div><div class="metadata"><small>'+f.type+'•'+fsize+'•<a href="#" class="remove" data-click="remove_attachment">remove</a></small></div></div></div>';

        jQuery(html).insertAfter(".medical_attachment");

          jQuery(".remove").click(function(e){
            e.preventDefault();
            jQuery(this).parent(".attachment-card").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        console.log(f);
        fileReader.readAsDataURL(f);
      }
      console.log(files);

    }

    jQuery('.file_next').click(function(){
        jQuery('#add_item_form').show();
        jQuery('.next_page_show').show();
        jQuery('.first_page_show').hide();
        jQuery('.Meicalupload').hide();
    });

jQuery('.add-item-submit-button').click(function(e){
    e.preventDefault(); 

    var category = jQuery('#add_item_form_medical_history_category_id').find('option:selected').text();
    var choice = jQuery('#add_item_form_medical_history_choice_id').find('option:selected').text();

    var html = '';

    html = '<div class="selected-item-card card mb-3 p-2"><h5 class="card-title font-heavyweight h6 mb-0">'+category+'</h5><p class="card-text text-muted mt-0"><small>'+choice+' • <a href="#" class="remove" data-click="remove_item">remove</a></small></p></div>';

    jQuery('.medical_category_and_choice').append(html); 

//hide prev divs

    jQuery('.last_page_show').show();
    jQuery('.review').show();
    jQuery('#add_item_form').hide();
    jQuery('.next_page_show').hide();
    jQuery('.first_page_show').hide();
    jQuery('.Meicalupload').hide();
    
});

// jQuery(".remove").click(function(){
// jQuery(this).parent(".selected-item-card").off();
// });


</script>

<script>
              
jQuery(document).on('change', 'select#add_item_form_medical_history_category_id', function () {
            var value = $(this).val();
             //var value2 = $(this).attr('id');
            // call ajax
            jQuery("#add_item_form_medical_history_choice_id").empty();
            var ajaxUrl = "<?php echo get_site_url();?>/wp-admin/admin-ajax.php";
            jQuery.ajax({
              url: ajaxUrl,
              type: 'POST',
              data: 'action=categoryFilter&main_catid='+value,

              success: function(results) {
                //console.log(results);
                jQuery("#add_item_form_medical_history_choice_id").append(results);
              }
            });

            var childvalue = $('#add_item_form_medical_history_choice_id').attr('id');

            if (value) {
            jQuery('.add-item-submit-button').attr('disabled',false);
            }else if(childvalue){
                jQuery('.add-item-submit-button').attr('disabled',false);
            }else{
                 jQuery('.add-item-submit-button').attr('disabled',true);
            }
            jQuery('#parentcat_id').val(value);

        });

jQuery(document).on('change', 'select#add_item_form_medical_history_choice_id', function () {
var value2 = jQuery(this).val();
jQuery('#childcat_id').val(value2);

});





        jQuery('#advance_to_upload').click(function(e){
            e.preventDefault();
            jQuery('.review').hide();
            jQuery('.Meicalupload').show();
            jQuery('.first_page_show').show();
            jQuery('.last_page_show').hide();
            jQuery('#add_item_form').hide();
            jQuery('.next_page_show').hide();
            jQuery('.file_next').text('Add Attachments');
            jQuery('.file_next').addClass('add-attachments').removeClass('file_next');
        });

        jQuery('.add-attachments').click(function(e){
            e.preventDefault();
            jQuery('.review').show();
            jQuery('.Meicalupload').hide();
            jQuery('.first_page_show').hide();
            jQuery('.last_page_show').show();
            jQuery('#add_item_form').hide();
            jQuery('.next_page_show').hide();
        });
        jQuery('#add_another_items').click(function(e) {
             e.preventDefault();
            jQuery('.review').hide();
            jQuery('.Meicalupload').hide();
            jQuery('.first_page_show').hide();
            jQuery('.last_page_show').hide();
            jQuery('#add_item_form').show();
            jQuery('.next_page_show').show();
            jQuery('.add-item-submit-button').addClass('add-another-items').removeClass('add-item-submit-button');
        });
          jQuery('.add-another-items').click(function(e) {
             e.preventDefault();
            jQuery('.review').show();
            jQuery('.Meicalupload').hide();
            jQuery('.first_page_show').hide();
            jQuery('.last_page_show').show();
            jQuery('#add_item_form').hide();
            jQuery('.next_page_show').hide();
            
        });

</script>
<script type="text/javascript">

    $(document).ready(function() {
        
    $('.js-example-basic-single').select2();
    jQuery('.select2-selection__arrow').html('<i class="fa fa-angle-down"></i>');
});
// jQuery('b[role="presentation"]').hide();

    //   var dropMenu2 = jQuery('.workfaciltydropdown');
    //     var html = '';
    //     html +='<a class="dropdown-item" href="#" data-value-facility-name="366th Medical Group - Mountain Home Air Force Base" style="line-height: 1.2rem;">366th Medical Group - Mountain Home Air Force Base<br><small class="text-muted" style="opacity: .9">Mountain Home Afb, ID</small></a>';
    //     html +='<a class="dropdown-item" href="#" data-value-facility-name="60th Medical Group - Travis AFB (AKA David Grant USAF Medical Center)" style="line-height: 1.2rem;">60th Medical Group - Travis AFB (AKA David Grant USAF Medical Center)<br><small class="text-muted" style="opacity: .9">Travis Afb, CA</small></a>';
    //     html +='<a class="dropdown-item" href="#" data-value-facility-name="673d Medical Group - Joint Base Elmendorf-Richardson" style="line-height: 1.2rem;">673d Medical Group - Joint Base Elmendorf-Richardson<br><small class="text-muted" style="opacity: .9">Elmendorf Afb, AK</small></a>';
    //     html +='<a class="dropdown-item" href="#" data-value-facility-name="Barton Memorial Hospital (AKA Barton Health)" style="line-height: 1.2rem;">Barton Memorial Hospital (AKA Barton Health)<br><small class="text-muted" style="opacity: .9">South Lake Tahoe, CA</small></a>';
    //     html +='<a class="dropdown-item" href="#" data-value-facility-name="Bascom Palmer Eye Institute (FKA Anne Bates Leach Eye Hospital)" style="line-height: 1.2rem;">Bascom Palmer Eye Institute (FKA Anne Bates Leach Eye Hospital)<br><small class="text-muted" style="opacity: .9">Miami, FL</small></a>';
    //     html +='<a class="dropdown-item" href="#" data-value-facility-name="Bassett Army Community Hospital" style="line-height: 1.2rem;">Bassett Army Community Hospital<br><small class="text-muted" style="opacity: .9">Fort Wainwright, AK</small></a>';
    //     html +='<a class="dropdown-item" href="#" data-value-facility-name="Zale Lipshy Pavilion - William P Clements Jr University Hospital (AKA Zale Lipshy University Hospital)" style="line-height: 1.2rem;">Zale Lipshy Pavilion - William P Clements Jr University Hospital (AKA Zale Lipshy University Hospital)<br> <small class="text-muted" style="opacity: .9">Dallas, TX </small></a>';

    //     var alldatadrop2 = jQuery(dropMenu2).html(html);
    //     var name_type = jQuery('.workfaciltydropdown a.dropdown-item').text();

    //     jQuery('.workfaciltydropdown a.dropdown-item').click(function(e){
    //         e.preventDefault();
    //         var addval = jQuery(this).attr('data-value-facility-name');
    //        jQuery(this).addClass('click-value').siblings().removeClass('click-value');
    //        jQuery('#work_history_facility_name').val(addval);
    //       jQuery('#work_history_facility_id').val(addval);
    //         setTimeout(function() {
    //             jQuery('.workfaciltydropdown').hide();
                
    //         }, 100);
           

    //     });
    //     jQuery("#work_history_facility_name").keyup(function(e) {
    //         e.preventDefault();
    //         jQuery(alldatadrop2);
    //         var val = jQuery(this).val();

    //         filters(val.toString().toLowerCase());
    //     });

    //     jQuery("#work_history_facility_name").on("paste", function() {
    //         jQuery(alldatadrop2);  
    //         var element = this;
    //         setTimeout(function() {
    //             var text = jQuery(element).val().toString().toLowerCase();
    //             filters(text);
    //         }, 100);
    //     });

    //     function filters(x) {
    //         var isMatch = false;
    //         jQuery(dropMenu2).each(function(i) {
    //         var content = jQuery(this).html();

    //         if (content.toString().toLowerCase().indexOf(x) == 0) {
    //             jQuery(this).hide();
    //         } else {
    //             isMatch = true;
    //             jQuery(this).show();

    //         }
    //         });

    //         var ccs = jQuery(dropMenu2).filter(function() {
    //         return jQuery(this).css('display') !== 'none';
    //         }).length;


    //         // jQuery(".no-results").toggle(!isMatch);
    //         // jQuery(".cc").toggle(isMatch);
    //     }

    //     var ccs = jQuery(dropMenu2).filter(function() {
    //     return jQuery(this).css('display') !== 'none';
    //     }).length;

/*********************************staffing input field**********************************/
  $('.agencystaffinginput').hide();
  $('input[name="work_employer_type"]').on( "change", function() {

         var test = $(this).val();
         if(test == 'Agency'){
            $('.agencystaffinginput').show();
         }else if(test == 'Facility'){
            $('.agencystaffinginput').hide();
         }else if(test == 'Anesthesia Group'){
            $('.agencystaffinginput').hide();
         }
          

    } );
</script>
<script>
    
    jQuery('.gapwork_name').on('change',function(){
       var valueofgap = jQuery(this).find('option:selected').text();
       jQuery('#work_gap_name').val(valueofgap);
    });
jQuery(document).ready(function(){
            jQuery('.anywhere input').click(function(e){
        if(this.checked) {
            jQuery('.location-actions').hide(); 
            jQuery('.anywhere-in-state select,.within-x-miles .field-wrapper input,.within-x-miles .field-wrapper select').attr('disabled',true) ;   
        }else{
            jQuery('.location-actions').show(); 
            jQuery('.anywhere-in-state select,.within-x-miles .field-wrapper input,.within-x-miles .field-wrapper select').attr('disabled',false) ; 
        }

        });
        jQuery('.anywhere-in-state input').click(function(){
        if(this.checked){
            jQuery('.within-x-miles .field-wrapper input,.within-x-miles .field-wrapper select').attr('disabled',true) ;
            jQuery('.anywhere-in-state select').attr('disabled',false) ;
        }else{
            jQuery('.within-x-miles .field-wrapper input,.within-x-miles .field-wrapper select').attr('disabled',false) ;
        }

        }) ;
        if(jQuery('.within-x-miles input').is(':checked')){
        jQuery('.anywhere-in-state select').attr('disabled',true); 
        }else{
        jQuery('.anywhere-in-state select').attr('disabled',false); 
        }

        jQuery('.within-x-miles input').click(function(){
        if(this.checked){
            jQuery('.anywhere-in-state select').attr('disabled',true) ; 
        }else{
            jQuery('.anywhere-in-state select').attr('disabled',false) ; 
        }

        }) ;
        jQuery('.anywhere-in-state input,.within-x-miles input').click(function(){
            if(this.checked) {
                jQuery('.location-actions').show();
                    
        }
        });
    
        $('#add-op-location-link').click(function(e,ids) {
            e.preventDefault();
            var html = '';
          var contentLength = $('#location_rows > div').length;
          var indexof = (contentLength+1);
          jQuery('#locCount').val(indexof);
          html += '<div class="opportunity-preference-location-fields-row-'+indexof+'">';
            html += '<div class="col-12">';
            html += '<div class="toolbar">';
            html += '<span class="d-none d-sm-inline mr-auto">';
            html += 'Specify the details of your desired location';
            html += '</span>';
            html += '<span class="d-md-none mr-auto">';
            html += 'Location Details';
            html += '</span>';
            html += '<a href="#remove" class="d-block remove-op-location-link-'+indexof+' healthshield-red-text text-end text-red removeelm'+indexof+'" >';
            html += '<i class="fad fa-minus-circle fa-fw"></i>';
            html += 'Remove';
            html += '</a>';
            html += '</div>';
            html += '</div>';
                html += '<div class="col-12">';
                html += '<section class="within-x-miles">';
                html += '<div class="row">';
                html += '<div class="col-12">';
                html += '<div class="form-group">';
                html += '<div class="custom-control custom-radio">';
                html += '<input checked="" class="toggle-location custom-control-input" data-type="radius" id="opportunity_preferences_locations_0_type_Radius" name="opportunity_preferences_locations_type_'+indexof+'" type="radio" value="SC" >';
                html += '<label class="custom-control-label" for="opportunity_preferences_locations_0_type_Radius" id="opportunity_preferences_locations_0_type_Radius_label">';
                html += 'Specific City';
                html += '</label>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '<div class="field-wrapper">';
                html += '<div class="row">';
                html += '<div class="col-12 col-md-6 col-lg-4">';
                html += '<div class="form-group">';
                html += '<label class="destination-field-label" for="opportunity_preferences_locations_0_destination">City</label>';
                html += '<input class="destination-field " id="opportunity_preferences_locations_0_destination" name="SC_destination_'+indexof+'" placeholder="Richmond" type="text" value="">';
                html += '</div>';
                html += '</div>';
                html += '<div class="col-12 col-md-6 col-lg-4">';
                html += '<div class="form-group">';
                html += '<label class="radius-state-field-label" for="opportunity_preferences_locations_0_province_id">State</label>';
                html += '<div class="select-wrapper flex-grow-1 ">';
                html += '<select class="browser-default radius-state-field select-css" id="opportunity_preferences_locations_0_province_id" name="SC_province_id_'+indexof+'" >';
                html += '<option value=""></option>';
                html += ' <option  value="Alabama">Alabama</option>';
                html += ' <option  value="Alaska">Alaska</option>';
                html += ' <option  value="Arizona">Arizona</option>';
                html += ' <option  value="American Samoa">American Samoa</option>';
                html += ' <option  value="Arkansas">Arkansas</option>';
                html += ' <option  value="California">California</option>';
                html += ' <option  value="Colorado">Colorado</option>';
                html += ' <option  value="Connecticut">Connecticut</option>';
                html += ' <option  value="Delaware">Delaware</option>';
                html += ' <option  value="District Of Columbia">District Of Columbia</option>';
                html += ' <option  value="Florida">Florida</option>';
                html += ' <option  value="Georgia">Georgia</option>';
                html += ' <option  value="Guam">Guam</option>';
                html += ' <option  value="Hawaii">Hawaii</option>';
                html += ' <option  value="Idaho">Idaho</option>';
                html += ' <option  value="Illinois">Illinois</option>';
                html += ' <option  value="Indiana">Indiana</option>';
                html += ' <option  value="Iowa">Iowa</option>';
                html += ' <option  value="Kansas">Kansas</option>';
                html += ' <option  value="Kentucky">Kentucky</option>';
                html += ' <option  value="Louisiana">Louisiana</option>';
                html += ' <option  value="Maine">Maine</option>';
                html += ' <option  value="Maryland">Maryland</option>';
                html += ' <option  value="Massachusetts">Massachusetts</option>';
                html += ' <option  value="Michigan">Michigan</option>';
                html += ' <option  value="Minnesota">Minnesota</option>';
                html += ' <option  value="Mississippi">Mississippi</option>';
                html += ' <option  value="Missouri">Missouri</option>';
                html += ' <option  value="Montana">Montana</option>';
                html += ' <option  value="Nebraska">Nebraska</option>';
                html += ' <option  value="Nevada">Nevada</option>';
                html += ' <option  value="New Hampshire">New Hampshire</option>';
                html += ' <option  value="New Jersey">New Jersey</option>';
                html += ' <option  value="New Mexico">New Mexico</option>';
                html += ' <option  value="New York">New York</option>';
                html += ' <option  value="North Carolina">North Carolina</option>';
                html += ' <option  value="North Dakota">North Dakota</option>';
                html += ' <option  value="Northern Mariana Islands">Northern Mariana Islands</option>';
                html += ' <option  value="Ohio">Ohio</option>';
                html += ' <option  value="Oklahoma">Oklahoma</option>';
                html += ' <option  value="Oregon">Oregon</option>';
                html += ' <option  value="Pennsylvania">Pennsylvania</option>';
                html += ' <option  value="Puerto Rico">Puerto Rico</option>';
                html += ' <option  value="Rhode Island">Rhode Island</option>';
                html += ' <option  value="South Carolina">South Carolina</option>';
                html += ' <option  value="South Dakota">South Dakota</option>';
                html += ' <option  value="Tennessee">Tennessee</option>';
                html += ' <option  value="Texas">Texas</option>';
                html += ' <option  value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>';
                html += ' <option  value="Utah">Utah</option>';
                html += ' <option  value="Vermont">Vermont</option>';
                html += ' <option  value="Virgin Islands">Virgin Islands</option>';
                html += ' <option  value="Virginia">Virginia</option>';
                html += ' <option  value="Washington">Washington</option>';
                html += ' <option  value="West Virginia">West Virginia</option>';
                html += ' <option  value="Wisconsin">Wisconsin</option>';
                html += ' <option  value="Wyoming">Wyoming</option>';     
                html += '</select>';

                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '<div class="col-12 col-lg-4">';
                html += '<div class="form-group">';
                html += '<label class="radius-field-label" for="opportunity_preferences_locations_0_radius">Max Distance</label>';
                html += '<div class="select-wrapper flex-grow-1 ">';
                html += '<select class=" radius-field" id="opportunity_preferences_locations_0_radius" name="SC_radius_'+indexof+'" >';
                  html += '<option value="10">10</option>';
                  html += '<option value="25">25</option>';
                  html += '<option value="50">50</option>';
                  html += '<option value="100">100</option>';
                html += '</select>';                                              
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                
                html += '</section>';
                html += '<section class="anywhere-in-state">';
                html += '<div class="row">';
                html += '<div class="col-12">';
                html += '<div class="form-group">';
                html += '<div class="custom-control custom-radio">';
                html += '<input class="toggle-location custom-control-input" data-type="province" id="opportunity_preferences_locations_0_type_Province" name="opportunity_preferences_locations_type_'+indexof+'" type="radio" value="AS">';
                html += '<label class="custom-control-label" for="opportunity_preferences_locations_0_type_Province" id="opportunity_preferences_locations_0_type_Province_label">';
                html += 'Anywhere in State';
                html += '</label>';
                html += ' </div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '<div class="field-wrapper">';
                html += '<div class="row">';
                html += '<div class="col s12">';
                html += '<div class="form-group">';
                html += '<label class="state-field-label d-none" for="opportunity_preferences_locations_0_province_id_as">State</label>';
                html += '<div class="select-wrapper flex-grow-1 ">';
                html += '<select class="browser-default  select-css state-field" id="opportunity_preferences_locations_0_province_id_as" name="AS_province_id_'+indexof+'">';
                html += '<option value=""></option>';
                html += ' <option  value="Alabama">Alabama</option>';
                html += ' <option  value="Alaska">Alaska</option>';
                html += ' <option  value="Arizona">Arizona</option>';
                html += ' <option  value="American Samoa">American Samoa</option>';
                html += ' <option  value="Arkansas">Arkansas</option>';
                html += ' <option  value="California">California</option>';
                html += ' <option  value="Colorado">Colorado</option>';
                html += ' <option  value="Connecticut">Connecticut</option>';
                html += ' <option  value="Delaware">Delaware</option>';
                html += ' <option  value="District Of Columbia">District Of Columbia</option>';
                html += ' <option  value="Florida">Florida</option>';
                html += ' <option  value="Georgia">Georgia</option>';
                html += ' <option  value="Guam">Guam</option>';
                html += ' <option  value="Hawaii">Hawaii</option>';
                html += ' <option  value="Idaho">Idaho</option>';
                html += ' <option  value="Illinois">Illinois</option>';
                html += ' <option  value="Indiana">Indiana</option>';
                html += ' <option  value="Iowa">Iowa</option>';
                html += ' <option  value="Kansas">Kansas</option>';
                html += ' <option  value="Kentucky">Kentucky</option>';
                html += ' <option  value="Louisiana">Louisiana</option>';
                html += ' <option  value="Maine">Maine</option>';
                html += ' <option  value="Maryland">Maryland</option>';
                html += ' <option  value="Massachusetts">Massachusetts</option>';
                html += ' <option  value="Michigan">Michigan</option>';
                html += ' <option  value="Minnesota">Minnesota</option>';
                html += ' <option  value="Mississippi">Mississippi</option>';
                html += ' <option  value="Missouri">Missouri</option>';
                html += ' <option  value="Montana">Montana</option>';
                html += ' <option  value="Nebraska">Nebraska</option>';
                html += ' <option  value="Nevada">Nevada</option>';
                html += ' <option  value="New Hampshire">New Hampshire</option>';
                html += ' <option  value="New Jersey">New Jersey</option>';
                html += ' <option  value="New Mexico">New Mexico</option>';
                html += ' <option  value="New York">New York</option>';
                html += ' <option  value="North Carolina">North Carolina</option>';
                html += ' <option  value="North Dakota">North Dakota</option>';
                html += ' <option  value="Northern Mariana Islands">Northern Mariana Islands</option>';
                html += ' <option  value="Ohio">Ohio</option>';
                html += ' <option  value="Oklahoma">Oklahoma</option>';
                html += ' <option  value="Oregon">Oregon</option>';
                html += ' <option  value="Pennsylvania">Pennsylvania</option>';
                html += ' <option  value="Puerto Rico">Puerto Rico</option>';
                html += ' <option  value="Rhode Island">Rhode Island</option>';
                html += ' <option  value="South Carolina">South Carolina</option>';
                html += ' <option  value="South Dakota">South Dakota</option>';
                html += ' <option  value="Tennessee">Tennessee</option>';
                html += ' <option  value="Texas">Texas</option>';
                html += ' <option  value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>';
                html += ' <option  value="Utah">Utah</option>';
                html += ' <option  value="Vermont">Vermont</option>';
                html += ' <option  value="Virgin Islands">Virgin Islands</option>';
                html += ' <option  value="Virginia">Virginia</option>';
                html += ' <option  value="Washington">Washington</option>';
                html += ' <option  value="West Virginia">West Virginia</option>';
                html += ' <option  value="Wisconsin">Wisconsin</option>';
                html += ' <option  value="Wyoming">Wyoming</option>';   
                  
                html += '</select>';

                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</section>';
                html += '</div>';
                html += '</div>';
          html += '</div>'; 
          
          $('#location_rows').append(html);
            jQuery('.opportunity-preference-location-fields-row-'+indexof).delegate('.removeelm'+indexof ,"click",function(){
                jQuery(this).parents('.opportunity-preference-location-fields-row-'+indexof).remove();
            });
    });
});


</script>

<script>

    jQuery('#profile_share_delivery_method_link').change(function(){
        if(this.checked){
            jQuery('.d-block.msg_personal').removeClass('d-block').addClass('d-none');
            jQuery('.d-block.email_input').removeClass('d-block').addClass('d-none');
            jQuery('.send_profile').html('<i class="fad fa-link"></i> Create Link');
            jQuery('#profile_share_email').removeAttr('required');
            
        }else{
            jQuery('.d-none.msg_personal').removeClass('d-none').addClass('d-block');
            jQuery('.d-none.email_input').removeClass('d-none').addClass('d-block');
            jQuery('.send_profile').html('<i class="fad fa-paper-plane"></i> Send profile Now');
            jQuery('#profile_share_email').attr('required','required');

        }
    });
  jQuery('#profile_share_delivery_method_email').click(function(){
        if(this.checked){
            jQuery('.d-none.msg_personal').removeClass('d-none').addClass('d-block');
            jQuery('.d-none.email_input').removeClass('d-none').addClass('d-block');
            jQuery('.send_profile').html('<i class="fad fa-paper-plane"></i> Send profile Now');
            jQuery('#profile_share_email').attr('required','required');
        }
    });

/***Enter Number Only****/
jQuery('input[type="number"],input[type="tel"],#profile_zip_code_id,#work_zip_code').keypress(function(e) {
    if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
    });
//     .on("cut copy paste",function(e){
//     e.preventDefault();
//   })


    function copyToClipboard(text) {
    var sampleTextarea = document.createElement("textarea");
    document.body.appendChild(sampleTextarea);
    sampleTextarea.value = text; //save main text in it
    sampleTextarea.select(); //select textarea contenrs
    document.execCommand("copy");
    document.body.removeChild(sampleTextarea);
}

jQuery('.clipboard-link').click(function(e){
    e.preventDefault();
    var copyText = jQuery(this).attr('data-clipboard-target');
    return copyToClipboard(copyText);
});

$("select.graduation_year,select.graduation_month").change(function(e){
     e.preventDefault();
   var startdate = $('.started_year').val();
   var enddate = $('.graduation_year').val();

    if(enddate){
        if(enddate < startdate  ){
        alert('End date should be greater than of Start date');
        //location.reload();
        }else{

        }
        var currentYear = (new Date).getFullYear();
        console.log(currentYear);
        if(jQuery('#degree_currently_enrolled').is(':checked')){
            if( enddate < currentYear){
                alert('You have selcted currently enrolled and select past year in end date');
                //location.reload();
            }
        }
   }
});
jQuery('#degree_currently_enrolled').change(function(e){
     var currentYear = (new Date).getFullYear();
     var enddate = $('.graduation_year').val();
var startdate = $('.started_year').val();
    if(this.checked){
            if(enddate){
                if( enddate < currentYear){
                    alert('You have selcted currently enrolled and select past year in end date');
                    //location.reload();
                }
            }

    }else{

    }
});
jQuery('#work_history_currently_work_here').change(function(e){
    var currentYear = (new Date).getFullYear();
    var enddate = $('#work_history_ended_on_year').val();
    var startdate = $('#work_history_started_on_year').val();
    if(this.checked){
        if(startdate == ''){

            jQuery(this).prop('checked',false);
        }else{
            if(enddate){
                if( enddate < currentYear){
                    alert('You have selcted currently enrolled and select past year in end date');
                    location.reload();
                }
            }
       }
    }else{

    }
});

$('select#work_history_started_on_month,select#work_history_started_on_year,select#work_history_ended_on_month,select#work_history_ended_on_year').change(function(e){
         e.preventDefault();
   var startdate = $('#work_history_started_on_year').val();
   var enddate = $('#work_history_ended_on_year').val();
   if(startdate == ''){
    var enddate = $('#work_history_ended_on_year').val('');
    var enddate = $('#work_history_ended_on_month').val('');
   
    }else{
        if(enddate){
            if(enddate < startdate  ){
            alert('End date should be greater than of Start date');
            location.reload();
            }else{

            }
            var currentYear = (new Date).getFullYear();
            console.log(currentYear);
            if(jQuery('#work_history_currently_work_here').is(':checked')){
                if( enddate < currentYear){
                    alert('You have selcted currently enrolled and select past year in end date');
                    location.reload();
                }
            }
       }

   }
});
jQuery('#workhistorysubmit').on('submit',function(){
    var startdate = $('#work_history_started_on_year').val();
    var enddatey = $('#work_history_ended_on_year').val();
    var enddatem = $('#work_history_ended_on_month').val();
     if(enddatey =='' && enddatem =='' && startdate){
         alert('Please select end date else Select I am currently work here');
                    location.reload();
       }
})

</script>

<script>

 $( "#profile_ssn_id").keyup(function() {
  var val = this.value.replace(/\D/g, '');
        val = val.replace(/^(\d{3})/, '$1-');
        val = val.replace(/-(\d{2})/, '-$1-');
        val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
        this.value = val;
  });

    jQuery(document).on('click', '.preview_share', function () {
        var values = $(this).attr('data-post-id');
        var ajaxUrl = "<?php echo get_site_url();?>/wp-admin/admin-ajax.php";
        jQuery.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: 'action=emailCountViews&postId='+values,

        success: function(results) {
            console.log(results);
            }
        });

    });


</script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery(".dropdownalldata input[type='text']").attr('required',false);
        jQuery("#dropId").on('change',function(){
        var thisId = jQuery(this).children(":selected").attr("id");
        jQuery('.d-block').removeClass('d-block').addClass('d-none');
        jQuery(".d-none input[type='text']").attr('required',false);
        jQuery("div#"+thisId+".d-none").removeClass('d-none').addClass('d-block');
        jQuery("div#"+thisId+".d-block input[type='text']").attr('required',true);

        });
 
        // Attachments function 
        jQuery("#hepatitis_add_attachment").click(function(e) {
            e.preventDefault();
            var wrapper = '<div class="card form-group mt-3 mb-3"><div class="custom_file"><input type="file" name="hep_file[]" value=""  accept=".jpg, .png, .pdf, .docx, .xlsx, .doc, .jpeg" id="attchmnet_key_id" class="attachments_cl" ><label for="attchmnet_key_id">Choose File (PDF, JPG or PNG, DOCX, DOC, XLSX)</label></div></div>';
            jQuery('.hepatitis_attachments_lists').append(wrapper);
        });
        jQuery("#flu_add_attachment").click(function(e) {
            e.preventDefault();
            var wrapper = '<div class="card form-group mt-3 mb-3"><div class="custom_file"><input type="file" name="flu_file[]" accept=".jpg, .png, .pdf, .docx, .xlsx, .doc,.jpeg" value="" id="attchmnet_key_id" class="attachments_cl" ><label for="attchmnet_key_id">Choose File (PDF, JPG or PNG, DOCX, DOC, XLSX)</label></div></div>';
            jQuery('.flu_attachments_lists').append(wrapper);
        });
        jQuery("#varicella_add_attachment").click(function(e) {
            e.preventDefault();
            var wrapper = '<div class="card form-group mt-3 mb-3"><div class="custom_file"><input type="file" name="varicella_file[]" accept=".jpg, .png, .pdf, .docx, .xlsx, .doc, .jpeg" value="" id="attchmnet_key_id" class="attachments_cl" ><label for="attchmnet_key_id">Choose File (PDF, JPG or PNG, DOCX, DOC, XLSX)</label></div></div>';
            jQuery('.varicella_attachments_lists').append(wrapper);
        });
        jQuery("#covid_add_attachment").click(function(e) {
            e.preventDefault();
            var wrapper = '<div class="card form-group mt-3 mb-3"><div class="custom_file"><input type="file" name="covid_file[]" accept=".jpg, .png, .pdf, .docx, .xlsx, .doc, .jpeg" value="" id="attchmnet_key_id" class="attachments_cl" ><label for="attchmnet_key_id">Choose File (PDF, JPG or PNG, DOCX, DOC, XLSX)</label></div></div>';
            jQuery('.covid_attachments_lists').append(wrapper);
        });
        jQuery("#tb_add_attachment").click(function(e) {
            e.preventDefault();
            var wrapper = '<div class="card form-group mt-3 mb-3"><div class="custom_file"><input type="file" name="tb_file[]" accept=".jpg, .png, .pdf, .docx, .xlsx, .doc, .jpeg" value="" id="attchmnet_key_id" class="attachments_cl" ><label for="attchmnet_key_id">Choose File (PDF, JPG or PNG, DOCX, DOC, XLSX)</label></div></div>';
            jQuery('.tb_attachments_lists').append(wrapper);
        });
        jQuery("#tdap_add_attachment").click(function(e) {
            e.preventDefault();
            var wrapper = '<div class="card form-group mt-3 mb-3"><div class="custom_file"><input type="file" name="tdap_file[]" accept=".jpg, .png, .pdf, .docx, .xlsx, .doc, .jpeg" value="" id="attchmnet_key_id" class="attachments_cl" ><label for="attchmnet_key_id">Choose File (PDF, JPG or PNG, DOCX, DOC, XLSX)</label></div></div>';
            jQuery('.tdap_attachments_lists').append(wrapper);
        });
        jQuery("#mmr_add_attachment").click(function(e) {
            e.preventDefault();
            var wrapper = '<div class="card form-group mt-3 mb-3"><div class="custom_file"><input type="file" name="mmr_file[]" accept=".jpg, .png, .pdf, .docx, .xlsx, .doc, .jpeg" value="" id="attchmnet_key_id" class="attachments_cl" ><label for="attchmnet_key_id">Choose File (PDF, JPG or PNG, DOCX, DOC, XLSX)</label></div></div>';
            jQuery('.mmr_attachments_lists').append(wrapper);
        });
        jQuery("#irh_add_attachment").click(function(e) {
            e.preventDefault();
            var wrapper = '<div class="card form-group mt-3 mb-3"><div class="custom_file"><input type="file" name="irh_file[]" accept=".jpg, .png, .pdf, .docx, .xlsx, .doc, .jpeg" value="" id="attchmnet_key_id" class="attachments_cl" ><label for="attchmnet_key_id">Choose File (PDF, JPG or PNG, DOCX, DOC, XLSX)</label></div></div>';
            jQuery('.irh_attachments_lists').append(wrapper);
        });
        jQuery("#other_add_attachment").click(function(e) {
          e.preventDefault();
          var contentLength2 = jQuery('.other_attachments_lists >div').length;
          var indexof2 = (contentLength2+1);
          jQuery('#otherinput_id').val(indexof2);
            
            var wrapper = '<div class="allattachmentsOther"><div class="form-group"><label for="documents_name_id">Other Documents Name</label><input type="text" id="documents_name_id" name="documents_name_id_'+indexof2+'" class="documentsname" value="" ></div><div class="card form-group mt-3 mb-3"><div class="custom_file"><input type="file" name="other_file[]" accept=".jpg, .png, .pdf, .docx, .xlsx, .doc, .jpeg" value="" id="attchmnet_key_id" class="attachments_cl" ><label for="attchmnet_key_id">Choose File (PDF, JPG or PNG, DOCX, DOC, XLSX)</label></div></div></div>';
            jQuery('.other_attachments_lists').append(wrapper);
        });

    }); 
</script>
<script type="text/javascript">
// $( init );

// function init() {
//   $( ".profile-section-types" ).sortable({
//       connectWith: ".profile-section-types",
//       stack: '.profile-section-types dragndropsec'
//     }).disableSelection();
// }

jQuery(document).ready(function(){

    jQuery('.js-example-basic-multiple').select2();
    
    jQuery('#periheralID').hide();
    jQuery('.administrationpe').change(function(){
       if(this.checked){
           jQuery('#periheralID').show();
       }else{
        jQuery('#periheralID').hide();
        jQuery('.js-example-basic-multiple').val(null).trigger('change'); 
       }
    });

    jQuery('.ad').on('click', function(){
        var checkVal = jQuery(this).val();
        if(checkVal == 'Administration - Peripheral')
        {
             if(jQuery(this).is(':checked'))
             {  
                jQuery('#periheralID').show();
             }
             else
             {
                jQuery('#periheralID').hide();
                jQuery('.js-example-basic-multiple').val(null).trigger('change'); 
             }
        }
    });

    // /*****************Reorder****************/

       
    // var divList = jQuery(".user_profile_all_deatils_info ul.education_display_lists .education_list");
    // divList.sort(function(a, b){ return jQuery(a).attr("id")-jQuery(b).attr("id")});
    // jQuery(".user_profile_all_deatils_info ul.education_display_lists ").html(divList);

});
jQuery("#facilityemergency").change(function() {
        if(this.checked) {
            jQuery(this).val('1');      
        }else{
            jQuery(this).val('0');
        }
});

jQuery(document).ready(function(){
    jQuery('.licenses_list,.certificate_list,.expiredateDiv').hover(function() {
        var id = jQuery(this).find('a[data-bs-toggle="collapse"]').data('bs-target');
            
        jQuery(id).stop(true, true).delay(200).slideToggle(500);
    },
    function() {
        var id = jQuery(this).find('a[data-bs-toggle="collapse"]').data('bs-target');
        jQuery(id).stop(true, true).delay(200).slideUp(800);
    });

});
</script>
<!-- Add more address and facility in work history -->
<script>
jQuery(document).ready(function(){
    jQuery('#add_facaddress').hide();
    jQuery('#expandaddtional').click(function(e){
        e.preventDefault();
        
        jQuery(this).toggleClass('open');
        if(jQuery(this).hasClass('open')){
            jQuery('#add_facaddress').show();
        }else{
            jQuery('#add_facaddress').hide();
        }


    });
    jQuery('#add_facaddress').click(function(e){
        e.preventDefault();
        var html = '';
        var lennew = (jQuery('.address_facility_new > div').length + 1);
        jQuery('#countfcaddress').val(lennew);
        html +=  `<div class="row fac-address`+lennew+`">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="op_facility_id_`+lennew+`">Facility `+lennew+`</label>
                        <input type="text" name="op_facility_name_`+lennew+`" id="op_facility_id_`+lennew+`" value="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="op_address_id_`+lennew+`">Address `+lennew+`</label>
                        <textarea class="character-counter" data-length="200" id="op_address_id_`+lennew+`" maxlength="200" name="op_address_name_`+lennew+`"></textarea>
                    </div>
                </div>
            </div> `;
            jQuery(".fac-address-"+lennew).delegate('.removeelm'+lennew ,"click",function(e){
                e.preventDefault();
                jQuery(this).parents('.fac-address-'+lennew).remove();
           
            });
        jQuery('.address_facility_new').append(html);
        
    });
        /*var lennew = jQuery('.address_facility_new > div').length;
    jQuery(".removeelm"+lennew).click(function(event) {
        event.preventDefault();
        console.log(lennew);
        alert('hi');
        jQuery(this).parents('.fac-address'+lennew).remove();
    });*/


    jQuery("form#new_work_history_form").delegate("a.delWork", "click", function(e){
        e.preventDefault();
        var v = jQuery(this).attr('id');
        jQuery('.row.fac-address'+v).remove();
    });
    
});

</script>

</body>
</html
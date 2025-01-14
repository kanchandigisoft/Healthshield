<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */


function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);

    wp_enqueue_style( 'sweet-style', '//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' );
    wp_enqueue_script('sweet-script','//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js',array('jquery'),'1.1',true); 


}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );
//breadcrumb function here

function get_breadcrumb() {
    echo '<li class="breadcrumb-item active" aria-current="page"><a href="'.home_url().'" rel="nofollow">Home</a></li>';
    if (is_category() || is_single()) {
        echo '<li class="breadcrumb-item" aria-current="page">';
        the_category(' &bull; ');
        echo '<li>';
            if (is_single()) {
                echo '<li class="breadcrumb-item" aria-current="page">';
                the_title();
                echo '</li>';
            }
    } elseif (is_page()) {
        echo '<li class="breadcrumb-item" aria-current="page">';
        echo the_title();
        echo '</li>';
    } elseif (is_search()) {
        echo '<li class="breadcrumb-item" aria-current="page">Search Results for...';
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
        echo '</li>';
    }
}


add_filter( 'author_link', 'modify_author_link', 10, 1 );        
function modify_author_link( $link ) { 
$site = get_site_url();      
    $link = $site.'profile/';
    return $link;                
}

class DM_Project_Post_Types {

    public function __construct() {
        add_action( 'init', array( $this, 'all_post_types' ) );
    }

    public function all_post_types() {
        $post_types = [
            [
                'post_type' => 'licenses',
                'singular'  => 'Licenses',
                'slug'      => 'licenses',
            ],
            [
                'post_type' => 'certifications',
                'singular'  => 'Certifications',
                'slug'      => 'certifications',
            ],
             [
                'post_type' => 'education',
                'singular'  => 'Education',
                'slug'      => 'education',
            ],
             [
                'post_type' => 'work-history',
                'singular'  => 'Work History',
                'slug'      => 'work-history',
            ],
            [
                'post_type' => 'work-history-gap',
                'singular'  => 'Work History Gap',
                'slug'      => 'work-history-gap',
            ],
             [
                'post_type' => 'skills',
                'singular'  => 'Skills',
                'slug'      => 'skills',
            ],
             [
                'post_type' => 'skills-checklists',
                'singular'  => 'Skills Checklists',
                'slug'      => 'skills-checklists',
            ],
             [
                'post_type' => 'references',
                'singular'  => 'References',
                'slug'      => 'references',
            ],
             [
                'post_type' => 'immunizations',
                'singular'  => 'Immunizations',
                'slug'      => 'immunizations',
            ],
            [
                'post_type' => 'additional-documents',
                'singular'  => 'Additional Documents',
                'slug'      => 'additional-documents',
            ],
            [
                'post_type' => 'opportunities',
                'singular'  => 'Opportunity',
                'slug'      => 'opportunities',
            ],
            [
                'post_type' => 'locations',
                'singular'  => 'Locations',
                'slug'      => 'locations',
            ],
             [
                'post_type' => 'my-shares',
                'singular'  => 'My Shares',
                'slug'      => 'my-shares',
            ],
            [
                'post_type' => 'military',
                'singular'  => 'Military',
                'slug'      => 'military',
            ],
            [
                'post_type' => 'insurance',
                'singular'  => 'Insurance',
                'slug'      => 'insurance',
            ],
            [
                'post_type' => 'case-logs',
                'singular'  => 'Case Logs',
                'slug'      => 'case-logs',
            ],
            [
                'post_type' => 'facility',
                'singular'  => 'Facilities',
                'slug'      => 'facility',
            ],
            [
                'post_type' => 'facility-contract',
                'singular'  => 'Facility Contract',
                'slug'      => 'facility-contract',
            ],
            [
                'post_type' => 'facility-document',
                'singular'  => 'Facility Document',
                'slug'      => 'facility-document',
            ],
            


        ];

        foreach ($post_types as $key => $post_type) {
            $this -> dm_register_post_type( $post_type );
        }
    }

    private function dm_register_post_type( $data ) {

        $singular  = $data['singular'];
        $plural    = ( isset( $data['plural'] ) ) ? $data['plural'] : $data['singular'] ;
        $post_type = $data['post_type'];
        $slug      = $data['slug'];

        $labels = array(
            'name'               => _x( $plural, 'post type general name', 'dm-artillerie-theme' ),
            'singular_name'      => _x( $singular, 'post type singular name', 'dm-artillerie-theme' ),
            'menu_name'          => _x( $plural, 'admin menu', 'dm-artillerie-theme' ),
            'name_admin_bar'     => _x( $singular, 'add new on admin bar', 'dm-artillerie-theme' ),
            'add_new'            => _x( 'Add New', $singular, 'dm-artillerie-theme' ),
            'add_new_item'       => __( 'Add New ' . $singular, 'dm-artillerie-theme' ),
            'new_item'           => __( 'New ' . $singular, 'dm-artillerie-theme' ),
            'edit_item'          => __( 'Edit ' . $singular, 'dm-artillerie-theme' ),
            'view_item'          => __( 'View ' . $singular, 'dm-artillerie-theme' ),
            'all_items'          => __( 'All ' . $plural, 'dm-artillerie-theme' ),
            'search_items'       => __( 'Search ' . $plural, 'dm-artillerie-theme' ),
            'parent_item_colon'  => __( 'Parent ' . $plural . ':', 'dm-artillerie-theme' ),
            'not_found'          => __( 'No ' . $plural . ' found.', 'dm-artillerie-theme' ),
            'not_found_in_trash' => __( 'No ' . $plural . ' found in Trash.', 'dm-artillerie-theme' )
        );
        //$profile_slug = '/profile/'.$slug ;
        $profile_slug = $slug ;
        $args = array(
            'labels'             => $labels,
            'description'        => __( $singular .'.', 'dm-artillerie-theme' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => $profile_slug, 'with_front' => false ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title','author', 'thumbnail', 'excerpt', 'comments')
        );

        register_post_type( $post_type, $args );

    }


} // End class

function medical_taxonomy() {
    register_taxonomy(
        'medical_categories',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
        'medical-history',             // post type name
        array(
            'hierarchical' => true,
            'label' => 'Medical Category', // display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'medical-history',    // This controls the base slug that will display before each term
                'with_front' => false  // Don't display the category base before
            )
        )
    );
}
add_action( 'init', 'medical_taxonomy');

new DM_Project_Post_Types;


function update_custom_roles() {
        add_role( 'CRNA', 'CRNA', array( 'read' => true, 'level_0' => true ,'edit_post'=> true,'delete_post' => true) );
        add_role( 'NP', 'NP', array( 'read' => true, 'level_0' => true ) );
        add_role( 'PA', 'PA', array( 'read' => true, 'level_0' => true ) );
        add_role( 'RN', 'RN', array( 'read' => true, 'level_0' => true ) );
        add_role( 'MD', 'MD', array( 'read' => true, 'level_0' => true ) );
        add_role( 'DO', 'DO', array( 'read' => true, 'level_0' => true ) );
        add_role( 'DDS', 'DDS', array( 'read' => true, 'level_0' => true ) ); 
        add_role( 'Provider', 'Provider', array( 'read' => true, 'level_0' => true ) );  
}
add_action( 'init', 'update_custom_roles' );



/**********************************function of medical category*********************/

add_action( 'wp_ajax_nopriv_categoryFilter', 'categoryFilterFun' );
add_action( 'wp_ajax_categoryFilter', 'categoryFilterFun' );
function categoryFilterFun () {

    $main_catid = $_POST['main_catid'];

            $taxonomies = array( 
            'medical_categories',
            );

            $args = array(
            'parent'         => $main_catid,
            'hide_empty' => false 
            ); 

            $terms = get_terms($taxonomies, $args);


    // $taxonomies = get_terms( array(
    // 'taxonomy' => 'medical_categories',
    //  'parent'         => $main_catid,
    //  'hide_empty' => false
    // ) );

    if ( !empty($terms) ) :
    $output .= '<option value=""></option>';
    foreach( $terms as $category ) {

                $output.= '<option value="'. esc_attr( $category->term_id ).'">
                    '. esc_html( $category->name ) .'</option>';
        
    }
    echo $output;
endif;
}


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
   .user-profile-picture img.attachment-96x96.size-96x96 {
    width: 150px;
    height: auto;
}
  </style>';
}


function filter_get_avatar( $avatar, $id_or_email, $size, $default, $alt ) {    
        // Get attachment id
        $attachment_id  = get_user_meta( $id_or_email, 'wp_user_avatar', true );
        
        // NOT empty
        if ( ! empty ( $attachment_id  ) ) {
            // Return saved image
            return wp_get_attachment_image( $attachment_id, [ $size, $size ], false, ['alt' => $alt] );
        }

        return $avatar;
}
add_filter( 'get_avatar', 'filter_get_avatar', 10, 5 );


/*********************************Signup form**********************************/

// user registration login form
function pippin_registration_form() {
 
    // only show the registration form to non-logged-in members
    if(!is_user_logged_in()) {
 
        global $pippin_load_css;
 
        // set this to true so the CSS is loaded
        $pippin_load_css = true;
 
        // check to make sure user registration is enabled
        $registration_enabled = get_option('users_can_register');
 
        // only show the registration form if allowed
        if($registration_enabled) {
            $output = pippin_registration_form_fields();
        } else {
            $output = __('User registration is not enabled');
        }
        return $output;
    }
}
add_shortcode('register_form', 'pippin_registration_form');



// user login form
function pippin_login_form() {
 
    if(!is_user_logged_in()) {
 
        global $pippin_load_css;
 
        // set this to true so the CSS is loaded
        $pippin_load_css = true;
 
        $output = pippin_login_form_fields();
    } else {
        // could show some logged in user info here
        // $output = 'user info here';
    }
    return $output;
}
add_shortcode('login_form', 'pippin_login_form');


// registration form fields
function pippin_registration_form_fields() {
 global $wp_roles;
    ob_start(); ?>  
        <h2 class="pippin_header font-normal text-center"><?php _e('Healthcare professionals deserve a simple, effective tool to manage their careers.'); ?></h2>
            
        <?php 
        // show any error messages after form submission
        pippin_show_error_messages(); ?>
 
        <form id="pippin_registration_form" class="pippin_form w-50 m-auto" action="" method="POST">
            <input type="hidden" name="agency" value="<?php echo $_GET['pId'] ?>">
            <fieldset>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="pippin_user_first"><?php _e('First Name'); ?></label>
                            <input name="pippin_user_first" id="pippin_user_first" type="text"/>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="pippin_user_last"><?php _e('Last Name'); ?></label>
                            <input name="pippin_user_last" id="pippin_user_last" type="text"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pippin_user_Login">Username</label>
                    <input name="pippin_user_login" id="pippin_user_login" class="required" type="text"/>
                </div>
                <div class="form-group">
                    <label for="pippin_user_email"><?php _e('Email'); ?></label>
                    <input name="pippin_user_email" id="pippin_user_email" class="required" type="email"/>
                </div>
                <div class="form-group">
                    <label for="password"><?php _e('Password'); ?></label>
                    <input name="pippin_user_pass" id="password_id" class="required" type="password"/>         
                </div>                            
                
                <div class="form-group text-center">
                    <input type="hidden" name="pippin_register_nonce" value="<?php echo wp_create_nonce('pippin-register-nonce'); ?>"/>
                    <input type="submit" class="my-3" name="regsiter_user" id="regsiter_user"  value="<?php _e('Create Your Account'); ?>"/>
                </div>
            </fieldset>
            <div class="col-12 mb-2 text-center">
        <a class="btn btn-link btn-block text-white" href="<?php echo get_permalink(1310); ?>">Already a user? Log In</a>
        </div>
        </form>
        
    <?php
    return ob_get_clean();
}



// login form fields
function pippin_login_form_fields() {
 
    ob_start(); ?>
        <h2 class="pippin_header font-normal text-center"><b>Freedom</b> at your fingertips</h2>
 
        <?php
        // show any error messages after form submission
        pippin_show_error_messages(); ?>
 
        <form id="pippin_login_form"  class="pippin_form w-50 m-auto" action="" method="post">
            <fieldset>
                <div class="form-group">
                    <label for="pippin_user_Login">Username</label>
                    <input name="pippin_user_login" id="pippin_user_login" class="required" type="text"/>
                </div>
                <div class="form-group">
                    <label for="pippin_user_pass">Password</label>
                    <input name="pippin_user_pass" id="pippin_user_pass" class="required" type="password"/>
                </div>
                <div class="form-group text-center">
                    <input type="hidden" name="pippin_login_nonce" value="<?php echo wp_create_nonce('pippin-login-nonce'); ?>"/>
                    <input id="pippin_login_submit" name="pippin_login_submit" class="my-3" type="submit" value="Login"/>
                </div>
            </fieldset>
                <div class="col-12 mb-2 d-block text-center">
                <a class="btn btn-block text-white" href="<?php echo home_url(); ?>/signup">Sign Up as Employee!</a>
                <span class="text-white">|</span>
                <a class="btn btn-block text-white" href="<?php echo home_url(); ?>/register">Sign Up as Employer!</a>
                <span class="text-white">|</span>
                <a class="btn btn-block text-white" href="<?php echo home_url(); ?>/facility-signup">Sign Up as Facility!</a>
                </div>
            <div class="col-12 text-center">
            <a class="btn btn-link btn-block text-white" href="<?php echo get_site_url(); ?>/my-account/?action=forgot_password" style="display:inline-block;">Forgot Password</a>
            </div>
        </form>
    <?php
    return ob_get_clean();
}


// logs a member in after submitting a form
function pippin_login_member() {
 
    if(isset($_POST['pippin_user_login']) && wp_verify_nonce($_POST['pippin_login_nonce'], 'pippin-login-nonce')) {
        // this returns the user ID and other info from the user name
        $user = get_userdatabylogin($_POST['pippin_user_login']);
 
        if(!$user) {
            // if the user name doesn't exist
            pippin_errors()->add('empty_username', __('Invalid username'));
        }
 
        if(!isset($_POST['pippin_user_pass']) || $_POST['pippin_user_pass'] == '') {
            // if no password was entered
            pippin_errors()->add('empty_password', __('Please enter a password'));
        }
 
        // check the user's login with their password
        if(!wp_check_password($_POST['pippin_user_pass'], $user->user_pass, $user->ID)) {
            // if the password is incorrect for the specified user
            pippin_errors()->add('empty_password', __('Incorrect password'));
        }
 
        // retrieve all error messages
        $errors = pippin_errors()->get_error_messages();

        $creds = array(
            'user_login'    => $_POST['pippin_user_login'],
            'user_password' => $_POST['pippin_user_pass'],
            'remember'      => true
            );
            $users = wp_signon( $creds, false );
            if ( is_wp_error( $users ) ) {
                //echo $errors;
            } else {
                wp_setcookie($_POST['pippin_user_login'], $_POST['pippin_user_pass'], true);
                wp_set_current_user($user->ID, $_POST['pippin_user_login']);  

                /* Getting membership ids of current user */
                if(class_exists('MeprUtils')) {
                  $user = MeprUtils::get_currentuserinfo();                  
                  if($user !== false && isset($user->ID)) {
                    $active_prodcuts = $user->active_product_subscriptions('ids');
                  }
                }
                $loginuser_meta = get_userdata($user->ID);
                $loginuser_meta_roles = $loginuser_meta->roles;

                if($loginuser_meta_roles[0] == 'Provider') {
                    if(!empty($active_prodcuts)){
                        $redirect = get_permalink(790);
                    } else {
                        $redirect = get_permalink(5752);
                    }                   
                } elseif ($loginuser_meta_roles[0] == 'CRNA') {

                    global $wpdb;

                    /**Getting Associated Agency Info***/
                    $User_Id = $user->ID;
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
                    /**If employee having agency then redirect to profile else to membership plan**/
                    if($havingAgency > 0 || !empty($active_prodcuts))
                    {
                        $redirect = get_permalink(790);
                    }
                    else
                    {                            
                        $redirect = get_permalink(5726);
                    }

                } else {
                    $redirect = get_permalink(790);
                }

                wp_redirect($redirect);
                exit;

            } 	

    }
}
add_action('init', 'pippin_login_member');


/**Register with Employee**/
function pippin_add_new_member() {
    if (isset( $_POST["pippin_user_login"] ) && wp_verify_nonce($_POST['pippin_register_nonce'], 'pippin-register-nonce')) {
        $user_login = $_POST['pippin_user_login'];      
        $user_email     = $_POST["pippin_user_email"];
        $user_first     = $_POST["pippin_user_first"];
        $user_last      = $_POST["pippin_user_last"];
        $user_pass      = $_POST["pippin_user_pass"];       
        $user_profession = $_POST['pippin_user_profession'];
        $user_exp = $_POST['pippin_user_exp'];

        $agency = $_POST['agency'];

        $user_specialty = $_POST['pippin_user_specialty'];
        // this is required for username checks
        require_once(ABSPATH . WPINC . '/registration.php');
 
        if(username_exists($user_login)) {
            // Username already registered
            pippin_errors()->add('username_unavailable', __('Username already taken'));
        }
        if(!validate_username($user_login)) {
            // invalid username
            pippin_errors()->add('username_invalid', __('Invalid username'));
        }
        if(!is_email($user_email)) {
            //invalid email
            pippin_errors()->add('email_invalid', __('Invalid email'));
        }
        if(email_exists($user_email)) {
            //Email address already registered
            pippin_errors()->add('email_used', __('Email already registered'));
        }
        if($user_pass == '') {
            // passwords do not match
            pippin_errors()->add('password_empty', __('Please enter a password'));
        }
 
        $errors = pippin_errors()->get_error_messages();
 
        // only create the user in if there are no errors
        if(empty($errors)) {
 
            $new_user_id = wp_insert_user(array(
                    'user_login'        => $user_login,
                    'user_pass'         => $user_pass,
                    'user_email'        => $user_email,
                    'first_name'        => $user_first,
                    'last_name'         => $user_last,
                    'user_registered'   => date('Y-m-d H:i:s'),
                    'role'              => $user_profession,
                    'meta_input' => array(
                        'year_of_experience' => $user_exp,
                        'specialty' => $user_specialty,
                    ),
                )
            );

                $creds = array(
                    'user_login'    => $user_login,
                    'user_password' => $user_pass,
                    'remember'      => true
                );
                $users = wp_signon( $creds, false );
                if ( is_wp_error( $users ) ) {
                    echo $errors;
                } else {


                       $savedEmp = get_user_meta($agency, 'selected_employees', true); 
                       if($savedEmp)
                       {
                            $newSave = $savedEmp.','.$new_user_id;
                            update_user_meta($agency, 'selected_employees', $newSave);
                        }
                        else
                        {
                            update_user_meta($agency, 'selected_employees', $new_user_id);
                        }


                        $key1 = 'request_status_'.$agency;
                        add_user_meta($new_user_id, $key1, '1');

                        $revoke_key = 'revoke_status_'.$agency;
                        update_user_meta($new_user_id, $revoke_key, 'yes');




                        wp_new_user_notification($new_user_id);
        
                        // log the new user in
                        wp_setcookie($user_login, $user_pass, true);
                        wp_set_current_user($new_user_id, $user_login); 
                        // send the newly created user to the home page after logging them in

                        $loginuser_meta = get_userdata($new_user_id);
                        $loginuser_meta_roles = $loginuser_meta->roles;


                        if($loginuser_meta_roles[0] == 'Provider') {
                            
                            $redirect = get_permalink(5752);
                                               
                        } elseif ($loginuser_meta_roles[0] == 'CRNA') {
                            
                            global $wpdb;

                            /**Getting Associated Agency Info***/
                            $User_Id = $new_user_id;
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
                            /**If employee having agency then redirect to profile else to membership plan**/
                            if($havingAgency > 0)
                            {
                                $redirect = get_permalink(790);
                            }
                            else
                            {                            
                                $redirect = get_permalink(5726);
                            }
                                               
                        } else {
                            $redirect = get_permalink(790);
                        }

                        wp_redirect($redirect);
                        exit;
                }
 
        }
 
    }
}
add_action('init', 'pippin_add_new_member');


/******************reset password form *********************/

function pippin_change_password_form() {
    global $post;   
 
    if (is_singular()) :
        $current_url = get_permalink($post->ID);
    else :
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") $pageURL .= "s";
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        else $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        $current_url = $pageURL;
    endif;      
    $redirect = $current_url;
 
    ob_start();
 
        // show any error messages after form submission
        pippin_show_error_messages(); ?>
 
        <?php if(isset($_GET['password-reset']) && $_GET['password-reset'] == 'true') { ?>
            <div class="pippin_message success">
                <span><?php _e('Password changed successfully', 'rcp'); ?></span>
            </div>
        <?php } ?>
        <form id="pippin_password_form" class="w-50 m-auto" method="POST" action="<?php echo $current_url; ?>">
            <fieldset id="email-fields" class="<?php if(isset($_GET['password-reset'])){ echo 'd-none'; }else{ echo 'd-block'; } ?>" >
                <div class="form-group">
                    <label for="exit_email_id">Email:</label>
                    <input type="email" value="" name="exit_email_id"  required id="exit_email_id">
                </div>
                <div class="form-group text-center">
                    <input type="hidden" name="pippin_email_nonce" value="<?php echo wp_create_nonce('pippin-email-nonce'); ?>"/>
                    <input id="pippin_email_submit" name="pippin_email_submit" class="my-3" type="submit" value="Send email"/>
                </div>
            </fieldset>
            <fieldset id="password-fields " class="<?php if(isset($_GET['password-reset'])){ echo 'd-block'; }else{ echo 'd-none'; } ?>" >
                <div class="form-group">
                    <label for="pippin_user_pass"><?php _e('New Password', 'rcp'); ?></label>
                    <input name="pippin_user_pass" id="pippin_user_pass" required type="password"/>
                </div>

                <div class="form-group">
                    <label for="pippin_user_pass_confirm"><?php _e('Password Confirm', 'rcp'); ?></label>
                    <input name="pippin_user_pass_confirm" id="pippin_user_pass_confirm" required type="password"/>
                </div>
               <div class="form-group text-center">
                    <input type="hidden" name="pippin_action" value="reset-password"/>
                    <input type="hidden" name="pippin_redirect" value="<?php echo $redirect; ?>"/>
                    <input type="hidden" name="pippin_password_nonce" value="<?php echo wp_create_nonce('rcp-password-nonce'); ?>"/>
                    <input id="pippin_password_submit" type="submit" class="my-3 text-center" value="<?php _e('Change Password', 'pippin'); ?>"/>
                </div>
            </fieldset>
        </form>
    <?php
    return ob_get_clean();  
}
 
// password reset form
function pippin_reset_password_form() {
    if(!is_user_logged_in()) {
        return pippin_change_password_form();
    }
}
add_shortcode('password_form', 'pippin_reset_password_form');
 function send_email_forget_password(){
    if(isset($_POST['pippin_email_submit'])){
        $user_email = $_POST['exit_email_id'];
        if(!is_email($user_email)) {
            //invalid email
            pippin_errors()->add('email_invalid', __('Invalid email'));
        }
        if(email_exists($user_email)) {
            //Email address already registered
            pippin_errors()->add('email_used', __('Email already registered'));
        }
        $errors = pippin_errors()->get_error_messages();

    }
 }
 add_action('init', 'send_email_forget_password');
 
// used for tracking error messages
function pippin_errors(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

// displays error messages from form submissions
function pippin_show_error_messages() {
    if($codes = pippin_errors()->get_error_codes()) {
        echo '<div class="pippin_errors">';
            // Loop error codes and display errors
           foreach($codes as $code){
                $message = pippin_errors()->get_error_message($code);
                echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
            }
        echo '</div>';
    }   
}


/*
* Functions to add view counters and display the value in the Admin's Posts overview
*
* Code base found at https://www.isitwp.com/track-post-views-without-a-plugin-using-post-meta/
*/

function get_post_views($postID) {
   $count_key = 'post_views_count';
   $count = get_post_meta($postID, $count_key, true);
   if($count==''){
       delete_post_meta($postID, $count_key);
       add_post_meta($postID, $count_key, '0');
       return "0 Views";
   }
   if ($count=='1') {
      return "1 View";
   }
   return $count.' Views';
}

add_action( 'wp_ajax_nopriv_emailCountViews', 'emailCountViews' );
add_action( 'wp_ajax_emailCountViews', 'emailCountViews' );
function emailCountViews() 
{
    $post_ID = $_POST['postId'];
// Only count views on published posts
   if (get_post_status($post_ID) !== 'publish'){
       return;
   }

   $count_key = 'post_views_count';
   $count = get_post_meta($post_ID, $count_key, true);

   if($count=='') {
       $count = 0;
       delete_post_meta($post_ID, $count_key);
       add_post_meta($post_ID, $count_key, '0');
   } else {
       $count++;
       update_post_meta($post_ID, $count_key, $count);
   }
}

// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); 

// Add to a column in WP-Admin
function posts_column_views($defaults) {
    $defaults['post_views'] = __('Views');
    return $defaults;
}

function posts_custom_column_views($column_name, $id) {
    if($column_name === 'post_views'){
        echo get_post_views(get_the_ID());
    }
}

add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);


/***********reorder***************/
add_action('wp_ajax_reOrderData', 'reOrderData');
function reOrderData(){
  global $wpdb, $user, $post;
    $uid = get_current_user_id();
    $result = array();
    $changedData = $_POST['changedData'];
    //$postId = $_POST['postId'];
    $dataArray = explode(',', $changedData);

    if($changedData)
    {

        foreach($dataArray as $dataVal)
        {
            $dataValArray = explode('/', $dataVal);  
            if($dataValArray){    
                $value = $dataValArray[0]+1;  
                update_post_meta( $dataValArray[1], 'postSorting' ,$value ); 
            }    
        }

        $result['status']='success';
        $result['msg']= $changedData;

    }
    else
    {
        $result['status']='error';
        $result['msg']= esc_html__('Something goes wrong please try again','ibid');
    }
    echo json_encode($result);
    exit;   
}






add_action('wp_ajax_deleteItem', 'deleteItem');
function deleteItem(){
    global $wpdb, $user, $post;
    $uid = get_current_user_id();
    $ID = $_POST['item_id'];
 

    if($ID)
    {
        wp_delete_post($ID);
        $result['status']='success';
        $result['msg']= esc_html__('Item deleted successfully','ibid');
    }
    else
    {
        $result['status']='error';
        $result['msg']= esc_html__('Something goes wrong please try again','ibid');
    }
    echo json_encode($result);
    exit;   
}

// the ajax function
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
function data_fetch(){

    $User_Id = get_current_user_id();
    $meta_query = array();
    $args = array();
    $search_string = $_POST['keyword'];

    $ap = $_POST['ap'];
    $ac = $_POST['ac'];
    $at = $_POST['at'];
    $ad = $_POST['ad'];

    $searchAge = $_POST['searchAge'];

    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    if($searchAge)
    {
        $searchAgeArray = explode(',', $searchAge);
    }


    $peri = $_POST['perheraltext'];

    if($peri)
    {
        $periSearch = explode(',', $peri);
    }

    if($ap)
    { 
        $apSearch = explode(',', $ap);
    }
    if($ac)
    {
        $acSearch = explode(',', $ac); 
    }
    if($at)
    {
        $atSearch = explode(',', $at);
    } 
    if($ad)
    {
        $adSearch = explode(',', $ad);
    }   
  
    if($search_string)
    {
        $meta_query[] = array(
            'key' => 'facility_name_case',
            'value' => $search_string,
            'compare' => 'LIKE'
        );
    }

    if(count($meta_query) > 1) {
        $meta_query['relation'] = 'OR';
    }

    // The Query
    $args['post_type'] = "case-logs";
    $args['posts_per_page'] = -1;
    $args['_meta_or_title'] = $search_string; //not using 's' anymore
    $args['meta_query'] = $meta_query;
    $args['author'] = $User_Id;
    $args['post_status'] = 'publish';
    

    $loop = new WP_Query( $args ); 

    $total = $loop->found_posts;

    if( $loop->have_posts() ) {
       
        while( $loop->have_posts() ): $loop->the_post(); 

        $postId = get_the_ID();
        $post_slug = $post->post_name;
        $fcname = get_field('facility_name_case');
        $agecase = get_field('age_case');
        $gendercase = get_field('gender_case');
        $phystatus = get_field('physical_status_case');
        $traumaemg = get_field('traumaemergency_case');
        $clinicalnot = get_field('clinical_notes_case');
        $peripheral = get_field('peripheral_case');

        $loopPeripheralArray = explode(',', $peripheral);

         $datecselog = get_field('case_log_date');  
         $newDate = date("Y-m-d", strtotime($datecselog)); 

        $imgs = get_post_meta($postId,'caselogs_attachment_id',true);
   
        $AnesthesiaTypevalues = get_post_meta($postId,'AnesthesiaType_data',true);
        $administartionvalues = get_post_meta($postId,'administration_data',true);
        $Proceduresvalues = get_post_meta($postId,'AnesthesiaProcedures_data',true);
        $AnatomicalCategoryvalues = get_post_meta($postId,'AnatomicalCategory_data',true);

        $getDay = get_post_meta($postId, 'day', true);
        $getMonth = get_post_meta($postId, 'month', true);
        $getYear = get_post_meta($postId, 'year', true);

        $faciAge = get_post_meta($postId, 'faciAge', true);
        if($faciAge == 'Neonate')
        {
            $label = 'Neonate (less than 4 weeks)';
        }
        else if($faciAge == 'Pediatric1')
        {
            $label = 'Pediatric ( 5 weeks - 2 years)';
        }
        else if($faciAge == 'Pediatric2')
        {
            $label = 'Pediatric 2 to 17 years';
        }
        else if($faciAge == 'Adult')
        {
            $label  = 'Adult 18-64';
        }
        else if($faciAge == 'Geriatric')
        {
            $label = 'Geriatric 65+ years';
        }
        else
        {
            $label = '';
        }

        /*if($getDay)
        {
            $day = $getDay.' Days';
        }
        else
        {
            $day = '';
        }

        if($getMonth)
        {
            $month = $getMonth.' Months';
        }
        else
        {
            $month = '';
        }

        if($getYear)
        {
            $year = $getYear.' Years';
        }
        else
        {
            $year = '';
        }

        $fullAge = $year.' '.$month.' '.$day;*/
   
        $va1 = explode(',', $AnesthesiaTypevalues);
        $va2 = explode(',', $administartionvalues);
        $va3 = explode(',', $Proceduresvalues);
        $va4 = explode(',', $AnatomicalCategoryvalues);

        $finalVa = array_merge($va1,$va3,$va4, $loopPeripheralArray);

        $caseId = array();

        /*if($searchAgeArray)
        {
            foreach($searchAgeArray as $searchAgeName)
            {
                if($searchAgeName == 'Neonate')
                {
                    $caseId[] = get_the_ID();
                }

                if($searchAgeName == 'Pediatric1')
                {
                    $caseId[] = get_the_ID();
                }

                if($searchAgeName == 'Pediatric2')
                {
                    $caseId[] = get_the_ID();
                }

                if($searchAgeName == 'Adult')
                {
                    $caseId[] = get_the_ID();
                }

                if($searchAgeName == 'Geriatric')
                {
                    $caseId[] = get_the_ID();
                }
            }
        }*/

        if($searchAgeArray && $faciAge)
        {

        if (in_array($faciAge, $searchAgeArray))
        {
            $caseId[] = get_the_ID();
        }

        }

        if($apSearch && $va3)
        {
            foreach($apSearch as $checkAp)
            {
                if (in_array($checkAp, $va3))
                {
                    $caseId[] = get_the_ID();
                }

            }
        }

        if($acSearch && $va4)
        {
            foreach($acSearch as $checkAc)
            {
                if (in_array($checkAc, $va4))
                {
                    $caseId[] = get_the_ID();
                }

            }
        }

        if($atSearch && $va1)
        {
            foreach($atSearch as $checkAt)
            {
                if (in_array($checkAt, $va1))
                {
                    $caseId[] = get_the_ID();
                }

            }
        }

        if($adSearch && $va2)
        {
            foreach($adSearch as $checkAd)
            {
                if (in_array($checkAd, $va2))
                {
                    $caseId[] = get_the_ID();
                }

            }
        }

        if($periSearch && $loopPeripheralArray)
        {
            foreach($periSearch as $checkPeri)
            {
                if (in_array($checkPeri, $loopPeripheralArray))
                {
                    $caseId[] = get_the_ID();
                }

            }
        }

        if($fromDate && $toDate)
        {
            if(($newDate >= $fromDate) && ($newDate <= $toDate))
            {
                $caseId[] = get_the_ID();
            }

        }

        $finalCaseId = array_unique($caseId);

        if (in_array($postId, $finalCaseId))
        {
            $class = '';
        }
        else
        {
            $class = 'style="display:none"';
        }

?>
        <li <?php echo $class; ?> class="caselogs_list list-display" id="post-<?php echo $postId; ?>">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5><?php echo $fcname; ?></h5>
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
                                <div class="data-row lic_rows_data">
                                    <div class="data_label">
                                        Age :
                                    </div>
                                    <div class="data_values">
                                    <?php echo $label; ?>
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
                                    <?php echo $datecselog; ?>
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
                                <?php if($imgs){ ?>
                                <div class="attachments">
                                    <div class="data_label">
                                        <h3>Attachments:</h3>
                                    </div>
                                    <?php                                    
                                    $meta = explode(',', $imgs);
                                    foreach ($meta as $metas) {
                                        $attch_name = basename( get_attached_file($metas ) );
                                        echo '<a target="_blank" href="'.wp_get_attachment_url($metas).'">'.$attch_name.'</a><br>';
                                    }
                                    ?>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-6">

                                <?php if($va1){ ?>
                                <div class="data-row lic_rows_data">
                                    <div class="data_labels">
                                    <b> Anesthesia Type:</b>

                                    <ul>
                                        <?php foreach($va1 as $antype){
                                            echo '<li>'.$antype.'</li>';
                                        } ?>
                                    </ul>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if($va2){ ?>
                                <div class="data-row lic_rows_data">
                                    <div class="data_labels">
                                        <b>Administration:</b>

                                    <ul>
                                        <?php foreach($va2 as $admin){
                                            if($admin == 'Administration - Peripheral')
                                            {
                                            if($peripheral) { $peripheral = '('.$peripheral.')';  }    
                                            echo '<li>'.$admin.' '.$peripheral.'</li>';
                                            }
                                            else
                                            {
                                            echo '<li>'.$admin.'</li>';
                                            }
                                        } ?>
                                    </ul>
                                    </div>
                                </div>
                                 <?php } ?>
                                <div class="data-row lic_rows_data">
                                    <div class="data_labels">
                                        <b>Anesthesia Procedures:</b>

                                    <ul>
                                        <?php foreach($va3 as $anpro){
                                            echo '<li>'.$anpro.'</li>';
                                        } ?>
                                    </ul>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_labels">
                                        <b>Anatomical Category:</b>

                                        <ul>
                                            <?php foreach($va4 as $ancat){
                                                echo '<li>'.$ancat.'</li>';
                                            } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
  <?php       endwhile;
        wp_reset_postdata();  
    }else{
        echo'No Data Found.';
    }

    die();
}





// the ajax function for pdf table
add_action('wp_ajax_data_fetch_pdf_table' , 'data_fetch_pdf_table');
add_action('wp_ajax_nopriv_data_fetch_pdf_table','data_fetch_pdf_table');
function data_fetch_pdf_table(){

    $User_Id = get_current_user_id();
    $meta_query = array();
    $args = array();
    $search_string = $_POST['keyword'];

    $ap = $_POST['ap'];
    $ac = $_POST['ac'];
    $at = $_POST['at'];
    $ad = $_POST['ad'];

    $searchAge = $_POST['searchAge'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];


    if($searchAge)
    {
        $searchAgeArray = explode(',', $searchAge);
    }


    $peri = $_POST['perheraltext'];

    if($peri)
    {
        $periSearch = explode(',', $peri);
    }

    if($ap)
    { 
        $apSearch = explode(',', $ap);
    }
    if($ac)
    {
        $acSearch = explode(',', $ac); 
    }
    if($at)
    {
        $atSearch = explode(',', $at);
    } 
    if($ad)
    {
        $adSearch = explode(',', $ad);
    }   
  
    if($search_string)
    {
        $meta_query[] = array(
            'key' => 'facility_name_case',
            'value' => $search_string,
            'compare' => 'LIKE'
        );
    }

    if(count($meta_query) > 1) {
        $meta_query['relation'] = 'OR';
    }

    // The Query
    $args['post_type'] = "case-logs";
    $args['posts_per_page'] = -1;
    $args['_meta_or_title'] = $search_string; //not using 's' anymore
    $args['meta_query'] = $meta_query;
    $args['author'] = $User_Id;
    $args['post_status'] = 'publish';
    

    $loop = new WP_Query( $args ); 

    $total = $loop->found_posts;

    if( $loop->have_posts() ) {
       
        while( $loop->have_posts() ): $loop->the_post(); 

        $postId = get_the_ID();
        $post_slug = $post->post_name;
        $fcname = get_field('facility_name_case');
        $agecase = get_field('age_case');
        $gendercase = get_field('gender_case');
        $phystatus = get_field('physical_status_case');
        $traumaemg = get_field('traumaemergency_case');
        $clinicalnot = get_field('clinical_notes_case');
        $peripheral = get_field('peripheral_case');

        $loopPeripheralArray = explode(',', $peripheral);

        $datecselog = get_field('case_log_date');  
        $newDate = date("Y-m-d", strtotime($datecselog));

        $imgs = get_post_meta($postId,'caselogs_attachment_id',true);
   
        $AnesthesiaTypevalues = get_post_meta($postId,'AnesthesiaType_data',true);
        $administartionvalues = get_post_meta($postId,'administration_data',true);
        $Proceduresvalues = get_post_meta($postId,'AnesthesiaProcedures_data',true);
        $AnatomicalCategoryvalues = get_post_meta($postId,'AnatomicalCategory_data',true);

        $getDay = get_post_meta($postId, 'day', true);
        $getMonth = get_post_meta($postId, 'month', true);
        $getYear = get_post_meta($postId, 'year', true);

        $faciAge = get_post_meta($postId, 'faciAge', true);
        if($faciAge == 'Neonate')
        {
            $label = 'Neonate (less than 4 weeks)';
        }
        else if($faciAge == 'Pediatric1')
        {
            $label = 'Pediatric ( 5 weeks - 2 years)';
        }
        else if($faciAge == 'Pediatric2')
        {
            $label = 'Pediatric 2 to 17 years';
        }
        else if($faciAge == 'Adult')
        {
            $label  = 'Adult 18-64';
        }
        else if($faciAge == 'Geriatric')
        {
            $label = 'Geriatric 65+ years';
        }
        else
        {
            $label = '';
        }

        /*if($getDay)
        {
            $day = $getDay.' Days';
        }
        else
        {
            $day = '';
        }

        if($getMonth)
        {
            $month = $getMonth.' Months';
        }
        else
        {
            $month = '';
        }

        if($getYear)
        {
            $year = $getYear.' Years';
        }
        else
        {
            $year = '';
        }

        $fullAge = $year.' '.$month.' '.$day;*/
   
        $va1 = explode(',', $AnesthesiaTypevalues);
        $va2 = explode(',', $administartionvalues);
        $va3 = explode(',', $Proceduresvalues);
        $va4 = explode(',', $AnatomicalCategoryvalues);

        $finalVa = array_merge($va1,$va3,$va4, $loopPeripheralArray);

        $caseId = array();

        /*if($searchAgeArray)
        {
            foreach($searchAgeArray as $searchAgeName)
            {
                if($searchAgeName == 'Neonate')
                {
                    $caseId[] = get_the_ID();
                }

                if($searchAgeName == 'Pediatric1')
                {
                    $caseId[] = get_the_ID();
                }

                if($searchAgeName == 'Pediatric2')
                {
                    $caseId[] = get_the_ID();
                }

                if($searchAgeName == 'Adult')
                {
                    $caseId[] = get_the_ID();
                }

                if($searchAgeName == 'Geriatric')
                {
                    $caseId[] = get_the_ID();
                }
            }
        }*/

        if($searchAgeArray && $faciAge)
        {

        if (in_array($faciAge, $searchAgeArray))
        {
            $caseId[] = get_the_ID();
        }

        }

        if($apSearch && $va3)
        {
            foreach($apSearch as $checkAp)
            {
                if (in_array($checkAp, $va3))
                {
                    $caseId[] = get_the_ID();
                }

            }
        }

        if($acSearch && $va4)
        {
            foreach($acSearch as $checkAc)
            {
                if (in_array($checkAc, $va4))
                {
                    $caseId[] = get_the_ID();
                }

            }
        }

        if($atSearch && $va1)
        {
            foreach($atSearch as $checkAt)
            {
                if (in_array($checkAt, $va1))
                {
                    $caseId[] = get_the_ID();
                }

            }
        }

        if($adSearch && $va2)
        {
            foreach($adSearch as $checkAd)
            {
                if (in_array($checkAd, $va2))
                {
                    $caseId[] = get_the_ID();
                }

            }
        }

        if($periSearch && $loopPeripheralArray)
        {
            foreach($periSearch as $checkPeri)
            {
                if (in_array($checkPeri, $loopPeripheralArray))
                {
                    $caseId[] = get_the_ID();
                }

            }
        }

        if($fromDate && $toDate)
        {
            if(($newDate >= $fromDate) && ($newDate <= $toDate))
            {
                $caseId[] = get_the_ID();
            }

        }

        $finalCaseId = array_unique($caseId);

        if (in_array($postId, $finalCaseId))
        {
            $class = '';
        }
        else
        {
            $class = 'style="display:none"';
        }
?>
        <table <?php echo $class; ?> border="1" cellpadding="4" cellspacing="4" id="myTab" class="table table-striped" width="100%" style="margin-bottom: 20px;">
                    <colgroup>
                        <col width="50%">
                            <col width="50%">
                    </colgroup>
                    <thead>
                        <tr class='warning'>
                            <th colspan="2" align="left" style="padding-left: 10px; text-transform: uppercase; font-size: 16px;"><?php echo $fcname; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>Facility Name:</strong><?php echo $fcname; ?><br>
                                <!-- <strong>Document Name:</strong><?php //echo $document_name; ?><br> -->
                                    <strong>Age :</strong><?php echo $label; ?><br>
                                    <strong>Gender:</strong><?php echo $gendercase; ?><br>
                                    <?php if($datecselog){ ?>
                                    <strong>Date:</strong><?php echo $datecselog; ?><br>
                                    <?php } ?>
                                    <strong>Physcial Status:</strong><?php echo $phystatus; ?><br>
                                    <strong>Trauma/Emergency:</strong><?php echo $traumaemg; ?><br>
                            </td>
                              <td>
                                <strong>Anesthesia Type:</strong><?php foreach($va1 as $antype){
                                            echo $antype.'<br>';
                                        } ?>
                                     <strong>Administration:</strong>
                                      <?php foreach($va2 as $admin){
                                            if($admin == 'Administration - Peripheral')
                                            {
                                            if($peripheral) { $peripheral = '('.$peripheral.')';  }    
                                            echo $admin.' '.$peripheral.'<br>';
                                            }
                                            else
                                            {
                                            echo $admin.'<br>';
                                            }
                                        } ?>  

                                    <strong>Anesthesia Procedures:</strong>
                                        <?php foreach($va3 as $anpro){
                                            echo $anpro.'<br>';
                                        } ?>
                                    <strong>Anatomical Category:</strong>
                                        <?php foreach($va4 as $anpro){
                                            echo $anpro.'<br>';
                                        } ?>
                                    
                              </td>
                        </tr>
                    </tbody>
                </table>
  <?php       endwhile;
        wp_reset_postdata();  
    }/*else{
        echo'Add your Clinical Information!';
    }*/

    die();
}





// here's the function we'd like to call with our cron job
function my_repeat_function() {
    global $wpdb, $user, $post;

    $args = array();
    $today = time();
    $fine = array();

    $args_certifications = array(  
        'post_type' => 'certifications',
        'post_status' => 'publish',
    );
    //print_r($args_certifications);
    $post_type = $args_certifications->post_type ;
    echo $post_type;

$loop_ct = new WP_Query( $args_certifications ); 
    if( $loop_ct->have_posts() ) {
        while( $loop_ct->have_posts() ): $loop_ct->the_post();
        $postId = get_the_ID();
        $post = get_post( $postId );
        $User_Id = $post->post_author;
        $the_user = get_userdata( $User_Id );
        $email = $the_user->user_email;
        $name = $the_user->user_login;

        $cert_type = get_field('certificate_type');                                                                                         
        $dt2 = get_field('certificate_expire_date');
        $date2 = date("Y-m-d", strtotime($dt2));
        $newDate = strtotime($date2);
        $diff = $newDate - $today;
        $totaldays = round($diff / (60 * 60 * 24));
        $sendmail = get_post_meta( $postId, 'expiremailsend', true );
        $expiredmail = get_post_meta( $postId, 'expiredmail', true );
            if($totaldays == 30 && $sendmail == ''){
                                            
                $to = $email;
                $subject = 'EXPIRING Credentials';
                $body = '<html><body style="background:#efefef;">';
                $body .= '<table cellspacing="0" cellpadding="20" style="font-size: 14px; font-family: sans-serif">';
                $body .= '<tbody>
                <tr><td style="font-size: 16px; font-weight: bold; color: #015084;">Hi '.$name.'</td></tr>
                <tr>
                <td style="font-size: 16px; font-weight: bold; color: #015084;">
                You have one or more piece of your credentialing file that will be expiring in 30 days. Please login into your HealthShield account and update the information so that you stay current.
                </td>
                    <tr>
                    <td style="font-size: 16px; font-weight: bold; color: #015084;">Thank you,<br>
                        HealthShield Credentialing<br>
                        T: <a href="tel:(864) 326-5399">(864) 326-5399</a> <br>
                        E: <a href="mailto:admin@healthshieldcredentialing.com">admin@healthshieldcredentialing.com</a> <br>
                        W: <a href="http://healthshieldcredentialing.com">http://healthshieldcredentialing.com/</a><br>
                            
                        </td>
                    </tr>
                </tr>
                </tbody>
                </table></body></html>'; 

                $headers = array(); 
                $headers[] = 'Content-Type: text/html; charset=UTF-8';
                $emailsent = wp_mail($to, $subject, $body, $headers);
                // return $emailsent;

                if ( $emailsent ) {
                update_post_meta(  $postId, 'expiremailsend', 'yes' );
                }

            } else if($totaldays <= 0 && $expiredmail == ''){  //email on expire

                $to = $email;
                $subject = 'EXPIRED Credentials';

$body = '<html><body style="background:#efefef;">';
                $body .= '<table cellspacing="0" cellpadding="20" style="font-size: 14px; font-family: sans-serif">';
                $body .= '<tbody>
                <tr><td style="font-size: 16px; font-weight: bold; color: #015084;">Hi '.$name.'</td></tr>
                <tr>
                <td style="font-size: 16px; font-weight: bold; color: #015084;">
                You have one or more piece of your credential file that has expired. Please login into your HealthShield account and update the information so that you stay current.
                </td>
                    <tr>
                    <td style="font-size: 16px; font-weight: bold; color: #015084;">Thank you,<br>
                        HealthShield Credentialing<br>
                        T: <a href="tel:(864) 326-5399">(864) 326-5399</a> <br>
                        E: <a href="mailto:admin@healthshieldcredentialing.com">admin@healthshieldcredentialing.com</a> <br>
                        W: <a href="http://healthshieldcredentialing.com">http://healthshieldcredentialing.com/</a><br>
                            
                        </td>
                    </tr>
                </tr>
                </tbody>
                </table></body></html>'; 

                $headers = array(); 
                $headers[] = 'Content-Type: text/html; charset=UTF-8';
                $emailsent = wp_mail($to, $subject, $body, $headers);
                // return $emailsent;

                if ( $emailsent ) {
                update_post_meta(  $postId, 'expiredmail', 'yes' );
                }

            } else {

            }
    endwhile;
    }
   $args_immunizations = array(  
        'post_type' => 'immunizations',
        'post_status' => 'publish',
    );
 $loop_imm = new WP_Query( $args_immunizations ); 
    if( $loop_imm->have_posts() ) {
        while( $loop_imm->have_posts() ): $loop_imm->the_post();
        $postId = get_the_ID();
        $post = get_post( $postId );
        $User_Id = $post->post_author;
        $the_user = get_userdata( $User_Id );
        $email = $the_user->user_email;
        $name = $the_user->user_login;

        $cert_type = get_field('immunizations_dropdown');                                                                                           
        $dt2 = get_field('flu_date_expire');
        $dt3 = get_field('covid_date_expire');
        $dt4 = get_field('tb_date_expire');
        if($cert_type == 'Flu'){
            $date2 = date("Y-m-d", strtotime($dt2));
        }else if($cert_type == 'COVID'){
            $date2 = date("Y-m-d", strtotime($dt3));
        }else if($cert_type == 'TB'){
            $date2 = date("Y-m-d", strtotime($dt4));
        }
        
        if($cert_type == 'Flu'){
           $mydate =  $dt2;
        }else if($cert_type == 'COVID'){
            $mydate =  $dt3;
        }else if($cert_type == 'TB'){
            $mydate =  $dt4;
        }
        $newDate = strtotime($date2);
        $diff = $newDate - $today;
        $totaldays = round($diff / (60 * 60 * 24));

        $sendmail = get_post_meta(  get_the_ID(), 'expiremailsend', true );
        $expiredmail = get_post_meta( $postId, 'expiredmail', true );

        if($totaldays == 30 && $sendmail == ''){

            if($cert_type == 'Flu'){                        
                    $to = $email;
                    $subject = 'EXIPRING Credentials';
            
                    $body = '<html><body style="background:#efefef;">';
                $body .= '<table cellspacing="0" cellpadding="20" style="font-size: 14px; font-family: sans-serif">';
                $body .= '<tbody>
                <tr><td style="font-size: 16px; font-weight: bold; color: #015084;">Hi '.$name.'</td></tr>
                <tr>
                <td style="font-size: 16px; font-weight: bold; color: #015084;">
                You have one or more piece of your credentialing file that will be expiring in 30 days. Please login into your HealthShield account and update the information so that you stay current.
                </td>
                    <tr>
                    <td style="font-size: 16px; font-weight: bold; color: #015084;">Thank you,<br>
                        HealthShield Credentialing<br>
                        T: <a href="tel:(864) 326-5399">(864) 326-5399</a> <br>
                        E: <a href="mailto:admin@healthshieldcredentialing.com">admin@healthshieldcredentialing.com</a> <br>
                        W: <a href="http://healthshieldcredentialing.com">http://healthshieldcredentialing.com/</a><br>
                            
                        </td>
                    </tr>
                </tr>
                </tbody>
                </table></body></html>'; 
            
                    $headers = array(); 
                    $headers[] = 'Content-Type: text/html; charset=UTF-8';
                    $emailsent = wp_mail($to, $subject, $body, $headers);
                    // return $emailsent;
            
                    if ( $emailsent ) {
                    update_post_meta(  get_the_ID(), 'expiremailsend', 'yes' );
                    }
            }else if($cert_type == 'COVID'){
                    $to = $email;
                    $subject = 'EXIPRING Credentials';
            
                    $body = '<html><body style="background:#efefef;">';
                $body .= '<table cellspacing="0" cellpadding="20" style="font-size: 14px; font-family: sans-serif">';
                $body .= '<tbody>
                <tr><td style="font-size: 16px; font-weight: bold; color: #015084;">Hi '.$name.'</td></tr>
                <tr>
                <td style="font-size: 16px; font-weight: bold; color: #015084;">
                You have one or more piece of your credentialing file that will be expiring in 30 days. Please login into your HealthShield account and update the information so that you stay current.
                </td>
                    <tr>
                    <td style="font-size: 16px; font-weight: bold; color: #015084;">Thank you,<br>
                        HealthShield Credentialing<br>
                        T: <a href="tel:(864) 326-5399">(864) 326-5399</a> <br>
                        E: <a href="mailto:admin@healthshieldcredentialing.com">admin@healthshieldcredentialing.com</a> <br>
                        W: <a href="http://healthshieldcredentialing.com">http://healthshieldcredentialing.com/</a><br>
                            
                        </td>
                    </tr>
                </tr>
                </tbody>
                </table></body></html>';
        
                $headers = array(); 
                $headers[] = 'Content-Type: text/html; charset=UTF-8';
                $emailsent = wp_mail($to, $subject, $body, $headers);
                // return $emailsent;
        
                if ( $emailsent ) {
                update_post_meta( get_the_ID(), 'expiremailsend', 'yes' );
                }
            }else if($cert_type == 'TB'){
                    $to = $email;
                    $subject = 'EXIPRING Credentials';
            
                    $body = '<html><body style="background:#efefef;">';
                $body .= '<table cellspacing="0" cellpadding="20" style="font-size: 14px; font-family: sans-serif">';
                $body .= '<tbody>
                <tr><td style="font-size: 16px; font-weight: bold; color: #015084;">Hi '.$name.'</td></tr>
                <tr>
                <td style="font-size: 16px; font-weight: bold; color: #015084;">
                You have one or more piece of your credentialing file that will be expiring in 30 days. Please login into your HealthShield account and update the information so that you stay current.
                </td>
                    <tr>
                    <td style="font-size: 16px; font-weight: bold; color: #015084;">Thank you,<br>
                        HealthShield Credentialing<br>
                        T: <a href="tel:(864) 326-5399">(864) 326-5399</a> <br>
                        E: <a href="mailto:admin@healthshieldcredentialing.com">admin@healthshieldcredentialing.com</a> <br>
                        W: <a href="http://healthshieldcredentialing.com">http://healthshieldcredentialing.com/</a><br>
                            
                        </td>
                    </tr>
                </tr>
                </tbody>
                </table></body></html>'; 
        
                $headers = array(); 
                $headers[] = 'Content-Type: text/html; charset=UTF-8';
                $emailsent = wp_mail($to, $subject, $body, $headers);
                // return $emailsent;
                if ( $emailsent ) {
                update_post_meta(  get_the_ID(), 'expiremailsend', 'yes' );
                }
            }else{}
        } else if($totaldays <= 0 && $expiredmail == ''){  //email on expire

            if($cert_type == 'Flu'){                        
                    $to = $email;
                    $subject = 'EXIPRED Credentials';
            
                    $body = '<html><body style="background:#efefef;">';
                $body .= '<table cellspacing="0" cellpadding="20" style="font-size: 14px; font-family: sans-serif">';
                $body .= '<tbody>
                <tr><td style="font-size: 16px; font-weight: bold; color: #015084;">Hi '.$name.'</td></tr>
                <tr>
                <td style="font-size: 16px; font-weight: bold; color: #015084;">
                You have one or more piece of your credential file that has expired. Please login into your HealthShield account and update the information so that you stay current.
                </td>
                    <tr>
                    <td style="font-size: 16px; font-weight: bold; color: #015084;">Thank you,<br>
                        HealthShield Credentialing<br>
                        T: <a href="tel:(864) 326-5399">(864) 326-5399</a> <br>
                        E: <a href="mailto:admin@healthshieldcredentialing.com">admin@healthshieldcredentialing.com</a> <br>
                        W: <a href="http://healthshieldcredentialing.com">http://healthshieldcredentialing.com/</a><br>
                            
                        </td>
                    </tr>
                </tr>
                </tbody>
                </table></body></html>'; 
            
                    $headers = array(); 
                    $headers[] = 'Content-Type: text/html; charset=UTF-8';
                    $emailsent = wp_mail($to, $subject, $body, $headers);
                    // return $emailsent;
            
                    if ( $emailsent ) {
                    update_post_meta(  get_the_ID(), 'expiredmail', 'yes' );
                    }
            }else if($cert_type == 'COVID'){
                    $to = $email;
                    $subject = 'EXIPRED Credentials';
            
                    $body = '<html><body style="background:#efefef;">';
                $body .= '<table cellspacing="0" cellpadding="20" style="font-size: 14px; font-family: sans-serif">';
                $body .= '<tbody>
                <tr><td style="font-size: 16px; font-weight: bold; color: #015084;">Hi '.$name.'</td></tr>
                <tr>
                <td style="font-size: 16px; font-weight: bold; color: #015084;">
                You have one or more piece of your credential file that has expired. Please login into your HealthShield account and update the information so that you stay current.
                </td>
                    <tr>
                    <td style="font-size: 16px; font-weight: bold; color: #015084;">Thank you,<br>
                        HealthShield Credentialing<br>
                        T: <a href="tel:(864) 326-5399">(864) 326-5399</a> <br>
                        E: <a href="mailto:admin@healthshieldcredentialing.com">admin@healthshieldcredentialing.com</a> <br>
                        W: <a href="http://healthshieldcredentialing.com">http://healthshieldcredentialing.com/</a><br>
                            
                        </td>
                    </tr>
                </tr>
                </tbody>
                </table></body></html>';
        
                $headers = array(); 
                $headers[] = 'Content-Type: text/html; charset=UTF-8';
                $emailsent = wp_mail($to, $subject, $body, $headers);
                // return $emailsent;
        
                if ( $emailsent ) {
                update_post_meta( get_the_ID(), 'expiredmail', 'yes' );
                }
            }else if($cert_type == 'TB'){
                    $to = $email;
                    $subject = 'EXIPIRED Credentials';
            
                    $body = '<html><body style="background:#efefef;">';
                $body .= '<table cellspacing="0" cellpadding="20" style="font-size: 14px; font-family: sans-serif">';
                $body .= '<tbody>
                <tr><td style="font-size: 16px; font-weight: bold; color: #015084;">Hi '.$name.'</td></tr>
                <tr>
                <td style="font-size: 16px; font-weight: bold; color: #015084;">
                You have one or more piece of your credential file that has expired. Please login into your HealthShield account and update the information so that you stay current.
                </td>
                    <tr>
                    <td style="font-size: 16px; font-weight: bold; color: #015084;">Thank you,<br>
                        HealthShield Credentialing<br>
                        T: <a href="tel:(864) 326-5399">(864) 326-5399</a> <br>
                        E: <a href="mailto:admin@healthshieldcredentialing.com">admin@healthshieldcredentialing.com</a> <br>
                        W: <a href="http://healthshieldcredentialing.com">http://healthshieldcredentialing.com/</a><br>
                            
                        </td>
                    </tr>
                </tr>
                </tbody>
                </table></body></html>'; 
        
                $headers = array(); 
                $headers[] = 'Content-Type: text/html; charset=UTF-8';
                $emailsent = wp_mail($to, $subject, $body, $headers);
                // return $emailsent;
                if ( $emailsent ) {
                update_post_meta(  get_the_ID(), 'expiredmail', 'yes' );
                }
            }else{}


        } else{
    
        }

    endwhile;
    }
 $args_licenses = array(  
        'post_type' => 'licenses',
        'post_status' => 'publish',
    );
$loop_lc = new WP_Query( $args_licenses ); 
    if( $loop_lc->have_posts() ) {
        while( $loop_lc->have_posts() ): $loop_lc->the_post();

        $postId = get_the_ID();
        $post = get_post( $postId );
        $User_Id = $post->post_author;
        $the_user = get_userdata( $User_Id );
        $email = $the_user->user_email;
        $name = $the_user->user_login;

        $cert_type = get_field('licenses_type');                                                                                            
        $dt2 = get_field('expire_date');
        $date2 = date("Y-m-d", strtotime($dt2));
        $newDate = strtotime($date2);
        $diff = $newDate - $today;
        $totaldays = round($diff / (60 * 60 * 24)); 
          
        $sendmail = get_post_meta( $postId, 'expiremailsend', true );
        $expiredmail = get_post_meta( $postId, 'expiredmail', true );
        if($totaldays == 30 && $sendmail == ''){
                                        
            $to = $email;
                $subject = 'EXIPRING Credentials';

                $body = '<html><body style="background:#efefef;">';
                $body .= '<table cellspacing="0" cellpadding="20" style="font-size: 14px; font-family: sans-serif">';
                $body .= '<tbody>
                <tr><td style="font-size: 16px; font-weight: bold; color: #015084;">Hi '.$name.'</td></tr>
                <tr>
                <td style="font-size: 16px; font-weight: bold; color: #015084;">
                You have one or more piece of your credentialing file that will be expiring in 30 days. Please login into your HealthShield account and update the information so that you stay current.
                </td>
                    <tr>
                    <td style="font-size: 16px; font-weight: bold; color: #015084;">Thank you,<br>
                        HealthShield Credentialing<br>
                        T: <a href="tel:(864) 326-5399">(864) 326-5399</a> <br>
                        E: <a href="mailto:admin@healthshieldcredentialing.com">admin@healthshieldcredentialing.com</a> <br>
                        W: <a href="http://healthshieldcredentialing.com">http://healthshieldcredentialing.com/</a><br>
                        </td>
                    </tr>
                </tr>
                </tbody>
                </table></body></html>';
    
            $headers = array(); 
            $headers[] = 'Content-Type: text/html; charset=UTF-8';
            $emailsent = wp_mail($to, $subject, $body, $headers);
            // return $emailsent;
    
            if ( $emailsent ) {
            update_post_meta(  $postId, 'expiremailsend', 'yes' );
            }
    
        } if($totaldays <= 0 && $expiredmail == ''){  //email on expire
            $to = $email;
                $subject = 'EXIPRED Credentials';

                $body = '<html><body style="background:#efefef;">';
                $body .= '<table cellspacing="0" cellpadding="20" style="font-size: 14px; font-family: sans-serif">';
                $body .= '<tbody>
                <tr><td style="font-size: 16px; font-weight: bold; color: #015084;">Hi '.$name.'</td></tr>
                <tr>
                <td style="font-size: 16px; font-weight: bold; color: #015084;">
                You have one or more piece of your credential file that has expired. Please login into your HealthShield account and update the information so that you stay current.
                </td>
                    <tr>
                    <td style="font-size: 16px; font-weight: bold; color: #015084;">Thank you,<br>
                        HealthShield Credentialing<br>
                        T: <a href="tel:(864) 326-5399">(864) 326-5399</a> <br>
                        E: <a href="mailto:admin@healthshieldcredentialing.com">admin@healthshieldcredentialing.com</a> <br>
                        W: <a href="http://healthshieldcredentialing.com">http://healthshieldcredentialing.com/</a><br>
                        </td>
                    </tr>
                </tr>
                </tbody>
                </table></body></html>';
    
            $headers = array(); 
            $headers[] = 'Content-Type: text/html; charset=UTF-8';
            $emailsent = wp_mail($to, $subject, $body, $headers);
            // return $emailsent;
    
            if ( $emailsent ) {
            update_post_meta(  $postId, 'expiredmail', 'yes' );
            }
        } else{
            
        }

    endwhile;
    }
}
// hook that function onto our scheduled event:
add_action ('mycronjob', 'my_repeat_function'); 


// user registration login form
function provider_registration_form() {
 
    // only show the registration form to non-logged-in members
    if(!is_user_logged_in()) {
 
        global $pippin_load_css;
 
        // set this to true so the CSS is loaded
        $pippin_load_css = true;
 
        // check to make sure user registration is enabled
        $registration_enabled = get_option('users_can_register');
 
        // only show the registration form if allowed
        if($registration_enabled) {
            $output = provider_registration_form_fields();
        } else {
            $output = __('User registration is not enabled');
        }
        return $output;
    }
}
add_shortcode('provider_register_form', 'provider_registration_form');

// registration form fields
function provider_registration_form_fields() {
    global $wp_roles;
       ob_start(); ?>  
        <h2 class="provider_header font-normal text-center">
            <?php _e('Healthcare professionals deserve a simple, effective tool to manage their careers.'); ?>
        </h2>
           <?php 
           // show any error messages after form submission
           pippin_show_error_messages(); ?>
    
           <form id="provider_registration_form" class="provider_form w-50 m-auto" action="" method="POST">
               <fieldset>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="firstname_id"><?php _e('First Name'); ?></label>
                                <input name="provider_user_fname" id="firstname_id" class="required" type="text"/> 
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="lastname_id"><?php _e('Last Name'); ?></label>
                                <input name="provider_user_lname" id="lastname_id" class="required" type="text"/> 
                            </div>
                        </div>
                    </div>
                   <div class="form-group">
                       <label for="provider_user_Login"><?php _e('Username'); ?></label>
                       <input name="provider_user_login" id="provider_user_login" class="required" type="text"/>
                   </div>
                   <div class="form-group">
                       <label for="provider_user_email"><?php _e('Email'); ?></label>
                       <input name="provider_user_email" id="provider_user_email" class="required" type="email"/>
                   </div>
                   <div class="form-group">
                       <label for="provider_user_agency"><?php _e('Agency Name'); ?></label>
                       <input name="provider_user_agency" id="provider_user_agency" class="required" type="text"/>
                   </div>
                   <div class="form-group">
                       <label for="phone_id"><?php _e('Phone number'); ?></label>
                       <input name="provider_user_phn" id="phone_id" class="required" type="number"/>         
                   </div>          
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="street_id"><?php _e('STREET/APT.'); ?></label>
                                <input name="provider_user_street" id="street_id" class="required" type="text"/> 
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="city_id"><?php _e('City'); ?></label>
                                <input name="provider_user_city" id="city_id" class="required" type="text"/> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="state_id"><?php _e('State'); ?></label>
                                <select id="state_id" name="provider_user_state" class="required">
									<option vlaue=""></option>
									<option value="Alabama">Alabama</option>
									<option value="Alaska">Alaska</option>
									<option value="Arizona">Arizona</option>
									<option value="American Samoa">American Samoa</option>
									<option value="Arkansas">Arkansas</option>
									<option value="California">California</option>
									<option value="Colorado">Colorado</option>
									<option value="Connecticut">Connecticut</option>
									<option value="Delaware">Delaware</option>
									<option value="District Of Columbia">District Of Columbia</option>
									<option value="Florida">Florida</option>
									<option value="Georgia">Georgia</option>
									<option value="Guam">Guam</option>
									<option value="Hawaii">Hawaii</option>
									<option value="Idaho">Idaho</option>
									<option value="Illinois">Illinois</option>
									<option value="Indiana">Indiana</option>
									<option value="Iowa">Iowa</option>
									<option value="Kansas">Kansas</option>
									<option value="Kentucky">Kentucky</option>
									<option value="Louisiana">Louisiana</option>
									<option value="Maine">Maine</option>
									<option value="Maryland">Maryland</option>
									<option value="Massachusetts">Massachusetts</option>
									<option value="Michigan">Michigan</option>
									<option value="Minnesota">Minnesota</option>
									<option value="Mississippi">Mississippi</option>
									<option value="Missouri">Missouri</option>
									<option value="Montana">Montana</option>
									<option value="Nebraska">Nebraska</option>
									<option value="Nevada">Nevada</option>
									<option value="New Hampshire">New Hampshire</option>
									<option value="New Jersey">New Jersey</option>
									<option value="New Mexico">New Mexico</option>
									<option value="New York">New York</option>
									<option value="North Carolina">North Carolina</option>
									<option value="North Dakota">North Dakota</option>
									<option value="Northern Mariana Islands">Northern Mariana Islands</option>
									<option value="Ohio">Ohio</option>
									<option value="Oklahoma">Oklahoma</option>
									<option value="Oregon">Oregon</option>
									<option value="Pennsylvania">Pennsylvania</option>
									<option value="Puerto Rico">Puerto Rico</option>
									<option value="Rhode Island">Rhode Island</option>
									<option value="South Carolina">South Carolina</option>
									<option value="South Dakota">South Dakota</option>
									<option value="Tennessee">Tennessee</option>
									<option value="Texas">Texas</option>
									<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
									<option value="Utah">Utah</option>
									<option value="Vermont">Vermont</option>
									<option value="Virgin Islands">Virgin Islands</option>
									<option value="Virginia">Virginia</option>
									<option value="Washington">Washington</option>
									<option value="West Virginia">West Virginia</option>
									<option value="Wisconsin">Wisconsin</option>
									<option value="Wyoming">Wyoming</option>
								</select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="zipcode_id"><?php _e('Zip code'); ?></label>
                                <input name="provider_user_zipcode" id="zipcode_id" class="required" type="number"/>    
                            </div>
                        </div>
                    </div> 
                   <div class="form-group">
                       <label for="ein_id"><?php _e('EIN'); ?></label>
                       <input name="provider_user_ein" id="ein_id" class="required" type="number"/>         
                   </div>    
                   <div class="form-group">
                       <label for="password_id"><?php _e('Password'); ?></label>
                       <input name="provider_user_pass" id="password_id" class="required" type="password"/>         
                   </div>     
                   <div class="form-group text-center">
                       <input type="hidden" name="provider_register_nonce" value="<?php echo wp_create_nonce('provider-register-nonce'); ?>"/>
                       <input type="submit" class="my-3" value="<?php _e('Create Your Account'); ?>"/>
                   </div>
                   
               </fieldset>
            <div class="col-12 mb-2 text-center">
                <a class="btn btn-link btn-block text-white" href="<?php echo get_permalink(1310); ?>">Already a user? Log In</a>
            </div>
           </form>
           
       <?php
       return ob_get_clean();
   }


// facility registration login form
function facility_registration_form() {
 
    // only show the registration form to non-logged-in members
    if(!is_user_logged_in()) {
 
        global $pippin_load_css;
 
        // set this to true so the CSS is loaded
        $pippin_load_css = true;
 
        // check to make sure user registration is enabled
        $registration_enabled = get_option('users_can_register');
 
        // only show the registration form if allowed
        if($registration_enabled) {
            $output = facility_registration_form_fields();
        } else {
            $output = __('User registration is not enabled');
        }
        return $output;
    }
}
add_shortcode('facility_register_form', 'facility_registration_form');


// registration form fields
function facility_registration_form_fields() {
    global $wp_roles;
       ob_start(); ?>  
        <h2 class="facility_header font-normal text-center">
            <?php _e('Healthcare professionals deserve a simple, effective tool to manage their careers.'); ?>
        </h2>
           <?php 
           // show any error messages after form submission
           pippin_show_error_messages(); ?>
    
           <form id="provider_registration_form" class="provider_form facility_form w-50 m-auto" action="" method="POST">
            <input type="hidden" name="agency" value="<?php echo $_GET['fpId'] ?>">
               <fieldset>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="firstname_id"><?php _e('First Name'); ?></label>
                                <input name="facility_user_fname" id="firstname_id" class="required" type="text"/> 
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="lastname_id"><?php _e('Last Name'); ?></label>
                                <input name="facility_user_lname" id="lastname_id" class="required" type="text"/> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                       <label for="facility_user_Login" class="required" ><?php _e('User Name'); ?></label>
                       <input name="facility_user_login" id="facility_user_login" class="required" type="text"/>
                   </div>
                   <div class="form-group">
                       <label for="facility_name" class="required"><?php _e('Facility Name'); ?></label>
                       <input name="facility_name" id="facility_name" class="required" type="text"/>
                   </div>
                   <div class="form-group">
                       <label for="facility_user_email" class="required"><?php _e('Email'); ?></label>
                       <input name="facility_user_email" id="facility_user_email" class="required" type="email"/>
                   </div>
                    <div class="form-group">
                       <label for="password_id" class="required"><?php _e('Password'); ?></label>
                       <input name="facility_user_pass" id="facility_password_id" class="required" type="password"/>         
                   </div>  
                   <div class="form-group">
                       <label for="phone_id" class="required"><?php _e('Phone number'); ?></label>
                       <input name="facility_user_phn" id="facility_phone_id" class="required" type="number"/>         
                   </div>  
                   <div class="form-group">
                        <label for="street_id"><?php _e('Address'); ?></label>
                        <input name="facility_user_address" id="street_id" class="required" type="text"/> 
                    </div>
                    <div class="form-group">
                        <div class="row">     
                    <div class="form-group">
                       <label for="site_contact"><?php _e('Site Contact'); ?></label>
                       <input name="facility_site_contact" id="facility_site_contact" class="required" type="text"/>         
                   </div>      
                   <div class="form-group text-center">
                       <input type="hidden" name="facility_register_nonce" value="<?php echo wp_create_nonce('facility-register-nonce'); ?>"/>
                       <input type="submit" class="my-3" value="<?php _e('Create Your Account'); ?>"/>
                   </div>                   
               </fieldset>
            <div class="col-12 mb-2 text-center">
                <a class="btn btn-link btn-block text-white" href="<?php echo get_permalink(1310); ?>">Already a user? Log In</a>
            </div>
           </form>
           
       <?php
       return ob_get_clean();
   }

   

/*****Register with Provider Role******/
function provider_add_new_member() {
    if (isset( $_POST["provider_user_login"] ) && wp_verify_nonce($_POST['provider_register_nonce'], 'provider-register-nonce')) {
        $user_login   = $_POST['provider_user_login'];      
        $user_email   = $_POST["provider_user_email"];
        $user_pass    = $_POST["provider_user_pass"];       
        $user_phn     = $_POST['provider_user_phn'];
        $user_street  = $_POST['provider_user_street'];
        $user_city    = $_POST['provider_user_city'];
        $user_state   = $_POST['provider_user_state'];
        $user_zipcode = $_POST['provider_user_zipcode'];
        $user_first   = $_POST['provider_user_fname'];
        $user_last   = $_POST['provider_user_lname'];
        $user_ein   = $_POST['provider_user_ein'];

        $provider_agency   = $_POST['provider_user_agency'];


        // this is required for username checks
        require_once(ABSPATH . WPINC . '/registration.php');
 
        if(username_exists($user_login)) {
            // Username already registered
            pippin_errors()->add('username_unavailable', __('Username already taken'));
        }
        if(!validate_username($user_login)) {
            // invalid username
            pippin_errors()->add('username_invalid', __('Invalid username'));
        }
        if(!is_email($user_email)) {
            //invalid email
            pippin_errors()->add('email_invalid', __('Invalid email'));
        }
        if(email_exists($user_email)) {
            //Email address already registered
            pippin_errors()->add('email_used', __('Email already registered'));
        }
        if($user_pass == '') {
            // passwords do not match
            pippin_errors()->add('password_empty', __('Please enter a password'));
        }
        if($user_phn == ''){
            // Phone number is balnk
            pippin_errors()->add('phone_empty', __('Please enter a Phone number'));
        }
        if($provider_agency == ''){
            // Phone number is balnk
            pippin_errors()->add('provider_agency', __('Please enter a Agency Name'));
        }
        if($user_street == ''){
            // address is balnk
            pippin_errors()->add('street_empty', __('Please enter a your Street and apartment'));
        }
        if($user_city == ''){
            // address is balnk
            pippin_errors()->add('city_empty', __('Please enter a your city'));
        }
        if($user_state == ''){
            // address is balnk
            pippin_errors()->add('state_empty', __('Please enter a your state'));
        }
        if($user_zipcode == ''){
            // address is balnk
            pippin_errors()->add('zipcode_empty', __('Please enter a your zip code'));
        }
 
        $errors = pippin_errors()->get_error_messages();
 
        // only create the user in if there are no errors
        if(empty($errors)) {
 
            $new_user_id = wp_insert_user(array(
                    'user_login'        => $user_login,
                    'user_pass'         => $user_pass,
                    'user_email'        => $user_email,
                    'first_name'        => $user_first,
                    'last_name'         => $user_last,
                    'user_registered'   => date('Y-m-d H:i:s'),
                    'role'              => 'Provider',
                    'meta_input' => array(
                        'phone_no'   => $user_phn,
                        'streetapt'  => $user_street,
                        'city'       => $user_city,
                        'state'      => $user_state,
                        'zip_code'   => $user_zipcode,
                        'einno'      =>  $user_ein,
                        'provider_agency'  =>  $provider_agency,
                    ),
                )
            );

                $creds = array(
                    'user_login'    => $user_login,
                    'user_password' => $user_pass,
                    'remember'      => true
                );
                $users = wp_signon( $creds, false );
                if ( is_wp_error( $users ) ) {
                    echo $errors;
                } else {
                        wp_new_user_notification($new_user_id);
        
                        // log the new user in
                        wp_setcookie($user_login, $user_pass, true);
                        wp_set_current_user($new_user_id, $user_login); 
                        // send the newly created user to the home page after logging them in


                        $loginuser_meta = get_userdata($new_user_id);
                        $loginuser_meta_roles = $loginuser_meta->roles;
                        // print_r($loginuser_meta_roles);
                        // die();

                        if($loginuser_meta_roles[0] == 'Provider') {
                            
                            $redirect = get_permalink(5752);
                                               
                        } elseif ($loginuser_meta_roles[0] == 'CRNA') {

                            global $wpdb;

                            /**Getting Associated Agency Info***/
                            $User_Id = $new_user_id;
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
                            /**If employee having agency then redirect to profile else to membership plan**/
                            if($havingAgency > 0)
                            {
                                $redirect = get_permalink(790);
                            }
                            else
                            {                            
                                $redirect = get_permalink(5726);
                            }
                                               
                        } else {
                            $redirect = get_permalink(790);
                        }

                        wp_redirect($redirect);
                        exit;

                } 
        }
 
    }
}
add_action('init', 'provider_add_new_member');



/**Register with Facility Role**/
function faciltiy_add_new_member() {
    if (isset( $_POST["facility_user_login"] ) && wp_verify_nonce($_POST['facility_register_nonce'], 'facility-register-nonce')) {
        $user_login   = $_POST['facility_user_login'];
        $facility_name   = $_POST['facility_name'];      
        $user_email   = $_POST["facility_user_email"];
        $user_pass    = $_POST["facility_user_pass"];       
        $user_phn     = $_POST['facility_user_phn'];
        $user_address  = $_POST['facility_user_address'];
        $user_first   = $_POST['facility_user_fname'];
        $user_last   = $_POST['facility_user_lname'];
        $user_site_contact = $_POST['facility_site_contact'];

        $agency = $_POST['agency'];

        // this is required for username checks
        require_once(ABSPATH . WPINC . '/registration.php');
 
        if(username_exists($user_login)) {
            // Username already registered
            pippin_errors()->add('username_unavailable', __('Username already taken'));
        }
        if(!validate_username($user_login)) {
            // invalid username
            pippin_errors()->add('username_invalid', __('Invalid username'));
        }
        if(!is_email($user_email)) {
            //invalid email
            pippin_errors()->add('email_invalid', __('Invalid email'));
        }
        if(email_exists($user_email)) {
            //Email address already registered
            pippin_errors()->add('email_used', __('Email already registered'));
        }
        if($user_pass == '') {
            // passwords do not match
            pippin_errors()->add('password_empty', __('Please enter a password'));
        }
        if($user_phn == ''){
            // Phone number is balnk
            pippin_errors()->add('phone_empty', __('Please enter a Phone number'));
        }


 
        $errors = pippin_errors()->get_error_messages();
        //echo $errors;
        //exit();
 
        // only create the user in if there are no errors
        if(empty($errors)) {
 
            $new_user_id = wp_insert_user(array(
                    'user_login'        => $user_login,
                    'user_pass'         => $user_pass,
                    'user_email'        => $user_email,
                    'first_name'        => $user_first,
                    'last_name'         => $user_last,
                    'user_registered'   => date('Y-m-d H:i:s'),
                    'role'              => 'facility',
                    'meta_input' => array(
                        'phone_no'   => $user_phn,
                        'streetapt'  => $user_address,
                        'site_contact' => $user_site_contact,
                        'facility_name' => $facility_name,
                    ),
                )
            );

                $creds = array(
                    'user_login'    => $user_login,
                    'user_password' => $user_pass,
                    'remember'      => true
                );
                $users = wp_signon( $creds, false );
                if ( is_wp_error( $users ) ) {
                    echo $errors;
                } else {


                       $savedFac = get_user_meta($agency, 'selected_facilities', true); 
                       if($savedFac)
                       {
                            $newSave = $savedFac.','.$new_user_id;
                            update_user_meta($agency, 'selected_facilities', $newSave);
                        }
                        else
                        {
                            update_user_meta($agency, 'selected_facilities', $new_user_id);
                        }


                        $key1 = 'facility_request_status_'.$agency;
                        add_user_meta($new_user_id, $key1, '1');

                        $revoke_key = 'facility_revoke_status_'.$agency;
                        update_user_meta($new_user_id, $revoke_key, 'yes');


                        wp_new_user_notification($new_user_id);
        
                        // log the new user in
                        wp_setcookie($user_login, $user_pass, true);
                        wp_set_current_user($new_user_id, $user_login); 
                        // send the newly created user to the home page after logging them in
                        wp_redirect(get_permalink(790)); exit;
                } 
 
        }
 
    }
}
add_action('init', 'faciltiy_add_new_member');


/* menu item for provider */
add_action( 'wp_head', 'show_hide_affiliate_menu_item', 500 );
function show_hide_affiliate_menu_item() {

    if( ! current_user_can( 'Provider' ) )
        echo '<style> .header_nav_main ul#menu-main-menu .member_plans { display: none !important } </style>'; 
}


add_action('template_redirect', 'redirect_user_role');
function redirect_user_role() {
    $user = wp_get_current_user();
    if( ! current_user_can( 'Provider' ) ) {
        if( is_page( 5512 ))   {
            wp_redirect('/');
            exit();
        }
    }
}

/************************/
add_action( 'wp_logout', 'auto_redirect_external_after_logout');
function auto_redirect_external_after_logout(){
  $url = get_site_url().'/signin/';  
  wp_redirect( $url );
  exit();
}


/****************/
/*function filter_function_name( $query_args, $sfid ) {

  global $user;  
  $user_id = get_current_user_id();  
  if($sfid==5914) {
    $query_args = array(
      'post_type' => 'case-logs',
      'author' => $user_id
    );
  }
  return $query_args;
}
add_filter( 'sf_edit_query_args', 'filter_function_name', 20, 2 );*/




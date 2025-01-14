<?php
/*
* Diaplays Dashbaord header
*/
$url = get_site_url();

?>
<header class="dashbaord-header">
 
    <nav class="navbar navbar-expand-lg navbar-dark py-1 px-3">
        <a class="navbar-brand" href="<?php echo get_site_url();?>">         
          <h1><img src="<?php echo get_site_url();?>/wp-content/uploads/2022/04/health-logo.png" width="155px" alt="" class="site-logo"></h1>
        </a>
      <div class="collapse navbar-collapse" id="header_nav">
        <ul class="navbar-nav navbar-nav-no-caret ms-auto">
          <li class="nav-item active dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="help_center_dropdown" role="button" data-bs-toggle="dropdown" >
              <i class="fad fa-question-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="<?php echo $url ?>/privacy-policy-2/" class="dropdown-item" target="_blank">
                <i class="fad fa-external-link fa-fw text-muted"></i> Privacy Policy
              </a>
              <a href="<?php echo $url ?>/terms-of-service/" class="dropdown-item" target="_blank">
                <i class="fad fa-external-link fa-fw text-muted"></i> Terms of Service
              </a>
              <div class="dropdown-divider"></div>
              <a class="live-chat-button dropdown-item" href="<?php echo $url ?>/contact-us/">
                <i class="fad fa-comments fa-fw text-muted"></i> Contact Us
              </a>
            </div>
          </li>
          <li class="nav-item active dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="user_menu_dropdown" role="button" data-bs-toggle="dropdown" >
              <i class="fad fa-id-badge fa-fw"></i>
              <span>
                <?php 
                $current_user = wp_get_current_user();
                echo $current_user->display_name;
                ?>

              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">

              <a class="dropdown-item" href="<?php echo $url ?>/my-account">
                <i class="fad fa-user fa-fw text-muted"></i>
                My Account
              </a>
              <div class="dropdown-divider"></div>
               <a class="dropdown-item" title="Logout" href="<?php echo wp_logout_url( home_url()); ?>">
                <i class="fa fa-sign-out fa-fw text-muted"></i>
                Sign Out
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
<?php if(!is_page('dashboard')){?>
  <nav class="breadcrumbs py-1 px-2" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <?php get_breadcrumb();?>

  </ol>
  </nav>
<?php } ?>
</header>
<?php
/*
* Template Name: Forget password
*/
get_header();
 ?>
  <div class="content loginform formbackimg">
    <div class="container py-5">
        <div class="row">
            <?php echo do_shortcode('[password_form]'); ?>
        </div>
    </div>
</div>

 <?php get_footer();?>
<?php
if(!is_user_logged_in()){
/*
* Template Name: Signup
*/
get_header();
 ?>
 <div class="content registerform formbackimg">
 <div class="overlay_bg_img"></div>
    <div class="container py-5">
        <div class="row">
            <?php echo do_shortcode('[register_form]'); ?>
        </div>
    </div>

</div>
 <?php get_footer();
}else{
    header('Location: ' . get_permalink(753));
}
?>
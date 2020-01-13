<?php 
$CI = &get_instance();
$CI->load->model('Dashboard_data');
$theme_color = $CI->Dashboard_data->gen_settings_data('theme_color')[0]['value'];
$button_color = $CI->Dashboard_data->gen_settings_data('button_color')[0]['value'];
?>
<style>
    .btn-theme {
        color: #fff;
        background: <?php echo ($button_color ? $button_color . " !important" : "#176fc1") ?>;
        border: <?php echo ($button_color ? $button_color . " !important" : "#176fc1") ?>;
    }
 
</style>
<div class="row justify-content-md-center h-100">
    <div class="col-sm-6">
        <h1 class='theme_color'><?php echo $detail; ?></h1>
        <?php if ($result  == 1) : ?>
        <a title="Log In" class="btn btn-theme" href="<?php echo base_url(); ?>/Login/log_out">Login with new password</a>
        <?php else: ?>
        <a title="Try again" class="btn btn-theme" href="<?php echo base_url(); ?>/login/change_password_page">Please Try again</a>
        <?php endif; ?>
       
    </div>
</div> 
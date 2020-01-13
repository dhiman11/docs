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

    .form-control {
        border: 1px solid <?php echo ($theme_color ? $theme_color . " !important" : "#176fc1") ?>;

    }
</style>
<div class="row justify-content-md-center h-100">
<h1 class="h2 theme_color">Change Password</h1>
    <div class="col-sm-4">

        <form action="<?php echo base_url('login/change_password') ?>" method="POST" role="form">
          

            <div class="form-group">
                <label for="">Old Password</label>
                <input type="text" name="old_pass" class="form-control" id="" placeholder="Old Password">
            </div>

            <div class="form-group">
                <label for="">New Password</label>
                <input type="password" name="new_pass" class="form-control" id="" placeholder="New Password">
            </div>



            <button type="submit" class="btn btn-theme">Change</button>
        </form>

    </div>
</div> 
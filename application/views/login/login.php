<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>



<div class="row justify-content-md-center h-100" style="justify-content: center;">
    <div class="card-wrapper">
        <div class="brand">
            <center><img style="width: 150px;margin-bottom: 10px;" src="<?php echo base_url('assets/images/mgs-logo.png'); ?>"></center>
        </div>
        <div class="card fat">
            <div class="card-body">
                <h4 class="card-title">Login</h4>
                <p style="color: #166fc1;border-bottom: 1px solid #166fc1;"> <?php echo $login_detail; ?></p>
                <?php
				$attributes = array('class' => 'login_form');
				echo form_open('login/login_process', $attributes);	?>


                <div class="form-group">
                    <label for="email">Username</label>

                    <input class="form-control" type="text" name="username" value='<?php echo get_cookie('username'); ?>' />
                </div>

                <div class="form-group">
                    <label for="password">Password
                        <!--a href="forgot.html" class="float-right">
											Forgot Password?
										</a-->
                    </label>
                    <div style="position:relative">
                        <input class="form-control password" type="password" name="password" value='<?php echo get_cookie('password'); ?>' />


                        <div class="btn btn-primary btn-sm" id="passeye-toggle-0" style="position:absolute;right:10px;top:50%;transform:translate(0,-50%);-webkit-transform:translate(0,-50%);-o-transform:translate(0,-50%);padding: 2px 7px;font-size:12px;cursor:pointer;">Show</div>
                    </div>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>

                <div class="form-group no-margin">
                    <button type="submit" class="btn btn-danger btn-block">
                        Login
                    </button>
                </div>
                <div class="margin-top20 text-center">
                    Don't have an account? <a href="<?php echo base_url('register'); ?>">Create One</a>
                </div>
                </form>
            </div>
        </div>
        <div class="footer">
            Copyright © 2019 — Marjane
        </div>
    </div>
</div>

<script>
    $('#passeye-toggle-0').click(function() {
        password_type = $(".password").attr("type");

        if (password_type == 'password') {
            $('.password').attr('type', 'text');
        } else {
            $('.password').attr('type', 'password');
        }


    });
</script>
<style>
    @media screen and (min-width: 600px) {
        .card-wrapper {
            width: 400px;
        }
    }
</style> 
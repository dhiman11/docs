<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
 
 <?php 

 
 $username = '';
 $email = '';
 
if (!empty($value))
{
 
	
	$username  = $value[0]['username'];
	$email  = $value[0]['email'];
  

  
}


?>
 
<div class="row justify-content-md-center h-100" style="justify-content: center;">
				<div class="card-wrapper">
					<div class="brand">
						<center><img style="width: 230px;" src="https://jquerylearn.com/assets/images/logo.png"></center>
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Register</h4>
							 <p style="color: #e64613;border-bottom: 1px solid #e64613;" ><?php echo $str; ?></p>
								<?php
								$attributes = array('class' => 'register_form');
								echo form_open('register/register_process', $attributes);	?>
													 
								<div class="form-group">
									<label for="email">E-Mail Address</label> 
									<input required class="form-control" type="text" name="email" value ='<?php echo $email; ?>'   />
								</div>
								
								
								<div class="form-group">
									<label for="email">Username</label> 
									<input required class="form-control" type="text" name="username" value ='<?php echo $username; ?>'    />
								</div>
								

								<div class="form-group">
									<label for="password">Password 
									</label>
									<div style="position:relative">
									<input required  class="form-control password"  type="password" name="password" value = '' />
									
								 
									<div class="btn btn-primary btn-sm" id="passeye-toggle-0" style="position:absolute;right:10px;top:50%;transform:translate(0,-50%);-webkit-transform:translate(0,-50%);-o-transform:translate(0,-50%);padding: 2px 7px;font-size:12px;cursor:pointer;">Show</div></div>
								</div>
 
								<div class="form-group no-margin">
									<button type="submit" class="btn btn-danger btn-block">
										Register
									</button>
								</div>
								<div class="margin-top20 text-center">
									If already a user ? <a href="<?php echo base_url('login'); ?>">Login</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright © 2017 — jQuerylearn.com
					</div>
				</div>
			</div>

			<script>
			 
				$('#passeye-toggle-0').click(function()
				{ 
				  	 password_type =  $(".password").attr("type");  
					  
					 if (password_type == 'password')
					 {
						$('.password').attr('type','text');
					 }
					 else
					 {
						 $('.password').attr('type','password');
					 }
					 
					 
				});
			 
			</script>
			
			<style>
			@media screen and (min-width: 600px) 
			{
				.card-wrapper 
				{
					width: 400px;
				}
			}
			</style>
 
 
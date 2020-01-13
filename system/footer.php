<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
 
 
 
 
 <footer>

<div class='bg-danger'>

	<div class="container">
	<div class="row">
		<div class="col-lg-3">
			<div class='footer_data'>
				<h4>Contact Us</h4>  
				<p>Please Contact us for more detail.And if you have any guest post for us please contact us . We are free to help every beginner who is facing problems . </p>
				<b>Name :</b> Akshay Dhiman<br>
				<b>Email 1 :</b> info@jquerylearn.com <br>
				<b>Email 2 :</b> jquerylearnhere.com <br>
				<b>Whatsapp :</b>+86-186 16384857<br>
				<b>Skype :</b> mr.akshaydhiman<br><br>
			</div>
		</div>

		<div class="col-lg-3">
			<div class='footer_data'>
				<h4>Pages</h4>  
				<ul class="list-unstyled">
					<li><a href='<?php base_url(); ?>'>Home Page</a></li>
					<li><a href='<?php base_url(); ?>/p/privacy'>Privacy</a></li>					
					<li><a href='<?php base_url(); ?>/p/about_us'>About Us</a></li>
					<li><a href='<?php base_url(); ?>/p/Contact_us'>Contact Us</a></li>
				 
				</ul>
			</div>
		</div>

		<div class="col-lg-3">

		</div>

		<div class="col-lg-3">

		</div>

		</div>	
	</div>	
</div>


	<div class='container-fluid bg-dark lower_footer'> 
		<a title="home page">© Copyright 2018 www.jQuerylearn.com. All rights reserved. Developed by jQueryLearn.com</a>
  </div>
  


 </footer>
 
 
 	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
 
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
	<script>
	
	$('textarea.execute').prepend('<FORM ACTION = "#" method="post"><input class="btn btn-danger" type ="submit" >');
	$('textarea.execute').after('</form>');
	
	</script>
	
	<script>
	$('form').on('submit',function(){ 
	data1 = unescape($(this).next('textarea').text());
			 
			$.ajax({
			type: "POST",
			url: "<?php echo base_url('lab/index');?>",
			data: {"data":data1},
			success: function(data) 
			{
				alert('saved');
			} 
			}); 
			
	}); 
	 
	</script>
	
 </body>
 
</html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
if ($this->session->userdata('status') == '1')
{
  redirect(base_url());		
}

?> 
 
 
 
 <div class="container">
 <center>
 <h1>Please verify your email</h1>
 <p>We have sent you an email to confirm the your email.Please check your inbox and confirm the account.If you have not recieved the email .
 Please <a style="color: red;text-decoration: underline;" href='<?php echo base_url('resend_email/').($this->session->userdata('status') == 1 ? '1' : '2').'' ?>'>resend</a> the confirmation email .</p>
 
 </center>
 
 
 </div>
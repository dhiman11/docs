<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header("X-XSS-Protection: 0");

?><!DOCTYPE html>
 <head>
 <meta charset="UTF-8">
 </head>
<div class='container '>

    <div class='row'>
	<div class='col-lg-12'>
	<p>Our HTML editor allow you to edit and code and experience the output . Learning coding by the help of our code editor . </p>
	</div>
	<div class='col-lg-6'>
		<h3 style="background: red;color: #fff;padding: 5px;margin: 0;margin-bottom: 10px;">CODE</h3>
	</div>
	<div class='col-lg-6'>
	
	<h3 style="background: red;color: #fff;padding: 5px;margin: 0;margin-bottom: 10px;">OUTPUT</h3>
	</div>
        <div class='col-lg-6' >
	
			<a  href='#'class='btn-danger btn tryit' onclick="runCode();" style="background: red;color: #fff;padding: 2px 24px;text-transform: capitalize;float: none;display: block;text-decoration: none;margin-bottom: 0px;font-size: 18px;border: 1px solid black;width: 106px;">Try this code</a>
			<textarea id = 'sourceCode' name='data' class='code' >
			 <?php echo $data; ?>
			</textarea>
			
	   </div>
	   
	    <div class='col-lg-6' >
		<div class='result'  >
          <iframe name="targetCode"  id="targetCode"> </iframe>
        </div>
	   </div>
	  <!-- ADS HERE-----> 
	      <div class='col-lg-6' >
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- Bottom_banner -->
				<ins class="adsbygoogle"
				style="display:block"
				data-ad-client="ca-pub-6956165890644293"
				data-ad-slot="7567862395"
				data-ad-format="auto"
				data-full-width-responsive="true"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
				
		  </div>
		  
		  <div class='col-lg-6' >
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- Bottom_banner -->
				<ins class="adsbygoogle"
				style="display:block"
				data-ad-client="ca-pub-6956165890644293"
				data-ad-slot="7567862395"
				data-ad-format="auto"
				data-full-width-responsive="true"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
				
		  </div>
			 
	   
    </div>
</div>

<style>
.col-lg-6 {
    display: inline-block;
    width: 49%;
    vertical-align: top;
}
.CodeMirror {
    border: 1px solid red;
    height: 100% !important;
    min-height: 600px;
}
.CodeMirror-scroll {
    min-height: 600px;
}
.result {
    padding: 5px;
    margin-top: 21.6px;
    min-height: 100%;
    height: 100%;
	min-height: 600px; 
}
iframe#targetCode {
    border: 1px solid #ff0000;
    min-height: 600px;
    width: 100%;
}

</style>


 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@5.39.2/lib/codemirror.css">
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.39.2/lib/codemirror.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.39.2/mode/xml/xml.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.39.2/mode/clike/clike.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.39.2/mode/php/php.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
 
<script> 
  	var js_editor = document.getElementsByClassName("code");
	Array.prototype.forEach.call(js_editor, function(el) {
		var editor = CodeMirror.fromTextArea(el, 
		{
			mode: "application/x-httpd-php",
			matchBrackets: true, 
			indentUnit: 3,
			lineNumbers: true, 
			indentWithTabs: true
		});
		// Update textarea
		function updateTextArea() 
		{
			editor.save();
		}
		editor.on('change', updateTextArea);
	}); 
	 
</script>

<script>
function runCode() {
var content = document.getElementById('sourceCode').value;
var iframe = document.getElementById('targetCode');
iframe = (iframe.contentWindow)?iframe.contentWindow:(iframe.contentDocument)? iframe.contentDocument.document: 
iframe.contentDocument;
 
iframe.document.open();
iframe.document.write(content);
iframe.document.close();
return false;
}
runCode();
</script>
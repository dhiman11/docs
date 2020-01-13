<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI =& get_instance();
$CI->load->model('Dashboard_data'); 
$theme_color = $CI->Dashboard_data->gen_settings_data('theme_color')[0]['value']; 
$footer_text_one = $CI->Dashboard_data->gen_settings_data('footer_text_1')[0]['value']; 
?>
<!DOCTYPE html>

<!---------EXAMPLE ------------>
<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="
    min-width: 97% !important;
">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Execution</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class='col-sm-6'>
                        <h3>CODE</h3>
                        <form>
                            <textarea readonly='readonly' style="width: 100%; height: 500px; min-height: 100%; margin-top: 0px; margin-bottom: 0px;" class='code code_popup'></textarea>
                        </form>
                    </div>
                    <div class='col-sm-6'>
                        <h3>OUTPUT</h3>
                        <div class='result'>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!---------EXAMPLE ------------>


<footer>

    <div class='bg-danger theme_color_footer '>
        <span style="padding-left: 10px;"><b>Recent news:</b></span>
    <marquee direction="right"  width="100%"   class="marquee1"> </marquee>
    <marquee direction="left"  width="100%"   class="marquee2"> </marquee>
    </div>


    <div class='container-fluid bg-dark lower_footer'>
        <a title="home page"><?php echo $footer_text_one; ?></a>
    </div>
  
</footer>
<style>
            .theme_color_footer {
                background-color: <?php echo ($theme_color ? $theme_color . " !important" : "#176fc1") ?>;
            }
</style>


<script>
    function change_theme(that) {
      
        var themeval = $(that).val();
		localStorage.setItem('theme', themeval); 
		window.location='';
	}

	$(function(){
		var theme  = localStorage.getItem('theme');
		if(theme ==1){
			$('body').css('background-color','rgb(101, 101, 101)'); 
			$('.jqheader').css('background-color','#2d2d2d '); 
			$('h1').css('color','#rgb(60, 60, 60)'); 
			$('h2').css('color','#rgb(60, 60, 60)'); 
			$('.search').css('border-left','5px solid #2d2d2d'); 
			$('.h1').css('border-left','5px solid #2d2d2d'); 
			$('.h2').css('border-left','5px solid #2d2d2d'); 
			$('.home_titles').css('background-color','rgb(45, 45, 45)'); 
			$('.home_titles').css('border-left','5px solid #2d2d2d'); 
			$('.home_titles').css('color','#d4d4d4'); 
			$('.content_detail').css('background','#d4d4d4'); 
			$('.left_post_menu ul').css('background','#d4d4d4'); 
			$('.search_topics').css('background','#d4d4d4'); 
			$('.search_results').css('background','#d4d4d4'); 
			$('.left_post_menu a').css('color','#000000'); 
			$('.search_results a').css('color','#000000'); 
			$('.tutorial').css('border-color','#2d2d2d'); 
			$('.tutorial p').css('background','#2d2d2d'); 
			$('.tutorial p').css('color','#d4d4d4'); 
			$('li.posts.active').css('border-color','rgb(45, 45, 45)'); 
			$('.content_detail h1').css('color','rgb(60, 60, 60)'); 
			$('.content_detail h1').css('border-color','#2d2d2d'); 
			$('a.btn.btn-danger,input.submit_form').css('background','#2d2d2d'); 
			$('a.btn.btn-danger,input.submit_form').css('border','#2d2d2d'); 
		 
		} 

		$("select.select_theme option[value='"+theme+"']").attr('selected','selected');
	})
	

    $('.content_data form').attr('target', '_BLANK');
    $('.content_data form').attr('method', 'post');
    $('.content_data form').attr('action', '../lab');
    $('.content_data form textarea.code').attr('name', 'data');


////Load recent news of the webpage
$(function(){

    $.ajax({ 
    type : 'POST',
    url : '<?php echo base_url(); ?>tutorial/recent_topics',
    dataType : "json",
    error : function() {
        alert('smx失败 ');
    },
    success : function(data) {
    
        var i = 1;
        $.each(data,function(key,value){
            $('.marquee1').append('<a style="color: #ffffff8a;" href="<?php echo base_url(); ?>tutorial/'+value['lesson_cat_id']+'/'+value['id']+'">  <b>'+value['updated_by']+'</b> worked on <b>'+value['lesson_name']+'</b>['+value['post_title']+']  '+timeSince(value['last_updated'])+'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;')
            $('.marquee2').append('<a style="color: #ffffff8a;" href="<?php echo base_url(); ?>tutorial/'+value['lesson_cat_id']+'/'+value['id']+'">  <b>'+value['updated_by']+'</b> worked on <b>'+value['lesson_name']+'</b>['+value['post_title']+']  '+timeSince(value['last_updated'])+'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;')
        });
    }

});
 
});


///////////STOP MARQUEE ON MOUSE HOVER
$("marquee").hover(function () { 
    this.stop();
}, function () {
    this.start();
});

//////////////////////
///// Time ago ///////
function timeSince(timeStamp) {
	var timeStamp = new Date(timeStamp);
	var now = new Date(),

		secondsPast = (now.getTime() - timeStamp.getTime()) / 1000;
	if (secondsPast < 60) {
		return parseInt(secondsPast) + ' <b>sec ago</b>';
	}
	if (secondsPast < 3600) {
		return parseInt(secondsPast / 60) + ' <b>min ago</b>';
	}
	if (secondsPast <= 86400) {
		return parseInt(secondsPast / 3600) + '<b> hours ago</b>';
	}
	if (secondsPast > 86400) {

		day = timeStamp.getDate();
		month = timeStamp.toDateString().match(/ [a-zA-Z]*/)[0].replace(" ", "");
		year = timeStamp.getFullYear() == now.getFullYear() ? "" : " " + timeStamp.getFullYear();
		return day + " " + month + year;
	}
}




</script>


</body>

</html> 
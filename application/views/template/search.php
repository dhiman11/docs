<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI =& get_instance();
$CI->load->model('Dashboard_data'); 
$theme_color = $CI->Dashboard_data->gen_settings_data('theme_color')[0]['value']; 

?>
<div class="container-fluid padding-top10 padding-bottom10">
    <div class="search">
        <input autofocus style="" type="text" class="search_topics form-control" placeholder="Search Topics" aria-label="Recipient's username" aria-describedby="basic-addon2">
        <img class="search_icon" src="<?php echo base_url('assets/images/loupe.png'); ?>" width="224" height="224" alt="Search free icon" title="Search free icon">
    </div>
    <span style="font-style: italic;color: #a7a7a7;"><b>eg:</b> session</span>
    <div class="search_results row" style="display: none;">
    </div>
</div>

<style>
    .search {
        border-left: 5px solid <?php echo ($theme_color?$theme_color:"#176fc1") ?>;
    }

    .search_results a {
        color: <?php echo ($theme_color ? $theme_color : "#176fc1") ?>;
        text-decoration: underline;
        font-size: 14px;
    }

    .search_topics {
        padding-left: 67px;
        <?php if ($page == 'tutorial') : ?> font-size: 18px;
        width: 14%;
        <?php endif;
    ?>color: #3c3c3c;
        text-transform: uppercase;
        height: 45px;
        border-radius: 0;
        border: 1px solid #efefef;
        background: rgba(224, 224, 224, 0.29);
    }

    .search_results {
        margin-left: 0px;
        margin-right: 0px;
        background: #f9f9f9;
        border: 1px solid #48484840;
    }

    .search_icon {
        width: 36px;
        position: absolute;
        z-index: 999;
        height: 36px;
        opacity: 0.6;
        margin: -40px 11px;
    }

    ::placeholder {
        /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: #aaaaaa;
        opacity: 1;
        /* Firefox */
    }

    :-ms-input-placeholder {
        /* Internet Explorer 10-11 */
        color: #aaaaaa;
    }

    ::-ms-input-placeholder {
        /* Microsoft Edge */
        color: #aaaaaa;

    }
</style>

<script>
    $('.search_topics').on('keyup', function() {

        // POST to server using $.post or $.ajax
        if ($('.search_topics').val().length > 0) {

            $('.search_results').show();
            var search_topis = $('.search_topics').val();
            $.ajax({
                data: {
                    'searching_for': search_topis
                },
                type: "POST",
                contentType: "application/x-www-form-urlencoded",
                dataType: "json",
                url: '<?php echo base_url('tutorial/search_something') ?>',
                success: function(data) {
                    //  console.log(data);
                    $('.search_results').html('');
                    $.each(data, function(key, value) {

                        $('.search_results').append('<div class="col-sm-4 category_div category_' + key + '"><h4>' + value['lesson'] + '</h4></div>');

                        var sc = 1;
                        console.log(value);
                        $.each(value, function(key1, value1) {
                            if (key1 != "lesson") {
                                $('.category_' + key).append('<div class=" subcat_div subcat_' + sc + '"><b>' + key1 + '</b></div><br>');
                                $.each(value1['post_title'], function(key2, value2) {
                                    $('.subcat_' + sc).append("<p><a href='<?php echo base_url('tutorial/'); ?>" + key + "/" + key2 + "'>" + value2 + "</a></p>")
                                });
                            }
                            sc++;
                        });

                    });

                },
            });
        } else {
            $('.search_results').hide();
        }
    });




    <?php if ($page  == 'tutorial') : ?>
    $('.search_topics').on('keyup', function() {
        if ($(this).val().length > 0) { 
            $(this).animate({
                width: '100%'
            }, 500, function() {
                // Animation complete.
            });

            $('.content_detail').removeAttr('style');
        } else {
            
            $(this).animate({
                width: '14%'
            }, 100, function() {
                $('.content_detail').css('margin-top', '-90px');
            });

        }

    })
    <?php endif; ?>
</script> 
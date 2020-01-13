<?php 
$CI = &get_instance();
$CI->load->model('Dashboard_data');
$theme_color = $CI->Dashboard_data->gen_settings_data('theme_color')[0]['value'];
$button_color = $CI->Dashboard_data->gen_settings_data('button_color')[0]['value'];
?>
<style>
    .container .inner_div {
        background: #ffffffa6;
        min-height: 51px;
        height: auto;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .form-control {
        border: 1px solid <?php echo ($theme_color ? $theme_color . " !important" : "#176fc1") ?>;
    }

    .inner_div lable {
    font-size: 14px;
    padding-top: 13px;
    display: block;
    font-weight: bold;
    padding-left: 10px;
}

    .inner_div input.form-control {
        height: 45px;
        min-height: 45px;
    }

    img.tempo_logo {
    max-width: 100px;
    max-height: 100px;
    height: auto;
    border: 2px solid #fff;
    width: auto;
}

    .btn-theme {
        color: #fff;
        background: <?php echo ($button_color ? $button_color . " !important" : "#176fc1") ?>;
        border: <?php echo ($button_color ? $button_color . " !important" : "#176fc1") ?>;
    }
</style>   
<div class="container">

    <div class="row">
    <h1 class="h2 theme_color">General settings</h1>
    <div class="col-sm-12"></div>
        <?php 
        foreach ($general_list as $value) {

            echo "<form class='text_form col-sm-6'>";
            echo "<div class=''  >";
            echo "<div class='row' style='border: 1px solid ".$theme_color."; background: #fff" . ";padding: 10px;    margin-bottom: 10px;
        margin-right: 10px;'>";


            echo "<div class='col-sm-5'> 
                                    <div class='inner_div'>
                                        <lable>" . $value->name . "</lable>
                                        </div>
                                    </div>";

            echo "  <div class='col-sm-7'>
                                <div class='inner_div'>
                                
                                    <input type='hidden' name='id' value='" . $value->id . "'>";
            switch ($value->type) {
                case 'color':
                    echo "<input   class=' types_of_file'  style='width: 100%;height: 60px;' type='" . $value->type . "'   value='" . $value->value . "' name='value'>
               
                ";
                    break;

                case 'textarea':
                    echo "<textarea   class=' types_of_file'  style='width: 100%;height: 45px;' type='" . $value->type . "'    name='value'>" . $value->value . "</textarea>
               
                ";
                    break;

                case 'file':
                    echo "<input required  class=' types_of_file'  type='" . $value->type . "'   value='" . $value->value . "' name='value'>
                <img  class='tempo_logo' src='" . $value->value . "'>
                <span style='
                    position: absolute;
                    width: 100%;
                    font-size: 13px;
                    color: red;
                    left: 15px;
                    bottom: -10px;'>
                        Try Logo with 100 x 100 dimension
                </span>
                ";
                    break;
                default:
                    echo "<input   type='" . $value->type . "' class='form-control types_of_file' value='" . $value->value . "' name='value'>";
                    break;
            }

            echo "        </div>
                            </div>";

            echo "  <div class='col-sm-3'>
                                
                                     <input class=' btn btn-theme submit_form_text' type ='button' value='Update'>";

            echo " </div>";

            echo " </div>";
            echo " </div>";
            echo " </form>";
        }
        ?>

    </div>
</div>

<script>
    $('.submit_form_text').on('click', function() {
        //    var form  = $(this).closest('form')[0];

        var formData = new FormData();
        var form_fields = $(this).closest('form').serializeArray();
        $.each(form_fields, function(key, input) {
            formData.append(input.name, input.value);
        });
        //---   ---------------------------------------------------

        var types_of_file = $(this).closest('form').find('.types_of_file').attr('type');
        if (types_of_file == 'file') {
            //  ------------------------------------------------------
            var image = $(this).closest('form').find('input[type="file"]')[0].files[0];
            formData.append('image', image);
            //------------------------------------------------------
        }

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('settings/general_setting/process_general_settings'); ?>",
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.result) {
                    location.href = '';
                } else {
                    alert("Something Wrong");
                }
            }
        });


    });
</script> 
<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->load->model('Dashboard_data');
$theme_color = $CI->Dashboard_data->gen_settings_data('theme_color')[0]['value'];
$homepage_header_one = $CI->Dashboard_data->gen_settings_data('homepage_header_1')[0]['value'];
$homepage_heading_two = $CI->Dashboard_data->gen_settings_data('homepage_header_2')[0]['value'];
$homepage_description = $CI->Dashboard_data->gen_settings_data('homepage_description')[0]['value'];
?>
<!DOCTYPE html>

<div class='container-fluid'>

    <div class='row'>
        <div class='col-lg-9'>
            <h1 class="h2 theme_color"><?php echo $homepage_header_one; ?></h1>
            <div class="home_titles" style=" margin-bottom: 10PX;display:inherit;padding:20px;background-color: rgba(230, 70, 19, 0.26);border-left: 5px solid <?php echo ($theme_color ? $theme_color : "##166fc1") ?>;">
                <?php echo $homepage_description; ?>
                <b>
                    <a href='<?php echo base_url() ?>'>
                    </a>
                </b>
            </div>

            <h1 class="h2"><?php echo $homepage_heading_two; ?></h2>

                <?php

                echo '<div class="row">';

                foreach ($menu as $value) {

                    $permissions  =  json_decode($value->permissions, true);


                    echo "<div class='col-lg-2 col-6'>";
                    if (isset($_SESSION['role_name'])) {
                        if (isset($permissions[$_SESSION['role_name']]) || $_SESSION['role_name'] == 'admin') {
                            if (in_array('update', $permissions[$_SESSION['role_name']]) || $_SESSION['role_name'] == 'admin') {
                                echo "<span class='edit_cat' onclick='edit_category(this," . $value->id . ",\"" . $value->lesson_name . "\")'> <img style='width: 18px;' src='" . base_url() . "/assets/images/edit.png'> </span>";
                            }
                        }
                    }
                    echo '
                        <a title="' . $value->lesson_name . '" class="" href="' . base_url('tutorial/' . $value->id . '/0') . '">';




                    echo '<div class="tutorial">  
                                    <img class="cat_images" alt="' . $value->lesson_name . '"   src="' . ImageExist($value->id, $value->remarks) . '"> 
                            </div>
                            <div class="_cat_headings"><p align="center">' . (strlen($value->lesson_name) > 15 ? substr($value->lesson_name, 0, 15) . "..." : $value->lesson_name) . '</p></div>
                        </a>';
                    echo "</div>";
                }


                ///////////////////If image Exist ////////////' . base_url('./uploads/') . $value->remarks . '
                function ImageExist($cat_id, $remarks)
                {
                    $file1 = FCPATH . "assets/category_images/" . $cat_id . ".jpg";
                    $file2 = FCPATH . "assets/category_images/" . $cat_id . ".png";
                   
                    if (file_exists($file1)) {
                        return base_url('assets/category_images/') . $cat_id . ".jpg?" . rand(10, 8129912397129);
                    }
                    elseif(file_exists($file2)) {
                        return base_url('assets/category_images/') . $cat_id . ".png?" . rand(10, 8129912397129);
                    } 
                    else {
                        return base_url('./uploads/') . $remarks;
                    }
                    
                }

                ?>
        </div>

    </div>

    <div class="col-lg-3">
        <div class="other_information" style="background: #f9cfc4;padding: 10px;height: 100%;">
        </div>
    </div>


</div>
</div>

<style>
    .tutorial p {
        background: <?php echo ($theme_color ? $theme_color : "#176fc1") ?>;
        color: #fff;
        font-size: 14px;
        position: absolute;
        width: calc(100% - 35px);
        bottom: 25px;
    }

    .tutorial {
        padding: 0px 0px 0px 0px;
        border-left: 5px solid <?php echo ($theme_color ? $theme_color : "#176fc1") ?>;
        border-right: 5px solid <?php echo ($theme_color ? $theme_color : "#176fc1") ?>;
        border-top: 5px solid <?php echo ($theme_color ? $theme_color : "#176fc1") ?>;
        margin-bottom: 0px;
        min-height: 150px;
        position: relative;
        max-height: 150px;
        background: #fff;
        display: block;
      
    }

    ._cat_headings {
    color: #fff;
    background: <?php echo ($theme_color ? $theme_color : "#176fc1") ?>;
    margin-bottom: 20px;
}

    span.edit_cat {
        position: absolute;
        color: #fff200;
        padding: 5px 7px;
        z-index: 99;
        background: #ffffff2e;
        cursor: pointer;
    }

    .cat_images {
        display: block;
        width: auto;
        max-height: 144px;
        max-width: 100%;
        height: auto;
        position: absolute;
        margin: auto;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }
</style>


<script>
    ////Update category  -->
    function edit_category(that, id, cat_name) {
        $('.please_wait').remove();
        my_alert("<form method='post' enctype='multipart/form-data' class='edit_cat_form'>" +
            "<Lable><b>Category Name</b><lable><input type='hidden' name='category_id' value='" + id + "'><input value='" + cat_name + "' class='form-control cat_name_input' name='category_name' >" +
            "<Lable><b>Image[Only JPEG]</b><lable><br><input accept='image/jpeg' id='cat_files'  name='new_category_image[]' type='file'></form>",
            "Update Category", 'Update',
            function(that) {

                var fd = new FormData();
                var c = 0;
                var file_data;
                $('input[type="file"]').each(function() {
                    file_data = $('input[type="file"]')[c].files; // for multiple files

                    for (var i = 0; i < file_data.length; i++) {
                        fd.append("file_" + c, file_data[i]);
                    }
                    c++;
                });
                var other_data = $('form').serializeArray();
                $.each(other_data, function(key, input) {
                    fd.append(input.name, input.value);
                });

                $.ajax({
                    url: '<?php echo base_url('update/update_category_name') ?>',
                    data: fd,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(data) {

                        if (data.result) {
                            location.reload(true);
                            $('.ui-dialog-buttonset').after("<b class='please_wait'>please wait....</b>");
                        } else {
                            $('.ui-dialog-buttonset').after("<b class='please_wait'>Something went wrong.</b>");
                        }

                    }
                });

                that.preventDefault();

            }, "cancel"
        );
    }
 
</script> 
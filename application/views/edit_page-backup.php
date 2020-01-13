<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>



<?php 

foreach ($data as $value) {
    $id = $value['id'];
    $subid = $value['sub_cat_id'];
    $post_title = $value['post_title'];
    $data = $value['post'];
    $slug = $value['slug'];
    $seo_keyword = $value['seo_keyword'];
    $seo_description = $value['seo_description'];
    $seo_title = $value['seo_title'];
}



?>

<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $post_title; ?></title>

    <!-- include libraries(jQuery, bootstrap) -->
    <!-- <link href="<?php  ?>editor_bootstrap.css" rel="stylesheet">
    <link href="<?php  ?>summernote.css" rel="stylesheet"> -->

    <style>
        div#cke_1_contents {
            min-height: 450px;
        }
    </style>
    <!-- <style>  
       iframe {
            height: 100% !important;
        }


        .left_post_menu ul {
            padding: 0;
        }

        .left_post_menu a {
            color: #505050;
            font-size: 12px;
            font-weight: 500;
        }

        .left_post_menu li.posts {
            list-style: none;
            line-height: 1.6;
        }

        .left_post_menu li.subcategory {
            font-size: 15px;
            font-weight: 700;
            list-style: none;
            margin-bottom: 2px;
            margin-top: 10px;
        }

        .text-danger {
            color: #3e3e3e !important;
        }

        label {
            width: 100%;
        }

        input.submit_form {
            background: #166fc1;
            border: #166fc1;
        }

        a.btn.btn-danger {
            background: #166fc1;
            border: #166fc1;
        }

        input.post_name_add,
        input.sub_cat_name {
            font-size: 13px;
            font-weight: 400;
            color: #000000;
        }

        .left_post_menu ul {
            padding: 4px;
            background: #ffffff;
            border: 1px solid #efefef;
        }

        b#add_subcat {
            font-size: 15px;
            font-weight: 700;
            list-style: none;
            margin-bottom: 2px;
            color: #e64511;
            margin-top: 10px;
            display: block;
        }

        /* .navbar-brand {
            display: inline-block !important;
            padding-top: .3125rem !important;
            padding-bottom: .3125rem !important;
            margin-right: 1rem !important;
            font-size: 1.25rem !important;
            line-height: inherit !important;
            white-space: nowrap !important;

        } */
        div#cke_1_contents {
            min-height: 450px;
        }

        div#navbarNavDropdown {
            padding-left: 0;
        }

        body {
            margin: 0 !important;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol" !important;
            font-size: medium !important;
            font-weight: 400 !important;
            line-height: 1.5 !important;
            color: #212529 !important;
            text-align: left !important;
            background-color: #fff;
        }

        .navbar.logo {
            padding: 8px 16px !important;
            margin-bottom: 0px !important;
            border: 0 !important;

        }

        .navbar.logo .navbar-brand {
            padding: 5px 0px !important;
            height: auto !important;
        }

        .nav-link {
            display: block !important;
            padding: 0.3rem 1rem !important;
        }

        .navbar-expand-lg .navbar-nav .nav-link {
            padding: 4.800px 16px 4.800px 0 !important;
        }

        .search_results {
            margin-left: 0px !important;
            margin-right: 0px !important;
        }
    </style> -->


</head>



<script src="<?php echo base_url('assets/js/') ?>jquery.min.js"></script>
<script src="<?php echo base_url('assets/ckeditor/') ?>ckeditor.js"></script>
<script src="<?php echo base_url('assets/ckeditor/samples/js/') ?>sample.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>

<body>
    <div class="container   padding-top10 padding-bottom10">


        <div class="row">

            <div class='col-lg-2  d-none  d-lg-block mobile_post_menu'>
                <div class='left_post_menu'>
                    <ul class="main_side_bar_ul">
                        <?php $cat_id = 1;
                        foreach ($sidebar_category as $subcat) : ?>

                        <li id='subcat_<?php echo $subcat['id']; ?>' sub_cat_id="<?php echo $subcat['id']; ?>" class='subcategory text-danger'>
                            <span class="editable_sup_cat_name<?php echo $subcat['id']; ?>">
                                <?php echo $subcat['sub_category_name']; ?></span>

                            <?php if ($this->session->userdata('logged_in') == 1) :  ?>
                            <?php echo "<a onclick='update_supp_name(this," . $subcat['id'] . ")' style='color:red;'  href='#'> <img style='width: 15px;' src='" . base_url('assets/images/edit.png') . "'></a>";  ?>
                            <?php endif; ?>



                            <ul class="main_post_bar_ul">
                                <?php $post_id = 1;
                                foreach ($subcat['posts'] as $post) : ?>

                                <?php
                                echo "<li id='post_" . $post['id'] . "' class='posts " . ($selected_page == $post['id'] ? 'active' : 'noo') . "'>
                                <a href='" . base_url('tutorial/' . $category_id . '/' . $post['id']) . "'>" . $post['post_title'] . "</a>";

                                if ($this->session->userdata('logged_in') == 1) {
                                    echo "
                            
                                <a style='color:red;'  href='" . base_url('edit/post/' . $category_id . '/' . $post['id']) . "'> 
                                    <img style='width: 15px;' src='" . base_url('assets/images/edit.png') . "'>
                                </a>&nbsp;
                                <a href='#' onclick='delete_post(" . $post['id'] . ")' style='color:red;' >
                                    <img style='width: 15px;' src='" . base_url('assets/images/delete.png') . "'>
                                </a>
                             
                            </li>
                             ";
                                }
                                ?>
                                <?php $post_id++;
                            endforeach; ?>

                                <?php if ($this->session->userdata('logged_in') == 1) :  ?>
                                <li class="posts"><a href="#<?php echo "post_" . $subcat['id']; ?>" onclick="add_more_post(this,<?php echo $subcat['id']; ?>)" class="add_more_post"><b id="<?php echo "post_" . $subcat['id']; ?>">+ add more</b></a><b><a style="color:red;" target="_blank"> </a></b></li>
                                <?php endif; ?>
                            </ul>
                        </li>





                        <?php $cat_id++;
                    endforeach; ?>
                        <?php if ($this->session->userdata('logged_in') == 1) :  ?>
                        <li style="cursor: pointer;" class="subcategory text-danger add_more_sub">
                            <a onclick="add_sub_cat(this)" href="#add_subcat">
                                <b id="add_subcat">+ add more</b>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>

            <div class="col-sm-10">

                <?php 
                foreach ($next_post as $value) {
                    $next_id = $value['id'];
                    $next_slug = $value['slug'];
                }

                foreach ($prev_post as $value) {
                    $prev_id = $value['id'];
                    $prev_slug = $value['slug'];
                }

                ?>

                <?PHP if (isset($prev_id)) : ?>
                <div class="row">
                    <div class="col-lg-6">
                        <a class=' btn btn-danger' href='<?php echo base_url('Edit/post/') . $category_id . "/" . $prev_id; ?>'>
                            << Edit Prev POST(<?php echo $prev_slug; ?>)</a> </div> <?PHP endif; ?>

                                <?PHP if (isset($next_id)) : ?>
                                <div class="col-lg-6  ">
                                    <a class='float-lg-right btn btn-danger' href='<?php echo base_url('Edit/post/') . $category_id . "/" . $next_id; ?>'>Edit Next POST(<?php echo $next_slug; ?>) >></a>
                                </div>
                                <?PHP endif; ?>
                    </div>
                    <div class="col-lg-12  ">
                        <hr>
                    </div>



                    <input id='lesson_id' readonly name='text' type='hidden' class='form-control' value='<?php echo $id; ?>' style="background: #ababab;border: 1px solid black;">

                    <div class="row">
                        <div class="col-lg-6">
                            <label>Lesson Title</label>
                            <input id='lesson_title' name='text' type='text' class='form-control' value='<?php echo (isset($post_title) ? $post_title : 'Empty or Deleted') ?>' style="background: #ababab;border: 1px solid black;">
                        </div>



                        <div class="col-lg-4">
                            <label style="width: 100%;">&nbsp;</label>
                            <input type='submit' class='btn btn-danger submit_form' value='Save'>
                            <div class='status'></div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <hr style="border-top: 1px solid rgb(255, 255, 255)">
                    </div>

                    <div class="col-lg-12">
                        <div class="row">
                            <textarea class='summernote validation' id='lesson_description' name='desc' width='100%'>
		                         <?php echo (!empty($data) ? htmlentities($data) : htmlentities(' ')); ?> 
		                     </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!-- include summernote css/js -->

        <!-- <script src="<?php  ?>summernote.js"></script> -->

        <script>
            $('.submit_form').on('click', function() {
                lesson_id = $('#lesson_id').val();
                lesson_title = $('#lesson_title').val();
                lesson_description = $('#lesson_description').val();


                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('update/lesson'); ?>",
                    data: {
                        "lesson_id": lesson_id,
                        "lesson_title": lesson_title,
                        "lesson_description": lesson_description
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        if (data) {
                            window.location.reload();
                        }

                    },
                    error: function() {

                    },
                    complete: function(data) {
                        // Handle the complete event
                        var data = JSON.parse(data.responseText);
                        if (data) {
                            window.location.reload();
                        }
                    }
                });

            });
        </script>




        <script>
            CKEDITOR.replace('lesson_description');
            // $(document).ready(function() {
            //     $('.summernote').summernote({
            //         height: 700
            //     });
            // });              $('.summernote').summernote({
            //         height: 700
            //     });
            // });


            <?php if ($this->session->userdata('logged_in') == 1) :  ?>



            function add_sub_cat(that) {
                $('.add_subclass').remove();
                $(that).before('<span class="add_subclass"><li style="cursor: pointer;"  class="subcategory text-danger add_more_sub"><input class="sub_cat_name" type="text" value="Enter Name"></li> <button class="btn btn-danger" onclick ="submit_sub_cat(this)">Add</button></span>');

            }

            function add_more_post(that, subcat_id) {

                $('.add_postss').remove();
                $(that).before('<span class="add_postss" style="width: 100%;display: block;"><li style="cursor: pointer;"  class="subcategory text-danger add_more_post"><input class="post_name_add" type="text" value="Enter post Name"></li> <button class="btn btn-danger" sub_id="' + subcat_id + '" onclick ="submit_post_name(this)">Add</button></span>');

            }


            // ADD sub category
            function submit_sub_cat(that) {
                var subval = $('.sub_cat_name').val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Insert/insert_sub_cat') ?>",
                    // The key needs to match your method's input parameter (case-sensitive).
                    data: {
                        "subval": subval,
                        "category_id": <?php echo $category_id; ?>
                    },
                    dataType: "POST",
                    success: function(data) {
                        // console.log(data);
                        if (data) {
                            // window.location.reload();
                        }

                    },
                    error: function() {

                    },
                    complete: function(data) {
                        // Handle the complete event
                        var data = JSON.parse(data.responseText);
                        if (data.result) {
                            window.location.reload();
                        } else {
                            alert(data.msg);
                        }
                    }
                });

            }

            // ADD new post 
            function submit_post_name(that) {
                var post_val = $('.post_name_add').val();
                var sub_id = $(that).attr('sub_id');
                var category = "<?php echo $category_id; ?>"

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Insert/insert_new_post') ?>",
                    // The key needs to match your method's input parameter (case-sensitive).
                    data: {
                        "post_val": post_val,
                        "sub_id": sub_id,
                        "category": category
                    },
                    dataType: "POST",
                    success: function(data) {
                        console.log(data);
                        if (data) {
                            window.location.reload();
                        }

                    },
                    error: function() {

                    },
                    complete: function(data) {
                        // Handle the complete event
                        var data = JSON.parse(data.responseText);
                        if (data.result) {
                            window.location.reload();
                        } else {
                            alert(data.msg);
                        }
                    }
                });

            }

            function delete_post(id) {

                if (confirm("Are you sure ?")) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('Delete/delete_post') ?>",
                        data: {
                            "id": id,
                            "category": "<?php echo $category_id; ?>"

                        },
                        dataType: "POST",
                        success: function(data) {
                            console.log(data);
                            if (data) {
                                window.location.reload();
                            }

                        },
                        error: function() {

                        },
                        complete: function(data) {
                            // Handle the complete event
                            var data = JSON.parse(data.responseText);
                            if (data.result) {
                                window.location.reload();
                            } else {
                                alert(data.msg);
                            }
                        }
                    });
                }

            }



            function update_supp_name(that, supp_id) {

                $(that).hide();
                var get_previous_val = $('.editable_sup_cat_name' + supp_id).text().trim();
                console.log(get_previous_val);

                $('.editable_sup_cat_name' + supp_id).html('<input class="edit_sub_category" type="text" value="' + get_previous_val + '"> <button class="btn btn-danger" sub_cat_id="' + supp_id + '" onclick="update_sub_cat(this)">Update</button>')

            }


            function update_sub_cat(that) {

                var get_updationval = $('.edit_sub_category').val();
                var sub_cat_id = $(that).attr('sub_cat_id');
                var category = "<?php echo $category_id; ?>"

                $.ajax({
                    type: "POST",
                    contentType: "application/x-www-form-urlencoded",
                    dataType: "html",
                    url: "<?php echo base_url('Update/update_sub_cat') ?>",
                    data: {
                        "get_updationval": get_updationval,
                        "sub_cat_id": sub_cat_id,
                        "category": category

                    },
                    dataType: "POST",
                    success: function(data) {
                        console.log(data);
                        if (data) {
                            window.location.reload();
                        }

                    },
                    error: function() {

                    },
                    complete: function(data) {
                        // Handle the complete event
                        var data = JSON.parse(data.responseText);
                        if (data.result) {
                            window.location.reload();
                        } else {
                            alert(data.msg);
                        }
                    }
                });
                return false;




            }


            $(document).ready(function() {
                $('.main_side_bar_ul').sortable({
                    classes: {
                        "ui-sortable": "highlight"
                    },
                    axis: 'y',
                    update: function(event, ui) {
                        var sorted = $(this).sortable('serialize');


                        $.ajax({
                            data: sorted,
                            type: "POST",
                            contentType: "application/x-www-form-urlencoded",
                            dataType: "html",
                            url: '<?php echo base_url('Update/update_subcat_queue') ?>'
                        });
                    }
                });



                $('.main_post_bar_ul').sortable({
                    cancel: ".add_more_post",
                    axis: 'y',
                    update: function(event, ui) {
                        var sorted = $(this).sortable('serialize');

                        // POST to server using $.post or $.ajax
                        $.ajax({
                            data: sorted,
                            type: "POST",
                            contentType: "application/x-www-form-urlencoded",
                            dataType: "html",
                            url: '<?php echo base_url('Update/update_post_queue') ?>'
                        });
                    }
                });



            });
            <?php endif; ?>
        </script>



</body>
<html> 
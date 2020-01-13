<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!DOCTYPE html>

<div class='container-fluid   padding-top10 padding-bottom10'>
    <div class='row'>
        <div class='col-lg-12'>

        </div>
        <!--------- LEFT SIDE MENU ----------------->
        <div class='col-lg-2  d-none  d-lg-block mobile_post_menu'>
            <div class='left_post_menu'>
                <ul class="main_side_bar_ul">
                    <?php $cat_id = 1;
                    foreach ($sidebar_category as $subcat) : ?>

                    <li id='subcat_<?php echo $subcat['id']; ?>' sub_cat_id="<?php echo $subcat['id']; ?>" class='subcategory text-danger'>
                    <?php if ($this->session->userdata('logged_in') == 1) :  ?>
                    <span style="cursor:move;margin-left: -30px;"> <img style='width: 30px;' src='<?php echo base_url('assets/images/scroll.png'); ?>'></span> 
                    <?php endif; ?>
                        <span class="editable_sup_cat_name<?php echo $subcat['id']; ?>">
                            <?php echo $subcat['sub_category_name']; ?></span>
                        <?php if ($this->session->userdata('logged_in') == 1) :  ?>
                        <?php echo "<a onclick='update_supp_name(this," . $subcat['id'] . ")' style='color:red;'  href='#'> <img style='width: 15px;' src='" . base_url('assets/images/edit.png') . "'></a>";  ?>
                        <?php endif; ?>



                        <ul class="main_post_bar_ul">
                            <?php $post_id = 1;
                            foreach ($subcat['posts'] as $post) : ?>

                            <?php
                            echo "<li id='post_" . $post['id'] . "' class='posts " . ($selected_page == $post['id'] ? 'active' : 'noo') . "'>"; ?>
                             <?php if ($this->session->userdata('logged_in') == 1) :  ?>
                    <span style="cursor:move;margin-left: -29px;margin-right: 9px;"> <img style='width: 20px;' src='<?php echo base_url('assets/images/scroll.png'); ?>'></span> 
                    <?php endif; ?>
                            <?php   echo "    <a class='post_page' href='" . base_url('tutorial/' . $category_id . '/' . $post['id']) . "'>" . $post['post_title'] . "</a>";

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
        <!--------- LEFT SIDE MENU ----------------->

        <!--------- Main Content start ----------------->
        <div class='col-lg-10 col-xs-12'>
            <div class="content_detail" style="margin-top: -90px;">
                <?php 
                if (!empty($post_data)) {
                    foreach ($post_data as $value) {
                        $post_title =  $value['post_title'];
                        $post_data =  $value['post'];
                        $post_update_date =  $value['last_updated'];
                        $updated_by =  $value['updated_by'];
                        $slug =  $value['slug'];
                    }
                } else {
                    $post_title =  "Loading .. ";
                    $post_data =  "Please wait while we load your topics.";
                    $post_update_date =  ' ';
                    $updated_by =  ' ';
                    $slug =  ' ';
                }



                ?>


                <div class="prev_post first_post">
                    <?php if (!empty($prev_post)) : ?>
                    <?php foreach ($prev_post as $value) {
                        $prev_url = base_url('tutorial/' . $category_id . '/' . $value['id']);
                    }
                    ?>
                    <a href='<?php echo $prev_url; ?>'> <b>
                            << Previous Page</b> </a> <?php endif; ?> </div> <div class="next_post first_post">
                                <?php if (!empty($next_post)) : ?>
                                <?php foreach ($next_post as $value) {
                                    $next_url = base_url('tutorial/' . $category_id . '/' . $value['id']);
                                }
                                ?>
                                <a href='<?php echo $next_url; ?>'> <b>Next Page >></b></a>
                                <?php endif; ?>
                </div>
                <!--xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
			xxxxxxxxxxxxxx Main POST xxxxxxxxxxxxxxxx-->

                <div class="content_data">
                    <h1 class="theme_color"> <?php echo $post_title; ?>
                        <?php if (isset($_SESSION['logged_in'])) : ?>
                        <?php if ($_SESSION['logged_in'] == 1) : ?>
                        <a target="_BLANK" href="<?php echo base_url('edit/post/' . $category_id . '/' . $selected_page); ?>">
                            <img style="width: 25px;" src="<?php echo base_url();  ?>/assets/images/edit.png"></a>
                        <?php endif; ?>
                        <?php endif; ?>
                    </h1>
                    <article>
                        <?php echo $post_data; ?>
                    </article>
                </div><br>
                <?php echo "<i>Last Updated: " . $post_update_date . " By " . $updated_by . "</i>"; ?>
                <br> <br>





                <div class="prev_post">
                    <?php if (!empty($prev_post)) : ?>
                    <?php foreach ($prev_post as $value) {
                        $prev_url = base_url('tutorial/' . $category_id . '/' . $value['id']);
                    }
                    ?>
                    <a href='<?php echo $prev_url; ?>'> <b>
                            << Previous Page</b> </a> <?php endif; ?> </div> <div class="next_post">
                                <?php if (!empty($next_post)) : ?>
                                <?php foreach ($next_post as $value) {
                                    $next_url = base_url('tutorial/' . $category_id . '/' . $value['id']);
                                }
                                ?>
                                <a href='<?php echo $next_url; ?>'> <b>Next Page >></b></a>
                                <?php endif; ?>
                </div>



                <!--------- ads2 close ----------------->

            </div>
            <!--------- Main Content close ----------------->


        </div>
    </div>
</div>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@5.39.2/lib/codemirror.css">
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.39.2/lib/codemirror.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.39.2/mode/xml/xml.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.39.2/mode/clike/clike.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.39.2/mode/php/php.js"></script>

<script>
    var js_editor = document.getElementsByClassName("code");
    Array.prototype.forEach.call(js_editor, function(el) {
        var editor = CodeMirror.fromTextArea(el, {
            mode: "application/x-httpd-php",
            matchBrackets: true,
            indentUnit: 3,
            lineNumbers: true,
            spellcheck: true,
            readOnly: true,
            indentWithTabs: true
        });
        // Update textarea
        function updateTextArea() {
            editor.save();
        }
        editor.on('change', updateTextArea);
    });
</script>


<style>
    .mobile_post_menu.active {
        min-width: 100px;
        display: block !important;
        position: absolute;
        z-index: 99999;
        background: #fff;
        border: 3px solid #e64613;
    }

    article p {
        line-height: 1.4 !important;
    }

    .ui-sortable-placeholder {
        background: red !important;
    }

    article pre {
        font-family: monospace;
        padding: 11px;
        background: #f5f5f5;
        color: #585858;
    }

    b#add_subcat {
        font-size: 15px;
        font-weight: 700;
        list-style: none;
        margin-bottom: 2px;
        color: #000000;
        margin-top: 10px;
        display: block;
    }

    blockquote {
        padding: 10px 20px;
        margin: 0 0 20px;
        font-size: 17.5px;
        border-left: 5px solid #eee;
    }

    article a {
        text-decoration: underline;
        color: #499dec;
    }
    .content_data { 
    overflow: scroll;
}

    @media screen and (max-width: 550px) {
                .mobile_post_menu.active {
                    top: 135px;
                }
                .content_detail .first_post {
                    display: none;
                }
                .content_detail {
                    margin: 0 !important;
                }

                input.search_topics {
                    width: 100%;
                }

            }


</style>

<script>
    $('.tutorial_toggle').on('click', function() {
        $('.mobile_post_menu').toggleClass('active');
    });






    <?php if ($this->session->userdata('logged_in') == 1) :  ?>



    function add_sub_cat(that) {
        $('.add_subclass').remove();
        $(that).before('<span class="add_subclass"><li style="cursor: pointer;"  class="subcategory text-danger add_more_sub"><input class="sub_cat_name" type="text" value="Enter Name"></li> <button class="btn btn-danger" onclick ="submit_sub_cat(this)">Add</button></span>');

    }

    function add_more_post(that, subcat_id) {

        $('.add_postss').remove();
        $(that).before('<span class="add_postss" style="width: 100%;display: block;"><li style="cursor: pointer;"  class="subcategory text-danger add_more_post"><input class="post_name_add " type="text" placeholder="Enter post Name"></li> <button class="btn btn-danger" sub_id="' + subcat_id + '" onclick ="submit_post_name(this)">Add</button></span>');

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
                    my_alert(data.msg,'Submit sub category name');
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
                    my_alert(data.msg,'Submit post name');
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
                        my_alert(data.msg,'Delete post'); 
                    }
                }
            });
        }

    }



    function update_supp_name(that, supp_id) {

        $(that).hide();
        var get_previous_val = $('.editable_sup_cat_name' + supp_id).text().trim();


        $('.editable_sup_cat_name' + supp_id).html('<input class="edit_sub_category" type="text" value="' + get_previous_val + '"> <button class="btn btn-danger" sub_cat_id="' + supp_id + '" onclick="update_sub_cat(this)">Update</button>')

    }

    function update_sub_cat(that) {

        var get_updationval = $('.edit_sub_category').val();
        var sub_cat_id = $(that).attr('sub_cat_id');
        var category = "<?php echo $category_id; ?>"

        $.ajax({
            type: "POST",
            contentType: "application/x-www-form-urlencoded",
            dataType: "json",
            url: "<?php echo base_url('Update/update_sub_cat') ?>",
            data: {
                "get_updationval": get_updationval,
                "sub_cat_id": sub_cat_id,
                "category": category

            },
            dataType: "POST",
            success: function(data) {
                my_alert('Update sub category',data);
                if (data) {
                    window.location.reload();
                }

            },
            error: function(data) {

            },
            complete: function(data) {
                // Handle the complete event
                var data = JSON.parse(data.responseText);
                if (data.result) {
                    window.location.reload();
                } else {
                    my_alert(data.msg,'Update sub category');
                   
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



        ///////////////////Auto load first page on load 




    });
    <?php endif; ?>


    <?php if ($selected_page == 0) : ?>
    setTimeout(() => {
        $('ul.main_side_bar_ul li:nth-child(1) ul li:nth-child(1) .post_page')[0].click();
    }, 1000);
    <?php endif; ?>
</script> 
<?php 
$CI = &get_instance();
$CI->load->model('Dashboard_data');
$theme_color = $CI->Dashboard_data->gen_settings_data('theme_color')[0]['value'];
$button_color = $CI->Dashboard_data->gen_settings_data('button_color')[0]['value'];
?>

<div class="container">
    <div class="row">
    <h1 class="h2 theme_color">Permissions</h1>
    <div class="col-sm-12"></div>
        <div class="col-sm-3">
            <div class="row" style="border: 1px solid #2d2d2d;padding: 5px;background: white;">
                <h3>Categories</h3>
                <span style="font-size: 11px;color: red;    font-style: italic;"><b>Note:</b> Every category you create here will be shown on <a href="<?php echo base_url(); ?>">homepage</a> and <a onclick="blinkmenu();" href="#">Menubar</a>.</span>

                <ul class="list-group w-100">
                    <?php
                    $i = 1;
                    foreach ($categories_data as $value) {

                        echo '<li class="list-group-item" id="cat_list_' . $i . '">
                     <a href="#cat_list_' . $i . '"onclick="edit_cat(' . $value['id'] . ',this,\'cat\')" class="badge"> 
                     ' . $value['lesson_name'] . '</a>
                 </li>';
                        $i++;
                    }
                    echo '<li class="list-group-item"> 
               <a onclick="add_more()" href="#"> +add More</a>
            </li>';
                    ?>
                </ul>




            </div>

            <div class="row" style="    margin-top: 20px;border: 1px solid #2d2d2d;padding: 5px;background: white;">
                <h3>Users</h3>
                <span style="font-size: 11px;color: red;    font-style: italic;"><b>Note:</b> By default every new user password is 123 .Users can change thir password from settings <a href="#" onclick="blinkmenu()">menubar</a> on top.</span>
                <ul class="list-group w-100">
                    <?php
                    $i = 1;
                    foreach ($users as $value) {

                        echo '<li class="list-group-item" id="user_list_' . $i . '">
                     <a href="#user_list_' . $i . '"onclick="edit_cat(' . $value['user_id'] . ',this,\'user\')" class="badge"> 
                     ' . $value['username'] . '</a>';
                        echo "<select onchange='update_role(" . $value['user_id'] . ",this)' style='float: right;'>";
                        foreach ($get_users_roles as $roles) {
                            echo "<option " . ($value['user_role'] == $roles['role_id'] ? 'selected' : '') . " value='" . $roles['role_id'] . "'>" . $roles['role_name'] . "</option>";
                        }
                        echo "</select>";
                        '</li>';
                    }
                    echo '<li class="list-group-item"> 
               <a onclick="add_more_user()" href="#"> +add More</a>
            </li>';
                    ?>
                </ul>

            </div>
        </div>
        <div class="col-sm-9">
            <div class="row">
                <?php
                $i = 1;
                foreach ($categories_data as $value) {

                    $permissions = json_decode($value['permissions'], true);



                    echo "<div class='col-sm-6'>";
                    echo "<form class='form_" . $i . "' href='#'>";
                    echo "<h3>" . $value['lesson_name'] . "</h3>";

                    echo "<table class='table'>";

                    echo "<tr><th>Role</th><th>Insert</th><th>Update</th><th>Delete</th></tr>";

                    foreach ($permissions_data as $pvalue) {

                        echo "<tr>";
                        echo "<td>";
                        echo $pvalue['role_name'];
                        echo "</td>";
                        echo "<td>";
                        echo '<input type="checkbox" ' . (isset($permissions) ? (array_key_exists($pvalue['role_name'], $permissions) ? (in_array("insert", $permissions[$pvalue['role_name']]) ? " checked" : "") : ' unchecked') : '') . ' name="' . $pvalue['role_name'] . '[]" value="insert">';
                        echo "</td>";
                        echo "<td>";
                        echo '<input type="checkbox" ' . (isset($permissions) ? (array_key_exists($pvalue['role_name'], $permissions) ? (in_array("update", $permissions[$pvalue['role_name']]) ? " checked" : "") : ' unchecked') : '') . '  name="' . $pvalue['role_name'] . '[]"  value="update">';
                        echo "</td>";
                        echo "<td>";
                        echo '<input type="checkbox" ' . (isset($permissions) ? (array_key_exists($pvalue['role_name'], $permissions) ? (in_array("delete", $permissions[$pvalue['role_name']]) ? " checked" : "") : ' unchecked') : '') . '  name="' . $pvalue['role_name'] . '[]" value="delete">';
                        echo "</td>";
                        echo "</tr>";
                    }

                    echo "<tr><td>";
                    echo '<input type="hidden"  name="category_id" value="' . $value['id'] . '">';
                    echo "</td></tr>";
                    echo "<tr><td colspan='4'><input id='form_" . $i . "' type='button' class='btn btn-theme submit_form' value='Update'></td></tr>";

                    echo "</table>";
                    echo "</form>";
                    echo "</div>";

                    $i++;
                }
                ?>
            </div>
        </div>
    </div>
</div>


<script>
    $('.submit_form').on('click', function() {
        var formid = $(this).attr('id');

        var fordata = $('.' + formid).serialize();

        // console.log(fordata);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('settings/Permissions/process_permissons'); ?>",
            dataType: 'json',
            data: val = fordata,
            success: function(data) {
                if (data.result) {
                    window.location = "";
                }
            }
        });

    });


    function edit_cat(id, that, type) {

        if (type == 'cat') {

            $(that).removeAttr('href');
            $(that).removeAttr('onclick');
            var category_name = $(that).text().trim()
            $(that).html('<form class="edit_category"><input name="category_id" type="hidden" value="' + id + '"><div class="input-group">' +
                '<input type="text" class="form-control" name="category_name" id="exampleInputAmount" placeholder="Search" value="' + category_name + '">' +
                '<span class="input-group-btn">' +
                '<button style="background: #166fc1;color: #fff;" type="button" class="btn btn-default update_category_name">Save</button>' +
                '</span>' +
                '</div></form>');
        }
        if (type == 'user') {
            $(that).removeAttr('href');
            $(that).removeAttr('onclick');
            var user_name = $(that).text().trim()
            $(that).html('<form class="edit_user"><input name="user_id" type="hidden" value="' + id + '"><div class="input-group">' +
                '<input type="text" class="form-control" name="user_name" id="exampleInputAmount" placeholder="Search" value="' + user_name + '">' +
                '<span class="input-group-btn">' +
                '<button style="background: #166fc1;color: #fff;" type="button" class="btn btn-default update_user_name">Save</button>' +
                '</span>' +
                '</div></form>');

        }
    }

    //Update the category 
    $(document).on('click', '.update_category_name', function() {

        var form_data = $(this).closest('form').serialize();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Update/update_category_name'); ?>",
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.result) {
                    window.location = "";
                }
            }
        });
    });

    //Update the User 
    $(document).on('click', '.update_user_name', function() {

        var form_data = $(this).closest('form').serialize();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Update/update_user_name'); ?>",
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.result) {
                    window.location = "";
                }
            }
        });
    });

    function add_more() {

        if (confirm('Are you sure you want to create new?')) {
            if (confirm('We dont have delete function available ? Still want to create ? hehe')) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Insert/insert_category'); ?>",
                    dataType: 'json',
                    data: "new_category=new",
                    success: function(data) {
                        if (data.result) {
                            window.location = "";
                        }
                    }
                });
            }
        }
    }


    function add_more_user() {

        if (confirm('Are you sure you want to create new?')) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Insert/insert_user'); ?>",
                dataType: 'json',
                data: "new_user=new",
                success: function(data) {
                    if (data.result) {
                        window.location = "";
                    }
                }
            });

        }
    }


    function update_role(user_id, that) {

        var new_user_role = $(that).val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Update/update_user_role'); ?>",
            dataType: 'json',
            data: "user_id=" + user_id + "&new_role=" + new_user_role,
            success: function(data) {
                if (data.result) {
                    window.location = "";
                }
            }
        });

    }


    function blinkmenu() {
        $('.jqheader').animate({
            backgroundColor: "red",
            marginTop:"5px"
        }, 200, function() {
            $('.jqheader').animate({
                backgroundColor: "#176fc1",
                marginTop:"-5px"
            }, 200, function() {
                $('.jqheader').animate({
                    backgroundColor: "red",
                    marginTop:"5px"
                }, 200, function() {
                    $('.jqheader').animate({
                    backgroundColor: "#176fc1",
                    marginTop:"0px"
                }, 200, function() {

                });
                });
            });
        });
    }
</script>
<style>
    form {
        background: #fff;
        padding: 10px;
        border: 1px solid #2d2d2d;
        margin-bottom: 20px;
    }

    .list-group-item {
        padding: .55rem 5px;
    }

    a.badge:before {
        content: "Edit";
        font-size: 10px;
        color: red;
    }

     .btn-theme {
            color: #fff;
            background: <?php echo ($button_color ? $button_color . " !important" : "#176fc1") ?>;
            border: <?php echo ($button_color ? $button_color . " !important" : "#176fc1") ?>;
        }
</style> 
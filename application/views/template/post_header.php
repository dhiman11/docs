<?php
defined('BASEPATH') or exit('No direct script access allowed');

$CI = &get_instance();
$CI->load->model('Dashboard_data');
$theme_color = $CI->Dashboard_data->gen_settings_data('theme_color')[0]['value'];

?>
<!DOCTYPE html>


<html lang='en'>

<head>
    <meta charset="UTF-8">
    <link rel="alternate" href="<?php echo current_url(); ?>" hreflang="en-us" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Global site tag (gtag.js) - Google Analytics -->

    <!--  -->

    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <link href="https://cdn.bootcss.com/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet">

    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg container-fluid  logo">
        <a TITLE='home page' class="navbar-brand" href="<?php echo base_url(); ?>"><img style="width: 55px;" src='<?php echo base_url(); ?>assets/images/mgs-logo.png'></a>

    </nav>
    <div class='jqheader  '>

        <nav class="navbar navbar-expand-lg   container-fluid">

            <button class="navbar-toggler bg-light tutorial_toggle" type="button">
                <span class="navbar-toggler-icon" style="width: auto;"><img style="width: 30px;height: 40px;margin-top: -5px;" src='<?php echo base_url('assets/images/'); ?>menu.png'></span>
            </button>

            <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><img style="width: 30px;height: 40px;margin-top: -5px;" src='<?php echo base_url('./uploads/'); ?>Down_red_arrow.png'></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a TITLE='home page' class="nav-link text-light" href="<?php echo base_url(); ?>">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <?php 
                    $i = 1;
                    foreach ($menu as $value) {
                        if ($i <= 4) {
                            echo '<li class="nav-item">
					<a class="nav-link text-light"  TITLE="' . $value->lesson_name . '" href="' . base_url('tutorial/' . $value->id) . '/0">' . $value->lesson_name . '<span class="sr-only">(current)</span></a>
					</li>';
                        }
                        $i++;
                    }
                    ?>

                    <!-- ///////////OTHER CATEGORIES//////////////////////// -->
                    <li class="dropdown">
                        <a class="dropdown-toggle nav-link text-light" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false">
                            <img style="width: 30px;" alt="NOTES" src="<?php echo base_url('assets/images/book.png'); ?>"> <span class="caret"></span>All</a>
                        <ul class="dropdown-menu cat_dropdown">
                            <?php 

                            foreach ($menu as $value) {

                                echo '<li class="nav-item">
                        <a class="nav-link  "  TITLE="' . $value->lesson_name . '" href="' . base_url('tutorial/' . $value->id) . '/0">' . $value->lesson_name . '<span class="sr-only">(current)</span></a>
                        </li>';
                                $i++;
                            }
                            ?>
                        </ul>
                    </li>
                    <!-- ///////////OTHER CATEGORIES Close////////////////// -->

                </ul>


                <ul class="navbar-nav float-lg-right ">

                    <li class="dropdown">
                        <a class="dropdown-toggle nav-link text-light" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false">
                            <img style="width: 30px;" alt="NOTES" src="<?php echo base_url('assets/images/user.png'); ?>"> <span class="caret"></span>Settings</a>
                        <ul class="dropdown-menu user_dropdown">

                            <!-- /////PERMISSION LIST -->
                            <?php if ($this->session->userdata('logged_in') == 1) { ?>
                            <?php if ($this->session->userdata('role_name') == 'admin') { ?>
                                <li class="nav-item    ">
                                <?php 
                                echo '<a TITLE="Log In" class="nav-link  "  href="' . base_url('general_setting') . '">
                                            <img style="width: 30px;" alt="NOTES" src="' . base_url('assets/images/settings.png') . '">
                                            &nbsp;General settings
                                            </a> ';
                                ?>
                            </li>
                            <li class="nav-item    ">
                                <?php 
                                echo '<a TITLE="Log In" class="nav-link  "  href="' . base_url('settings/Permissions') . '">
                                            <img style="width: 30px;" alt="NOTES" src="' . base_url('assets/images/settings.png') . '">
                                            &nbsp;Change Permissions
                                            </a> ';
                                ?>
                            </li>
                            <?php 
                        }
                    } ?>
                            <!-- ///////PERMISSION LIST CLOSE -->

                            <!-- /////IMAGE UPLOAD LIST -->
                            <?php if ($this->session->userdata('logged_in') == 1) { ?>
                            <li class="nav-item  ">
                                <a TITLE='home page' target="_BLANK" class="nav-link  " href="<?php echo base_url('Image_upload/index'); ?>"><img style="width: 29px;" alt="NOTES" src="<?php echo base_url('assets/images/picture.png'); ?>">&nbsp;&nbsp;&nbsp;Images Upload(Admin Only) </a>
                            </li>
                            <?php 
                        } ?>
                            <!-- /////////IMAGE UPLOAD CLOSE HERE -->

                            <!-- /////Change password -->
                            <?php if ($this->session->userdata('logged_in') == 1) { ?>
                            <li class="nav-item  ">
                                <a TITLE='home page' class="nav-link  " href="<?php echo base_url('login/change_password_page'); ?>"><img style="width: 30px;" alt="NOTES" src="<?php echo base_url('assets/images/password.png'); ?>">&nbsp;&nbsp;Change Password </a>
                            </li>
                            <?php 
                        } ?>
                            <!-- /////////IMAGE UPLOAD CLOSE HERE -->


                        </ul>
                    </li>



                    <li class="nav-item    ">

                        <?php 

                        if ($this->session->userdata('logged_in') == 1) {
                            echo '<a TITLE="Log Out" class="nav-link text-light"  href="' . base_url('Login/log_out') . '"><img style="width: 30px;" alt="NOTES" src="' . base_url('assets/images/logout.png') . '">Logout (' . $this->session->userdata('username') . ')
                            <span style="
                            position: absolute;
                            bottom: -1px;
                            font-size: 12px;
                            right: 150px;
                            font-style: italic;
                            color: yellow;
                            border-top: 1px solid #ffffff59;
                        "> Your Role : "<span>' . $this->session->userdata('role_name') . '"</span> </span>
                        </a> ';
                        } else {
                            echo '<a   TITLE="Log In" class="nav-link text-light" href="' . base_url('Login/index') . '"><img style="width: 30px;" alt="NOTES" src="' . base_url('assets/images/login.png') . '">Login</a>';
                        }

                        ?>
                    </li>


                    <li class="nav-item">
                        <select style="vertical-align: middle;margin-top: 5px;" class="select_theme" onchange="change_theme(this)">
                            <option value="0">Light Theme</option>
                            <option value="1">Dark Theme</option>
                        </select>
                    </li>
                </ul>
            </div>
        </nav>

        <style>
            .jqheader {
                background-color: <?php echo ($theme_color ? $theme_color : "#176fc1") ?>;
            }

            .theme_color_footer {
                background-color: <?php echo ($theme_color ? $theme_color . " !important" : "#176fc1") ?>;
            }


            .tutorial {
                padding: 0px 0px 0px 0px;
                border-left: 5px solid <?php echo ($theme_color ? $theme_color : "#176fc1") ?>;
                border-right: 5px solid <?php echo ($theme_color ? $theme_color : "#176fc1") ?>;
                border-top: 5px solid <?php echo ($theme_color ? $theme_color : "#176fc1") ?>;
            }

            .tutorial p {
                background: <?php echo ($theme_color ? $theme_color : "#176fc1") ?>;
                color: #fff;
                font-size: 20px;
            }

            h1.theme_color {
                border-left: 5px solid <?php echo ($theme_color ? $theme_color : "#176fc1") ?>;
            }


            .left_post_menu a {
                color: <?php echo ($theme_color ? $theme_color : "#176fc1") ?>;
                font-size: 12px;
                font-weight: 600;
                text-decoration: underline;
            }

            .navbar-brand {
                display: inline-block !important;
                padding-top: .3125rem !important;
                padding-bottom: .3125rem !important;
                margin-right: 1rem !important;
                font-size: 1.25rem !important;
                line-height: inherit !important;
                white-space: nowrap !important;
            }

            .jqheader nav.navbar.navbar-expand-lg.container {
                margin-bottom: 10px !important;
            }


            .user_dropdown,
            .cat_dropdown {
                width: 100%;
                padding: 10px;
                background: #dff1ff;
            }

            .cat_dropdown {
                min-width: 470px;
            }

            .user_dropdown {
                min-width: 300px;
            }

            .cat_dropdown.show {
                height: auto;
                overflow-y: scroll;
                max-height: 300px;
            }

            .cat_dropdown a {
                text-decoration: underline;
                color: #333333;
                font-weight: 400;
                padding-left: 5px !important;
            }

            .cat_dropdown li:nth-child(odd) {
                display: inline-block;
                width: 49%;
                background: #176fc117;
                margin-bottom: 5px;
                border: 1px solid #becdd9;
                margin-right: 5px;
            }

            .cat_dropdown li:nth-child(even) {
                display: inline-block;
                width: 49%;
                background: #176fc117;
                margin-bottom: 5px;
                border: 1px solid #becdd9;
            }

            @media screen and (max-width: 550px) {
                .mobile_post_menu.active {
                    top: 135px;
                }
            }
        </style>

    </div> 
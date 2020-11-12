<?php 
    include '../lib/Session.php';
    Session::checkSession();
    include '../lib/Database.php';
    include '../helpers/Format.php';

    $db = new Database();
    $fm = new Format();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>eGohona Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="./main.css" rel="stylesheet">
    <link href="./css/stylesheet.css" rel="stylesheet">
    <script src="./js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="./js/setup.js" type="text/javascript"></script>
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                        <div class="logo-sr">
                           <a href=""><img src="assets/images/logo-inverse.png" alt="eGohona Logo" style="width:150px;"></a>
                        </div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    <div class="app-header__content">
                <div class="app-header-left">
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="view_products.php" class="nav-link">
                                <i class="nav-link-icon fa fa-database"> </i>
                                All Products
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="add_product.php" class="nav-link">
                                <i class="nav-link-icon fa fa-edit"></i>
                                Add New Product
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="orders.php" class="nav-link">
                                <i class="nav-link-icon fa fa-cog"></i>
                                Manage Orders
                            </a>
                        </li>
                    </ul>        </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left" style="order: 2; margin-left: 15px;">
                                    <div class="btn-group">
                                        <?php
                                            $id = Session::get("adminId");
                                            $query 	= "SELECT * FROM admins WHERE id = '$id'";
			                                $getData = $db->select($query);
                                            if ($getData) {
                                                while ($result = $getData->fetch_assoc()) {
                                            
                                        ?>
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="<?= $result['admin_image']; ?>" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <a href="user_profile.php?id=<?= $result['id']; ?>" type="button" tabindex="0" class="dropdown-item">User Account</a>
                                            <a href="" type="button" tabindex="0" class="dropdown-item">Products<div class="ml-auto badge badge-pill badge-secondary">
                                            <?php 
                                                $sql = "SELECT * FROM products";
                                                $result = $db->select($sql);
                                                $row_cnt = $result->num_rows;
                                                echo $row_cnt;
                                            ?></div></a>
                                            <a href="" type="button" tabindex="0" class="dropdown-item">Categories<div class="ml-auto badge badge-pill badge-secondary"><?php 
                                                $sql = "SELECT * FROM categories";
                                                $result = $db->select($sql);
                                                $row_cnt = $result->num_rows;
                                                echo $row_cnt;
                                            ?></div></a>
                                            <a href="" type="button" tabindex="0" class="dropdown-item">Settings</a>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a href="logout.php" type="button" tabindex="0" class="dropdown-item">Logout</a>
                                        </div>
                                        <?php } } ?>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <?php
                                            $id = Session::get("adminId");
                                            $query 	= "SELECT * FROM admins WHERE id = '$id'";
			                                $getData = $db->select($query);
                                            if ($getData) {
                                                while ($result = $getData->fetch_assoc()) {
                                            
                                    ?>
                                    <div class="widget-heading">
                                    <?= $result['name']; ?>
                                    </div>
                                    <div class="widget-subheading">
                                    <?= $result['email']; ?>
                                    </div>
                                </div>
                                <?php } } ?>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div> 
        <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-sr">
                            <img src="assets/images/logo-inverse.png" alt="egohona logo" style="width:150px;">
                        </div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">
                                    <a href="index.php">
                                        <i class="metismenu-icon pe-7s-airplay"></i>Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-diamond"></i>
                                        Products
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-collapse">
                                        <li>
                                            <a href="add_product.php">
                                                <i class="metismenu-icon"></i>
                                                Add New Product
                                            </a>
                                        </li>
                                        <li>
                                            <a href="view_products.php">
                                                <i class="metismenu-icon">
                                                </i>View Products
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-ticket"></i>
                                        Categories
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-collapse">
                                        <li class="">
                                            <a href="add_category.php">
                                                <i class="metismenu-icon"></i>
                                                Add New Category
                                            </a>
                                        </li>
                                        <li>
                                            <a href="view_categories.php">
                                                <i class="metismenu-icon">
                                                </i>View Categories
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-note2"></i>
                                        Orders
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-collapse">
                                        <li>
                                            <a href="orders.php">
                                                <i class="metismenu-icon"></i>
                                                All Orders
                                            </a>
                                        </li>
                                        <li>
                                            <a href="pending_orders.php">
                                                <i class="metismenu-icon"></i>
                                                Pending Orders
                                            </a>
                                        </li>
                                        <li>
                                            <a href="confirmed_orders.php">
                                                <i class="metismenu-icon"></i>
                                                Confirmed Orders
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-photo"></i>
                                        Slider
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-collapse">
                                        <li>
                                            <a href="add_slider.php">
                                                <i class="metismenu-icon"></i>
                                                Add New Slider
                                            </a>
                                        </li>
                                        <li>
                                            <a href="view_sliders.php">
                                                <i class="metismenu-icon">
                                                </i>View Sliders
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-users"></i>
                                        Customers
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-collapse">
                                        <li>
                                            <a href="view_customers.php">
                                                <i class="metismenu-icon">
                                                </i>View Customers
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-photo"></i>
                                        Banners
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-collapse">
                                        <li>
                                            <a href="add_banner.php">
                                                <i class="metismenu-icon">
                                                </i>Add Banner
                                            </a>
                                        </li>
                                        <li>
                                            <a href="edit_banner.php">
                                                <i class="metismenu-icon">
                                                </i>Update Banner
                                            </a>
                                        </li>
                                        <li>
                                            <a href="view_banners.php">
                                                <i class="metismenu-icon">
                                                </i>View Banners
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-global"></i>
                                        General Options
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-collapse">
                                        <li>
                                            <a href="update_logo.php?id=1">
                                                <i class="metismenu-icon">
                                                </i>Update Logo
                                            </a>
                                        </li>
                                        <li>
                                            <a href="add_page.php">
                                                <i class="metismenu-icon">
                                                </i>Add New Page
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-id"></i>
                                        Admin Profile
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-collapse">
                                        <li>
                                            <a href="user_profile.php">
                                                <i class="metismenu-icon">
                                                </i>Account Details
                                            </a>
                                        </li>
                                        <li>
                                            <a href="edit_proImg.php">
                                                <i class="metismenu-icon">
                                                </i>Change Profile Image
                                            </a>
                                        </li>
                                        <li>
                                            <a href="change_pass.php">
                                                <i class="metismenu-icon">
                                                </i>Change Password
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
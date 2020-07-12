<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?= $description ?>">
        <title><?= $title ?></title>
        <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
        <link href="<?= base_url('assets/css/custom-admin.css') ?>" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet' type='text/css'>
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
                <?php if ($this->session->userdata('logged_in')) { ?>
                    <nav class="navbar navbar-default">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <i class="fa fa-lg fa-bars"></i>
                            </button>
                        </div>
                        <div id="navbar" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="<?= base_url('admin') ?>"><i class="fa fa-home"></i> Home</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?= base_url('admin/logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </div>
                    </nav>
                <?php } ?>
                <div class="container-fluid">
                    <div class="row">
                        <?php if ($this->session->userdata('logged_in')) { ?>
                            <div class="col-sm-3 col-md-3 col-lg-2 left-side navbar-default">
                                <ul class="sidebar-menu">
                                    <li class="header">ECOMMERCE</li>
                                    <li><a href="<?= base_url('admin/publish') ?>" <?= urldecode(uri_string()) == 'admin/publish' ? 'class="active"' : '' ?>><i class="fa fa-edit" aria-hidden="true"></i> Publish product</a></li>
                                    <li><a href="<?= base_url('admin/products') ?>" <?= urldecode(uri_string()) == 'admin/products' ? 'class="active"' : '' ?>><i class="fa fa-files-o" aria-hidden="true"></i> Products</a></li>
                                    <?php if ($showBrands == 1) { ?>
                                        <li><a href="<?= base_url('admin/brands') ?>" <?= urldecode(uri_string()) == 'admin/brands' ? 'class="active"' : '' ?>><i class="fa fa-registered" aria-hidden="true"></i> Brands</a></li>
                                    <?php } ?>
                                    <li><a href="<?= base_url('admin/shopcategories') ?>" <?= urldecode(uri_string()) == 'admin/shopcategories' ? 'class="active"' : '' ?>><i class="fa fa-list-alt" aria-hidden="true"></i> Shop Categories</a></li>
                                    <li>
                                        <a href="<?= base_url('admin/orders') ?>" <?= urldecode(uri_string()) == 'admin/orders' ? 'class="active"' : '' ?>>
                                            <i class="fa fa-money" aria-hidden="true"></i> Orders 
                                            <?php if ($numNotPreviewOrders > 0) { ?>
                                                <img src="<?= base_url('assets/imgs/exlamation-hi.png') ?>" style="position: absolute; right:10px; top:7px;" alt="">
                                            <?php } ?>
                                        </a>
                                    </li>
                                    <li class="header">SETTINGS</li>
                                    <li><a href="<?= base_url('admin/adminusers') ?>" <?= urldecode(uri_string()) == 'admin/adminusers' ? 'class="active"' : '' ?>><i class="fa fa-user" aria-hidden="true"></i> Admin Users</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-10 col-sm-offset-3 col-md-offset-3 col-lg-offset-2">
                                <?php if ($warnings != null) { ?>
                                    <div class="alert alert-danger">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        There are some errors that you must fix!
                                        <ol>
                                            <?php foreach ($warnings as $warning) { ?>
                                                <li><?= $warning ?></li>
                                            <?php } ?>
                                        </ol>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                            <div>
                            <?php } ?>


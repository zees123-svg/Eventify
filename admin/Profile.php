<?php

session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
} 

include 'common/header.php';
include 'common/sidebar.php';
?>

<!-- Main content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h3 class="text-center mb-3">My Profile</h3>
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <td>Zeeshan</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>zeeshanramzanok@gmail.com</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>Active</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

    <?php
    include 'common/footer.php';
    ?>
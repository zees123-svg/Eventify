<?php

include 'common/header.php';
include 'common/sidebar.php'; 

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];

        $stmt = $conn->prepare("INSERT INTO calendar (title, start, end) 
                                VALUES (:title, :start, :end)");

        $success = $stmt->execute([
            ':title' => $title,
            ':start' => $start,
            ':end' => $end,
        ]);

        if ($success) {
            echo "<script>
                alert('Your calendar has been added successfully!');
                window.location.href='calendars.php';
            </script>";
        } else {
            echo "<script>alert('Database insert failed.'); window.history.back();</script>";
        }

    } 
?>



<!-- Main content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add New Calendar</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Calendars</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-3"></div>
                <!-- Center column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">New Calendar form</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                                </div>
                                <div class="form-group">
                                    <label for="start">Event Start</label>
                                    <input type="datetime-local" class="form-control" id="start" name="start">
                                </div>
                                <div class="form-group">
                                   <label for="end">Event End</label>
                                    <input class="form-control" type="datetime-local" name="end" id="end">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer col text-center">
                            <button type="submit" name="submit" class="btn btn-primary mx-auto">Add New Calendars</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>
<?php
    include 'common/footer.php';
?>
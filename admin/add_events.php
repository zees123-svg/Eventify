<?php

include 'common/header.php';
include 'common/sidebar.php'; 

if (isset($_POST['submit'])) {
    $tab_number = $_POST['tab_number'];
    $event_name = $_POST['event_name'];
    $event_menu = $_POST['event_menu'];
    $location = $_POST['location'];
    $details = $_POST['details'];
    $total_persons = $_POST['total_persons'];
    $shift = $_POST['shift'];
    $file_name = '';

    // All other variables...

    if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
        $file_name = basename($_FILES['fileToUpload']['name']);
        $target_path = './dist/assets/' . $file_name;

        if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {
            echo "<script>alert('File upload failed.'); window.history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('No file uploaded or upload error.'); window.history.back();</script>";
        exit;
    }

        $stmt = $conn->prepare("INSERT INTO event (tab_number, event_name, img, event_menu, location, total_persons, details, shift) 
                                VALUES (:tab_number, :event_name, :img, :event_menu, :location, :total_persons, :details, :shift)");

        $success = $stmt->execute([
            ':tab_number' => $tab_number,
            ':event_name' => $event_name,
            ':img' => $file_name,
            ':event_menu' => $event_menu,
            ':location' => $location,
            ':total_persons' => $total_persons,
            ':details' => $details,
            ':shift' => $shift,
        ]);

        if ($success) {
            echo "<script>
                alert('Your event has been added successfully!');
                window.location.href='events.php';
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
                    <h1 class="m-0">Add New Event</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Events</li>
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
                            <h3 class="card-title">New Event form</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tab_number">Tab Number</label>
                                    <select class="form-control" id="tab_number" name="tab_number">
                                        <option value="1">Tab 1</option>
                                        <option value="2">Tab 2</option>
                                    </select> 
                                </div>    
                                <div class="form-group">
                                    <label for="Event">Event Name</label>
                                    <input type="text" class="form-control" id="Event" name="event_name" placeholder="Enter Event Name">
                                </div>
                                <div class="form-group">
                                    <label for="Event">Event Menu</label>
                                    <input type="text" class="form-control" id="Event" name="event_menu" placeholder="Enter Event Menu">
                                </div>
                                <div class="form-group">
                                   <label for="fileToUpload">Main Image</label>
                                    <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
                                </div>
                                <div class="form-group">
                                 <label for="location">Event Location</label>
                                 <input type="text" class="form-control" id="location" name="location" placeholder="Enter Event Location">
                                </div>
                                <div class="form-group">
                                    <label for="total_persons">Total Persons</label>
                                    <input type="number" class="form-control" id="total_persons" name="total_persons" placeholder="Enter number of persons">
                                </div>

                                <div class="form-group">
                                    <label for="shift">Shift</label>
                                      <select class="form-control" id="shift" name="shift">
                                        <option value="Morning">Morning</option>
                                        <option value="Evening">Evening</option>
                                        <option value="Night">Night</option>
                                      </select>
                                </div>
                                <!-- Main content -->
                                <section class="content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-outline card-info">
                                                <div class="card-header">
                                                    <h3 class="card-title">
                                                        Note
                                                    </h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <textarea id="summernote" name="details">
                                                        Place <em>some</em> <u>text</u> <strong>here</strong>
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.col-->
                                    </div>
                                    <!-- /.row -->
                                </section>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer col text-center">
                            <button type="submit" name="submit" class="btn btn-primary mx-auto">Add New Events</button>
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
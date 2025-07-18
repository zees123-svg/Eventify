<?php
include 'common/header.php';
include 'common/sidebar.php';

if (isset($_POST['post'])) {
    $title = $_POST['title'];
     $detail = $_POST['detail'];


    $file_name = '';
    if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === 0) {
        $file_name = $_FILES['fileToUpload']['name'];
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], './dist/assets/' . $file_name);
    } else {
        echo "<script>alert('File upload failed or no file uploaded.'); window.history.back();</script>";
        exit;
    }

    $publish = isset($_POST['publish']) ? 1 : 0;
    $details = $_POST['details'];

    $sql = "INSERT INTO post (title, img, detail, details, publish) 
            VALUES ('$title', '$file_name', '$detail', '$details' ,'$publish')";
    $affected_row = $conn->exec($sql);

    echo "<script>
        alert('Your post has been added successfully!');
        window.location.href='post.php';
    </script>";
    exit;
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
                    <h1 class="m-0">New Post</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Post</li>
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
                            <h3 class="card-title">Post form</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title </label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter post title">
                                </div>
                                 <div class="row mt-3">
                        <div class="form-group col">
                            <label for="fileToUpload">Main Image</label>
                            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
                        </div>
                    </div>
                               <div class="row mt-3">
                        <div class="form-group col">
                            <label for="detail">Detail</label>
                            <textarea class="form-control" name="detail" cols=40 rows=3>Short Desc</textarea>
                        </div>
                    </div>
                                <div class="form-group">
                                    <label for="publish">Publish</label>
                                    <input type="checkbox" class="form-control" id="publish" name="publish" placeholder="Enter post publish">
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
                                <button type="submit" name="post" class="btn btn-primary mx-auto w-25">Post</button>
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
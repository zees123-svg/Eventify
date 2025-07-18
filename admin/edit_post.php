<?php
include 'common/header.php';
include 'common/sidebar.php';
include 'DB/Connection.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid ID.");
}

$stmt = $conn->prepare('SELECT * FROM post WHERE id = :id');
$stmt->execute([':id' => $id]);
$cat = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cat) {
    die("Post not found.");
}

if (isset($_POST['post'])) {
    $title = $_POST['title'] ?? '';
    $detail = $_POST['detail'] ?? '';
    $details = $_POST['details'] ?? '';
    $publish = isset($_POST['publish']) ? 1 : 0;
    $updated_at = date('Y-m-d H:i:s');

    $uploadDir = './dist/assets/';
    $image = $cat['img'];

    if (!empty($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['error'] === 0) {
        $fileName = basename($_FILES['fileToUpload']['name']);
        $fileName = preg_replace('/[^A-Za-z0-9.\-_]/', '_', $fileName);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
            $image = $fileName;
        } else {
            echo "<script>alert('Image upload failed.');</script>";
        }
    }

    $stmt = $conn->prepare("UPDATE post SET title = ?, img = ?, detail = ?, details = ?, publish = ?, updated_at = ? WHERE id = ?");
    $stmt->execute([$title, $image, $detail, $details, $publish, $updated_at, $id]);

    echo "<script>alert('Post updated successfully.'); window.location.href='post.php';</script>";
    exit;
}
?>

<!-- Main Content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Post</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Post</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <!-- General form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Post form</h3>
                        </div>

                        <!-- Form Start -->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <div class="form-group">
            <label for="title">New Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($cat['title']) ?>" placeholder="Enter post title">
        </div>

        <div class="form-group">
            <label for="fileToUpload">Main Image</label>
            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
            <?php if (!empty($cat['img'])): ?>
                <p>Current Image:</p>
                <img src="./dist/assets/<?= htmlspecialchars($cat['img']) ?>" width="200" />
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="detail">Short Description</label>
            <textarea class="form-control" name="detail" rows="3"><?= htmlspecialchars($cat['detail']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="publish">Publish</label>
            <input type="checkbox" id="publish" name="publish" value="1" <?= $cat['publish'] ? 'checked' : '' ?>>
            <small>Check to publish</small>
        </div>

        <div class="form-group">
            <label for="details">Details</label>
            <textarea id="summernote" name="details"><?= htmlspecialchars($cat['details']) ?></textarea>
        </div>
    </div>

    <div class="card-footer text-center">
        <button type="submit" name="post" class="btn btn-primary w-25">Submit</button>
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
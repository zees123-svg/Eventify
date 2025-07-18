<?php

include("./common/header.php");    
include("../admin/DB/Connection.php"); 

$id = $_GET['id'];
$stmt = $conn->prepare('SELECT * FROM post WHERE id = :id');
$stmt->execute(array(':id' => $id));
$post = $stmt->fetch();
// print_r($post);
?>

  <section class="blog-section mt-1">
    <!-- ***** Blog Page ***** -->
      <div class="page-heading-blog-p1">
           <div class="container">
           </div>
      </div>
    <!-- ***** Blog Page ***** --> 

    <div class="container mt-5">
      <h2 class="mb-5">Eventify Blog Details</h2>
      <div class="blog-grid">

      <div class="container">
      <h1><?= $post['title']; ?></h1>
      <p><?= $post['detail']; ?></p>
      <p class="meta"><strong>Published:</strong> May 5, 2025</p>
       <img src="../admin/dist/assets/<?php echo htmlspecialchars($post['img']); ?>"/>
      <div class="content">
        <?= $post['details']; ?>
      </div>
    </div>
  </section> <br><br>


<?php

include("./common/footer.php");    

?>  
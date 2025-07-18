<?php
include("./common/header.php"); 

include("../admin/DB/Connection.php"); 

if ($conn) {
    $stmt = $conn->prepare("SELECT * FROM post");
	$stmt->execute();
	$test = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } else {
        echo "Connection failed.";
    }
?>

  <section class="blog-section mt-1">
    <!-- ***** Blog Page ***** -->
      <div class="page-heading-blog">
           <div class="container">
           </div>
      </div>
    <!-- ***** Blog Page ***** --> 

    <div class="container mt-5">
      <h2 class="mb-5">Eventify Blog</h2>
      <div class="blog-grid">
  <?php foreach ($test as $post): ?>
        <!-- Blog Post 1 -->
        <div class="blog-card">
          <img src="../admin/dist/assets/<?php echo htmlspecialchars($post['img']); ?>"/>
          <h2><?= $post['title']; ?></h2>
          <p><?= $post['detail']; ?></P>
          <p><strong>Published:</strong> May 5, 2025</p>
          <a href="BlogPage.php?id=<?= $post['id']; ?>" class="btn btn-sm btn-success">View More</a>
        </div>
  <?php endforeach ?>
      </div>
    </div>
  </section><br><br><br>

<?php

include("./common/footer.php");    

?>  
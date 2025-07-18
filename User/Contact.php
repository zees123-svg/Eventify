<?php
include("./common/header.php");    
include("../admin/DB/Connection.php"); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $first_name = trim($_POST['first_name'] ?? '');
        $last_name = trim($_POST['last_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $mobile_number = trim($_POST['mobile_number'] ?? '');
        $message = trim($_POST['message'] ?? '');

        $stmt = $conn->prepare("INSERT INTO contact (first_name, last_name, email, mobile_number, message)
            VALUES (:first_name, :last_name, :email, :mobile_number, :message)");

        $stmt->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':mobile_number' => $mobile_number,
            ':message' => $message,
        ]);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- ***** Contact Us Page ***** -->
   <div class="page-heading-contact-us">
        <div class="container">
        </div>
    </div>
<!-- ***** Contact Us Page ***** -->    

<section class="contact-section">
  <div class="container">
    <h2><strong>Contact Us</strong></h2>
    <p class="subtitle">We’d love to hear from you! Reach out to us through any of the following channels.</p>

    <div class="contact-grid">
      <!-- Contact Info -->
      <div class="contact-info">
        <h3 class="text-dark"><strong>Eventify Headquarters</strong></h3>
        <p><strong>Address:</strong> 14-Y Government Colony Tanki Chowk, 56000, Pakistan</p>
        <p><strong>Phone:</strong> +92 321 6850363</p>
        <p><strong>Email:</strong> versatilezeeshan1708@gmail.com</p>
        <p><strong>Hours:</strong> Mon to Fri: 10:00 AM to 8:00 PM <br> Sat - Sun: 11:00 AM to 4:00 PM <br> Holidays: Closed</p>

        <h3 class="text-dark"><strong>Other Locations</strong></h3>
        <ul>
          <li><strong>Islamabad Office:</strong> Royal Marquee, Islamabad</li>
          <li><strong>Lahore Office:</strong> Johar Town, Lahore</li>
        </ul>
            <div class="social-links">
                <ul>
                    <li><a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="https://www.instagram.com"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
      </div>

      <!-- Contact Form -->
      <div class="contact-form">
        <form action="Contact.php" method="post">
          <label for="first_name">First Name*</label>
          <input type="text" id="first_name" name="first_name" required>

          <label for="last_name">Last Name*</label>
          <input type="text" id="last_name" name="last_name" required>

          <label for="mobile_number">Mobile Number*</label>
          <input type="text" id="mobile_number" name="mobile_number" required>

          <label for="email">Your Email*</label>
          <input type="email" id="email" name="email" required>

          <label for="message">Your Message</label>
          <textarea id="message" name="message" rows="5" required></textarea>

          <div class="col-lg-3 z1">
            <fieldset>
                <button type="submit" id="form-submit" class="main-dark-button">Submit</button>
            </fieldset>
          </div>
        </form>
      </div>
    </div>

    <!-- Map Placeholder -->
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3426.552065156668!2d73.45931527439193!3d30.81519358164479!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3922a7577ea324db%3A0x336a38aba5098ba8!2s14y%20Government%20Colony%20Main%20Road%2C%20Government%20Colony%20Govt%20Colony%2C%20Okara%2C%20Pakistan!5e0!3m2!1sen!2s!4v1747168968648!5m2!1sen!2s"
            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
    </div>
  </div>
</section>


<?php

include("./common/footer.php");    

?>  
<?php
include("../admin/DB/Connection.php"); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

        try {
            $email = trim($_POST['email'] ?? '');

            $stmt = $conn->prepare("INSERT INTO subscribe (email) VALUES (:email)");

            $stmt->execute([
            ':email' => $email, 
        ]);
        } 
        catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!-- *** Subscribe *** -->
    <div class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h4>Subscribe Our Newsletter:</h4>
                </div>
                <div class="col-lg-8">
                    <form action="index.php" method="post">
                        <div class="row">
                          <div class="col-lg-9">
                            <fieldset>
                              <input name="email" type="email" placeholder="Your Email Address" required>
                            </fieldset>
                          </div>
                          <div class="col-lg-3">
                            <fieldset>
                              <a href="index.php">  
                              <button type="submit" id="form-submit" class="main-dark-button">Submit</button>
                              </a>
                            </fieldset>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- *** Footer *** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="address">
                        <h4>Address</h4>
                        <span>14-Y Government Colony <br>Tanki Chowk, 56000<br>Pakistan</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="index.php" class="active">Home</a></li>
                            <li><a href="Blog.php">Blog</a></li>
                            <li><a href="Services.php">Services</a></li>
                            <li><a href="About.php">About Us</a></li>
                            <li><a href="rentvenue.php">Venue</a></li>
                            <li><a href="showsevent.php">Shows & Events</a></li>  
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="hours">
                        <h4>Open Hours</h4>
                        <ul>
                            <li>Mon to Fri: 10:00 AM to 8:00 PM</li>
                            <li>Sat - Sun: 11:00 AM to 4:00 PM</li>
                            <li>Holidays: Closed</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <p class="copyright">Copyright @ 2025 Eventify Company </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="sub-footer">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="logo"><span>Ev<em>entify</em></span></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu">
                                    <ul>
                                        <li><a href="index.php" class="active">Home</a></li>
                                        <li><a href="Blog.php">Blog</a></li>
                                        <li><a href="Services.php">Services</a></li>
                                        <li><a href="About.php">About Us</a></li>
                                        <li><a href="rentvenue.php">Venue</a></li>
                                        <li><a href="showsevent.php">Shows & Events</a></li>  
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="social-links">
                                    <ul>
                                        <li><a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="https://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="https://www.instagram.com"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="./assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="./assets/js/popper.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="./assets/js/scrollreveal.min.js"></script>
    <script src="./assets/js/waypoints.min.js"></script>
    <script src="./assets/js/jquery.counterup.min.js"></script>
    <script src="./assets/js/imgfix.min.js"></script> 
    <script src="./assets/js/mixitup.js"></script> 
    <script src="./assets/js/accordions.js"></script>
    <script src="./assets/js/owl-carousel.js"></script>
    
    <!-- Global Init -->
    <script src="./assets/js/custom.js"></script>

    <!-- Calendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src="./assets/js/calendar.js"></script>

  </body>
</html>
<?php
include("./common/header.php");    
include("../admin/DB/Connection.php"); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = trim($_POST['name'] ?? '');
        $rating = trim($_POST['rating'] ?? '');
        $comment = trim($_POST['comment'] ?? '');

        $stmt1 = $conn->prepare("INSERT INTO review 
            (name, rating, comment)
            VALUES 
            (:name, :rating, :comment)");

        $stmt1->execute([
            ':name' => $name,
            ':rating' => $rating,
            ':comment' => $comment,
        ]);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$stmt2 = $conn->prepare("SELECT * FROM calendar ORDER BY start ASC");
$stmt2->execute();
$calendars = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>


 <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner">
        
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-content">
                        <h6>Date, Day & Year</h6>
                        <h2>Marriage Event 2025 in Pakistan.</h2>
                         <div class="b1">
                            <a class="l1" href="rentvenue.php">Event Booking</a>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- *** Owl Carousel Items ***-->
    <div class="show-events-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-show-events owl-carousel">
                        <div class="item">
                            <a href="#"><img src="./assets/images/download(2).jfif" alt=""></a>
                        </div>
                        <div class="item">
                            <a href="#"><img src="./assets/images/download(6).jfif" alt=""></a> 
                        </div>
                        <div class="item">
                            <a href="#"><img src="./assets/images/Image(2).jpg" alt=""></a> 
                        </div>
                        <div class="item">
                            <a href="#"><img src="./assets/images/images(2).jfif" alt=""></a> 
                        </div>
                        <div class="item">
                            <a href="#"><img src="./assets/images/images(3).jfif" alt=""></a> 
                        </div>
                        <div class="item">
                            <a href="#"><img src="./assets/images/images(4).jfif" alt=""></a> 
                        </div>
                        <div class="item">
                            <a href="#"><img src="./assets/images/images(7).jfif" alt=""></a> 
                        </div>
                        <div class="item">
                            <a href="#"><img src="./assets/images/images(8).jfif" alt=""></a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- *** Amazing Venus ***-->
    <div class="amazing-venues">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="left-content">
                        <h4>Three Amazing Venues for events</h4>
                        <h5>Fawad Villas Lawn Okara</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae eos nemo reiciendis ullam quas voluptate corrupti rerum<br>
                             repudiandae consequuntur quae similique, ducimus illo cum nostrum neque, blanditiis quo modi!</p>
                        <h5>Johar Town Park Lahore</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae eos nemo reiciendis ullam quas voluptate corrupti rerum<br>
                             repudiandae consequuntur quae similique, ducimus illo cum nostrum neque, blanditiis quo modi!</p>
                        <h5>Royall Marquee Islamabad</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae eos nemo reiciendis ullam quas voluptate corrupti rerum<br>
                             repudiandae consequuntur quae similique, ducimus illo cum nostrum neque, blanditiis quo modi!</p>          
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="right-content">
                        <h5><i class="fa fa-map-marker"></i> Visit Us</h5>
                        <span>14-Y Government Colony <br>Tanki Chowk, 56000<br>Pakistan</span>
                        <div class="text-button"><a href="rentvenue.php">Need Directions? <i class="fa fa-arrow-right"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- *** Map ***-->
    <div class="map-image">
        <img src="./assets/images/image.png" alt="Maps of 3 Venues">
    </div>


    <!-- *** Reviews & Feedback ***-->
  <section>
          <P class="h2 text-center mt-5">Reviews and Feedback</P>
          <P class="lead text-center">These are some feedbacks given by our costumers:</P>
          <div class="flex-wrap mt-5" style="display: flex; justify-content: center; gap: 50px;">
            <div class="card" style="width: 18rem; height: 240px;">
              <div class="card-body">
                <h5 class="card-title text-center text-muted">Rated 4.8/5</h5>
                  <p class="card-text">“The 7th UAF Congress meeting was held well organized and all the arrangements are very fine . Looking forward to the next one!”</p>
                      <footer class="blockquote-footer">Faheem Tariq, Verified Attende</footer>
              </div>
            </div> 
            <div class="card" style="width: 18rem; height: 240px;">
              <div class="card-body">
                <h5 class="card-title text-center text-muted">Rated 4.8/5</h5>
                  <p class="card-text">“The 7th UAF Congress meeting was held well organized and all the arrangements are very fine . Looking forward to the next one!”</p>
                      <footer class="blockquote-footer">Faheem Tariq, Verified Attende</footer>
              </div>
            </div> 
            <div class="card" style="width: 18rem; height: 240px;">
              <div class="card-body">
                <h5 class="card-title text-center text-muted">Rated 4.8/5</h5>
                  <p class="card-text">“The 7th UAF Congress meeting was held well organized and all the arrangements are very fine . Looking forward to the next one!”</p>
                      <footer class="blockquote-footer">Faheem Tariq, Verified Attende</footer>
              </div>
            </div> 
        </section><br><br>

        <section>
  <h2 class="text-center mt-5">Leave Your Review</h2>
  <form action="Index.php" method="POST" style="max-width: 500px; margin: 20px auto;">
    <div class="mb-3">
      <label for="name" class="form-label">Your Name*</label>
      <input type="text" id="name" name="name" class="form-control" placeholder="Your Name" required/>
    </div>
    <div class="mb-3">
      <label for="rating" class="form-label">Rating (0.0 to 5.0)*</label>
      <input type="number" step="0.1" min="0" max="5" id="rating" name="rating" class="form-control" placeholder="Your rating" required/>
    </div>
    <div class="mb-3">
      <label for="comment" class="form-label">Your Feedback*</label>
      <textarea id="comment" name="comment" class="form-control" rows="4" placeholder="Your Feedback about Eventify" required></textarea>
    </div>
   <button type="submit" class="btn btn-primary">Submit Review</button>
  </form>
</section>

<!-- *** Calendar Events ***-->
<section class="calendar-section py-5" style="background: #f8f9fa;">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="text-dark">Upcoming Events</h2>
      <p class="text-muted">Stay updated with what's coming next</p>
    </div>
    <div id="calendar"></div>
  </div>
    <div class="text-center mt-5">
        <a href="Calendar-events.php" class="btn btn-primary">View More</a>
    </div>
</section>

        <!-- *** Coming Events ***-->
        <div class="coming-events">
            <div class="left-button">
                <div class="main-white-button">
                    <a href="showsevent.php">Discover More</a>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="event-item">
                        <div class="thumb">
                            <a href="rentvenue.php"><img src="./assets/images/images(7).jfif" alt=""></a>
                        </div>
                        <div class="down-content">
                            <a href="rentvenue.php"><h4>Fawad Villas Lawn</h4></a>
                            <ul>
                                <li><i class="fa fa-clock-o"></i> Tuesday: 15:30-19:30</li>
                                <li><i class="fa fa-map-marker"></i>Fawad Villas Okara</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="event-item">
                        <div class="thumb">
                            <a href="rentvenue.php"><img src="./assets/images/images(8).jfif" alt=""></a>
                        </div>
                        <div class="down-content">
                            <a href="rentvenue.php"><h4>Johar Town Park</h4></a>
                            <ul>
                                <li><i class="fa fa-clock-o"></i> Wednesday: 08:00-14:00</li>
                                <li><i class="fa fa-map-marker"></i> Johar Town Lahore</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="event-item">
                        <div class="thumb">
                            <a href="rentvenue.php"><img src="./assets/images/Image(2).jpg" alt=""></a>
                        </div>
                        <div class="down-content">
                            <a href="rentvenue.php"><h4>Royal Marquee</h4></a>
                            <ul>
                                <li><i class="fa fa-clock-o"></i> Thursday: 09:00-23:00</li>
                                <li><i class="fa fa-map-marker"></i> Royal Hall Marquee Islamabad</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include("./common/footer.php");    

?>  
<?php
include("./common/header.php"); 
include("../admin/DB/Connection.php"); 

// Fetch venues by tab number
$stmt1 = $conn->prepare("SELECT * FROM venue WHERE tab_number = 1");
$stmt1->execute();
$tab1_venues = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $conn->prepare("SELECT * FROM venue WHERE tab_number = 2");
$stmt2->execute();
$tab2_venues = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$stmt3 = $conn->prepare("SELECT * FROM venue WHERE tab_number = 3");
$stmt3->execute();
$tab3_venues = $stmt3->fetchAll(PDO::FETCH_ASSOC);


// Fetch all bookings
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = trim($_POST['name'] ?? '');
        $home_address = trim($_POST['home_address'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $mobile_number = trim($_POST['mobile_number'] ?? '');
        $cnic_number = trim($_POST['cnic_number'] ?? '');
        $total_persons = trim($_POST['total_persons'] ?? '');
        $event_type = trim($_POST['event_type'] ?? '');
        $venue_requested = trim($_POST['venue_requested'] ?? '');
        $start_time = trim($_POST['start_time'] ?? '');
        $end_time = trim($_POST['end_time'] ?? '');
        $about_event = trim($_POST['about_event'] ?? '');

        $stmt = $conn->prepare("INSERT INTO bookings 
            (name, home_address, email, mobile_number, cnic_number, total_persons, event_type, venue_requested, start_time, end_time, about_event)
            VALUES 
            (:name, :home_address, :email, :mobile_number, :cnic_number, :total_persons, :event_type, :venue_requested, :start_time, :end_time, :about_event)");

        $stmt->execute([
            ':name' => $name,
            ':home_address' => $home_address,
            ':email' => $email,
            ':mobile_number' => $mobile_number,
            ':cnic_number' => $cnic_number,
            ':total_persons' => $total_persons,
            ':event_type' => $event_type,
            ':venue_requested' => $venue_requested,
            ':start_time' => $start_time,
            ':end_time' => $end_time,
            ':about_event' => $about_event,
        ]);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- ***** Venue Section ***** -->
<div class="page-heading-rent-venue">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Are You Looking For A Venue?</h2>
                <span>Check out our venues, pick your choice and fill the reservation application.</span>
            </div>
        </div>
    </div>
</div>
<div class="rent-venue-tabs">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row" id="tabs">
          <div class="col-lg-12">
            <div class="heading-tabs">
              <div class="row">
                <div class="col-lg-8">
                  <ul>
                    <li><a href='#tabs-1'>Okara</a></li>
                    <li><a href='#tabs-2'>Lahore</a></a></li>
                    <li><a href='#tabs-3'>Islamabad</a></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <section class='tabs-content'>
              <article id='tabs-1'>
                <div class="row">
                  <div class="col-lg-9">
                    <div class="right-content">
                      <?php if (!empty($tab1_venues)): ?>
                      <?php foreach ($tab1_venues as $venue): ?>
                      <h4><?= htmlspecialchars($venue['venue_name']); ?></h4>
                      <p><?= htmlspecialchars($venue['detail']); ?></p>
                      <ul class="list">
                        <li><?= htmlspecialchars($venue['location']); ?></li>
                        <li><?= htmlspecialchars($venue['price_display']); ?></li>
                        <li><?= htmlspecialchars($venue['total_capacity']); ?></li>
                      </ul>
                      <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                  </div>  
                  <div class="col-lg-3">
                    <div id="map">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3426.3309267274562!2d73.46317429999998!3d30.82139220000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3922a7d56a71a3d3%3A0x508d5c43166aa7ac!2sLWF%20okara!5e0!3m2!1sen!2s!4v1747007055906!5m2!1sen!2s" width="100%" height="240px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                      <h5>Any Question?</h5>
                      <p>Tumeric air affogato sare torial waistcoat denim stumber.</p>
                    </div>
                  </div>
                </div>  
              </article>                            
              <article id='tabs-2'>
                <div class="row">
                  <div class="col-lg-9">
                    <div class="right-content">
                      <?php if (!empty($tab2_venues)): ?>
                      <?php foreach ($tab2_venues as $venue): ?>
                      <h4><?= htmlspecialchars($venue['venue_name']); ?></h4>
                      <p><?= htmlspecialchars($venue['detail']); ?></p>
                      <ul class="list">
                        <li><?= htmlspecialchars($venue['location']); ?></li>
                        <li><?= htmlspecialchars($venue['price_display']); ?></li>
                        <li><?= htmlspecialchars($venue['total_capacity']); ?></li>
                      </ul>
                      <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                  </div>                          
                  <div class="col-lg-3">
                    <div id="map">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3403.0239924196994!2d74.27245049687365!3d31.468526171591915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391903d7729d30eb%3A0x807f2933609dfe25!2sAli%20Park!5e0!3m2!1sen!2s!4v1747007274498!5m2!1sen!2s" width="100%" height="240px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                      <h5>Any Question?</h5>
                      <p>Tumeric air affogato sare torial waistcoat denim stumber.</p>
                    </div>
                  </div>
                </div>  
              </article>   
              <article id='tabs-3'>
                <div class="row">
                  <div class="col-lg-9">
                    <div class="right-content">
                      <?php if (!empty($tab3_venues)): ?>
                      <?php foreach ($tab3_venues as $venue): ?>
                      <h4><?= htmlspecialchars($venue['venue_name']); ?></h4>
                      <p><?= htmlspecialchars($venue['detail']); ?></p>
                      <ul class="list">
                        <li><?= htmlspecialchars($venue['location']); ?></li>
                        <li><?= htmlspecialchars($venue['price_display']); ?></li>
                        <li><?= htmlspecialchars($venue['total_capacity']); ?></li>
                      </ul>
                      <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                  </div>                              
                  <div class="col-lg-3">
                    <div id="map">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1663.305705909722!2d73.17551259713323!3d33.51148584114623!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38dff21cce899d99%3A0x2f97861f11ce1a12!2sRoyal%20Marquee!5e0!3m2!1sen!2s!4v1747007511005!5m2!1sen!2s" width="100%" height="240px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                      <h5>Any Question?</h5>
                      <p>Tumeric air affogato sare torial waistcoat denim stumber.</p>
                    </div>
                  </div>
                </div>  
              </article>    
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="rent-venue-application">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="heading-text">
                        <h4>Reservation Application</h4>
                    </div>
                    <div class="contact-form">
                        <form method="post" action="rentvenue.php">
                          <div class="row">
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <label for="name">Full Name*</label>
                                <input type="text" id="name" name="name" placeholder="Full Name" required>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <label for="home_address">Home Address*</label>
                                <input type="text" id="home_address" name="home_address" placeholder="Home Address" required>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <label for="email">Email*</label>
                                <input name="email" id="email" type="email" placeholder="Your Email" required>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <label for="mobile_number">Mobile Number*</label>
                                <input name="mobile_number" id="mobile_number" type="text" placeholder="Mobile Number" required>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <label for="cnic_number">CNIC Number*</label>
                                <input name="cnic_number" id="cnic_number" type="text" placeholder="CNIC Number" required>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <label for="total_persons">Total Persons*</label>
                                <input name="total_persons" id="total_persons" type="number" placeholder="Number of Persons" required>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <label for="venue_requested">Venue Requested*</label>
                                <input name="venue_requested" id="venue_requested" type="text" placeholder="Venue Requested" required>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <label for="event_type">Event Type*</label>
                                <input name="event_type" id="event_type" type="text" placeholder="Type Of Event" required>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <label for="start_time">Start Time & Date*</label>
                                <input name="start_time" id="start_time" type="datetime-local" placeholder="Event start time & date" required>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <label for="end_time">End Time & Date*</label>
                                <input name="end_time" id="end_time" type="datetime-local" placeholder="Event end time & date" required>
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <label for="about_event">About the Event*</label>
                                <textarea name="about_event" id="about_event" rows="6" placeholder="About The Event You Are Hosting" required></textarea>
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <button type="submit" id="form-submit" class="main-dark-button">Submit Request</button>
                              </fieldset>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php

include("./common/footer.php");    

?>  
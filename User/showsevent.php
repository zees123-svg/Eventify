<?php

include("./common/header.php");  

include("../admin/DB/Connection.php"); 

// Fetch events by tab number
$stmt1 = $conn->prepare("SELECT * FROM event WHERE tab_number = 1");
$stmt1->execute();
$tab1_events = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $conn->prepare("SELECT * FROM event WHERE tab_number = 2");
$stmt2->execute();
$tab2_events = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- ***** About Us Page ***** -->
    <div class="page-heading-shows-events">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Our Shows & Events</h2>
                    <span>Check out upcoming and past shows & events.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="shows-events-tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row" id="tabs">
                        <div class="col-lg-12">
                            <div class="heading-tabs">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <ul>
                                          <li><a href='#tabs-1'>Upcoming</a></li>
                                          <li><a href='#tabs-2'>Past</a></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <section class='tabs-content'>
                                <article id='tabs-1'>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="heading"><h2>Upcoming</h2></div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="sidebar">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="heading-sidebar">
                                                            <h4>Sort The Upcoming Shows & Events By:</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="month">
                                                            <h6>Month</h6>
                                                            <ul>
                                                                <li><a href="#">June</a></li>
                                                                <li><a href="#">July</a></li>
                                                                <li><a href="#">August</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="category">
                                                            <h6>Category</h6>
                                                            <ul>
                                                                <li><a href="#">Walima Event</a></li>
                                                                <li><a href="#">Food Fun Festival</a></li>
                                                                <li><a href="#">Music & Fun Festival</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="venues">
                                                            <h6>Venues</h6>
                                                            <ul>
                                                                <li><a href="#">Fawad Villas Lawn</a></li>
                                                                <li><a href="#">Johar Town Park</a></li>
                                                                <li><a href="#">Royal Marquee</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="event-item">
                                                        <div class="row">
                                                            <?php if (!empty($tab1_events)): ?>
                                                            <?php foreach ($tab1_events as $event): ?>
                                                            <div class="col-lg-4">
                                                                <div class="left-content">
                                                                    <h2><?= htmlspecialchars($event['event_name']); ?></h2>
                                                                    <p><?= htmlspecialchars($event['event_menu']); ?></P>
                                                                    <div class="main-dark-button"><a href="eventdetails.php?id=<?= $event['id']; ?>" class="btn btn-sm btn-success">View More</a></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="thumb">
                                                                   <img src="../admin/dist/assets/<?php echo htmlspecialchars($event['img']); ?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="right-content">
                                                                     <ul>
                                                                        <li>
                                                                            <i class="fa fa-map-marker"></i>
                                                                             <td><?= htmlspecialchars($event['location']); ?></td>
                                                                        </li>
                                                                        <li>
                                                                            <i class="fa fa-users"></i>
                                                                            <td><?= htmlspecialchars($event['total_persons']); ?></td>
                                                                        </li>
                                                                        <li>
                                                                            <td><?= htmlspecialchars($event['shift']); ?></td>
                                                                        </li>    
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>                            
                                <article id='tabs-2'>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="heading"><h2>Past</h2></div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="sidebar">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="heading-sidebar">
                                                            <h4>Sort The Past Shows & Events By:</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="month">
                                                            <h6>Month</h6>
                                                            <ul>
                                                                <li><a href="#">February</a></li>
                                                                <li><a href="#">March</a></li>
                                                                <li><a href="#">April</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="category">
                                                            <h6>Category</h6>
                                                            <ul>
                                                                <li><a href="#">Birthday Event</a></li>
                                                                <li><a href="#">Barat Event</a></li>
                                                                <li><a href="#">Business Meeting</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="venues">
                                                            <h6>Venues</h6>
                                                            <ul>
                                                                <li><a href="#">Fawad Villas Lawn</a></li>
                                                                <li><a href="#">Johar Town Park</a></li>
                                                                <li><a href="#">Royal Marquee</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="event-item">
                                                        <div class="row">
                                                            <?php if (!empty($tab2_events)): ?>
                                                            <?php foreach ($tab2_events as $event): ?>
                                                            <div class="col-lg-4">
                                                                <div class="left-content">
                                                                    <h2><?= htmlspecialchars($event['event_name']); ?></h2>
                                                                    <p><?= htmlspecialchars($event['event_menu']); ?></P>
                                                                    <div class="main-dark-button"><a href="eventdetails.php?id=<?= $event['id']; ?>" class="btn btn-sm btn-success">View More</a></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="thumb">
                                                                  <img src="../admin/dist/assets/<?php echo htmlspecialchars($event['img']); ?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="right-content">
                                                                    <ul>
                                                                        <li>
                                                                            <i class="fa fa-map-marker"></i>
                                                                             <td><?= htmlspecialchars($event['location']); ?></td>
                                                                        </li>
                                                                        <li>
                                                                            <i class="fa fa-users"></i>
                                                                            <td><?= htmlspecialchars($event['total_persons']); ?></td>
                                                                        </li>
                                                                        <li>
                                                                            <td><?= htmlspecialchars($event['shift']); ?></td>
                                                                        </li>    
                                                                    </ul>
                                                                </div>    
                                                            </div>    
                                                            <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div> 
                                                </div>      
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

<?php

include("./common/footer.php");    

?>  
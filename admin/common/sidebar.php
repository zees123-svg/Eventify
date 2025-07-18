 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <span class="brand-text font-weight-light text-dark">Eventify</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php" class="d-block">
             <?php echo isset($_SESSION['admin_name']) ? htmlspecialchars($_SESSION['admin_name']) : 'Admin'; ?>
          </a>
        </div>
      </div>  

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="subscribe.php" class="nav-link">
              <i class="fas fa-envelope-open-text mr-2 ml-1"></i>
              <p>
                Subscribe
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="events.php" class="nav-link">
              <i class="bi bi-calendar-event-fill mr-2 ml-1"></i>
              <p>
                Events
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="calendars.php" class="nav-link">
              <i class="bi bi-calendar-event-fill mr-2 ml-1"></i>
              <p>
                Calendars
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="post.php" class="nav-link">
              <i class="fas fa-file-alt mr-2 ml-1"></i>
              <p>
                Posts
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="venue.php" class="nav-link">
              <i class="fas fa-landmark mr-2 ml-1"></i>
              <p>
                Venue
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="reviews.php" class="nav-link">
              <i class="fas fa-comment-dots mr-2 ml-1"></i>
              <p>
                Reviews
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Contact.php" class="nav-link">
              <i class="fa fa-phone mr-2 ml-1"></i>
              <p>
                Contact
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Booking.php" class="nav-link">
              <i class="bi bi-calendar mr-2 ml-1"></i>
              <p>
                Booking
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
             <i class="fas fa-sign-out-alt mr-2 ml-1"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

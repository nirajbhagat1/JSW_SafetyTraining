

<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsiive Admin Dashboard | CodingLab </title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin_navbar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  </head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <img id="logo-img" src="../assets/img/JSWSTEEL.NS-5d2dda26.png" alt="">
      <span class="logo_name">Admin </span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="all_users.php" class="active">
          <i class='bx bxs-user-rectangle'></i>
            <span class="links_name">users</span>
          </a>
        </li>
        <li>
          <a href="admin_test.php">
          <i class='bx bxs-edit' ></i>
            <span class="links_name">Test</span>
          </a>
        </li>
        <li>
          <a href="admin_videos.php">
          <i class='bx bx-video-plus' ></i>
            <span class="links_name">Videos</span>
          </a>
        </li>
        <li>
          <a href="admin_documents.php">
          <i class='bx bxs-file-doc' ></i>
            <span class="links_name">Documents</span>
          </a>
        </li>
        <li>
          <a href="admin_about.php">
          <i class='bx bxs-info-circle' ></i>
            <span class="links_name">About Us</span>
          </a>
        </li>
        <li>
          <a href="admin_contact.php">
          <i class='bx bxs-contact' ></i>
            <span class="links_name">Contact us</span>
          </a>
        </li>
      
        <li class="log_out">
          <a href="admin_logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      
    </nav>

    
      

  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>

</body>
</html>
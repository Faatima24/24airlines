<?php 
if(!(isset($_SESSION['user_id']))) {
  header("location:../login.php");
  die;
}
?>
<aside class="main-sidebar">
  <h4 class="text-center"> 24Airlines </h4>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user -->
    <div class="image">
      <img src="user_images/<?php echo $_SESSION['profile_picture'];?>" class="img-circle elevation-2" alt="User Image" />
    </div>
    <div class="info">
      <a class="d-block"><?php echo $_SESSION['display_name'];?></a>
    </div>
    <!-- Sidebar Menu -->
    <ul>
      <li>
        <a href="../home.php">
          <i class="fas fa-home"></i>
          Accueil
        </a>
      </li>
      <li>
        <a href="../exams.php">
          <i class="fas fa-file-alt"></i>
          Examens
        </a>
      </li>
      <li>
        <a href="../pilots.php">
          <i class="fas fa-user"></i>
          Pilotes
        </a>
      </li>
      <li>
        <a href="../flights.php">
          <i class="fas fa-plane"></i>
          Vols
        </a>
      </li>
      <li>
        <a href="../articles.php">
          <i class="fas fa-newspaper"></i>
          Publications
        </a>
      </li>
      <li>
        <a href="https://aerometeo.fr/">
          <i class="fas fa-cloud-sun"></i>
          Météo
        </a>
      </li>
    </ul>
  </div>
  <!-- /.sidebar -->
</aside>

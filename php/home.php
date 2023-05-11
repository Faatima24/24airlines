<?php 
require_once ("utils/db_connect.php");

  $queryFlight = "SELECT date, departure_city, arrival_city
  FROM flights
  WHERE date >= CURDATE()
  ORDER BY date ASC
  LIMIT 1;
  ;";

  $queryExam = "SELECT name , next_exam_date, exam_center
  FROM exams
  WHERE next_exam_date >= CURDATE()
  ORDER BY next_exam_date ASC
  LIMIT 1;
  ;";

  $queryArticle = "SELECT name , description, date
  FROM articles
  ORDER BY date ASC
  LIMIT 1;
  ;";
  try {

    $req= $db->prepare($queryFlight);
    $req->execute();
    $infoFlight= $req->fetch(PDO::FETCH_ASSOC);


    $req= $db->prepare($queryExam);
    $req->execute();
    $infoExam= $req->fetch(PDO::FETCH_ASSOC);

    $req= $db->prepare($queryArticle);
    $req->execute();
    $infoArticle= $req->fetch(PDO::FETCH_ASSOC);


  } catch(PDOException $ex) {
    echo $ex->getMessage();
    echo $ex->getTraceAsString();
    exit;
  }

?> 
<!DOCTYPE html>
<html lang="fr">
<head>
<title>Accueil</title>
</head>
<body >
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->

<?php 
require ('utils/header.php');
require ('utils/sidebar.php');
?>  
  <div class="content-wrapper">
    <section class="content-header">
      <div>
        <h1> Accueil </h1>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes -->
        <div class="row">
            <div class="small-box">
              <div class="inner">
                <h3><?php echo $infoFlight;?></h3>
                <p> Vol prochain </p>
              </div>
              <div class="icon">
                <i class="fa fa-plane"></i>
              </div>
            </div>
          
            <div class="small-box ">
              <div class="inner">
                <h3><?php echo $infoExam;?></h3>
                <p> Examen prochain </p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
            </div>
          
            <div class="small-box">
              <div class="inner">
                <h3><?php echo $infoArticle;?></h3>
                <p> Dernier article publié </p>
              </div>
              <div class="icon">
                <i class="fa fa-bullhorn"></i>
              </div>
          
            </div>
          
        </div>
      </div>
    </section>
<?php require ('utils/footer.php');?>  
</div>



</body>
</html>
<?php
session_start();
require_once("utils/db_connect.php");
require("utils/mailer.php");

//controle de la méthode utilisée//
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(["success" => false, "error" => "Mauvaise méthode"]);
    die;
}
// else{
//     $_SERVER["REQUEST_METHOD"]=="POST" ;
// }

// controle de saisie//
if (!isset($_POST["id"], $_POST["firstname"], $_POST["lastname"], $_POST["birthdate"], $_POST["email"], $_POST["password"], $_POST["chief"], $_POST["street_number"], $_POST["street_name"], $_POST["zip_code"], $_POST["city"], $_POST["flight_hours"], $_FILES["profile_picture"]
)) {
    echo json_encode(["success" => false, "error" => "Données manquantes "]);
    die;
}
if (
    empty(trim($_POST["id"])) ||
    empty(trim($_POST["firstname"])) ||
    empty(trim($_POST["lastname"])) ||
    empty(trim($_POST["birthdate"])) ||
    empty(trim($_POST["email"])) ||
    empty(trim($_POST["password"]))||
    empty(trim($_POST["chief"])) ||
    empty(trim($_POST["street_number"])) ||
    empty(trim($_POST["street_name"])) ||
    empty(trim($_POST["zip_code"])) ||
    empty(trim($_POST["city"])) ||
    empty(trim($_POST["flight_hours"]))||
    // If $_FILES["profile_picture"]["error"] is not equal to UPLOAD_ERR_OK(who has a value of 0), it means that there was some kind of error during the upload process
    $_FILES["profile_picture"]["error"] != UPLOAD_ERR_OK
    ) {
    echo json_encode(["success" => false, "error" => "Données vides ou erreur lors de l'insertion du fichier"]);
    die; 
}

$regex = "/^[a-zA-Z0-9-+._]+@[a-zA-Z0-9-]{2,}\.[a-zA-Z]{2,}$/";
if (!preg_match($regex, $_POST["email"])) {
    echo json_encode(["success" => false, "error" => "Email au mauvais format"]);
    die; 
}
$regex = "/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])[a-zA-Z0-9]{8,12}$/";
if (!preg_match($regex, $_POST["password"])) {
    echo json_encode(["success" => false, "error" => "Mot de passe au mauvais format"]);
    die; 
}

$hash = password_hash($_POST["password"], PASSWORD_DEFAULT);


$baseName = basename($_FILES["profile_picture"]["name"]);
$targetFile =  time().$baseName;
//mkdir() function checks if the directory "user_images" exists. If not, it creates it.
if (!is_dir('user_images')) {
    mkdir('user_images');
}
//move file from .. to .. returns True if done successfully
$status = move_uploaded_file($_FILES["profile_picture"]["tmp_name"], 
'user_images/'.$targetFile);
if($status) {
    try {
    $db->beginTransaction();
    $req = $db->prepare("INSERT INTO pilots(id, firstname, lastname, birthdate, email, password, chief, street_number, street_name, zip_code, city, flight_hours, profile_picture) VALUES (:id, :firstname, :lastname, :birthdate, :email, :pwd, :chief, :street_number, :street_name , :zip_code, :city, :flight_hours, :profile_picture)");
    $req->bindValue(":id", $_POST["id"]);
    $req->bindValue(":firstname", $_POST["firstname"]); 
    $req->bindValue(":lastname", $_POST["lastname"]);
    $req->bindValue(":birthdate", $_POST["birthdate"]);
    $req->bindValue(":email", $_POST["email"]);
    $req->bindValue(":pwd", $hash);
    $req->bindValue(":profile_picture", $targetFile);
    $req->bindValue(":chief", $_POST["chief"]);
    $req->bindValue(":street_number", $_POST["street_number"]);
    $req->bindValue(":street_name", $_POST["street_name"]);
    $req->bindValue(":zip_code", $_POST["zip_code"]);
    $req->bindValue(":city", $_POST["city"]);
    $req->bindValue(":flight_hours", $_POST["flight_hours"]);
    $req->execute(); 
    $db->commit();

$message = 'utilisateur sauvegardé avec succès';    

mailer($_POST["email"], "Bienvenue {$_POST["firstname"]} {$_POST["lastname"]}", "Bienvenue dans l'équipe de 24Airlines!  ");

} catch(PDOException $ex) {
    $db->rollback();
    echo $ex->getTraceAsString();
    echo $ex->getMessage();
    exit;
}
echo json_encode(["success" => true]);

} else {
    $message = 'a problem occured in image uploading.';
}



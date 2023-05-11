<?php
session_start();
require_once("utils/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(["success" => false, "error" => "Mauvaise méthode"]);
    die; 
}
// else{
//     $_SERVER["REQUEST_METHOD"]=="POST" ;
// }

if (!isset($_POST["email"], $_POST["password"])) {
    echo json_encode(["success" => false, "error" => "Données manquantes"]);
    die; 
}

if (empty(trim($_POST["email"])) || empty(trim($_POST["password"]))) {
    echo json_encode(["success" => false, "error" => "Données vides"]);
    die; 
}

$req = $db->prepare("SELECT * FROM pilots WHERE email = ?");
$req->execute([$_POST["email"]]); 

// J'affecte à ma variable $pilot le résultat unique (ou pas de résultat) de ma requete SQL
$pilot = $req->fetch(PDO::FETCH_ASSOC);

//? Si ma variable $pilot à une valeur ET que le mot de passe correspond au hash de celui de l'utilisateur alors
if ($pilot && password_verify($_POST["password"], $pilot["password"])) {
    $_SESSION["connected"] = true; // J'affecte à la clé "connected" la valeur true
    $_SESSION["pilot_id"] = $pilot["id"]; // J'affecte à la clé "pilot_id" la valeur de l'id de l'utilisateur qui vient de se connecter
    $_SESSION["chief"] = $pilot["chief"]; // J'affecte à la clé "chief" la valeur chief de l'utilisateur

    echo json_encode(["success" => true]);
} else { //? Sinon
    $_SESSION = [];
    echo json_encode(["success" => false, "error" => "Utilisateur introuvable"]);
}
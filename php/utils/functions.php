<?php
session_start();

function isChief() {
    if(isset($_POST['Chief']) && $_POST['Chief']=1) {
        return true;
    } else {
        return false;
    }
}

// function isConnected(){
//      if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {
//         echo json_encode(["success" => false, "error" => "Connectez-vous d'abord"]);
//         die;
//     }
// }

?>
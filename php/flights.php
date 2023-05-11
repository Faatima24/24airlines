<?php
session_start();

require_once ('utils/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if they are not logged in
    header('Location: login.php');
    exit;
}


// If the user is an admin and the add flight form is submitted, insert the new flight into the database
if (isChief() && isset($_POST['addFlight'])) {
    $sql = "INSERT INTO flights (departure_date, departure_hour, departure_airport, departure_city, arrival_date, arrival_hour, arrival_airport, arrival_city, id_plane, id_pilot)
        VALUES (:departure_date, :departure_hour, :departure_airport, :departure_city, :arrival_date, :arrival_hour, :arrival_airport, :arrival_city, :id_plane, :id_pilot)";
    $req = $db->prepare($sql); 

    $req->bindValue(':departure_date', $_POST['departure_date']);
    $req->bindValue(':departure_hour', $_POST['departure_hour']);
    $req->bindValue(':departure_airport', $_POST['departure_airport']);
    $req->bindValue(':departure_city', $_POST['departure_city']);
    $req->bindValue(':arrival_date', $_POST['arrival_date']);
    $req->bindValue(':arrival_hour', $_POST['arrival_hour']);
    $req->bindValue(':arrival_airport', $_POST['arrival_airport']);
    $req->bindValue(':arrival_city', $_POST['arrival_city']);
    $req->bindValue(':id_plane', $_POST['id_plane']);
    $req->bindValue(':id_pilot', $_POST['id_pilot']);

    if ($req->execute()) {
        echo 'Le vol a été ajouté avec succès.';
    } else {
        echo 'Une erreur est survenue lors de l\'ajout du vol';
    }

}

// Get the logged-in user's ID
$userID = $_SESSION['user_id'];

// Prepare the SQL query with placeholders
if (isChief()) {
    // If the user is an admin, select all flights
    $sql = "SELECT * FROM flights";
    $req = $db->prepare($sql);
    $req->execute();

} else {
    // If the user is not an admin, select only flights with their ID
    $sql = "SELECT * FROM flights WHERE id_pilot = ?";
    $req = db->prepare($sql);
    $req->execute();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vols</title>
</head>
<body>
    

<div class="container">
    <h1>Vols</h1>

    <?php if (isChief()) : ?>
        <h2>Ajouter un vol au système</h2>
        <form method="post">
            <div class="form-group">
                <label for="departureDate">Date de départ</label>
                <input type="date" name="departure_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="departureHour">Heure de départ</label>
                <input type="time" name="departure_hour" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="departureAirport">Airport de départ</label>
                <input type="text" name="departure_airport" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="departureCity">Ville de départ</label>
                <input type="text" name="departure_city" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="arrivalDate">Date d'arrivée</label>
                <input type="date" name="arrival_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="arrivalHour">Heure d'arrivée</label>
                <input type="time" name="arrival_hour" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="arrivalAirport">Airport d'arrivée</label>
                <input type="text" name="arrival_airport" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="arrivalCity">Ville d'arrivée</label>
                <input type="text" name="arrival_city" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="planeID">ID avion</label>
                <input type="number" name="id_plane" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="pilotID">ID du Pilot</label>
                <input type="number" name="id_pilot" class="form-control" required>
            </div>
    <button type="submit" name="addFlight" class="btn btn-primary">Ajouter un vol</button>
    <?php endif; ?>

</div>

</body>

</html>
<?php
session_start();

require_once ('utils/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if they are not logged in
    header('Location:login.php');
    exit;
}

// Check if the logged-in user is an admin
if (!isChief()) {
    // Redirect the user to the home page if they are not an admin
    header('Location: home.php');
    exit;
}

if (isset($_POST['name']) && isset($_POST['description'])) {
    $sql = "INSERT INTO articles (name, description, date) VALUES (:name, :description, :date)";
    $req = $db->prepare($sql); 

    $req->bindValue(':name', $_POST['name']);
    $req->bindValue(':description', $_POST['description']);
    $req->bindValue(':date', current_timestamp());

    if ($req->execute()) {
        echo '<p class="alert alert-success">publication publiée avec succès!</p>';
    } else {
        echo '<p class="alert alert-danger"> Erreur lors de l\'insertion de la publication!</p>';
    }
}

// Get all articles from the database
$sql = "SELECT * FROM articles";
$req = $db->prepare($sql);
$req->execute();
$articles = $req->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Publications</title>
</head>
<body>
    <h1>Publications</h1>

    <?php if (isChief()) : ?>
        <h2>Ajouter une nouvelle publication</h2>
        <form method="post">
            <div class="form-group">
                <label for="name">Titre</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <button type="submit" name="button" class="btn btn-primary">Ajouter </button>
        </form>
    <?php endif; ?>

    <h2>View Articles</h2>
    <?php foreach ($articles as $article) : ?>
        <h3><?php echo $article['name']; ?></h3>
        <p><?php echo $article['description']; ?></p>
        <p><?php echo $article['date']; ?></p>
    <?php endforeach; ?>

</body>
</html>



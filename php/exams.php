<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Examens</title>
</head>
<body>
	<h1>Examens</h1>
	<?php

		require_once('utils/db_connect.php');
		require('utils/functions.php');
        include('utils/header.php');

        if(isChief()) {
			// if user is an admin the add exam form appers
			echo '<h2>Add Exam</h2>';
			echo '<form method="post" action="add_exam.php">';
			echo '<label>Name:</label><br />';
			echo '<input type="text" name="name" required /><br />';
			echo '<label>Exam Date:</label><br />';
			echo '<input type="date" name="examdate" required /><br />';
			echo '<label>Validity:</label><br />';
			echo '<input type="text" name="validity" required /><br />';
			echo '<label>Expiry Date:</label><br />';
			echo '<input type="date" name="expiry_date" required /><br />';
			echo '<label>Next Exam Date:</label><br />';
			echo '<input type="date" name="next_exam_date" required /><br />';
			echo '<label>Exam Center:</label><br />';
			echo '<input type="text" name="exam_center" required /><br />';
			echo '<input type="submit" value="Add Exam" />';
			echo '</form>';

            // inserting the infos into the database
            $sql = "INSERT INTO exams (name, exam_date, validity, expiry_date, next_exam_date, exam_center)
            VALUES (:name, :examdate, :validity, :expiry_date, :next_exam_date, :exam_center)";
            $req = $db->prepare($sql);

            // Bind the form values to the parameters in the prepared statement
            $req->bindValue(':name', $_POST['name']);
            $req->bindValue(':examdate', $_POST['examdate']);
            $req->bindValue(':validity', $_POST['validity']);
            $req->bindValue(':expiry_date', $_POST['expiry_date']);
            $req->bindValue(':next_exam_date', $_POST['next_exam_date']);
            $req->bindValue(':exam_center', $_POST['exam_center']);
            if ($req->execute()) {
                echo 'L\'examen a été ajouté avec succès.';
            } else {
                echo 'Une erreur est survenue lors de l\'ajout de l\'examen.';
            }
		}
		
		// show the list of exams
		echo '<h2>Liste des examens</h2>';
		$req= $db->prepare("SELECT * FROM exams");
		$req->execute();
		if($req->rowCount()> 0) {
			echo '<table>';
			echo '<tr><th>ID</th><th>Nom de l\'examen</th><th>Date de passage </th><th>Validité</th><th>Date d\'expiration</th><th>Date de l\'examen prochain</th><th>Centre d\'examination</th></tr>';
			while($row = $req->fetch(PDO::FETCH_ASSOC)) {
				echo '<tr>';
				echo '<td>'.$row['id'].'</td>';
				echo '<td>'.$row['name'].'</td>';
				echo '<td>'.$row['exam_date'].'</td>';
				echo '<td>'.$row['validity'].'</td>';
				echo '<td>'.$row['expiry_date'].'</td>';
				echo '<td>'.$row['next_exam_date'].'</td>';
				echo '<td>'.$row['exam_center'].'</td>';
				echo '</tr>';
			}
			echo '</table>';
		} else {
			echo 'No exams found.';
		}
	?>
</body>
</html>

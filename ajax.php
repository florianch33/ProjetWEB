<?php
      include('connect.php');

      if (isset($_POST['key'])) {
      	$nom = $conn->real_escape_string($_POST['nom']);
      	$prenom = $conn->real_escape_string($_POST['prenom']);
      	$fonction = $conn->real_escape_string($_POST['fonction']);

      	if ($_POST['key'] == 'addNew') {
      		$sql = $conn->query("SELECT id FROM personnel WHERE nom = '$nom'");
      		if ($sql->num_rows > 0)
      			exit("Ce nom existe déja");
      		else {
      			$conn->query("INSERT INTO personnel (nom, prenom, fonction) VALUES ('$nom', '$prenom', '$fonction')");
      			$result = $stmt->execute();
      			exit('La personne est enregistrée');
      		}
      	}
      }
?>
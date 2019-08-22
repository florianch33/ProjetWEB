<?php
      include('connect.php');

      if (isset($_POST['key'])) {

         if ($_POST['key'] == 'getData') {

      		$sql = $conn->query("SELECT * FROM personnel LIMIT 0, 10");
      		$rows = $sql->fetchAll();
            $sql->execute();
      		$datarows = count($rows);
      		if ($datarows > 0) {
      			$response = "";
      		    while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
      		    	$response .='

      		    <tr>
                     <td>'.$data['id'].'</td>
                     <td>'.$data['nom'].'</td>
                     <td>'.$data['prenom'].'</td>
                     <td>'.$data['fonction'].'</td>
                     <td>
                     <input type="button" value="Edit" class="btn btn-primary">
                     <input type="button" value="View" class="btn btn-success">
                     <input type="button" value="Delete" class="btn btn-danger">
                     </td>
      		    </tr>

      		    ';
      		} exit ($response);
      	    } else 
      		exit('reachedMax'); 	
        }

        $nom = $conn->quote($_POST['nom']);
      	$prenom = $conn->quote($_POST['prenom']);
      	$fonction = $conn->quote($_POST['fonction']);

      	if ($_POST['key'] == 'addNew') {
      		$sql = $conn->query("SELECT id FROM personnel WHERE nom = $nom");
      		$rows = $sql->fetchAll();
      		$datarows = count($rows);
      		if ($datarows > 0)
      			exit ("Ce nom existe déja");
      		else {
      			$conn->query("INSERT INTO personnel (nom, prenom, fonction) VALUES ($nom, $prenom, $fonction)");
      			exit ("La personne est enregistrée");
      		}
      	}
      }
?>



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
                     <td id="nom_'.$data['id'].'">'.$data['nom'].'</td>
                     <td id="prenom_'.$data['id'].'">'.$data['prenom'].'</td>
                     <td id="fonction_'.$data['id'].'">'.$data['fonction'].'</td>
                     <td>
                     <input type="button" onclick="viewORedit('.$data['id'].', \'edit\')" value="Edit" class="btn btn-primary">
                     <input type="button" onclick="viewORedit('.$data['id'].', \'view\')" value="View" class="btn btn-success">
                     <input type="button" onclick="deleteRow('.$data['id'].')" value="Delete" class="btn btn-danger">
                     </td>
      		    </tr>

      		    ';
      		} exit ($response);
      	    } else 
      		exit('Trop d informations'); 	
        }


        if ($_POST['key'] == 'getRowData'){
        
          $rowID = $conn->quote($_POST['rowID']);
          $sql = $conn->query("SELECT nom, prenom, fonction FROM personnel WHERE id = $rowID");
          $data = $sql->fetch(PDO::FETCH_ASSOC);
          $jsonArray = array(
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'fonction' => $data['fonction'],
          );
          exit(json_encode($jsonArray));
        }

        $nom = $conn->quote($_POST['nom']);
        $prenom = $conn->quote($_POST['prenom']);
        $fonction = $conn->quote($_POST['fonction']);
        $rowID = $conn->quote($_POST['rowID']);

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


        if ($_POST['key'] == 'updateRow') {
         $sql = $conn->query("UPDATE personnel SET nom = $nom, prenom = $prenom, fonction = $fonction WHERE id = $rowID");
         exit("Modification effectuée");
      }

        if($_POST['key'] == 'deleteRow'){
         $sql = $conn->query("DELETE FROM personnel WHERE id = $rowID");
         exit ("Les informations ont étaient supprimées");
        }

   }
?>
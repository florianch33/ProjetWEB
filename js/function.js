function manageData(key) {
	var nom = $("#nom");
	var prenom = $("#prenom");
	var fonction = $("#fonction");
    var editRowID = $("#editRowID");

	if (isNotEmpty(nom) && isNotEmpty(prenom) && isNotEmpty(fonction)) {
		$.ajax({
            url: 'ajax.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: key,
                nom: nom.val(),
                prenom: prenom.val(),
                fonction: fonction.val(),
                rowID: editRowID.val()
            }, success: function (response) {	
              if (response != "success")
                alert(response);
              else {
                $("$nom_"+editRowID.val()).html(nom.val());
                nom.val('');
                prenom.val('');
                fonction.val('');
                $("#tableManager").modal('hide');
                $("#manageBtn").attr('value', 'Add').attr('onclick', "manageData('addNew')");

              }
            }
        });
	}    
}


function viewORedit(rowID, type){
        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            dataType: 'json',
            data: {
                key: 'getRowData',
                rowID: rowID
            }, success: function (response) { 
              if(type == "view"){
                $("#showContent").fadeIn();
                $("#editContent").fadeOut();
                $("#nomView").html(response.nom);
                $("#prenomView").html(response.prenom);
                $("#fonctionView").html(response.fonction);
                $("#manageBtn").fadeOut();
                $("#closeBtn").fadeIn();
              } else {
                $("#editContent").fadeIn();
                $("#showContent").fadeOut();
                $("#editRowID").val(rowID);
                $("#nom").val(response.nom);
                $("#prenom").val(response.prenom);
                $("#fonction").val(response.fonction);
                $("#closeBtn").fadeOut();
                $("#manageBtn").attr('value', 'Informations modifiées').attr('onclick',"manageData('updateRow')");

              } 
              $(".modal-title").html(response.nom);
              $("#tableManager").modal('show');
           }
        });  
}

function deleteRow(rowID){
        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: 'deleteRow',
                rowID: rowID,
            }, success: function (response) {   
                $("#nom_"+rowID).parent().remove();
                alert(response);
            }
        });  
}

function getData(start, limit){
		$.ajax({
            url: 'ajax.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: 'getData',
                start: start,
                limit: limit
            }, success: function (response) {	
              if (response != "Trop d informations"){
            	$('tbody').append(response);
            }
           }
        });  
}

function isNotEmpty(caller) {
	if (caller.val() == '') {
		caller.css('border', '1px solid red');
		return false;
	}else
	    caller.css('border', '');

	return true;
}

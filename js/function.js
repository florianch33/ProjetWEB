function manageData(key) {
	var nom = $("#nom");
	var prenom = $("#prenom");
	var fonction = $("#fonction");

	if (isNotEmpty(nom) && isNotEmpty(prenom) && isNotEmpty(fonction)) {
		$.ajax({
            url: 'ajax.php',
            method: 'POST',
            dataType: 'text',
            date: {
                key: key,
                nom: nom.val(),
                prenom: prenom.val(),
                fonction: fonction.val()
            }, success: function (response) {	
            }

        });
	}    
}

function isNotEmpty(caller) {
	if (caller.val() == '') {
		caller.css('border', '1px solid red');
		return false;
	}else
	    caller.css('border', '');

	return true;
}
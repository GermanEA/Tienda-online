window.addEventListener('load', loadAjaxSearch, false);

function loadAjaxSearch(){
    ajaxSearchAdmin();
    ajaxSearchDate();
    ajaxSearchDateDelivery();
}

function ajaxSearchAdmin(){
	$('#saleSearch').keyup(function(e) {
		var search = $(this).val();
		$.ajax({
			url: '../models/ajax-sale-search.php',
			type: 'POST',
			data: {'search': search},
			beforeSend: function(){

			}
		})
		.done(function(resultado) {
            $('#resultAjax').html(resultado);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			if ($('#saleSearch').val() == "") {
				$('#resultAjax').html("");
			}
        });
		
    });
}

function ajaxSearchDate(){
	$('#dateSearch').change(function(e) {
		var search = $(this).val();
		$.ajax({
			url: '../models/ajax-date-search.php',
			type: 'POST',
			data: {'search': search},
			beforeSend: function(){

			}
		})
		.done(function(resultado) {
            $('#resultAjax').html(resultado);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			if ($('#dateSearch').val() == "") {
				$('#resultAjax').html("");
			}
        });
		
    });
}

function ajaxSearchDateDelivery(){
	$('#dateSearchDelivery').change(function(e) {
		var search = $(this).val();
		$.ajax({
			url: '../models/ajax-date-delivery.php',
			type: 'POST',
			data: {'search': search},
			beforeSend: function(){

			}
		})
		.done(function(resultado) {
            $('#resultAjax').html(resultado);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			if ($('#dateSearchDelivery').val() == "") {
				$('#resultAjax').html("");
			}
        });
		
    });
}
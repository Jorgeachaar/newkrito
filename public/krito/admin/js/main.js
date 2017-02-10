$(document).ready(function() {
	
	$('.btn-order-detail').on('click', function(e) {
		e.preventDefault();
		
		var order_id = $(this).data('id');
		var path = $(this).data('path');
		var token = $(this).data('token');
		var modal_title = $('.modal-title');
		var modal_body = $('modal-body');
		var loading = '<p><i class="fa fa-circle-o-notch fa-spin"></i> Loading </p>';
		var table = $('#table-order-detail tbody');
		var data = {'_token' : token, 'order_id' : order_id};

		modal_title.html("Detalle de pedido: " + order_id);
		table.html(loading);

		$.post(
			path, 
			data, 
			function(data) {
				table.html("");
				console.log(data);
				for (var i = 0; i < data.length; i++) {
					
					var quantity = parseInt(data[i].quantity); 
					var price = parseFloat(data[i].price).toFixed(2);
					var total = (parseFloat(data[i].price)*parseFloat(data[i].quantity)).toFixed(2);
					var product = data[i].product.desc;
					
					var fila = '<tr>';
					fila += '<td>' + product + '</td>';
					fila += '<td>' + price + '</td>';
					fila += '<td>' + quantity + '</td>';
					fila += '<td>' + total + '</td>';
					fila += '</tr>';

					table.append(fila);
				};
			   console.log(response);
		    },
		    'json'
		);

	});
});
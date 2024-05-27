$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;
			});
		} else{
			checkbox.each(function(){
				this.checked = false;
			});
		}
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
    // belom jalan
    // $('.edit').click(function() {
    //     // Get the id, route, and token
    //     var id = $(this).data('id');
    //     var route = $(this).data('route');
    //     var token = $('meta[name="csrf-token"]').attr('content');

    //     // Create a JSON object
    //     var dataToSend = {
    //         id: id,
    //         _token: token
    //     };

    //     // Alert the JSON data for debugging
    //     alert(JSON.stringify(dataToSend));

    //     // Perform the AJAX request
    //     $.ajax({
    //         url: route,
    //         type: "POST",
    //         data: dataToSend,
    //         success: function(response) {
    //             location.reload();
    //         },
    //         error: function(xhr) {
    //             console.log(xhr);
    //             // Handle errors
    //         }
    //     });
    // });


});


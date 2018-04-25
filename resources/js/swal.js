if (message == "success") {
	swal('Item added successfully', '', 'success');
}
else if (message == "failed") {
	swal("Unable to add item. Please make sure your inputs are numbers", "", "warning");
}
else if(message == "deleteSuccess") {
	swal("Item deleted successfully", " ", "success");
}
else if(message == "deleteFailed") {
	swal("Failed to delete item", "", 'warning');
}

if (lift != null) {
	$('#chooseLiftToDisplay').val(lift).change();
	displayLift = lift; 
}
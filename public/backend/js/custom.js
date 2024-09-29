$(document).ready(function(){
	// Check Admin Password is correct or not
	$("#current_password").keyup(function(){
		var current_password = $("#current_password").val();
		/*alert(current_password);*/
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type:'post',
			url:'/backend/check-admin-password',
			data:{current_password:current_password},
			success:function(resp){
				if(resp=="false"){
					$("#check_password").html("<font color='red'>Current Password is Incorrect!</font>");
				}else if(resp=="true"){
					$("#check_password").html("<font color='green'>Current Password is Correct!</font>");
				}
			},error:function(){
				alert('Error');
			}
		});
	})
});


const csrfToken = '{{ csrf_token() }}';
// Datatable Data Load
function loadDataTable(tableId, ajaxUrl, columns) {
    $(document).ready(function() {
        $('#' + tableId).DataTable({
            processing: true,
            serverSide: true,
            ajax: ajaxUrl,
            columns: columns,
            responsive: true
        });
    });
}

// Datatable Data delete
function deleteOperation(routeName, row_id, tableId) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(routeName.replace(':id', row_id), {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }).then(response => {
                Swal.fire({
                    icon: "success",
                    title: response.data.message,
                });
                $('#' + tableId).DataTable().ajax.reload(); // Reload the DataTable after delete
            }).catch(error => {
                Swal.fire(
                    'Error!',
                    'There was an issue with deleting the data',
                    'error'
                );
            });
        }
    });
}

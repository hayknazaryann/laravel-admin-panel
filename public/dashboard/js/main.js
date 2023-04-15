$(document)
    .on('click', '.delete', function (e) {
        e.preventDefault();
        let _this = $(this),
            type = $(_this).attr('data-type');

        Swal.fire({
            text: 'Are you sure you want to delete ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then(result => {
            if (result?.value) {
                _this.parent('form').submit();
            }
        })
    })

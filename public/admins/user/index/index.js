function actionDelete(e) {
    e.preventDefault()
    let urlRequest = $(this).data('url')
    let self = $(this)
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: urlRequest,
                type: 'GET',
                success: result => {
                    if (result.code == 200){
                        self.parent().parent().remove()
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                },
                error: e => {
                    Swal.fire(
                        'Delete Failed!',
                        'Your file hasn\'t been deleted.',
                        'fail'
                    )
                }
            })
        }
    })
}

$(function () {
    $(document).on('click', '.action_delete', actionDelete)
})

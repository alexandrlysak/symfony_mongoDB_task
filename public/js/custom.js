function deletePost(id)
{
    jQuery('#deletedPostId').val(id);
    jQuery('#deletePostConfirmModal').modal('show');
}

function deletePostData()
{
    var id = jQuery('#deletedPostId').val();
    jQuery.ajax({
        url: '/dashboard/post/delete',
        type: 'POST',
        dataType: 'JSON',
        data: {
            id: id
        },
        success: function(response) {
            if (response.code === 0) {
                alert(response.message);
            } else if (response.code === 1) {
                jQuery('#post_'+id).fadeOut();
                jQuery('#deletePostConfirmModal').modal('hide');
            }
        },
        error: function(response) {
            alert('Operation Error !!!');
        }
    });
}



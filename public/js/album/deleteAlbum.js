$(document).on("click", ".delete_btn", function (e) {
    e.preventDefault();

    var album_id = $(this).attr("album_id");
    // Ask the user for confirmation and get their choice
    var choice = confirm(
        "Do you want to move all images to another album before deleting this album? Press OK to move images or Cancel to delete without moving."
    );

    if (choice) {
        $.ajax({
            type: "DELETE",
            url: "{{ route('albums.destroy', ':id') }}".replace(
                ":id",
                album_id
            ),
            data: {
                _token: "{{ csrf_token() }}",
                id: album_id,
                targetAlbumId: 1,
            },
            success: function (data) {
                if (data.status == true) {
                    $("#success_msg").show();
                }

                $(".AlbumRow" + data.id).remove();
            },
            error: function (reject) {
                // Handle error
            },
        });
    } else {
        // If the user chooses to delete the album without moving images
        $.ajax({
            type: "DELETE",
            url: "{{ route('albums.destroy', ':id') }}".replace(
                ":id",
                album_id
            ),
            data: {
                _token: "{{ csrf_token() }}",
                id: album_id,
            },
            success: function (data) {
                if (data.status == true) {
                    $("#success_msg").show();
                }

                $(".AlbumRow" + data.id).remove();
            },
            error: function (reject) {
                // Handle error
            },
        });
    }
});

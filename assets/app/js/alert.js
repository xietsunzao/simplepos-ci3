$("body").on("click", ".btn-danger", function (e) {
    e.preventDefault();
    var targetUrl = $(this).attr("href");
    var id = $(this).attr("data-id");
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang dihapus tidak bisa dikembalikan lagi!",
        type: 'warning',
        width: 500,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.value) {
            var postData = {};
            postData["id"] = id;
            $.post(targetUrl, postData, function (result) {
                Swal.fire(
                    "dihapus",
                    "Data berhasil dihapus!",
                    "success",
                ).then(function(){
                    location.reload();
                });
            });
        }
    });
});

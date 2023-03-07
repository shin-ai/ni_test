$(function () {
  $(".tombolTambahData").on("click", function () {
    $("#judulModalLabel").html("Tambah Data Barang");
    $(".modal-footer button[type=submit]").html("Tambah data");
    $("#gambarOld").val("");
    $("#gambarPreview").attr("src", "");
    $("#nama-barang").val("");
    $("#harga-beli").val("");
    $("#harga-jual").val("");
    $("#stok").val("");
  });

  $(".tampilModalUbah").on("click", function () {
    $("#judulModalLabel").html("Ubah Data Barang");
    $(".modal-footer button[type=submit]").html("Ubah data");
    $(".modal-body form").attr(
      "action",
      "http://localhost:8080/web-project/ni-test/public/barang/ubah"
    );

    const id = $(this).data("id");

    $.ajax({
      url: "http://localhost:8080/web-project/ni-test/public/barang/getubah",
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#gambarOld").val(data.gambar);
        $("#gambarPreview").attr(
          "src",
          "http://localhost:8080/web-project/ni-test/public/img/" + data.gambar
        );
        $("#nama-barang").val(data.nama_barang);
        $("#harga-beli").val(data.harga_beli);
        $("#harga-jual").val(data.harga_jual);
        $("#stok").val(data.stok);
        $("#id").val(data.id);
      },
    });
  });
});

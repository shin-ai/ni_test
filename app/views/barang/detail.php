<div class="container mt-3">
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= BASEURL; ?>/img/<?= $data['barang']['gambar']; ?>" class="img-fluid rounded-start" alt="<?= $data['barang']['gambar']; ?>">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $data['barang']['nama_barang']; ?></h5>
                    <p class="card-text"><?= $data['barang']['harga_beli']; ?></p>
                    <p class="card-text"><?= $data['barang']['harga_jual']; ?></p>
                    <p class="card-text"><?= $data['barang']['stok']; ?></p>
                    <a href="<?= BASEURL; ?>/buku" class="card-link">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
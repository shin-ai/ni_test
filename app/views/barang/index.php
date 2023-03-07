<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>


    <div class="row mb-3 justify-content-between">
        <div class="col-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary tombolTambahData" data-bs-toggle="modal" data-bs-target="#forModal">
                Tambah Data Barang
            </button>
        </div>
        <div class="col-lg-6">
            <form action="<?= BASEURL; ?>/barang/cari" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Barang" name="keyword" id="keyword" autocomplete="off">
                    <div class="input-group-append ms-1">
                        <button class="btn btn-primary" type="submit" id="tombolCari">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h3>Daftar Barang</h3>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga Beli</th>
                                <th scope="col">Harga Jual</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $k = 1; ?>
                            <?php foreach ($data['barang'] as $barang) : ?>
                                <tr>
                                    <th scope="row"><?= $k; ?></th>
                                    <td>
                                        <img src="<?= BASEURL; ?>/img/<?= $barang['gambar'] ?>" alt="" width=50>
                                    </td>
                                    <td><?= $barang['nama_barang'] ?></td>
                                    <td><?= $barang['harga_beli'] ?></td>
                                    <td><?= $barang['harga_jual'] ?></td>
                                    <td><?= $barang['stok'] ?></td>
                                    <td>
                                        <div>
                                            <a class="badge bg-primary" href="<?= BASEURL; ?>/barang/detail/<?= $barang['id']; ?>">detail</a>
                                            <a class="badge bg-success tampilModalUbah" href="<?= BASEURL; ?>/barang/ubah/<?= $barang['id']; ?>" data-bs-toggle="modal" data-bs-target="#forModal" data-id="<?= $barang['id']; ?>">ubah</a>
                                            <a class="badge bg-danger" href="<?= BASEURL; ?>/barang/hapus/<?= $barang['id']; ?>" onclick="return confirm('Yakin?')">hapus</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $k++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </li>
            </ul>
            <div class="my-2 d-flex justify-content-end" id="pagination">
                <?php for ($i = 1; $i <= $data['pages']; $i++) : ?>
                    <?php if ($i == $data['currentPage']) : ?>
                        <a class="btn btn-primary active" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    <?php else : ?>
                        <a class="btn btn-primary mx-2" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="forModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModalLabel">Tambah Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>/barang/tambah" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="gambarOld" id="gambarOld">
                    <div class="mb-3">
                        <img id="gambarPreview" src="" alt="" width="60"><br>
                        <label for="gambar" class="form-label">Input File Gambar</label>
                        <input name="gambar" class="form-control" type="file" id="gambar" onchange="previewImage()">
                    </div>
                    <div class="mb-3">
                        <label for="nama-barang" class="form-label">Input Nama Barang</label>
                        <input name="nama_barang" type="text" class="form-control" id="nama-barang" placeholder="Input Nama Barang">
                    </div>
                    <div class="mb-3">
                        <label for="harga-beli" class="form-label">Input Harga Beli</label>
                        <input name="harga_beli" type="number" class="form-control" id="harga-beli" placeholder="100000">
                    </div>
                    <div class="mb-3">
                        <label for="harga-jual" class="form-label">Input Harga Jual</label>
                        <input name="harga_jual" type="numer" class="form-control" id="harga-jual" placeholder="100000">
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Input Stok</label>
                        <input name="stok" type="number" class="form-control" id="stok" placeholder="10">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
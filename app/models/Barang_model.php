<?php

class Barang_model
{
    private $table = 'barang';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllBarang()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getBarangById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function tambahDataBarang($data)
    {
        //upload
        $gambar = $this->uploadGambar();

        if (!$gambar) {
            return false;
        }

        $query = "INSERT INTO barang
                    VALUES
                (Null, :gambar, :nama_barang, :harga_beli, :harga_jual, :stok)";
        $this->db->query($query);
        $this->db->bind('gambar', $gambar);
        $this->db->bind('nama_barang', $data['nama_barang']);
        $this->db->bind('harga_beli', $data['harga_beli'], PDO::PARAM_INT);
        $this->db->bind('harga_jual', $data['harga_jual'], PDO::PARAM_INT);
        $this->db->bind('stok', $data['stok'], PDO::PARAM_INT);
    }
    public function hapusDataBarang($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataBarang($data)
    {
        //upload
        $oldGambar = $data['gambar'];

        $gambar_new = $_FILES['gambar']['name'];

        if ($gambar_new != "") {
            $gambar = $this->uploadGambar();
            $query = "UPDATE barang SET
                    gambar = :gambar,
                    nama_barang = :nama_barang,
                    harga_beli = :harga_beli,
                    harga_jual = :harga_jual,
                    stok = :stok
                WHERE id = :id";
            $this->db->query($query);
            $this->db->bind('gambar', $gambar);
            $this->db->bind('nama_barang', $data['nama_barang']);
            $this->db->bind('harga_beli', $data['harga_beli']);
            $this->db->bind('harga_jual', $data['harga_jual']);
            $this->db->bind('stok', $data['stok']);
            $this->db->bind('id', $data['id']);
            $this->db->execute();
            return $this->db->rowCount();
        } else {
            $query = "UPDATE barang SET
                        gambar = :gambar,
                        nama_barang = :nama_barang,
                        harga_beli = :harga_beli,
                        harga_jual = :harga_jual,
                        stok = :stok
                    WHERE id = :id";
            $this->db->query($query);
            $this->db->bind('gambar', $data['gambarOld']);
            $this->db->bind('nama_barang', $data['nama_barang']);
            $this->db->bind('harga_beli', $data['harga_beli']);
            $this->db->bind('harga_jual', $data['harga_jual']);
            $this->db->bind('stok', $data['stok']);
            $this->db->bind('id', $data['id']);

            $this->db->execute();
            return $this->db->rowCount();
        }
    }

    public function uploadGambar()
    {
        $errorGambar = $_FILES["gambar"]["error"];

        $namaGambar = $_FILES["gambar"]["name"];
        $ukuranGambar = $_FILES["gambar"]["size"];
        $tmpNameGambar = $_FILES["gambar"]["tmp_name"];

        //cek apakah tidak ada gambar yg diupload
        if ($errorGambar === 4) {
            echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
            return false;
        }

        //cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['jpg', 'png'];
        $ekstensiGambar = explode('.', $namaGambar);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "
            <script>
                alert('Yang anda upload bukan gambar!');
            </script>
        ";
            return false;
        }

        //cek jika ukuran gambar terlalu besar
        if ($ukuranGambar > 1000000) {
            echo "
            <script>
                alert('ukuran gambar terlalu besar');
            </script>
        ";
        }

        //lolos pengecekan, gambar siap diupload
        //generate nama gambar baru
        $namaGambarBaru = uniqid();
        $namaGambarBaru .= ".";
        $namaGambarBaru .= $ekstensiGambar;

        move_uploaded_file($tmpNameGambar, 'img/' . $namaGambarBaru);

        return $namaGambarBaru;
    }
    public function cariDataBarang($limit, $offset)
    {
        $keyword = "";
        if (!empty($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
        }
        $query = "SELECT * FROM " . $this->table . " WHERE nama_barang LIKE :keyword LIMIT :limit OFFSET :offset";
        $this->db->query($query);
        $this->db->bind(':keyword', "%$keyword%", PDO::PARAM_STR);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }
    public function getData($offset, $limit)
    {
        $sql = "SELECT * FROM barang LIMIT :offset, :limit";
        $this->db->query($sql);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        $this->db->execute();
        return $this->db->resultSet();
    }
    public function getTotalData()
    {
        $sql = "SELECT COUNT(*) AS total FROM " . $this->table;
        $this->db->query($sql);
        $this->db->execute();
        $row = $this->db->single();
        return $row['total'];
    }
}

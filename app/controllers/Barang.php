<?php

class Barang extends Controller
{
    public function index($page = 1)
    {
        $limit = 1;
        $url = $_SERVER['REQUEST_URI'];
        $query_string = parse_url($url, PHP_URL_QUERY);
        parse_str($query_string, $params);
        $page = isset($params['page']) ? $params['page'] : $page;
        
        $offset = ($page - 1) * $limit;

        $data['judul'] = 'Daftar Barang';
        $data['barang'] = $this->model('Barang_model')->getData($offset, $limit);
        $data['totalItems'] = $this->model('Barang_model')->getTotalData();
        $data['pages'] = ceil($data['totalItems'] / $limit);
        $data['currentPage'] = $page;
        $this->view('templates/header', $data);
        $this->view('barang/index', $data);
        $this->view('templates/footer');
    }
    public function detail($id)
    {
        $data['judul'] = 'Detail Barang';
        $data['barang'] = $this->model('Barang_model')->getBarangById($id);
        $this->view('templates/header', $data);
        $this->view('barang/detail', $data);
        $this->view('templates/footer');
    }
    public function tambah()
    {
        if ($this->model('Barang_model')->tambahDataBarang($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'Ditambahkan', 'success');
            header('Location: ' . BASEURL . '/barang');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/barang');
            exit;
        }
    }
    public function hapus($id)
    {
        if ($this->model('Barang_model')->hapusDataBarang($id) > 0) {
            Flasher::setFlash('Berhasil', 'Dihapus', 'success');
            header('Location: ' . BASEURL . '/barang');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Dihapus', 'danger');
            header('Location: ' . BASEURL . '/barang');
            exit;
        }
    }
    public function getubah()
    {
        echo json_encode($this->model('Barang_model')->getBarangById($_POST['id']));
    }
    public function ubah()
    {
        if ($this->model('Barang_model')->ubahDataBarang($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'Diubah', 'success');
            header('Location: ' . BASEURL . '/barang');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Diubah', 'danger');
            header('Location: ' . BASEURL . '/barang');
            exit;
        }
    }
    public function cari()
    {
        $limit = 1;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $data['judul'] = 'Daftar Barang';
        $data['barang'] = $this->model('Barang_model')->cariDataBarang($limit, $offset);
        $total = $this->model('Barang_model')->getTotalData();
        $data['pages'] = ceil($total / $limit);
        $this->view('templates/header', $data);
        $this->view('barang/index', $data);
        $this->view('templates/footer');
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\modelPelanggan;
use App\Models\ProductModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pelanggan extends BaseController
{
    protected $modelpelanggan;
    
    public function __construct()
    {
        $this->modelpelanggan = new modelPelanggan();
    }

    public function index()
    {
        return view('v_pelanggan');
    }

    public function simpan_pelanggan()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_pelanggan'  => 'required',
            'alamat'         => 'required',
            'no_telp'          => 'required|integer',
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return $this->response->setJSON([
                'status'    => 'error',
                'errors'     => $validation->getErrors(),
            ]);
        }

        $data = [
            'nama_pelanggan'  => $this->request->getVar('nama_pelanggan'),
            'alamat'         => $this->request->getVar('alamat'),
            'no_telp'          => $this->request->getVar('no_telp'),
        ];

        $this->modelpelanggan->save($data);

        return $this->response->setJSON([
            'status'    => 'success',
            'message'   => 'Data pelanggan berhasil disimpan',
        ]);
    }
    public function tampil_pelanggan()
    {
        $pelanggan = $this->modelpelanggan->findAll();

        return $this->response->setJSON([
            'status'    => 'success',
            'pelanggan'   => $pelanggan
        ]);
    }
    public function hapus_pelanggan()
    {
        $id_pelanggan = $this->request->getPost('id_pelanggan');

        if ($this->modelpelanggan->delete($id_pelanggan)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Pelanggan berhasil dihapus'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menghapus pelanggan'
            ]);
        }
    }
    // public function edit($productId) {
    //     $product = $this->productmodel->getById($productId);
        
    //     if ($product) {
    //         echo json_encode(['status' => 'success', 'product' => $product]);
    //     } else {
    //         echo json_encode(['status' => 'error', 'message' => 'Produk tidak ditemukan']);
    //     }
    // }
    public function update() {
        $id_pelanggan = $this->request->getPost('id_pelanggan');
        $nama_pelanggan = $this->request->getPost('nama_pelanggan');
        $alamat = $this->request->getPost('alamat');
        $no_telp = $this->request->getPost('no_telp');

            $dataUpdate = [
                'nama_pelanggan' => $nama_pelanggan,
                'alamat' => $alamat,
                'no_telp' => $no_telp
            ];

            $updated = $this->modelpelanggan->update($id_pelanggan, $dataUpdate);

            if ($updated) {
                echo json_encode(['status' => 'success', 'message' => 'Pelanggan berhasil diupdate']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate produk']);
            }
        }

}

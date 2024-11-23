<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\HTTP\ResponseInterface;

class Product extends BaseController
{
    protected $productmodel;
    
    public function __construct()
    {
        $this->productmodel = new ProductModel();
    }

    public function index()
    {
        return view('v_product');
    }

    public function simpan_product()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_product'  => 'required',
            'harga'         => 'required|decimal',
            'stok'          => 'required|integer',
            'gambar'        => 'required',
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return $this->response->setJSON([
                'status'    => 'error',
                'errors'     => $validation->getErrors(),
            ]);
        }

        $data = [
            'nama_product'  => $this->request->getVar('nama_product'),
            'harga'         => $this->request->getVar('harga'),
            'stok'          => $this->request->getVar('stok'),
            'gambar'        => $this->request->getVar('gambar'),
        ];

        $this->productmodel->save($data);

        return $this->response->setJSON([
            'status'    => 'success',
            'message'   => 'Data product berhasil disimpan',
        ]);
    }
    public function tampil_product()
    {
        $product = $this->productmodel->findAll();

        return $this->response->setJSON([
            'status'    => 'success',
            'product'   => $product
        ]);
    }
    public function hapus_product()
    {
        $productId = $this->request->getPost('product_id');

        if ($this->productmodel->delete($productId)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Produk berhasil dihapus'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menghapus produk'
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
        $productId = $this->request->getPost('product_id');
        $namaProduct = $this->request->getPost('nama_product');
        $harga = $this->request->getPost('harga');
        $stok = $this->request->getPost('stok');

            $dataUpdate = [
                'nama_product' => $namaProduct,
                'harga' => $harga,
                'stok' => $stok
            ];

            $updated = $this->productmodel->update($productId, $dataUpdate);

            if ($updated) {
                echo json_encode(['status' => 'success', 'message' => 'Produk berhasil diupdate']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate produk']);
            }
        }

}

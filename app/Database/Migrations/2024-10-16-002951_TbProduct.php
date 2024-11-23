<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use function PHPSTORM_META\type;

class TbProduct extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "product_id" =>[
                'type'=>'int',
                'constraint'=> 11,
                'auto_increment'=> true,
                'null'=> false
            ],
            "nama_product" =>[
                'type'=> 'varchar',
                'constraint'=> 255
            ],
            "harga"=>[
                'type'=> 'decimal',
                'constraint'=> '10,2'
            ],
            "stok"=>[
                'type' => 'int',
                'constraint'=> 11
            ]
            ]
        );
        $this->forge->addPrimaryKey('product_id');
        $this->forge->createTable('tb_product');
    }

    public function down()
    {
        
    }
}

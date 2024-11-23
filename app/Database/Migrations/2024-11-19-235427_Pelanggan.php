<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id_pelanggan" =>[
                'type'=>'int',
                'constraint'=> 11,
                'auto_increment'=> true,
                'null'=> false
            ],
            "nama_pelanggan" =>[
                'type'=> 'varchar',
                'constraint'=> 255
            ],
            "alamat"=>[
                'type'=> 'varchar',
                'constraint'=> 255
            ],
            "no_telp"=>[
                'type' => 'int',
                'constraint'=> 20
            ],
            "created_at" =>[
                'type'=>'datetime',
                'null'=> false
            ],
            "updated_at" =>[
                'type'=>'datetime',
                'null'=> false
            ],
            "deleted_at" =>[
                'type'=>'datetime',
                'null'=> false
            ],
            ]
        );
        $this->forge->addPrimaryKey('id_pelanggan');
        $this->forge->createTable('pelanggan');
    }

    public function down()
    {
        
    }
}

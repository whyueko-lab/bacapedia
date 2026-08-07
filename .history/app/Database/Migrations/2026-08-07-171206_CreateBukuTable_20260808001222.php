<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBukuTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>true,
                'auto_increment'=>true
            ],

            'buku_id'=>[
                'type'=>'VARCHAR',
                'constraint'=>20
            ],

            'judul'=>[
                'type'=>'VARCHAR',
                'constraint'=>150
            ],

            'penulis'=>[
                'type'=>'VARCHAR',
                'constraint'=>100
            ],

            'penerbit'=>[
                'type'=>'VARCHAR',
                'constraint'=>100
            ],

            'kategori_id'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>true
            ],

            'stok'=>[
                'type'=>'INT',
                'constraint'=>11,
                'default'=>0
            ],

            'tahun_terbit'=>[
                'type'=>'YEAR'
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey(
            'kategori_id',
            'kategori',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('buku');
    }

    public function down()
    {
        $this->forge->dropTable('buku');
    }
}

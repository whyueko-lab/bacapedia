<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePeminjamanTable extends Migration
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

            'user_id'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>true
            ],

            'buku_id'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>true
            ],

            'tanggal_pinjam'=>[
                'type'=>'DATE'
            ],

            'tanggal_jatuh_tempo'=>[
                'type'=>'DATE'
            ],

            'tanggal_kembali'=>[
                'type'=>'DATE',
                'null'=>true
            ],

            'status'=>[
                'type'=>'ENUM',
                'constraint'=>['DIPINJAM','DIKEMBALIKAN'],
                'default'=>'DIPINJAM'
            ],

            'denda'=>[
                'type'=>'DECIMAL',
                'constraint'=>'10,2',
                'default'=>0
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey(
            'user_id',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'buku_id',
            'buku',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('peminjaman');
    }

    public function down()
    {
        //
    }
}

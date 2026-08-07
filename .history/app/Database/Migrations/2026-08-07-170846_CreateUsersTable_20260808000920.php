<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id' => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'auto_increment' => true,
        ],

        'user_id' => [
            'type'       => 'VARCHAR',
            'constraint' => 20,
        ],

        'nama' => [
            'type'       => 'VARCHAR',
            'constraint' => 100,
        ],

        'email' => [
            'type'       => 'VARCHAR',
            'constraint' => 100,
        ],

        'password' => [
            'type' => 'TEXT',
        ],

        'role' => [
            'type'       => 'ENUM',
            'constraint' => ['ADMIN', 'PETUGAS', 'ANGGOTA'],
            'default'    => 'ANGGOTA',
        ],

        'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
    ]);

    $this->forge->addKey('id', true);
    $this->forge->addUniqueKey('email');

    $this->forge->createTable('users');
}

    public function down()
    {
        //
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Login extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			],
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'created_at' => [
				'type' => 'DATETIME',
				'null' => TRUE
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'null' => TRUE
			],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('login');
	}

	public function down()
	{
		$this->forge->dropTable('login');
	}
}

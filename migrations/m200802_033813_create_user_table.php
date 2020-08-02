<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m200802_033813_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id_usuario' => $this->primaryKey(),
            'nombre' => $this->char(255),
            'apellido' => $this->char(255),
            'username' => $this->char(255)->notNull(),
            'email' => $this->char(255),
            'password' => $this->char(255),
            'nacimiento' => $this->datetime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}

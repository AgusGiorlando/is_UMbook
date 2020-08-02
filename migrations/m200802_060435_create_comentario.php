<?php

use yii\db\Migration;

/**
 * Class m200802_060435_create_comentario
 */
class m200802_060435_create_comentario extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comentario', [
            'id_comentario' => $this->primaryKey(),
            'id_usuario' => $this->char(255),
            'id_autor' => $this->integer(),
            'contenido' => $this->char(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200802_060435_create_comentario cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200802_060435_create_comentario cannot be reverted.\n";

        return false;
    }
    */
}

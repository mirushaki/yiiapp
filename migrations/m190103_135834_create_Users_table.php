<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Users`.
 */
class m190103_135834_create_Users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Users', [
            'id' => $this->primaryKey(),
            'firstName' => $this->string(50),
            'lastName' => $this->string(50),
            'eMail' => $this->string(100),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('Users');
    }
}

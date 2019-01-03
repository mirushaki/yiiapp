<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Orders`.
 * Has foreign keys to the tables:
 *
 * - `Users`
 */
class m190103_135938_create_Orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Orders', [
            'id' => $this->primaryKey(),
            'number' => $this->string(50),
            'user_id' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-Orders-user_id',
            'Orders',
            'user_id'
        );

        // add foreign key for table `Users`
        $this->addForeignKey(
            'fk-Orders-user_id',
            'Orders',
            'user_id',
            'Users',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `Users`
        $this->dropForeignKey(
            'fk-Orders-user_id',
            'Orders'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-Orders-user_id',
            'Orders'
        );

        $this->dropTable('Orders');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 * Has foreign keys to the tables:
 *
 * - `Users`
 */
class m190103_122950_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->defaultValue('sample title'),
            'content' => $this->text()
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-news-user_id',
            'news',
            'user_id'
        );

        // add foreign key for table `Users`
        $this->addForeignKey(
            'fk-news-user_id',
            'news',
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
            'fk-news-user_id',
            'news'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-news-user_id',
            'news'
        );

        $this->dropTable('news');
    }
}

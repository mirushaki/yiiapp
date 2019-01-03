<?php

use yii\db\Migration;

/**
 * Handles adding created_at_column_updated_at to table `news`.
 */
class m190103_134228_add_created_at_column_updated_at_column_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'created_at', $this->timestamp()->defaultValue(null));
        $this->addColumn('news', 'updated_at', $this->timestamp()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('news', 'created_at');
        $this->dropColumn('news', 'updated_at');
    }
}

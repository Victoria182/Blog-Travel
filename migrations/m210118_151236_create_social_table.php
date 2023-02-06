<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%social}}`.
 */
class m210118_151236_create_social_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%social}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'link' => $this->string(),
            'icon' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%social}}');
    }
}

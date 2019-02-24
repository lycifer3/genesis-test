<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%debtors}}`.
 */
class m190223_223014_create_debtors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%debtors}}', [
            'id' => $this->primaryKey()->unsigned(),
            'first_name' => $this->string(30)->notNull(),
            'last_name'  => $this->string(30)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%debtors}}');
    }
}

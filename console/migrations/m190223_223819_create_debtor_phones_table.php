<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%debtor_phones}}`.
 */
class m190223_223819_create_debtor_phones_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%debtor_phones}}', [
            'id' => $this->primaryKey()->unsigned(),
            'debtor_id' => $this->integer(11)->unsigned()->notNull(),
            'phone' => $this->string(15)->notNull()
        ]);

        $this->createIndex('debtor_id', 'debtor_phones', 'debtor_id');
        $this->addForeignKey(
            'fk-debtor_id',
            'debtor_phones',
            'debtor_id',
            'debtors',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%debtor_phones}}');
    }
}

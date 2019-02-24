<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "debtors".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 *
 * @property DebtorPhone[] $debtorPhones
 */
class Debtor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'debtors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDebtorPhones()
    {
        return $this->hasMany(DebtorPhone::class, ['debtor_id' => 'id']);
    }
}

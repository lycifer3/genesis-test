<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "debtor_phones".
 *
 * @property int $id
 * @property int $debtor_id
 * @property string $phone
 *
 * @property Debtor $debtor
 */
class DebtorPhone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'debtor_phones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['debtor_id', 'phone'], 'required'],
            [['debtor_id'], 'integer'],
            [['phone'], 'string', 'max' => 15],
            [['debtor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Debtor::class, 'targetAttribute' => ['debtor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'debtor_id' => 'Debtor ID',
            'phone' => 'Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDebtor()
    {
        return $this->hasOne(Debtor::class, ['id' => 'debtor_id']);
    }
}

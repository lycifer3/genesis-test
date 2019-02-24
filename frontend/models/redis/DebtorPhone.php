<?php

namespace frontend\models\redis;

use \yii\redis\ActiveRecord;

/**
 * Class DebtorPhone
 *
 * @property integer $id
 * @property integer $debtor_id
 * @property string $phone
 *
 * @property Debtor $debtor
 *
 * @package frontend\models
 */
class DebtorPhone extends ActiveRecord
{
    /**
     * @return array
     */
    public function attributes()
    {
        return ['id', 'debtor_id', 'phone'];
    }

    /**
     * @return \yii\db\ActiveQueryInterface
     */
    public function getDebtor()
    {
        return $this->hasOne(Debtor::class, ['id' => 'debtor_id']);
    }

    /**
     * @param $phones
     * @param Debtor $debtor
     * @return array|ActiveRecord[]
     */
    public static function savePhones($phones, Debtor $debtor)
    {
        foreach ($phones as $phone) {
            $model = new self();
            $model->debtor_id = $debtor->id;
            $model->phone = $phone;
            $model->save();
        }

        return self::find()->where(['debtor_id' => $debtor->id])->all();
    }

}
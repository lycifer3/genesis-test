<?php

namespace frontend\models\redis;

use frontend\jobs\debtor\SaveDebtorJob;
use \yii\redis\ActiveRecord;

/**
 * Class DebtorModel
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 *
 * @property DebtorPhone $debtorPhones
 *
 * @package frontend\models
 */
class Debtor extends ActiveRecord
{
    /**
     * @return array
     */
    public function attributes()
    {
        return ['id', 'first_name', 'last_name'];
    }

    /**
     * @return \yii\db\ActiveQueryInterface
     */
    public function getDebtorPhones()
    {
        return $this->hasMany(DebtorPhone::class, ['debtor_id' => 'id']);
    }

    /**
     * Save debtor
     *
     * @param $post
     * @return Debtor
     */
    public static function saveDebtor($post)
    {
        $model = new self();
        $model->first_name = $post['first_name'];
        $model->last_name = $post['last_name'];
        $model->save();

        $phones = DebtorPhone::savePhones($post['phone_numbers'], $model);

        self::saveDebtorJob($model, $phones);

        return $model;
    }

    /**
     * Add job for save debtor to bd
     * @param $debtor
     */
    public static function saveDebtorJob($debtor, $phones)
    {
        \Yii::$app->queue->push(new SaveDebtorJob($debtor, $phones));
    }
}
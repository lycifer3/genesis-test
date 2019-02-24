<?php

namespace frontend\jobs\debtor;

use common\models\Debtor as activeDebtor;
use common\models\DebtorPhone;
use yii\queue\JobInterface;
use \frontend\models\redis\Debtor as redisDebtor;
use Yii;

/**
 * Class SaveDebtorJob
 * @package frontend\jobs\debtor
 */
class SaveDebtorJob implements JobInterface
{
    /** @var redisDebtor $debtor */
    public $debtor;
    public $phones;

    /**
     * SaveDebtorJob constructor.
     * @param array $params
     */
    public function __construct(redisDebtor $debtor, $phones)
    {
        $this->debtor = $debtor;
        $this->phones = $phones;
    }

    /**
     * @param \yii\queue\Queue $queue
     * @return mixed|void
     * @throws \yii\db\Exception
     * @throws \yii\db\StaleObjectException
     */
    public function execute($queue)
    {
        $activeDebtor = new activeDebtor();
        $activePhone = new DebtorPhone();
        $activeDebtor->first_name = $this->debtor->first_name;
        $activeDebtor->last_name = $this->debtor->last_name;
        $activeDebtor->save();

        $phoneRows = [];
        foreach ($this->phones as $key => $phone) {
            $phoneRows[$key] = [
                $activeDebtor->id,
                $phone['phone']
            ];
        }

        Yii::$app->db->createCommand()->batchInsert(
            DebtorPhone::tableName(),
            ['debtor_id', 'phone'],
            $phoneRows
        )->execute();

        $activePhone::deleteAll(['debtor_id' => $this->debtor->id]);
        $this->debtor->delete();
    }
}
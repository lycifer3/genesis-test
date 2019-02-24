<?php

namespace frontend\controllers;

use frontend\models\redis\Debtor;
use yii\web\Response;

/**
 * Class UserController
 * @package frontend\controllers
 */
class UserController extends BaseController
{
    /**
     * @var string
     */
    public $modelClass = \frontend\models\Debtor::class;

    /**
     * @return array
     */
    public function actionDebtor()
    {
        $data = \Yii::$app->request->post();
        $debtor = Debtor::saveDebtor($data);

        \Yii::$app->response->format = Response::FORMAT_JSON;

        return array_merge($debtor->toArray(), ['phone_numbers' => $debtor->debtorPhones]);
    }
}
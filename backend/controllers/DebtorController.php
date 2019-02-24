<?php

namespace backend\controllers;

use Yii;
use common\models\Debtor;
use backend\models\SearchDebtor;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DebtorController implements the CRUD actions for Debtor model.
 */
class DebtorController extends Controller
{
    /**
     * Lists all Debtor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchDebtor();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

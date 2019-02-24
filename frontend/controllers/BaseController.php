<?php

namespace frontend\controllers;

use yii\rest\ActiveController;

class BaseController extends ActiveController {
    public $enableCsrfValidation = false;

    public function actions() {
        $actions = parent::actions();

        unset($actions['update']);
        unset($actions['create']);
        unset($actions['delete']);
        unset($actions['index']);
        unset($actions['view']);

        return $actions;
    }

    /**
     * @return null|\yii\web\IdentityInterface
     */
    public function getUser() {
        return \Yii::$app->user->identity;
    }

    /**
     * @return int|string
     */
    public function getAuthId() {
        return \Yii::$app->user->getId();
    }

    public function di($class) {
        return \Yii::$container->get($class);
    }
}
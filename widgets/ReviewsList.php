<?php

namespace pantera\reviews\widgets;

use pantera\reviews\models\ReviewSearch;
use yii\base\Widget;
use yii\db\ActiveRecord;

class ReviewsList extends Widget
{
    /** @var ActiveRecord */
    public $model;

    public function run()
    {
        parent::run();
        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->getQueryParams());
        $dataProvider->query->andWhere([
            'model_class' => $this->model::className(),
            'model_id' => $this->model->getPrimaryKey(),
        ]);

        return $this->render('reviews-list', [
            'dataProvider' => $dataProvider,
            'model' => $this->model,
        ]);
    }
}

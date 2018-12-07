<?php

namespace pantera\reviews\widgets;

use pantera\reviews\models\ReviewSearch;
use yii\base\Widget;
use yii\db\ActiveRecord;

class LatestReviews extends Widget
{
    /** @var ActiveRecord */
    public $model;

    public function run()
    {
        parent::run();
        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->getQueryParams());
        $dataProvider->pagination = false;
        $dataProvider->query->andWhere([
            'model_class' => get_class($this->model),
            'model_id' => $this->model->getPrimaryKey(),
        ]);
        $dataProvider->query->limit(2);
        /** @noinspection MissedViewInspection */
        return $this->render('latest-reviews', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function init()
    {
        parent::init();
        ReviewsAsset::register($this->view);
    }
}

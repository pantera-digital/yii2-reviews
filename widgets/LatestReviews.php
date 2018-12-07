<?php

namespace pantera\reviews\widgets;

use pantera\reviews\widgets\models\ReviewSearch;
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
        $dataProvider = $searchModel->search($this->model);
        $dataProvider->sort = false;
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

<?php

namespace pantera\reviews\widgets;

use pantera\reviews\models\ReviewMetric;
use pantera\reviews\models\ReviewMetricType;
use pantera\reviews\models\ReviewSearchWidget;
use Yii;
use yii\base\Widget;
use yii\db\ActiveRecord;

class ReviewsList extends Widget
{
    /** @var ActiveRecord */
    public $model;

    public function run()
    {
        parent::run();
        $searchModel = new ReviewSearchWidget([
            'sort' => Yii::$app->request->getQueryParam('reviews_sort'),
        ]);
        $dataProvider = $searchModel->search($this->model);
        $averageRating = ReviewMetric::find()
            ->joinWith(['type', 'review'])
            ->andWhere([
                'model_class' => get_class($this->model),
                'model_id' => $this->model->getPrimaryKey()
            ])
            ->andWhere(['type' => ReviewMetricType::TYPE_RATING])
            ->average('value') ?: 0;
        /** @noinspection MissedViewInspection */
        return $this->render('reviews-list', [
            'dataProvider' => $dataProvider,
            'model' => $this->model,
            'averageRating' => $averageRating,
        ]);
    }

    public function init()
    {
        parent::init();
        ReviewsAsset::register($this->view);
    }
}

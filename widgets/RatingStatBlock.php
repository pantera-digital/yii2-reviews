<?php

namespace pantera\reviews\widgets;

use pantera\reviews\models\Review;
use pantera\reviews\models\ReviewMetric;
use pantera\reviews\models\ReviewMetricType;
use yii\base\Widget;
use yii\db\ActiveRecord;

class RatingStatBlock extends Widget
{
    /** @var ActiveRecord */
    public $model;

    public function run()
    {
        parent::run();
        $ratingStat = ReviewMetric::find()
            ->joinWith(['review', 'type'])
            ->select('avg(value) as avg_value, ' . ReviewMetricType::tableName() . '.name as name')
            ->andWhere([
                'model_class' => get_class($this->model),
                'model_id' => $this->model->getPrimaryKey(),
                'type' => ReviewMetricType::TYPE_RATING
            ])
            ->groupBy(ReviewMetricType::tableName() . '.id')
            ->asArray()
            ->createCommand()
            ->queryAll();
        $count = Review::find()
            ->andWhere([
                'model_class' => get_class($this->model),
                'model_id' => $this->model->getPrimaryKey(),
            ])->count() ?: 0;
        /** @noinspection MissedViewInspection */
        return $this->render('rating-stat-block', [
            'ratingStat' => $ratingStat,
            'count' => $count
        ]);
    }
}

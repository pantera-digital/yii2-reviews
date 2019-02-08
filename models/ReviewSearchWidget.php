<?php

namespace pantera\reviews\models;

use pantera\reviews\models\Review;
use pantera\reviews\models\ReviewMetricType;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class ReviewSearchWidget extends Review
{
    public $sort = null;

    public $defaultSort = 'date';

    public $sortModes = [
        'date'       => 'created_at DESC',
        'date_asc'   => 'created_at',
        'rating'     => 'avg(value) DESC',
        'rating_asc' => 'avg(value)',
        'likes'      => 'likes DESC',
        'likes_asc'  => 'likes',
    ];

    /**
     * @param ActiveRecord $model
     * @return ActiveDataProvider
     */
    public function search(ActiveRecord $model)
    {
        $query = Review::find()
            ->isActive()
            ->andWhere([
                'model_class' => get_class($model),
                'model_id' => $model->getPrimaryKey(),
            ])
            ->joinWith(['reviewMetrics', 'reviewMetrics.type'])
            ->andWhere([
                'type' => ReviewMetricType::TYPE_RATING
            ])
            ->groupBy('review_id')
            ->orderBy($this->sortModes[$this->sort ?: $this->defaultSort]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
    }
}

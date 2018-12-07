<?php

namespace pantera\reviews\widgets\models;

use pantera\reviews\models\Review;
use pantera\reviews\models\ReviewMetricType;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class ReviewSearch extends Review
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }


    /**
     * @param ActiveRecord $model
     * @return ActiveDataProvider
     */
    public function search(ActiveRecord $model)
    {
        $query = Review::find()->andWhere([
            'model_class' => get_class($model),
            'model_id' => $model->getPrimaryKey(),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
        switch (Yii::$app->request->getQueryParam('reviews_sort')) {
            case 'date':
                $dataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];
                break;
            case 'rating':
                $query->joinWith(['reviewMetrics', 'reviewMetrics.type'])
                    ->andWhere([
                        'type' => ReviewMetricType::TYPE_RATING
                    ])
                    ->groupBy('review_id')
                    ->orderBy('avg(value) DESC');
                break;
            case 'likes':
                $dataProvider->sort->defaultOrder = ['likes' => SORT_DESC];
                break;
            case 'date_asc':
                $dataProvider->sort->defaultOrder = ['created_at' => SORT_ASC];
                break;
            case 'rating_asc':
                $query->joinWith(['reviewMetrics', 'reviewMetrics.type'])
                    ->andWhere([
                        'type' => ReviewMetricType::TYPE_RATING
                    ])
                    ->groupBy('review_id')
                    ->orderBy('avg(value) ASC');
                break;
            case 'likes_asc':
                $dataProvider->sort->defaultOrder = ['likes' => SORT_ASC];
                break;
        }
        return $dataProvider;
    }
}

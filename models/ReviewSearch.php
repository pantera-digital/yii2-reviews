<?php

namespace pantera\reviews\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ReviewSearch represents the model behind the search form of `rivership\modules\reviews\models\Review`.
 */
class ReviewSearch extends Review
{
    public $reviews_sort;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'model_id'], 'integer'],
            [['reviews_sort'], 'string', 'on' => ['date', 'rating', 'likes']],
            [['email', 'name', 'model_class'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = Review::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'model_id' => $this->model_id,
        ]);
        switch (Yii::$app->request->getQueryParam('reviews_sort')) :
            case 'date':
                $dataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];
                break;
            case 'rating':
                $query
                    ->joinWith(['reviewMetrics', 'reviewMetrics.type'])
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
                $query
                    ->joinWith(['reviewMetrics', 'reviewMetrics.type'])
                    ->andWhere([
                        'type' => ReviewMetricType::TYPE_RATING
                    ])
                    ->groupBy('review_id')
                    ->orderBy('avg(value) ASC');
                break;
            case 'likes_asc':
                $dataProvider->sort->defaultOrder = ['likes' => SORT_ASC];
                break;
        endswitch;

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'model_class', $this->model_class]);

        return $dataProvider;
    }
}

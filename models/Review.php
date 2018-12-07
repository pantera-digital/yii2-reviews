<?php

namespace pantera\reviews\models;

use Yii;

/**
 * This is the model class for table "lumi_review".
 *
 * @property string $id
 * @property int $user_id Пользователь который оставил отзыв
 * @property string $email Емейл пользователя который оставил отзыв
 * @property string $name Имя пользователя который оставил отзыв
 * @property string $model_class Класс модели, для поиска отзыва
 * @property string $model_id Идентификатор модели к которой оставлен отзыв
 *
 * @property ReviewMetric[] $reviewMetrics
 * @property bool $status [tinyint(3) unsigned]  Статус публикации отзыва
 * @property int $likes [int(11) unsigned]  Лайки отзыва
 * @property int $dislikes [int(11) unsigned]  Дизлайки отзыва
 * @property int $created_at [timestamp]  Отзыв создан
 */
class Review extends \yii\db\ActiveRecord
{
    public $metrics = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%review}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'model_id', 'likes', 'status', 'dislikes'], 'integer'],
            [['model_class', 'model_id'], 'required'],
            [['_metrics', 'created_at'], 'safe'],
            [['email', 'name', 'model_class'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => Yii::t('reviews', 'User ID'),
            'email' => Yii::t('reviews', 'Email'),
            'name' => Yii::t('reviews', 'Name'),
            'model_class' => Yii::t('reviews', 'Model Class'),
            'model_id' => Yii::t('reviews', 'Model ID'),
            'status' => Yii::t('reviews', 'Status'),
        ];
    }


    public function getAverageRating()
    {
        return $this->getReviewMetrics()
            ->joinWith('type')
            ->andWhere([
                'type' => ReviewMetricType::TYPE_RATING
            ])->average('value');
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->__saveMetrics();
    }

    public function afterFind()
    {
        $this->__fetchMetrics();
        return true;
    }

    protected function __fetchMetrics()
    {
        foreach ($this->getReviewMetrics()->all() as $reviewMetric) {
            $this->metrics[$reviewMetric->metric_type_id] = $reviewMetric->value;
        }
    }

    protected function __saveMetrics()
    {
        foreach ($this->metrics as $metric_type_id => $metric_value) {
            $metric = ReviewMetric::findOne([
                'review_id' => $this->id,
                'metric_type_id' => $metric_type_id,
            ]);
            if (!$metric) {
                $metric = new ReviewMetric([
                    'metric_type_id' => $metric_type_id,
                    'review_id' => $this->id,
                ]);
            }
            $metric->value = $metric_value;
            $metric->save();
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewMetrics()
    {
        return $this->hasMany(ReviewMetric::class, ['review_id' => 'id']);
    }
}

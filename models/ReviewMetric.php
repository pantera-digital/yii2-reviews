<?php

namespace pantera\reviews\models;

/**
 * This is the model class for table "lumi_review_metric".
 *
 * @property string $id
 * @property string $review_id
 * @property int $metric_type_id
 * @property string $value
 *
 * @property Review $review
 */
class ReviewMetric extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%review_metric}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['review_id', 'metric_type_id', 'value'], 'required'],
            [['review_id', 'metric_type_id'], 'integer'],
            [['value'], 'string'],
            [
                ['review_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Review::class,
                'targetAttribute' => ['review_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'review_id' => 'Review ID',
            'metric_type_id' => 'Metric Type ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReview()
    {
        return $this->hasOne(Review::class, ['id' => 'review_id']);
    }

    public function getType()
    {
        return $this->hasOne(ReviewMetricType::class, ['id' => 'metric_type_id']);
    }
}

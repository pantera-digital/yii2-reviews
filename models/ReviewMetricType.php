<?php

namespace pantera\reviews\models;

use Yii;

/**
 * This is the model class for table "lumi_review_metric_types".
 *
 * @property string $id
 * @property string $name Название метрики которую заполняет пользователь
 * @property int $type Тип метрики, которую заполняет пользователь (оценка или текст)
 */
class ReviewMetricType extends \yii\db\ActiveRecord
{
    const TYPE_RATING = 1;
    const TYPE_TEXT = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%review_metric_types}}';
    }


    public static function getTypes()
    {
        return [
            self::TYPE_RATING => Yii::t('reviews', 'Rating (stars)'),
            self::TYPE_TEXT => Yii::t('reviews', 'Judgment (text)'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('reviews', 'Name'),
            'type' => Yii::t('reviews', 'Type of assessment'),
        ];
    }
}

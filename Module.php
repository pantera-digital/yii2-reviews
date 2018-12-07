<?php

namespace pantera\reviews;

use Yii;

class Module extends \yii\base\Module
{
    public static function ratingLabel($rating)
    {
        if ($rating < 2) {
            return Yii::t('reviews', 'Badly');
        } elseif ($rating < 3) {
            return Yii::t('reviews', 'Average');
        } elseif ($rating < 4) {
            return Yii::t('reviews', 'Good');
        } elseif ($rating < 5) {
            return Yii::t('reviews', 'Fine');
        } elseif ($rating == 5) {
            return Yii::t('reviews', 'Sumptuously!');
        }
        return null;
    }
}

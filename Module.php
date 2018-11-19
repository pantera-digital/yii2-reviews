<?php

namespace pantera\reviews;

class Module extends \yii\base\Module
{
    public static function ratingLabel($rating)
    {
        if ($rating < 2) {
            return 'Плохо';
        } elseif ($rating < 3) {
            return 'Средне';
        } elseif ($rating < 4) {
            return 'Хорошо';
        } elseif ($rating < 5) {
            return 'Отлично';
        } elseif ($rating == 5) {
            return 'Великолепно!';
        }

        return null;
    }
}

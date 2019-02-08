<?php

namespace pantera\reviews\widgets;

use yii\base\Widget;

class ReviewsEmpty extends Widget
{
    public $text = 'Отзывов ещё нет — ваш может стать первым';
    
    public $linkHref = '#';

    public $linkLabel = 'Оставить отзыв';

    public function run()
    {
        return $this->render('reviews-empty');
    }
}

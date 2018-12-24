<?php

namespace pantera\reviews\widgets\form;

use pantera\reviews\models\Review;
use Yii;
use yii\base\Event;
use yii\base\Widget;
use yii\bootstrap\Modal;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\web\View;

class ReviewForm extends Widget
{
    /* @var ActiveRecord */
    public $model;
    /* @var bool Флаг что нужно загрузить форму асинхронно */
    public $mode = self::MODE_MODAL;

    /* @var string Форма будет загруженна в модальное окно */
    const MODE_MODAL = 'modal';
    /* @var string Форма рендерится инлайново */
    const MODE_INLINE = 'inline';

    public function run()
    {
        parent::run();
        if ($this->mode === self::MODE_MODAL) {
            return Html::a(Yii::t('reviews', 'Add review'), 'javascript:void(0)', [
                'class' => 'new-reviews-link btn',
                'data' => [
                    'target' => '#' . $this->getId(),
                    'toggle' => 'modal',
                ],
            ]);
        } else {
            /** @noinspection MissedViewInspection */
            return $this->render('index', [
                'model' => $this->initModel(),
            ]);
        }
    }

    public function init()
    {
        parent::init();
        $this->setId('review-modal-' . $this->getId());
        ReviewFormAsset::register($this->view);
        if ($this->mode === self::MODE_MODAL) {
            Event::on(View::class, View::EVENT_END_BODY, function () {
                Modal::begin([
                    'id' => $this->getId(),
                    'header' => Yii::t('reviews', 'Add review'),
                ]);
                /** @noinspection MissedViewInspection */
                echo $this->render('index', [
                    'model' => $this->initModel(),
                ]);
                Modal::end();
            });
        }
    }

    protected function initModel()
    {
        $model = new Review();
        $model->model_class = get_class($this->model);
        $model->model_id = $this->model->getPrimaryKey();
        $model->setScenario(Review::SCENARIO_USER);
        return $model;
    }
}

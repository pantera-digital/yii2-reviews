<?php

use pantera\reviews\models\ReviewMetricTypeSearch;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel ReviewMetricTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('reviews', 'Review Metric Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-metric-type-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <p>
        <?= Html::a(Yii::t('reviews', 'Create Review Metric Type'), ['create'], [
            'class' => 'btn btn-success',
            'data' => [
                'pjax' => 0,
            ],
        ]) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'type',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

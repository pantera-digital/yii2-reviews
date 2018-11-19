<?php

use pantera\reviews\models\ReviewMetricSearch;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel ReviewMetricSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Review Metrics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-metric-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Create Review Metric', ['create'], [
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
            'review_id',
            'metric_type_id',
            'value:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

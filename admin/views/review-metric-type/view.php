<?php

use pantera\reviews\models\ReviewMetricType;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model ReviewMetricType */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('reviews', 'Review Metric Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-metric-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('reviews', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('reviews', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'type',
        ],
    ]) ?>

</div>

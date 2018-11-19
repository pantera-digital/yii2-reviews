<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model rivership\modules\reviews\models\ReviewMetric */

$this->title = 'Create Review Metric';
$this->params['breadcrumbs'][] = ['label' => 'Review Metrics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-metric-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

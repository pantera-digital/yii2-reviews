<?php

use pantera\reviews\models\ReviewSearch;
use pheme\grid\ToggleColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel ReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('reviews', 'Reviews');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <p>
        <?= Html::a(Yii::t('reviews', 'Create Review'), ['create'], [
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
            'user_id',
            'email:email',
            'name',
            'model_class',
            [
                'class' => ToggleColumn::class,
                'attribute' => 'status'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

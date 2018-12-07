<?php
/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 11/19/18
 * Time: 5:16 PM
 */

namespace pantera\reviews\widgets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class ReviewsAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $css = [
        'css/style.css',
    ];

    public $js = [
        'js/script.js',
    ];

    public $depends = [
        JqueryAsset::class,
    ];
}

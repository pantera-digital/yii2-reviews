<?php

namespace pantera\reviews;

use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\i18n\PhpMessageSource;

class Bootstrap implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     * @throws \yii\base\InvalidConfigException
     */
    public function bootstrap($app)
    {
        if (!isset($app->get('i18n')->translations['reviews'])) {
            $app->get('i18n')->translations['reviews'] = [
                'class' => PhpMessageSource::class,
                'basePath' => __DIR__ . '/messages',
                'sourceLanguage' => 'en-US'
            ];
        }
    }
}

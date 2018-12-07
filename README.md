# Yii2 reviews module

## Установка
```
composer require pantera-digital/yii2-reviews
```
В конфиг добавить путь до миграций
```
'controllerMap' => [
    'migrate' => [
        'class' => yii\console\controllers\MigrateController::className(),
        'migrationPath' => [
            '@pantera/reviews/migrations',
        ],
    ],
],
```
Применить миграции
```
php yii migrate
```
### Настройка админки
В конфиг админки добавить
```
'modules' => [
    'reviews' => [
        'class' => \pantera\reviews\admin\Module::class,
        'reviewAdminClasses' => [
            SampleClass::class => [
                'title' => 'Названия', //Имя как будет называется этот класс в списке
                'value' => 'title', //Имя поля в модели возможно указать callback
            ],
        ]
    ],
],
```
Нужно добавить метрики по пути /admin/reviews/review-metric-type

Можно добавлять отзывы по пути /admin/reviews/review
### Настройка фронта
Добавить в конфиг
```
'modules' => [
    'reviews' => [
        'class' => \pantera\reviews\Module::class,
    ],
],
```
### Вывод
Для вывода последних отзывов
```
<?=\pantera\reviews\widgets\LatestReviews::widget([
    'model' => $model
]) ?>
```
Для вывода списка всех отзывов
```
<?= \pantera\reviews\widgets\ReviewsList::widget([
    'model' => $model,
]) ?>
```
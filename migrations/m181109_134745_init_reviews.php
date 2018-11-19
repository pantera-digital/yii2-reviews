<?php

use yii\db\Migration;

/**
 * Class m181109_134745_init_reviews
 */
class m181109_134745_init_reviews extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->null()->comment('Пользователь который оставил отзыв'),
            'email' => $this->string(255)->null()->comment('Емейл пользователя который оставил отзыв'),
            'name' => $this->string(255)->null()->comment('Имя пользователя который оставил отзыв'),
            'model_class' => $this->string(255)->notNull()->comment('Класс модели, для поиска отзыва'),
            'model_id' => $this->integer()->unsigned()->notNull()
                ->comment('Идентификатор модели к которой оставлен отзыв'),
            'status' => $this->tinyInteger()->unsigned()->notNull()->defaultValue(0)
                ->comment('Статус публикации отзыва'),
            'likes' => $this->integer()->unsigned()->null()->comment('Лайки отзыва'),
            'dislikes' => $this->integer()->unsigned()->null()->comment('Дизлайки отзыва'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('NOW()')->comment('Отзыв создан'),
        ]);

        $this->createTable('{{%review_metric_types}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255)->comment('Название метрики которую заполняет пользователь'),
            'type' => $this->integer()->notNull()
                ->comment('Тип метрики, которую заполняет пользователь (оценка или текст)'),
        ]);

        $this->createTable('{{%review_metric}}', [
            'id' => $this->primaryKey()->unsigned(),
            'review_id' => $this->integer()->notNull()->unsigned(),
            'metric_type_id' => $this->integer()->notNull(),
            'value' => $this->text(255)->notNull(),
        ]);

        $this->createIndex('ix-review-metric-review_id', '{{%review_metric}}', 'review_id');
        $this->addForeignKey(
            'fk-review-metric-review',
            '{{%review_metric}}',
            'review_id',
            '{{%review}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%review_metric}}');
        $this->dropTable('{{%review_metric_types}}');
        $this->dropTable('{{%review}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m181119_063810_change_fk
 */
class m181119_063810_change_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-review-metric-review', '{{%review_metric}}');
        $this->addForeignKey(
            'fk-review-metric-review',
            '{{%review_metric}}',
            'review_id',
            '{{%review}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-review-metric-review', '{{%review_metric}}');
        $this->addForeignKey(
            'fk-review-metric-review',
            '{{%review_metric}}',
            'review_id',
            '{{%review}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );
        return true;
    }
}

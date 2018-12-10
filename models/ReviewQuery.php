<?php

namespace pantera\reviews\models;

/**
 * @see Review
 */
class ReviewQuery extends \yii\db\ActiveQuery
{
    /**
     * Только активные
     * @return ReviewQuery
     */
    public function isActive(): self
    {
        return $this->andWhere(['=', Review::tableName() . '.status', Review::STATUS_ACTIVE]);
    }
}

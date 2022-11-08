<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "locations".
 *
 * @property int $id
 * @property string $name
 *
 * @property Cases[] $cases
 */
class LocationModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        if (!$_ENV["DATABASE_SCHEMA"]) {
            return "locations";
        } else {
            return $_ENV["DATABASE_SCHEMA"] . ".locations";
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Location',
        ];
    }

    /**
     * Gets query for [[Cases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCases()
    {
        return $this->hasMany(Cases::class, ['locationId' => 'id']);
    }
}

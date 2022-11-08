<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "satkers".
 *
 * @property int $id
 * @property string $name
 *
 * @property Cases[] $cases
 */
class SatKerModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        if (!$_ENV["DATABASE_SCHEMA"]) {
            return "satkers";
        } else {
            return $_ENV["DATABASE_SCHEMA"] . ".satkers";
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
            'name' => 'Satker Name',
        ];
    }

    /**
     * Gets query for [[Cases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCases()
    {
        return $this->hasMany(Cases::class, ['satKerId' => 'id']);
    }
}

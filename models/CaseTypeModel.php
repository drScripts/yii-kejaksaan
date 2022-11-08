<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "caseTypes".
 *
 * @property int $id
 * @property string $name
 *
 * @property Cases[] $cases
 */
class CaseTypeModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        if (!$_ENV["DATABASE_SCHEMA"]) {
            return "caseTypes";
        } else {
            return $_ENV["DATABASE_SCHEMA"] . ".caseTypes";
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
            'name' => 'Case Type',
        ];
    }

    /**
     * Gets query for [[Cases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCases()
    {
        return $this->hasMany(Cases::class, ['caseTypeId' => 'id']);
    }
}

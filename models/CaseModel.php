<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cases".
 *
 * @property int $id
 * @property int $satKerId
 * @property int $locationId
 * @property string $name
 * @property string $spdpNumber
 * @property string $spdpDate
 * @property int $caseTypeId
 * @property resource|null $document
 * @property int $caseStageId
 *
 * @property CaseStages $caseStage
 * @property CaseTypes $caseType
 * @property Locations $location
 * @property Satkers $satKer
 */
class CaseModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        if (!$_ENV["DATABASE_SCHEMA"]) {
            return "cases";
        } else {
            return $_ENV["DATABASE_SCHEMA"] . ".cases";
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['satKerId', 'locationId', 'name', 'spdpNumber', 'spdpDate', 'caseTypeId', 'caseStageId'], 'required'],
            [['satKerId', 'locationId', 'caseTypeId', 'caseStageId'], 'default', 'value' => null],
            [['satKerId', 'locationId', 'caseTypeId', 'caseStageId'], 'integer'],
            [['spdpDate'], 'safe'],
            [['document'], 'string'],
            [['name', 'spdpNumber'], 'string', 'max' => 255],
            [['caseStageId'], 'exist', 'skipOnError' => true, 'targetClass' => CaseStageModel::class, 'targetAttribute' => ['caseStageId' => 'id']],
            [['caseTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => CaseTypeModel::class, 'targetAttribute' => ['caseTypeId' => 'id']],
            [['locationId'], 'exist', 'skipOnError' => true, 'targetClass' => LocationModel::class, 'targetAttribute' => ['locationId' => 'id']],
            [['satKerId'], 'exist', 'skipOnError' => true, 'targetClass' => SatKerModel::class, 'targetAttribute' => ['satKerId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'satKerId' => 'Sat Ker ID',
            'locationId' => 'Location ID',
            'name' => 'Name',
            'spdpNumber' => 'Spdp Number',
            'spdpDate' => 'Spdp Date',
            'caseTypeId' => 'Case Type ID',
            'document' => 'Document',
            'caseStageId' => 'Case Stage ID',
        ];
    }

    /**
     * Gets query for [[CaseStage]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCaseStage()
    {
        return $this->hasOne(CaseStageModel::class, ['id' => 'caseStageId']);
    }

    /**
     * Gets query for [[CaseType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCaseType()
    {
        return $this->hasOne(CaseTypeModel::class, ['id' => 'caseTypeId']);
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(LocationModel::class, ['id' => 'locationId']);
    }

    /**
     * Gets query for [[SatKer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSatKer()
    {
        return $this->hasOne(SatKerModel::class, ['id' => 'satKerId']);
    }
}

<?php

use yii\db\Migration;

/**
 * Class m221107_151957_case
 */
class m221107_160132_case extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('audit.cases', [
            'id' => $this->primaryKey(),
            'satKerId' => $this->integer()->notNull(),
            'locationId' => $this->integer()->notNull(),
            "name" => $this->string()->notNull(),
            "spdpNumber" => $this->string()->notNull(),
            "spdpDate" => $this->dateTime()->notNull(),
            "caseTypeId" => $this->integer()->notNull(),
            "document" =>  $this->binary(429496729),
            'caseStageId' => $this->integer()->notNull(),
        ]);

        // creates index for column `satKerId`
        $this->createIndex(
            'idx-cases-satKerId',
            'audit.cases',
            'satKerId',
            false,
        );

        // add foreign key for table `satkers`
        $this->addForeignKey(
            'fk-cases-satKerId',
            'audit.cases',
            'satKerId',
            'audit.satkers',
            'id',
            'CASCADE'
        );

        // creates index for column `locationId`
        $this->createIndex(
            'idx-cases-locationId',
            'audit.cases',
            'locationId',
            false,
        );

        // add foreign key for table `locations`
        $this->addForeignKey(
            'fk-cases-locationId',
            'audit.cases',
            'locationId',
            'audit.locations',
            'id',
            'CASCADE'
        );

        // creates index for column `caseTypeId`
        $this->createIndex(
            'idx-cases-caseTypeId',
            'audit.cases',
            'caseTypeId',
            false,
        );

        // add foreign key for table `caseTypes`
        $this->addForeignKey(
            'fk-cases-caseTypeId',
            'audit.cases',
            'caseTypeId',
            'audit.caseTypes',
            'id',
            'CASCADE'
        );

        // creates index for column `caseStageId`
        $this->createIndex(
            'idx-cases-caseStageId',
            'audit.cases',
            'caseStageId',
            false,
        );

        // add foreign key for table `caseStages`
        $this->addForeignKey(
            'fk-cases-caseStageId',
            'audit.cases',
            'caseStageId',
            'audit.caseStages',
            'id',
            'CASCADE'
        );


        $this->db->createCommand("CREATE OR REPLACE TRIGGER t_if_modified_trg 
        AFTER INSERT OR UPDATE OR DELETE ON audit.cases
        FOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-cases-satKerId',
            'cases'
        );

        $this->dropIndex(
            'idx-cases-satKerId',
            'cases'
        );

        $this->dropForeignKey(
            'fk-cases-locationId',
            'cases'
        );

        $this->dropIndex(
            'idx-cases-locationId',
            'cases'
        );

        $this->dropForeignKey(
            'fk-cases-caseTypeId',
            'cases'
        );

        $this->dropIndex(
            'idx-cases-caseTypeId',
            'cases'
        );


        $this->dropForeignKey(
            'fk-cases-caseStageId',
            'cases'
        );

        $this->dropIndex(
            'idx-cases-caseStageId',
            'cases'
        );

        $this->dropTable("cases");
    }
}

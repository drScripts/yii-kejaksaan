<?php

use yii\db\Migration;

/**
 * Class m221107_160132_caseStage
 */
class m221107_151957_caseStage extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('audit.caseStages', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("audit.caseStages");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221107_160132_caseStage cannot be reverted.\n";

        return false;
    }
    */
}

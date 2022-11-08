<?php

use yii\db\Migration;

/**
 * Class m221107_150957_caseType
 */
class m221107_150957_caseType extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('audit.caseTypes', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("audit.caseTypes");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221107_150957_caseType cannot be reverted.\n";

        return false;
    }
    */
}

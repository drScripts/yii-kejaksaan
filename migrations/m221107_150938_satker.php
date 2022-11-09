<?php

use yii\db\Migration;

/**
 * Class m221107_150938_satker
 */
class m221107_150938_satker extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('audit.satkers', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);


        $this->db->createCommand("CREATE OR REPLACE TRIGGER t_if_modified_trg 
        AFTER INSERT OR UPDATE OR DELETE ON audit.satkers
        FOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();")->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("audit.satkers");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221107_150938_satker cannot be reverted.\n";

        return false;
    }
    */
}

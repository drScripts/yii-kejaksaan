<?php

namespace app\controllers;

use Exception;
use Yii;
use yii\web\Controller;

/**
 * LocationController implements the CRUD actions for LocationModel model.
 */
class MigrateController extends Controller
{
    /**
     * Lists all LocationModel models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (YII_ENV_DEV) {
            $this->createSchema();
            $this->actionMigrate();

            sleep(3);

            return $this->redirect("/index");
        } else {
            return new Exception("can't run mgiration in production mode", 400);
        }
    }

    public function actionMigrate()
    {
        // Keep current application
        $oldApp = \Yii::$app;
        // Load Console Application config
        $config = require \Yii::getAlias('@app') . '/config/console.php';
        new \yii\console\Application($config);
        $result = \Yii::$app->runAction('migrate', ['migrationPath' => '@app/migrations/', 'interactive' => false]);
        // Revert application
        \Yii::$app = $oldApp;
        return $result;
    }

    public function createSchema()
    {

        $isExists =  Yii::$app->db->createCommand("SELECT 
        COUNT(table_name)
        FROM 
            information_schema.tables 
        WHERE 
        table_schema LIKE 'audit' AND 
        table_type LIKE 'BASE TABLE' AND
        table_name = 'logged_actions';
            ")->queryOne();

        if ($isExists["count"] == 1) {
            return;
        }

        Yii::$app->db->createCommand("create schema audit;")->execute();
        Yii::$app->db->createCommand("revoke create on schema audit from public;")->execute();

        Yii::$app->db->createCommand("create table audit.logged_actions (
            schema_name text not null,
            table_name text not null,
            user_name text,
            action_tstamp timestamp with time zone not null default current_timestamp,
            action TEXT NOT NULL check (action in ('I','D','U')),
            original_data text,
            new_data text,
            query text
        ) with (fillfactor=100);")->execute();

        Yii::$app->db->createCommand("revoke all on audit.logged_actions from public;")->execute();
        Yii::$app->db->createCommand("grant select on audit.logged_actions to public;")->execute();
        Yii::$app->db->createCommand("create index logged_actions_schema_table_idx on audit.logged_actions(((schema_name||'.'||table_name)::TEXT));")->execute();
        Yii::$app->db->createCommand("create index logged_actions_action_tstamp_idx on audit.logged_actions(action_tstamp);")->execute();
        Yii::$app->db->createCommand("create index logged_actions_action_idx on audit.logged_actions(action);")->execute();
        Yii::$app->db->createCommand("CREATE OR REPLACE FUNCTION audit.if_modified_func() RETURNS trigger AS \$body$
        DECLARE
            v_old_data TEXT;
            v_new_data TEXT;
        BEGIN
         /*  If this actually for real auditing (where you need to log EVERY action),
        then you would need to use something like dblink or plperl that could log outside the transaction,
        regardless of whether the transaction committed or rolled back.
        */

        /* This dance with casting the NEW and OLD values to a ROW is not necessary in pg 9.0+ */

        if (TG_OP = 'UPDATE') then
            v_old_data := ROW(OLD.*);
            v_new_data := ROW(NEW.*);
            insert into audit.logged_actions (schema_name,table_name,user_name,action,original_data,new_data,query) 
            values (TG_TABLE_SCHEMA::TEXT,TG_TABLE_NAME::TEXT,session_user::TEXT,substring(TG_OP,1,1),v_old_data,v_new_data, current_query());
            RETURN NEW;
        elsif (TG_OP = 'DELETE') then
            v_old_data := ROW(OLD.*);
            insert into audit.logged_actions (schema_name,table_name,user_name,action,original_data,query)
            values (TG_TABLE_SCHEMA::TEXT,TG_TABLE_NAME::TEXT,session_user::TEXT,substring(TG_OP,1,1),v_old_data, current_query());
            RETURN OLD;
        elsif (TG_OP = 'INSERT') then
            v_new_data := ROW(NEW.*);
            insert into audit.logged_actions (schema_name,table_name,user_name,action,new_data,query)
            values (TG_TABLE_SCHEMA::TEXT,TG_TABLE_NAME::TEXT,session_user::TEXT,substring(TG_OP,1,1),v_new_data, current_query());
            RETURN NEW;
        else
            RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - Other action occurred: %, at %',TG_OP,now();
            RETURN NULL;
        end if;

        EXCEPTION
            WHEN data_exception THEN
                RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - UDF ERROR [DATA EXCEPTION] - SQLSTATE: %, SQLERRM: %',SQLSTATE,SQLERRM;
                RETURN NULL;
            WHEN unique_violation THEN
                RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - UDF ERROR [UNIQUE] - SQLSTATE: %, SQLERRM: %',SQLSTATE,SQLERRM;
                RETURN NULL;
            WHEN others THEN
                RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - UDF ERROR [OTHER] - SQLSTATE: %, SQLERRM: %',SQLSTATE,SQLERRM;
                RETURN NULL;
        END;

        \$body$
        LANGUAGE plpgsql
        SECURITY DEFINER
        SET search_path = pg_catalog, audit;
        ")->execute();
    }
}

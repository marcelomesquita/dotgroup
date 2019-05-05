<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tarefas}}`.
 */
class m190503_191828_create_tarefas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tarefas}}', [
            'id' => $this->primaryKey(),
            'titulo' => $this->string()->notNull(),
            'descricao' => $this->string(),
            'prioridade' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tarefas}}');
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tarefa}}".
 *
 * @property int $id
 * @property string $titulo
 * @property string $descricao
 * @property int $prioridade
 */
class Tarefa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tarefas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'prioridade'], 'required'],
            [['titulo', 'descricao'], 'string', 'max' => 255],
            [['prioridade'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'titulo' => Yii::t('app', 'Título'),
            'descricao' => Yii::t('app', 'Descrição'),
            'prioridade' => Yii::t('app', 'Prioridade'),
        ];
    }
}

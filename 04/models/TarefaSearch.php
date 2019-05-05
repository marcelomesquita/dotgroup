<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tarefa;

/**
 * TarefaSearch represents the model behind the search form of `app\models\Tarefa`.
 */
class TarefaSearch extends Tarefa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'prioridade'], 'integer'],
            [['titulo', 'descricao'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tarefa::find();

        $dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => ['defaultOrder' => ['prioridade'=> SORT_ASC]],
			'pagination' => false
		]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['id' => $this->id]);
		$query->andFilterWhere(['prioridade' => $this->prioridade]);
        $query->andFilterWhere(['like', 'titulo', $this->titulo]);
		$query->andFilterWhere(['like', 'descricao', $this->descricao]);

        return $dataProvider;
    }
}

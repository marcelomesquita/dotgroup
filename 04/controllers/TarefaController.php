<?php

namespace app\controllers;

use Yii;
use app\models\Tarefa;
use app\models\TarefaSearch;
use yii\web\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TarefaController implements the CRUD actions for Tarefa model.
 */
class TarefaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET'],
                    'create' => ['POST'],
                    'update' => ['POST'],
                    'delete' => ['DELETE'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tarefa models.
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $searchModel = new TarefaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $output = [
            'tarefas' => $dataProvider->getModels()
        ];

        return $output;
    }

    /**
     * Creates a new Tarefa model.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new Tarefa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $output = [
                'tarefa' => $model,
                'mensagem' => 'Tarefa cadastrada com sucesso!'
            ];

            return $output;
        } else {
            $output = [
                'mensagem' => "Falha ao cadastrar tarefa!\n" . implode("\n", $model->getFirstErrors())
            ];

            return $output;
        }
    }

    /**
     * Updates an existing Tarefa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $output = [
                'mensagem' => 'Tarefa atualizada com sucesso!'
            ];

            return $output;
        } else {
            $output = [
                'mensagem' => "Falha ao atualizar tarefa!\n" . implode("\n", $model->getFirstErrors())
            ];

            return $output;
        }
    }

    /**
     * Updates the order of the list.
     * @return mixed
     */
    public function actionOrder()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $tarefas = Yii::$app->request->post("tarefas");

        foreach ($tarefas as $tarefa) {
            $model = $this->findModel((int) $tarefa['id']);

            $model->prioridade = (int) $tarefa['prioridade'];

            $model->save();
        }

        $output = [
            'mensagem' => 'Tarefas ordenadas com sucesso!'
        ];

        return $output;
    }

    /**
     * Deletes an existing Tarefa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($id);

        if ($model->delete()) {
            $output = [
                'mensagem' => 'Tarefa deletada com sucesso!'
            ];

            return $output;
        } else {
            $output = [
                'mensagem' => 'Falha ao deletar tarefa!'
            ];

            return $output;
        }
    }

    /**
     * Finds the Tarefa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tarefa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tarefa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

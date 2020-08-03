<?php

namespace app\controllers;

use Yii;
use app\models\base\Comentario;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComentarioController implements the CRUD actions for Comentario model.
 */
class ComentarioController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    /**
     * Creates a new Comentario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNuevo()
    {
        $model = new Comentario();

        if ($form = Yii::$app->request->post()['NuevoComentarioForm']) {
            try {
                $user = Yii::$app->user;
                $model->contenido = $form['contenido'];
                $model->id_autor = $user->getId();
                $model->id_usuario = $user->getId();

                Comentario::guardar($model);

                return $this->redirect(['site/muro']);
            } catch (\Exception $ex) {
                throw $ex;
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Comentario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_comentario]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Comentario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEliminar($id)
    {
        Comentario::borrar($id);

        return $this->redirect(['site/muro']);
    }

    /**
     * Finds the Comentario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comentario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comentario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

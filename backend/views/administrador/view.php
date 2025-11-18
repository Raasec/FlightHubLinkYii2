<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Administrador */

$this->title = 'Administrador #' . $model->id_admin;
$this->params['breadcrumbs'][] = ['label' => 'Administradors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Update', ['update', 'id_admin' => $model->id_admin], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id_admin' => $model->id_admin], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this admin?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
                    
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id_admin',
                            'id_utilizador',
                            [
                                'label' => 'Username',
                                'value' => $model->user->username
                            ],
                            [
                                'label' => 'Nome',
                                'value' => $model->user->nome
                            ],
                            [
                                'label' => 'Email',
                                'value' => $model->user->email
                            ],
                            'nivel_acesso',
                            'responsavel_area',
                            [
                                'label' => 'Data de Registo',
                                'value' => $model->user->data_registo
                            ],
                        ],
                    ]) ?>
                </div>
                <!--.col-md-12-->
            </div>
            <!--.row-->
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>
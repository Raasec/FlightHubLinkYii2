<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Funcionario */

$this->title = "Funcionário #".$model->id_funcionario;

$this->params['breadcrumbs'][] = ['label' => 'Funcionários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);

/** @var \common\models\User $user */  //buscar o User para conseguir identificar no tipo
$user = Yii::$app->user->identity;

$isAdmin = $user->tipo_utilizador === 'administrador';
$isOwner = $model->id_utilizador == $user->id;

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?php if ($isAdmin || $isOwner): ?>
                        <?= Html::a('Update', ['update', 'id_funcionario' => $model->id_funcionario], ['class' => 'btn btn-primary']) ?>
                        <?php endif; ?>

                        <?php if ($isAdmin): ?>
                        <?= Html::a('Delete', ['delete', 'id_funcionario' => $model->id_funcionario], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                        <?php endif; ?>
                    </p>
                    
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id_utilizador',
                            'id_funcionario',
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
                            'departamento',
                            'cargo',
                            [
                                'attribute' => 'turno',
                                'value' => $model->displayTurno(),
                            ],
                            'data_contratacao',
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
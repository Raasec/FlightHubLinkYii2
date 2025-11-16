<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Passageiro */

$this->title = $model->id_passageiro;
$this->params['breadcrumbs'][] = ['label' => 'Passageiros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Update', ['update', 'id_passageiro' => $model->id_passageiro], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id_passageiro' => $model->id_passageiro], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id_passageiro',
                            'id_utilizador',
                            'nif',
                            'telefone',
                            'nacionalidade',
                            'data_nascimento',
                            'preferencias:ntext',
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
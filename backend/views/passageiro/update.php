<?php

/* @var $this yii\web\View */
/* @var $model common\models\Passageiro */

$this->title = 'Update Passageiro: ' . $model->id_passageiro;
$this->params['breadcrumbs'][] = ['label' => 'Passageiros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_passageiro, 'url' => ['view', 'id_passageiro' => $model->id_passageiro]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>
<?php

/* @var $this yii\web\View */
/* @var $model common\models\ServicoAeroporto */

$this->title = 'Update Airport Service: ' . $model->id_servico;
$this->params['breadcrumbs'][] = ['label' => 'Servico Aeroportos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_servico, 'url' => ['view', 'id_servico' => $model->id_servico]];
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
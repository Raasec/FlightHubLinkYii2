<?php

/* @var $this yii\web\View */
/* @var $model common\models\CompanhiaAerea */

$this->title = 'Update Airline: ' . $model->id_companhia;
$this->params['breadcrumbs'][] = ['label' => 'Airlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_companhia, 'url' => ['view', 'id_companhia' => $model->id_companhia]];
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
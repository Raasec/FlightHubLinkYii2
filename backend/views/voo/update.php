<?php

/* @var $this yii\web\View */
/* @var $model common\models\Voo */

$this->title = 'Update Flight: ' . $model->id_voo;
$this->params['breadcrumbs'][] = ['label' => 'Flights', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_voo, 'url' => ['view', 'id_voo' => $model->id_voo]];
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
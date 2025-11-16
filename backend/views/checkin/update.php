<?php

/* @var $this yii\web\View */
/* @var $model common\models\Checkin */

$this->title = 'Update Checkin: ' . $model->id_checkin;
$this->params['breadcrumbs'][] = ['label' => 'Checkins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_checkin, 'url' => ['view', 'id_checkin' => $model->id_checkin]];
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
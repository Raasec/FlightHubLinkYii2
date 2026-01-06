<?php

/* @var $this yii\web\View */
/* @var $model common\models\Checkin */

$this->title = 'Update Checkin: ' . $model->id_checkin;

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model,
                        'bilhetes' => $bilhetes,
                        'funcionarios' => $funcionarios,
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>
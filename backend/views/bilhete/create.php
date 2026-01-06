<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Bilhete */

$this->title = 'Create Ticket';

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model,
                        'passageiros' => $passageiros,
                        'voos' => $voos,
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>
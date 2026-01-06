<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Bilhete */

$this->title = "Ticket #" . $model->id_bilhete;

\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Update', ['update', 'id_bilhete' => $model->id_bilhete], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id_bilhete' => $model->id_bilhete], [
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
                            'id_bilhete',
                            'id_passageiro',
                            'id_voo',
                            'gate',
                            'issue_date',
                            'price',
                            'travel_class',
                            'seat',
                            'status',
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

    <hr>

    <div class="mt-3">
        <?= Html::a(
            '← Back to Tickets',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>
</div>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CompanhiaAerea */

$this->title = $model->name;

?>

<div class="container-fluid">

    <div class="card">
        <div class="card-body">

            <!-- ACTION BUTTONS -->
            <div class="mb-3">
                <?= Html::a('Update', ['update', 'id_companhia' => $model->id_companhia], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id_companhia' => $model->id_companhia], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this airline?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>

            <div class="row">
                <!-- LOGO -->
                <div class="col-md-4 text-center">
                    <?= Html::img(
                        $model->imageUrl,
                        [
                            'style' => 'max-width:220px; max-height:120px; object-fit:contain;',
                            'alt' => $model->name,
                        ]
                    ) ?>
                </div>

                <!-- DETAILS -->
                <div class="col-md-8">
                    <?= DetailView::widget([
                        'model' => $model,
                        'options' => ['class' => 'table table-bordered table-striped'],
                        'attributes' => [
                            [
                                'label' => 'Airline ID',
                                'value' => $model->id_companhia,
                            ],
                            'name',
                            [
                                'label' => 'IATA Code',
                                'format' => 'raw',
                                'value' => Html::tag(
                                    'span',
                                    $model->iata_code,
                                    ['class' => 'badge badge-info']
                                ),
                            ],
                            'country_origin',
                        ],
                    ]) ?>
                </div>
            </div>

        </div>
    </div>

    <hr>

    <div class="mt-3">
        <?= Html::a(
            '← Back to Airlines',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>

</div>

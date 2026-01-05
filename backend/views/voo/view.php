<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Voo */

$this->title = 'Flight ' . $model->numero_voo;


\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Update', ['update', 'id_voo' => $model->id_voo], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id_voo' => $model->id_voo], [
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
                            'id_voo',
                            [
                                'label' => 'Airline',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    if (!$model->companhia) {
                                        return Html::tag('span', '(not set)', ['class' => 'text-danger']);
                                    }

                                    return Html::tag(
                                        'div',
                                        Html::img(
                                            $model->companhia->imageUrl,
                                            [
                                                'style' => 'width:60px;height:35px;object-fit:contain;margin-right:10px;',
                                            ]
                                        ) .
                                        Html::encode($model->companhia->name),
                                        ['class' => 'd-flex align-items-center']
                                    );
                                },
                            ],
                            'numero_voo',
                            'origin',
                            'destination',
                            'tipo_voo',
                            'departure_date',
                            'arrival_date',
                            'gate',
                            [
                                'label' => 'Responsible Employee',
                                'value' => function ($model) {

                                    $funcionario = $model->funcionarioResponsavel;

                                    if (!$funcionario) {
                                        return '(not set)';
                                    }

                                    // 1️ Full name via UserProfile
                                    if (
                                        $funcionario->userProfile &&
                                        !empty($funcionario->userProfile->full_name)
                                    ) {
                                        return $funcionario->userProfile->full_name;
                                    }

                                    // 2️ Fallback para username
                                    if ($funcionario->user) {
                                        return $funcionario->user->username;
                                    }

                                    // 3️ fallback para ID
                                    return 'Employee #' . $funcionario->id_funcionario;
                                },
                            ],

                            [
                                'attribute' => 'status',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    $label = \common\models\Voo::optsStatus()[$model->status] ?? $model->status;
                                    $class = $model->status == 1 ? 'badge badge-success' : 'badge badge-secondary';
                                    return Html::tag('span', $label, ['class' => $class]);
                                },
                            ],
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
            '← Back to Flights',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>

</div>
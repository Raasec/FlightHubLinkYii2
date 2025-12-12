<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CompanhiaAerea */

$this->title = $model->id_companhia;
$this->params['breadcrumbs'][] = ['label' => 'Airlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Update', ['update', 'id_companhia' => $model->id_companhia], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id_companhia' => $model->id_companhia], [
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
                            'id_companhia',
                            'name',
                            'iata_code',
                            'country_origin',
                            [
                                'attribute' => 'image',
                                'label' => 'Logo',
                                'format' => 'raw',
                                'value' => function($model) {
                                    if (!$model->image) return '(no image)';
                                    return Html::img(
                                        Yii::getAlias('@imgUrl') . '/airlines/' . $model->image,
                                        ['width' => '100px']
                                    );
                                }
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
</div>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Review */

$this->title = "Review #:" . $model->id_review;

\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Update', ['update', 'id_review' => $model->id_review], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id_review' => $model->id_review], [
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
                            'id_review',
                            'id_passageiro',
                            'id_voo',
                            'rating',
                            'comment:ntext',
                            'review_date',
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
            '← Back to Incidents',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>
</div>
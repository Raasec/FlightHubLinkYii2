<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Notificacao */

$this->title = "Notification #:" . $model->id_notificacao;

\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Update', ['update', 'id_notificacao' => $model->id_notificacao], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id_notificacao' => $model->id_notificacao], [
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
                            'id_notificacao',
                            'id_voo',
                            'type',
                            'message:ntext',
                            'sent_at',
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
            '← Back to Notifications',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>
</div>
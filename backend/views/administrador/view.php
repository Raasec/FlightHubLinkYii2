<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Administrador */

$this->title = "Administrador #{$model->id_admin}";

$this->params['breadcrumbs'][] = ['label' => 'Administrators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$isAdmin = Yii::$app->user->can('administrador');

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?php if ($isAdmin): ?>
                            <?= Html::a('Update', ['update', 'id_admin' => $model->id_admin], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Delete', ['delete', 'id_admin' => $model->id_admin], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this admin?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        <?php endif; ?>
                    </p>
                    
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id_admin',
                            'id_utilizador',
                            [
                                'label' => 'Username',
                                'value' => $model->user->username
                            ],
                            [
                                'label' => 'Email',
                                'value' => $model->user->email
                            ],
                            'access_level',
                            'area_responsible',
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
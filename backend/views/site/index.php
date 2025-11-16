<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Dashboard';
$this -> params ['breadcrumbs'][] = $this-> title;
?>

<div class="row">

    <!-- Voos -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>0</h3> <!-- depois ligamos à BD -->
                <p>Voos</p>
            </div>
            <div class="icon">
                <i class="fas fa-plane-departure"></i>
            </div>
            <a href="<?= Url::to(['/voo/index']) ?>" class="small-box-footer">
                Gerir voos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

     <!-- Bilhetes -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>0</h3>
                <p>Bilhetes</p>
            </div>
            <div class="icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <a href="<?= Url::to(['/bilhete/index']) ?>" class="small-box-footer">
                Gerir bilhetes <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Notificações -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>0</h3>
                <p>Notificações</p>
            </div>
            <div class="icon">
                <i class="fas fa-bell"></i>
            </div>
            <a href="<?= Url::to(['/notificacao/index']) ?>" class="small-box-footer">
                Gerir notificações <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Pedidos de assistência -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>0</h3>
                <p>Pedidos de assistência</p>
            </div>
            <div class="icon">
                <i class="fas fa-headset"></i>
            </div>
            <a href="<?= Url::to(['/pedido-assistencia/index']) ?>" class="small-box-footer">
                Gerir pedidos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Resumo do sistema</h3>
            </div>
            <div class="card-body">
                <p>Aqui vamos colocar estatísticas reais de voos, bilhetes, reviews, etc.,
                   de acordo com o DER.</p>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Atividade recente</h3>
            </div>
            <div class="card-body">
                <p>Mais tarde podemos listar últimos voos criados, incidentes, pedidos de
                   assistência por resolver, etc.</p>
            </div>
        </div>
    </div>
</div>
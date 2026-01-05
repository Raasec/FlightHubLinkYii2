<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Dashboard';


?>

<div class="row">


<!-- <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/css/style.css"> -->

    <!-- Voos -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $totalVoos ?></h3> <!-- depois ligamos à BD -->
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
                <h3><?= $totalBilhetes ?></h3>
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
                <h3><?= $totalNotificacoes ?></h3>
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
                <h3><?= $totalPedidos ?></h3>
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

    <!-- Calendar -->
    <div class="col-lg-4">
        <div class="card bg-gradient-success">
            <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="far fa-calendar-alt"></i>
                    Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-bars"></i>
                        </button> 
                        <div class="dropdown-menu" role="menu">
                            <a href="#" class="dropdown-item">Add new event</a>
                            <a href="#" class="dropdown-item">Clear events</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">View calendar</a>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                <!--  tools -->
                </div>
                <!-- card-header -->

                <div class="card-body pt-0">
                <!--The calendar -->
                  <div id="calendar" style="width: 100%"></div>
                </div>
              <!-- /.card-body -->
          
          </div>
      </div>

        
        <!-- Table dos Voos Partidas -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Recent Departures Flights</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>

              <div class="card-body table-responsive p-0">

                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Flight</th>
                    <th>Origin</th>
                    <th>Hour</th>
                    <th>Status</th>
                    <th>More</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($recentDepartures as $voo): ?>
                  <tr>
                    <td>
                        <?= \yii\helpers\Html::encode($voo->numero_voo) ?>
                    </td>
                    <td>
                        <?= \yii\helpers\Html::encode($voo->destination) ?>
                    </td>
                    <td>
                        <?= Yii::$app->formatter->asDatetime($voo->departure_date, 'php:H:i') ?>
                    </td>
                    <td>
                        <span class="status"><?= \yii\helpers\Html::encode($voo->status) ?></span>
                    </td>
                    <td>
                      <a href="<?= \yii\helpers\Url::to(['/voo/view', 'id_voo' => $voo->id_voo]) ?>" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>


            <!-- Table dos Voos Chegadas -->
      <div class="col-lg-4">
        <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Recent Arrivals</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
            </div>

            <div class="card-body table-responsive p-0">


                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Flight</th>
                    <th>Origin</th>
                    <th>Hour</th>
                    <th>Status</th>
                    <th>More</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($recentArrivals as $voo): ?>
                  <tr>
                    <td>
                        <?= \yii\helpers\Html::encode($voo->numero_voo) ?>
                    </td>
                    <td>
                        <?= \yii\helpers\Html::encode($voo->origin) ?>
                    </td>
                    <td>
                        <?= Yii::$app->formatter->asDatetime($voo->arrival_date, 'php:H:i') ?>
                    </td>
                    <td>
                        <span class="status"><?= \yii\helpers\Html::encode($voo->status) ?></span>
                    </td>
                    <td>
                      <a href="<?= \yii\helpers\Url::to(['/voo/view', 'id_voo' => $voo->id_voo]) ?>" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>


  <!-- Segunda linha (Resumo + Atividade) -->
    <div class="row mt-4">

      <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Resumo do sistema</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Funcionários -->
                    <div class="col-lg-6 col-6">
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h3><?= $totalFuncionarios ?></h3>
                                <p>Funcionários Ativos</p>
                            </div>
                            <div class="icon"><i class="fas fa-user-tie"></i></div>
                            <a href="<?= Url::to(['/funcionario/index']) ?>" class="small-box-footer">
                                Gerir funcionários <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Passageiros -->
                    <div class="col-lg-6 col-6">
                        <div class="small-box bg-maroon">
                            <div class="inner">
                                <h3><?= $totalPassageiros ?></h3>
                                <p>Passageiros Registados</p>
                            </div>
                            <div class="icon"><i class="fas fa-users"></i></div>
                            <a href="<?= Url::to(['/passageiro/index']) ?>" class="small-box-footer">
                                Gerir passageiros <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Atividade Recente (Notificações)</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <?php foreach ($recentNotifications as $notificacao): ?>
                    <li class="item">
                        <div class="product-img">
                            <i class="fas fa-bell fa-2x text-warning"></i>
                        </div>
                        <div class="product-info">
                            <a href="<?= Url::to(['/notificacao/view', 'id_notificacao' => $notificacao->id_notificacao]) ?>" class="product-title">
                                Notificação #<?= $notificacao->id_notificacao ?>
                            </a>
                            <span class="product-description">
                                <?= \yii\helpers\Html::encode($notificacao->message) ?>
                            </span>
                            <div class="notification-time text-muted small mt-1">
                                <?= Yii::$app->formatter->asDatetime($notificacao->sent_at, 'php:d M . H:i') ?>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                    <?php if (empty($recentNotifications)): ?>
                        <li class="item">
                            <div class="p-3 text-center text-muted">Sem atividade recente.</div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="card-footer text-center">
                <a href="<?= Url::to(['/notificacao/index']) ?>" class="uppercase">
                    Ver Todas as Notificações
                </a>
            </div>
        </div>
    </div>
  
</div>
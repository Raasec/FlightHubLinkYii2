<?php
$this->title = 'Recent Activity';
?>

<div class="row">
    <div class="col-lg-12">

    <!-- Layout das notificações -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Notifications</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">

                    <!-- Notificação: Pedido de Assistência -->
                    <li class="item">
                        <div class="product-img">
                            <i class="fas fa-headset fa-2x text-warning"></i>
                        </div>
                        <div class="product-info">
                            <a class="product-title">
                                Pedido de Assistência
                                <span class="badge badge-warning float-right">Assistência</span>
                            </a>
                            <span class="product-description">
                                Passageiro solicitou ajuda no check-in.
                            </span>
                            <div class="notification-time text-muted small mt-1">
                                2 Dezembro . 17:08
                            </div>
                        </div>
                    </li>

                    <!-- Notificação: Voo -->
                    <li class="item">
                        <div class="product-img">
                            <i class="fas fa-plane-departure fa-2x text-info"></i>
                        </div>
                        <div class="product-info">
                            <a class="product-title">
                                Atualização de Voo
                                <span class="badge badge-info float-right">Voo</span>
                            </a>
                            <span class="product-description">
                                Voo FR9021 alterou o horário de partida.
                            </span>
                            <div class="notification-time text-muted small mt-1">
                                2 Dezembro . 16:55
                            </div>
                        </div>
                    </li>

                    <!-- Notificação: Incidente -->
                    <li class="item">
                        <div class="product-img">
                            <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                        </div>
                        <div class="product-info">
                            <a class="product-title">
                                Incidente de Segurança
                                <span class="badge badge-danger float-right">Incidente</span>
                            </a>
                            <span class="product-description">
                                Bagagem suspeita reportada no terminal 2.
                            </span>
                            <div class="notification-time text-muted small mt-1">
                                30 Novembro . 20:31
                            </div>
                        </div>
                    </li>

                    <!-- Notificação: Check-in/Bilhete -->
                    <li class="item">
                        <div class="product-img">
                            <i class="fas fa-ticket-alt fa-2x text-success"></i>
                        </div>
                        <div class="product-info">
                            <a class="product-title">
                                Novo Check-in
                                <span class="badge badge-success float-right">Bilhete</span>
                            </a>
                            <span class="product-description">
                                Passageiro completou check-in para TP123.
                            </span>
                            <div class="notification-time text-muted small mt-1">
                                30 Novembro . 16:00
                            </div>
                        </div>
                    </li>

                    <!-- Mais notificações (exemplo) -->

                    <li class="item">
                        <div class="product-img">
                            <i class="fas fa-user-md fa-2x text-danger"></i>
                        </div>
                        <div class="product-info">
                            <a class="product-title">
                                Atraso devido à meteorologia
                                <span class="badge badge-danger float-right">Incidente</span>
                            </a>
                            <span class="product-description">
                                Condições infavoráveis para descolagem do Voo XP451. Previsto a sua descolagem em 4 horas.
                            </span>
                            <div class="notification-time text-muted small mt-1">
                                27 Novembro . 15:22
                            </div>
                        </div>
                    </li>

                </ul>
            </div>

            <div class="card-footer text-center">
                <a href="<?= \yii\helpers\Url::to(['/notificacao/index']) ?>" class="uppercase">
                    View All Notifications
                </a>
            </div>
        </div>

    </div>


</div>

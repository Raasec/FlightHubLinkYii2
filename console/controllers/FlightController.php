<?php

namespace console\controllers;

use yii\console\Controller;
use common\models\Voo;
use common\models\Bilhete;
use yii\helpers\Console;
use common\services\AirlineSeeder;


/**
 * ESTE CONSOLE CONTROLLER É PARA TAREFAS AUTOMÁTICAS RELACIONADAS COM VOOS.
 * Da para dar run no terminal com: php yii flight/deactivate-expired
 */
class FlightController extends Controller
{
    /**
     * procura voos que já foram (departure_date < NOW) 
     * e que ainda estejam com status ativo (status = '1')
     * e desativa-os para não sobrecarregar nada
     */
    public function actionDeactivateExpired()
    {
        $this->stdout("limpeza de voos expirados \n", Console::FG_CYAN);

        // damos run a 1 update na bd para ser super eficiente
        try {
            $count = Voo::updateAll(
                ['status' => 0], 
                [
                    'and', 
                    ['!=', 'status', 0], // Só mexe no que ainda n esta 0
                    ['<', 'departure_date', date('Y-m-d H:i:s')]
                ]
            );

            if ($count > 0) {
                $this->stdout("Sucesso: $count voos foram desativados.\n", Console::FG_GREEN);
            } else {
                $this->stdout("Nada para limpar. Todos os voos ativos são validos.\n", Console::FG_YELLOW);
            }
        } catch (\Exception $e) {
            $this->stderr("Erro ao atualizar voos: " . $e->getMessage() . "\n", Console::FG_RED);
            return Controller::EXIT_CODE_ERROR;
        }

        $this->stdout("tarefa concluída \n", Console::FG_GREEN);
        return Controller::EXIT_CODE_NORMAL;
    }

    /**
     * GERA VOOS ALEATORIOS PARA TESTES (é suposto imitar um sistema que daria feed a flights ao aeroporto) 
     * php yii flight/seed [quantidade]
     * honestamente tanto isto como o deactivate-expired sao para testes e não boas solutions mas é o melhor
     * que consigo fazer na ultima semana
     */
    public function actionFeed($count = 10)
    {
        $this->stdout("A criar $count voos random\n", Console::FG_GREEN);

        $airlines = \common\models\CompanhiaAerea::find()->column();
        if (empty($airlines)) {
            $this->stderr("Erro: Nao existem companhias aereas na base de dados.\n", Console::FG_RED);
            return Controller::EXIT_CODE_ERROR;
        }

        //algumas coisas pre definidas
        $employees = \common\models\Funcionario::find()->column();
        $gates = ['A', 'B', 'C', 'D'];
        $cities = ['Lisboa', 'Porto', 'Faro', 'Funchal', 'Madrid', 'Paris', 'Londres', 'Berlim', 'Roma', 'Amesterdão'];
        $prefixes = ['TP', 'LH', 'AF', 'BA', 'FR'];

        $created = 0;
        for ($i = 0; $i < $count; $i++) {
            $voo = new Voo();
            
            // random 
            $isDeparture = (rand(0, 1) == 1);
            $origin = $isDeparture ? 'Lisboa' : $cities[array_rand($cities)];
            $dest = $isDeparture ? $cities[array_rand($cities)] : 'Lisboa';
            
            if ($origin == $dest) $dest = 'Ponta Delgada'; // da prevent que a mesma cidade seja o destino

            $voo->id_companhia = $airlines[array_rand($airlines)];
            $voo->numero_voo = $prefixes[array_rand($prefixes)] . rand(100, 999);
            $voo->origin = $origin;
            $voo->destination = $dest;
            $voo->tipo_voo = $isDeparture ? 'departure' : 'arrival';
            $voo->gate = $gates[array_rand($gates)];
            $voo->status = 1;
            
            if (!empty($employees)) {
                $voo->id_funcionario_responsavel = $employees[array_rand($employees)];
            }

            // Data random nos proximos 7 dias (podia meter meses ou algo assim, mas isto é para testes e consistency)
            $daysOffset = rand(0, 7);
            $hoursOffset = rand(0, 23);
            $minsOffset = rand(0, 59);
            $date = date('Y-m-d H:i:s', strtotime("+$daysOffset days +$hoursOffset hours +$minsOffset minutes"));
            
            $voo->departure_date = $date;
            $voo->arrival_date = date('Y-m-d H:i:s', strtotime($date . ' +2 hours'));

            if ($voo->save()) {
                $created++;
                $this->stdout("Criado: {$voo->numero_voo} ($origin -> $dest) em $date\n", Console::FG_GREEN);
            } else {
                $this->stderr("Falha ao criar voo {$i}: " . json_encode($voo->errors) . "\n");
            }
        }

        $this->stdout("feed concluido: $created voos gerados \n", Console::FG_CYAN);
        return Controller::EXIT_CODE_NORMAL;
    }

    /**
     * atualiza o status dos bilhetes de voos que ja aterraram.
     * Bilhetes que estao paid ou checkin passam para Used se o voo ja chegou (deviamos ter feito ENUM na BD)
     * php yii flight/update-ticket-status
     */
    public function actionUpdateTicketStatus()
    {
        $this->stdout("Atualização de bilhetes em curso...\n", Console::FG_CYAN);

        try {
            // Assumimos que Paid e Check-in sao os status que queremos mudar para Used
            // Se o voo já aterrou há algum tempo tipo mais de 24h talvez Expired? 
            
            $now = date('Y-m-d H:i:s');
            
            $subQuery = Voo::find()
                ->select('id_voo')
                ->where(['<', 'arrival_date', $now]);

            $count = Bilhete::updateAll(
                ['status' => 'Used'],
                [
                    'and',
                    ['in', 'id_voo', $subQuery],
                    ['in', 'status', ['Paid', 'Check-in']]
                ]
            );

            if ($count > 0) {
                $this->stdout("Sucesso: $count bilhetes foram atualizados para Used.\n", Console::FG_GREEN);
            } else {
                $this->stdout("Nada para atualizar. Todos os bilhetes estão com status correto.\n", Console::FG_YELLOW);
            }

        } catch (\Exception $e) {
            $this->stderr("Erro ao atualizar status dos bilhetes: " . $e->getMessage() . "\n", Console::FG_RED);
            return Controller::EXIT_CODE_ERROR;
        }

        $this->stdout("Tarefa concluida.\n", Console::FG_GREEN);
        return Controller::EXIT_CODE_NORMAL;
    }


    // Sinc com as airlines criadas via Seed no services common
    //region AirlineSync
    public function actionSyncAirlines()
    {
        $result = AirlineSeeder::syncDefaultAirlines();

        $this->stdout("Airlines synced successfully\n");
        $this->stdout("Total: {$result['total']}\n");
        $this->stdout("Created: {$result['created']}\n");
        $this->stdout("Updated: {$result['updated']}\n");
    }

    //endregion
}

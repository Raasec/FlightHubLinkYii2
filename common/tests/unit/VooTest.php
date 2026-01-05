<?php

namespace common\tests\unit;

use yii\console\Application;
use yii\db\Connection;
use Yii;
use common\models\Voo;
use common\models\CompanhiaAerea;

class VooTest extends \Codeception\Test\Unit
{
    protected function _before(): void
    {
        new Application([
            'id' => 'test-app',
            'basePath' => dirname(__DIR__, 2),
            'components' => [
                'db' => [
                    'class' => Connection::class,
                    'dsn' => 'mysql:host=localhost;dbname=aeroportodb_test',
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
                ],
            ],
        ]);
    }

    protected function createCompanhia(): CompanhiaAerea
    {
        $companhia = new CompanhiaAerea();
        $companhia->name = 'Airline ' . Yii::$app->security->generateRandomString(6);
        $companhia->iata_code = 'TP';
        $companhia->country_origin = 'Portugal';
        $companhia->save(false);

        return $companhia;
    }

    protected function createValidVoo(): Voo
    {
        $companhia = $this->createCompanhia();

        $voo = new Voo();
        $voo->id_companhia = $companhia->id_companhia;
        $voo->numero_voo = 'TP' . rand(100, 999);
        $voo->origin = 'LIS';
        $voo->destination = 'PDL';
        $voo->tipo_voo = 'departure';
        $voo->departure_date = '2025-01-01 10:00';
        $voo->arrival_date = '2025-01-01 12:00';
        $voo->gate = 'A';
        $voo->status = 1;

        return $voo;
    }

    public function testGateMustBeValid(): void
    {
        $voo = $this->createValidVoo();
        $voo->gate = 'Z';

        $this->assertFalse($voo->validate(['gate']));
    }

    public function testStatusMustBeValid(): void
    {
        $voo = $this->createValidVoo();
        $voo->status = 5;

        $this->assertFalse($voo->validate(['status']));
    }

    public function testTipoVooMustBeValid(): void
    {
        $voo = $this->createValidVoo();
        $voo->tipo_voo = 'invalid';

        $this->assertFalse($voo->validate(['tipo_voo']));
    }

    public function testVooIsSavedInDatabase(): void
    {
        $voo = $this->createValidVoo();

        $this->assertTrue($voo->save());
        $this->assertNotNull($voo->id_voo);
    }

    public function testVooCompanhiaRelation(): void
    {
        $voo = $this->createValidVoo();
        $voo->save(false);

        $this->assertNotNull($voo->companhia);
        $this->assertEquals($voo->id_companhia, $voo->companhia->id_companhia);
    }
}

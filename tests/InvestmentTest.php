<?php
namespace App\Tests;

require_once __DIR__ . '/../models/Loan.php';
require_once __DIR__ . '/../models/Tranche.php';
require_once __DIR__ . '/../models/Investor.php';
require_once __DIR__ . '/../models/Investment.php';
require_once __DIR__ . '/../services/InvestmentService.php';

use PHPUnit\Framework\TestCase;

use App\Models\Investor;
use App\Models\Investment;
use App\Models\Loan;
use App\Models\Tranche;
use App\Services\InvestmentService;

class InvestmentTest extends TestCase
{
    protected $trancheA;
    protected $trancheB;
    protected $loan;
    protected $investor1;
    protected $investor2;
    protected $investor3;
    protected $investor4;

    protected function setUp()
    {
        $this->trancheA = Tranche::create('A',1000,0.03);
        $this->trancheB = Tranche::create('B',1000,0.06);

        // Set up the Loan
        $startDate = \DateTime::createFromFormat('d/m/Y', '01/10/2015');
        $endDate = \DateTime::createFromFormat('d/m/Y', '15/11/2015');
        $this->loan = Loan::create($startDate,$endDate,[$this->trancheA, $this->trancheB]);

        // Set up some Investors
        $this->investor1 = Investor::create(1000);
        $this->investor2 = Investor::create(1000);
        $this->investor3 = Investor::create(1000);
        $this->investor4 = Investor::create(1000);
    }

    public function testOverInvestmentOfTranche()
    {

        InvestmentService::invest($this->investor1,1000,$this->trancheA, \DateTime::createFromFormat('d/m/Y', '03/10/2015'));

        $this->assertEquals(0,$this->trancheA->getInvestmentAvailable());
        $this->assertEquals(1000,$this->trancheA->getInvestmentTotal());
        $this->assertEquals(1,count($this->trancheA->getInvestmentTotal()));

        $this->expectException(\Exception::class);

        InvestmentService::invest($this->investor2,1,$this->trancheA, \DateTime::createFromFormat('d/m/Y', '04/10/2015'));

        $this->assertEquals(0,$this->trancheA->getInvestmentAvailable());
        $this->assertEquals(1000,$this->trancheA->getInvestmentTotal());
        $this->assertEquals(1,count($this->trancheA->getInvestmentTotal()));

    }

    public function testInvestmentLargerThanBalance()
    {

        InvestmentService::invest($this->investor3,500,$this->trancheB, \DateTime::createFromFormat('d/m/Y', '10/10/2015'));

        $this->assertEquals(500,$this->trancheB->getInvestmentAvailable());
        $this->assertEquals(500,$this->trancheB->getInvestmentTotal());
        $this->assertEquals(1,count($this->trancheB->getInvestmentTotal()));

        $this->expectException(\Exception::class);

        InvestmentService::invest($this->investor4,1100,$this->trancheB, \DateTime::createFromFormat('d/m/Y', '25/10/2015'));

        $this->assertEquals(500,$this->trancheB->getInvestmentAvailable());
        $this->assertEquals(500,$this->trancheB->getInvestmentTotal());
        $this->assertEquals(1,count($this->trancheB->getInvestmentTotal()));

    }

    public function testInterestCalculations()
    {

        InvestmentService::invest($this->investor1,1000,$this->trancheA, \DateTime::createFromFormat('d/m/Y', '03/10/2015'));
        InvestmentService::invest($this->investor3,500,$this->trancheB, \DateTime::createFromFormat('d/m/Y', '10/10/2015'));

        $startDate = \DateTime::createFromFormat('d/m/Y', '01/10/2015');
        $endDate = \DateTime::createFromFormat('d/m/Y', '31/10/2015');
        $this->assertEquals(28.06,$this->investor1->getEarningsForPeriod($startDate,$endDate));
        $this->assertEquals(0,$this->investor2->getEarningsForPeriod($startDate,$endDate));
        $this->assertEquals(21.29,$this->investor3->getEarningsForPeriod($startDate,$endDate));
        $this->assertEquals(0,$this->investor4->getEarningsForPeriod($startDate,$endDate));

    }
}

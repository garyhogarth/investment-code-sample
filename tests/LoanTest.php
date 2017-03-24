<?php
namespace App\Tests;

require_once __DIR__ . '/../models/Loan.php';
require_once __DIR__ . '/../models/Tranche.php';

use PHPUnit\Framework\TestCase;
use App\Models\Loan;
use App\Models\Tranche;

class LoanTest extends TestCase
{
    /**
     * @covers Loan::create()
     */
    public function testFactoryMethod()
    {
        $startDate = new \DateTime('now');
        $endDate = new \DateTime('+ 1 week');
        $trancheA = new Tranche('A',1000,0.03);
        $trancheB = new Tranche('B',1000,0.06);


        $loan = Loan::create($startDate, $endDate, [$trancheA, $trancheB]);

        $this->assertEquals($startDate,$loan->getStartDate());
        $this->assertEquals($endDate,$loan->getEndDate());
        $this->assertEquals(2,count($loan->getTranches()));
        $this->assertEquals($trancheA,$loan->getTranches()[0]);
        $this->assertEquals($trancheB,$loan->getTranches()[1]);
    }

    /**
     * @covers Loan::setStartDate()
     * @covers Loan::setEndDate()
     * @covers Loan::addTranche()
     * @covers Loan::getTranches()
     * @covers Loan::getStartDate()
     * @covers Loan::getEndDate()
     */
    public function testSettersSetCorrectlyWhenGivenValidData()
    {
        $startDate = new \DateTime('now');
        $endDate = new \DateTime('+ 1 week');
        $trancheA = new Tranche('A',1000,0.03);
        $trancheB = new Tranche('B',1000,0.06);


        $loan = new Loan();
        $loan->setStartDate($startDate);
        $loan->setEndDate($endDate);

        $this->assertEquals($startDate,$loan->getStartDate());
        $this->assertEquals($endDate,$loan->getEndDate());

        $loan->addTranche($trancheA);
        $this->assertEquals(1,count($loan->getTranches()));

        $loan->addTranche($trancheB);
        $this->assertEquals(2,count($loan->getTranches()));

        $this->assertEquals($trancheA,$loan->getTranches()[0]);
        $this->assertEquals($trancheB,$loan->getTranches()[1]);

    }

    /**
     * @covers Loan::setStartDate()
     */
    public function testSetStartDoesNotAllowNonDateTimeObjects()
    {
        $startDate = 'test';

        $this->expectException(\TypeError::class);

        $loan = new Loan();
        $loan->setStartDate($startDate);

        $this->assertNotEquals($startDate,$loan->getStartDate());
    }

    /**
     * @covers Loan::setEndDate()
     */
    public function testSetEndDoesNotAllowNonDateTimeObjects() {
        $endDate = 'test';

        $this->expectException(\TypeError::class);

        $loan = new Loan();
        $loan->setStartDate($endDate);

        $this->assertNotEquals($endDate,$loan->getEndDate());
    }

    /**
     * @covers Loan::addTranche()
     */
    public function testAddTrancheDoesNotAllowNonTrancheObjects() {
        $tranche = 'test';

        $this->expectException(\TypeError::class);

        $loan = new Loan();
        $loan->addTranche($tranche);

        $this->assertEquals(0,count($loan->getTranches()));
    }

}

<?php
namespace App\Tests;

require_once __DIR__ . '/../models/Loan.php';

use PHPUnit\Framework\TestCase;
use App\Models\Loan;

class LoanTest extends TestCase
{
    /**
     * @covers Loan::setStartDate()
     */
    public function testSetStartDateSetsCorrectly() {
        $startDate = new \DateTime('now');
        $endDate = new \DateTime('+ 1 week');

        $loan = new Loan();
        $loan->setStartDate($startDate);
        $loan->setEndDate($endDate);

        $this->assertEquals($startDate,$loan->getStartDate());
        $this->assertEquals($endDate,$loan->getEndDate());
    }

    /**
     * @covers Loan::setStartDate()
     */
    public function testSetStartDoesNotAllowNonDateTimeObjects() {
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

}

<?php
namespace App\Tests;
require_once __DIR__ . '/../models/Tranche.php';

use PHPUnit\Framework\TestCase;
use App\Models\Tranche;

class TrancheTest extends TestCase
{
    /**
     * @covers Tranche::setMonthlyInterestRate()
     * @covers Tranche::setAmount()
     */
    public function testSettersSetCorrectlyWhenGivenValidData() {
        $interestRate = 0.03;
        $amount = 1000;

        $tranche = new Tranche();

        $tranche->setMonthlyInterestRate($interestRate);
        $this->assertEquals($interestRate,$tranche->getMonthlyInterestRate());

        $tranche->setAmount($interestRate);
        $this->assertEquals($amount,$tranche->getAmount());
    }

    /**
     * @covers Tranche::setMonthlyInterestRate()
     */
    public function testSetMonthlyInterestRateDoesNotAllowNonFloat() {
        $interestRate = 'test';

        $this->expectException(\TypeError::class);

        $tranche = new Tranche();
        $tranche->setMonthlyInterestRate($interestRate);

        $this->assertNotEquals($interestRate,$tranche->getMonthlyInterestRate());
    }

}

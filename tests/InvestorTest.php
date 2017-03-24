<?php
namespace App\Tests;

use App\Models\Investor;
use PHPUnit\Framework\TestCase;

class InvestorTest extends TestCase
{
    /**
     * @covers Loan::create()
     */
    public function testFactoryMethod()
    {
        $balance = 1000;

        $investor = Investor::create($balance);

        $this->assertEquals($balance,$investor->getBalance());
    }

    /**
     * @covers Investor::setBalance()
     * @covers Investor::getBalance()
     */
    public function testSettersSetCorrectlyWhenGivenValidData()
    {
        $balance = 1000;

        $investor = new Investor();
        $investor->setBalance($balance);

        $this->assertEquals($balance,$investor->getBalance());

    }
}

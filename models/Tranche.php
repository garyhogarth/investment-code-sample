<?php

namespace App\Models;


class Tranche
{

    private $name;
    private $amount;
    private $monthlyInterestRate;
    private $loan;
    private $investments = [];


    /**
     * Factory method
     *
     * @param $name
     * @param $amount
     * @param $monthlyInterestRate
     * @return Tranche
     */
    public static function create($name, $amount, $monthlyInterestRate) : Tranche
    {
        $tranche = new Tranche();
        $tranche->setName($name);
        $tranche->setAmount($amount);
        $tranche->setMonthlyInterestRate($monthlyInterestRate);

        return $tranche;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getAmount() : float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getMonthlyInterestRate() : float
    {
        return $this->monthlyInterestRate;
    }

    /**
     * @param float $monthlyInterestRate
     */
    public function setMonthlyInterestRate(float $monthlyInterestRate)
    {
        $this->monthlyInterestRate = $monthlyInterestRate;
    }

    /**
     * @return Loan
     */
    public function getLoan() : Loan
    {
        return $this->loan;
    }

    /**
     * @param Loan $loan
     */
    public function setLoan(Loan $loan)
    {
        $this->loan = $loan;
    }

    /**
     * @return array
     */
    public function getInvestments(): array
    {
        return $this->investments;
    }

    /**
     * @param Investment $investment
     */
    public function addInvestment(Investment $investment)
    {
        $this->investments[] = $investment;
    }

    /**
     * @return float
     */
    public function getInvestmentTotal() : float
    {
        $total = array_reduce($this->getInvestments(), function($i, Investment $investment) {
            return $i += $investment->getAmount();
        });

        return $total ? floatval($total) : 0.00;
    }

    /**
     * @return float
     */
    public function getInvestmentAvailable() : float
    {
        return $this->getAmount() - $this->getInvestmentTotal();
    }

}
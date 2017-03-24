<?php

namespace App\Models;


class Tranche
{

    private $amount;
    private $monthlyInterestRate;

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount(float $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getMonthlyInterestRate()
    {
        return $this->monthlyInterestRate;
    }

    /**
     * @param mixed $monthlyInterestRate
     */
    public function setMonthlyInterestRate(float $monthlyInterestRate)
    {
        $this->monthlyInterestRate = $monthlyInterestRate;
    }


}
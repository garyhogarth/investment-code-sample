<?php

namespace App\Models;


class Investor
{

    private $balance;
    private $investments = [];

    /**
     * Factory method
     *
     * @param $balance
     * @return Investor
     */
    public static function create($balance) {
        $investor = new Investor();
        $investor->setBalance($balance);

        return $investor;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param mixed $balance
     */
    public function setBalance(float $balance)
    {
        $this->balance = $balance;
    }

    /**
     * @param float $amount
     */
    public function modifyBalance(float $amount) {
        $this->setBalance($this->getBalance() + $amount);
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
        $this->modifyBalance($investment->getAmount()*-1);
    }

}
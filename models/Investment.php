<?php

namespace App\Models;


class Investment
{

    private $investor;
    private $tranche;
    private $amount;

    /**
     * @param Investor $investor
     * @param Tranche $tranche
     * @param float $amount
     * @return Investment
     */
    public static function create(Investor $investor, Tranche $tranche, float $amount = 0.00)
    {
        $investment = new Investment();
        $investment->investor = $investor;
        $investment->tranche = $tranche;
        $investment->amount = $amount;

        return $investment;
    }

    /**
     * @return mixed
     */
    public function getInvestor()
    {
        return $this->investor;
    }

    /**
     * @return mixed
     */
    public function getTranche()
    {
        return $this->tranche;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $investor
     */
    public function setInvestor(Investor $investor)
    {
        $this->investor = $investor;
    }

    /**
     * @param mixed $tranche
     */
    public function setTranche(Tranche $tranche)
    {
        $this->tranche = $tranche;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount(float $amount)
    {
        $this->amount = $amount;
    }


}
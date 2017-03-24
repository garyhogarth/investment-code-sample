<?php

namespace App\Models;


class Investment
{

    private $investor;
    private $investmentDate;
    private $tranche;
    private $amount;

    /**
     * @param Investor $investor
     * @param Tranche $tranche
     * @param float $amount
     * @return Investment
     */
    public static function create(Investor $investor, Tranche $tranche, float $amount = 0.00, $investmentDate)
    {
        $investment = new Investment();
        $investment->setInvestor($investor);
        $investment->setTranche($tranche);
        $investment->setAmount($amount);
        $investment->setInvestmentDate($investmentDate);

        return $investment;
    }

    /**
     * @return Investor
     */
    public function getInvestor() : Investor
    {
        return $this->investor;
    }

    /**
     * @return Tranche
     */
    public function getTranche() : Tranche
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
     * @param Investor $investor
     */
    public function setInvestor(Investor $investor)
    {
        $this->investor = $investor;
    }

    /**
     * @param Tranche $tranche
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

    /**
     * @return mixed
     */
    public function getInvestmentDate()
    {
        return $this->investmentDate;
    }

    /**
     * @param \DateTime $investmentDate
     */
    public function setInvestmentDate(\DateTime $investmentDate)
    {
        $this->investmentDate = $investmentDate;
    }



    public function getEarningsForPeriod(\DateTime $startDate, \DateTime $endDate)
    {
        // Before we modify the dates, lets clone them so that we don't accidentally mutate them
        $cleanStartDate = clone $startDate;
        $cleanStartDate->setTime(0,0,0);

        $cleanEndDate = clone $endDate;
        $cleanEndDate->setTime(0,0,0)->modify('+ 1 day');

        $daysInMonth = $cleanEndDate->diff($cleanStartDate)->format("%a");
        $validDaysInMonth = $cleanEndDate->diff($this->getInvestmentDate()->setTime(0,0,0))->format("%a");

        if ($validDaysInMonth <= 0) {
            return 0;
        } elseif ($validDaysInMonth >= $daysInMonth) {
            $percentage = 1;
        } else {
            $percentage = $validDaysInMonth/$daysInMonth;
        }

        return round($this->getTranche()->getMonthlyInterestRate()*$this->getAmount()*$percentage,2);
    }


}
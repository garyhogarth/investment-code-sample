<?php

namespace App\Models;


class Loan
{
    private $startDate;
    private $endDate;
    private $tranches = [];


    /**
     * Factory Method
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param array $tranches
     * @return Loan
     */
    public static function create(\DateTime $startDate, \DateTime $endDate, array $tranches) : Loan
    {
        $loan = new Loan();
        $loan->setStartDate($startDate);
        $loan->setEndDate($endDate);

        foreach ($tranches as $tranche) {
            $loan->addTranche($tranche);
        }

        return $loan;
    }

    /**
     * @return mixed
     */
    public function getStartDate() : \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate() : \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime  $endDate
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return array
     */
    public function getTranches() : array
    {
        return $this->tranches;
    }

    /**
     * @param Tranche $tranche
     */
    public function addTranche(Tranche $tranche)
    {
        $tranche->setLoan($this);
        $this->tranches[] = $tranche;
    }

}
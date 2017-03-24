<?php

namespace App\Models;


class Loan
{
    private $startDate;
    private $endDate;
    private $tranches = [];

    public function __construct()
    {
        // Do nothing for now
    }

    /**
     * @return mixed
     */
    public function getStartDate()
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
    public function getEndDate()
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
    public function getTranches()
    {
        return $this->tranches;
    }

    /**
     * @param Tranche $tranche
     * @return array
     */
    public function addTranche(Tranche $tranche)
    {
        return $this->tranches[] = $tranche;
    }

}
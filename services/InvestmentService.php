<?php

namespace App\Services;

use App\Models\Investment;
use App\Models\Investor;
use App\Models\Tranche;
use PHPUnit\Framework\Exception;

class InvestmentService
{

    /**
     * @param Investor $investor
     * @param float $amount
     * @param Tranche $tranche
     * @param \DateTime|null $investmentDate
     * @return Investment
     * @throws \Exception
     */
    public static function invest(Investor $investor,float $amount,Tranche $tranche, \DateTime $investmentDate = null)
    {

        // Set the date to the current data unless defined
        $investmentDate = $investmentDate instanceof \DateTime ? $investmentDate : new \DateTime();

        // Check the date is OK
        if ($investmentDate <= $tranche->getLoan()->getStartDate()) {
            throw new \Exception('Loan not yet open');
        }

        if ($investmentDate >=$tranche->getLoan()->getEndDate()) {
            throw new \Exception('Loan has closed');
        }

        // Check balance of user
        if ($investor->getBalance() < $amount) {
            throw new \Exception('Investor does not have sufficient funds');
        }

        // Check remaining loan
        if ($tranche->getInvestmentAvailable() < $amount) {
            throw new \Exception('Tranche does not have sufficient funds');
        }

        // OK lets create the investment and deduct from the investors wallet
        $investment = Investment::create($investor,$tranche,$amount);
        $tranche->addInvestment($investment);
        $investor->addInvestment($investment);
    }

}
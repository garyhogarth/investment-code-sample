<?php

require_once __DIR__ . '/../models/Loan.php';
require_once __DIR__ . '/../models/Tranche.php';
require_once __DIR__ . '/../models/Investor.php';
require_once __DIR__ . '/../models/Investment.php';
require_once __DIR__ . '/../services/InvestmentService.php';

use App\Models\Investor;
use App\Models\Loan;
use App\Models\Tranche;

use App\Services\InvestmentService;

// Set up some Tranches
$trancheA = Tranche::create('A',1000,0.03);
$trancheB = Tranche::create('B',1000,0.06);

// Set up the Loan
$startDate = \DateTime::createFromFormat('d/m/Y', '01/10/2015');
$endDate = \DateTime::createFromFormat('d/m/Y', '15/11/2015');
$loan = Loan::create($startDate,$endDate,[$trancheA, $trancheB]);

// Set up some Investors
$investor1 = Investor::create(1000);
$investor2 = Investor::create(1000);
$investor3 = Investor::create(1000);
$investor4 = Investor::create(1000);

try {
    InvestmentService::invest($investor1,1000,$trancheA, \DateTime::createFromFormat('d/m/Y', '03/10/2015'));
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "</br>";
}

try {
    InvestmentService::invest($investor2,1,$trancheA, \DateTime::createFromFormat('d/m/Y', '04/10/2015'));
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "</br>";
}

try {
    InvestmentService::invest($investor3,500,$trancheB, \DateTime::createFromFormat('d/m/Y', '10/10/2015'));
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "</br>";
}

try {
    InvestmentService::invest($investor4,1100,$trancheB, \DateTime::createFromFormat('d/m/Y', '25/10/2015'));
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "</br>";
}

try {
    InvestmentService::invest($investor4,50,$trancheB, \DateTime::createFromFormat('d/m/Y', '25/11/2015'));
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "</br>";
}

try {
    InvestmentService::invest($investor4,50,$trancheB, \DateTime::createFromFormat('d/m/Y', '05/09/2015'));
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "</br>";
}

$startDate = \DateTime::createFromFormat('d/m/Y', '01/10/2015');
$endDate = \DateTime::createFromFormat('d/m/Y', '31/10/2015');

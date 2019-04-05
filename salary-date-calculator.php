<?php

require_once 'vendor/autoload.php';

use App\ReportGenerator;

$fileName = $argv[1] ?? 'report.csv';

$reportGenerator = new ReportGenerator();

try {
    echo $reportGenerator->generateReport($fileName) . PHP_EOL;
} catch (\Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

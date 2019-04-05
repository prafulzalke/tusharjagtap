<?php

declare(strict_types = 1);

namespace App;

/**
 * Class ReportGenerator responsible for generating report.
 *
 * @package App
 */
class ReportGenerator
{
    /**
     * Last month.
     */
    const LAST_MONTH = 12;

    /**
     * Salary date calculator.
     *
     * @var SalaryDateCalculator
     */
    private $salaryDateCalculator;

    /**
     * CSV writer.
     *
     * @var CsvWriter
     */
    private $csvWriter;

    /**
     * Get salary date calculator.
     *
     * @return SalaryDateCalculator
     */
    public function getSalaryDateCalculator(): SalaryDateCalculator
    {
        if (null === $this->salaryDateCalculator) {
            $this->salaryDateCalculator = new SalaryDateCalculator();
        }

        return $this->salaryDateCalculator;
    }

    /**
     * Get Csv writer
     *
     * @return CsvWriter
     */
    public function getCsvWriter(): CsvWriter
    {
        if (null === $this->csvWriter) {
            $this->csvWriter = new CsvWriter();
        }

        return $this->csvWriter;
    }

    /**
     * Generate report.
     *
     * @param string $inputFilePath
     * @return string
     */
    public function generateReport(string $inputFilePath): string
    {
        try {
            $dateTime = new \DateTime();
            $currentMonth = $dateTime->format('n');
            $currentYear = $dateTime->format('Y');

            for ($month = $currentMonth; $month <= self::LAST_MONTH; $month++) {
                $salaryPayData[$month] = $this->getSalaryDateCalculator()->getPayableDatesData((string)$month, (string)$currentYear);
            }

            return $this->getCsvWriter()->write($inputFilePath, $salaryPayData);
        } catch (\Exception $exception) {
            return 'Due to some technical error or invalid inputs, CSV is not generated.';
        }
    }
}

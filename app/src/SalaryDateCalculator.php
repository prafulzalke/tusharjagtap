<?php

declare(strict_types = 1);

namespace App;

/**
 * Class SalaryDateCalculator responsible for date calculations.
 *
 * @package App
 */
class SalaryDateCalculator
{
    /**
     * Bonus pay day.
     */
    const BONUS_PAY_DAY = 15;

    /**
     * Working weekdays count.
     */
    const WORKING_WEEKDAYS_COUNT = 5;

    /**
     * Get list of payable dates for the provided month and year.
     *
     * @param string $month
     * @param string $year
     * @return array
     */
    public function getPayableDatesData(string $month, string $year): array
    {
        $dateObj = \DateTime::createFromFormat('!m', $month);
        $dateObj->setDate((int)$year, (int)$month, self::BONUS_PAY_DAY);
        $date = $dateObj->format('d-m-Y');
        $monthName = $dateObj->format('F');

        return [
            $monthName,
            $this->getSalaryPayDate($date),
            $this->getBonusPayDate($date)
        ];
    }

    /**
     * Get bonus pay date.
     *
     * @param string $bonusDate
     * @return string
     */
    private function getBonusPayDate(string $bonusDate): string
    {
        if ($this->isWeekend($bonusDate)) {
            $bonusDate = $this->getComingWednesdayDate($bonusDate);
        }

        return $bonusDate;
    }

    /**
     * Get salary pay date.
     *
     * @param string $salaryDate
     * @return string
     */
    private function getSalaryPayDate(string $salaryDate): string
    {
        $salaryDate = $this->getLastDateOfMonth($salaryDate);

        if ($this->isWeekend($salaryDate)) {
            $salaryDate = $this->getLastFridayDateOfTheMonth($salaryDate);
        }

        return $salaryDate;
    }

    /**
     * Get the last date of the month.
     *
     * @param string $date
     * @return string
     */
    private function getLastDateOfMonth(string $date): string
    {
        $dateTime = new \DateTime($date);
        $dateTime->modify('last day of this month');

        return $dateTime->format('d-m-Y');
    }

    /**
     * Check date is weekend.
     *
     * @param string $date
     * @return bool
     */
    private function isWeekend(string $date): bool
    {
        $dateTime = new \DateTime($date);

        return (self::WORKING_WEEKDAYS_COUNT < $dateTime->format('N'));
    }

    /**
     * Get coming Wednesday date.
     *
     * @param string $date
     * @return string
     */
    private function getComingWednesdayDate(string $date): string
    {
        $dateTime = new \DateTime($date);
        $dateTime->modify('next wednesday');

        return $dateTime->format('d-m-Y');
    }

    /**
     * Get last Friday date of the month.
     *
     * @param string $date
     * @return string
     */
    private function getLastFridayDateOfTheMonth(string $date): string
    {
        $dateTime = new \DateTime($date);
        $dateTime->modify('previous friday');

        return $dateTime->format('d-m-Y');
    }
}

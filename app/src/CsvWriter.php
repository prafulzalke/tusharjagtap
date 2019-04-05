<?php

declare(strict_types = 1);

namespace App;

/**
 * Class CsvWriter responsible to write csv.
 *
 * @package App
 */
class CsvWriter implements WriterInterface
{
    /**
     * Directory creator.
     *
     * @var DirectoryCreator
     */
    private $directoryCreator;

    /**
     * Get directory creator.
     *
     * @return DirectoryCreator
     */
    public function getDirectoryCreator(): DirectoryCreator
    {
        if (null === $this->directoryCreator) {
            $this->directoryCreator = new DirectoryCreator();
        }

        return $this->directoryCreator;
    }

    /**
     * Write salary pay data to csv.
     *
     * @param string $inputFilePath
     * @param array $salaryPayData
     * @return string
     */
    public function write(string $inputFilePath, array $salaryPayData): string
    {
        if ([] === $salaryPayData) {
            return 'Csv is not generated as there is no data available to be written in it.';
        }

        $pathParts = pathinfo($inputFilePath);
        $filePath = $this->getDirectoryCreator()->create($pathParts['dirname']);

        if ('' === $filePath) {
            return 'Due to some technical error unable to create csv file.';
        }

        $filePath = sprintf('%s/%s', $filePath, $pathParts['basename']);

        // Create a file pointer connected to the output stream
        $file = fopen($filePath, 'w');

        // Send the column headers
        fputcsv($file, ['Month name', 'Salary date', 'Bonus date'], ',', '"');

        // Output each row of the data
        foreach ($salaryPayData as $row) {
            fputcsv($file, $row, ',', '"');
        }

        fclose($file);

        return sprintf('Report generated in : %s', $pathParts['basename']);
    }
}

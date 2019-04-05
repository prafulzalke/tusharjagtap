<?php

declare(strict_types = 1);

namespace App;

/**
 * Interface WriterInterface to generate report.
 *
 * @package App
 */
interface WriterInterface
{
    /**
     * Export data to file.
     *
     * @param string $fileName
     * @param array $data
     * @return string
     */
    public function write(string $fileName, array $data): string;
}

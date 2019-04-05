<?php

declare(strict_types = 1);

namespace App;

/**
 * Class DirectoryCreator responsible for creating directory.
 *
 * @package App
 */
class DirectoryCreator
{
    /**
     * The default report directory name to store files.
     *
     * @var string
     */
    const DEFAULT_REPORT_DIRECTORY_PATH = 'SalaryReports';

    /**
     * Directory separator.
     *
     * @var string
     */
    const DIRECTORY_SEPARATOR = '/';

    /**
     * Permission code.
     */
    const PERMISSION_CODE = 0700;

    /**
     * Create directory.
     *
     * @param string $directoryName
     * @return string
     */
    public function create(string $directoryName): string
    {
        // Directory path to be create.
        $filePath = ('.' === $directoryName) ?
            self::DEFAULT_REPORT_DIRECTORY_PATH :
            sprintf( '%s%s%s',self::DEFAULT_REPORT_DIRECTORY_PATH, self::DIRECTORY_SEPARATOR, $directoryName);

        // Check directory is exists if not create new.
        if (!is_dir($filePath)) {
            if (!mkdir($filePath, self::PERMISSION_CODE, true)) {
                return '';
            }
        }

       return $filePath;
    }
}

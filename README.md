# Salary Payment Date tool

Salary Payment Date tool is a PHP library for dealing payment dates reminder.

## Assumptions 

1. Dates are displayed starting from the current date and only for the current year.
2. Saturday and Sunday are considered as weekend days.
3. Staff get regular monthly fixed base salary (i.e. on the last day of the month if it is not a week end day other wise the day before the last day of the month.)
4. Monthly bonus is paid on the 15th of the next month if that day is not a weekend day else on the first Wednesday after 15th.
5. Dates displayed are in the formats dd-mm-yyyy (For. e.g. 31-05-2019)
6. While executing the script through command line, user will provide the file-name with 
.csv extension only through command line. If no filename is provided, default file name will be considered as report.csv
7. All csv files will be generated within SalaryReports directory within the project only.

## Solution

We are making a console application.
1) Please unzip the directory and place it to the appropriate directory. 

2) Please run following command from the root directory of the project.

    ```
    composer install
    ```
## How to run
Run tests with following command.

 1) To generate CSV in default file `report.csv`.
    
    ```
    php salary-date-calculator.php
    ```
    
 2) To generate CSV in specific file.
    
    ```
    php salary-date-calculator.php salar-report.csv
    ```
 3) To generate CSV in specific location within SalaryReports.
    
    ```
    php salary-date-calculator.php /result/salary-report.csv
    ```
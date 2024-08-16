<?php

define('CUSTOMERS_FILE_PATH', 'customers-10000.csv');

function get_customers_data()
{
    $start_time = microtime(true);
    
    $opened_file_handler = fopen(CUSTOMERS_FILE_PATH, 'r');
    if ($opened_file_handler === false) {
        die("Error: Unable to open the file " . CUSTOMERS_FILE_PATH);
    }

    $data = [];
    $headers = [];
    $row_count = 0;
    while (!feof($opened_file_handler)) {

        $row = fgetcsv($opened_file_handler, 1024);
        if ($row !== false && !empty($row)) {
            if ($row_count == 0) {
                array_push($headers, $row);    
            } else {
                array_push($data, $row);
            }
        }

        $row_count++;
    }

    fclose($opened_file_handler);

    $end_time = microtime(true);
    $execution_time = $end_time - $start_time;

    return [
        'headers' => $headers,
        'data' => $data,
        'execution_time' => $execution_time
    ];
}

$customers = get_customers_data();

?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #2</title>
    <link rel="icon" href="https://phpsandbox.io/assets/img/brand/phpsandbox.png">
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css" />   
</head>
<body>

<h1>
    Customers
</h1>
<h4>
<?php foreach(range('A', 'Z') as $letter): ?>
    <a href="filtered.php?letter=<?php echo $letter; ?>"><?php echo $letter; ?></a>
<?php endforeach; ?>
</h4>
<small>
The dataset is retrieved from this URL <a href="https://www.datablist.com/learn/csv/download-sample-csv-files">https://www.datablist.com/learn/csv/download-sample-csv-files</a>
</small>
<p>Execution Time: <?php echo round($customers['execution_time'], 4); ?> seconds</p>
<table aria-label="Customers Dataset">
    <thead>
        <tr>
            <th>Customer ID</th>
            <th>Complete Name</th>
            <th>Company</th>
            <th>Address</th>
            <th>Email Address</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($customers['data'] as $record):
    ?>
        <tr>
            <td><?php echo htmlspecialchars($record[1]); ?></td>
            <td><?php echo htmlspecialchars("<strong>{$record[3]}</strong>, {$record[2]}"); ?></td>
            <td><?php echo htmlspecialchars($record[4]); ?></td>
            <td><?php echo htmlspecialchars($record[7]); ?></td>
            <td><?php echo htmlspecialchars($record[9]); ?></td>
        </tr>
    <?php
    endforeach;
    ?>
    </tbody>
</table>


</body>
</html>

<?php
$registrants = [];
if (($file = fopen('registrations.csv', 'r')) !== FALSE) {
    while (($data = fgetcsv($file, 1000, ',')) !== FALSE) {
        $registrants[] = $data;
    }
    fclose($file);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style-registrants.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrants List</title>
</head>
<body>
    <div class="header">
        <h1>List of Registrants</h1>
    </div>
    <table>
        <thead>
            <tr>
                <th>Complete Name</th>
                <th>Birthday</th>
                <th>Age</th>
                <th>Contact Number</th>
                <th>Sex</th>
                <th>Program</th>
                <th>Complete Address</th>
                <th>Email Address</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registrants as $registrant): ?>
                <tr>
                    <td><?php echo htmlspecialchars($registrant[0]); ?></td>
                    <td><?php echo htmlspecialchars($registrant[1]); ?></td>
                    <td><?php echo htmlspecialchars($registrant[2]); ?></td>
                    <td><?php echo htmlspecialchars($registrant[3]); ?></td>
                    <td><?php echo htmlspecialchars($registrant[4]); ?></td>
                    <td><?php echo htmlspecialchars($registrant[5]); ?></td>
                    <td><?php echo htmlspecialchars($registrant[6]); ?></td>
                    <td><?php echo htmlspecialchars($registrant[7]); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
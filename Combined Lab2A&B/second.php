<?php
$errors = [];
$form_data = [
    'name' => '',
    'birthday' => '',
    'age' => '',
    'contact' => '',
    'sex' => [],
    'program' => '',
    'address' => '',
    'email' => ''
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
        $errors['name'] = 'Complete Name is required.';
    } else {
        $form_data['name'] = $_POST['name'];
    }

    if (empty($_POST['birthday'])) {
        $errors['birthday'] = 'Birthday is required.';
    } else {
        $form_data['birthday'] = $_POST['birthday'];
    }

    if (empty($_POST['age'])) {
        $errors['age'] = 'Age is required.';
    } else {
        $form_data['age'] = $_POST['age'];
    }

    if (empty($_POST['contact'])) {
        $errors['contact'] = 'Contact Number is required.';
    } else {
        $form_data['contact'] = $_POST['contact'];
    }

    if (empty($_POST['sex'])) {
        $errors['sex'] = 'Please select one option for Sex.';
    } else {
        $form_data['sex'] = $_POST['sex'];
    }

    if (empty($_POST['program'])) {
        $errors['program'] = 'Program is required.';
    } else {
        $form_data['program'] = $_POST['program'];
    }

    if (empty($_POST['address'])) {
        $errors['address'] = 'Complete Address is required.';
    } else {
        $form_data['address'] = $_POST['address'];
    }

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email Address is required.';
    } else {
        $form_data['email'] = $_POST['email'];
    }

    if (empty($errors)) {
        if (($file = fopen('registrations.csv', 'a')) !== FALSE) {
            $age = date_diff(date_create($form_data['birthday']), date_create('today'))->y;
            fputcsv($file, [$form_data['name'], $form_data['birthday'], $age, $form_data['contact'], implode(', ', $form_data['sex']), $form_data['program'], $form_data['address'], $form_data['email']]);
            fclose($file);
        } else {
            echo "<p>Unable to open file for writing.</p>";
            exit();
        }

        header('Location: thankyou.php');
        exit();
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style-registration.css">

    <title>Registration Form</title>

</head>
<body>
    <section class="container">
        <div class="header-container">
            <img src="./img/logo.png" alt="Logo" class="logo">
            <header>Registration Form</header>
        </div>

        <?php if (!empty($errors)): ?>
        <div class="error-message">
            <strong>Please correct the following errors:</strong>
            <ul>
                <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <form class="form" action="registration.php" method="POST">
            <div class="input-box">
                <label>Complete Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($form_data['name']); ?>">
            </div>

            <div class="input-box">
                <label>Birthday:</label>
                <input type="date" name="birthday" value="<?php echo htmlspecialchars($form_data['birthday']); ?>">
            </div>

            <div class="input-box">
                <label>Age:</label>
                <input type="number" name="age" value="<?php echo htmlspecialchars($form_data['age']); ?>">
            </div>

            <div class="input-box">
                <label>Contact Number:</label>
                <input type="text" name="contact" value="<?php echo htmlspecialchars($form_data['contact']); ?>">
            </div>

            <div class="gender-box">
                <label>Sex:</label>
                <div class="gender-option">
                    <label><input type="checkbox" name="sex[]" value="Male" <?php if(in_array('Male', $form_data['sex'])) echo 'checked'; ?>> Male</label>
                    <label><input type="checkbox" name="sex[]" value="Female" <?php if(in_array('Female', $form_data['sex'])) echo 'checked'; ?>> Female</label>
                </div>
            </div>

            <div class="input-box">
                <label>Program:</label>
                <select name="program">
                    <option value="" <?php if (empty($form_data['program'])) echo 'selected'; ?>>Select Program</option>
                    <option value="Bachelor of Science in Information Technology" <?php if ($form_data['program'] == 'Bachelor of Science in Information Technology') echo 'selected'; ?>>Bachelor of Science in Information Technology</option>
                    <option value="Bachelor of Science in Computer Science" <?php if ($form_data['program'] == 'Bachelor of Science in Computer Science') echo 'selected'; ?>>Bachelor of Science in Computer Science</option>
                    <option value="Bachelor of Science in Multi-Media Arts" <?php if ($form_data['program'] == 'Bachelor of Science in Multi-Media Arts') echo 'selected'; ?>>Bachelor of Science in Multi-Media Arts</option>
                </select>
            </div>

            <div class="input-box">
                <label>Complete Address:</label>
                <input type="text" name="address" value="<?php echo htmlspecialchars($form_data['address']); ?>">
            </div>

            <div class="input-box">
                <label>Email Address:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($form_data['email']); ?>">
            </div>

            <button type="submit">Register</button>
        </form>
    </section>
</body>
</html>
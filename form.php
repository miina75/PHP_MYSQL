<?php
session_start();

$errors = [];
$values = [
    'fullname' => '',
    'email' => '',
    'birthplace' => '',
    'gender' => '',
    'faculty' => '',
    'languages' => [],
    'comment' => ''
];

$messages = [
    'fullname' => 'Please fill in your full name.',
    'email' => 'Please fill in your email.',
    'email_valid' => 'Please enter a valid email address.',
    'birthplace' => 'Please fill in your place of birth.',
    'gender' => 'Please select your gender.',
    'faculty' => 'Please select your faculty.',
    'languages' => 'Please select at least one language.'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $values['fullname'] = trim($_POST['fullname'] ?? '');
    $values['email'] = trim($_POST['email'] ?? '');
    $values['birthplace'] = trim($_POST['birthplace'] ?? '');
    $values['gender'] = $_POST['gender'] ?? '';
    $values['faculty'] = $_POST['faculty'] ?? '';
    $values['languages'] = $_POST['languages'] ?? [];
    $values['comment'] = trim($_POST['comment'] ?? '');

    if ($values['fullname'] === '') {
        $errors['fullname'] = $messages['fullname'];
    }

    if ($values['email'] === '') {
        $errors['email'] = $messages['email'];
    } elseif (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = $messages['email_valid'];
    }

    if ($values['birthplace'] === '') {
        $errors['birthplace'] = $messages['birthplace'];
    }

    if ($values['gender'] === '') {
        $errors['gender'] = $messages['gender'];
    }

    if ($values['faculty'] === '') {
        $errors['faculty'] = $messages['faculty'];
    }

    if (empty($values['languages'])) {
        $errors['languages'] = $messages['languages'];
    }

    if (empty($errors)) {
        $_SESSION['submitted_fullname'] = $values['fullname'];
        $_SESSION['submitted_email'] = $values['email'];
        $_SESSION['submitted_birthplace'] = $values['birthplace'];
        $_SESSION['submitted_gender'] = $values['gender'];
        $_SESSION['submitted_faculty'] = $values['faculty'];
        $_SESSION['submitted_languages'] = $values['languages'];
        $_SESSION['submitted_comment'] = $values['comment'];

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f7ff;
            margin: 0;
            padding: 30px;
        }

        form {
            max-width: 700px;
            margin: 30px auto;
            background: #fff;
            padding: 25px 30px;
            border: 1px solid #dfe8f5;
            border-radius: 14px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.08);
        }

        h1 {
            text-align: center;
            color: #1e3a8a;
            margin-bottom: 20px;
        }

        fieldset {
            border: 1px solid #d7e1f1;
            border-radius: 10px;
            padding: 18px;
            background: #fafcff;
        }

        legend {
            font-weight: bold;
            color: #1e3a8a;
            padding: 0 8px;
        }

        label {
            display: inline-block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #23395d;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 12px;
            border: 1px solid #c9d5ea;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 6px;
        }

        input[type="submit"],
        input[type="reset"] {
            background: #1e3a8a;
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            margin-right: 10px;
        }

        input[type="reset"] {
            background: #6b7280;
        }

        p {
            padding: 10px 12px;
            border-radius: 8px;
            margin: 0 0 15px 0;
        }

        p[style*="color:red"] {
            background: #fee2e2;
            border: 1px solid #fecaca;
        }

        h2 /{
            color: #1e3a8a;
        }
    </style>
</head>
<body>
    
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <h1>Student Registration</h1>

    <fieldset>
        <legend>Personal Info</legend>

        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($values['fullname']); ?>">
        <?php if (isset($errors['fullname'])) { echo "<div style='color:red; font-size:13px; margin-bottom:8px;'>" . htmlspecialchars($errors['fullname']) . "</div>"; } ?><br>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($values['email']); ?>">
        <?php if (isset($errors['email'])) { echo "<div style='color:red; font-size:13px; margin-bottom:8px;'>" . htmlspecialchars($errors['email']) . "</div>"; } ?><br>

        <label for="birthplace">Place of Birth</label>
        <input type="text" id="birthplace" name="birthplace" value="<?php echo htmlspecialchars($values['birthplace']); ?>">
        <?php if (isset($errors['birthplace'])) { echo "<div style='color:red; font-size:13px; margin-bottom:8px;'>" . htmlspecialchars($errors['birthplace']) . "</div>"; } ?><br>

        <label>Gender</label><br>
        <input type="radio" name="gender" value="male" <?php if ($values['gender'] === 'male') echo 'checked'; ?>> Male
        <input type="radio" name="gender" value="female" <?php if ($values['gender'] === 'female') echo 'checked'; ?>> Female
        <?php if (isset($errors['gender'])) { echo "<div style='color:red; font-size:13px; margin-top:6px; margin-bottom:8px;'>" . htmlspecialchars($errors['gender']) . "</div>"; } ?><br>

        <label for="faculty">Faculty</label>
        <select name="faculty" id="faculty">
            <option value="" <?php if ($values['faculty'] === '') echo 'selected'; ?>>-- Select Faculty --</option>
            <option value="computer" <?php if ($values['faculty'] === 'computer') echo 'selected'; ?>>Computer IT</option>
            <option value="engineering" <?php if ($values['faculty'] === 'engineering') echo 'selected'; ?>>Engineering</option>
            <option value="health" <?php if ($values['faculty'] === 'health') echo 'selected'; ?>>Health</option>
        </select>
        <?php if (isset($errors['faculty'])) { echo "<div style='color:red; font-size:13px; margin-bottom:8px;'>" . htmlspecialchars($errors['faculty']) . "</div>"; } ?><br>

        <label>Languages</label><br>
        <input type="checkbox" name="languages[]" value="English" <?php if (in_array('English', $values['languages'])) echo 'checked'; ?>> English
        <input type="checkbox" name="languages[]" value="Amharic" <?php if (in_array('Amharic', $values['languages'])) echo 'checked'; ?>> Amharic
        <input type="checkbox" name="languages[]" value="French" <?php if (in_array('French', $values['languages'])) echo 'checked'; ?>> French
        <input type="checkbox" name="languages[]" value="Arabic" <?php if (in_array('Arabic', $values['languages'])) echo 'checked'; ?>> Arabic
        <?php if (isset($errors['languages'])) { echo "<div style='color:red; font-size:13px; margin-top:6px; margin-bottom:8px;'>" . htmlspecialchars($errors['languages']) . "</div>"; } ?><br>
    </fieldset>
    <br>

    <label for="comment">Comment</label><br>
    <textarea id="comment" name="comment" rows="4" cols="40" placeholder="Write your comment here..."><?php echo htmlspecialchars($values['comment']); ?></textarea><br>

    <input type="submit" name="submit" value="Register">
    <input type="reset" name="reset" value="Clear"><br>
</form>



</body>
</html>

<?php
if (isset($_SESSION['submitted_fullname']) || isset($_SESSION['submitted_email'])) {
    echo "<h2>Submitted Information</h2>";
    echo "<p><strong>Full Name:</strong> " . htmlspecialchars($_SESSION['submitted_fullname'] ?? '') . "</p>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($_SESSION['submitted_email'] ?? '') . "</p>";
    echo "<p><strong>Place of Birth:</strong> " . htmlspecialchars($_SESSION['submitted_birthplace'] ?? '') . "</p>";
    echo "<p><strong>Gender:</strong> " . htmlspecialchars($_SESSION['submitted_gender'] ?? '') . "</p>";
    echo "<p><strong>Faculty:</strong> " . htmlspecialchars($_SESSION['submitted_faculty'] ?? '') . "</p>";

    $languages = $_SESSION['submitted_languages'] ?? [];
    if (is_array($languages) && count($languages) > 0) {
        echo "<p><strong>Languages:</strong> " . htmlspecialchars(implode(', ', $languages)) . "</p>";
    } else {
        echo "<p><strong>Languages:</strong> None selected</p>";
    }

    echo "<p><strong>Comment:</strong> " . htmlspecialchars($_SESSION['submitted_comment'] ?? '') . "</p>";

    unset(
        $_SESSION['submitted_fullname'],
        $_SESSION['submitted_email'],
        $_SESSION['submitted_birthplace'],
        $_SESSION['submitted_gender'],
        $_SESSION['submitted_faculty'],
        $_SESSION['submitted_languages'],
        $_SESSION['submitted_comment']
    );
}
?>
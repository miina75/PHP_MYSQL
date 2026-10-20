<?php
// Displays the submitted student information in a table
session_start();
if (empty($_SESSION['student'])) {
    header("Location: index.php");
    exit;
}
$s = $_SESSION['student'];
function h($v) { return htmlspecialchars($v, ENT_QUOTES); }

$sections = [
    "Personal Information" => [
        'Full Name' => 'name', 'Place of Birth' => 'pob', 'Date of Birth' => 'dob',
        'Address' => 'address', 'Gender' => 'gender', 'Telephone' => 'telephone', 'Email' => 'email',
    ],
    "Parent Information" => [
        'Parent Name' => 'pname', 'Parent Telephone' => 'ptelephone', 'Relationship' => 'relationship',
    ],
    "Academic Information" => [
        'Student ID' => 'student_id', 'Faculty' => 'faculty', 'Department' => 'department',
        'Class' => 'class', 'Registration Date' => 'regdate',
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registration Successful</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  body { background:#f0f3f8; }
  .card-header { background:#0d3b66; color:#fff; }
  th.sec { background:#0d3b66 !important; color:#fff; }
  .photo { width:150px; height:150px; object-fit:cover; border-radius:8px; border:3px solid #0d3b66; }
</style>
</head>
<body>
<div class="container py-4" style="max-width:800px">
  <div class="card shadow-sm">
    <div class="card-header text-center py-3">
      <h4 class="mb-0">Registration Successful</h4>
      <small>Submitted student information</small>
    </div>
    <div class="card-body p-4">
      <div class="alert alert-success">Thank you, <strong><?= h($s['name']) ?></strong>. Your information was submitted successfully.</div>

      <div class="text-center mb-3">
        <img src="<?= h($s['image']) ?>" alt="Student image" class="photo">
      </div>

      <table class="table table-bordered table-striped align-middle">
        <?php foreach ($sections as $title => $fields): ?>
          <thead><tr><th colspan="2" class="sec"><?= h($title) ?></th></tr></thead>
          <tbody>
            <?php foreach ($fields as $label => $key): ?>
              <tr><th style="width:35%"><?= h($label) ?></th><td><?= nl2br(h($s[$key])) ?></td></tr>
            <?php endforeach; ?>
          </tbody>
        <?php endforeach; ?>
      </table>

      <div class="text-end">
        <a href="index.php" class="btn btn-primary">Register another student</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>

<?php
// Student Registration Form - Chapter 4 (Forms & Validation)
session_start();

$errors = [];
$old = [];          // keep form data after submit (Validation Checklist 2-2)
$firstError = '';   // name of first invalid field, used to focus the user there

$faculties = ["Computer & IT", "Engineering", "Medicine", "Business & Economics", "Education", "Law"];
$departments = ["Computer Science", "Information Technology", "Software Engineering", "Civil Engineering", "Nursing", "Accounting"];
$extensions = ["png", "jpg", "jpeg", "gif", "webp"];   // allowed image types (in_array check)
$maxSize = 2 * 1024 * 1024;                              // 2MB

// Field list: control name => label shown in error message
$required = [
    'name' => 'Full name', 'pob' => 'Place of birth', 'dob' => 'Date of birth',
    'address' => 'Address', 'gender' => 'Gender', 'telephone' => 'Telephone',
    'email' => 'Email', 'pname' => 'Parent name', 'ptelephone' => 'Parent telephone',
    'relationship' => 'Relationship', 'student_id' => 'Student ID', 'faculty' => 'Faculty',
    'department' => 'Department', 'class' => 'Class', 'regdate' => 'Registration date',
];

if (isset($_POST['submit'])) {
    // 1) Empty checks for every text/dropdown/textarea/radio field
    foreach ($required as $field => $label) {
        $old[$field] = isset($_POST[$field]) ? trim($_POST[$field]) : '';
        if (empty($old[$field])) {
            $errors[$field] = "Please enter your $label.";
        }
    }
    if (empty($old['gender'])) $errors['gender'] = "Please select the student's gender.";
    if (isset($errors['faculty'])) $errors['faculty'] = "Please select a Faculty.";
    if (isset($errors['department'])) $errors['department'] = "Please select a Department.";
    if (isset($errors['relationship'])) $errors['relationship'] = "Please select the parent's relationship.";

    // 2) Name: letters and spaces only
    if (!isset($errors['name']) && !preg_match("/^[A-Za-z ]+$/", $old['name'])) {
        $errors['name'] = "Full name may contain only letters and spaces.";
    }
    if (!isset($errors['pname']) && !preg_match("/^[A-Za-z ]+$/", $old['pname'])) {
        $errors['pname'] = "Parent name may contain only letters and spaces.";
    }

    // 3) Email format
    if (!isset($errors['email']) && !filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address (e.g. name@example.com).";
    }

    // 4) Telephone: digits, +, spaces, dashes (7-15 digits)
    foreach (['telephone', 'ptelephone'] as $t) {
        if (!isset($errors[$t]) && !preg_match("/^\+?[0-9 \-]{7,15}$/", $old[$t])) {
            $errors[$t] = "Please enter a valid telephone number (7-15 digits).";
        }
    }

    // 5) File upload: chosen? extension allowed? size? real image?
    $ext = '';
    if (empty($_FILES['image']['name'])) {
        $errors['image'] = "Please upload the student's image.";
    } elseif ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errors['image'] = "The image could not be uploaded. Please try again.";
    } else {
        $name_ext = explode(".", $_FILES['image']['name']);
        $ext = strtolower(end($name_ext));
        if (!in_array($ext, $extensions)) {
            $errors['image'] = "File extension .$ext is not allowed. Use: " . implode(", ", $extensions) . ".";
        } elseif ($_FILES['image']['size'] > $maxSize) {
            $errors['image'] = "Image is too big. Maximum size is 2MB.";
        } elseif (!getimagesize($_FILES['image']['tmp_name'])) {
            $errors['image'] = "The selected file is not a valid image.";
        }
    }

    // 6) All good: move file (renamed after student ID), save data, redirect
    if (empty($errors)) {
        $fileName = preg_replace("/[^A-Za-z0-9_-]/", "_", $old['student_id']) . "." . $ext;
        $target = "uploads/" . $fileName;
        if (file_exists($target)) unlink($target);   // replace older photo of same ID
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $old['image'] = $target;
            $_SESSION['student'] = $old;
            header("Location: result.php");
            exit;
        } else {
            $errors['image'] = "Server could not save the image. Check the uploads folder permissions.";
        }
    }
    // First field (in form order) with an error
    foreach (array_merge(array_keys($required), ['image']) as $f) {
        if (isset($errors[$f])) { $firstError = $f; break; }
    }
}

// helpers
function val($k) { global $old; return htmlspecialchars($old[$k] ?? '', ENT_QUOTES); }
function inv($k) { global $errors; return isset($errors[$k]) ? ' is-invalid' : ''; }
function err($k) { global $errors; return isset($errors[$k]) ? '<div class="invalid-feedback d-block">' . htmlspecialchars($errors[$k]) . '</div>' : ''; }
function sel($k, $v) { global $old; return (($old[$k] ?? '') === $v) ? ' selected' : ''; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Registration</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  body { background:#f0f3f8; }
  .card-header { background:#0d3b66; color:#fff; }
  legend.section { font-size:1.1rem; font-weight:600; color:#0d3b66; border-bottom:2px solid #0d3b66; padding-bottom:.3rem; }
</style>
</head>
<body>
<div class="container py-4" style="max-width:900px">
  <div class="card shadow-sm">
    <div class="card-header text-center py-3">
      <h4 class="mb-0">Jamhuriya University of Science &amp; Technology</h4>
      <small>Student Registration Form</small>
    </div>
    <div class="card-body p-4">

      <?php if ($errors): ?>
        <div class="alert alert-danger">
          <strong>Please fix <?= count($errors) ?> problem(s):</strong>
          <ul class="mb-0">
            <?php foreach ($errors as $e) echo "<li>" . htmlspecialchars($e) . "</li>"; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form method="post" enctype="multipart/form-data" novalidate>

        <!-- ================= PERSONAL INFORMATION ================= -->
        <fieldset class="mb-4">
          <legend class="section">Personal Information</legend>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" for="name">Full Name</label>
              <input type="text" class="form-control<?= inv('name') ?>" id="name" name="name" value="<?= val('name') ?>">
              <?= err('name') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="email">Email</label>
              <input type="text" class="form-control<?= inv('email') ?>" id="email" name="email" value="<?= val('email') ?>">
              <?= err('email') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="pob">Place of Birth (POB)</label>
              <input type="text" class="form-control<?= inv('pob') ?>" id="pob" name="pob" value="<?= val('pob') ?>">
              <?= err('pob') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="dob">Date of Birth (DOB)</label>
              <input type="date" class="form-control<?= inv('dob') ?>" id="dob" name="dob" value="<?= val('dob') ?>">
              <?= err('dob') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="telephone">Telephone</label>
              <input type="tel" class="form-control<?= inv('telephone') ?>" id="telephone" name="telephone" value="<?= val('telephone') ?>">
              <?= err('telephone') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label d-block">Gender</label>
              <div class="form-check form-check-inline mt-2">
                <input class="form-check-input" type="radio" name="gender" id="gmale" value="Male" <?= val('gender')==='Male' ? 'checked' : '' ?>>
                <label class="form-check-label" for="gmale">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="gfemale" value="Female" <?= val('gender')==='Female' ? 'checked' : '' ?>>
                <label class="form-check-label" for="gfemale">Female</label>
              </div>
              <?= err('gender') ?>
            </div>
            <div class="col-12">
              <label class="form-label" for="address">Address</label>
              <textarea class="form-control<?= inv('address') ?>" id="address" name="address" rows="2"><?= val('address') ?></textarea>
              <?= err('address') ?>
            </div>
            <div class="col-12">
              <label class="form-label" for="image">Student Image (png, jpg, jpeg, gif, webp - max 2MB)</label>
              <input type="file" class="form-control<?= inv('image') ?>" id="image" name="image" accept="image/*">
              <?= err('image') ?>
            </div>
          </div>
        </fieldset>

        <!-- ================= PARENT INFORMATION ================= -->
        <fieldset class="mb-4">
          <legend class="section">Parent Information</legend>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label" for="pname">Parent Name</label>
              <input type="text" class="form-control<?= inv('pname') ?>" id="pname" name="pname" value="<?= val('pname') ?>">
              <?= err('pname') ?>
            </div>
            <div class="col-md-4">
              <label class="form-label" for="ptelephone">Parent Telephone</label>
              <input type="tel" class="form-control<?= inv('ptelephone') ?>" id="ptelephone" name="ptelephone" value="<?= val('ptelephone') ?>">
              <?= err('ptelephone') ?>
            </div>
            <div class="col-md-4">
              <label class="form-label" for="relationship">Relationship</label>
              <select class="form-select<?= inv('relationship') ?>" id="relationship" name="relationship">
                <option value="">-- Select --</option>
                <?php foreach (["Father", "Mother", "Guardian", "Brother", "Sister", "Uncle", "Aunt"] as $r): ?>
                  <option value="<?= $r ?>"<?= sel('relationship', $r) ?>><?= $r ?></option>
                <?php endforeach; ?>
              </select>
              <?= err('relationship') ?>
            </div>
          </div>
        </fieldset>

        <!-- ================= ACADEMIC INFORMATION ================= -->
        <fieldset class="mb-4">
          <legend class="section">Academic Information</legend>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label" for="student_id">Student ID</label>
              <input type="text" class="form-control<?= inv('student_id') ?>" id="student_id" name="student_id" value="<?= val('student_id') ?>">
              <?= err('student_id') ?>
            </div>
            <div class="col-md-4">
              <label class="form-label" for="faculty">Faculty</label>
              <select class="form-select<?= inv('faculty') ?>" id="faculty" name="faculty">
                <option value="">-- Select --</option>
                <?php foreach ($faculties as $f): ?>
                  <option value="<?= $f ?>"<?= sel('faculty', $f) ?>><?= $f ?></option>
                <?php endforeach; ?>
              </select>
              <?= err('faculty') ?>
            </div>
            <div class="col-md-4">
              <label class="form-label" for="department">Department</label>
              <select class="form-select<?= inv('department') ?>" id="department" name="department">
                <option value="">-- Select --</option>
                <?php foreach ($departments as $d): ?>
                  <option value="<?= $d ?>"<?= sel('department', $d) ?>><?= $d ?></option>
                <?php endforeach; ?>
              </select>
              <?= err('department') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="class">Class</label>
              <input type="text" class="form-control<?= inv('class') ?>" id="class" name="class" placeholder="e.g. Year 1 - Morning" value="<?= val('class') ?>">
              <?= err('class') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="regdate">Registration Date</label>
              <input type="date" class="form-control<?= inv('regdate') ?>" id="regdate" name="regdate" value="<?= val('regdate') ?>">
              <?= err('regdate') ?>
            </div>
          </div>
        </fieldset>

        <div class="d-flex gap-2 justify-content-end">
          <a href="index.php" class="btn btn-outline-secondary">Reset form</a>
          <button type="submit" name="submit" class="btn btn-primary px-4">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php if ($firstError): ?>
<script>
  // Put the user at the first field that needs attention
  var f = document.getElementById(<?= json_encode($firstError === 'gender' ? 'gmale' : $firstError) ?>);
  if (f) { f.scrollIntoView({behavior:'smooth', block:'center'}); f.focus(); }
</script>
<?php endif; ?>
</body>
</html>

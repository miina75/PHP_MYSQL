<?php include 'includes/header.php'; ?>

<?php include 'includes/navbar.php'; ?>

    <div class="container-fluid">
        <div class="row">

<?php include 'includes/sidebar.php'; ?>

            <!-- Main Content -->
            <main class="col-lg-9 mt-2">
<?php
include 'sections/students.php';
include 'sections/courses.php';
include 'sections/grades.php';
include 'sections/events.php';
include 'sections/about.php';
include 'sections/contact.php';
?>
            </main>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>

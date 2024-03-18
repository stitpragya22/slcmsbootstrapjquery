<!-- plugins/TaskManagerPlugin/Views/task_list.php -->
<?= $this->extend('layouts/admindash') ?>
<?= $this->section('body') ?>
<h2>Task List</h2>
<ul>
    <?php foreach ($tasks as $task): ?>
        <li><?= $task['title']; ?></li>
    <?php endforeach; ?>
</ul>
<?= $this->endSection() ?>

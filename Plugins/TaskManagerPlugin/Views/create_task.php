<!-- plugins/TaskManagerPlugin/Views/create_task.php -->

<h2>Create Task</h2>
<?= form_open('addons/TaskManagerPlugin/create') ?>
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required><br>
    <label for="description">Description:</label>
    <textarea name="description" id="description"></textarea><br>
    <button type="submit">Create Task</button>
<?= form_close() ?>

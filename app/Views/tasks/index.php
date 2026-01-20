<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>My Tasks</h2>
            <a href="/tasks/create" class="btn btn-primary">Create New Task</a>
        </div>
        <?php if (empty($tasks)): ?>
            <div class="alert alert-info">No tasks found. <a href="/tasks/create">Create your first task</a>.</div>
        <?php else: ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= $task['id'] ?></td>
                        <td><?= esc($task['title']) ?></td>
                        <td><?= ucfirst($task['status']) ?></td>
                        <td>
                            <a href="/tasks/view/<?= $task['id'] ?>" class="btn btn-info btn-sm">View</a>
                            <a href="/tasks/edit/<?= $task['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form method="post" action="/tasks/<?= $task['id'] ?>" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
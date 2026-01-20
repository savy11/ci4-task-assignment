<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Task Details</h2>
            <a href="/tasks" class="btn btn-secondary">Back to List</a>
        </div>

        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>Title</th>
                    <td><?= esc($task['title']) ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?= esc($task['description']) ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?= ucfirst(esc($task['status'])) ?></td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td><?= $task['created_at'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
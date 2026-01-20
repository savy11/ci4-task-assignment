<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">

        <h2>Edit Task</h2>
        <form method="post" action="/tasks/<?= $task['id'] ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="mb-3">
                <label class="form-label" for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= esc($task['title']) ?>"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="description">Description</label>
                <textarea name="description" id="description"
                    class="form-control"><?= esc($task['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="status">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="completed" <?= $task['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Update Task</button>
                <a href="/tasks" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
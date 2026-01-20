<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <h2>Create Task</h2>
        <form method="post" action="/tasks">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label" for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= old('title') ?>" required>
                <?php if (session()->getFlashdata('errors.title')): ?><span
                        style="color: red;"><?= session()->getFlashdata('errors.title') ?></span><?php endif; ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4"><?= old('description') ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="pending" <?= old('status') === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="completed" <?= old('status') === 'completed' ? 'selected' : '' ?>>Completed</option>
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Create Task</button>
                <a href="/tasks" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
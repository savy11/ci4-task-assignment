<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4 offset-md-4">
        <div class="bg-light p-4 rounded">
            <h2 class="text-center">Register</h2>
            <form method="post" action="/auth/register">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= old('username') ?>" required>
                    <?php if (isset($errors['username'])): ?><span
                            style="color: red;"><?= $errors['username'] ?></span><?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                    <?php if (isset($errors['email'])): ?><span
                            style="color: red;"><?= $errors['email'] ?></span><?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                    <?php if (isset($errors['password'])): ?><span
                            style="color: red;"><?= $errors['password'] ?></span><?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password_confirm">Confirm Password</label>
                    <input type="password" name="password_confirm" class="form-control" required>
                    <?php if (isset($errors['password_confirm'])): ?><span
                            style="color: red;"><?= $errors['password_confirm'] ?></span><?php endif; ?>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
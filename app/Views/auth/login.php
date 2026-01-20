<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4 offset-md-4">
        <div class="bg-light p-4 rounded">
            <h2 class="text-center">Login</h2>
            <form method="post" action="/auth/login">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= old('email') ?>"
                        required>
                    <?php if (isset($errors['email'])): ?><span
                            style="color: red;"><?= $errors['email'] ?></span><?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    <?php if (isset($errors['password'])): ?><span
                            style="color: red;"><?= $errors['password'] ?></span><?php endif; ?>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input" <?= old('remember') ? 'checked' : '' ?>>
                    <label for="remember" class="form-check-label">Remember Me</label>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
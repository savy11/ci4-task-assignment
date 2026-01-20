<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - <?= $title ?? 'Home' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <style>
        main {
            height: calc(100vh - 96px);
        }
    </style>
</head>

<body>
    <header class="container-fluid bg-light">
        <div class="row">
            <div class="col-12">
                <div class="container">
                    <nav class="navbar navbar-right navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="/">Task Manager</a>
                        <div class="collapse navbar-collapse">
                            <ul class="navbar-nav ms-auto">
                                <?php if (session()->get('user_id')): ?>
                                    <li class="nav-item"><a class="nav-link" href="/tasks">My Tasks</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                                <?php else: ?>
                                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <main class="container py-3">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </main>

    <footer class="bg-light py-2">
        <div class="container-fluid text-center">
            <div>&copy; <?= date('Y') ?> Task Manager. All rights reserved.</div>
        </div>
    </footer>
</body>

</html>
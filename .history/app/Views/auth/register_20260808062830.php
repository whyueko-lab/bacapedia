<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Bacapedia</title>

```
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
```

</head>
<body class="bg-light">

<div class="container">

```
<div class="row justify-content-center mt-5">

    <div class="col-md-5">

        <div class="card shadow">

            <div class="card-header bg-success text-white text-center">
                <h4>Register Bacapedia</h4>
            </div>

            <div class="card-body">

                <?php if(session()->getFlashdata('error')): ?>

                    <div class="alert alert-danger">

                        <?= session()->getFlashdata('error') ?>

                    </div>

                <?php endif; ?>

                <form action="/register" method="post">

                    <div class="mb-3">

                        <label>Nama</label>

                        <input type="text" name="nama" class="form-control" required>

                    </div>

                    <div class="mb-3">

                        <label>Email</label>

                        <input type="email" name="email" class="form-control" required>

                    </div>

                    <div class="mb-3">

                        <label>Password</label>

                        <input type="password" name="password" class="form-control" required>

                    </div>

                    <button class="btn btn-success w-100">Register</button>

                </form>

                <hr>

                <div class="text-center">

                    <a href="/login">Sudah punya akun? Login</a>

                </div>

            </div>

        </div>

    </div>

</div>
```

</div>

</body>
</html>

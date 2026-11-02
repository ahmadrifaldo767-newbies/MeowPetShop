<div class="row justify-content-center mt-5" data-aos="zoom-in">
    <div class="col-md-5">
        <div class="card shadow border-0">
            <div class="card-header bg-dark text-white text-center py-3">
                <h4 class="mb-0 fw-bold"><i class="bi bi-person-lock"></i> Login Admin</h4>
            </div>
            <div class="card-body p-4 bg-light">
                <?php if(isset($error_login)): ?>
                    <div class="alert alert-danger text-center fw-bold"><?= $error_login ?></div>
                <?php endif; ?>
                <form action="index.php?page=login" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Username</label>
                        <input type="text" name="username" class="form-control" required placeholder="Masukkan username">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
                    </div>
                    <button type="submit" name="login" class="btn btn-warning w-100 fw-bold py-2 shadow-sm">Masuk Dashboard</button>
                </form>
            </div>
            <div class="card-footer text-center text-muted small py-3">
               <strong>Masukan Username</strong><strong> | Dan Password Yang Benaer</strong>
            </div>
        </div>
    </div>
</div>
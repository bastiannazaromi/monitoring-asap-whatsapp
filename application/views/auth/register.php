<form class="pt-3">
    <div class="form-group">
        <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Retype Password">
    </div>
    <div class="mt-3 float-right">
        <button class="btn btn-primary font-weight-medium auth-form-btn">REGISTER</button>
    </div>
    <div class="text-center mt-4 fw-light">
        have an account? <a href="<?= base_url('auth'); ?>" class="text-primary">Login</a>
    </div>
</form>
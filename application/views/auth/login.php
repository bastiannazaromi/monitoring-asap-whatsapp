<form class="pt-3" action="<?= base_url('auth'); ?>" method="post">
    <div class="form-group">
        <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" name="nama">
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password">
    </div>
    <div class="mt-3 float-right">
        <button type="submit" class="btn btn-primary font-weight-medium auth-form-btn">SIGN IN</button>
    </div>
</form>
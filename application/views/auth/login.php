<?php $this->view('header'); ?>

<div class="container">
    <div class="mx-auto py-5">
        <form class="p-4" method="post">
            <h4>Log In</h4>
            <p>Authenticate your account and gain access to additional features.</p>

            <?php if ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $this->session->flashdata('error'); ?>
                    <?php if ($this->session->flashdata('failed')) : ?>
                        -- <?php echo $this->session->flashdata('failed'); ?> attempts.
                    <?php endif ?>
                </div>
            <?php endif ?>

            <div class="form-group">
                <label for="emailInput">Email address</label>
                <input type="email" class="form-control <?php echo feedback('email') ?>" id="emailInput" aria-describedby="emailHelp" name="email" value="<?php echo set_value('email'); ?>" size="50">
                <?php if (form_error('email')): ?>
                    <div class="invalid-feedback">
                        <?php echo form_error('email'); ?>
                    </div>
                <?php else: ?>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="passwordInput">Password</label>
                <input type="password" class="form-control <?php echo feedback('password') ?>" id="passwordInput" name="password">
                <?php if (form_error('password')): ?>
                    <div class="invalid-feedback">
                        <?php echo form_error('password'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="rememberMeCheck" name="remember_me">
                <label class="form-check-label" for="rememberMeCheck">Remember me for 7 days</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?php $this->view('footer'); ?>

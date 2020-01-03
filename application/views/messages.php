<?php if ($this->session->flashdata('attempts')) : ?>
    <div class="alert alert-danger mb-2" role="alert" style="margin-bottom: -1em;">
        <div class="container">
            <?php echo $this->session->flashdata('attempts'); ?> failed password attempt(s) were previously made on your account.
        </div>
    </div>
<?php endif ?>

<?php if (authenticated() && user()->is_admin) : ?>
    <div class="alert alert-info" role="alert" style="margin-bottom: -1em;">
        <div class="container">
            You are currently logged in with administrative privileges
        </div>
    </div>
<?php endif ?>
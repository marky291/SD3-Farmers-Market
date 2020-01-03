<?php if ($this->session->flashdata('danger')) : ?>
    <div class="alert alert-danger" role="alert">
        <div class="container">
            <?php echo $this->session->flashdata('danger'); ?>
        </div>
    </div>
<?php endif ?>

<?php if (authenticated() && user()->is_admin) : ?>
    <div class="alert alert-info" role="alert">
        <div class="container">
            You are currently logged in with administrative privileges
        </div>
    </div>
<?php endif ?>

<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success" role="alert">
        <div class="container">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    </div>
<?php endif ?>

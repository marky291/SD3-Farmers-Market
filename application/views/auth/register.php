<?php $this->view('header'); ?>

<div class="container">
    <div class="mx-auto py-5">
        <form class="p-4" method="post">
            <h4>Member Registration</h4>
            <p>Create a new account and gain access to a plethora of member features.</p>

            <?php if ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif ?>

            <div class="form-group">
                <label for="companyInput">Company Name</label>
                <input type="company" class="form-control <?php echo feedback('company') ?>" id="companyInput" aria-describedby="companyHelp" name="company" value="<?php echo set_value('company'); ?>" size="50">
                <?php if (form_error('company')): ?>
                    <div class="invalid-feedback">
                        <?php echo form_error('company'); ?>
                    </div>
                <?php else: ?>
                    <small id="companyHelp" class="form-text text-muted">The name that represents your company, or sole representation</small>
                <?php endif; ?>
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <label for="forenameInput">Forename</label>
                    <input type="forename" class="form-control <?php echo feedback('forename') ?>" id="forenameInput" aria-describedby="forenameHelp" name="forename" value="<?php echo set_value('forename'); ?>" size="50">
                    <?php if (form_error('forename')): ?>
                        <div class="invalid-feedback">
                            <?php echo form_error('forename'); ?>
                        </div>
                    <?php else: ?>
                        <small id="forenameHelp" class="form-text text-muted">Enter your first name</small>
                    <?php endif; ?>
                </div>
                <div class="col">
                    <label for="surnameInput">Surname</label>
                    <input type="surname" class="form-control <?php echo feedback('surname') ?>" id="surnameInput" aria-describedby="surnameHelp" name="surname" value="<?php echo set_value('surname'); ?>" size="50">
                    <?php if (form_error('surname')): ?>
                        <div class="invalid-feedback">
                            <?php echo form_error('surname'); ?>
                        </div>
                    <?php else: ?>
                        <small id="surnameHelp" class="form-text text-muted">Enter your last name</small>
                    <?php endif; ?>
                </div>
            </div>
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
                <label for="addressLine1Input">Address Line 1</label>
                <input type="text" class="form-control <?php echo feedback('addressLine1') ?>" id="addressLine1Input" aria-describedby="addressLine1Help" name="addressLine1" value="<?php echo set_value('addressLine1'); ?>" size="50">
                <?php if (form_error('addressLine1')): ?>
                    <div class="invalid-feedback">
                        <?php echo form_error('addressLine1'); ?>
                    </div>
                <?php else: ?>
                    <small id="addressLine1Help" class="form-text text-muted">First line of your address</small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="addressLine1Input">Address Line 2</label>
                <input type="text" class="form-control <?php echo feedback('addressLine2') ?>" id="addressLine2Input" aria-describedby="addressLine2Help" name="addressLine2" value="<?php echo set_value('addressLine2'); ?>" size="50">
                <?php if (form_error('addressLine2')): ?>
                    <div class="invalid-feedback">
                        <?php echo form_error('addressLine2'); ?>
                    </div>
                <?php else: ?>
                    <small id="addressLine2Help" class="form-text text-muted">Second line of your address</small>
                <?php endif; ?>
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <label for="exampleFormControlSelect1">Country</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>Ireland</option>
                        <option>United Kingdom</option>
                    </select>
                    <?php if (form_error('forename')): ?>
                        <div class="invalid-feedback">
                            <?php echo form_error('forename'); ?>
                        </div>
                    <?php else: ?>
                        <small id="forenameHelp" class="form-text text-muted">Enter your first name</small>
                    <?php endif; ?>
                </div>
                <div class="col">
                    <label for="exampleFormControlSelect1">City</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>Limerick</option>
                    </select>
                    <?php if (form_error('surname')): ?>
                        <div class="invalid-feedback">
                            <?php echo form_error('surname'); ?>
                        </div>
                    <?php else: ?>
                        <small id="surnameHelp" class="form-text text-muted">Enter your last name</small>
                    <?php endif; ?>
                </div>
                <div class="col">
                    <label for="surnameInput">Post Code</label>
                    <input type="surname" class="form-control <?php echo feedback('surname') ?>" id="surnameInput" aria-describedby="surnameHelp" name="surname" value="<?php echo set_value('surname'); ?>" size="50">
                    <?php if (form_error('surname')): ?>
                        <div class="invalid-feedback">
                            <?php echo form_error('surname'); ?>
                        </div>
                    <?php else: ?>
                        <small id="surnameHelp" class="form-text text-muted">Enter your last name</small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="phoneInput">Phone number</label>
                <input type="text" class="form-control <?php echo feedback('phone') ?>" id="phoneInput" aria-describedby="phoneHelp" name="phone" value="<?php echo set_value('phone'); ?>" size="50">
                <?php if (form_error('phone')): ?>
                    <div class="invalid-feedback">
                        <?php echo form_error('phone'); ?>
                    </div>
                <?php else: ?>
                    <small id="phoneHelp" class="form-text text-muted">Let us get in touch if anything pops up</small>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>

<?php $this->view('footer'); ?>

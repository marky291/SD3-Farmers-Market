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

            <?php if (validation_errors()): ?>
                <div class="mb-4">
                    <p class="mb-0 font-weight-bold">[DEBUG]: Validation failure due to the following issues:</p>
                    <?php echo validation_errors('<span class="badge badge-danger">', '</span>'); ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="companyInput">Company Name</label>
                <input type="company" class="form-control <?php echo feedback('company') ?>" id="companyInput" aria-describedby="companyHelp" name="company" value="<?php echo set_value('company'); ?>" >
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
                    <input type="forename" class="form-control <?php echo feedback('forename') ?>" id="forenameInput" aria-describedby="forenameHelp" name="forename" value="<?php echo set_value('forename'); ?>" >
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
                    <input type="surname" class="form-control <?php echo feedback('surname') ?>" id="surnameInput" aria-describedby="surnameHelp" name="surname" value="<?php echo set_value('surname'); ?>" >
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
                <input type="text" class="form-control <?php echo feedback('email') ?>" id="emailInput" aria-describedby="emailHelp" name="email" value="<?php echo set_value('email'); ?>" >
                <?php if (form_error('email')): ?>
                    <div class="invalid-feedback">
                        <?php echo form_error('email'); ?>
                    </div>
                <?php else: ?>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                <?php endif; ?>
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <label for="exampleFormControlSelect1">Password</label>
                    <input type="password" class="form-control <?php echo feedback('password') ?>" id="passwordInput" aria-describedby="passwordHelp" name="password" value="<?php echo set_value('password'); ?>" >
                    <?php if (form_error('password')): ?>
                        <div class="invalid-feedback">
                            <?php echo form_error('password'); ?>
                        </div>
                    <?php else: ?>
                        <small id="forenameHelp" class="form-text text-muted">Password credentials for account access</small>
                    <?php endif; ?>
                </div>
                <div class="col">
                    <label for="exampleFormControlSelect1">Confirm Password</label>
                    <input type="password" class="form-control <?php echo feedback('password_confirm') ?>" id="password_confirmInput" aria-describedby="password_confirmHelp" name="password_confirm" value="<?php echo set_value('password_confirm'); ?>" >
                    <?php if (form_error('password_confirm')): ?>
                        <div class="invalid-feedback">
                            <?php echo form_error('password_confirm'); ?>
                        </div>
                    <?php else: ?>
                        <small id="password_confirmHelp" class="form-text text-muted">Confirm your password credentials for future access</small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="address_line_oneInput">Address Line 1</label>
                <input type="text" class="form-control <?php echo feedback('address_line_one') ?>" id="address_line_oneInput" aria-describedby="address_line_oneHelp" name="address_line_one" value="<?php echo set_value('address_line_one'); ?>" >
                <?php if (form_error('address_line_one')): ?>
                    <div class="invalid-feedback">
                        <?php echo form_error('address_line_one'); ?>
                    </div>
                <?php else: ?>
                    <small id="address_line_oneHelp" class="form-text text-muted">First line of your address</small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="address_line_twoInput">Address Line 2</label>
                <input type="text" class="form-control <?php echo feedback('address_line_two') ?>" id="address_line_twoInput" aria-describedby="address_line_twoHelp" name="address_line_two" value="<?php echo set_value('address_line_two'); ?>" >
                <?php if (form_error('address_line_two')): ?>
                    <div class="invalid-feedback">
                        <?php echo form_error('address_line_two'); ?>
                    </div>
                <?php else: ?>
                    <small id="address_line_twoHelp" class="form-text text-muted">Second line of your address</small>
                <?php endif; ?>
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <label for="countrySelect">Country</label>
                    <select class="form-control" id="countrySelect" name="country">
                        <option value="ireland" <?php echo set_select('country', 'ireland', TRUE); ?>>Ireland</option>
                    </select>
                    <?php if (form_error('country')): ?>
                        <div class="invalid-feedback">
                            <?php echo form_error('country'); ?>
                        </div>
                    <?php else: ?>
                        <small id="countryHelp" class="form-text text-muted">Select your country</small>
                    <?php endif; ?>
                </div>
                <div class="col">
                    <label for="citySelect">City</label>
                    <select class="form-control" id="citySelect" name="city">
                        <option value="limerick" <?php echo set_select('city', 'limerick', TRUE); ?>>Limerick</option>
                        <option value="cork" <?php echo set_select('city', 'cork'); ?>>Cork</option>
                        <option value="dublin" <?php echo set_select('city', 'dublin'); ?>>Dublin</option>
                        <option value="kilkenny" <?php echo set_select('city', 'kilkenny'); ?>>Kilkenny</option>
                    </select>
                    <?php if (form_error('city')): ?>
                        <div class="invalid-feedback">
                            <?php echo form_error('city'); ?>
                        </div>
                    <?php else: ?>
                        <small id="cityHelp" class="form-text text-muted">Select your city location</small>
                    <?php endif; ?>
                </div>
                <div class="col">
                    <label for="eircodeInput">Post Code</label>
                    <input type="text" class="form-control <?php echo feedback('eircode') ?>" id="eircodeInput" aria-describedby="eircodeHelp" name="eircode" value="<?php echo set_value('eircode'); ?>" >
                    <?php if (form_error('eircode')): ?>
                        <div class="invalid-feedback">
                            <?php echo form_error('eircode'); ?>
                        </div>
                    <?php else: ?>
                        <small id="eircodeHelp" class="form-text text-muted">Location area postal code</small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="phoneInput">Phone number</label>
                <input type="text" class="form-control <?php echo feedback('phone') ?>" id="phoneInput" aria-describedby="phoneHelp" name="phone" value="<?php echo set_value('phone'); ?>" >
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

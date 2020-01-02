<div class="navigation">
    <ul class="list-group d-flex flex-row">
        <?php if (authenticated()): ?>
<!--            <li>-->
<!--                <a href="" class="navigation-item">-->
<!--                    <i class="fas fa-user-circle"></i>-->
<!--                    <p>--><?php //echo user()->contactLastName ?><!--</p>-->
<!--                </a>-->
<!--            </li>-->
            <li>
                <a href="/basket/index" class="navigation-item">
                    <i class="fas fa-shopping-basket"></i>
                    <p>Basket (<b>{{ count }}</b>)</p>
                </a>
            </li>
<!--            <li>-->
<!--                <a href="" class="navigation-item">-->
<!--                    <i class="fas fa-cash-register"></i>-->
<!--                    <p>Checkout</p>-->
<!--                </a>-->
<!--            </li>-->
            <li>
                <a href="/auth/logout" class="navigation-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <p>Log Out</p>
                </a>
            </li>
        <?php else: ?>
            <li>
                <a href="" class="navigation-item">
                    <i class="fas fa-user-plus"></i>
                    <p>Register</p>
                </a>
            </li>
            <li>
                <a href="/auth/login" class="navigation-item">
                    <i class="fas fa-sign-in-alt"></i>
                    <p>Log In</p>
                </a>
            </li>
        <?php endif ?>
    </ul>
</div>
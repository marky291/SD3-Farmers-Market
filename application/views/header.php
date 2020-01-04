<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LIT Farmers Market</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?php echo base_url('favicon.ico') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url('app.css') ?>">
</head>

<body>
<div id="app" v-cloak>
    <page basket-count="<?php echo BasketTotalCount() ?>" inline-template>
        <div class="">
            <div class="row py-3 bg-white shadow-sm">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <a href="<?php echo base_url('/')?>" class="logo d-flex align-items-center mr-4">
                                <img src="<?php echo base_url('images/logo.png') ?>" alt="LIT Logo" height="50px">
                                <span class="title text-lit-red mb-0 ml-3">
                                LIT Farmers Market
                            </span>
                            </a>
                        </div>
                        <div class="d-flex">
                            <form class="form-inline" method="get" action="/product/search">
                                <div class="form-group search">
                                    <input style="width:300px;" type="text" class="form-control" name="query" id="" aria-describedby="helpId" placeholder="Search for Anything">
                                    <button type="submit" class="btn btn-primary mr-4">Search</button>
                                </div>
                            </form>
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
                                            <a href="/auth/register" class="navigation-item">
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
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('messages'); ?>
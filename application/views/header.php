<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LIT Farmers Market</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url('favicon.ico') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url('app.css') ?>">
</head>

<body>
<div class="row py-3 bg-white shadow-sm">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <a href="<?php echo base_url('/')?>" class="logo d-flex align-items-center mr-4">
                    <img src="<?php echo base_url('/images/logo.png') ?>" alt="LIT Logo" height="50px">
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
                <?php $this->view('market'); ?>
            </div>
        </div>
    </div>
</div>
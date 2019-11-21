<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Hello, world!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="app.css">
    </head>

    <body>
        <div id="app" class="container">

            <h1 class="mb-3 mt-3">Farmers Market Products</h1>

            <?php /** @var Product_model $product */ ?>
            <?php foreach ($productLine as $line): ?>
                <h4 class="mb-4 bg-info text-white py-1 px-2"><?php echo $line[0]->productLine ?></h4>
                <div class="d-flex flex-wrap mb-5">
                    <?php foreach ($line as $product): ?>
                        <product-card inline-template>
                            <div class="card mb-3" style="width: 357.95px; margin-right: 5px; margin-left: 5px;">
                                <div class="row no-gutters">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $product->description ?></h5>
                                        <p>Purchase for €<?php echo $product->formatPrice() ?></p>
                                        <p class="card-text d-flex align-items-center justify-content-between">
                                            <small class="text-muted">Supplied by <?php echo $product->supplier ?></small>
                                            <small class="mb-0 bg-dark text-white px-2"><?php echo $product->quantityInStock ?> Left</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </product-card>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

        </div>

        <script src="app.js"></script>
    </body>
</html>
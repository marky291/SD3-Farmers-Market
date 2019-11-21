<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Hello, world!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="app.css">
    </head>

    <body class="bg-light">
        <div id="app" class="container">
            <div class="d-flex justify-content-between">
                <h1 class="mt-4 mb-2">Farmers Market Products</h1>
                <form class="form-inline">
                    <div class="form-group">
                        <input style="width:450px;" type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Search for Anything">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>

            <div class="row mt-4">
                <div class="col-2">
                    <div class="">
                        <h5>Shop by Category</h5>
                        <ul>
                            <?php foreach ($lines as $category): ?>
                                <li><a href=""><?php echo $category->productLine; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="">
                        <h5>Shop by Supplier</h5>
                        <ul>
                            <?php foreach ($suppliers as $item): ?>
                                <li><a href=""><?php echo $item->supplier; ?></a></li>
                            <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-10">
                    <?php /** @var Product_model $product */ ?>
                    <?php foreach ($lineProducts as $line): ?>
                        <h4 class="mb-2 py-1 px-2 font-weight-bold">Browse <?php echo plural($line[0]->productLine) ?></h4>
                        <div class="d-flex flex-wrap mb-5 flex-1 bg-white p-2 pt-3">
                            <?php foreach ($line as $product): ?>
                                <product-card inline-template>
                                    <div class="card mb-2" style="width: 291.64px; margin-right: 5px; margin-left: 5px;">
                                        <div class="row no-gutters">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $product->description ?></h5>
                                                <p>EUR <?php echo $product->formatPrice() ?></p>
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
            </div>

        </div>

        <script src="app.js"></script>
    </body>
</html>
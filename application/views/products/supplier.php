<?php $this->view('header'); ?>

<div id="app" class="container">
    <div class="row py-5">
        <div class="col-2">
            <?php $this->view('sidebar'); ?>
        </div>
        <div class="col-10">
            <?php /** @var Product_model $product */ ?>
            <?php foreach ($products as $product): ?>
                <product-card inline-template>
                    <div class="card mb-2 shadow-sm" style="width: 291.64px; margin-right: 5px; margin-left: 5px;">
                        <div class="row no-gutters">
                            <div class="card-body" style="border:none !important">
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <h5 class="card-title"><?php echo $product->description ?></h5>
                                        <p>EUR <?php echo $product->formatPrice() ?></p>
                                    </div>
                                    <img class="rounded-circle shadow" src="<?php echo $product->thumbImageUrl() ?>" alt="Product image" height="45px" width="50px">
                                </div>
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
    </div>
</div>

<?php $this->view('footer'); ?>

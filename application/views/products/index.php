
<?php $this->view('header'); ?>

<div id="app" class="container">
    <div class="row py-5">
        <div class="col-2">
            <?php $this->view('sidebar'); ?>
        </div>
        <div class="col-10">
            <?php /** @var Product_model $product */ ?>
            <?php if(isset($heading)): ?>
                <h4 class="mb-1"><?php echo plural($heading) ?></h4>
            <?php endif; ?>
            <div class="d-flex flex-wrap mb-5 flex-1p-2 pt-3">
                <?php if(count($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <product-card :product="<?php echo htmlentities(json_encode($product))?>" inline-template>
                            <div class="card mb-2 shadow-sm" style="width: 291.64px; margin-right: 5px; margin-left: 5px;" @click='viewProduct("<?php echo $product->viewProductLink()?>")'>
                                <div class="row no-gutters">
                                    <div class="card-body" style="border:none !important">
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <h5 class="card-title"><?php echo $product->description ?></h5>
                                                <p>EUR <?php echo $product->formatSalePrice() ?></p>
                                            </div>
                                            <div class="rounded-circle" style="
                                                    height:50px;
                                                    width:50px;
                                                    background-position: center;
                                                    background-size: cover;
                                                    background-image: url(<?php echo $product->thumbImageUrl()?>)">
                                            </div>
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
                <?php else: ?>
                    <h5>No products to display with the requested parameters</h5>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $this->view('footer'); ?>
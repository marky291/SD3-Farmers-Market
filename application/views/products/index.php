
<?php $this->view('header'); ?>

<?php if ($this->session->flashdata('attempts')) : ?>
    <div class="alert alert-danger" role="alert" style="margin-bottom: -1em;">
        <div class="container">
            <?php echo $this->session->flashdata('attempts'); ?> failed password attempt(s) were previously made on your account.
        </div>
    </div>
<?php endif ?>

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
                                    <div class="card-body" style="">
                                        <div class="p-4 border-rounded" style="background: rgba(255, 255, 255, .97;">
                                            <div class="d-flex justify-content-between">
                                                <div class="" style="flex:5">
                                                    <h5 class="card-title mb-0"><?php echo $product->description ?></h5>
                                                    <small class="text-muted mb-2">Supplied by <?php echo $product->supplier ?></small>
                                                </div>
                                                <div class="d-flex align-self-center" style="flex:1">
                                                    <i class="fas fa-cart-plus" style="font-size:2em;"></i>
                                                </div>
                                            </div>
                                            <div class="card-text d-flex align-items-center justify-content-between py-2">
                                                <p class="font-weight-bold mb-0">EUR <?php echo $product->formatSalePrice() ?></p>
                                                <p class="mb-0">(<?php echo $product->quantityInStock ?> left.)</p>
                                            </div>
                                            <div class="my-2" style="height:30px; background-position: center;background-size: contain;background-image: url(<?php echo $product->thumbImageUrl()?>);"></div>
                                        </div>
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
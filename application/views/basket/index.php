
<?php $this->view('header'); ?>

<?php if ($this->session->flashdata('attempts')) : ?>
    <div class="alert alert-danger" role="alert" style="margin-bottom: -1em;">
        <div class="container">
            <?php echo $this->session->flashdata('attempts'); ?> failed password attempt(s) were previously made on your account.
        </div>
    </div>
<?php endif ?>

<div class="container">
    <div class="row py-5">
        <div class="col-2">
            <?php $this->view('sidebar'); ?>
        </div>
        <div class="col-10">
            <?php /** @var Product_model $product */ ?>
            <?php if(isset($heading)): ?>
                <h4 class="mb-1"><?php echo plural($heading) ?></h4>
            <?php endif; ?>
            <checkout inline-template>
                <div class="d-flex flex-column mb-5 flex-1p-2 pt-3">
                    <?php foreach ($products as $product): ?>
                        <product-card :limit="<?php echo $product->quantityInStock ?>" :total="<?php echo GetBasketItemCount($product->produceCode) ?>" :product="<?php echo htmlentities(json_encode($product))?>" inline-template>
                            <div class="basket-item d-flex">
                                <div class="picture">
                                    <img src="<?php echo $product->thumbImageUrl() ?>" alt="" height="100%" width="100%">
                                </div>
                                <div class="description">
                                    <h5 class="card-title mb-0"><?php echo $product->description ?></h5>
                                    <small class="text-muted mb-2">Supplied by <?php echo $product->supplier ?></small>
                                </div>
                                <div class="quantity">
                                    x<input type="text" value="" v-model="count">
                                </div>
                                <div class="button">
                                    <a href="#" class="badge badge-danger">Remove</a>
                                </div>
                                <div class="pricing d-flex">
                                    <div class="item mx-2">
                                        <p>€<?php echo number_format($product->bulkSalePrice, 2) ?></p>
                                    </div>
                                    <div class="quantity mx-2">
                                        <p class="font-weight-bold">€<?php echo number_format($product->bulkSalePrice * GetBasketItemCount($product->produceCode), 2) ?></p>
                                    </div>
                                </div>
                            </div>
                        </product-card>
                    <?php endforeach; ?>
                    <div class="d-flex justify-content-end py-5 justify-content-between">
                        <h3 class="mr-4 mb-0 font-weight-bold">Your basket Total:</h3>
                        <h3>€1,000,000</h3>
                    </div>
                    <button type="button" class="btn btn-primary">Pay Now</button>
                </div>
            </checkout>
        </div>
    </div>
</div>

<?php $this->view('footer'); ?>
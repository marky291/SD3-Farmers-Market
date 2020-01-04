
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
                        <product :limit="<?php echo $product->quantityInStock ?>" :total="<?php echo BasketProductCount($product) ?>" :product="<?php echo htmlentities(json_encode($product))?>" inline-template>
                            <div class="basket-item d-flex">
                                <div class="picture">
                                    <img src="<?php echo $product->thumbImageUrl() ?>" alt="" height="100%" width="100%">
                                </div>
                                <div class="description" style="width: 230px">
                                    <h5 class="card-title mb-0"><?php echo $product->description ?></h5>
                                    <small class="text-muted mb-2">Supplied by <?php echo $product->supplier ?></small>
                                </div>
                                <div class="quantity" style="margin-top:-15px;">
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-0"><small>Quantity:</small></p>
                                        <p class="mb-0"><small>Max: <?php echo $product->quantityInStock ?></small></p>
                                    </div>
                                    <input type="number" placeholder="Quantity" v-model="count" name="quantity" class="form-control" required="" @change="updateQuantity()">
                                </div>
                                <div class="button">
                                    <button type="button" class="btn btn-outline-danger" @click="requestRemoval('/basket/destroy')">Remove</button>
                                </div>
                                <div class="pricing d-flex text-right justify-content-end" style="width: 20%">
                                    <div class="item mr-4">
                                        <p class="mb-0">€<?php echo number_format($product->bulkSalePrice, 2) ?> ea.</p>
                                    </div>
                                    <div class="quantity mx-2">
                                        <p class="font-weight-bold mb-0">€<?php echo number_format(BasketTotalProductPrice($product), 2) ?></p>
                                    </div>
                                </div>
                            </div>
                        </product>
                    <?php endforeach; ?>
                    <div class="d-flex justify-content-end mb-5 py-4 justify-content-between" style="border-bottom:1px solid #ccc">
                        <h4 class="mr-4 mb-0">Your basket Total:</h4>
                        <h4 class="mb-0">€<?php echo number_format(BasketTotalCollectionPrice($products), 2) ?></h4>
                    </div>
                    <form role="form">
                        <h4>Payment Information</h4>
                        <div class="border-top border-bottom p-4 mb-3" style="background: rgba(67, 153, 225, 0.05)">
                            <div class="form-group">
                                <label for="username">Full name (on the card)</label>
                                <input type="text" name="username" placeholder="Jason Doe" required="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="cardNumber">Card number</label>
                                <div class="input-group">
                                    <input type="text" name="cardNumber" placeholder="Your card number" class="form-control" required="">
                                    <div class="input-group-append">
                                    <span class="input-group-text text-muted">
                                        <i class="fab fa-cc-visa mx-2" style="font-size: 1.25em;"></i>
                                        <i class="fab fa-cc-mastercard mx-2" style="font-size: 1.25em;"></i>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label><span class="hidden-xs">Expiration</span></label>
                                        <div class="input-group">
                                            <input type="number" placeholder="MM" name="" class="form-control" required="">
                                            <input type="number" placeholder="YY" name="" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label data-toggle="tooltip" title="" data-original-title="Three-digits code on the back of your card">CVV
                                            <i class="fa fa-question-circle"></i>
                                        </label>
                                        <input type="text" required="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Pay Now</button>
                    </form>
                </div>
            </checkout>
        </div>
    </div>
</div>

<?php $this->view('footer'); ?>
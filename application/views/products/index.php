
<?php $this->view('header'); ?>

<div class="container">
    <div class="row py-5">
        <div class="col-2">
            <?php $this->view('sidebar'); ?>
        </div>
        <div class="col-10">
            <?php /** @var Product_model $product */ ?>
            <?php if(isset($heading)): ?>
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-1"><?php echo plural($heading)?></h4>
                    <?php if(authenticated()): ?>
                        <a href="/wishlist/index"><span class="font-weight-bold">My Wishlist <i class="fas fa-star"></i></span></a>
                    <?php endif ?>
                </div>
            <?php endif; ?>
            <div class="d-flex flex-wrap mb-5 flex-1p-2 pt-3">
                <?php if(count($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <product @store:basket="incrementBasketCount" :wishlisted="<?php echo (authenticated() && $product->isWishListedBy(user())) ? 'true' : 'false' ?>" :limit="<?php echo $product->quantityInStock ?>" :total="<?php echo BasketProductCount($product) ?>" :product="<?php echo htmlentities(json_encode($product))?>" inline-template>
                            <div class="card mb-2 shadow-sm" @click='redirect("<?php echo $product->viewProductLink()?>")'>
                                <div class="row no-gutters">
                                    <div class="card-body" style="">
                                        <div class="p-4 border-rounded" style="background: rgba(255, 255, 255, .97;">
                                            <div class="d-flex justify-content-between">
                                                <div class="" style="flex:5">
                                                    <h5 class="card-title mb-0"><?php echo $product->description ?></h5>
                                                    <small class="text-muted mb-2">Supplied by <?php echo $product->supplier ?></small>
                                                </div>
                                                <div class="d-flex align-self-center add-to-cart-icon">
                                                   <?php if (authenticated()): ?>
                                                       <button type="button" class="btn btn-light d-flex" @click.stop="addThisItemToBasket()">
                                                           <small><i class="fas fa-cart-plus"></i> <b>{{ count }}</b></small>
                                                       </button>
                                                   <?php else: ?>
                                                       <button type="button" class="btn btn-light d-flex" @click.stop="redirect('/auth/login')">
                                                           <small><i class="fas fa-cart-plus"></i> <b>0</b></small>
                                                       </button>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="card-text d-flex align-items-center justify-content-between py-2">
                                                <p class="font-weight-bold mb-0"><small>
                                                        <?php if (authenticated()): ?>
                                                            <i :class="wishlist ? 'fas fa-heart' : 'far fa-heart'" class="text-danger mr-2" @click.stop="toggleWishlist()"></i>
                                                        <?php else: ?>
                                                            <i :class="wishlist ? 'fas fa-heart' : 'far fa-heart'" class="text-danger mr-2" @click.stop="redirect('/auth/login')"></i>
                                                        <?php endif ?>
                                                    </small> EUR <?php echo $product->formatSalePrice() ?>
                                                </p>
                                                <p class="mb-0">({{ limit }} left.)</p>
                                            </div>
                                            <div class="my-2" style="height:30px; background-position: center;background-size: contain;background-image: url(<?php echo $product->thumbImageUrl()?>);"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </product>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h5>No products to display with the requested parameters</h5>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $this->view('footer'); ?>
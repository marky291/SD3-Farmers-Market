
<?php $this->view('header'); ?>

<div id="app" class="container">
    <div class="row py-5">
        <div class="col-2">
            <?php $this->view('sidebar'); ?>
        </div>
        <div class="col-10">
            <?php /** @var Product_model $product */ ?>
            <product-view :product="<?php echo htmlentities(json_encode($product))?>" inline-template>
                <div>
                    <div class="d-flex">
                        <div class="col-7">
                            <div class="d-flex">
                                <div class="mb-3" style="flex:5">
                                    <h3 class="card-title mb-1"><?php echo $product->description ?></h3>
                                    <small class="text-muted mb-2">Supplied by <?php echo $product->supplier ?></small>
                                </div>
                                <div class="d-flex align-self-center add-to-cart-icon">
                                    <?php if (authenticated()): ?>
                                        <button type="button" class="btn btn-light d-flex" @click.stop="addThisItemToBasket()">
                                            <i class="fas fa-cart-plus"></i> <b>{{ count }}</b>
                                        </button>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-outline-secondary rounded-circle" @click.stop='redirectToLink("auth/login")'>
                                            <i class="fas fa-cart-plus text-black-50" style="font-size:2em;"></i>
                                        </button>
                                    <?php endif ?>
                                </div>
                            </div>
                            <p class="text-justify">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>
                            <div class="row mt-4">
                                <h3 class="col">Buy: €<?php echo $product->formatSalePrice() ?></h3>
                                <h3 class="col">Sell: €<?php echo $product->formatBuyPrice() ?></h3>
                            </div>
                        </div>
                        <div class="col-4 p-3 offset-1 bg-light rounded">
                            <div class="h-100 w-100 rounded" style="
                                    background-image: url('<?php echo $product->fullImageUrl()?>');
                                    background-position: center;
                                    background-size: cover;
                            "></div>
                            <div class="h-100 w-100 rounded" style="
                                    margin-top: -262px;
                                    background: linear-gradient(rgba(247, 247, 247, 0), rgba(139, 139, 139, 0.08) 80%, rgba(0, 0, 0, 0.65));
                            "></div>
                        </div>
                    </div>
                </div>
            </product-view>
            <div class="bg-light p-3">
                <product-timeline product="<?php echo $product->produceCode; ?>"></product-timeline>
            </div>
        </div>
    </div>
</div>

<?php $this->view('footer'); ?>
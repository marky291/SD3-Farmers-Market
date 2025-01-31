
<?php $this->view('header'); ?>

<div id="app" class="container">
<?php if (validation_errors()): ?>
                <div class="mb-4">
                    <p class="mb-0 font-weight-bold">[DEBUG]: Validation failure due to the following issues:</p>
                    <?php echo validation_errors('<span class="badge badge-danger">', '</span>'); ?>
                </div>
            <?php endif; ?>
    <div class="row py-5">
        <div class="col-2">
            <?php $this->view('sidebar'); ?>
        </div>
        <div class="col-10">
            <?php /** @var Product_model $product */ ?>
            <product @store:basket="incrementBasketCount"
                     :wishlisted="<?php echo (authenticated() && $product->isWishListedBy(user())) ? 'true' : 'false' ?>"
                     :limit="<?php echo $product->quantityInStock ?>"
                     :total="<?php echo BasketProductCount($product) ?>"
                     :product="<?php echo htmlentities(json_encode($product))?>"
            inline-template>
                <div class="card-view">

                    <?php if ($product->exists()): ?>
                        <form action="/product/update/<?php echo $product->produceCode ?>" enctype="multipart/form-data" method="post">
                    <?php else: ?>
                        <form action="/product/save" enctype="multipart/form-data" method="post">
                    <?php endif ?>
                        <div class="d-flex">
                        <div class="col-7">
                            <div class="d-flex">
                                <div class="mb-3" style="flex:5; padding-right: 45px;">
                                    <?php if (!isset($editing) || $editing === false ): ?>
                                        <h3 class="card-title mb-1"><?php echo $product->description ?></h3>
                                        <p class="card-title mb-1"><?php echo $product->productLine ?></h3>
                                    <?php else: ?>
                                        <div class="form-group">
                                            <input id="descriptionInput" class="card-title w-100 mb-1 p-1 form-control font-weight-bold <?php echo feedback('description') ?>" name="description" style="font-size:1.4em" value="<?php echo $product->description ?>" placeholder="Product Name">
                                            <?php if (form_error('description')): ?>
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('description'); ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    <?php endif ?>
                                    <?php if (!isset($editing) || $editing === false ): ?>
                                        <small class="text-muted mb-2">Supplied by <?php echo $product->supplier ?></small>
                                    <?php else: ?>
                                        <select class="form-control" id="supplierSelect" name="supplier_id" style="font-size:80%">
                                            <?php /** @var Supplier_model $supplier */ ?>
                                            <?php foreach($suppliers as $supplier): ?>
                                                <option value="<?php echo $supplier->id?>">Supplied by <?php echo $supplier->name ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <?php if (form_error('supplier_id')): ?>
                                            <div class="invalid-feedback">
                                                <?php echo form_error('supplier_id'); ?>
                                            </div>
                                        <?php endif ?>
                                        <div class="form-group mt-2" style="font-size:80%">
                                            <input id="productLineInput" class="<?php echo feedback('productLine') ?>" name="productLine" style="font-size:1.4em" value="<?php echo $product->productLine ?>" placeholder="Product Line">
                                            <?php if (form_error('productLine')): ?>
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('productLine'); ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <?php if ($product->exists()): ?>
                                    <div class="d-flex align-self-center add-to-cart-icon">
                                        <?php if (authenticated()): ?>
                                            <button type="button" class="btn btn-light d-flex mr-2" @click.stop="toggleWishlist()">
                                                <small>Save <i :class="wishlist ? 'fas fa-heart' : 'far fa-heart'" class="text-danger"></i></small>
                                            </button>
                                            <button type="button" class="btn btn-light d-flex" @click.stop="addThisItemToBasket()">
                                                <small>Purchase <i class="fas fa-cart-plus"></i> <b>{{ count }}</b></small>
                                            </button>
                                        <?php else: ?>
                                        <button type="button" class="btn btn-light d-flex mr-2" @click.stop="redirect('/auth/login')">
                                            <small>Save <i :class="wishlist ? 'fas fa-heart' : 'far fa-heart'" class="text-danger"></i></small>
                                        </button>
                                        <button type="button" class="btn btn-light d-flex" @click.stop="redirect('/auth/login')()">
                                            <small>Purchase <i class="fas fa-cart-plus"></i> <b>0</b></small>
                                            <?php endif ?>
                                    </div>
                                <?php endif ?>
                            </div>
                            <?php if (!isset($editing) || $editing === false ): ?>
                                <p class="text-justify">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </p>
                            <?php else: ?>
                                <p>
                                    <div class="form-group">
                                        <textarea name="content" placeholder="Product Content" id="" class="w-100 p-1 form-control <?php echo feedback('content') ?>" cols="30" rows="8" style="margin-top:-10px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</textarea>
                                        <?php if (form_error('content')): ?>
                                            <div class="invalid-feedback">
                                                <?php echo form_error('content'); ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </p>

                            <?php endif ?>
                            <div class="row my-4 align-items-center">
                                <div class="col d-flex">
                                    <?php if (!isset($editing) || $editing === false ): ?>
                                        <div class="d-flex flex-column">
                                            <h4 class="font-weight-bold mb-0">EUR <?php echo $product->formatSalePrice() ?></h4>
                                            <h4 class="font-weight-bold mb-0">In Stock <?php echo $product->quantityInStock ?></h4>
                                        </div>
                                    <?php else: ?>
                                        <h4 class="font-weight-bold">
                                            <div class="form-group align-items-center mb-0 d-flex">
                                                EUR <input placeholder="Sell Price" class="card-title ml-2 mb-0 p-1 col font-weight-bold form-control <?php echo feedback('sale_price') ?>" name="sale_price" value="<?php echo $product->formatSalePrice() ?>" style="font-size:0.9em">
                                            </div>
                                            <?php if (form_error('sale_price')): ?>
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('sale_price'); ?>
                                                </div>
                                            <?php endif ?>
                                        </h4>
                                        <h4 class="font-weight-bold">
                                            <div class="form-group align-items-center mb-0 d-flex">
                                                QTY <input placeholder="Stock" class="card-title ml-2 mb-0 p-1 col font-weight-bold form-control <?php echo feedback('stock') ?>" name="stock" value="<?php echo $product->quantityInStock ?>" style="font-size:0.9em">
                                            </div>
                                            <?php if (form_error('stock')): ?>
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('stock'); ?>
                                                </div>
                                            <?php endif ?>
                                        </h4>
                                    <?php endif ?>
                                </div>
                                <div class="col text-right">
                                    <?php if (authenticated() && user()->hasAdminRole()): ?>
                                        <?php if (!isset($editing) || $editing === false): ?>
                                            <button type="button" class="btn btn-warning" @click="redirect('<?php echo $product->deleteProductLink() ?>')">Delete</button>
                                            <button type="button" class="btn btn-info" @click="redirect('<?php echo $product->editProductLink() ?>')">Modify</button>
                                        <?php elseif ($product->exists()): ?>
                                            <button type="submit" class="btn btn-outline-info">Update</button>
                                            <button type="button" class="btn btn-info" @click="redirect('<?php echo $product->viewProductLink() ?>')">View</button>
                                        <?php else: ?>
                                            <button type="submit" value="upload" class="btn btn-primary">Create</button>
                                        <?php endif ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 p-3 offset-1 bg-light rounded" style="max-height: 295px;">
                            <div class="h-100 w-100 rounded" style="
                                    background-image: url('<?php echo $product->fullImageUrl()?>');
                                    background-position: center;
                                    background-size: cover;
                            "></div>
                            <div class="h-100 w-100 rounded" style="
                                    margin-top: -265px;
                                    background: linear-gradient(rgba(247, 247, 247, 0), rgba(139, 139, 139, 0.08) 80%, rgba(0, 0, 0, 0.65));
                            ">
                            <?php if (isset($editing) && $editing === true ): ?>
                                <input type="file" name="userfile" size="20" class="px-2 py-2" style="position:absolute; bottom:14px; background:#ffffffe3" id="inputGroupFile01">
                            <?php endif ?>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </product>
            <div class="bg-light p-3 mt-3">
                <product-timeline product="<?php echo $product->produceCode; ?>"></product-timeline>
            </div>
        </div>
    </div>
</div>

<?php $this->view('footer'); ?>
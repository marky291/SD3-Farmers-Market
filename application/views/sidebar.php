<div class="">
    <h5>Shop by Category</h5>
    <ul>
        <?php foreach ($this->product_model->allProductLines() as $category): ?>
            <li><a href=""><?php echo $category->productLine; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="">
    <h5>Shop by Supplier</h5>
    <ul>
        <?php foreach ($this->product_model->allSuppliers() as $item): ?>
            <li><?php echo anchor('/product/supplier/' . url_title($item->supplier), $item->supplier) ?></li>
        <?php endforeach; ?>
</div>
<div class="">
    <h5>Random Picks</h5>
    <ul>
        <?php /** @var Product_model $product */ ?>
        <?php foreach ($this->product_model->getRandomProducts(12) as $product): ?>
            <li><a href="<?php echo $product->viewProductLink()?>"><?php echo $product->description?></a></li>
        <?php endforeach; ?>
</div>
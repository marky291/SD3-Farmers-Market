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
            <li><?php echo anchor('/product/supplier/' . url_title($item->supplier), $item->supplier) ?></li>
        <?php endforeach; ?>
</div>
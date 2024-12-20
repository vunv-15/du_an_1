<?php 
require_once './views/layout/header.php';
require_once './views/layout/navbar.php';
$isSearching = isset($_GET['search']) && !empty(trim($_GET['search']));

?>
<style>
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;


}

.pagination a {
    padding: 8px 12px;
    margin: 0 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    transition: all 0.3s ease;
}

.pagination a.active {
    color: #fff;
}

.pagination a:hover {
    background-color: #0056b3;
    color: #fff;
}
.pagination ul {
    list-style: none;
    display: flex;
    justify-content: center;
    padding: 0;
    margin: 20px 0;
}

.pagination ul li {
    margin: 0 5px;
}

.pagination ul li a {
    display: block;
    padding: 10px 15px;
    border: 1px solid #ddd;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}
</style>
<section id="category1" class="product__love">
    <div class="container">
        
    <div class="row bg-white">
            <!-- Tiêu đề -->
            <div class="col-12 product__love-title" >
                <h2 class="product__love-heading upper"></h2>
            </div>
        
            <!-- Cột danh mục bên trái -->
            <aside class="col-lg-3 col-md-4 col-sm-12">
                <div class="category__sidebar">
                    <h3 class="category__sidebar-heading">Danh mục sản phẩm</h3>
                    <ul class="category__sidebar-list">
                        <?php if (!empty($categories)): ?>
                            <a class="category__sidebar-link <?= empty($_GET['danh_muc_id']) ? 'active' : '' ?>" 
                               href="index.php?act=productByCategory">
                               Tất cả
                            </a>
                            <?php foreach ($categories as $category): ?>
                                <li class="category__sidebar-item">
                                    <a href="index.php?act=productByCategory&danh_muc_id=<?= htmlspecialchars($category['id']); ?>" 
                                       class="category__sidebar-link <?= (isset($_GET['danh_muc_id']) && $_GET['danh_muc_id'] == $category['id']) ? 'active' : '' ?>">
                                        <?= htmlspecialchars($category['ten_danh_muc']); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="category__sidebar-item">Không có danh mục nào</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </aside>
            
            <!-- Cột sản phẩm bên phải -->
            <div class="col-lg-9 col-md-8 col-sm-12">
            <div class="row bg-white">
            <!-- Tiêu đề -->
            <div class="col-12 product__love-title" style="text-align: center;">
                <h2 class="product__love-heading upper">Danh sách sản phẩm</h2>
            </div>
        </div>
                <div class="row" >
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <div class="product__panel-item col-lg-4 col-md-6 col-sm-12"  >
                                <div class="product__panel-img-wrap" style="width:120px;" >
                                    <a href="index.php?act=showProductDetail&id=<?= htmlspecialchars($product['id']); ?>">
                                        <img src="<?= htmlspecialchars($product['hinh_anh']); ?>" 
                                             alt="<?= htmlspecialchars($product['ten_sach']); ?>" 
                                             class="product__panel-img">
                                    </a>
                                </div>
                                <h3 class="product__panel-heading">
                                    <a href="index.php?act=showProductDetail&id=<?= htmlspecialchars($product['id']); ?>" class="product__panel-link">
                                        <?= htmlspecialchars($product['ten_sach']); ?>
                                    </a>
                                </h3>
                                <div class="product__panel-price">
                                    <span class="product__panel-price-current">
                                        <?= number_format($product['gia_sach'], 0, ',', '.'); ?> VND
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="col-12 text-center">Không có sản phẩm nào phù hợp với từ khóa tìm kiếm.</p>
                    <?php endif; ?>
                </div>
                 <!-- Phân trang -->
<!-- Phân trang -->
<!-- Phân trang -->
<?php if (!$isSearching): ?>
<div class="pagination">
    <ul>
        <!-- Nút Trang trước -->
        <li class="<?= ($currentPage == 1) ? 'disabled' : '' ?>">
            <a href="<?= ($currentPage > 1) 
                        ? "index.php?act=productByCategory&page=" . ($currentPage - 1) 
                        : '#' ?>">
                <
            </a>
        </li>

        <!-- Hiển thị các số trang -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="<?= ($i == $currentPage) ? 'active' : '' ?>">
                <a href="index.php?act=productByCategory&page=<?= $i ?>">
                    <?= $i ?>
                </a>
            </li>
        <?php endfor; ?>

        <!-- Nút Trang sau -->
        <li class="<?= ($currentPage == $totalPages) ? 'disabled' : '' ?>">
            <a href="<?= ($currentPage < $totalPages) 
                        ? "index.php?act=productByCategory&page=" . ($currentPage + 1) 
                        : '#' ?>">
                >
            </a>
        </li>
    </ul>
</div>
<?php endif; ?>



            </div>
        </div>
    </div>
</section>

<?php 
require_once './views/layout/footer.php';
?>

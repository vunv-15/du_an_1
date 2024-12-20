<?php require_once './views/layout/header.php'; ?>
<?php require_once './views/layout/navbar.php' ?>
<?php require_once './views/layout/sidebar.php' ?>



<button onclick="topFunction()" id="myBtn-scroll" title="Go to top"><i class="fas fa-chevron-up"></i></i></button>
<!-- bestselling product -->
<section class="bestselling">
    <div class="container">
        <div class="row">
            <div class="bestselling__heading-wrap">
                <img src="./assets/images/bestselling.png" alt="Sản phẩm bán chạy"
                    class="bestselling__heading-img">
                <div class="bestselling__heading">Top sách mới nhập</div>
            </div>
        </div>

        <section class="row">
            <?php if (!empty($bestSellingProducts)): ?>
                <?php foreach ($bestSellingProducts  as $key => $sgproduct): ?>
                    <div class="bestselling__product col-lg-4 col-md-6 col-sm-12">
                        <div class="bestselling__product-img-box" style="width:100px;">
                            <img src="<?= htmlspecialchars($sgproduct['hinh_anh']) ?>" alt="<?= htmlspecialchars($sgproduct['ten_sach']) ?>" class="bestselling__product-img">
                        </div>
                        <div class="bestselling__product-text">
                            <h3 class="bestselling__product-title">
                                <a href="index.php?act=showProductDetail&id=<?= htmlspecialchars($sgproduct['id']) ?>" class="bestselling__product-link">
                                    <?= htmlspecialchars($sgproduct['ten_sach']) ?>
                                </a>
                            </h3>
                            <div class="bestselling__product-rate-wrap">
                                <i class="fas fa-star bestselling__product-rate"></i>
                                <i class="fas fa-star bestselling__product-rate"></i>
                                <i class="fas fa-star bestselling__product-rate"></i>
                                <i class="fas fa-star bestselling__product-rate"></i>
                                <i class="fas fa-star bestselling__product-rate"></i>
                            </div>
                            <div class="product__panel-price">
                                <?php if (!empty($sgproduct['gia_khuyen_mai'])) { ?>
                                    <span class="product__panel-price-old">
                                        <?= number_format($sgproduct['gia_khuyen_mai'], 0, ',', '.') ?>đ
                                    </span>
                                    <span class="product__panel-price-current">
                                        <?= number_format($sgproduct['gia_sach'], 0, ',', '.') ?>đ
                                    </span>
                                <?php } else { ?>
                                    <span class="product__panel-price-current">
                                        <?= number_format($sgproduct['gia_sach'], 0, ',', '.') ?>đ
                                    </span>
                                <?php } ?>
                            </div>
                            <div class="bestselling__product-btn-wrap">
                                <button class="bestselling__product-btn">Xem hàng</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="font-size:30px; margin-left:350px;">Không có sản phẩm bán chạy nào.</p>
            <?php endif; ?>
        </section>

        <div class="row bestselling__banner">

            <div class="bestselling__banner-left col-lg-6">
                <img src="./assets/images1/banner/920x420_phienchodocu.png" alt="Banner quảng cáo"
                    class="bestselling__banner-left-img">
            </div>
            <div class="bestselling__banner-right col-lg-6">
                <img src="./assets/images1/banner/muonkiepnhansinh_resize_920x420.jpg" alt="Banner quảng cáo"
                    class="bestselling__banner-right-img">
            </div>
        </div>
    </div>
</section>

<!-- end bestselling product -->

<!-- product -->
<section class="product">
    <div class="container">
        <div class="row">
            <aside class="product__sidebar col-lg-3 col-md-0 col-sm-12">
                <div class="product__sidebar-heading">
                    <div class=""></div>
                    <h2 class="product__sidebar-title">
                        <img src="./assets/images1/item/1380754_batman_comic_hero_superhero_icon.png" alt="" class="menu__item-icon" id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512">
                        Sách Chuyên Ngành
                    </h2>
                </div>

                <nav class="product__sidebar-list">

                    <div class="row">
                        <div class="product__sidebar-item col-lg-6">
                            <img src="https://salt.tikicdn.com/cache/750x750/ts/product/bd/74/f3/5c33e7993d6044b1d251d50ac7c14fd6.jpg.webp" alt="" class="product__sidebar-item-img">
                            <a href="" class="product__sidebar-item-name">Chat GPT</a>
                        </div>
                        <div class="product__sidebar-item col-lg-6">
                            <img src="https://salt.tikicdn.com/cache/750x750/ts/product/dd/26/49/4224fbbe438fcf9f15beba9b01fefc95.jpg.webp" class="product__sidebar-item-img">
                            <a href="" class="product__sidebar-item-name">An Toàn Mạng</a>
                        </div>
                        <div class="product__sidebar-item col-lg-6">
                            <img src="https://salt.tikicdn.com/cache/750x750/ts/product/8c/f8/59/3dfc87252e7f46b7d43e7abd65271643.jpg.webp" alt="" class="product__sidebar-item-img">
                            <a href="" class="product__sidebar-item-name">Khiêu Vũ - Áp LỰc</a>
                        </div>
                        <div class="product__sidebar-item col-lg-6">
                            <img src="https://salt.tikicdn.com/cache/750x750/ts/product/4b/3e/44/133188033ff8305f4abeb2311602fd57.jpg.webp" alt="" class="product__sidebar-item-img">
                            <a href="" class="product__sidebar-item-name">Bảo Mật Mạng</a>
                        </div>
                    </div>
                </nav>
                <br><br><br><br>
                <nav class="product__sidebar-list">

                    <div class="row">
                        <div class="product__sidebar-item col-lg-6">
                            <img src="https://salt.tikicdn.com/cache/750x750/ts/product/73/c4/ee/c60b0e53d90e8ddecd2436fe7ba8b66a.jpg.webp" alt="" class="product__sidebar-item-img">
                            <a href="" class="product__sidebar-item-name">Big Data</a>
                        </div>
                        <div class="product__sidebar-item col-lg-6">
                            <img src="https://salt.tikicdn.com/cache/750x750/ts/product/de/e4/61/eff304650d0827f583e9a95cbb1ca329.jpg.webp" class="product__sidebar-item-img">
                            <a href="" class="product__sidebar-item-name">Xu Hướng Công Nghệ</a>
                        </div>
                        <div class="product__sidebar-item col-lg-6">
                            <img src="./assets/images1/product/twd2_biaao_demo.jpg" alt="" class="product__sidebar-item-img">
                            <a href="" class="product__sidebar-item-name">Comics</a>
                        </div>
                        <div class="product__sidebar-item col-lg-6">
                            <img src="https://salt.tikicdn.com/cache/750x750/ts/product/e5/b1/af/9988dec244e14fabcd7b592f21cd13c7.jpg.webp" alt="" class="product__sidebar-item-img">
                            <a href="" class="product__sidebar-item-name">C++</a>
                        </div>
                    </div>
                </nav>

                <!-- <div class="product__sidebar-img-wrap"> -->
                <!-- <img src="./assets/images1/product/Demon Slayer_ Kimetsu no Yaiba - Assista na Crunchyroll.png" width="255" height="350" alt=""> -->
                <!-- <video width="255" height="300" controls>
                        <source src="video/contra.st_1629123780_musicaldown.com.mp4" type="video/mp4">
                        </video> -->
                <!-- <img src="./assets/images/banner_7.jpg" alt="" class="product__sidebar-img"> -->
                <!-- </div> -->
            </aside>

            <article class="product__content col-lg-9 col-md-12 col-sm-12">
                <nav class="row">
                    <ul class="product__list hide-on-mobile">
                        <li class="product__item product__item--active">
                            <a href="#" class="product__link">Sách Chuyên Ngành</a>
                        </li>
                    </ul>

                    <div class="product__title-mobile">
                        <h2>Hành động - Phiêu lưu</h2>
                    </div>
                </nav>

                <div class="row product__panel">
                    <?php foreach ($listSanPham as $key => $sanPham): ?>
                        <div class="product__panel-item col-lg-3 col-md-4 col-sm-6">
                            <div class="product__panel-item-wrap">
                                <div class="product__panel-img-wrap">
                                    <!-- Thêm liên kết xem chi tiết sản phẩm -->
                                    <a href="index.php?act=showProductDetail&id=<?= htmlspecialchars($sanPham['id']) ?>">
                                        <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= htmlspecialchars($sanPham['ten_sach']) ?>" class="product__panel-img">
                                    </a>
                                </div>
                                <h3 class="product__panel-heading">
                                    <a href="index.php?act=showProductDetail&id=<?= htmlspecialchars($sanPham['id']) ?>" class="product__panel-link">
                                        <?= htmlspecialchars($sanPham['ten_sach']) ?>
                                    </a>
                                </h3>
                                <div class="product__panel-rate-wrap">
                                    <i class="fas fa-star product__panel-rate"></i>
                                    <i class="fas fa-star product__panel-rate"></i>
                                    <i class="fas fa-star product__panel-rate"></i>
                                    <i class="fas fa-star product__panel-rate"></i>
                                    <i class="fas fa-star product__panel-rate"></i>
                                </div>

                                <div class="product__panel-price">
                                    <?php if (!empty($sanPham['gia_khuyen_mai'])) { ?>
                                        <span class="product__panel-price-old">
                                            <?= number_format($sanPham['gia_khuyen_mai'], 0, ',', '.') ?>đ
                                        </span>
                                        <span class="product__panel-price-current">
                                            <?= number_format($sanPham['gia_sach'], 0, ',', '.') ?>đ
                                        </span>
                                    <?php } else { ?>
                                        <span class="product__panel-price-current">
                                            <?= number_format($sanPham['gia_sach'], 0, ',', '.') ?>đ
                                        </span>
                                    <?php } ?>
                                </div>

                                <?php
                                $ngayXuatBan = new DateTime($sanPham['ngay_xuat_ban']);
                                $ngayHienTai = new DateTime();
                                $tinhNgay = $ngayHienTai->diff($ngayXuatBan);

                                if ($tinhNgay->days <= 7) {
                                ?>
                                    <div class="product__panel-price-sale-off">
                                        Mới
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </article>

        </div>
    </div>
</section>
<!--end product -->

<!-- product love -->
<section class="product__love">
    <div class="container">
        <div class="row bg-white">
            <div class="col-lg-12 col-md-12 col-sm-12 product__love-title">
                <h2 class="product__love-heading">Có thể bạn thích</h2>
            </div>
        </div>
        <div class="row bg-white">
            <?php if (!empty($suggestedProducts)): ?>
                <?php foreach ($suggestedProducts as $sgProduct): ?>
                    <div class="product__panel-item col-lg-2 col-md-3 col-sm-6">
                        <div class="product__panel-img-wrap">
                            <img src="<?= htmlspecialchars($sgProduct['hinh_anh']) ?>" alt="<?= htmlspecialchars($sgProduct['ten_sach']) ?>" class="product__panel-img">
                        </div>
                        <h3 class="product__panel-heading">
                            <a href="index.php?act=showProductDetail&id=<?= htmlspecialchars($sgProduct['id']) ?>" class="product__panel-link">
                                <?= htmlspecialchars($sgProduct['ten_sach']) ?>
                            </a>
                        </h3>
                        <div class="product__panel-rate-wrap">
                            <i class="fas fa-star product__panel-rate"></i>
                            <i class="fas fa-star product__panel-rate"></i>
                            <i class="fas fa-star product__panel-rate"></i>
                            <i class="fas fa-star product__panel-rate"></i>
                            <i class="fas fa-star product__panel-rate"></i>
                        </div>
                        <div class="product__panel-price">
                            <?php if (!empty($sgProduct['gia_khuyen_mai'])): ?>
                                <span class="product__panel-price-old"><?= number_format($sgProduct['gia_khuyen_mai'], 0, ',', '.') ?>đ</span>
                                <span class="product__panel-price-current"><?= number_format($sgProduct['gia_sach'], 0, ',', '.') ?>đ</span>
                            <?php else: ?>
                                <span class="product__panel-price-current"><?= number_format($sgProduct['gia_sach'], 0, ',', '.') ?>đ</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="product__love-no-product">Không có sản phẩm nào bạn có thể thích.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
<!--end product love -->

<!-- post -->
<section class="posts">
    <div class="container">
        <header class="row posts__title">
            <div class="posts__title-wrap col-lg-12 col-md-12 col-sm-12">
                <h2 class="posts__heading">
                    Tin tức - Bài viết
                </h2>
            </div>
        </header>
        <article class="row posts__list">
            <div class="posts__item col-lg-3 col-md-6 col-sm-6">
                <div class="posts__item-img">
                    <img src="./assets/images1/post/got-it-e-voucher.png" width="80%">
                </div>
                <h3 class="posts__item-heading">
                    <a href="" class="posts__item-title">
                        Mẹo săn mã voucher giảm giá tại Edu Book
                    </a>
                </h3>
                <div class="posts__item-date">
                    28/05/2020
                </div>
                <div class="posts__item-cate-wrap">
                    <div class="posts__item-cate">
                        <i class="fa fa-folder posts__item-cate-icon"></i>
                        <div class="posts__item-cate-name">
                            Tin tức
                        </div>
                    </div>
                    <div class="posts__item-cate-ad">
                        <i class="fa fa-user posts__item-cate-ad-icon"></i>
                        <div class="posts__item-cate-ad-name">
                            Nguyễn Nhung
                        </div>
                    </div>
                </div>
                <div class="posts__item-description">
                    Nếu bạn đang gặp phải những vấn đề về săn, lấy, sử dụng mã voucher của EduBook. Xin hãy yên tâm, bài viết này
                    dành cho bạn! Trong bài viết này mình sẽ chia sẻ đến bạn những mẹo, những kinh nghiệm giúp bạn săn được nhiều
                    mã giảm giá EduBook nhất có thể.....
                </div>
            </div>

            <div class="posts__item col-lg-3 col-md-6 col-sm-6">
                <div class="posts__item-img">
                    <img src="./assets/images1/post/hinh-ghep-15986994500641611959184.jpg">
                </div>
                <h3 class="posts__item-heading">
                    <a href="" class="posts__item-title">
                        Cách phân biệt sách thật, giả chính xác
                    </a>
                </h3>
                <div class="posts__item-date">
                    05/06/2020
                </div>
                <div class="posts__item-cate-wrap">
                    <div class="posts__item-cate">
                        <i class="fa fa-folder posts__item-cate-icon"></i>
                        <div class="posts__item-cate-name">
                            Tin tức
                        </div>
                    </div>
                    <div class="posts__item-cate-ad">
                        <i class="fa fa-user posts__item-cate-ad-icon"></i>
                        <div class="posts__item-cate-ad-name">
                            Trung Trần
                        </div>
                    </div>
                </div>
                <div class="posts__item-description">
                    Để các độc giả, phụ huynh, học sinh và các thầy cô giáo… không mua phải các loại sách tham khảo giả, sách in lậu,
                    mình sẽ hướng dẫn cách phân biệt sách thật, giả nhanh chóng và chính xác. Nếu bạn chú ý quan sát một xíu là có thể
                    phân biệt được sách giả ngay. Với sách giả khi cầm trên tay sẽ có cảm giác mềm hơn, không cứng và chắc tay như sách thật...
                </div>
            </div>

            <div class="posts__item col-lg-3 col-md-6 col-sm-6">
                <div class="posts__item-img">
                    <img src="./assets/images1/post/cach-su-dung-ma-giam-gia-hieu-qua-tai-vnreviews.png">
                </div>
                <h3 class="posts__item-heading">
                    <a href="#" class="posts__item-title">
                        Sử dụng mã giảm giá Edu Book như thế nào
                    </a>
                </h3>
                <div class="posts__item-date">
                    26/05/2020
                </div>
                <div class="posts__item-cate-wrap">
                    <div class="posts__item-cate">
                        <i class="fa fa-folder posts__item-cate-icon"></i>
                        <div class="posts__item-cate-name">
                            Tin tức
                        </div>
                    </div>
                    <div class="posts__item-cate-ad">
                        <i class="fa fa-user posts__item-cate-ad-icon"></i>
                        <div class="posts__item-cate-ad-name">
                            Tùng Lương
                        </div>
                    </div>
                </div>
                <div class="posts__item-description">
                    Sau khi lấy được mã rồi thì tất nhiên bạn phải biết cách sử dụng nó rồi. Về cơ bản thì EduBook cho phép bạn sử dụng cùng
                    lúc 3 loại mã giảm giá mà mình đã kể trên trong cùng 1 đơn hàng. Bao gồm:
                    Mã FreeShip,
                    Mã giảm giá của Shop,
                    Và Ưu đãi từ đối tác thanh toán,....
                </div>
            </div>

            <div class="posts__item col-lg-3 col-md-6 col-sm-6">
                <div class="posts__item-img">
                    <img src="./assets/images1/post/images.jfif">
                </div>
                <h3 class="posts__item-heading">
                    <a href="" class="posts__item-title">
                        Hướng dẫn đổi trả sách, hoàn tiền Edu Book
                    </a>
                </h3>
                <div class="posts__item-date">
                    22/05/2020
                </div>
                <div class="posts__item-cate-wrap">
                    <div class="posts__item-cate">
                        <i class="fa fa-folder posts__item-cate-icon"></i>
                        <div class="posts__item-cate-name">
                            Tin tức
                        </div>
                    </div>
                    <div class="posts__item-cate-ad">
                        <i class="fa fa-user posts__item-cate-ad-icon"></i>
                        <div class="posts__item-cate-ad-name">
                            Nguyễn Nhung
                        </div>
                    </div>
                </div>
                <div class="posts__item-description">
                    Mua hàng trên Edu Book nhưng sản phẩm bạn nhận được không giống hình, sản phẩm bị lỗi. Bạn nghĩ mình bị lừa, bạn bối rối không biết
                    làm thế nào và quyết định search google: “Phải làm gì khi muốn hoàn trả hàng hoàn tiền trên Edu Book”. Bài viết này sẽ hướng dẫn
                    bạn đổi trả sách EduBook đúng quy trình...
                </div>
            </div>
        </article>
        <article class="row posts__view">
            <!-- <a href="post.html" class="posts__view-btn">Xem thêm</a> -->
        </article>
    </div>
</section>
<!-- end post -->
<?php require_once './views/layout/footer.php' ?>
</body>

</html>
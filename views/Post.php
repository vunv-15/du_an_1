<?php
require_once './views/layout/header.php';
require_once './views/layout/navbar.php';
?>
<style>
    /* Layout for Content Section */
    .post__list {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin: 20px 0;
    }

    .post__item {
        display: flex;
        gap: 15px;
        background: #fff;
        border: 1px solid #eaeaea;
        border-radius: 8px;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    .post__item:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* Image Styling */
    .post__item-img-wrap {
        flex-shrink: 0;
        width: 150px;
    }

    .post__item-img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 8px 0 0 8px;
    }

    /* Content Styling */
    .post__item-content {
        padding: 15px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .post__item-title {
        margin: 0;
    }

    .post__item-heading {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin: 0;
        transition: color 0.3s ease;
    }

    .post__item-heading:hover {
        color: #007BFF;
    }

    .posts__item-cate-wrap {
        display: flex;
        gap: 20px;
        font-size: 14px;
        color: #777;
        align-items: center;
    }

    .posts__item-cate-icon,
    .posts__item-cate-ad-icon {
        margin-right: 5px;
        color: #555;
    }

    .posts__item-description {
        font-size: 14px;
        color: #555;
        line-height: 1.6;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .post__item {
            flex-direction: column;
        }

        .post__item-img-wrap {
            width: 100%;
        }

        .post__item-content {
            padding: 10px;
        }
    }
</style>
<section class="posts">
    <div class="container">
        <div class="row">
            <article class="post__list col-lg-9 col-md-9 col-sm-12">
                <div class="post__item">
                    <div class="post__item-img-wrap">
                        <img src="./assets/images1/post/got-it-e-voucher.png" class="post__item-img">
                    </div>

                    <div class="post__item-content">
                        <div class="post__item-title">
                            <a href="#" class="post__item-link">
                                <h2 class="post__item-heading">
                                    Mẹo săn mã voucher giảm giá tại Edu Book
                                </h2>
                            </a>
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
                </div>
                <div class="post__item">
                    <div class="post__item-img-wrap">
                        <img src="./assets/images1/post/hinh-ghep-15986994500641611959184.jpg" class="post__item-img">
                    </div>

                    <div class="post__item-content">
                        <div class="post__item-title">
                            <a href="#" class="post__item-link">
                                <h2 class="post__item-heading">
                                    Cách phân biệt sách thật, giả chính xác
                                </h2>
                            </a>
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
                </div>
                <div class="post__item">
                    <div class="post__item-img-wrap">
                        <img src="./assets/images1/post/cach-su-dung-ma-giam-gia-hieu-qua-tai-vnreviews.png" class="post__item-img">
                    </div>

                    <div class="post__item-content">
                        <div class="post__item-title">
                            <a href="#" class="post__item-link">
                                <h2 class="post__item-heading">
                                    Sử dụng mã giảm giá Edu Book như thế nào
                                </h2>
                            </a>
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
                </div>

                <div class="post__item">
                    <div class="post__item-img-wrap">
                        <img src="./assets/images1/post/images.jfif" class="post__item-img">
                    </div>

                    <div class="post__item-content">
                        <div class="post__item-title">
                            <a href="#" class="post__item-link">
                                <h2 class="post__item-heading">
                                    Hướng dẫn đổi trả sách, hoàn tiền Edu Book
                                </h2>
                            </a>
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
                </div>

                <div class="post__item">
                    <div class="post__item-img-wrap">
                        <img src="./assets/images1/post/62255041_667523643676350_795766940692905984_n.jpg" class="post__item-img">
                    </div>

                    <div class="post__item-content">
                        <div class="post__item-title">
                            <a href="#" class="post__item-link">
                                <h2 class="post__item-heading">
                                    Chương trình đổi sách cũ lấy cây xanh
                                </h2>
                            </a>
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
                            Dự án “Đổi sách cũ – Lấy cây xanh” nhận được sự hưởng ứng rất đông đảo của mọi người. Mọi người nhanh chân đến tham gia chương trình “Ngày hội Sống xanh 2021” đồng thời ghé thăm gian hàng D6 (Trung tâm ứng phó sự cố an toàn môi trường) để cùng nhau trao đổi tri thức và có được cho mình những chậu cây xanh thật dễ thương nhé...
                        </div>
                    </div>
                </div>

                <div class="post__item">
                    <div class="post__item-img-wrap">
                        <img src="./assets/images1/post/e2.jpg" class="post__item-img">
                    </div>

                    <div class="post__item-content">
                        <div class="post__item-title">
                            <a href="#" class="post__item-link">
                                <h2 class="post__item-heading">
                                    Góp sách cũ, tặng niềm vui mới cho trẻ em nghèo
                                </h2>
                            </a>
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
                            Hôm nay ngồi xếp đống sách vừa đi nhận ở trường Định Thiện Lý về do các em quyên góp, ủng hộ ác bạn nhỏ vùng xa, thấy vui ghê nơi. Rồi bỗng nhiên ngồi nhớ ra nhiều chuyện.
                            Hồi nhỏ nhà không có điều kiện, thèm đọc sách gì đâu. Mà chỗ mình lại ở vùng sâu nên đã thiếu lại càng thêm thiếu...
                        </div>
                    </div>
                </div>
            </article>

            <aside class="post__aside col-lg-3 col-md-3 col-sm-0">
                <div class="product__aside-top">
                    <div class="product__aside-top-item">
                        <div class="product__aside-top-item-text">
                            <p>
                                Giao hàng nhanh chóng
                            </p>
                            <span>
                                Chỉ trong vòng 24h
                            </span>
                        </div>
                    </div>
                    <div class="product__aside-top-item">
                        <div class="product__aside-top-item-text">
                            <p>
                                Sản phẩm chính hãng
                            </p>
                            <span>
                                Sản phẩm nhập khẩu 100%
                            </span>
                        </div>
                    </div>
                    <div class="product__aside-top-item">
                        <div class="product__aside-top-item-text">
                            <p>
                                Mua hàng tiết kiệm
                            </p>
                            <span>
                                Rẻ hơn từ 10% đến 30%
                            </span>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
<?php
require_once './views/layout/footer.php';
?>
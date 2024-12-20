<?php $productModel = new ProductModel();
$categories = $productModel->getAllCategories(); ?>

<header id="header">
    <!-- header top -->
    <div class="header__top">
        <div class="container">
            <section class="row flex">
                <div class="col-lg-5 col-md-0 col-sm-0 heade__top-left">
                    <span>EduBook - Cội nguồn của tri thức</span>
                </div>

                <nav class="col-lg-7 col-md-0 col-sm-0 header__top-right">
                    <ul class="header__top-list">
                        <li class="header__top-item">
                            <a href="<?= BASE_URL . '?act=register' ?>" class="header__top-link">Đăng ký</a>
                        </li>
                        <li class="header__top-item dropdown">
                            <a href="#" class="header__top-link">Đăng nhập</a>
                            <ul class="dropdown-menu" style="min-width: 130px;">
                                <li><a href="<?= BASE_URL . '?act=login' ?>"><i class="fas fa-user fa-sm"></i> Đăng nhập Client</a></li>
                                <li><a href="<?= BASE_URL_ADMIN . '?act=login-admin' ?>"><i class="fas fa-user-shield fa-sm"></i> Đăng nhập Admin</a></li>
                                <?php if (isset($_SESSION['user_client'])): ?>
                                    <!-- Nếu đã đăng nhập, hiển thị  -->
                                    <?php if (isset($_SESSION['user_client'])): ?>
                                        <!-- Nếu đã đăng nhập, hiển thị thông tin người dùng -->
                                        <li><a href="<?= BASE_URL . '?act=chi-tiet-khach-hang&id=' . $_SESSION['user_client']['id'] ?>"><i class="fas fa-id-card fa-sm"></i> Thông tin cá nhân</a></li>
                                    <?php endif; ?>
                                    <li><a href="<?= BASE_URL . '?act=orderHistory' ?>">Lich sử đơn hàng</a></li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= BASE_URL . '?act=logout' ?>" onclick="return confirm('Đăng xuất tài khoản ?')">
                                            <i class="fas fa-sign-out-alt fa-sm"></i> Logout
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php if (isset($_SESSION['user_client'])): ?>
                            <!-- Nếu đã đăng nhập, hiển thị thông tin người dùng -->
                            <li class="header__top-item d-flex align-items-center bg-primary" style="margin-left: 20px;">
                                <p class="m-0 fw-bold text-light" style="font-size: 1.2rem;">
                                    <i class="fa fa-user me-2 text-light fa-sm"></i>
                                    Hello <?php echo $_SESSION['user_client']['ho_ten']; ?> <!-- In ra tên người dùng -->
                                </p>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </section>
        </div>
    </div>
    <!--end header top -->
    <!-- header bottom -->
    <div class="header__bottom">
        <div class="container">
            <section class="row">
                <div class="col-lg-3 col-md-4 col-sm-12 header__logo">
                    <h1 class="header__heading">
                        <a href="#" class="header__logo-link">
                            <img src="./assets/images1/logo1.png" alt="Logo" class="header__logo-img">
                        </a>
                    </h1>
                </div>

                <div class="col-lg-6 col-md-7 col-sm-0 header__search">
                    <form id="search-form" class="header__search-form" action="index.php" method="get">
                        <input type="hidden" name="act" value="search">
                        <div class="header__search-container">
                            <input
                                type="text"
                                name="keyword"
                                class="header__search-input"
                                placeholder="Tìm kiếm tại đây..."
                                id="search-keyword">
                            <button type="submit" class="header__search-btn">
                                <i class="fas fa-search header__search-icon"></i>
                            </button>
                        </div>
                    </form>
                    <!-- Kết quả tìm kiếm -->
                    <div id="search-results" class="search-results hidden"></div>
                </div>

                <div class="col-lg-2 col-md-0 col-sm-0 header__call">
                    <div class="header__call-icon-wrap">
                        <i class="fas fa-phone-alt header__call-icon"></i>
                    </div>
                    <div class="header__call-info">
                        <div class="header__call-text">
                            Gọi điện tư vấn
                        </div>
                        <div class="header__call-number">
                            039.882.3232
                        </div>
                    </div>
                </div>

                <a href="index.php?act=viewCart" class="col-lg-1 col-md-1 col-sm-0 header__cart">
                    <div class="header__cart-icon-wrap">
                        <i class="fas fa-shopping-cart header__nav-cart-icon"></i>
                        <span class="header__notice"><?= htmlspecialchars($uniqueProductCount ?? 0) ?></span>
                    </div>
                </a>

            </section>
        </div>
    </div>
    <!--end header bottom -->
    <!-- header nav -->
    <div class="header__nav">
        <div class="container">
            <section class="row">
                <div class="header__nav-menu-wrap col-lg-3 col-md-0 col-sm-0">
                    <i class="fas fa-bars header__nav-menu-icon">
                        <div id="dropdownMenu" class="header__nav-menu hidden">
                            <select class="catelist" onchange="location = this.value;">
                                <option value="index.php?act=productByCategory" <?= empty($_GET['danh_muc_id']) ? 'selected' : '' ?>>
                                    Tất cả
                                </option>
                                <?php if (isset($categories)): ?>
                                    <?php foreach ($categories as $category): ?>
                                        <option
                                            value="index.php?act=productByCategory&danh_muc_id=<?= $category['id'] ?>"
                                            <?= (isset($_GET['danh_muc_id']) && $_GET['danh_muc_id'] == $category['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($category['ten_danh_muc']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option disabled>Không có danh mục</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </i>

                    <style>
                        .header__nav-menu {
                            position: absolute;
                            transform: translateX(-10%);
                            margin-top: 10px;
                            border-radius: 5px;
                            z-index: 1000;

                        }

                        .header__nav-menu select {
                            width: 285px;
                            padding: 8px 12px;
                            font-size: 14px;
                            border: 1px solid #ddd;
                            border-radius: 5px;
                            outline: none;
                        }

                        .hidden {
                            display: none;
                        }

                        .fas.fa-bars {
                            cursor: pointer;
                            font-size: 24px;
                        }

                        .header__search-container {
                            display: flex;
                            align-items: center;
                            border: 1px solid #ddd;
                            border-radius: 5px;
                            background-color: white;
                            overflow: hidden;
                        }

                        .header__search-category {
                            border: none;
                            padding: 0 10px;
                            background: none;
                            cursor: pointer;
                            outline: none;
                            font-size: 14px;
                            color: #333;
                        }

                        .header__search-category:focus {
                            outline: none;
                        }

                        .header__search-input {
                            flex: 1;
                            border: none;
                            padding: 10px;
                            font-size: 14px;
                            outline: none;
                            width: 500px;
                        }

                        .header__search-btn {
                            background-color: #ff4d4d;
                            border: none;
                            padding: 10px 15px;
                            cursor: pointer;
                            outline: none;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }

                        .header__search-btn .header__search-icon {
                            color: white;
                            font-size: 16px;
                        }

                        .header__search-btn:hover {
                            background-color: #e63939;
                        }

                        .header__search-container input:focus {
                            outline: none;
                        }

                        .search-results {
                            position: absolute;
                            top: calc(80%);
                            left: 15px;
                            width: 100%;
                            max-width: 548px;
                            background: #ffffff;
                            border: 1px solid #ddd;
                            border-radius: 8px;
                            z-index: 1000;
                            font-size: 70px;
                            max-height: 300px;
                            overflow-y: auto;
                            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                            padding: 8px 0;
                        }

                        .search-results ul {
                            list-style: none;
                            margin: 0;
                            padding: 0;
                        }

                        .search-results li {
                            display: flex;
                            align-items: center;
                            padding: 8px 12px;
                            border-bottom: 1px solid #f1f1f1;
                            cursor: pointer;
                            transition: background-color 0.2s ease;
                        }

                        .search-results li:hover {
                            background-color: #f9f9f9;
                        }

                        .search-results li:last-child {
                            border-bottom: none;
                        }

                        .search-results img {
                            width: 40px;
                            height: 40px;
                            object-fit: cover;
                            border-radius: 4px;
                            margin-right: 12px;
                        }

                        .search-results .search-result-title {
                            font-size: 14px;
                            color: #333;
                            line-height: 1.4;
                            flex: 1;
                        }

                        .search-results .search-result-empty {
                            color: #888;
                            font-size: 14px;
                            text-align: center;
                            padding: 10px 0;
                        }
                    </style>
                    <div class="header__nav-menu-title">Danh mục sản phẩm</div>
                    <script>
                        const menuIcon = document.querySelector(".header__nav-menu-icon");
                        const dropdownMenu = document.getElementById("dropdownMenu");

                        menuIcon.addEventListener("mouseover", () => {
                            dropdownMenu.classList.remove("hidden");
                        });


                        dropdownMenu.addEventListener("mouseout", (e) => {
                            if (!menuIcon.contains(e.relatedTarget)) {
                                dropdownMenu.classList.add("hidden");
                            }
                        });
                        document.getElementById('search-keyword').addEventListener('input', function() {
                            const keyword = this.value.trim();
                            const resultsContainer = document.getElementById('search-results');

                            if (keyword === '') {
                                resultsContainer.classList.add('hidden');
                                return;
                            }

                            // Gửi AJAX để tìm kiếm
                            fetch(`index.php?act=search&keyword=${encodeURIComponent(keyword)}`, {
                                    method: 'GET',
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                    },
                                })
                                .then((response) => response.text())
                                .then((html) => {
                                    resultsContainer.innerHTML = `<ul>${html}</ul>`;
                                    resultsContainer.classList.remove('hidden');
                                })
                                .catch((error) => {
                                    console.error('Error:', error);
                                    resultsContainer.innerHTML = '<p class="search-result-empty">Có lỗi xảy ra. Vui lòng thử lại.</p>';
                                    resultsContainer.classList.remove('hidden');
                                });
                        });

                        // Điều hướng đến trang chi tiết sản phẩm
                        function redirectToProduct(productId) {
                            window.location.href = `index.php?act=showProductDetail&id=${productId}`;
                        }

                        // Ẩn kết quả khi click ra ngoài
                        document.addEventListener('click', function(e) {
                            const resultsContainer = document.getElementById('search-results');
                            if (!resultsContainer.contains(e.target) && e.target.id !== 'search-keyword') {
                                resultsContainer.classList.add('hidden');
                            }
                        });
                    </script>

                </div>
                <div class="header__nav col-lg-9 col-md-0 col-sm-0">
                    <ul class="header__nav-list">
                        <li class="header__nav-item">
                            <a href="index.php" class="header__nav-link">Trang Chủ</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="index.php?act=productByCategory" class="header__nav-link">Danh Mục Sản Phẩm</a>

                        </li>
                        <li class="header__nav-item">
                            <a href="index.php?act=post" class="header__nav-link">Bài Viết</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="index.php?act=contact" class="header__nav-link">Liên Hệ</a>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
</header>
<!--end header nav -->
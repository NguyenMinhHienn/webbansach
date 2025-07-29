<!-- Page Header Start -->
<div class="container-fluid store-header">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1>Cửa Hàng</h1>
        <p class="welcome-text">Chào mừng bạn đến với thế giới mua sắm tuyệt vời của chúng tôi!</p>
        <div class="d-inline-flex breadcrumb-links mt-3">
            <p><a href="index.php">Trang chủ</a></p>
            <p class="px-2">-</p>
            <p>Sản phẩm</p>
        </div>
    </div>
</div>

<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12 mb-4">
            <h5 class="font-weight-semi-bold mb-4">Bộ lọc sản phẩm</h5>
            <form method="GET" action="index.php">
                <input type="hidden" name="act" value="search">

                <!-- Categories -->
                <div class="border-bottom mb-4 pb-4">
                    <h6 class="font-weight-semi-bold mb-3">Danh mục</h6>
                    <select name="category_id" class="form-control">
                        <option value="">Tất cả danh mục</option>
                        <?php foreach ($listDanhMuc as $md): ?>
                            <option value="<?= $md['id'] ?>"
                                <?= (isset($_GET['category_id']) && $_GET['category_id'] == $md['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($md['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Price Range -->
                <div class="border-bottom mb-4 pb-4">
                    <h6 class="font-weight-semi-bold mb-3">Khoảng giá</h6>
                    <select name="price_range" class="form-control">
                        <option value="">Tất cả giá</option>
                        <option value="0-50000" <?= (isset($_GET['price_range']) && $_GET['price_range'] == '0-50000') ? 'selected' : '' ?>>
                            Dưới 50,000đ
                        </option>
                        <option value="50000-100000" <?= (isset($_GET['price_range']) && $_GET['price_range'] == '50000-100000') ? 'selected' : '' ?>>
                            50,000đ - 100,000đ
                        </option>
                        <option value="100000-200000" <?= (isset($_GET['price_range']) && $_GET['price_range'] == '100000-200000') ? 'selected' : '' ?>>
                            100,000đ - 200,000đ
                        </option>
                        <option value="200000-500000" <?= (isset($_GET['price_range']) && $_GET['price_range'] == '200000-500000') ? 'selected' : '' ?>>
                            200,000đ - 500,000đ
                        </option>
                        <option value="500000-999999999" <?= (isset($_GET['price_range']) && $_GET['price_range'] == '500000-999999999') ? 'selected' : '' ?>>
                            Trên 500,000đ
                        </option>
                    </select>
                </div>

                <!-- Sort Products -->
                <div class="border-bottom mb-4 pb-4">
                    <h6 class="font-weight-semi-bold mb-3">Sắp xếp</h6>
                    <select name="sort" class="form-control">
                        <option value="">Mặc định</option>
                        <option value="price_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : '' ?>>
                            Giá: Thấp đến cao
                        </option>
                        <option value="price_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : '' ?>>
                            Giá: Cao đến thấp
                        </option>
                        <option value="name_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'name_asc') ? 'selected' : '' ?>>
                            Tên: A đến Z
                        </option>
                        <option value="name_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'name_desc') ? 'selected' : '' ?>>
                            Tên: Z đến A
                        </option>
                        <option value="newest" <?= (isset($_GET['sort']) && $_GET['sort'] == 'newest') ? 'selected' : '' ?>>
                            Mới nhất
                        </option>
                        <option value="bestseller" <?= (isset($_GET['sort']) && $_GET['sort'] == 'bestseller') ? 'selected' : '' ?>>
                            Bán chạy nhất
                        </option>
                    </select>
                </div>

                <!-- Filter Buttons -->
                <div class="mb-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-search mr-2"></i>Lọc sản phẩm
                    </button>
                    <a href="?act=search" class="btn btn-outline-secondary btn-block mt-2">
                        <i class="fa fa-redo mr-2"></i>Đặt lại
                    </a>
                </div>
            </form>

            <!-- Current Filters -->
            <?php if (isset($_GET['keyword']) || isset($_GET['category_id']) || isset($_GET['price_range']) || isset($_GET['sort'])): ?>
                <div class="border-top pt-4">
                    <h6 class="font-weight-semi-bold mb-3">Bộ lọc đang chọn:</h6>
                    <div class="d-flex flex-wrap">
                        <?php if (!empty($_GET['keyword'])): ?>
                            <span class="badge badge-primary m-1 p-2">
                                Từ khóa: <?= htmlspecialchars($_GET['keyword']) ?>
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($_GET['category_id'])): ?>
                            <span class="badge badge-info m-1 p-2">
                                Danh mục: <?= htmlspecialchars($listDanhMuc[$_GET['category_id']]['name'] ?? '') ?>
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($_GET['price_range'])): ?>
                            <span class="badge badge-success m-1 p-2">
                                Giá: <?= str_replace(
                                            ['0-50000', '50000-100000', '100000-200000', '200000-500000', '500000-999999999'],
                                            ['Dưới 50k', '50k-100k', '100k-200k', '200k-500k', 'Trên 500k'],
                                            $_GET['price_range']
                                        ) ?>
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($_GET['sort'])): ?>
                            <span class="badge badge-warning m-1 p-2">
                                Sắp xếp: <?= str_replace(
                                                ['price_asc', 'price_desc', 'name_asc', 'name_desc', 'newest', 'bestseller'],
                                                ['Giá tăng', 'Giá giảm', 'Tên A-Z', 'Tên Z-A', 'Mới nhất', 'Bán chạy'],
                                                $_GET['sort']
                                            ) ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!-- Shop Sidebar End -->

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <?php
            // Khởi tạo các biến phân trang
            $items_per_page = 8; // Số sản phẩm trên mỗi trang
            $total_products = count($listsp); // Tổng số sản phẩm
            $totalPages = ceil($total_products / $items_per_page); // Tổng số trang
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Trang hiện tại
            if ($page < 1) $page = 1;
            if ($page > $totalPages) $page = $totalPages;

            // Tính vị trí bắt đầu lấy sản phẩm
            $start = ($page - 1) * $items_per_page;

            // Lấy sản phẩm cho trang hiện tại
            $current_page_products = array_slice($listsp, $start, $items_per_page);
            ?>



            <!-- Product List -->
            <div class="row pb-3">
                <?php if (empty($listsp)): ?>
                    <div class="col-12 text-center">
                        <p>Không tìm thấy sản phẩm nào!</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($current_page_products as $sp): ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <?php if (!empty($sp['sale_value'])): ?>
                                        <div class="position-absolute bg-danger text-white p-1"
                                            style="top: 0; left: 0; font-size: 0.9rem; z-index: 1;">
                                            -<?php echo number_format($sp['sale_value'], 0); ?>%
                                        </div>
                                    <?php endif; ?>
                                    <img class="img-fluid custom-img" src="<?php echo removeFirstChar($sp['image']) ?>" alt="">

                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3"><?php echo htmlspecialchars($sp['title']); ?></h6>
                                    <div class="d-flex justify-content-center">
                                        <h6 class="text-danger">
                                            <?php echo number_format($sp['price'], 0, ',', '.'); ?>đ
                                        </h6>
                                        <?php if (!empty($sp['sale_value'])): ?>
                                            <h6 class="text-muted ml-2">
                                                <del><?php echo number_format($sp['original_price'], 0, ',', '.'); ?>đ</del>
                                            </h6>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="card-footer d-flex justify-content-center bg-light border">
                                    <a href="?act=chitietsp&id=<?php echo $sp['id'] ?>" class="btn btn-sm text-dark p-0">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="col-12 pb-1">
                    <nav>
                        <ul class="pagination justify-content-center mb-3">
                            <!-- Previous -->
                            <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?act=sanpham&page=<?php echo max(1, $page - 1); ?>">
                                    <span>&laquo;</span>
                                </a>
                            </li>

                            <!-- Page Numbers -->
                            <?php
                            $range = 2;
                            $start_page = max(1, $page - $range);
                            $end_page = min($totalPages, $page + $range);

                            // First page
                            if ($start_page > 1) {
                                echo '<li class="page-item"><a class="page-link" href="?act=sanpham&page=1">1</a></li>';
                                if ($start_page > 2) {
                                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                }
                            }

                            // Page numbers
                            for ($i = $start_page; $i <= $end_page; $i++):
                            ?>
                                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?act=sanpham&page=<?php echo $i; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor;

                            // Last page
                            if ($end_page < $totalPages) {
                                if ($end_page < $totalPages - 1) {
                                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                }
                                echo '<li class="page-item"><a class="page-link" href="?act=sanpham&page=' . $totalPages . '">' . $totalPages . '</a></li>';
                            }
                            ?>

                            <!-- Next -->
                            <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?act=sanpham&page=<?php echo min($totalPages, $page + 1); ?>">
                                    <span>&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <?php endif; ?>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap');
body, html {
    font-family: 'Montserrat', Arial, sans-serif;
}

    .store-header {
        background: linear-gradient(135deg, #3d6477ff, #5bade4ff); /* Gradient nền */
        color: white;
        border-radius: 15px;
        padding: 60px 20px;
        margin-bottom: 50px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .store-header h1 {
        font-size: 48px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 15px;
        color: #ffffff;
        animation: fadeInDown 1s ease-out;
    }

    .store-header .breadcrumb-links p {
        margin: 0;
        font-size: 16px;
        color: #ddd;
        animation: fadeIn 1.5s ease-in;
    }

    .store-header .breadcrumb-links a {
        color: #ffffff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .store-header .breadcrumb-links a:hover {
        color: #00c6ff;
        text-decoration: underline;
    }

    .store-header .breadcrumb-links p.px-2 {
        color: #bbb;
    }

    .store-header .welcome-text {
        font-size: 20px;
        font-weight: 400;
        color: #f1f1f1;
        margin-top: 10px;
        animation: fadeInUp 1.5s ease-out;
    }

    /* Hiệu ứng */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
/* Header */
.container-fluid.bg-secondary {
    border-radius: 0 0 24px 24px;
    box-shadow: 0 4px 24px rgba(52,152,219,0.10);
    background: linear-gradient(90deg, #6dd5fa 0%, #2980b9 100%);
    color: #fff;
    margin-bottom: 40px;
}
.container-fluid.bg-secondary h1 {
    font-size: 2.5rem;
    font-weight: 800;
    letter-spacing: 2px;
    text-shadow: 0 2px 8px rgba(41,128,185,0.18);
}
.container-fluid.bg-secondary a {
    color: #f1c40f;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.2s;
}
.container-fluid.bg-secondary a:hover {
    color: #fff;
    text-decoration: underline;
}

/* Sidebar bộ lọc */
.col-lg-3 {
    background: #f7f9fa;
    border-radius: 18px;
    box-shadow: 0 2px 16px rgba(52,152,219,0.08);
    padding: 28px 18px 18px 18px;
    margin-bottom: 32px;
}
.col-lg-3 h5 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2980b9;
    margin-bottom: 24px;
}
.col-lg-3 h6 {
    color: #2980b9;
    font-weight: 700;
}
.col-lg-3 select, .col-lg-3 .form-control {
    border-radius: 8px;
    border: 1.5px solid #b2bec3;
    font-size: 1.05rem;
    margin-bottom: 8px;
    padding: 8px 12px;
}
.col-lg-3 .btn-primary, .col-lg-3 .btn-outline-secondary {
    font-size: 1.08rem;
    font-weight: 700;
    border-radius: 8px;
    padding: 8px 0;
    margin-bottom: 6px;
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
}
.col-lg-3 .btn-primary {
    background: linear-gradient(90deg, #2980b9, #6dd5fa);
    border: none;
    color: #fff;
    box-shadow: 0 2px 8px rgba(52,152,219,0.10);
}
.col-lg-3 .btn-primary:hover {
    background: linear-gradient(90deg, #6dd5fa, #2980b9);
    color: #fff;
}
.col-lg-3 .btn-outline-secondary {
    border: 2px solid #b2bec3;
    color: #2980b9;
    background: #fff;
}
.col-lg-3 .btn-outline-secondary:hover {
    background: #2980b9;
    color: #fff;
    border-color: #f1c40f;
}
.col-lg-3 .badge {
    font-size: 1rem;
    border-radius: 8px;
    padding: 6px 14px;
    font-weight: 600;
    margin-bottom: 4px;
}
.col-lg-3 .badge-primary { background: #2980b9; }
.col-lg-3 .badge-info { background: #6dd5fa; color: #fff; }
.col-lg-3 .badge-success { background: #27ae60; }
.col-lg-3 .badge-warning { background: #f1c40f; color: #fff; }

/* Sản phẩm */
.product-item {
    border-radius: 16px !important;
    box-shadow: 0 2px 16px rgba(52,152,219,0.08);
    transition: box-shadow 0.2s, transform 0.2s;
    border: 1.5px solid #eaf6fb !important;
    background: #fff;
    overflow: hidden;
    min-height: 370px;
    display: flex;
    flex-direction: column;
}
.product-item:hover {
    box-shadow: 0 8px 32px rgba(52,152,219,0.16);
    transform: translateY(-6px) scale(1.03);
    border-color: #6dd5fa !important;
    z-index: 2;
}
.product-img img, .custom-img {
    width: 160px;
    height: 160px;
    object-fit: cover;
    border-radius: 12px;
    margin: 0 auto;
    box-shadow: 0 2px 8px rgba(41,128,185,0.07);
    background: #fff;
    margin-top: 18px;
}
.product-img .position-absolute {
    font-size: 1.05rem !important;
    font-weight: 700;
    padding: 5px 14px;
    border-radius: 12px;
    top: 10px !important;
    left: 10px !important;
    background: linear-gradient(90deg, #e74c3c, #e67e22);
    color: #fff;
    box-shadow: 0 2px 8px rgba(231,76,60,0.12);
    z-index: 2;
}
.card-body h6 {
    font-size: 1.08rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 8px;
}
.card-body .text-danger {
    font-size: 1.13rem;
    font-weight: 800;
    color: #e74c3c !important;
    margin-right: 8px;
}
.card-body .text-muted {
    font-size: 1.05rem;
    font-weight: 600;
    color: #b2bec3 !important;
}
.card-footer {
    background: #f7f9fa !important;
    border-top: 1.5px solid #eaf6fb !important;
    border-radius: 0 0 16px 16px !important;
    padding: 10px 0 !important;
}
.card-footer .btn {
    font-size: 1.08rem;
    font-weight: 700;
    border-radius: 8px;
    padding: 6px 18px;
    background: linear-gradient(90deg, #2980b9, #6dd5fa);
    color: #fff;
    border: none;
    transition: background 0.2s, color 0.2s;
}
.card-footer .btn:hover {
    background: linear-gradient(90deg, #6dd5fa, #2980b9);
    color: #fff;
}

/* Phân trang */
.pagination .page-link {
    font-size: 1.08rem;
    font-weight: 700;
    color: #2980b9;
    border-radius: 8px;
    margin: 0 2px;
    border: 1.5px solid #eaf6fb;
    transition: background 0.2s, color 0.2s;
}
.pagination .page-item.active .page-link, .pagination .page-link:hover {
    background: linear-gradient(90deg, #2980b9, #6dd5fa);
    color: #fff;
    border-color: #2980b9;
}
.pagination .page-item.disabled .page-link {
    color: #b2bec3;
    background: #f7f9fa;
    border-color: #eaf6fb;
}
</style>
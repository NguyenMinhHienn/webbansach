<!-- Page Header Start -->
<div class="container-fluid shop-header mb-5 position-relative">
    <div class="overlay"></div>
    <div class="d-flex flex-column align-items-center justify-content-center text-white text-center" style="min-height: 300px; position: relative; z-index: 2;">
        <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">📚 Cửa hàng sách & truyện</h1>
        <a href="index.php" class="btn btn-outline-light px-4 py-2 animate__animated animate__fadeInUp">
            <i class="fa fa-arrow-left me-2"></i> Về trang chủ
        </a>
    </div>
</div>


<!-- Shop Content Start -->
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
                        <?php foreach ($listdm as $dm): ?>  
                            <option value="<?= $dm['id'] ?>"
                                <?= (isset($_GET['category_id']) && $_GET['category_id'] == $dm['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($dm['name']) ?>
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

                        <?php
                        $categoryName = '';
                        $selectedCategoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

                        foreach ($listdm as $dm) {
                            if ($dm['id'] == $selectedCategoryId) {
                                $categoryName = $dm['name'];
                                break;
                            }
                        }
                        ?>

                        <?php if (!empty($categoryName)): ?>
                            <span class="badge badge-info m-1 p-2">
                                Danh mục: <?= htmlspecialchars($categoryName) ?>
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
            // Lọc sản phẩm theo từ khóa tìm kiếm
            if (!empty($_GET['keyword'])) {
                $keyword = mb_strtolower(trim($_GET['keyword']), 'UTF-8'); // Chuyển keyword về chữ thường và loại bỏ khoảng trắng thừa
                $listsp = array_filter($listsp, function ($sp) use ($keyword) {
                    $title = mb_strtolower($sp['title'], 'UTF-8'); // Chuyển tên sản phẩm về chữ thường
                    return str_contains($title, $keyword);
                });
            }

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

            <div class="row pb-3">
                <?php if (empty($listsp)): ?>
                    <div class="col-12">
                        <p class="text-center">Không tìm thấy sản phẩm nào!</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($current_page_products as $sp): ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <?php if (!empty($sp['sale_value'])): ?>
                                        <div class="position-absolute bg-danger text-white p-1"
                                            style="top: 0; left: 0; font-size: 0.9rem; z-index: 1;">
                                            -<?= $sp['sale_value'] ?>%
                                        </div>
                                    <?php endif; ?>
                                    <img class="img-fluid custom-img" src="<?= removeFirstChar($sp['image']) ?>" alt="">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3"><?= htmlspecialchars($sp['title']) ?></h6>
                                    <div class="d-flex justify-content-center">
                                        <h6 class="text-danger"><?= number_format($sp['final_price']) ?>đ</h6>
                                        <?php if (!empty($sp['sale_value'])): ?>
                                            <h6 class="text-muted ml-2">
                                                <del><?= number_format($sp['original_price']) ?>đ</del>
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

                    <!-- Pagination -->
                    <?php if ($totalPages > 1): ?>
                        <div class="col-12 pb-1">
                            <nav>
                                <ul class="pagination justify-content-center mb-3">
                                    <!-- Previous -->
                                    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?act=search&page=<?= ($page - 1) ?>&keyword=<?= urlencode($keyword ?? '') ?>&category_id=<?= $category_id ?? '' ?>&price_range=<?= $price_range ?? '' ?>&sort=<?= $sort ?? '' ?>">
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
                                        echo '<li class="page-item"><a class="page-link" href="?act=search&page=1&keyword=' . urlencode($keyword ?? '') . '&category_id=' . ($category_id ?? '') . '&price_range=' . ($price_range ?? '') . '&sort=' . ($sort ?? '') . '">1</a></li>';
                                        if ($start_page > 2) {
                                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                        }
                                    }

                                    // Page numbers
                                    for ($i = $start_page; $i <= $end_page; $i++):
                                    ?>
                                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                            <a class="page-link" href="?act=search&page=<?= $i ?>&keyword=<?= urlencode($keyword ?? '') ?>&category_id=<?= $category_id ?? '' ?>&price_range=<?= $price_range ?? '' ?>&sort=<?= $sort ?? '' ?>">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                    <?php endfor;

                                    // Last page
                                    if ($end_page < $totalPages) {
                                        if ($end_page < $totalPages - 1) {
                                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                        }
                                        echo '<li class="page-item"><a class="page-link" href="?act=search&page=' . $totalPages . '&keyword=' . urlencode($keyword ?? '') . '&category_id=' . ($category_id ?? '') . '&price_range=' . ($price_range ?? '') . '&sort=' . ($sort ?? '') . '">' . $totalPages . '</a></li>';
                                    }
                                    ?>

                                    <!-- Next -->
                                    <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?act=search&page=<?= ($page + 1) ?>&keyword=<?= urlencode($keyword ?? '') ?>&category_id=<?= $category_id ?? '' ?>&price_range=<?= $price_range ?? '' ?>&sort=<?= $sort ?? '' ?>">
                                            <span>&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <!-- Shop Product End -->

    </div>
</div>
<style>
    .custom-img {
        width: 200px;
        /* Hoặc kích thước mong muốn */
        height: 200px;
        object-fit: cover;
        /* Cắt ảnh để vừa khung mà không bị méo */
    }
</style>
<!-- Nhúng animate.css nếu chưa có -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
:root {
    --primary-color: #6C5CE7;    /* tím nhạt */
    --secondary-color: #ffeaa7;  /* vàng nhạt */
    --accent-color: #00cec9;     /* xanh biển */
    --bg-light: #f8f9fa;
    --text-dark: #2d3436;
    --text-muted: #636e72;
}

/* ==== HEADER CỬA HÀNG ==== */
.shop-header {
    background: url('https://images.unsplash.com/photo-1600508771731-d7e29f649707?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80') center center/cover no-repeat;
    position: relative;
    border-radius: 0 0 30px 30px;
}
.shop-header .overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(108, 92, 231, 0.7);
    z-index: 1;
}
.shop-header .btn {
    border-radius: 30px;
}

/* ==== NỘI DUNG TIÊU ĐỀ ==== */
.shop-header h1 {
    color: white;
    font-size: 3rem;
    text-shadow: 2px 2px 5px rgba(0,0,0,0.3);
}
.shop-header a.btn {
    font-weight: 500;
    font-size: 1rem;
}

/* ==== KHUNG BỘ LỌC ==== */
.col-lg-3 {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    padding: 25px;
    margin-bottom: 30px;
}
.col-lg-3 h6, .col-lg-3 h5 {
    color: var(--primary-color);
}
.col-lg-3 select {
    border-radius: 12px;
    border: 1px solid #dfe6e9;
    padding: 8px 12px;
    transition: all 0.3s ease;
}
.col-lg-3 select:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 5px rgba(0, 206, 201, 0.3);
}

/* ==== NÚT LỌC ==== */
.btn-primary {
    background-color: var(--primary-color);
    border: none;
}
.btn-primary:hover {
    background-color: #5e54c6;
}
.btn-outline-secondary:hover {
    background-color: var(--secondary-color);
    color: black;
}

/* ==== THẺ SẢN PHẨM ==== */
.product-item {
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}
.product-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.product-img {
    position: relative;
    overflow: hidden;
    border-radius: 20px 20px 0 0;
}
.product-img img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: transform 0.4s ease-in-out;
}
.product-img:hover img {
    transform: scale(1.05);
}

/* ==== GIÁ & TÊN ==== */
.card-body h6 {
    color: var(--text-dark);
    font-weight: 600;
}
.card-body .text-danger {
    color: #e17055 !important;
}
.card-body del {
    font-size: 0.85rem;
    color: #b2bec3;
}

/* ==== FOOTER SẢN PHẨM ==== */
.card-footer {
    background: var(--bg-light);
    border-top: none;
    border-radius: 0 0 20px 20px;
}
.card-footer a {
    font-weight: 500;
    color: #0984e3;
    transition: all 0.3s ease;
}
.card-footer a:hover {
    color: #6c5ce7;
    text-decoration: underline;
}

/* ==== PHÂN TRANG ==== */
.pagination .page-link {
    color: var(--primary-color);
    border: 1px solid #ccc;
}
.pagination .page-item.active .page-link {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}
.pagination .page-link:hover {
    background-color: var(--accent-color);
    color: white;
}

/* ==== BADGE LỌC ==== */
.badge {
    font-size: 0.85rem;
    border-radius: 20px;
    padding: 6px 12px;
}
.badge-primary {
    background-color: var(--primary-color);
}
.badge-info {
    background-color: var(--accent-color);
}
.badge-success {
    background-color: #55efc4;
}
.badge-warning {
    background-color: #fab1a0;
}
</style>

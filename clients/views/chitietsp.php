<?php

if (!empty($sanphamCT)): ?>
    <div class="row px-xl-5 product-detail-modern">
        <div class="col-lg-5 pb-5">
            <div class="product-image-modern position-relative shadow-lg rounded-lg overflow-hidden">
                <img id="product-image" class="w-100 h-100 img-fluid" src="<?= removeFirstChar($sanphamCT['image']) ?? '' ?>" alt="Image">
                <?php if (!empty($sanphamCT['sale_value'])): ?>
                    <span class="badge badge-sale-modern position-absolute">
                        <?php if ($sanphamCT['sale_value'] < 100): ?>
                            -<?= number_format($sanphamCT['sale_value'], 0) ?>%
                        <?php else: ?>
                            -<?= number_format($sanphamCT['sale_value'], 0, ',', '.') ?> đ
                        <?php endif; ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-bold mb-3 product-title-modern"><?= $sanphamCT['title'] ?? '' ?></h3>
            <div class="product-details mb-4">
                <?php if (!empty($sanphamCT['variants'])): ?>
                    <div class="variants-container-modern mb-3">
                        <?php foreach ($sanphamCT['variants'] as $variant): ?>
                            <button class="btn variant-btn-modern"
                                data-price="<?= $variant['price'] ?>"
                                data-stock="<?= $variant['stock_quantity'] ?>"
                                data-image="<?= removeFirstChar($variant['image']) ?>"
                                data-format="<?= $variant['format'] ?>"
                                data-language="<?= $variant['language'] ?>"
                                data-sale-value="<?= $variant['sale_value'] ?>"
                                onclick="updateVariantInfo(this)">
                                <?= $variant['format'] ?> + <?= $variant['language'] ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <p class="mb-4 stock-modern" id="stock-display"><i class="fas fa-box"></i> Còn : <?= $sanphamCT['stock_quantity'] ?? '' ?> sản phẩm</p>


            <div class="mb-4">
                <h3 class="font-weight-bold d-inline text-danger product-price-modern" id="product-price">
                    <?php
                    if (!empty($sanphamCT['sale_value'])) {
                        $original_price =  $sanphamCT['price'];
                        $sale_value = $sanphamCT['sale_value'];
                        if ($sale_value < 100) {
                            $final_price = $original_price - ($original_price * $sale_value / 100);
                        } else {
                            $final_price = $original_price - $sale_value;
                        }
                        echo number_format(max($final_price, 0), 0, ',', '.') . ' đ';
                    } else {
                        echo number_format($sanphamCT['price'] ?? 0, 0, ',', '.') . ' đ';
                    }
                    ?>
                </h3>
                <?php if (!empty($sanphamCT['sale_value'])): ?>
                    <h5 class="font-weight-semi-bold d-inline text-muted ml-2" id="original-price" style="text-decoration: line-through;">
                        <?= number_format($sanphamCT['original_price'] ?? $sanphamCT['price'], 0, ',', '.') ?> đ
                    </h5>
                <?php endif; ?>
            </div>
            <p class="mb-4 product-desc-modern"><?= $sanphamCT['description'] ?? '' ?></p>

            <form action="?act=add-item-to-cart" method="POST" class="d-flex align-items-center mb-4 pt-2">
                <input type="hidden" name="variant_id" value="<?= htmlspecialchars($sanphamCT['id'] ?? '') ?>">
                <input type="hidden" name="comic_id" value="<?= htmlspecialchars($sanphamCT['comic_id'] ?? $sanphamCT['id'] ?? '') ?>">
                <?php if (($sanphamCT['stock_quantity'] ?? 0) > 0): ?>
                    <div class="input-group quantity mr-3 quantity-modern">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-outline-primary btn-minus btn-qty-modern" onclick="decreaseValue()">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" name="quantity" id="quantity" class="form-control bg-light text-center qty-input-modern" value="1" min="1" max="<?= (int) $sanphamCT['stock_quantity'] ?>">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-outline-primary btn-plus btn-qty-modern" onclick="increaseValue()">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" name="view-shopping-cart" class="btn btn-gradient-modern px-4 shadow-sm ml-2">
                        <i class="fa fa-shopping-cart mr-1"></i> Thêm vào giỏ
                    </button>
                <?php else: ?>
                    <div class="alert alert-warning mb-0">Hết Hàng</div>
                <?php endif; ?>
            </form>
            <form action="?act=checkout" method="POST" style="display: inline;" onsubmit="return validateBeforeCheckout()">
                <input type="hidden" name="buy_now" value="1">
                <input type="hidden" name="comic_id" value="<?= htmlspecialchars($sanphamCT['id'] ?? '') ?>">
                <input type="hidden" name="quantity" id="buy_now_quantity" value="1">
                <input type="hidden" name="price" value="<?= htmlspecialchars($final_price ?? $sanphamCT['price'] ?? '') ?>">
                <input type="hidden" name="title" value="<?= htmlspecialchars($sanphamCT['title'] ?? '') ?>">
                <input type="hidden" name="image" value="<?= htmlspecialchars($sanphamCT['image'] ?? '') ?>">
                <button type="submit" class="btn btn-gradient-modern px-4 shadow-sm ml-2">
                    <i class="fa fa-bolt mr-1"></i> Mua ngay
                </button>
            </form>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-warning">No product details available.</div>
<?php endif; ?>

<div class="d-flex pt-2 share-modern">
    <p class="text-dark font-weight-medium mb-0 mr-2">Chia sẻ:</p>
    <div class="d-inline-flex">
        <a class="text-dark px-2 social-icon-modern" href="#"><i class="fab fa-facebook-f"></i></a>
        <a class="text-dark px-2 social-icon-modern" href="#"><i class="fab fa-twitter"></i></a>
        <a class="text-dark px-2 social-icon-modern" href="#"><i class="fab fa-linkedin-in"></i></a>
        <a class="text-dark px-2 social-icon-modern" href="#"><i class="fab fa-pinterest"></i></a>
    </div>
</div>

<div class="row px-xl-5">
    <div class="col">
        <!-- Tabs for Comments and Reviews -->
        <div class="modern-tabs-container">
            <ul class="nav nav-tabs modern-tabs justify-content-center border-0 mb-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="comments-tab-btn" data-toggle="tab" href="#comments-tab" role="tab"><i class="far fa-comments mr-1"></i> Bình luận</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="reviews-tab-btn" data-toggle="tab" href="#reviews-tab" role="tab"><i class="far fa-star mr-1"></i> Đánh giá</a>
                </li>
            </ul>
            <div class="tab-content modern-tab-content">
                <!-- Comments Section -->
                <div class="tab-pane fade show active" id="comments-tab" role="tabpanel">
                    <div class="row g-4 align-items-stretch">
                        <div class="col-md-6">
                            <div class="modern-card shadow-sm p-4 h-100">
                                <h5 class="mb-3 text-primary font-weight-bold"><i class="far fa-comments mr-2"></i>Danh sách bình luận</h5>
                                <?php
                                $comments_shown = 0;
                                $has_comments = false;
                                ?>
                                <div id="comment-list">
                                    <?php foreach ($binhluans as $key => $binhluan): ?>
                                        <?php if ($binhluan['comics_id'] == $sanphamCT['id']): ?>
                                            <?php if ($binhluan['status'] == '2'): ?>
                                                <?php $has_comments = true; ?>
                                                <div class="media mb-3 comment-item modern-comment-item animate__animated animate__fadeInUp" style="display: <?= $comments_shown < 5 ? 'block' : 'none'; ?>;">
                                                    <div class="media-body">
                                                        <h6 class="mb-1"><span class="font-weight-bold text-dark"><i class="fa fa-user-circle mr-1"></i><?= $binhluan['name'] ?: 'Khách' ?></span><small class="text-muted ml-2"><i class="fa fa-clock mr-1"></i><?= $binhluan['Create_at'] ?></small></h6>
                                                        <p class="mb-0 text-secondary"><span><?= $binhluan['Content'] ?></span></p>
                                                    </div>
                                                </div>
                                                <?php $comments_shown++; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <?php if (!$has_comments): ?>
                                    <p class="text-muted">Sản phẩm chưa có bình luận.</p>
                                <?php elseif ($comments_shown > 5): ?>
                                    <div class="btn-group mt-3">
                                        <button id="load-more-comments" class="btn btn-outline-primary btn-sm">Xem thêm</button>
                                        <button id="close-comments" class="btn btn-outline-secondary btn-sm" style="display: none;">Đóng</button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modern-card shadow-sm p-4 h-100">
                                <h5 class="mb-3 text-success font-weight-bold"><i class="fa fa-plus-circle mr-2"></i>Thêm bình luận mới</h5>
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <form action="<?= '?act=add-binh-luan&id=' . $sanphamCT['id'] ?>" method="POST">
                                        <div class="form-group mb-3">
                                            <label for="Content">Nội dung bình luận:</label>
                                            <textarea name="Content" id="Content" class="form-control" rows="4" placeholder="Nhập nội dung bình luận..." required></textarea>
                                        </div>
                                        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                                        <input type="hidden" name="comics_id" value="<?= $sanphamCT['id'] ?>">
                                        <button type="submit" class="btn btn-gradient-modern px-4">Gửi bình luận</button>
                                    </form>
                                <?php else: ?>
                                    <p>Vui lòng <a href="index.php?act=login" class="text-primary font-weight-bold">đăng nhập</a> để bình luận.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Reviews Section -->
                <div class="tab-pane fade" id="reviews-tab" role="tabpanel">
                    <div class="row g-4 align-items-stretch">
                        <div class="col-md-6">
                            <div class="modern-card shadow-sm p-4 h-100">
                                <h5 class="mb-3 text-warning font-weight-bold"><i class="far fa-star mr-2"></i>Danh sách đánh giá</h5>
                                <?php
                                function getRatingStars($ratingText)
                                {
                                    $ratings = [
                                        'very_bad' => 1,
                                        'bad' => 2,
                                        'average' => 3,
                                        'good' => 4,
                                        'excellent' => 5,
                                    ];
                                    return $ratings[$ratingText] ?? 0;
                                }
                                $reviews_shown = 0;
                                $has_reviews = false;
                                ?>
                                <?php foreach ($danhgias as $key => $danhgia): ?>
                                    <?php if ($sanphamCT['id'] == $danhgia['comic_id']): ?>
                                        <?php if ($danhgia['status'] == 'approved'): ?>
                                            <?php $has_reviews = true; ?>
                                            <div class="media mb-3 modern-review-item animate__animated animate__fadeInUp">
                                                <div class="media-body">
                                                    <h6 class="mb-1"><span class="font-weight-bold text-dark"><i class="fa fa-user-circle mr-1"></i><?= $danhgia['name'] ?: 'Khách' ?></span><small class="text-muted ml-2"><i class="fa fa-clock mr-1"></i><?= date('d/m/Y', strtotime($danhgia['created_at'])) ?></small></h6>
                                                    <div class="mb-2">
                                                        <span class="text-warning">
                                                            <?php $rating = getRatingStars($danhgia['rating']); ?>
                                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                                <?php if ($i <= $rating): ?>
                                                                    <i class="fa fa-star"></i>
                                                                <?php else: ?>
                                                                    <i class="fa fa-star-o"></i>
                                                                <?php endif; ?>
                                                            <?php endfor; ?>
                                                        </span>
                                                        <span class="text-muted small">(<?= ucfirst($danhgia['rating']) ?>)</span>
                                                    </div>
                                                    <p class="mb-0 text-secondary">Nội dung: <?= htmlspecialchars($danhgia['review_text']) ?></p>
                                                </div>
                                            </div>
                                            <?php $reviews_shown++; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if (!$has_reviews): ?>
                                    <p class="text-muted">Sản phẩm chưa có đánh giá.</p>
                                <?php elseif ($reviews_shown > 5): ?>
                                    <div class="btn-group mt-3">
                                        <button id="load-more-reviews" class="btn btn-outline-warning btn-sm">Xem thêm</button>
                                        <button id="close-reviews" class="btn btn-outline-secondary btn-sm" style="display: none;">Đóng</button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modern-card shadow-sm p-4 h-100">
                                <h5 class="mb-3 text-info font-weight-bold"><i class="fa fa-plus-circle mr-2"></i>Thêm đánh giá mới</h5>
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <form action="<?= '?act=add-danh-gia&id=' . $sanphamCT['id'] ?>" method="POST">
                                        <div class="form-group mb-3">
                                            <label for="rating">Đánh giá:</label>
                                            <select name="rating" id="rating" class="form-control" required>
                                                <option value="">Chọn mức đánh giá</option>
                                                <option value="very_bad">Rất tệ</option>
                                                <option value="bad">Tệ</option>
                                                <option value="average">Trung bình</option>
                                                <option value="good">Tốt</option>
                                                <option value="excellent">Xuất sắc</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="review_text">Nội dung đánh giá:</label>
                                            <textarea name="review_text" id="review_text" class="form-control" rows="4" placeholder="Nhập nội dung đánh giá..." required></textarea>
                                        </div>
                                        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                                        <input type="hidden" name="comic_id" value="<?= $sanphamCT['id'] ?>">
                                        <button type="submit" class="btn btn-gradient-modern px-4">Gửi đánh giá</button>
                                    </form>
                                <?php else: ?>
                                    <p>Vui lòng <a href="index.php?act=login" class="text-primary font-weight-bold">đăng nhập</a> để đánh giá.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Products Start -->
        <div class="container-fluid pt-5">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2">Sách cùng thể loại</span></h2>
            </div>
            <div class="row px-xl-5 pb-3">
                <?php
                $count = 0;
                $displayed_products = array();
                foreach ($sanphamCL as $spcl):

                    if (in_array($spcl['id'], $displayed_products)) continue;
                    $displayed_products[] = $spcl['id'];

                    $count++;
                ?>
                    <a href="?act=chitietsp&id=<?php echo $spcl['id'] ?>" class="text-decoration-none text-dark">
                        <div class="product-card" style="flex: 0 0 20%; max-width: 20%; padding: 0 10px; box-sizing: border-box;">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <?php if (!empty($spcl['sale_value'])): ?>
                                        <div class="position-absolute bg-danger text-white p-1" style="top: 0; left: 0; font-size: 0.9rem; z-index: 1;">
                                            <?php
                                            if ($spcl['sale_value'] < 100) {
                                                echo '-' . number_format($spcl['sale_value'], 0) . '%';
                                            } else {
                                                echo '-' . number_format($spcl['sale_value'], 0, ',', '.') . ' đ';
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>

                                    <img class="img-fluid w-100" src="<?php echo removeFirstChar($spcl['image']) ?>" alt="" style="width: 50%; height: auto;">
                                </div>

                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3"><?php echo $spcl['title'] ?></h6>

                                    <div class="d-flex justify-content-center">
                                        <h5 class=" text-danger small-price">
                                            <?php
                                            $original_price = $spcl['original_price'];
                                            $final_price = $original_price;
                                            $has_discount = false;

                                            // Kiểm tra giảm giá theo phần trăm hoặc giảm giá cố định
                                            if (!empty($spcl['sale_value'])) {
                                                $has_discount = true;
                                                if ($spcl['sale_value'] < 100) {
                                                    // Giảm giá theo phần trăm
                                                    $final_price -= ($original_price * $spcl['sale_value'] / 100);
                                                } else {
                                                    // Giảm giá theo số tiền cố định
                                                    $final_price -= $spcl['sale_value'];
                                                }
                                            }

                                            echo number_format(max($final_price, 0), 0, ',', '.'); // Đảm bảo giá không âm
                                            ?> đ
                                        </h5>
                                        <?php if ($has_discount): ?>
                                            <h6 class="text-muted ml-2"><del><?php echo number_format($original_price, 0, ',', '.') ?> đ</del></h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-center bg-light border">
                                    <a href="?act=chitietsp&id=<?php echo $spcl['id'] ?>" class="btn btn-sm text-dark p-0">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach ?>


                <?php if ($count == 0): ?>
                    <div class="col-12 text-center">Không có sản phẩm cùng loại</div>
                <?php endif; ?>
            </div>
        </div>
        <!-- Nút điều hướng -->
        <button class="btn-carousel btn-left">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="btn-carousel btn-right">
            <i class="fas fa-chevron-right"></i>
        </button>





        <script>
            function increaseValue() {
                var input = document.getElementById('quantity');
                var max = parseInt(input.getAttribute('max'));
                var value = parseInt(input.value);

                if (value < max) {
                    input.value = value + 1;
                }
            }

            function decreaseValue() {
                var input = document.getElementById('quantity');
                var value = parseInt(input.value);

                if (value > 1) {
                    input.value = value - 1;
                }
            }

            // Thêm validation khi người dùng nhập trực tiếp
            document.getElementById('quantity').addEventListener('change', function() {
                var value = parseInt(this.value);
                var max = parseInt(this.getAttribute('max'));

                if (isNaN(value) || value < 1) {
                    this.value = 1;
                } else if (value > max) {
                    this.value = max;
                }
            });

            function updateVariantInfo(button) {
                // Lấy các giá trị từ data-* của nút
                var price = parseFloat(button.getAttribute('data-price'));
                var stock = parseInt(button.getAttribute('data-stock'));
                var image = button.getAttribute('data-image');
                var saleValue = parseFloat(button.getAttribute('data-sale-value') || 0);

                // Kiểm tra các giá trị đã được lấy đúng chưa
                console.log('Price:', price, 'Stock:', stock, 'Image:', image, 'Sale Value:', saleValue);

                // Tính giá sau giảm giá nếu có
                var finalPrice = price;
                if (saleValue > 0) {
                    if (saleValue < 100) {
                        // Giảm giá theo phần trăm
                        finalPrice = price - (price * saleValue / 100);
                    } else {
                        // Giảm giá theo số tiền cố định
                        finalPrice = price - saleValue;
                    }
                }

                // Cập nhật giá hiển thị
                document.getElementById('product-price').textContent =
                    new Intl.NumberFormat('vi-VN').format(Math.max(finalPrice, 0)) + ' đ';

                // Cập nhật số lượng tồn kho
                var stockDisplay = document.getElementById('stock-display');
                stockDisplay.textContent = `Còn : ${stock} sản phẩm`;

                // Cập nhật hình ảnh sản phẩm
                document.getElementById('product-image').src = image ? image : '';

                // Cập nhật số lượng tối đa (max) cho input số lượng
                var quantityInput = document.getElementById('quantity');
                quantityInput.setAttribute('max', stock);
                quantityInput.value = Math.min(quantityInput.value, stock);

                // Cập nhật giá trị số lượng "mua ngay"
                document.getElementById('buy_now_quantity').value = Math.min(1, stock);
            }


            function validateBeforeCheckout() {
                // Kiểm tra đăng nhập
                <?php if (!isset($_SESSION['user'])): ?>
                    Swal.fire({
                        title: 'Thông báo',
                        text: 'Vui lòng đăng nhập để mua hàng!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Đăng nhập',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index.php?act=login';
                        }
                    });
                    return false;
                <?php endif; ?>

                // Kiểm tra số lượng tồn kho
                const quantity = parseInt(document.getElementById('quantity').value);
                const stock = parseInt(document.getElementById('quantity').getAttribute('max'));

                if (quantity > stock) {
                    Swal.fire({
                        title: 'Lỗi',
                        text: 'Số lượng vượt quá tồn kho!',
                        icon: 'error'
                    });
                    return false;
                }

                // Cập nhật số lượng cho form mua ngay
                document.getElementById('buy_now_quantity').value = quantity;
                return true;
            }

            // Hiển thị giá gốc nếu có giảm giá
            if (saleValue > 0) {
                document.getElementById('original-price').style.display = 'inline';
                document.getElementById('original-price').textContent =
                    new Intl.NumberFormat('vi-VN').format(price) + ' đ';
            } else {
                document.getElementById('original-price').style.display = 'none';
            }

            // Cập nhật số lượng tồn kho
            document.querySelector('.variant-stock').textContent = stock ? stock : '0';

            // Cập nhật hình ảnh
            document.getElementById('product-image').src = image ? image : '';

            // Cập nhật thông tin biến thể đã chọn
            document.querySelector('.selected-variant-info').style.display = 'block';


            function validateBeforeCheckout() {
                // Kiểm tra đăng nhập
                <?php if (!isset($_SESSION['user'])): ?>
                    Swal.fire({
                        title: 'Thông báo',
                        text: 'Vui lòng đăng nhập để mua hàng!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Đăng nhập',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index.php?act=login';
                        }
                    });
                    return false;
                <?php endif; ?>

                // Kiểm tra số lượng tồn kho
                const quantity = parseInt(document.getElementById('quantity').value);
                const stock = parseInt('<?= $sanphamCT['stock_quantity'] ?? 0 ?>');

                if (quantity > stock) {
                    Swal.fire({
                        title: 'Lỗi',
                        text: 'Số lượng vượt quá tồn kho!',
                        icon: 'error'
                    });
                    return false;
                }

                // Cập nhật số lượng cho form mua ngay
                document.getElementById('buy_now_quantity').value = quantity;
                return true;
            }
            //
            document.addEventListener("DOMContentLoaded", function() {
                const loadMoreBtn = document.getElementById("load-more-comments");
                const closeCommentsBtn = document.getElementById("close-comments");
                const commentItems = document.querySelectorAll(".comment-item");
                let visibleCount = 5;

                if (loadMoreBtn) {
                    loadMoreBtn.addEventListener("click", function() {
                        // Hiển thị các bình luận tiếp theo
                        for (let i = visibleCount; i < visibleCount + 5; i++) {
                            if (commentItems[i]) {
                                commentItems[i].style.display = "block";
                            }
                        }
                        visibleCount += 5;

                        // Hiển thị nút "Đóng" khi có nhiều hơn 5 bình luận
                        if (visibleCount > 5) {
                            closeCommentsBtn.style.display = "inline-block";
                        }

                        // Ẩn nút "Xem thêm" nếu không còn bình luận
                        if (visibleCount >= commentItems.length) {
                            loadMoreBtn.style.display = "none";
                        }
                    });
                }

                if (closeCommentsBtn) {
                    closeCommentsBtn.addEventListener("click", function() {
                        // Ẩn các bình luận và chỉ hiển thị 5 bình luận đầu
                        for (let i = 5; i < commentItems.length; i++) {
                            commentItems[i].style.display = "none";
                        }
                        visibleCount = 5;

                        // Hiển thị lại nút "Xem thêm" và ẩn nút "Đóng"
                        loadMoreBtn.style.display = "inline-block";
                        closeCommentsBtn.style.display = "none";
                    });
                }
            });

            function increaseValue() {
                var value = parseInt(document.getElementById('quantity').value);
                value = isNaN(value) ? 0 : value;
                value++;
                document.getElementById('quantity').value = value;
            }

            function decreaseValue() {
                var value = parseInt(document.getElementById('quantity').value);
                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    document.getElementById('quantity').value = value;
                }
            }
        </script>
        <style>
            .product-detail-modern {
                background: #fff;
                border-radius: 18px;
                box-shadow: 0 6px 32px rgba(0,0,0,0.08);
                margin-bottom: 2rem;
                padding: 2rem 1.5rem 1.5rem 1.5rem;
                font-family: 'Montserrat', Arial, sans-serif;
            }
            .product-image-modern {
                background: linear-gradient(135deg, #f8fafc 60%, #e3f0ff 100%);
                border-radius: 18px;
                box-shadow: 0 4px 24px rgba(0,123,255,0.08);
                min-height: 350px;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                overflow: hidden;
            }
            .badge-sale-modern {
                top: 18px;
                left: 18px;
                background: linear-gradient(90deg, #ff512f 0%, #dd2476 100%);
                color: #fff;
                font-size: 1rem;
                font-weight: 700;
                padding: 8px 16px;
                border-radius: 16px;
                box-shadow: 0 2px 8px rgba(221,36,118,0.15);
                z-index: 2;
                letter-spacing: 1px;
                animation: badge-pop 0.7s cubic-bezier(.68,-0.55,.27,1.55);
            }
            @keyframes badge-pop {
                0% { transform: scale(0.7); opacity: 0; }
                80% { transform: scale(1.15); opacity: 1; }
                100% { transform: scale(1); }
            }
            .product-title-modern {
                font-size: 2.1rem;
                color: #222;
                letter-spacing: 0.5px;
                margin-bottom: 0.5rem;
            }
            .product-price-modern {
                font-size: 2rem;
                font-weight: 700;
                color: #e53935;
                margin-right: 1rem;
                letter-spacing: 1px;
                transition: color 0.2s;
            }
            .product-price-modern:hover {
                color: #ff512f;
            }
            .product-desc-modern {
                font-size: 1.1rem;
                color: #444;
                background: #f8fafc;
                border-radius: 12px;
                padding: 1rem 1.2rem;
                margin-bottom: 1.5rem;
                box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            }
            .variants-container-modern {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }
            .variant-btn-modern {
                border-radius: 12px;
                border: 2px solid #007bff;
                background: #fff;
                color: #007bff;
                font-weight: 600;
                padding: 8px 18px;
                transition: all 0.2s, box-shadow 0.3s;
                box-shadow: 0 2px 8px rgba(0,123,255,0.07);
                margin-bottom: 4px;
            }
            .variant-btn-modern:hover, .variant-btn-modern.active {
                background: linear-gradient(90deg, #007bff 0%, #00c6ff 100%);
                color: #fff;
                box-shadow: 0 4px 16px rgba(0,123,255,0.15);
                transform: translateY(-2px) scale(1.04);
            }
            .stock-modern {
                font-size: 1.1rem;
                color: #009688;
                font-weight: 500;
                margin-bottom: 1.2rem;
            }
            .quantity-modern {
                border-radius: 12px;
                overflow: hidden;
                background: #f8fafc;
                box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            }
            .btn-qty-modern {
                border-radius: 0;
                background: #fff;
                color: #007bff;
                border: none;
                font-size: 1.2rem;
                transition: background 0.2s, color 0.2s;
            }
            .btn-qty-modern:hover {
                background: #007bff;
                color: #fff;
            }
            .qty-input-modern {
                border: none;
                background: #f8fafc;
                font-size: 1.1rem;
                font-weight: 600;
                width: 60px;
                text-align: center;
                color: #222;
            }
            .btn-gradient-modern {
                background: linear-gradient(90deg, #ff512f 0%, #dd2476 100%);
                color: #fff;
                font-weight: 700;
                border-radius: 12px;
                border: none;
                box-shadow: 0 2px 8px rgba(221,36,118,0.12);
                transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
            }
            .btn-gradient-modern:hover {
                background: linear-gradient(90deg, #dd2476 0%, #ff512f 100%);
                box-shadow: 0 4px 16px rgba(221,36,118,0.18);
                transform: translateY(-2px) scale(1.04);
            }
            .share-modern .social-icon-modern {
                color: #fff;
                background: linear-gradient(135deg, #007bff 0%, #00c6ff 100%);
                border-radius: 50%;
                width: 36px;
                height: 36px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 8px;
                font-size: 1.1rem;
                transition: background 0.2s, transform 0.2s;
                box-shadow: 0 2px 8px rgba(0,123,255,0.10);
            }
            .share-modern .social-icon-modern:hover {
                background: linear-gradient(135deg, #ff512f 0%, #dd2476 100%);
                color: #fff;
                transform: scale(1.12);
            }
            @media (max-width: 991.98px) {
                .product-detail-modern { padding: 1rem 0.5rem; }
                .product-title-modern { font-size: 1.5rem; }
                .product-price-modern { font-size: 1.3rem; }
                .product-image-modern { min-height: 220px; }
            }
            @media (max-width: 767.98px) {
                .product-detail-modern { flex-direction: column; }
                .product-image-modern { min-height: 180px; }
                .product-title-modern { font-size: 1.1rem; }
            }
        </style>
        <style>
            /* Vùng chứa số lượng sản phẩm */
            .quantity-modern {
                display: flex;
                align-items: center;
                max-width: 150px;
                border: 1px solid #ccc;
                border-radius: 10px;
                overflow: hidden;
                background-color: #fff;
            }

            /* Nút + và - */
            .btn-qty-modern {
                width: 40px;
                height: 40px;
                border: none;
                background: #f0f0f0;
                color: #333;
                transition: background-color 0.2s, transform 0.2s;
            }

            .btn-qty-modern:hover {
                background-color: #007bff;
                color: #fff;
                transform: scale(1.05);
            }

            /* Ô nhập số lượng */
            .qty-input-modern {
                width: 50px;
                text-align: center;
                border: none;
                outline: none;
                font-weight: bold;
                font-size: 16px;
            }

            /* Nút thêm vào giỏ */
            .btn-gradient-modern {
                background: linear-gradient(to right, #ff6a00, #ee0979);
                color: white;
                border: none;
                border-radius: 8px;
                transition: 0.3s;
            }

            .btn-gradient-modern:hover {
                background: linear-gradient(to right, #ee0979, #ff6a00);
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                transform: translateY(-2px);
            }
        </style>
        

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const productContainers = document.querySelectorAll('.products-container');

                productContainers.forEach(container => {
                    const wrapper = container.querySelector('.products-wrapper');
                    const btnLeft = container.parentElement.querySelector('.btn-left');
                    const btnRight = container.parentElement.querySelector('.btn-right');

                    // Ngăn chặn kéo hình ảnh
                    wrapper.querySelectorAll('img').forEach(img => {
                        img.addEventListener('dragstart', (e) => e.preventDefault());
                        img.style.pointerEvents = 'none'; // Vô hiệu hóa tương tác chuột với hình ảnh
                    });

                    let isDragging = false;
                    let startX;
                    let scrollLeft;
                    let momentum = 0;
                    let animationId;

                    // Mouse events với momentum scrolling
                    wrapper.addEventListener('mousedown', (e) => {
                        isDragging = true;
                        wrapper.classList.add('dragging');
                        startX = e.pageX;
                        scrollLeft = wrapper.scrollLeft;
                        momentum = 0;
                        cancelAnimationFrame(animationId);
                        e.preventDefault(); // Ngăn chặn hành vi mặc định
                    });

                    wrapper.addEventListener('mousemove', (e) => {
                        if (!isDragging) return;
                        e.preventDefault();

                        const x = e.pageX;
                        const delta = (startX - x);
                        wrapper.scrollLeft = scrollLeft + delta;

                        momentum = delta * 0.1;
                        startX = x;
                        scrollLeft = wrapper.scrollLeft;
                    });

                    // Thêm event listener cho document để xử lý mouseup bên ngoài wrapper
                    document.addEventListener('mouseup', finishDragging);
                    document.addEventListener('mouseleave', finishDragging);

                    function finishDragging() {
                        if (!isDragging) return;
                        isDragging = false;
                        wrapper.classList.remove('dragging');

                        function momentumScroll() {
                            if (Math.abs(momentum) > 0.1) {
                                wrapper.scrollLeft += momentum;
                                momentum *= 0.95;
                                animationId = requestAnimationFrame(momentumScroll);
                            }
                        }
                        momentumScroll();
                    }

                    // Button navigation với animation mượt
                    btnLeft.addEventListener('click', () => {
                        const scrollAmount = wrapper.offsetWidth * 0.8;
                        smoothScroll(wrapper, -scrollAmount);
                    });

                    btnRight.addEventListener('click', () => {
                        const scrollAmount = wrapper.offsetWidth * 0.8;
                        smoothScroll(wrapper, scrollAmount);
                    });

                    function smoothScroll(element, amount) {
                        const start = element.scrollLeft;
                        const target = start + amount;
                        const duration = 500; // ms
                        const startTime = performance.now();

                        function animation(currentTime) {
                            const elapsed = currentTime - startTime;
                            const progress = Math.min(elapsed / duration, 1);

                            // Easing function for smoother animation
                            const easeProgress = 1 - Math.pow(1 - progress, 4);

                            element.scrollLeft = start + (amount * easeProgress);

                            if (progress < 1) {
                                requestAnimationFrame(animation);
                            }
                        }

                        requestAnimationFrame(animation);
                    }
                });
            });
        </script>




        <style>
            .btn-carousel {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background-color: rgba(0, 123, 255, 0.8);
                /* Màu nền xanh mờ */
                color: white;
                /* Màu chữ trắng */
                border: 2px solid transparent;
                /* Border mặc định trong suốt */
                border-radius: 50%;
                /* Bo góc tròn */
                width: 40px;
                /* Kích thước nhỏ hơn */
                height: 40px;
                /* Kích thước nhỏ hơn */
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                z-index: 10;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                /* Hiệu ứng bóng */
                transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease, border 0.3s ease;
            }

            .btn-carousel:hover {
                background-color: rgba(0, 123, 255, 1);
                /* Màu nền đậm hơn khi hover */
                transform: translateY(-50%) scale(1.1);
                /* Phóng to nhẹ khi hover */
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
                /* Tăng độ bóng khi hover */
            }

            .btn-carousel:active {
                border: 2px solid black;
                /* Border đen khi nhấn */
                transform: translateY(-50%) scale(0.95);
                /* Thu nhỏ nhẹ khi nhấn */
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                /* Giảm bóng khi nhấn */
            }

            .btn-left {
                left: -5px;
                /* Vị trí nút bên trái */
            }

            .btn-right {
                right: -5px;
                /* Vị trí nút bên phải */
            }

            .btn-carousel i {
                font-size: 18px;
                /* Kích thước icon nhỏ hơn */
            }

            .products-wrapper {
                display: flex;
                overflow-x: auto;
                scroll-behavior: auto;
                /* Thay đổi từ smooth sang auto để tránh xung đột với custom scrolling */
                -webkit-overflow-scrolling: touch;
                cursor: grab;
                user-select: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                scroll-snap-type: x proximity;
                /* Thay đổi từ mandatory sang proximity để mượt hơn */
                gap: 10px;
                /* Thêm khoảng cách giữa các items */
            }

            .products-wrapper::-webkit-scrollbar {
                display: none;
            }

            .products-wrapper.dragging {
                cursor: grabbing;
                scroll-behavior: auto;
                scroll-snap-type: none;
                /* Tắt snap trong khi kéo */
            }

            .product-card {
                flex: 0 0 20%;
                max-width: 20%;
                padding: 0 10px;
                box-sizing: border-box;
                scroll-snap-align: start;
                transition: transform 0.3s ease;
            }

            .product-card:hover {
                transform: translateY(-5px);
            }

            /* Thêm media query để điều chỉnh vị trí nút trên màn hình nhỏ */
            @media (max-width: 1200px) {
                .btn-left {
                    left: 10px;
                }

                .btn-right {
                    right: 10px;
                }
            }

            /* Thêm overflow-x: hidden cho container để tránh thanh cuộn ngang */
            .container-fluid {
                overflow-x: hidden;
            }

            /* Đảm bảo scroll smooth hoạt động trên tất cả các trình duyệt */
            @supports (scroll-behavior: smooth) {
                .products-wrapper {
                    scroll-behavior: smooth;
                }
            }

            /* Thêm styles để ngăn chặn việc chọn text */
            .products-wrapper {
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .product-img img {
                pointer-events: none;
                /* Vô hiệu hóa tương tác chuột với hình ảnh */
                -webkit-user-drag: none;
                /* Ngăn kéo hình ảnh trên Chrome/Safari */
                -khtml-user-drag: none;
                /* Ngăn kéo hình ảnh trên các trình duyệt khác */
                -moz-user-drag: none;
                -o-user-drag: none;
                -user-drag: none;
            }
        </style>
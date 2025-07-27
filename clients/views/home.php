
<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Sách Hot</span></h2>
    </div>
    <div class="modern-products-grid">
        <?php
        $displayed_products = array();
        foreach ($sanphams_hot as $sanpham):
            if (in_array($sanpham['id'], $displayed_products)) continue;
            $displayed_products[] = $sanpham['id'];
        ?>
        <div class="modern-product-card">
            <a href="?act=chitietsp&id=<?php echo $sanpham['id'] ?>" class="modern-product-link">
                <div class="modern-product-img-wrap">
                    <?php if (!empty($sanpham['sale_value'])): ?>
                        <span class="modern-sale-badge">
                            <?php
                            if ($sanpham['sale_value'] < 100) {
                                echo '-' . number_format($sanpham['sale_value'], 0) . '%';
                            } else {
                                echo '-' . number_format($sanpham['sale_value'], 0, ',', '.') . ' đ';
                            }
                            ?>
                        </span>
                    <?php endif; ?>
                    <img class="modern-product-img" src="<?php echo removeFirstChar($sanpham['image']) ?>" alt="">
                </div>
                <div class="modern-product-info">
                    <h6 class="modern-product-title"><?php echo $sanpham['title'] ?></h6>
                    <div class="modern-product-prices">
                        <?php
                        $original_price = $sanpham['original_price'];
                        $final_price = $original_price;
                        $has_discount = false;
                        if (!empty($sanpham['sale_value'])) {
                            $has_discount = true;
                            if ($sanpham['sale_value'] < 100) {
                                $final_price -= ($original_price * $sanpham['sale_value'] / 100);
                            } else {
                                $final_price -= $sanpham['sale_value'];
                            }
                        }
                        ?>
                        <span class="modern-final-price"><?php echo number_format(max($final_price, 0), 0, ',', '.') ?> đ</span>
                        <?php if ($has_discount): ?>
                            <span class="modern-original-price"><?php echo number_format($original_price, 0, ',', '.') ?> đ</span>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach ?>
    </div>
</div>
<!-- Products End -->






<!-- Category/Hot Banner Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <!-- Danh mục nổi bật -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="category-banner-modern shadow-lg rounded-lg p-4 h-100 d-flex flex-column justify-content-center align-items-center">
                <h4 class="font-weight-bold mb-3 text-primary"><i class="fa fa-th-large mr-2"></i>Danh mục nổi bật</h4>
                <div class="d-flex flex-wrap justify-content-center">
                    <a href="?act=search&category_id=1" class="btn btn-category mr-2 mb-2"><i class="fa fa-heart text-danger mr-1"></i> Tình cảm</a>
                    <a href="?act=search&category_id=2" class="btn btn-category mr-2 mb-2"><i class="fa fa-magic text-warning mr-1"></i> Kỳ ảo</a>
                    <a href="?act=search&category_id=3" class="btn btn-category mr-2 mb-2"><i class="fa fa-user-secret text-info mr-1"></i> Trinh thám</a>
                    <a href="?act=search&category_id=4" class="btn btn-category mr-2 mb-2"><i class="fa fa-laugh-squint text-success mr-1"></i> Hài hước</a>
                    <a href="?act=search&category_id=5" class="btn btn-category mr-2 mb-2"><i class="fa fa-rocket text-primary mr-1"></i> Phiêu lưu</a>
                    <a href="?act=search&category_id=6" class="btn btn-category mr-2 mb-2"><i class="fa fa-futbol text-secondary mr-1"></i> Thể thao</a>
                </div>
            </div>
        </div>
        <!-- Banner quảng cáo sản phẩm hot -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="hot-banner-modern shadow-lg rounded-lg p-0 h-100 position-relative overflow-hidden d-flex align-items-center justify-content-center" style="background: linear-gradient(90deg, #f7971e 0%, #ffd200 100%); min-height: 220px;">
                <img src="clients/assets/img/hotbook_banner.png" alt="Hot Book" class="hot-banner-img position-absolute" style="left: 0; top: 50%; transform: translateY(-50%); max-width: 180px; max-height: 160px; z-index: 1;">
                <div class="hot-banner-content position-relative pl-5" style="z-index: 2;">
                    <h3 class="text-white font-weight-bold mb-2" style="text-shadow: 0 2px 8px rgba(0,0,0,0.18); letter-spacing: 1px;">Khuyến mãi cực hot!</h3>
                    <p class="text-white mb-3" style="font-size: 1.1rem;">Sách bán chạy, ưu đãi lên đến <span class="font-weight-bold text-warning">50%</span> cho các tựa hot nhất tháng này!</p>
                    <a href="?act=search&hot=1" class="btn btn-gradient-modern px-4 py-2 font-weight-bold">Khám phá ngay <i class="fa fa-arrow-right ml-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Category/Hot Banner End -->




<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Sách Mới</span></h2>
    <div class="modern-products-grid">
        <?php
        $displayed_products = array();
        usort($sanphamnew, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        foreach ($sanphamnew as $sp):
            if (in_array($sp['id'], $displayed_products)) continue;
            $displayed_products[] = $sp['id'];
        ?>
        <div class="modern-product-card">
            <a href="?act=chitietsp&id=<?php echo $sp['id'] ?>" class="modern-product-link">
                <div class="modern-product-img-wrap">
                    <?php if (!empty($sp['sale_value'])): ?>
                        <span class="modern-sale-badge">
                            <?php
                            if ($sp['sale_value'] < 100) {
                                echo '-' . number_format($sp['sale_value'], 0) . '%';
                            } else {
                                echo '-' . number_format($sp['sale_value'], 0, ',', '.') . ' đ';
                            }
                            ?>
                        </span>
                    <?php endif; ?>
                    <img class="modern-product-img" src="<?php echo removeFirstChar($sp['image']) ?>" alt="" >
                </div>
                <div class="modern-product-info">
                    <h6 class="modern-product-title"><?php echo $sp['title'] ?></h6>
                    <div class="modern-product-prices">
                        <?php
                        $original_price = $sp['original_price'];
                        $final_price = $original_price;
                        $has_discount = false;
                        if (!empty($sp['sale_value'])) {
                            $has_discount = true;
                            if ($sp['sale_value'] < 100) {
                                $final_price -= ($original_price * $sp['sale_value'] / 100);
                            } else {
                                $final_price -= $sp['sale_value'];
                            }
                        }
                        ?>
                        <span class="modern-final-price"><?php echo number_format(max($final_price, 0), 0, ',', '.') ?> đ</span>
                        <?php if ($has_discount): ?>
                            <span class="modern-original-price"><?php echo number_format($original_price, 0, ',', '.') ?> đ</span>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach ?>
    </div>
    </div>
</div>





<!-- Offer Start -->
<div class="container-fluid offer pt-5">
    <div class="row px-xl-5">
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                <img src="clients/assets/img/bongda.webp"  alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">Giảm 20% cho các sản phẩm</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Thể Loại : Thể Thao </h1>
                    <a href="?act=search&category_id=6" class="btn btn-outline-primary py-md-2 px-md-3">Mua Ngay</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                <img src="clients/assets/img/tinhcam.jpg"  alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">Giảm 20% cho các sản phẩm</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Thể Loại : Tình Cảm </h1>
                    <a href="?act=search&category_id=1" class="btn btn-outline-primary py-md-2 px-md-3">Mua Ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Products Start --> 
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Sách Siêu Ưu Đãi</span></h2>
    </div>
    <div class="modern-products-grid">
        <?php
        $displayed_products = array();
        foreach ($sanphams_sale as $spsale):
            if (in_array($spsale['id'], $displayed_products)) continue;
            $displayed_products[] = $spsale['id'];
        ?>
        <div class="modern-product-card">
            <a href="?act=chitietsp&id=<?php echo $spsale['id'] ?>" class="modern-product-link">
                <div class="modern-product-img-wrap">
                    <?php if (!empty($spsale['sale_value'])): ?>
                        <span class="modern-sale-badge">
                            <?php
                            if ($spsale['sale_value'] < 100) {
                                echo '-' . number_format($spsale['sale_value'], 0) . '%';
                            } else {
                                echo '-' . number_format($spsale['sale_value'], 0, ',', '.') . ' đ';
                            }
                            ?>
                        </span>
                    <?php endif; ?>
                    <img class="modern-product-img" src="<?php echo removeFirstChar($spsale['image']) ?>" alt="" >
                </div>
                <div class="modern-product-info">
                    <h6 class="modern-product-title"><?php echo $spsale['title'] ?></h6>
                    <div class="modern-product-prices">
                        <?php
                        $original_price = $spsale['original_price'];
                        $final_price = $original_price;
                        $has_discount = false;
                        if (!empty($spsale['sale_value'])) {
                            $has_discount = true;
                            if ($spsale['sale_value'] < 100) {
                                $final_price -= ($original_price * $spsale['sale_value'] / 100);
                            } else {
                                $final_price -= $spsale['sale_value'];
                            }
                        }
                        ?>
                        <span class="modern-final-price"><?php echo number_format(max($final_price, 0), 0, ',', '.') ?> đ</span>
                        <?php if ($has_discount): ?>
                            <span class="modern-original-price"><?php echo number_format($original_price, 0, ',', '.') ?> đ</span>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach ?>
    </div>
    </div>
</div>








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
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap');

body, html {
    font-family: 'Montserrat', Arial, sans-serif;
}

/* Thanh điều hướng (giả định class .navbar) */
.navbar, .navbar-nav, .navbar-brand, .nav-link {
    font-size: 1.18rem !important;
    font-weight: 700;
    letter-spacing: 0.5px;
}
.navbar {
    background: linear-gradient(90deg, #2980b9, #6dd5fa);
    box-shadow: 0 2px 12px rgba(41,128,185,0.08);
}
.navbar-brand {
    font-size: 1.5rem !important;
    color: #fff !important;
    text-shadow: 1px 2px 8px rgba(41,128,185,0.12);
}
.nav-link.active, .nav-link:hover {
    color: #f1c40f !important;
    text-shadow: 0 2px 8px rgba(241,196,15,0.12);
}

/* Banner nổi bật */

/* Banner nổi bật */
.container-fluid.offer {
    border-radius: 18px;
    box-shadow: 0 6px 32px rgba(52,152,219,0.13);
    background: linear-gradient(90deg, #f7f9fa 60%, #eaf6fb 100%);
    margin-bottom: 32px;
    padding: 0 0 0 0;
    max-width: 1400px;
    margin-left: auto;
    margin-right: auto;
}
.offer .position-relative {
    border-radius: 16px;
    overflow: visible;
    box-shadow: 0 2px 16px rgba(52,152,219,0.10);
    background: linear-gradient(120deg, #6dd5fa 0%, #2980b9 100%);
    min-height: 260px;
    display: flex;
    align-items: center;
    position: relative;
}
.offer img {
    border-radius: 12px;
    max-height: 180px;
    object-fit: cover;
    box-shadow: 0 2px 12px rgba(41,128,185,0.10);
    margin-bottom: 12px;
    margin-top: 12px;
    max-width: 90%;
    z-index: 1;
    position: relative;
}
.offer .position-relative > img {
    position: absolute;
    left: 24px;
    top: 50%;
    transform: translateY(-50%);
    max-width: 220px;
    max-height: 160px;
    margin: 0;
    z-index: 1;
}
.offer .position-relative > .position-relative {
    position: relative;
    left: 240px;
    top: 0;
    z-index: 2;
    width: calc(100% - 260px);
    padding-left: 24px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
}
.offer h1, .offer h5 {
    color: #fff !important;
    text-shadow: 0 2px 8px rgba(41,128,185,0.18);
}
.offer .btn {
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 8px;
    padding: 8px 28px;
    background: #fff;
    color: #2980b9;
    border: 2px solid #2980b9;
    transition: background 0.2s, color 0.2s;
}
.offer .btn:hover {
    background: #2980b9;
    color: #fff;
    border-color: #f1c40f;
}


/* Nút danh mục nổi bật */
.btn-category {
    background: linear-gradient(90deg, #f7971e, #ffd200);
    color: #fff;
    font-weight: 700;
    font-size: 1.08rem;
    border-radius: 12px;
    padding: 10px 28px;
    margin: 8px 8px 8px 0;
    box-shadow: 0 2px 8px rgba(241,196,15,0.13);
    border: none;
    transition: background 0.2s, color 0.2s, box-shadow 0.2s, transform 0.2s;
    display: flex;
    align-items: center;
    gap: 6px;
}
.btn-category:hover {
    background: linear-gradient(90deg, #ffd200, #f7971e);
    color: #fff;
    box-shadow: 0 4px 16px rgba(241,196,15,0.18);
    transform: translateY(-2px) scale(1.04);
}

/* Banner quảng cáo hot book */
.hot-banner-modern {
    background: linear-gradient(90deg, #f7971e 0%, #ffd200 100%);
    border-radius: 18px;
    min-height: 220px;
    box-shadow: 0 4px 24px rgba(241,196,15,0.13);
    position: relative;
    overflow: hidden;
}
.hot-banner-img {
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    max-width: 180px;
    max-height: 160px;
    z-index: 1;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(241,196,15,0.10);
}
.hot-banner-content {
    position: relative;
    z-index: 2;
    padding-left: 200px;
}
.hot-banner-modern .btn-gradient-modern {
    background: linear-gradient(90deg, #e74c3c 0%, #e67e22 100%);
    color: #fff;
    font-weight: 700;
    border-radius: 12px;
    border: none;
    box-shadow: 0 2px 8px rgba(231,76,60,0.12);
    transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
}
.hot-banner-modern .btn-gradient-modern:hover {
    background: linear-gradient(90deg, #e67e22 0%, #e74c3c 100%);
    box-shadow: 0 4px 16px rgba(231,76,60,0.18);
    transform: translateY(-2px) scale(1.04);
}

/* Modern Product Grid for Hot Books & Sale */
.modern-products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 32px 24px;
    margin: 0 auto 40px auto;
    padding: 0 10px;
    width: 100%;
    max-width: 1400px;
    min-width: 0;
    box-sizing: border-box;
}
.modern-product-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: box-shadow 0.3s, transform 0.3s;
    position: relative;
    display: flex;
    flex-direction: column;
    min-height: 370px;
}
.modern-product-card:hover {
    box-shadow: 0 8px 32px rgba(52,152,219,0.18);
    transform: translateY(-6px) scale(1.03);
    z-index: 2;
}
.modern-product-link {
    color: inherit;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    height: 100%;
}
.modern-product-img-wrap {
    position: relative;
    width: 100%;
    background: #f7f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 180px;
    padding: 18px 0 10px 0;
}
.modern-product-img {
    width: 140px;
    height: 180px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    background: #fff;
    transition: transform 0.25s;
}
.modern-product-card:hover .modern-product-img {
    transform: scale(1.07) rotate(-2deg);
}
.modern-sale-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: linear-gradient(90deg, #e74c3c, #e67e22);
    color: #fff;
    font-size: 1.08rem;
    font-weight: 700;
    padding: 5px 16px;
    border-radius: 14px;
    box-shadow: 0 2px 8px rgba(231,76,60,0.12);
    z-index: 2;
    letter-spacing: 1px;
}
.modern-product-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 16px 12px 10px 12px;
}
.modern-product-title {
    font-size: 1.13rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
    text-align: center;
    min-height: 44px;
    line-height: 1.3;
}
.modern-product-prices {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 8px;
}
.modern-final-price {
    color: #e74c3c;
    font-size: 1.22rem;
    font-weight: 800;
    letter-spacing: 0.5px;
}
.modern-original-price {
    color: #b2bec3;
    font-size: 1.08rem;
    text-decoration: line-through;
    font-weight: 600;
}
@media (max-width: 900px) {
    .modern-products-grid {
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    }
    .modern-product-img {
        width: 110px;
        height: 140px;
    }
}
@media (max-width: 600px) {
    .modern-products-grid {
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 18px 8px;
    }
    .modern-product-img {
        width: 80px;
        height: 100px;
    }
    .modern-product-title {
        font-size: 0.98rem;
        min-height: 32px;
    }
}
</style>

   
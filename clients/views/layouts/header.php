<?php ob_start();?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="" sizes="16x16" href="clients/assets/logo/logo.png">
    <title>BooksTower</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="assets/logo/logo.png">
    <link rel="shortcut icon" href="assets/logo/logo.png">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="./clients/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="./clients/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./clients/assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">



</head>

<body>
    <!-- Modern Topbar Start -->
    <div class="header-modern-container container-fluid px-0">
        <div class="header-modern-topbar d-flex justify-content-between align-items-center px-xl-5 py-2">
            <div class="d-flex align-items-center gap-3">
                <a class="header-support-link text-primary font-weight-bold mr-3" href="#"><i class="fa fa-headset mr-1"></i> Hỗ trợ 24/7</a>
                <span class="header-hotline d-none d-md-inline text-dark"><i class="fa fa-phone-alt mr-1"></i> 1900 1234</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a class="header-social-link" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="header-social-link" href="#"><i class="fab fa-twitter"></i></a>
                <a class="header-social-link" href="#"><i class="fab fa-linkedin-in"></i></a>
                <a class="header-social-link" href="#"><i class="fab fa-instagram"></i></a>
                <a class="header-social-link" href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <div class="header-modern-mainbar row align-items-center py-3 px-xl-5 mx-0">
            <div class="col-lg-3 col-12 text-center text-lg-left mb-2 mb-lg-0">
                <a href="./" class="header-logo-link d-inline-flex align-items-center">
                    <img src="clients/assets/logo/logo.png" alt="Logo" class="header-logo-img mr-2" style="height: 64px;">
                    <span class="header-logo-text font-weight-bold text-primary" style="font-size: 2rem; letter-spacing: 1px;">BooksTower</span>
                </a>
            </div>
            <div class="col-lg-6 col-12 mb-2 mb-lg-0">
                <form action="index.php" method="GET" class="header-search-form d-flex">
                    <input type="hidden" name="act" value="search">
                    <div class="input-group header-search-group">
                        <input type="text" name="keyword" class="form-control header-search-input" placeholder="Tìm kiếm sách, tác giả, thể loại..." value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>" required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-gradient-modern header-search-btn"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-12 text-center text-lg-right">
                <a href="#" class="btn btn-modern-icon mr-2" title="Thông báo">
                    <i class="fas fa-bell"></i>
                </a>
                <a href="?act=view-shopping-cart" class="btn btn-modern-icon" title="Giỏ hàng">
                    <i class="fas fa-shopping-cart text-primary"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Modern Topbar End -->

    <style>
        .header-modern-container {
            background: linear-gradient(90deg, #f7f9fa 60%, #eaf6fb 100%);
            box-shadow: 0 2px 12px rgba(41,128,185,0.08);
            border-bottom-left-radius: 18px;
            border-bottom-right-radius: 18px;
        }
        .header-modern-topbar {
            background: linear-gradient(90deg, #2980b9, #6dd5fa);
            color: #fff;
            font-size: 1.08rem;
            font-weight: 600;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
        }
        .header-support-link {
            color: #fff !important;
            font-size: 1.08rem;
            transition: color 0.2s;
        }
        .header-support-link:hover { color: #f1c40f !important; }
        .header-hotline { color: #fff; font-size: 1.08rem; }
        .header-social-link {
            color: #fff;
            font-size: 1.15rem;
            margin-left: 10px;
            transition: color 0.2s, transform 0.2s;
        }
        .header-social-link:hover {
            color: #f1c40f;
            transform: scale(1.15);
        }
        .header-modern-mainbar {
            background: transparent;
        }
        .header-logo-link {
            text-decoration: none;
        }
        .header-logo-img {
            height: 64px;
            width: auto;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(41,128,185,0.10);
        }
        .header-logo-text {
            font-family: 'Montserrat', Arial, sans-serif;
            font-size: 2rem;
            color: #2980b9;
            letter-spacing: 1px;
        }
        .header-search-form {
            width: 100%;
        }
        .header-search-group {
            width: 100%;
        }
        .header-search-input {
            border-radius: 12px 0 0 12px;
            border: 2px solid #6dd5fa;
            font-size: 1.08rem;
            padding: 10px 16px;
            background: #fff;
            font-family: 'Montserrat', Arial, sans-serif;
        }
        .header-search-btn {
            border-radius: 0 12px 12px 0;
            background: linear-gradient(90deg, #2980b9, #6dd5fa);
            color: #fff;
            font-weight: 700;
            border: none;
            transition: background 0.2s, color 0.2s;
        }
        .header-search-btn:hover {
            background: linear-gradient(90deg, #6dd5fa, #2980b9);
            color: #f1c40f;
        }
        .btn-modern-icon {
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(41,128,185,0.10);
            color: #2980b9;
            font-size: 1.25rem;
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 4px;
            transition: background 0.2s, color 0.2s, transform 0.2s;
        }
        .btn-modern-icon:hover {
            background: #2980b9;
            color: #fff;
            transform: scale(1.08);
        }
        @media (max-width: 991.98px) {
            .header-logo-text { font-size: 1.3rem; }
            .header-logo-img { height: 44px; }
            .header-modern-mainbar { padding: 1rem 0.5rem; }
        }
        @media (max-width: 767.98px) {
            .header-modern-topbar, .header-modern-mainbar { padding-left: 10px !important; padding-right: 10px !important; }
            .header-logo-img { height: 36px; }
            .header-logo-text { font-size: 1.1rem; }
            .header-search-input { font-size: 0.98rem; padding: 7px 10px; }
            .btn-modern-icon { width: 36px; height: 36px; font-size: 1rem; }
        }
    </style>


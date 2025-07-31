<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PetLand</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="clients/assets/css/thongtin.css">
  <style>
    .hidden {
      display: none;
    }

    .profile-detail {
      background-color: #f8f9fa;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .profile-detail h4 {
      color: #343a40;
      border-bottom: 1px solid #dee2e6;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .info-item {
      margin-bottom: 15px;
    }

    .info-label {
      font-weight: 600;
      color: #495057;
    }

    .info-value {
      color: #212529;
    }

    .edit-btn {
      margin-top: 20px;
    }

    .avatar-container {
      position: relative;
      display: inline-block;
    }

    .avatar-upload {
      position: absolute;
      bottom: 0;
      right: 0;
      background: #fff;
      border-radius: 50%;
      padding: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    body {
      background: linear-gradient(to right, #e0eafc, #cfdef3);
      font-family: 'Segoe UI', sans-serif;
    }

    .container {
      background-color: #ffffff;
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-top: 30px;
    }

    .list-group .list-group-item {
      border: none;
      border-radius: 10px;
      margin-bottom: 10px;
      transition: all 0.3s ease;
    }

    .list-group .list-group-item:hover {
      background-color: #007bff;
      color: white;
      transform: translateX(3px);
    }

    .list-group .list-group-item.active {
      background-color: #007bff;
      color: white;
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(0, 123, 255, 0.2);
    }

    .profile-section {
      background: linear-gradient(135deg, #007bff, #00c6ff);
      border-radius: 15px;
      color: white;
    }

    .profile-section h5 {
      margin-top: 10px;
      font-weight: bold;
    }

    .profile-detail {
      background-color: #ffffff;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .profile-detail h4 {
      font-weight: 700;
      color: #007bff;
      border-bottom: 2px solid #007bff;
      padding-bottom: 10px;
      margin-bottom: 30px;
    }

    .info-item {
      margin-bottom: 20px;
    }

    .info-label {
      font-weight: 600;
      color: #555;
      font-size: 15px;
    }

    .info-value {
      font-size: 16px;
      color: #222;
    }

    .edit-btn a {
      background: linear-gradient(to right, #007bff, #00c6ff);
      border: none;
      padding: 10px 25px;
      border-radius: 30px;
      font-weight: 500;
      color: white;
      transition: 0.3s ease;
    }

    .edit-btn a:hover {
      background: linear-gradient(to right, #0056b3, #00a1e6);
      transform: scale(1.05);
      text-decoration: none;
      color: white;
    }

    .avatar-container {
      position: relative;
      display: inline-block;
    }

    .avatar-container img {
      border: 3px solid white;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease;
    }

    .avatar-container img:hover {
      transform: scale(1.05);
    }

    .avatar-upload {
      position: absolute;
      bottom: 0;
      right: 0;
      background: #fff;
      border-radius: 50%;
      padding: 6px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .avatar-upload i {
      color: #007bff;
    }

    /* Hiệu ứng chuyển đổi section */
    .hidden {
      display: none;
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    .profile-detail.show {
      opacity: 1;
    }
  </style>
</head>

<body>
  <!-- Main Container -->
  <div class="container text-center py-4">
    <h2 class="text-primary font-weight-bold">Chào mừng bạn đến với BooksTower! 📚</h2>
    <p class="text-muted">Quản lý thông tin cá nhân, đơn hàng và tài khoản của bạn tại đây.</p>
  </div>

  <div class="container my-4">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-3 mb-4 mb-md-0">
        <div class="list-group">
          <div class="profile-section p-3 border-bottom text-center">
            <!-- Avatar và tên người dùng -->
            <div class="avatar-container">
              <img src="<?php echo htmlspecialchars($_SESSION['user']['avatar'] ?? './uploads/user/default.jpg'); ?>"
                alt="Avatar" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
              <a href="?act=edit-profile" class="avatar-upload" title="Đổi ảnh đại diện">
                <i class="fas fa-camera text-primary" style="font-size: 14px;"></i>
              </a>
            </div>
            <h5 class="fw-bold mt-2">
              <?php
              if (isset($_SESSION['user']['name'])) {
                echo htmlspecialchars($_SESSION['user']['name']);
              } else {
                echo 'Người dùng';
              }
              ?>
            </h5>

          </div>
          <a href="#profile" class="list-group-item list-group-item-action active" onclick="showSection('profile')">
            <i class="fas fa-user-circle mr-2"></i>Thông tin cá nhân
          </a>
          <a href="?act=don-hang" class="list-group-item list-group-item-action" onclick="showSection('orders')">
            <i class="fas fa-clipboard-list mr-2"></i>Đơn hàng của tôi
          </a>
          <a href="?act=change-password" class="list-group-item list-group-item-action">
            <i class="fas fa-key mr-2"></i>Đổi mật khẩu
          </a>
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-md-9">
        <!-- Profile Section -->
        <div id="profile-section" class="profile-detail">
          <h4><i class="fas fa-user mr-2"></i>Thông tin cá nhân</h4>

          <div class="row">
            <div class="col-md-6">
              <div class="info-item">
                <div class="info-label">Họ và tên:</div>
                <div class="info-value">
                  <?php echo isset($_SESSION['user']['name']) ? htmlspecialchars($_SESSION['user']['name']) : 'Chưa cập nhật'; ?>
                </div>
              </div>

              <div class="info-item">
                <div class="info-label">Email:</div>
                <div class="info-value">
                  <?php echo isset($_SESSION['user']['email']) ? htmlspecialchars($_SESSION['user']['email']) : 'Chưa cập nhật'; ?>
                </div>
              </div>

              <div class="info-item">
                <div class="info-label">Số điện thoại:</div>
                <div class="info-value">
                  <?php echo isset($_SESSION['user']['phone']) ? htmlspecialchars($_SESSION['user']['phone']) : 'Chưa cập nhật'; ?>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="info-item">
                <div class="info-label">Giới tính:</div>
                <div class="info-value">
                  <?php
                  if (isset($_SESSION['user']['gender'])) {
                    echo $_SESSION['user']['gender'] == 1 ? 'Nam' : ($_SESSION['user']['gender'] == 2 ? 'Nữ' : 'Khác');
                  } else {
                    echo 'Chưa cập nhật';
                  }
                  ?>
                </div>
              </div>

              <div class="info-item">
                <div class="info-label">Ngày sinh:</div>
                <div class="info-value">
                  <?php echo isset($_SESSION['user']['birthday']) ? date('d/m/Y', strtotime($_SESSION['user']['birthday'])) : 'Chưa cập nhật'; ?>
                </div>
              </div>

              <div class="info-item">
                <div class="info-label">Địa chỉ:</div>
                <div class="info-value">
                  <?php echo isset($_SESSION['user']['address']) ? htmlspecialchars($_SESSION['user']['address']) : 'Chưa cập nhật'; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="text-right edit-btn">
            <a href="?act=edit-profile" class="btn btn-primary">
              <i class="fas fa-edit mr-2"></i>Chỉnh sửa thông tin
            </a>
          </div>
        </div>

        <!-- Orders Section (hidden by default) -->
        <div id="orders-section" class="hidden">
          <!-- Nội dung đơn hàng sẽ được thêm ở đây -->
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function showSection(sectionId) {
      // Ẩn tất cả các section
      document.getElementById('profile-section').classList.add('hidden');
      document.getElementById('orders-section').classList.add('hidden');

      // Hiển thị section được chọn
      document.getElementById(sectionId + '-section').classList.remove('hidden');

      // Cập nhật active state cho menu
      document.querySelectorAll('.list-group-item').forEach(item => {
        item.classList.remove('active');
      });
      event.currentTarget.classList.add('active');
    }

    // Mặc định hiển thị profile section khi trang tải
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('profile-section').classList.remove('hidden');
    });
  </script>
</body>

</html>
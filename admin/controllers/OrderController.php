<?php
class OrderController{
    private $modelOrder;
    private $modelUser;

    public function __construct(){
        $this->modelOrder = new Order();
        $this->modelUser = new User();
    }

    public function views_order() {
        $orders = $this->modelOrder->getAll();
        require_once './views/order/listdonhang.php';
    }

    public function views_edit_order() {
        $order = $this->modelOrder->getById($_GET['id']);
        require_once './views/order/editorder.php';
    }

    public function views_post_edit_order() {
        if (isset($_POST)) {
            $data = [
                ':id' => $_POST['id'],
                ':payment_status' => $_POST['payment_status'],
                ':shipping_status' => $_POST['shipping_status']
            ];

            try {
                $this->validateOrderUpdate($data);
                if ($this->modelOrder->updateOrder($data)) {
                    $_SESSION['success'] = "Cập nhật đơn hàng thành công";
                } else {
                    $_SESSION['error'] = "Cập nhật đơn hàng thất bại";
                }
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
            }
        }
        header('Location: ?act=order');
        exit;
    }

    // Kiểm tra trạng thái đơn hàng và điều kiện chuyển đổi
    private function validateOrderUpdate($data) {
        $currentOrder = $this->modelOrder->getById($data[':id']);

        
        $validShippingTransitions = [
            'processing' => ['delivering'],   // Đang xử lý → Đang giao
            'delivering' => ['delivered'],    // Đang giao → Đã giao
            'delivered'  => ['returned'],     // Đã giao → Trả hàng
            'returned'   => [],               // Trả hàng → Kết thúc
            'cancelled'  => []                 // Hủy → Kết thúc
        ];

        if ($data[':shipping_status'] !== $currentOrder['shipping_status']) {
            if (!isset($validShippingTransitions[$currentOrder['shipping_status']])) {
                throw new Exception("Trạng thái vận chuyển hiện tại không hợp lệ: {$currentOrder['shipping_status']}");
            }
            $allowedNextShipping = $validShippingTransitions[$currentOrder['shipping_status']];
            if (!in_array($data[':shipping_status'], $allowedNextShipping)) {
                throw new Exception("Không thể chuyển trạng thái vận chuyển từ {$currentOrder['shipping_status']} sang {$data[':shipping_status']}. Vui lòng cập nhật tuần tự từng bước.");
            }
        }
        // ✅ Hết phần bổ sung

        // Kiểm tra trạng thái thanh toán cho các phương thức thanh toán online
        if ($currentOrder['payment_method'] === 'CREDIT' || 
            $currentOrder['payment_method'] === 'BANKING' || 
            $currentOrder['payment_method'] === 'MOMO') {
            
            $validTransitions = [
                'unpaid' => ['processing', 'cancelled'],  
                'processing' => ['paid', 'failed', 'cancelled'],
                'failed' => ['processing'],
                'paid' => ['refunded'],
                'refunded' => [],
                'cancelled' => []
            ];
           
            // Kiểm tra chuyển đổi trạng thái thanh toán
            if ($data[':payment_status'] !== $currentOrder['payment_status']) {
                if (!isset($validTransitions[$currentOrder['payment_status']])) {
                    throw new Exception("Trạng thái hiện tại không hợp lệ: {$currentOrder['payment_status']}");
                }

                $allowedNextStatuses = $validTransitions[$currentOrder['payment_status']];
                if (!in_array($data[':payment_status'], $allowedNextStatuses)) {
                    throw new Exception("Không thể chuyển từ trạng thái {$currentOrder['payment_status']} sang {$data[':payment_status']}");
                }
            }

            // Kiểm tra điều kiện shipping_status
            if ($data[':shipping_status'] !== $currentOrder['shipping_status']) {
                if ($currentOrder['payment_status'] === 'failed' || $currentOrder['payment_status'] === 'unpaid') {
                    if ($data[':shipping_status'] !== 'cancelled') {
                        throw new Exception("Không thể thay đổi trạng thái đơn hàng khi thanh toán chưa thành công");
                    }
                }
                
                if ($currentOrder['payment_status'] !== 'paid' && 
                    $data[':shipping_status'] !== 'cancelled') {
                    throw new Exception("Trạng thái đơn hàng chỉ có thể thay đổi sau khi đã thanh toán thành công");
                }
            }
        }
        
        // Kiểm tra đơn hàng đang giao
        if ($currentOrder['shipping_status'] === 'delivering') {
            if ($data[':shipping_status'] === 'cancelled') {
                throw new Exception("Không thể hủy đơn hàng đang trong quá trình giao");
            }
        }
        
        // Xử lý COD
        if ($currentOrder['payment_method'] === 'COD') {
            if ($currentOrder['payment_status'] === 'processing') {
                $data[':payment_status'] = 'unpaid';
            }
            
            if (!in_array($data[':payment_status'], ['unpaid','paid'])) {
                throw new Exception("COD chỉ có thể có trạng thái chưa thanh toán hoặc thanh toán");
            }

            if ($data[':payment_status'] === 'paid') {
                if ($currentOrder['shipping_status'] !== 'delivered') {
                    throw new Exception("COD chỉ có thể đánh dấu đã thanh toán khi đã giao hàng thành công");
                }
            }
        }

        if (in_array($currentOrder['shipping_status'], ['returned', 'cancelled'])) {
            // Chặn thay đổi shipping_status
            if (isset($data[':shipping_status']) && $data[':shipping_status'] !== $currentOrder['shipping_status']) {
                throw new Exception("Không thể thay đổi trạng thái giao hàng của đơn hàng đã hoàn thành/hủy");
            }
        
            // Nếu đơn hàng bị hủy, payment_status phải là 'failed'
            if ($currentOrder['shipping_status'] === 'cancelled') {
                $data[':payment_status'] = 'failed'; // ép trạng thái thanh toán về thất bại
            }
        }

        // Kiểm tra đơn hàng đã giao
        if ($currentOrder['shipping_status'] === 'delivered') {
            if ($data[':shipping_status'] !== 'delivered' && 
                $data[':shipping_status'] !== 'returned') {
                throw new Exception("Đơn hàng đã giao thành công chỉ có thể chuyển sang trạng thái trả hàng");
            }
        }

        // Kiểm tra trả hàng
        if ($data[':shipping_status'] === 'returned') {
            if ($currentOrder['shipping_status'] !== 'delivered') {
                throw new Exception("Không thể trả hàng khi đơn hàng chưa giao thành công");
            }
        }
    }

    public function views_order_detail() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = "Không tìm thấy đơn hàng";
            return;
        }

        $order = $this->modelOrder->getOrderThongTinKhachHang($id);
        $detailsp = $this->modelOrder->getOrderDetailsThongTin($id);

        if (!$order || !$detailsp) {
            $_SESSION['error'] = "Không tìm thấy thông tin đơn hàng id";
            return;
        }

        require_once './views/order/chitietdh.php';
    }
}
?>

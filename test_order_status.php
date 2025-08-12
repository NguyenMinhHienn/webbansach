<?php
// File test để kiểm tra logic cập nhật trạng thái đơn hàng

// Giả lập dữ liệu đơn hàng với trạng thái pending
$testOrders = [
    [
        'id' => 1,
        'shipping_status' => 'pending',
        'payment_status' => 'processing',
        'payment_method' => 'BANKING'
    ],
    [
        'id' => 2,
        'shipping_status' => 'delivering',
        'payment_status' => 'processing',
        'payment_method' => 'BANKING'
    ],
    [
        'id' => 3,
        'shipping_status' => 'delivered',
        'payment_status' => 'paid',
        'payment_method' => 'COD'
    ]
];

// Giả lập logic validation từ OrderController
function validateOrderUpdate($currentOrder, $newData) {
    $validShippingTransitions = [
        'pending' => ['delivering', 'cancelled'],  // Chờ xử lý → Đang giao hoặc Hủy
        'delivering' => ['delivered', 'cancelled'], // Đang giao → Đã giao hoặc Hủy
        'delivered'  => ['returned'],              // Đã giao → Trả hàng
        'returned'   => [],                        // Trả hàng → Kết thúc
        'cancelled'  => []                         // Hủy → Kết thúc
    ];

    if ($newData['shipping_status'] !== $currentOrder['shipping_status']) {
        if (!isset($validShippingTransitions[$currentOrder['shipping_status']])) {
            throw new Exception("Trạng thái vận chuyển hiện tại không hợp lệ: {$currentOrder['shipping_status']}");
        }
        $allowedNextShipping = $validShippingTransitions[$currentOrder['shipping_status']];
        if (!in_array($newData['shipping_status'], $allowedNextShipping)) {
            throw new Exception("Không thể chuyển trạng thái vận chuyển từ {$currentOrder['shipping_status']} sang {$newData['shipping_status']}. Vui lòng cập nhật tuần tự từng bước.");
        }
    }
    
    return true;
}

// Test cases
$testCases = [
    [
        'description' => 'Test 1: Chuyển từ pending sang delivering (hợp lệ)',
        'currentOrder' => $testOrders[0],
        'newData' => ['shipping_status' => 'delivering', 'payment_status' => 'processing']
    ],
    [
        'description' => 'Test 2: Chuyển từ pending sang delivered (không hợp lệ - nhảy cóc)',
        'currentOrder' => $testOrders[0],
        'newData' => ['shipping_status' => 'delivered', 'payment_status' => 'paid']
    ],
    [
        'description' => 'Test 3: Chuyển từ delivering sang delivered (hợp lệ)',
        'currentOrder' => $testOrders[1],
        'newData' => ['shipping_status' => 'delivered', 'payment_status' => 'paid']
    ],
    [
        'description' => 'Test 4: Chuyển từ delivered sang returned (hợp lệ)',
        'currentOrder' => $testOrders[2],
        'newData' => ['shipping_status' => 'returned', 'payment_status' => 'refunded']
    ]
];

echo "<h2>Kết quả test logic cập nhật trạng thái đơn hàng:</h2>\n";

foreach ($testCases as $test) {
    echo "<h3>{$test['description']}</h3>\n";
    echo "Trạng thái hiện tại: {$test['currentOrder']['shipping_status']}<br>\n";
    echo "Trạng thái mới: {$test['newData']['shipping_status']}<br>\n";
    
    try {
        validateOrderUpdate($test['currentOrder'], $test['newData']);
        echo "<span style='color: green;'>✅ THÀNH CÔNG: Chuyển đổi trạng thái hợp lệ</span><br><br>\n";
    } catch (Exception $e) {
        echo "<span style='color: red;'>❌ LỖI: {$e->getMessage()}</span><br><br>\n";
    }
}

echo "<h3>Kết luận:</h3>\n";
echo "- Trạng thái 'pending' đã được thêm vào logic validation<br>\n";
echo "- Các chuyển đổi tuần tự được cho phép<br>\n";
echo "- Các chuyển đổi nhảy cóc sẽ bị chặn<br>\n";
?>

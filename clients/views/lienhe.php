<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Liên hệ với chúng tôi</span></h2>
    </div>
    <div class="row px-xl-5 justify-content-center">
        <div class="col-lg-7 mb-5">
            <div class="contact-form contact-card shadow-lg p-4 rounded-4">
                <div id="success"></div>
                <form name="sentMessage" id="contactForm" novalidate="novalidate">
                    <div class="control-group mb-3">
                        <input type="text" class="form-control form-control-lg rounded-3" id="name" placeholder="Họ và tên"
                            required="required" data-validation-required-message="Vui lòng nhập họ tên" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group mb-3">
                        <input type="email" class="form-control form-control-lg rounded-3" id="email" placeholder="Email"
                            required="required" data-validation-required-message="Vui lòng nhập email" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group mb-3">
                        <input type="text" class="form-control form-control-lg rounded-3" id="subject" placeholder="Tiêu đề"
                            required="required" data-validation-required-message="Vui lòng nhập tiêu đề" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group mb-3">
                        <textarea class="form-control form-control-lg rounded-3" rows="6" id="message" placeholder="Nội dung liên hệ"
                            required="required"
                            data-validation-required-message="Vui lòng nhập nội dung"></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-gradient px-5 py-2 rounded-pill shadow" type="submit" id="sendMessageButton">
                            <i class="fa fa-paper-plane mr-2"></i>Gửi liên hệ
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Assistant Section Start -->
        <!-- Assistant Section Start -->
        <div class="col-lg-5 mb-5">
            <div class="assistant-card shadow-lg p-4 rounded-4 h-100 d-flex flex-column justify-content-start bg-white">
                <h5 class="font-weight-bold mb-3 text-primary"><i class="fas fa-robot mr-2"></i>Trợ lý ảo BooksTower</h5>
                <p class="mb-3 text-muted">Tôi có thể giúp bạn trả lời một số câu hỏi nhanh:</p>

                <div class="question-buttons mb-3">
                    <button class="btn btn-outline-primary btn-sm w-100 text-left mb-2 animate-button" onclick="answerBot('Làm sao để đặt hàng?')">
                        <i class="fas fa-shopping-cart mr-2"></i>Làm sao để đặt hàng?
                    </button>
                    <button class="btn btn-outline-primary btn-sm w-100 text-left mb-2 animate-button" onclick="answerBot('Chính sách đổi trả là gì?')">
                        <i class="fas fa-exchange-alt mr-2"></i>Chính sách đổi trả là gì?
                    </button>
                    <button class="btn btn-outline-primary btn-sm w-100 text-left mb-2 animate-button" onclick="answerBot('Thời gian giao hàng bao lâu?')">
                        <i class="fas fa-clock mr-2"></i>Thời gian giao hàng?
                    </button>
                </div>

                <div class="form-group mb-2">
                    <label for="userQuestion" class="font-weight-bold text-secondary mb-1">Hoặc nhập câu hỏi của bạn:</label>
                    <textarea id="userQuestion" rows="2" class="form-control form-control-sm rounded-3 mb-2" placeholder="Ví dụ: Tôi muốn huỷ đơn hàng..."></textarea>
                    <button class="btn btn-gradient btn-sm px-4 py-2 rounded-pill shadow" onclick="handleQuestion()">
                        <i class="fas fa-paper-plane mr-1"></i>Gửi câu hỏi
                    </button>
                </div>

                <div id="botAnswer" class="mt-3 alert alert-info d-none animate__animated animate__fadeIn"></div>
            </div>
        </div>
        <!-- Assistant Section End -->

        <!-- Assistant Section End -->

    </div>
</div>
<!-- Contact End -->

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap');

    body,
    html {
        font-family: 'Montserrat', Arial, sans-serif;
    }

    .contact-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(52, 152, 219, 0.10);
        border: 1.5px solid #eaf6fb;
        transition: box-shadow 0.2s, border 0.2s;
    }

    .contact-card:focus-within,
    .contact-card:hover {
        box-shadow: 0 8px 32px rgba(52, 152, 219, 0.18);
        border-color: #6dd5fa;
    }

    .contact-form input,
    .contact-form textarea {
        border-radius: 10px;
        border: 1.5px solid #b2bec3;
        font-size: 1.08rem;
        padding: 12px 16px;
        margin-bottom: 8px;
        transition: border 0.2s, box-shadow 0.2s;
    }

    .contact-form input:focus,
    .contact-form textarea:focus {
        border-color: #2980b9;
        box-shadow: 0 2px 8px rgba(52, 152, 219, 0.10);
    }

    .btn-gradient {
        background: linear-gradient(90deg, #2980b9, #6dd5fa);
        color: #fff;
        font-weight: 700;
        font-size: 1.13rem;
        border: none;
        box-shadow: 0 2px 8px rgba(52, 152, 219, 0.10);
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    }

    .btn-gradient:hover {
        background: linear-gradient(90deg, #6dd5fa, #2980b9);
        color: #fff;
        box-shadow: 0 4px 16px rgba(52, 152, 219, 0.18);
    }

    .contact-info-card {
        background: #f7f9fa;
        border-radius: 18px;
        border: 1.5px solid #eaf6fb;
        box-shadow: 0 4px 24px rgba(52, 152, 219, 0.10);
        transition: box-shadow 0.2s, border 0.2s;
    }

    .contact-info-card:hover {
        box-shadow: 0 8px 32px rgba(52, 152, 219, 0.18);
        border-color: #6dd5fa;
    }

    .contact-info-card h5,
    .contact-info-card h6 {
        color: #2980b9;
        font-weight: 700;
    }

    .contact-info-card .btn-outline-primary,
    .contact-info-card .btn-outline-danger,
    .contact-info-card .btn-outline-info {
        border-radius: 50%;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        border-width: 2px;
        margin-right: 6px;
        margin-bottom: 0;
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    }

    .contact-info-card .btn-outline-primary:hover {
        background: #2980b9;
        color: #fff;
    }

    .contact-info-card .btn-outline-danger:hover {
        background: #e74c3c;
        color: #fff;
    }

    .contact-info-card .btn-outline-info:hover {
        background: #6dd5fa;
        color: #fff;
    }
</style>

<script>
    function answerBot(question) {
        let answer = '';
        switch (question) {
            case 'Làm sao để đặt hàng?':
                answer = '🛒 Bạn có thể đặt hàng bằng cách chọn sản phẩm và nhấn nút "Thêm vào giỏ hàng", sau đó vào giỏ để thanh toán.';
                break;
            case 'Chính sách đổi trả là gì?':
                answer = '🔁 Bạn có thể đổi trả sản phẩm trong vòng 7 ngày nếu sản phẩm lỗi hoặc không đúng mô tả.';
                break;
            case 'Thời gian giao hàng bao lâu?':
                answer = '⏰ Thời gian giao hàng từ 2-5 ngày làm việc tùy vào khu vực.';
                break;
            default:
                answer = '🤖 Xin lỗi, tôi chưa có câu trả lời cho câu hỏi này.';
        }
        const botAnswerEl = document.getElementById('botAnswer');
        botAnswerEl.innerText = answer;
        botAnswerEl.classList.remove('d-none');
        botAnswerEl.classList.add('animate__fadeIn');
    }

    function handleQuestion() {
        const input = document.getElementById('userQuestion').value.trim();
        if (input) {
            answerBot(input);
        } else {
            const botAnswerEl = document.getElementById('botAnswer');
            botAnswerEl.innerText = '❗ Vui lòng nhập câu hỏi trước.';
            botAnswerEl.classList.remove('d-none');
            botAnswerEl.classList.add('animate__fadeIn');
        }
    }
</script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<style>
    .assistant-card {
        border: 1.5px solid #eaf6fb;
        border-radius: 18px;
        background: #fefefe;
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .assistant-card:hover {
        box-shadow: 0 8px 32px rgba(52, 152, 219, 0.18);
        transform: translateY(-3px);
    }

    .question-buttons .btn {
        transition: all 0.3s ease;
    }

    .question-buttons .btn:hover {
        background-color: #2980b9;
        color: #fff;
        transform: scale(1.02);
    }

    #botAnswer {
        font-size: 0.95rem;
        border-radius: 10px;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }
</style>
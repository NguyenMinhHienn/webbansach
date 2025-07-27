



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
        <div class="col-lg-5 mb-5">
            <div class="contact-info-card shadow-lg p-4 rounded-4 h-100 d-flex flex-column justify-content-center">
                <h5 class="font-weight-bold mb-3 text-primary">Thông tin liên hệ</h5>
                <p class="mb-4">Nếu bạn có bất kỳ thắc mắc hoặc cần hỗ trợ, hãy liên hệ với chúng tôi qua thông tin dưới đây hoặc gửi biểu mẫu bên cạnh.</p>
                <div class="d-flex flex-column mb-3">
                    <h6 class="font-weight-bold mb-2"><i class="fa fa-map-marker-alt text-primary mr-2"></i>Địa chỉ:</h6>
                    <span class="mb-2">123 Đường ABC, Quận 1, TP.HCM</span>
                </div>
                <div class="d-flex flex-column mb-3">
                    <h6 class="font-weight-bold mb-2"><i class="fa fa-envelope text-primary mr-2"></i>Email:</h6>
                    <span class="mb-2">info@example.com</span>
                </div>
                <div class="d-flex flex-column mb-3">
                    <h6 class="font-weight-bold mb-2"><i class="fa fa-phone-alt text-primary mr-2"></i>Hotline:</h6>
                    <span class="mb-2">+84 123 456 789</span>
                </div>
                <div class="d-flex flex-row gap-2 mt-3">
                    <a href="#" class="btn btn-sm btn-outline-primary rounded-circle mx-1"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-sm btn-outline-danger rounded-circle mx-1"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="btn btn-sm btn-outline-info rounded-circle mx-1"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap');
body, html { font-family: 'Montserrat', Arial, sans-serif; }

.contact-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(52,152,219,0.10);
    border: 1.5px solid #eaf6fb;
    transition: box-shadow 0.2s, border 0.2s;
}
.contact-card:focus-within, .contact-card:hover {
    box-shadow: 0 8px 32px rgba(52,152,219,0.18);
    border-color: #6dd5fa;
}
.contact-form input, .contact-form textarea {
    border-radius: 10px;
    border: 1.5px solid #b2bec3;
    font-size: 1.08rem;
    padding: 12px 16px;
    margin-bottom: 8px;
    transition: border 0.2s, box-shadow 0.2s;
}
.contact-form input:focus, .contact-form textarea:focus {
    border-color: #2980b9;
    box-shadow: 0 2px 8px rgba(52,152,219,0.10);
}
.btn-gradient {
    background: linear-gradient(90deg, #2980b9, #6dd5fa);
    color: #fff;
    font-weight: 700;
    font-size: 1.13rem;
    border: none;
    box-shadow: 0 2px 8px rgba(52,152,219,0.10);
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
}
.btn-gradient:hover {
    background: linear-gradient(90deg, #6dd5fa, #2980b9);
    color: #fff;
    box-shadow: 0 4px 16px rgba(52,152,219,0.18);
}
.contact-info-card {
    background: #f7f9fa;
    border-radius: 18px;
    border: 1.5px solid #eaf6fb;
    box-shadow: 0 4px 24px rgba(52,152,219,0.10);
    transition: box-shadow 0.2s, border 0.2s;
}
.contact-info-card:hover {
    box-shadow: 0 8px 32px rgba(52,152,219,0.18);
    border-color: #6dd5fa;
}
.contact-info-card h5, .contact-info-card h6 {
    color: #2980b9;
    font-weight: 700;
}
.contact-info-card .btn-outline-primary, .contact-info-card .btn-outline-danger, .contact-info-card .btn-outline-info {
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


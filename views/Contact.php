<?php
require_once './views/layout/header.php';
require_once './views/layout/navbar.php';
?>

<style>
    /* General Styles for Contact Section */
    .contact__self,
    .contact__regist {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .contact__self h3,
    .contact__regist h3 {
        font-size: 20px;
        color: #333;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .contact__self p,
    .contact__regist p {
        font-size: 14px;
        color: #555;
        line-height: 1.6;
    }

    .contact__self-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .contact__self-item {
        margin-bottom: 10px;
    }

    .contact__self-link {
        text-decoration: none;
        font-size: 14px;
        color: #007BFF;
        transition: color 0.3s ease;
    }

    .contact__self-link:hover {
        color: #0056b3;
    }

    /* Registration Form */
    .contact__regist form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .contact__regist form input,
    .contact__regist form textarea {
        width: 100%;
        padding: 10px 15px;
        font-size: 14px;
        color: #333;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .contact__regist form input:focus,
    .contact__regist form textarea:focus {
        border-color: #007BFF;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        outline: none;
    }

    .contact__regist form textarea {
        resize: none;
        height: 100px;
    }

    .contact__regist form button {
        padding: 10px 15px;
        font-size: 14px;
        font-weight: bold;
        color: #fff;
        background-color: #007BFF;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .contact__regist form button:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Responsive Design */
    @media (max-width: 768px) {

        .contact__self,
        .contact__regist {
            margin-bottom: 20px;
        }

        .contact__regist form textarea {
            height: 80px;
        }
    }
</style>
<!-- score-top-->

<button onclick="topFunction()" id="myBtn-scroll" title="Go to top"><i class="fas fa-chevron-down"></i></button>
<!-- contact -->
<section class="contact">
    <div class="container">
        <div class="row mt-4 mb-50 pc">
            <div class="col-12 contact__map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8969921702765!2d105.76491950710259!3d21.036807215564114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454bbe135a505%3A0x152cff27eb8815ee!2zxJDGoW4gbmd1ecOqbiA1IGvDvSB0w7pjIHjDoSBN4bu5IMSQw6xuaA!5e0!3m2!1svi!2s!4v1592705439737!5m2!1svi!2s" width="1100" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>

        <div class="row mt-4 mb-4">
            <div class="col-lg-6 col-md-6 col-sm-12 contact__self">
                <h3 class="mb-4">
                    Liên hệ với chúng tôi
                </h3>
                <p>
                    Để không ngừng nâng cao chất lượng dịch vụ và đáp ứng tốt hơn nữa các yêu cầu sử dụng sách của Quý khách, chúng tôi mong muốn nhận được các thông tin phản hồi. Nếu Quý khách có bất kỳ thắc mắc hoặc đóng góp nào, xin vui lòng liên hệ với chúng tôi theo thông tin dưới đây. Chúng tôi sẽ phản hồi lại Quý khách trong thời gian sớm nhất.
                </p>
                <h3 class="mt-4 mb-4">
                    Thông tin liên hệ
                </h3>

                <ul class="contact__self-list">
                    <li class="contact__self-item">
                        <a class="contact__self-link" href="#">EduBook.com</a>
                    </li>
                    <li class="contact__self-item">
                        <a class="contact__self-link" href="#">SĐT: 0393.078.242</a>
                    </li>
                    <li class="contact__self-item">
                        <a class="contact__self-link" href="#">Email: EduBook2001@gmail.com</a>
                    </li>
                    <li class="contact__self-item">
                        <a class="contact__self-link" href="#">Địa chỉ: Số 3A, Tạ Quang Bử, Hai Bà Trưng, Hà Nội</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 contact__regist">
                <h3 class="mb-4">
                    Đăng ký tư vấn miễn phí
                </h3>

                <p>Quý khách vui lòng để lại thông tin để nhân viên tư vấn điện lại cho bạn sớm nhất!</p>

                <form>
                    <input type="text" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Họ tên của bạn...">

                    <input type="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email của bạn...">

                    <input type="number" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Số điện thoại...">

                    <textarea name="" id="" cols="200" rows="15" placeholder="Nội dung cần tư vấn..."></textarea>
                    <button type="submit">Gửi liên hệ</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
require_once './views/layout/footer.php';
?>
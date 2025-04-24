<!DOCTYPE html>
<html lang="vi">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <meta charset="UTF-8">
    <title>Trang Trại Nhà Mộc</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('build/assets/css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body>
    @include('banner')
    <div class="container-fluid d-flex flex-lg-row flex-column gap-4 align-items-start">


        <!-- Menu desktop -->
        <div class="menu-sidebar d-none d-lg-block">
            <h4>Menu</h4>
            <div class="category-nav">
                @foreach ($categories as $category)
                    <a href="#{{ $category->id }}"
                        class="{{ isset($currentCategory) && $currentCategory->id == $category->id ? 'active' : '' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Menu mobile -->
        <div class="menu-mobile-grid d-block d-lg-none sticky-mobile-menu">
            <div class="category-grid">
                @foreach ($categories as $category)
                    <a href="#{{ $category->id }}" class="category-box">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>




        <!-- Sản phẩm -->
        <div style="background-color: white;">
            <div class="search-bar-wrapper mb-3 w-100 px-3">
                <input type="search" id="search-input" class="form-control search-input"
                    placeholder="🔍 Bạn đang cần tìm món gì ?">
            </div>


            <div class="product-section flex-grow-1">
                <div class="products">
                    @foreach ($categories as $category)
                        <section id="{{ $category->id }}">
                            <h2>{{ $category->name }}</h2>
                            <div class="product-grid">
                                @foreach ($category->products as $product)
                                    <div class="product-card" data-name="{{ Str::slug($product->name, ' ') }}">
                                        <div class="product-img">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                        </div>
                                        <div class="product-details">
                                            <div class="product-info">
                                                <h3>{{ $product->name }}</h3>
                                                <p class="price">{{ number_format($product->price) }} VNĐ</p>
                                            </div>
                                            <div class="add-to-cart">
                                                <button onclick="addToCart('{{ $product->name }}', {{ $product->price }})">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </section>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Giỏ hàng -->
        <div class="cart-sidebar p-4 bg-white rounded shadow-sm cart-fixed-mobile">
            <h4 class="mb-3">🛒 Giỏ hàng</h4>
            <div id="cart-items" class="mb-3" style="max-height: 200px; overflow-y: auto;"></div>
            <p><strong>Tổng:</strong> <span id="cart-total">0 VNĐ</span></p>
            <button class="btn btn-success w-100 mt-2">Xác nhận đơn hàng</button>
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade fullscreen-mobile" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Xác nhận đặt bàn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="modal-section-title">Đơn hàng của bạn</h6>
                    <div id="modal-cart-items" class="mb-4"></div>
                    <hr class="section-divider">

                    <h6 class="modal-section-title mt-4">Thông tin người đặt</h6>
                    <form id="order-form">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="customer-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="customer-phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="customer-phone" required>
                        </div>
                        <!-- Thêm trường Ngày đặt bàn -->
                        <div class="mb-3">
                            <label for="reservation-date" class="form-label">Ngày đặt bàn</label>
                            <input type="text" class="form-control" id="reservation-date" placeholder="dd/mm/yyyy"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="arrival-time" class="form-label">Dự kiến giờ ăn</label>
                            <input type="text" class="form-control" id="arrival-time" placeholder="Chọn giờ" required
                                readonly>
                        </div>


                        <!-- Thêm trường Số lượng người -->
                        <div class="mb-3">
                            <label for="guest-count" class="form-label">Số lượng người</label>
                            <input type="number" class="form-control" id="guest-count" required min="1">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" onclick="submitOrder()">Đặt bàn</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal xác nhận đặt bàn thành công -->

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Đặt Bàn Thành Công</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Cảm ơn bạn! Đơn hàng của bạn đã được xác nhận thành công. Bạn vui lòng để ý điện thoại sẽ có nhân
                    viên gọi điện xác nhận cho bạn!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Thông báo tiến trình khi gửi đơn hàng -->
    <div class="progress-overlay" id="progress-overlay">
        <div class="progress-bar">
            <p>Đang xử lý đơn hàng...</p>
        </div>
    </div>

    <script>
        const originalParse = JSON.parse;
        JSON.parse = function (value) {
            try {
                return originalParse.apply(this, arguments);
            } catch (e) {
                console.warn("⚠️ JSON.parse bị lỗi với giá trị:", value);
                return value; // trả lại chuỗi thô để tránh lỗi
            }
        };

    </script>
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Khởi tạo flatpickr cho input với định dạng dd/mm/yyyy
        flatpickr("#reservation-date", {
            dateFormat: "d/m/Y",  // Định dạng ngày dd/mm/yyyy
            locale: "vi"
        });
        // Khởi tạo Flatpickr cho trường chọn giờ (24 giờ)
        flatpickr("#arrival-time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            minTime: "00:00",
            maxTime: "23:59",
            defaultHour: 12,
            defaultMinute: 0,
            allowInput: false,
            mobile: {

                timeFormat: "H:i",
                time_24hr: true,
                dateFormat: "H:i",
            }
        });
    </script>
    <script>
        document.getElementById('search-input').addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            const productCards = document.querySelectorAll('.product-card');

            productCards.forEach(card => {
                const name = card.getAttribute('data-name') || '';
                if (name.includes(keyword.replace(/\s+/g, '-'))) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    const id = entry.target.id;
                    const desktopLink = document.querySelector(`.category-nav a[href="#${id}"]`);
                    const mobileLink = document.querySelector(`.category-box[href="#${id}"]`);

                    if (entry.isIntersecting) {
                        // Xử lý desktop
                        document.querySelectorAll('.category-nav a').forEach(el => el.classList.remove('active'));
                        if (desktopLink) desktopLink.classList.add('active');

                        // Xử lý mobile
                        document.querySelectorAll('.category-box').forEach(el => el.classList.remove('active'));
                        if (mobileLink) mobileLink.classList.add('active');
                    }
                });
            }, { threshold: 0.75 });

            document.querySelectorAll("section[id]").forEach(section => {
                observer.observe(section);
            });
        });

        document.querySelectorAll('.category-box').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const id = this.getAttribute('href').replace('#', '');
                const section = document.getElementById(id);
                if (section) {
                    window.scrollTo({
                        top: section.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

    </script>
    <script>
        const cart = [];

        function addToCart(name, price) {
            const existing = cart.find(item => item.name === name);
            if (existing) {
                existing.quantity += 1;
            } else {
                cart.push({ name, price, quantity: 1 });
            }
            renderCart();
            showCustomAlert(`Đã thêm "${name}" vào giỏ hàng thành công!`, 'success');
        }

        function changeQuantity(name, delta) {
            const item = cart.find(i => i.name === name);
            if (!item) return;

            item.quantity += delta;
            if (item.quantity <= 0) {
                const index = cart.indexOf(item);
                cart.splice(index, 1); // xóa khỏi giỏ nếu quantity <= 0
            }
            renderCart();
        }

        function renderCart() {
            const cartItems = document.getElementById('cart-items');
            cartItems.innerHTML = '';
            let total = 0;

            cart.forEach(item => {
                const div = document.createElement('div');
                div.className = 'cart-item';

                // Tạo nội dung HTML an toàn
                div.innerHTML = `
            <div>${item.name}</div>
            <div><strong>${(item.price * item.quantity).toLocaleString('vi-VN')} VNĐ</strong></div>
            <div class="cart-controls">
                <button class="decrease">−</button>
                <span>${item.quantity}</span>
                <button class="increase">+</button>
            </div>
        `;

                // Gán sự kiện riêng biệt (tránh lỗi cú pháp)
                div.querySelector('.decrease').addEventListener('click', () => changeQuantity(item.name, -1));
                div.querySelector('.increase').addEventListener('click', () => changeQuantity(item.name, 1));

                cartItems.appendChild(div);

                total += item.price * item.quantity;
            });

            document.getElementById('cart-total').innerText = total.toLocaleString('vi-VN') + ' VNĐ';
        }

        // Hàm render giỏ hàng trong modal
        function renderModalCart() {
            const modalCartItems = document.getElementById('modal-cart-items');
            modalCartItems.innerHTML = '';
            let total = 0;

            cart.forEach(item => {
                const div = document.createElement('div');
                div.className = 'cart-item';
                div.innerHTML = `
                <div>${item.name}</div>
                <div>${item.quantity}</div>
                <div><strong>${(item.price * item.quantity).toLocaleString('vi-VN')} VNĐ</strong></div>
                
            `;
                modalCartItems.appendChild(div);

                total += item.price * item.quantity;
            });

            modalCartItems.innerHTML += `<p><strong>Tổng:</strong> ${total.toLocaleString('vi-VN')} VNĐ</p>`;
        }


        // Hàm mở modal khi bấm xác nhận đơn hàng
        function openOrderModal() {
            renderModalCart();
            var myModal = new bootstrap.Modal(document.getElementById('orderModal'), {
                keyboard: false
            });
            myModal.show();
        }
        function scrollToCategory(id) {
            if (!id) return;
            const section = document.getElementById(id);
            if (section) {
                window.scrollTo({
                    top: section.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        }
        function showCustomAlert(message, type = 'success') {
            const alertBox = document.createElement('div');
            alertBox.classList.add('custom-alert');

            // Thêm class tương ứng với loại thông báo
            if (type === 'success') {
                alertBox.classList.add('success');
            } else if (type === 'error') {
                alertBox.classList.add('error');
            }

            alertBox.innerText = message;
            document.body.appendChild(alertBox);

            setTimeout(() => alertBox.classList.add('show'), 100);

            setTimeout(() => {
                alertBox.classList.remove('show');
                setTimeout(() => alertBox.remove(), 500);
            }, 3000);
        }


        // Hàm kiểm tra định dạng số điện thoại
        function validatePhoneNumber(phoneNumber) {
            const phoneRegex = /^(0[3|5|7|8|9])[0-9]{8}$/; // Biểu thức chính quy cho số điện thoại Việt Nam
            return phoneRegex.test(phoneNumber);
        }
        // Hàm gửi dữ liệu đến server
        function submitOrder() {
            if (cart.length === 0) {
                showCustomAlert("Bạn chưa đặt món nào, xin vui lòng chọn món!", "error");
                return; // Dừng lại nếu giỏ hàng trống
            }
            const name = document.getElementById('customer-name').value;
            const phone = document.getElementById('customer-phone').value;
            const reservationDate = document.getElementById('reservation-date').value;
            const arrivalTime = document.getElementById('arrival-time').value; // Lấy giờ dự kiến đến
            const guestCount = document.getElementById('guest-count').value;

            if (!name || !phone || !reservationDate || !guestCount || !arrivalTime) {
                showCustomAlert("Vui lòng điền đầy đủ thông tin!", "error");
                return;
            }
            // Kiểm tra số điện thoại hợp lệ
            if (!validatePhoneNumber(phone)) {
                showCustomAlert("Số điện thoại không hợp lệ. Vui lòng nhập lại.", "error");
                return;
            }
            const today = new Date();
            const selectedDate = flatpickr.parseDate(reservationDate, "d/m/Y");
            if (selectedDate < today.setHours(0, 0, 0, 0)) {
                showCustomAlert("Ngày đặt bàn không được là ngày quá khứ!", "error");
                return;
            }
            // Chuẩn bị dữ liệu để gửi lên server
            const orderData = {
                customer_name: name,
                customer_phone: phone || null,
                reservation_date: reservationDate,
                arrival_time: arrivalTime,
                guest_count: guestCount,
                cart: cart
            };
            document.getElementById('progress-overlay').style.display = 'flex';

            // Gửi dữ liệu đến server bằng AJAX (sử dụng Fetch API)
            fetch('/api/submit-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Lấy CSRF token
                },
                body: JSON.stringify(orderData)
            })

                .then(response => response.json())
                .then(data => {
                    document.getElementById('progress-overlay').style.display = 'none';
                    if (data.success) {
                        cart.length = 0;
                        renderCart();
                        // Đóng modal và thông báo thành công
                        const myModal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
                        myModal.hide();
                        // Hiển thị Modal thành công
                        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();

                        setTimeout(() => {
                            document.body.removeAttribute('data-bs-overflow');
                            document.body.removeAttribute('data-bs-padding-right');
                        }, 100);
                    } else {
                        showCustomAlert("Có lỗi xảy ra. Vui lòng thử lại.", "error");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("Có lỗi xảy ra. Vui lòng thử lại.");
                });

        }



        // Liên kết nút xác nhận với hàm openOrderModal
        document.querySelector('.btn.btn-success.w-100.mt-2').addEventListener('click', openOrderModal);

    </script>


</body>

</html>
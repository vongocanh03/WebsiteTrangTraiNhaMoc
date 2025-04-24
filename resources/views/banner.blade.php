<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <meta charset="UTF-8">

    <style>
        /* Cấu hình banner */
        .banner {
            display: flex;
            background-color: #ffffff;
            padding: 20px;
            color: #fff;
            align-items: center;
            border-radius: 12px;
            margin-left: 80px;
            margin-right: 80px;
        }

        .banner-left {

            align-items: center;
            justify-content: center;
        }

        .logo {
            width: 60%;
            height: auto;
        }

        .banner-right {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .banner-right h2 {
            font-size: 24px;
            font-weight: 700;
            margin: 5px 0;
            text-transform: uppercase;
        }

        .status {
            background-color: rgb(255 255 255);
            /* Màu xanh */
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .address,
        .hours,
        .hotline {
            font-size: 14px;
            margin: 5px 0;
        }

        .logo {
            width: 72px;
            height: 72px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 12px;
            /* hoặc 50% nếu bạn muốn tròn */
            background-color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 991.98px) {

            /* Banner full-screen mobile */
            .mobile-banner {
                width: 100%;
                height: 200px;
                background-size: cover;
                background-position: center;
                position: relative;
            }

            .mobile-banner-overlay {
                width: 100%;
                height: 100%;
                padding: 16px;

                flex-direction: column;
                justify-content: space-between;
                position: relative;
            }

            .mobile-banner-top {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .btn-back,
            .btn-lang {
                background-color: rgba(255, 255, 255, 0.9);
                border: none;
                padding: 6px 12px;
                border-radius: 20px;
                font-size: 14px;
                color: #444;
                font-weight: 600;
            }

            .mobile-logo {
                width: 200px;
                height: 200px;
                background-size: cover;
                background-position: center;
                background-color: white;
                border-radius: 16px;
                position: absolute;
                bottom: -36px;
                left: 16px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                border: 5px solid #ffffff;

            }

            /* Thông tin dưới banner */
            .mobile-store-info {
                margin-top: 50px;
                padding: 16px;
                text-align: center;
                background-color: white;
                border-radius: 12px;
                box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.05);
            }

            .mobile-store-info h2 {
                font-style: normal;
                font-weight: 600;
                line-height: 25px;
                letter-spacing: 0;
                text-align: left;
                padding: 0 10px;
            }

            .mobile-store-info p {
                font-size: 40px;
                text-align: left;
                color: #608b77;
            }

            .status .dot {
                width: 8px;
                height: 8px;
                background-color: #00c851;
                border-radius: 50%;
                display: inline-block;
                margin-right: 6px;
            }

            .restaurant_info {
                font-size: 14px;
                color: #444;
                line-height: 1.6;
                padding-left: 20px;
            }

            .restaurant_info i {
                margin-right: 8px;
                color: #999;
                min-width: 18px;
            }

            .status {
                color: #28a745;
                font-weight: 600;
                display: flex;
                align-items: center;
            }

            .status .dot {
                display: inline-block;
                width: 20px;
                height: 20px;
                background-color: #28a745;
                border-radius: 50%;
                margin-right: 30px;
            }


        }

        /*desktoop */
        @media (min-width: 992px) {

            .mobile-banner,
            .mobile-store-info {
                display: none !important;
            }

            .desktop-banner {
                display: flex;
                background-color: white;
                align-items: center;
                border-radius: 12px;
                margin-bottom: 8px;
                margin-right: 80px;
                margin-left: 80px;
                padding: 20px 16px 20px 20px;
            }
        }

        .desktop-banner-left {
            flex: 0 0 520px;
            height: 260px;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: flex-end;
            padding: 10px;
            margin-right: 30px;
        }

        .desktop-logo {
            width: 80px;
            height: 80px;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border: 2.5px solid #ffffff;
        }

        .desktop-banner-right h2 {
            font-size: 28px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 12px;
            color: #222;
        }

        .desktop-banner-right p {
            font-size: 16px;
            color: #444;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .desktop-banner-right .status {
            color: #28a745;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .desktop-banner-right .dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color: #28a745;
            border-radius: 50%;
            margin-right: 6px;
        }

        .desktop-banner-right i {
            color: #198754;
        }
        }
    </style>

</head>

<body>
    <!-- Banner dành cho desktop -->
    <div class="desktop-banner d-none d-lg-flex">
        <div class="desktop-banner-left" style="background-image: url('{{ asset('storage/images/banner-bg.jpg') }}');">
            <div class="desktop-logo" style="background-image: url('{{ asset('storage/images/logonm.jpg') }}');"></div>
        </div>
        <div class="desktop-banner-right">
            <h2>TRANG TRẠI NHÀ MỘC</h2>
            <p class="status" id="store-status-desktop">
                <span class="dot"></span> Đang kiểm tra...
            </p>

            <p><i class="fas fa-store-alt"></i> Quyết Tiến, Thạch Xuân, Thạch Hà, Hà Tĩnh</p>
            <p><i class="far fa-clock"></i> Giờ mở cửa: 14:00 - 22:00</p>
            <p><i class="fas fa-phone-alt"></i> Số điện thoại cửa hàng: 0911136667 & 0941133888</p>
        </div>
    </div>

    <!-- Banner dành cho mobile -->
    <div class="mobile-banner"
        style="background-image: url('{{ asset('storage/images/banner-bg.jpg') }}'); height: 56vw">
        <div class="mobile-banner-overlay">
            <div class="mobile-logo" style="background-image: url('{{ asset('storage/images/logonm.jpg') }}');"></div>
        </div>
    </div>

    <div class="mobile-store-info">
        <h2>TRANG TRẠI NHÀ MỘC</h2>
        <div class="restaurant_info">
            <p class="status" id="store-status-mobile">
                <span class="dot"></span> Đang kiểm tra...
            </p>

            <p><i class="fas fa-store-alt"></i>Quyết Tiến, Thạch Xuân, Thạch Hà, Hà Tĩnh</p>
            <p><i class="far fa-clock"></i> Giờ mở cửa: 14:00 - 22:00</p>
            <p><i class="fas fa-phone-alt"></i> Số điện thoại: 0911136667 & 0941133888</p>
        </div>

    </div>
    <script>
        function updateStoreStatus() {
            const now = new Date();
            const hours = now.getHours();
            const minutes = now.getMinutes();

            // Giờ mở cửa: 14:00 đến 22:00
            const isOpen = (hours > 14 || (hours === 14 && minutes >= 0)) &&
                (hours < 22 || (hours === 22 && minutes === 0));

            const statusText = isOpen ? 'Đang mở cửa' : 'Đang đóng cửa';
            const statusColor = isOpen ? '#28a745' : '#dc3545'; // xanh hoặc đỏ

            const statusDot = `<span class="dot" style="background-color:${statusColor};"></span>`;

            const desktopStatus = document.getElementById('store-status-desktop');
            const mobileStatus = document.getElementById('store-status-mobile');

            if (desktopStatus) {
                desktopStatus.innerHTML = statusDot + statusText;
                desktopStatus.style.color = statusColor;
            }

            if (mobileStatus) {
                mobileStatus.innerHTML = statusDot + statusText;
                mobileStatus.style.color = statusColor;
            }
        }

        // Gọi hàm khi trang tải xong
        document.addEventListener('DOMContentLoaded', updateStoreStatus);
    </script>


</body>
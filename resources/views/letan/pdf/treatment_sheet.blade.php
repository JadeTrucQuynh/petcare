<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Phiếu điều trị #{{ $phieu->sttpdt }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #000;
        }
        h2, h3, h4 {
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding: 15px;
        }
        .info-box {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            page-break-inside: avoid;
        }
        th, td {
            border: 1px dashed #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #f8f8f8;
            font-weight: bold;
        }
        .total {
            text-align: right;
            font-weight: bold;
            font-size: 16px;
            margin-top: 15px;
            page-break-inside: avoid;
        }
        .bottom-section {
            display: block;
            margin-top: 40px;
            page-break-inside: avoid;
        }
        .sign-box {
            text-align: right;
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .sign-line {
            display: inline-block;
            width: 200px;
            border-bottom: 1px solid #000;
            margin-top: 30px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 13px;
            color: #000;
            padding: 5px;
            font-style: italic;
            border-top: 1px solid #000;
            background: #fff;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <h2>CƠ SỞ CHĂM SÓC THÚ CƯNG WiWi</h2>
        <p>Địa chỉ: 158, đường 3/2, phường Xuân Khánh, quận Ninh Kiều, Tp Cần Thơ</p>
        <p>Hotline: 0969-888-444</p>
        <hr>
        <h3>PHIẾU ĐIỀU TRỊ #PDT0000{{ $phieu->sttpdt }}</h3>
        <p>Ngày lập phiếu: {{ \Carbon\Carbon::parse($phieu->ngay)->format('d/m/Y') }}</p>
    </div>

    {{-- Thông tin khách hàng --}}
    <div class="info-box">
        <h4>THÔNG TIN KHÁCH HÀNG</h4>
        <p><strong>Tên khách hàng:</strong> {{ $phieu->thuCung->khachHang->tenkh ?? 'N/A' }}</p>
        <p><strong>Số điện thoại khách hàng:</strong> {{ $phieu->thuCung->khachHang->sdt ?? 'N/A' }}</p>
        <p><strong>Thú cưng điều trị:</strong> {{ $phieu->thuCung->tentc }} ({{ $phieu->thuCung->loaiThuCung->tenltc ?? 'N/A' }})</p>
    </div>

    {{-- Dịch vụ --}}
    <h4>DỊCH VỤ SỬ DỤNG</h4>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tên dịch vụ</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dichVuItems as $ct)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ct->dichVu->tendv ?? 'Không xác định' }}</td>
                    <td>{{ number_format($ct->dongia, 0, ',', '.') }} VNĐ</td>
                    <td>{{ number_format($ct->thanhtien, 0, ',', '.') }} VNĐ</td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align:center;">Không có dịch vụ nào</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Thuốc --}}
    <h4>THUỐC SỬ DỤNG</h4>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tên thuốc</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @forelse($thuocItems as $ct)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ct->thuoc->tenthuoc ?? 'Không xác định' }}</td>
                    <td>{{ $ct->soluong }}</td>
                    <td>{{ number_format($ct->dongia, 0, ',', '.') }} VNĐ</td>
                    <td>{{ number_format($ct->thanhtien, 0, ',', '.') }} VNĐ</td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align:center;">Không có thuốc nào</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Tổng tiền --}}
    <p class="total">TỔNG CỘNG: {{ number_format($phieu->tongtien, 0, ',', '.') }} VNĐ</p>

    {{-- Ký tên --}}
    <div class="bottom-section">
        <div class="sign-box">
            <p><strong>Người lập phiếu</strong></p>
            <p>(Ký và ghi rõ họ tên)</p>
            <div class="sign-line"></div>
            <br><br>
            <strong>{{ $phieu->nhanVien->tennv ?? 'receptionist' }}</strong></p>
        </div>

        {{-- Footer --}}
        <div class="footer">
            <hr>
            <p>WiWi xin cảm ơn bạn đã tin tưởng dịch vụ của chúng tôi!</p>
        </div>
    </div>

</body>
</html>

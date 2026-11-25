<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn #{{ $phieu->sttpdt }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; }
        .center { text-align: center; }
        .bold { font-weight: bold; }
        .line { border-top: 1px dashed #aaa; margin: 8px 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 5px; text-align: left; }
        th { border-bottom: 1px dashed #aaa; }
        .total { text-align: right; font-weight: bold; }
    </style>
</head>
<body>
    {{-- Tiêu đề --}}
    <div class="center">
        <h3>CƠ SỞ CHĂM SÓC THÚ CƯNG WiWi</h3>
        <p>158, đường 3/2, phường Xuân Khánh, quận Ninh Kiều, Tp Cần Thơ</p>
        <p>0969-888-444</p>
        <div class="line"></div>
        <h4>HÓA ĐƠN THANH TOÁN</h4>
        <h5>Mã hóa đơn: #HD0000{{ $phieu->sttpdt }}</h5>
    </div>

    {{-- Thông tin khách --}}
    <p><span class="bold">Khách hàng:</span> {{ $phieu->thuCung->khachHang->tenkh ?? 'N/A' }}</p>
    <p><span class="bold">Thú cưng:</span> {{ $phieu->thuCung->tentc }} ({{ $phieu->thuCung->loaiThuCung->tenltc ?? 'N/A' }})</p>
    <p><span class="bold">Ngày:</span> {{ \Carbon\Carbon::parse($phieu->ngay)->format('d/m/Y') }}</p>
    <div class="line"></div>

    {{-- Dịch vụ --}}
    @if($dichVuItems->count() > 0)
        <h4>DỊCH VỤ SỬ DỤNGS</h4>
        <table>
            <thead>
                <tr>
                    <th>Tên dịch vụ</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dichVuItems as $ct)
                    <tr>
                        <td>{{ $ct->dichVu->tendv ?? 'Dịch vụ' }}</td>
                        <td>{{ number_format($ct->dongia, 0, ',', '.') }} VNĐ</td>
                        <td>{{ number_format($ct->thanhtien, 0, ',', '.') }} VNĐ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Thuốc --}}
    @if($thuocItems->count() > 0)
        <h4>THUỐC SỬ DỤNG</h4>
        <table>
            <thead>
                <tr>
                    <th>Tên thuốc</th>
                    <th>SL</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($thuocItems as $ct)
                    <tr>
                        <td>{{ $ct->thuoc->tenthuoc ?? 'Thuốc' }}</td>
                        <td>{{ $ct->soluong }}</td>
                        <td>{{ number_format($ct->dongia, 0, ',', '.') }} VNĐ</td>
                        <td>{{ number_format($ct->thanhtien, 0, ',', '.') }} VNĐ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="line"></div>
    <p class="total">TỔNG CỘNG: {{ number_format($phieu->tongtien, 0, ',', '.') }} VNĐ</p>

    <div class="center">
        <div class="line"></div>
        <p>WiWi xin cảm ơn bạn đã tin tưởng dịch vụ của chúng tôi!</p>
    </div>
</body>
</html>

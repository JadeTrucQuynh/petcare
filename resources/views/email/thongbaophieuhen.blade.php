<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thông báo phiếu hẹn</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h2>Xin chào {{ $tenkh }},</h2>

    <p>Chúng tôi xin thông báo rằng phiếu hẹn khám của bạn tại <strong>WiWi - Cơ sở chăm sóc thú cưng</strong> với nội dung hẹn khám như sau: </p>

    <ul>
        <li><strong>Ngày giờ hẹn:</strong> {{ $ngaygio }}</li>
        <li><strong>Dịch vụ:</strong> {{ $dichvu }}</li>
        <li><strong>Loại thú cưng:</strong> {{ $loaitc->tenltc }}</li>
    </ul>

    @if(strtolower($trangthai) === 'đã duyệt')
        <p style="color: green;">
            Phiếu hẹn của bạn đã được <strong>duyệt</strong>. Xin vui lòng có mặt tại WiWi đúng vào thời gian trên để được phục vụ tốt nhất.
        </p>
    @elseif(strtolower($trangthai) === 'không duyệt')
        <p style="color: red;">
            Rất tiếc, phiếu hẹn của bạn <strong>không được duyệt</strong>. Vui lòng chọn lại thời gian khác hoặc quay lại sau để kiểm tra thông tin mới nhất.
        </p>
    @else
        <p>
            Phiếu hẹn của bạn hiện đang ở trạng thái: <strong>{{ $trangthai }}</strong>.
        </p>
    @endif

    <p>Chân thành cảm ơn bạn đã tin tưởng và sử dụng dịch vụ của WiWi!</p>

    <p>Trân trọng,<br>
    <strong>🐾 WiWi</strong></p>
</body>
</html>

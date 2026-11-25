@extends('letan.letan_layout')
<title>Chi tiết phiếu điều trị</title>

@section('letan_content')
<!-- Modal Thanh Toán -->
<div class="modal fade" id="modalThanhToan" tabindex="-1" aria-labelledby="modalThanhToanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalThanhToanLabel">Xác nhận thanh toán</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
      </div>
      <div class="modal-body">
        <p>Tổng tiền cần thanh toán: <strong class="text-danger">{{ number_format($phieu->tongtien, 0, ',', '.') }} VNĐ</strong>.</p>
        <p>Bấm chọn xác nhận thanh toán sau khi đã được thanh toán!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="handleConfirm('{{ route('invoice.pdf', $phieu->sttpdt) }}')">
            Xác nhận thanh toán
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
{{-- /////////////////////////////////////////////// --}}
<!-- Toast giữa màn hình -->
<div class="position-fixed top-50 start-50 translate-middle p-3" style="z-index: 1080;">
  <div id="toastThanhToan" class="toast text-bg-success border-0 fade" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex align-items-center">
      <div class="toast-body">
        Đã thanh toán thành công!
      </div>
      <button type="button" class="btn-close btn-close-white ms-3 me-2" data-bs-dismiss="toast" aria-label="Đóng"></button>
    </div>
  </div>
</div>
{{-- ////////////////////////////////////////////////// --}}
<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h3>Chi tiết phiếu điều trị #{{ $phieu->sttpdt }}</h3>

    {{-- Thông tin khách hàng & thú cưng --}}
    <div class="card mb-3">
        <div class="card-header bg-info text-white">👤 Thông tin khách hàng</div>
        <div class="card-body">
            <p><strong>Tên khách hàng:</strong> {{ optional($phieu->thuCung->khachHang)->tenkh ?? 'N/A' }}</p>
            <p><strong>Tên thú cưng:</strong> {{ $phieu->thuCung->tentc }}</p>
            <p><strong>Loại thú cưng:</strong> {{ optional($phieu->thuCung->loaiThuCung)->tenltc ?? 'N/A' }}</p>
            <p><strong>Ngày lập phiếu:</strong> {{ \Carbon\Carbon::parse($phieu->ngay)->format('d/m/Y') }}
            <p><strong>Tổng tiền:</strong> <span class="text-danger fw-bold">{{ number_format($phieu->tongtien,0,',','.') }} VNĐ</span></p>
        </div>
    </div>

    {{-- Danh sách dịch vụ --}}
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">Dịch vụ đã sử dụng</div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
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
                            <td>{{ number_format($ct->dongia,0,',','.') }} VNĐ</td>
                            <td>{{ number_format($ct->thanhtien,0,',','.') }} VNĐ</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Không có dịch vụ nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Danh sách thuốc --}}
    <div class="card mb-3">
        <div class="card-header bg-success text-white">Thuốc đã kê đơn</div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Tên thuốc</th>
                        <th>Đơn vị tính</th>
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
                            <td>{{ $ct->thuoc->dvtinh }}</td>
                            <td>{{ $ct->soluong }}</td>
                            <td>{{ number_format($ct->dongia,0,',','.') }} VNĐ</td>
                            <td>{{ number_format($ct->thanhtien,0,',','.') }} VNĐ</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Không có thuốc nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4 text-end">
        @if (!$phieu->thanhtoan)
            <button id="btnThanhToan" class="btn btn-success" onclick="handleThanhToan()">
                Thanh toán
            </button>
        @else
            <span class="btn btn-outline-success disabled">
                Đã thanh toán
            </span>
        @endif
        <a href="{{ route('letan.treatment_sheet.list') }}" class="btn btn-secondary ms-2">⬅ Quay lại</a>
    </div>
</div>
<style>
    .toast-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .toast-hover:hover {
    transform: scale(1.05) rotate(-1deg);
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.6);
    }
</style>
<script>
function handleThanhToan() {
    setTimeout(() => {
        const modal = new bootstrap.Modal(document.getElementById('modalThanhToan'));
        modal.show();
    }, 600);

    // window.open(pdfUrl, '_blank');

}
function handleConfirm(pdfUrl) {

    window.open(pdfUrl, '_blank');

    const modalEl = document.getElementById('modalThanhToan');
    const modalInstance = bootstrap.Modal.getInstance(modalEl);
    if (modalInstance) {
        modalInstance.hide();
    }

    const btn = document.getElementById('btnThanhToan');
    if (btn) {
        btn.classList.remove('btn-success');
        btn.classList.add('btn-outline-success');
        btn.innerHTML = 'Đã thanh toán';
        btn.disabled = true;
    }
    window.open(pdfUrl, '_blank');

    showThanhToanToast();
}
function showThanhToanToast() {
    const toastEl = document.getElementById('toastThanhToan');
    const toast = new bootstrap.Toast(toastEl,{ delay: 5000 });
    toast.show();
}
</script>
@endsection
@if (session('pdf_url'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                window.open('{{ session('pdf_url') }}', '_blank');
            }, 500);
        });
    </script>
@endif

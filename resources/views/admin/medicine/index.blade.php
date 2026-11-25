@extends('admin.admin_layout')
<title>Quản lý thuốc</title>

@section('admin_content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Danh sách thuốc</h3>
        <a href="{{ route('admin.medicine.create') }}" class="btn btn-primary">
            ➕ Thêm thuốc
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="malt" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Tất cả loại thuốc --</option>
                    @foreach($loaithuoc as $loai)
                        <option value="{{ $loai->malt }}" {{ $malt == $loai->malt ? 'selected' : '' }}>
                            {{ $loai->tenlt }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Tên thuốc</th>
                        <th>Đơn vị tính</th>
                        <th>Mô tả</th>
                        <th>Loại</th>
                        <th>Giá hiện tại</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($thuoc as $thuocs)
                        <tr class="align-middle text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $thuocs->tenthuoc }}</td>
                            <td class="text-start">{{ $thuocs->dvtinh }}</td>
                            <td class="text-start">{{ $thuocs->mota }}</td>
                            <td>{{ $thuocs->loaiThuoc->tenlt ?? '-' }}</td>
                            <td>
                                @if($thuocs->giaMoiNhat)
                                    {{ number_format($thuocs->giaMoiNhat->dgthuoc) }} đ <br>
                                    <small>({{ $thuocs->giaMoiNhat->ngay }})</small>
                                @else
                                    <span class="text-muted">Chưa có giá</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.medicine.edit', $thuocs->mathuoc) }}" class="btn btn-warning btn-sm me-1">
                                    Sửa
                                </a>
                                <form action="{{ route('admin.medicine.destroy', $thuocs->mathuoc) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                                <button class="btn btn-info btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#giaThuocModal"
                                        data-ten="{{ $thuocs->tenthuoc }}"
                                        data-gias='@json($thuocs->dgThuocs)'>
                                    Lịch sử giá thuốc
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Không có thuốc nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $thuoc->links() }}
    </div>
</div>
{{-- modal giá thuoc --}}
<div class="modal fade" id="giaThuocModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Lịch sử giá thuốc</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <h6 id="modalTenThuoc"></h6>
        <table class="table table-sm table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Đơn giá</th>
              <th>Ngày áp dụng</th>
            </tr>
          </thead>
          <tbody id="modalBodyGiaThuoc">
            <!-- render bằng JS -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById('giaThuocModal');
    modal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        let ten = button.getAttribute('data-ten');
        let gias = JSON.parse(button.getAttribute('data-gias'));

        modal.querySelector("#modalTenThuoc").innerText = ten;

        let tbody = modal.querySelector("#modalBodyGiaThuoc");
        tbody.innerHTML = "";
        gias.forEach((gia, index) => {
            tbody.innerHTML += `
              <tr>
                <td>${index+1}</td>
                <td>${Number(gia.dgthuoc).toLocaleString()} đ</td>
                <td>${new Date(gia.created_at).toLocaleString('vi-VN')}</td>
              </tr>`;
        });
    });
});
</script>

@endsection

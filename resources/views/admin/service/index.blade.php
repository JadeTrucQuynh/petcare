@extends('admin.admin_layout')
<title>Quản lý dịch vụ</title>

@section('admin_content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Danh sách dịch vụ</h3>
        <a href="{{ route('admin.service.create') }}" class="btn btn-primary">
            Thêm dịch vụ
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Bộ lọc loại dịch vụ -->
    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="maldv" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Tất cả loại dịch vụ --</option>
                    @foreach($loaidvs as $loai)
                        <option value="{{ $loai->maldv }}" {{ $maldv == $loai->maldv ? 'selected' : '' }}>
                            {{ $loai->tenldv }}
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
                        <th>Tên dịch vụ</th>
                        <th>Mô tả</th>
                        <th>Loại</th>
                        <th>Giá hiện tại</th>
                        <th>Hình đại diện</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dichvus as $dv)
                        <tr class="align-middle text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $dv->tendv }}</td>
                            <td class="text-start">{{ $dv->mota }}</td>
                            <td>{{ $dv->loaiDichVu->tenldv ?? '-' }}</td>
                            <td>
                                @if($dv->giaMoiNhat)
                                    {{ number_format($dv->giaMoiNhat->dgdichvu) }} đ <br>
                                    <small>({{ $dv->giaMoiNhat->ngay }})</small>
                                @else
                                    <span class="text-muted">Chưa có giá</span>
                                @endif
                            </td>
                            <td>
                                @if($dv->hinhDaiDien)
                                    <img src="{{ asset($dv->hinhDaiDien->duongdan) }}" alt="Ảnh dịch vụ" width="80" height="80">
                                @else
                                    <span class="text-muted">Chưa có ảnh</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.service.edit', $dv->madv) }}" class="btn btn-warning btn-sm me-1">
                                    Sửa
                                </a>
                                <form action="{{ route('admin.service.destroy', $dv->madv) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                                <button class="btn btn-info btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#giaModal"
                                        data-ten="{{ $dv->tendv }}"
                                        data-gias='@json($dv->dgDichVus)'>
                                    Xem lịch sử đơn giá
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Không có dịch vụ nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $dichvus->links() }}
    </div>
</div>
{{-- Modal --}}
<div class="modal fade" id="giaModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Lịch sử giá dịch vụ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <h6 id="modalTenDV"></h6>
        <table class="table table-sm table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Đơn giá</th>
              <th>Ngày áp dụng</th>
            </tr>
          </thead>
          <tbody id="modalBodyGia">
            <!-- JS sẽ render ở đây -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById('giaModal');
    modal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        let ten = button.getAttribute('data-ten');
        let gias = JSON.parse(button.getAttribute('data-gias'));

        // set tên
        modal.querySelector("#modalTenDV").innerText = ten;

        // render bảng
        let tbody = modal.querySelector("#modalBodyGia");
        tbody.innerHTML = "";
        gias.forEach((gia, index) => {
            tbody.innerHTML += `
              <tr>
                <td>${index+1}</td>
                <td>${Number(gia.dgdichvu).toLocaleString()} đ</td>
                <td>${new Date(gia.created_at).toLocaleString('vi-VN')}</td>
              </tr>`;
        });
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

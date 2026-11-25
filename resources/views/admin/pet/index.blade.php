@extends('admin.admin_layout')
<title>Danh sách thú cưng</title>

@section('admin_content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Danh sách thú cưng</h3>
    </div>

    <!-- Bộ lọc khách hàng + loại thú cưng -->
    <form method="GET" class="mb-3">
        <div class="row g-2">
            <!-- Lọc theo khách hàng -->
            <div class="col-md-4">
                <select name="makh" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Tất cả khách hàng --</option>
                    @foreach($khachhang as $kh)
                        <option value="{{ $kh->makh }}" {{ $makh == $kh->makh ? 'selected' : '' }}>
                            {{ $kh->tenkh }} ({{ $kh->sdt }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Lọc theo loại thú cưng -->
            <div class="col-md-4">
                <select name="maltc" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Tất cả loại thú cưng --</option>
                    @foreach($loaithucung as $ltc)
                        <option value="{{ $ltc->maltc }}" {{ $maltc == $ltc->maltc ? 'selected' : '' }}>
                            {{ $ltc->tenltc }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nút reset bộ lọc -->
            <div class="col-md-2">
                <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary w-100">Xóa lọc</a>
            </div>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Tên thú cưng</th>
                        <th>Loại thú cưng</th>
                        <th>Khách hàng</th>
                        <th>Số lần điều trị</th>
                        <th>Mô tả</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($thucung as $tc)
                        <tr class="align-middle text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $tc->tentc }}</td>
                            <td>{{ $tc->loaiThuCung->tenltc ?? '-' }}</td>
                            <td>
                                {{ $tc->khachHang->tenkh ?? 'N/A' }}<br>
                                <small class="text-muted">{{ $tc->khachHang->sdt ?? '' }}</small>
                            </td>
                            <td>{{ $tc->phieu_dieu_tris_count }}</td>
                            <td class="text-start">{{ $tc->mota }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Không có thú cưng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $thucung->appends(request()->query())->links() }}
    </div>
</div>
@endsection

@extends('letan.letan_layout')
<title>
    Danh sách phiếu điều trị
</title>
@section('letan_content')
<form method="GET" action="{{ route('letan.treatment_sheet.list') }}" class="row g-2 mb-3">
    <div class="col-md-4">
        <select name="makh" class="form-select">
            <option value="">--Lọc theo khách hàng--</option>
            @foreach($khachHangs as $kh)
                <option value="{{ $kh->makh }}" {{ request('makh') == $kh->makh ? 'selected' : '' }}>
                    {{ $kh->tenkh }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <select name="maltc" class="form-select">
            <option value="">--Lọc theo loại thú--</option>
            @foreach($loaiThuCungs as $ltc)
                <option value="{{ $ltc->maltc }}" {{ request('maltc') == $ltc->maltc ? 'selected' : '' }}>
                    {{ $ltc->tenltc }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <input type="text" name="tentc" class="form-control" placeholder="Tên thú cưng..." value="{{ request('tentc') }}">
    </div>
    <div class="col-md-12 text-end">
        <button type="submit" class="btn btn-primary">Lọc</button>
        <a href="{{ route('letan.treatment_sheet.list') }}" class="btn btn-secondary ms-2">❌ Xóa lọc</a>
    </div>
</form>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Danh sách phiếu điều trị</h3>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>STTPDT</th>
                        <th>Ngày tạo phiếu</th>
                        <th>Tên thú cưng</th>
                        <th>Tên khách hàng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ds as $danhsachs)
                        <tr class="align-middle text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $danhsachs->ngay }}</td>
                            <td class="text-start">{{ $danhsachs->thuCung->tentc }}</td>
                            <td class="text-start">{{ $danhsachs->thuCung->khachHang->tenkh ?? '(Không có)' }}</td>
                            <td>
                                <a href="{{ route('letan.treatment_sheet.show', $danhsachs->sttpdt) }}" class="btn btn-warning btn-sm me-1">
                                    Xem chi tiết
                                </a>
                                {{-- <a href="{{ route('invoice.pdf',$danhsachs->sttpdt) }}" class="btn btn-warning btn-sm me-1">
                                    Thanh toán
                                </a> --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Không có phiếu điều trị nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

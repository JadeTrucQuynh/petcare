@extends('letan.letan_layout')
<title>
    Checking
</title>
@section('letan_content')
<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="mb-4">
        <form action="{{ route('letan.checking') }}" method="GET" class="d-flex align-items-center gap-2">
            <label for="matt" class="mb-0">Lọc:</label>
            <select name="matt" id="matt" class="form-select w-auto" onchange="this.form.submit()">
                <option value="1" {{ $trangThai == 1 ? 'selected' : '' }}>Chờ duyệt</option>
                <option value="2" {{ $trangThai == 2 ? 'selected' : '' }}>Đã duyệt</option>
                <option value="3" {{ $trangThai == 3 ? 'selected' : '' }}>Không duyệt</option>
            </select>
        </form>
    </div>
    {{-- <h2 class="mb-4">📋 Danh sách phiếu hẹn chờ duyệt</h2> --}}

    @forelse ($phieuchoduyet as $phieu)
        <div class="card shadow-sm mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-2">
                        🐾 {{ $phieu->khachHang->tenkh }}
                        <small class="text-muted">({{ $phieu->loaiThuCung->tenltc }})</small>
                    </h5>
                    <p class="mb-1">Ngày hẹn: {{ $phieu->ngaygiohen->format('d/m/Y H:i') }}</p>
                    <p class="mb-0">Dịch vụ:
                        @foreach($phieu->dichVus as $dv)
                            <span class="badge bg-info text-dark">{{ $dv->tendv }}</span>
                        @endforeach
                    </p>
                </div>

                @if($phieu->matt==1)
                    <div>
                        <form action="{{ route('letan.checking.approve', ['id' => $phieu->sttphen]) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Duyệt</button>
                        </form>

                        <form action="{{ route('letan.checking.reject', ['id' => $phieu->sttphen]) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">Từ chối</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <p class="text-muted">Không có phiếu hẹn nào cần duyệt.</p>
    @endforelse
</div>
@endsection

@extends('letan.letan_layout')
<title>
    Danh sách lịch hẹn
</title>
@section('letan_content')
<div class="container py-4">
<!-- Lịch hẹn đã duyệt -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
                LỊCH HẸN KHÁM SẮP TỚI
        </div>
        <div class="card-body p-0">
            <table class="table table-sm table-hover mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>Ngày giờ</th>
                        <th>Khách hàng</th>
                        <th>Số điện thoại khách hàng</th>
                        <th>Loại thú cưng</th>
                        <th>Dịch vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lichHenDaDuyet as $lich)
                        <tr class="align-middle text-center">
                            <td>{{ \Carbon\Carbon::parse($lich->ngaygiohen)->format('d/m/Y || H:i') }}</td>
                            <td>{{ $lich->khachHang->tenkh ?? 'N/A' }}</td>
                            <td>{{ $lich->khachHang->sdt ?? 'N/A' }}</td>
                            <td>{{ $lich->loaiThuCung->tenltc ?? '-' }}</td>
                            <td>
                                @if($lich->dichVus->count())
                                    {{ $lich->dichVus->pluck('tendv')->implode(', ') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Không có lịch hẹn nào được duyệt.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@extends('letan.letan_layout')
<title>Tạo phiếu điều trị</title>
@section('letan_content')
<style>
    .input-tentc {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}
</style>
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tạo Phiếu Điều Trị</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('letan.treatment_sheet.store') }}" method="POST">
                @csrf

                {{-- KHUNG 1: Tìm khách hàng --}}
                <div class="mb-4 p-3 border rounded bg-light">
                    <h5 class="text-secondary mb-3">Thông tin khách hàng</h5>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <select id="khachhang" name="makh" class="form-select" required></select>
                    </div>
                    {{-- Sẽ được thêm bằng JS nếu là khách mới --}}
                {{-- <input type="hidden" name="sdt_new" value="..."> --}}

                    {{-- Nếu chọn được khách hàng thì hiển thị thông tin --}}
                    <div id="khach-info" class="border rounded p-3 bg-white d-none">
                        <p><strong>Số điện thoại:</strong> <span id="sdt"></span></p>
                        <p><strong>Địa chỉ:</strong> <span id="diachi"></span></p>
                        <p><strong>Email:</strong> <span id="email"></span></p>
                    </div>

                    {{-- Nếu không có khách hàng thì cho nhập tên mới --}}
                    <div id="tao-moi-khach" class="mb-3 d-none">
                        <label class="form-label">Tên khách hàng mới</label>
                        <input type="text" name="tenkh_new" id="tenkh_new" class="form-control" placeholder="Nhập tên khách hàng">
                    </div>
                </div>

                {{-- KHUNG 2: Thông tin điều trị --}}
                <div class="p-3 border rounded">
                    <h5 class="text-secondary mb-3">Thông tin điều trị</h5>

                    {{-- Ngày phiếu --}}
                    <div class="mb-3">
                        <label class="form-label">Ngày tạo phiếu</label>
                        <input type="text" class="form-control" value="{{ date('d/m/Y') }}" readonly>
                    </div>

                    {{-- Tên thú cưng --}}
                    <div class="mb-3">
                        <label class="form-label">Tên thú cưng</label>
                        <select id="chon-thu-cung" class="form-control">
                            <option value="">--Chọn thú cưng--</option>
                            {{-- JS sẽ load danh sách thú cưng --}}
                        </select>
                        <input type="text" id="tentc" name="tentc" class="form-control mt-2" placeholder="Nhập tên thú cưng" style="display: none;">
                        <input type="hidden" name="matc_existing" id="matc_existing">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Loại thú cưng</label>
                        <select name="maltc" id="maltc" class="form-select" required>
                            <option value="">-- Chọn loại thú cưng --</option>
                            @foreach($loaitc as $loaitcs)
                                <option value="{{ $loaitcs->maltc }}">{{ $loaitcs->tenltc }}</option>
                            @endforeach
                        </select>
                    </div>

                    <hr>

                    {{-- Dịch vụ --}}
                    <h5 class="text-secondary">Dịch vụ sử dụng</h5>
                    <div id="dichvu-list">
                        <div class="row g-2 mb-2">
                            <div class="col-md-6">
                                <select name="dichvu[0][madv]" class="form-select">
                                    <option value="">-- Chọn dịch vụ --</option>
                                    @foreach($dichvu as $dv)
                                        <option value="{{ $dv->madv }}">{{ $dv->tendv }} - {{ $dv->giaMoiNhat ? number_format($dv->giaMoiNhat->dgdichvu, 0, ',', '.') : 'Chưa có giá' }} đ</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                {{-- Chừa chỗ trống để canh hàng với thuốc --}}
                                <input type="hidden" name="dichvu[0][soluong]" value="1">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success w-100" onclick="addDichVu()">Thêm dịch vụ</button>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Thuốc --}}
                    <h5 class="text-secondary">Thuốc kê đơn</h5>
                    <div id="thuoc-list">
                        <div class="row g-2 mb-2">
                            <div class="col-md-6">
                                <select name="thuoc[0][mathuoc]" class="form-select">
                                    <option value="">-- Chọn thuốc --</option>
                                    @foreach($thuoc as $t)
                                        <option value="{{ $t->mathuoc }}">{{ $t->tenthuoc }} - {{ $t->giaMoiNhat ? number_format($t->giaMoiNhat->dgthuoc, 0, ',', '.') : 'Chưa có giá' }} đ</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="thuoc[0][soluong]" class="form-control" value="1" min="1">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success w-100" onclick="addThuoc()">Thêm thuốc</button>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <button type="submit" class="btn btn-primary w-100 mt-3">Tạo Phiếu Điều Trị</button>
            </form>
        </div>
    </div>
</div>
{{-- JS Select2 AJAX --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@push('scripts')
<script>
$(document).ready(function () {
    $('#khachhang').select2({
        placeholder: "Nhập số điện thoại khách hàng...",
        tags: true,
        ajax: {
            url: '{{ route("letan.treatment_sheet.search") }}',
            dataType: 'json',
            delay: 250,
            data: params => ({ q: params.term }),
            processResults: data => {
                let results = data.map(item => ({
                    id: item.id,
                    text: item.text,
                    sdt: item.sdt,
                    diachi: item.diachi,
                    email: item.email
                }));
                return { results };
            },
            cache: true
        },
        createTag: function (params) {
            return {
                id: '__new__' + params.term,
                text: `🔧 Tạo khách mới: ${params.term}`,
                isNew: true,
                sdt: params.term
            };
        }
    });

    $('#khachhang').on('select2:select', function (e) {
        const data = e.params.data;

        if (data.isNew) {
            $('#khach-info').addClass('d-none');
            $('#tao-moi-khach').removeClass('d-none');
            $('#tenkh_new').val('');
            $('input[name="sdt_new"]').remove();
            $('<input>').attr({
                type: 'hidden',
                name: 'sdt_new',
                value: data.sdt
            }).appendTo('form');
            $('#chon-thu-cung').html(`<option value="">-- Nhập tên thú cưng mới --</option>`).trigger('change');
            togglePetNameInput('input');
        } else {
            $('#tao-moi-khach').addClass('d-none');
            $('#tenkh_new').val('');
            $('input[name="sdt_new"]').remove();

            $('#sdt').text(data.sdt);
            $('#diachi').text(data.diachi || '(Chưa cập nhật)');
            $('#email').text(data.email || '(Chưa cập nhật)');
            $('#khach-info').removeClass('d-none');

            $.get(`/letan/thu-cung/${data.id}`, function (pets) {
                let options = `<option value="">-- Chọn thú cưng --</option>`;
                pets.forEach(p => {
                    options += `<option value="${p.matc}" data-name="${p.tentc}" data-type="${p.maltc}">${p.tentc}</option>`;
                });
                $('#chon-thu-cung').html(options);
            });
        }
    });

    function togglePetNameInput(mode, name = '') {
        if (mode === 'select') {
            $('#selectPetName').show();
            $('#tentc').hide().val(name).prop('readonly', true);
        } else {
            $('#selectPetName').hide();
            $('#tentc').show().val('').prop('readonly', false).focus();
        }
    }

    $('#chon-thu-cung').on('change', function () {
        const selected = $(this).find(':selected');
        const matc = $(this).val();
        const name = selected.data('name');
        const type = selected.data('type');
        $('#matc_existing').val(matc || '');

        if (matc) {
            togglePetNameInput('select'); // 👉 chỉ hiển thị dropdown
            $('#tentc').val(name).prop('readonly', true);
            $('#maltc').val(type).prop('disabled', true);
        } else {
            togglePetNameInput('input'); // 👉 hiển thị ô input nhập mới
            $('#tentc').val('').prop('readonly', false);
            $('#maltc').val('').prop('disabled', false);
        }

        if (matc) {
            $('#tentc')
                .val(name)
                .addClass('d-none')
                .prop('readonly', true)
                .css('display', 'none'); // ẩn bằng style luôn để chắc
            $('#maltc').val(type).prop('disabled', true);
        } else {
            $('#tentc')
                .val('')
                .removeClass('d-none')
                .prop('readonly', false)
                .css('display', 'block'); // hiện lại khi chọn nhập mới
            $('#maltc').val('').prop('disabled', false);
        }
    });

    let dvIndex = 1, thuocIndex = 1;

    window.addDichVu = function () {
        let html = `
            <div class="row g-2 mb-2">
                <div class="col-md-6">
                    <select name="dichvu[${dvIndex}][madv]" class="form-select">
                        <option value="">-- Chọn dịch vụ --</option>
                        @foreach($dichvu as $dv)
                            <option value="{{ $dv->madv }}">{{ $dv->tendv }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                                <input type="hidden" name="dichvu[0][soluong]" value="1">
                            </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100" onclick="this.closest('.row').remove()">🗑</button>
                </div>
            </div>`;
        document.getElementById('dichvu-list').insertAdjacentHTML('beforeend', html);
        dvIndex++;
    };

    window.addThuoc = function () {
        let html = `
            <div class="row g-2 mb-2">
                <div class="col-md-6">
                    <select name="thuoc[${thuocIndex}][mathuoc]" class="form-select">
                        <option value="">-- Chọn thuốc --</option>
                        @foreach($thuoc as $t)
                            <option value="{{ $t->mathuoc }}">{{ $t->tenthuoc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" name="thuoc[${thuocIndex}][soluong]" class="form-control" value="1" min="1">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100" onclick="this.closest('.row').remove()">🗑</button>
                </div>
            </div>`;
        document.getElementById('thuoc-list').insertAdjacentHTML('beforeend', html);
        thuocIndex++;
    };
    });
</script>
@endpush
@endsection

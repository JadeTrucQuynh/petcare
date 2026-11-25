@extends('owner.owner_layout')
<title>
  Dashboard
</title>
@section('owner_content')
  <style>
    .custom-tooltip.bs-tooltip-auto[x-placement^=top] .tooltip-arrow::before,
    .custom-tooltip.bs-tooltip-top .tooltip-arrow::before {
    border-top-color: #28a745;
    /* màu mũi tên tooltip */
    }

    /* Khách hàng */
    .tooltip-khachhang {
    background-color: #e3f2fd;
    color: #0d47a1;
    border: 1px solid #42a5f5;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    padding: 8px 12px;
    font-size: 13px;
    max-width: 300px;
    }

    .tooltip-khachhang .tooltip-arrow::before {
    border-top-color: #42a5f5 !important;
    }

    /* Thú cưng */
    .tooltip-thucung {
    background-color: #f1f8e9;
    color: #33691e;
    border: 1px solid #81c784;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    padding: 8px 12px;
    font-size: 13px;
    max-width: 300px;
    }

    .tooltip-thucung .tooltip-arrow::before {
    border-top-color: #81c784 !important;
    }

    /* Doanh thu */
    .tooltip-doanhthu {
    background-color: #fff8e1;
    color: #f57f17;
    border: 1px solid #ffca28;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    padding: 8px 12px;
    font-size: 13px;
    max-width: 300px;
    }

    .tooltip-doanhthu .tooltip-arrow::before {
    border-top-color: #ffca28 !important;
    }
  </style>
  <div class="container py-4">
    <h3 class="mb-3">Tổng quan</h3>
    <form action="{{ route('owner.dashboard') }}" method="GET" class="row g-3">
    <div class="col-md-3">
      <input type="date" name="date" class="form-control" value="{{ request('date') }}">
    </div>
    <div class="col-md-3">
      <input type="month" name="month" class="form-control" value="{{ request('month') }}">
    </div>
    <div class="col-md-3">
      <select name="year" class="form-control">
      @for ($y = now()->year; $y >= 2020; $y--)
      <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
    @endfor
      </select>
    </div>
    <div class="col-md-3">
      <button class="btn btn-primary" type="submit">Lọc</button>
      <a href="{{ route('owner.dashboard') }}" class="btn btn-secondary">Xóa bộ lọc</a>
    </div>

    </form>
    <!-- Thống kê tổng quan -->
    <div class="row mb-4">
    {{-- Ô khách hàng --}}
    <div class="col-md-3 mb-3">
      <div class="card shadow border-start border-primary border-4" data-bs-toggle="tooltip" data-bs-html="true"
      data-bs-custom-class="tooltip-khachhang" title="
            @foreach ($dsKhachHang as $kh)
        {{ $kh->tenkh }}<br>
        @endforeach
            ">
      <div class="card-body">
        <h6 class="text-muted">👤 Khách hàng</h6>
        <h4 class="mb-0">{{ $soKhachHang }}</h4>
      </div>
      </div>
    </div>

    {{-- Ô thú cưng đã khám --}}
    <div class="col-md-3 mb-3">
      <div class="card shadow border-start border-success border-4" data-bs-toggle="tooltip" data-bs-html="true"
      data-bs-custom-class="tooltip-thucung" title="
            @foreach ($dsThuCungDaDuyet as $tc)
        {{ $tc->tentc }} - {{ $tc->khachhang->tenkh ?? 'Chưa rõ' }}<br>
        @endforeach
            ">
      <div class="card-body">
        <h6 class="text-muted">🐾 Thú cưng đã khám</h6>
        <h4 class="mb-0">{{ $soThuCungDaDuyet }}</h4>
      </div>
      </div>
    </div>

    {{-- Ô doanh thu --}}
    <div class="col-md-3 mb-3">
      <div class="card shadow border-start border-warning border-4" data-bs-toggle="tooltip" data-bs-html="true"
      data-bs-custom-class="tooltip-doanhthu" title="
            @foreach ($dsHoaDon as $hd)
        #HD0000{{ $hd->stthdon }} - {{ number_format($hd->tongtien, 0, ',', '.') }}đ<br>
        @endforeach
            ">
      <div class="card-body">
        <h6 class="text-muted">💰 Doanh thu</h6>
        <h4 class="mb-0">{{ number_format($tongDoanhThu, 0, ',', '.') }} đ</h4>
      </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow border-start border-danger border-4">
      <div class="card-body">
        <h6 class="text-muted">📅 Số lần điều trị</h6>
        <h4 class="mb-0">{{ $soLanDieuTri }}</h4>
      </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow border-start border-secondary border-4">
      <div class="card-body">
        <h6 class="text-muted">⏳ Lịch chờ duyệt</h6>
        <h4 class="mb-0">{{ $soLichChoDuyet }}</h4>
      </div>
      </div>
    </div>
    </div>
    <!-- Các thống kê khác sẽ đặt ở đây -->
    <h3 class="mb-3">Thống kê danh mục</h3>

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Doanh thu</h5>
            <input type="month" id="monthPicker" class="form-control w-auto d-none">
            <select id="filterDoanhThu" class="form-select w-auto">
                <option value="month">Theo tháng</option>
                <option value="quarter">Theo quý</option>
                <option value="year">Theo năm</option>
                <option value="day">Theo ngày</option>
                <option value="week">Theo tuần</option>
            </select>
        </div>
        <div class="card-body">
            <canvas id="doanhThuChart" height="120"></canvas>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thống kê số lượng điều trị theo loại thú cưng</h5>
            <select id="time-filter" class="form-select w-auto">
            <option value="day">Theo ngày</option>
            <option value="month" selected>Tháng</option>
            <option value="quarter">Quý</option>
            <option value="year">Năm</option>
            </select>
        </div>
        <div class="card-body">
            <canvas id="chartStackedThuCung" height="100"></canvas>
        </div>
    </div>

    <div class="card shadow mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thống kê số lượng dịch vụ/loại dịch vụ được sử dụng</h5>
            <select id="pie-filter" class="form-select w-auto">
            <option value="day">Theo ngày</option>
            <option value="week">Theo tuần</option>
            <option value="month" selected>Tháng</option>
            <option value="quarter">Quý</option>
            <option value="year">Năm</option>
            </select>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 d-flex justify-content-center">
                <div style="max-width:300px; width:100%;">
                    <h6 class="text-center">Thống kê dịch vụ được sử dụng</h6>
                    <canvas id="pieDichVu"></canvas>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <div style="max-width:300px; width:100%;">
                    <h6 class="text-center">Thống kê loại dịch vụ được sử dụng</h6>
                    <canvas id="pieLoaiDichVu"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Bạn có thể thêm các thống kê khác ở đây -->
  </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("doanhThuChart").getContext("2d");
    let doanhThuChart;

    function loadChart(filter = "month", value = null) {
        let url = "{{ route('owner.chartDoanhThuColumn') }}?filter=" + filter;
        if (value) url += "&value=" + value;

        fetch(url)
            .then(res => res.json())
            .then(data => {
                const labels = data.map(item => item.label);
                const totals = data.map(item => item.total);

                if (doanhThuChart) doanhThuChart.destroy();

                doanhThuChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Doanh thu (VNĐ)",
                            data: totals,
                            backgroundColor: "rgba(54, 162, 235, 0.6)",
                            borderColor: "rgba(54, 162, 235, 1)",
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return value.toLocaleString("vi-VN") + " đ";
                                    }
                                }
                            }
                        }
                    }
                });
            });
    }

    loadChart("month");

    const filterSelect = document.getElementById("filterDoanhThu");
    const monthPicker = document.getElementById("monthPicker");

    filterSelect.addEventListener("change", function () {
        if (this.value === "day") {
            monthPicker.classList.remove("d-none");
        } else {
            monthPicker.classList.add("d-none");
            loadChart(this.value);
        }
    });

    monthPicker.addEventListener("change", function () {
        if (filterSelect.value === "day") {
            loadChart("day", this.value);
        }
    });
});
</script>
{{-- ///////////////////////////////////////////////// --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  let chart;

  function fetchChartStacked(type = 'month') {
    fetch(`{{ route('owner.chart.thucung.stacked') }}?filter=${type}`)
        .then(res => res.json())
        .then(data => {
        let labels = [];
        if (type === 'month') {
            labels = Array.from({ length: 12 }, (_, i) => `Tháng ${i + 1}`);
        } else if (type === 'quarter') {
            labels = ['Quý 1 năm 2025', 'Quý 2 năm 2025', 'Quý 3 năm 2025', 'Quý 4 năm 2025'];
        } else if (type === 'year') {
            const startYear = 2020, endYear = new Date().getFullYear();
            labels = Array.from({ length: endYear - startYear + 1 }, (_, i) => `${startYear + i}`);
        } else if (type === 'day') {
            const daysInMonth = new Date().getFullYear() % 4 === 0 && new Date().getMonth() === 1 ? 29 : new Date().getDate();
            labels = Array.from({ length: 31 }, (_, i) => `Ngày ${i + 1}`);
        }

        // 🎨 Lấy danh sách loại thú cưng
        const types = [...new Set(data.map(d => d.loaithucung))];

        const datasets = types.map((typeName, i) => {
            return {
            label: typeName,
            data: labels.map(label => {
                const found = data.find(d => d.label === label && d.loaithucung === typeName);
                return found ? found.total : 0;
            }),
            backgroundColor: getColor(i)
            };
        });

        if (chart) chart.destroy();
        chart = new Chart(document.getElementById('chartStackedThuCung'), {
            type: 'bar',
            data: { labels, datasets },
            options: {
            responsive: true,
            plugins: {
                title: {
                display: true,
                text: 'So sánh số lượng điều trị theo thời gian'
                }
            },
            scales: {
                x: { stacked: true },
                y: { stacked: true, beginAtZero: true }
            }
            }
        });
        });
    }

  function getColor(index) {
    const colors = ['#3674B5', '#578FCA', '#A1E3F9', '#D1F8EF'];
    return colors[index % colors.length];
  }

  document.getElementById('time-filter').addEventListener('change', function () {
    fetchChartStacked(this.value);
  });

  fetchChartStacked();
});
</script>
{{-- ///////////////////////// --}}
<script>
function renderPieChart(canvasId, url, filter = 'month', value = null) {
  const params = new URLSearchParams({ filter });
  if (value) params.append('value', value);

  fetch(`${url}?${params.toString()}`)
    .then(res => res.json())
    .then(data => {
      const ctx = document.getElementById(canvasId);
      if (ctx.chart) ctx.chart.destroy(); // clear old chart if exists

      ctx.chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: data.map(i => i.label),
            datasets: [{
            data: data.map(i => i.total),
            backgroundColor: [
                "#3674B5",
                "#578FCA",
                "#A1E3F9",
                "#D1F8EF"
            ],
            borderColor: "#fff",
            borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
            legend: { position: 'bottom' },
            title: {
                display: true,
                text: canvasId === 'pieDichVu'
                ? 'Tỉ lệ dịch vụ được sử dụng'
                : 'Tỉ lệ theo loại dịch vụ'
            }
            }
        }
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
  const pieFilter = document.getElementById('pie-filter');
  const dateInput = document.querySelector('input[name="date"]');
  const monthInput = document.querySelector('input[name="month"]');
  const yearInput = document.querySelector('select[name="year"]');

  function getValue(filter) {
    if (filter === 'day' || filter === 'week') return dateInput?.value;
    if (filter === 'month' || filter === 'quarter') return monthInput?.value;
    if (filter === 'year') return yearInput?.value;
    return null;
  }

  function updateCharts() {
    const filter = pieFilter.value;
    const value = getValue(filter);
    renderPieChart('pieDichVu', '{{ route("owner.chart.dichvu") }}', filter, value);
    renderPieChart('pieLoaiDichVu', '{{ route("owner.chart.loaidichvu") }}', filter, value);
  }

  pieFilter.addEventListener('change', updateCharts);
  updateCharts();
});
</script>
{{-- /////////////////////////////////// --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(el => new bootstrap.Tooltip(el))
    });
</script>

@endsection

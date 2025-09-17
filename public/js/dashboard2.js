    // PERBAIKAN: Menggunakan $(function() { ... }) dari jQuery
    $(function() {
        // Menampilkan tanggal hari ini
        const dateElement = document.getElementById('current-date');
        const today = new Date();
        const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        if(dateElement) {
          dateElement.textContent = today.toLocaleDateString('id-ID', optionsDate);
        }

        // Grafik Statistik Pengunjung
        var optionsChart = {
          series: [{
            name: 'Pengunjung',
            data: [350, 480, 420, 550, 600, 580, 700]
          }],
          chart: {
            type: 'area',
            height: 300,
            zoom: { enabled: false },
            toolbar: { show: false },
          },
          dataLabels: { enabled: false },
          stroke: { curve: 'smooth', width: 2 },
          colors: ["var(--bs-primary)"],
          fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.4,
                opacityTo: 0.1,
                stops: [0, 90, 100]
            }
          },
          xaxis: {
            categories: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
          },
          grid: { borderColor: '#e5eaef', strokeDashArray: 4 },
        };
        
        var chart = new ApexCharts(document.querySelector("#visitor-stats-chart"), optionsChart);
        chart.render();
    });
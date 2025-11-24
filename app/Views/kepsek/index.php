<div class="container-fluid">
    <h2 class="mb-4">Guru Favorit</h2>
    <div>
        <canvas id="gupres"></canvas>
    </div>

     <h2 class="mb-4">Tenaga Kependidikan Favorit</h2>
    <div>
        <canvas id="tenpres"></canvas>
    </div>
</div>
<!-- https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.5.0/chart.min.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- <script src="<?= base_url('js/chart.min.js') ?>"></script> -->

<script>
    const gtx = document.getElementById('gupres');

    new Chart(gtx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '20 Besar Guru Favorit',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    const ttx = document.getElementById('tenpres');

    new Chart(ttx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '20 Besar Tenaga Kependidikan Favorit',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
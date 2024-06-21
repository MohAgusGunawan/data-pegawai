<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pencatatan Data Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .sidebar {
            flex: 1;
        }
        .charts-row {
            display: flex;
            flex-wrap: wrap; /* Add flex-wrap to handle responsiveness */
            gap: 20px;
            flex: 2;
        }
        .chart-container, .table-container {
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            flex: 1 1 calc(50% - 20px); /* Flex basis to take 50% width minus the gap */
            min-width: 300px; /* Ensure minimum width */
        }
        .chart-container canvas {
            width: 100%;
            height: 120px; /* Set a fixed height for the charts */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="table-container">
                <h4>Data Pegawai</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Departemen</th>
                            <th>Departemen</th>
                            <th>Departemen</th>
                            <th>Departemen</th>
                            <th>Departemen</th>
                            <th>Departemen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>Manager</td>
                            <td>HR</td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>Staff</td>
                            <td>IT</td>
                        </tr>
                        <tr>
                            <td>Mark Johnson</td>
                            <td>Intern</td>
                            <td>Marketing</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="charts-row">
            <div class="chart-container">
                <h4>Distribusi Pegawai per Departemen</h4>
                <canvas id="deptChart"></canvas>
            </div>
            <div class="chart-container">
                <h4>Distribusi Pegawai per Jabatan</h4>
                <canvas id="jobChart"></canvas>
            </div>
            <div class="chart-container">
                <h4>Riwayat Pekerjaan Pegawai</h4>
                <canvas id="historyChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const deptChartCtx = document.getElementById('deptChart').getContext('2d');
        const jobChartCtx = document.getElementById('jobChart').getContext('2d');
        const historyChartCtx = document.getElementById('historyChart').getContext('2d');

        const deptChart = new Chart(deptChartCtx, {
            type: 'pie',
            data: {
                labels: ['HR', 'IT', 'Marketing', 'Finance'],
                datasets: [{
                    label: 'Pegawai per Departemen',
                    data: [10, 20, 30, 15],
                    backgroundColor: ['#3498db', '#2ecc71', '#e74c3c', '#f1c40f']
                }]
            }
        });

        const jobChart = new Chart(jobChartCtx, {
            type: 'bar',
            data: {
                labels: ['Manager', 'Staff', 'Intern'],
                datasets: [{
                    label: 'Pegawai per Jabatan',
                    data: [5, 25, 10],
                    backgroundColor: ['#3498db', '#2ecc71', '#e74c3c']
                }]
            }
        });

        const historyChart = new Chart(historyChartCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Riwayat Pekerjaan Pegawai',
                    data: [3, 5, 2, 8, 6, 4],
                    backgroundColor: '#3498db',
                    borderColor: '#3498db',
                    fill: false
                }]
            }
        });
    </script>
</body>
</html>

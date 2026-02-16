<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Connect Hub - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-slate-900 text-white font-sans min-h-screen">

    <div class="container mx-auto p-8">
        <header class="mb-10 flex justify-between items-center border-b border-slate-700 pb-5">
            <h1 class="text-3xl font-extrabold tracking-tight">Connect <span class="text-blue-500">Hub</span></h1>
            <div id="sync-status" class="text-sm text-slate-400">Status: Sprawdzanie...</div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-slate-800 p-6 rounded-2xl shadow-xl border border-slate-700">
                <h2 class="text-xl font-semibold mb-6">Stan magazynowy wg kategorii</h2>
                <div class="h-[300px]">
                    <canvas id="inventoryChart"></canvas>
                </div>
            </div>

            <div class="bg-slate-800 p-6 rounded-2xl shadow-xl border border-slate-700">
                <h2 class="text-xl font-semibold mb-4">Szybkie akcje</h2>
                <button onclick="refreshData()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-all font-medium">
                    🔄 Odśwież dane z bazy
                </button>
                <div class="mt-6 p-4 bg-slate-900 rounded-lg text-slate-300 italic">
                    <p id="currency-info">Ładowanie kursów walut NBP...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        let myChart;

        async function refreshData() {
            const statusEl = document.getElementById('sync-status');
            const currencyInfo = document.getElementById('currency-info');
            
            statusEl.innerText = "Synchronizacja...";
            currencyInfo.innerText = "Pobieranie kursu...";

            try {
                const responseStats = await fetch('../api/get-stats.php');
                const stats = await responseStats.json();
                const labels = stats.map(item => item.label);
                const values = stats.map(item => item.total_stock);

                if (myChart) myChart.destroy();
                const ctx = document.getElementById('inventoryChart').getContext('2d');
                myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom', labels: { color: '#cbd5e1' } }
                        }
                    }
                });

                const responseCurrency = await fetch('../api/get-currency.php');
                const currencyData = await responseCurrency.json();

                if (currencyData.rate) {
                    currencyInfo.innerHTML = `Aktualny kurs 1 EUR = <span class="text-blue-400 font-bold">${currencyData.rate} PLN</span> (NBP)`;
                } else {
                    currencyInfo.innerText = "Nie udało się pobrać kursu walut.";
                }

                statusEl.innerText = "Ostatnia aktualizacja: " + new Date().toLocaleTimeString();

            } catch (error) {
                console.error("Błąd pobierania danych:", error);
                statusEl.innerText = "Błąd połączenia!";
                currencyInfo.innerText = "Błąd komunikacji z API.";
            }
        }

        refreshData();
    </script>
</body>
</html>
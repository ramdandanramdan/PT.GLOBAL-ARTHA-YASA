import "./bootstrap";

import Alpine from "alpinejs";

// --- BARU: Impor Chart.js ---
import Chart from "chart.js/auto"; // Gunakan 'chart.js/auto' untuk import otomatis

window.Alpine = Alpine;
window.Chart = Chart; // Jadikan Chart tersedia secara global jika Anda membutuhkannya

Alpine.start();

// --- BARU: Contoh SCRIPT INI HARUS DI PINDAHKAN KE FILE KHUSUS CHART ---
// Ini hanya untuk demonstrasi bahwa Chart.js sudah siap diimpor.
// Biasanya, Anda akan menempatkan logika chart di file terpisah (misalnya: analytics.js)
document.addEventListener("DOMContentLoaded", () => {
    const retentionChartElement = document.getElementById(
        "customer-retention-chart"
    );

    if (retentionChartElement && retentionChartElement.tagName !== "CANVAS") {
        // Ganti elemen placeholder <div> dengan elemen <canvas>
        const newCanvas = document.createElement("canvas");
        newCanvas.id = "customer-retention-canvas";
        retentionChartElement.parentNode.replaceChild(
            newCanvas,
            retentionChartElement
        );

        // Contoh sederhana chart
        new Chart(newCanvas, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei"],
                datasets: [
                    {
                        label: "Retensi Pelanggan",
                        data: [85, 82, 88, 79, 90],
                        borderColor: "rgb(75, 192, 192)",
                        tension: 0.1,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            },
        });
    }
});

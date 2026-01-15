<?php include "../auth/auth_check.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../assets/css/main.css">

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
</head>

<body class="dark">

<div id="exportArea">

<h2>🏆 Faculty Leaderboard</h2>
<p>Live competition between faculties</p>

<canvas id="leaderboardChart" height="120"></canvas>

<div id="leaderboardList" style="margin-top:30px;"></div>

</div>

<!-- ACTION BUTTON -->
<div style="margin-top:30px;">
  <button onclick="downloadPDF()">📄 Download PDF</button>

 <script>
function downloadPDF() {
  const tbody = document.getElementById("printTableBody");
  tbody.innerHTML = "";

  lastData.forEach((d, i) => {
    tbody.innerHTML += `
      <tr>
        <td style="border:1px solid #000;padding:6px;text-align:center;">
          ${i+101}
        </td>
        <td style="border:1px solid #000;padding:6px;">
          ${d.faculty}
        </td>
        <td style="border:1px solid #000;padding:6px;text-align:center;">
          ${d.score}
        </td>
      </tr>
    `;
  });

  document.getElementById("printDate").innerText =
    new Date().toLocaleString("id-ID");

  html2pdf()
    .set({
      margin: 10,
      filename: "faculty_leaderboard_report.pdf",
      image: { type: "jpeg", quality: 0.98 },
      html2canvas: {
        scale: 2,       // 🔥 bikin tajam
        useCORS: true
      },
      jsPDF: {
        unit: "mm",
        format: "a4",
        orientation: "portrait"
      }
    })
    .from(document.getElementById("printTemplate"))
    .save();
}
</script>


  <button onclick="downloadExcel()">📊 Download Excel</button>

  <script>
function downloadExcel() {
  const excelData = lastData.map((d, i) => ({
    No: i + 1,
    Faculty: d.faculty,
    Score: d.score
  }));

  const ws = XLSX.utils.json_to_sheet(excelData);

  ws["!cols"] = [
    { wch: 5 },
    { wch: 25 },
    { wch: 10 }
  ];

  const wb = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(wb, ws, "Leaderboard");

  XLSX.writeFile(wb, "faculty_leaderboard_report.xlsx");
}
</script>

</div>

<script>
let chart;
let lastData = [];

async function loadLeaderboard() {
  const res = await fetch("../api/leaderboard_data.php");
  const data = await res.json();
  lastData = data;

  const faculties = data.map(d => d.faculty);
  const scores = data.map(d => d.score);

  // ===== TEXT LEADERBOARD =====
  let html = "";
  data.forEach((d, i) => {
    let medal = i == 0 ? "🥇" : i == 1 ? "🥈" : i == 2 ? "🥉" : "🎖️";
    html += `<p>${medal} <b>${i+1}. ${d.faculty}</b> — ${d.score} pts</p>`;
  });
  document.getElementById("leaderboardList").innerHTML = html;

  // ===== CHART =====
  if (!chart) {
    chart = new Chart(document.getElementById("leaderboardChart"), {
      type: "bar",
      data: {
        labels: faculties,
        datasets: [{
          label: "Score",
          data: scores,
          backgroundColor: "#00eaff"
        }]
      },
      options: {
        responsive: true,
        animation: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { ticks: { color: "white" } },
          y: { ticks: { color: "white" }, beginAtZero:true }
        }
      }
    });
  } else {
    chart.data.labels = faculties;
    chart.data.datasets[0].data = scores;
    chart.update();
  }
}

// realtime refresh
loadLeaderboard();
setInterval(loadLeaderboard, 5000);

// ===== EXPORT =====
function downloadPDF() {
  html2pdf().from(document.getElementById("exportArea"))
    .set({ filename: "faculty_leaderboard.pdf" })
    .save();
}

function downloadExcel() {
  const ws = XLSX.utils.json_to_sheet(lastData);
  const wb = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(wb, ws, "Leaderboard");
  XLSX.writeFile(wb, "faculty_leaderboard.xlsx");
}
</script>

</body>
</html>
<!-- ===== TEMPLATE EXPORT (HIDDEN) ===== -->
<div id="printTemplate" style="display:none; color:#000; font-family:Arial;">
  
  <h2 style="text-align:center;margin-bottom:5px;">
    FACULTY LEADERBOARD REPORT
  </h2>

  <p style="text-align:center;margin-top:0;font-size:13px;">
    The Catalyst – Lab Survival Simulator
  </p>

  <hr>

  <table border="1" cellspacing="0" cellpadding="8" width="100%" style="border-collapse:collapse;font-size:13px;">
    <thead style="background:#f0f0f0;">
      <tr>
        <th>No</th>
        <th>Faculty</th>
        <th>Score</th>
      </tr>
    </thead>
    <tbody id="printTableBody"></tbody>
  </table>

  <p style="margin-top:15px;font-size:12px;">
    Generated at: <span id="printDate"></span>
  </p>

  <p style="text-align:center;margin-top:40px;font-size:11px;">
    © The Catalyst | Faculty Competition Report
  </p>

</div>

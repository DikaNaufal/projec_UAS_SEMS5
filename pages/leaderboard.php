<?php include "../auth/auth_check.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../assets/css/main.css">

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="dark">

<h2>🏆 Faculty Leaderboard</h2>
<p>Live competition between faculties</p>

<!-- Chart -->
<canvas id="leaderboardChart" height="120"></canvas>

<!-- Text Leaderboard -->
<div id="leaderboardList" style="margin-top:30px;"></div>

<script>
let chart;

async function loadLeaderboard() {
  const res = await fetch("../api/leaderboard_data.php");
  const data = await res.json();

  const faculties = data.map(d => d.faculty);
  const scores = data.map(d => d.score);

  // Render text list
  let html = "";
  data.forEach((d, i) => {
    html += `<p>🥇 ${i+1}. ${d.faculty} — <b>${d.score}</b> pts</p>`;
  });
  document.getElementById("leaderboardList").innerHTML = html;

  // Render / update chart
  if (!chart) {
    chart = new Chart(document.getElementById("leaderboardChart"), {
      type: "bar",
      data: {
        labels: faculties,
        datasets: [{
          label: "Highest Score",
          data: scores,
          backgroundColor: "#00eaff"
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false }
        },
        scales: {
          x: { ticks: { color: "white" } },
          y: { ticks: { color: "white" } }
        }
      }
    });
  } else {
    chart.data.labels = faculties;
    chart.data.datasets[0].data = scores;
    chart.update();
  }
}

// initial load
loadLeaderboard();

// realtime refresh every 5 seconds
setInterval(loadLeaderboard, 5000);
</script>

</body>
</html>

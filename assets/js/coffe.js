function brew() {
  let t = document.getElementById("temp").value;
  let time = (100 - t) * 2 + 60;
  document.getElementById("coffee").innerText =
    `Perfect brew time: ${time}s ☕`;
}

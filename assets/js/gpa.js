function predict() {
  let g = document.getElementById("gpa").value;
  let r = g >= 3.8 ? "Einstein begadang ☕"
        : g >= 3 ? "Pejuang skripsi"
        : "Tenang, Bill Gates juga di sini 😌";
  document.getElementById("out").innerText = r;
}

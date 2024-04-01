const myButton = document.getElementById("myButton");
const myH1 = document.getElementById("myH1");

myButton.addEventListener("click", function() {
  const newHello = document.createElement("div"); // Membuat elemen div baru
  newHello.textContent = "Hello World!"; // Menetapkan teks "Hello World!" pada elemen baru
  document.body.appendChild(newHello); // Menambahkan elemen baru ke dalam body
});

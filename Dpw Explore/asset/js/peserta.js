async function muatDaftarPeserta() {
  const tbody = document.querySelector("tbody");

  const res = await fetch("../data/peserta.json");

  const data = await res.json();

  tbody.innerHTML = "";

  data.forEach((peserta) => {
    tbody.innerHTML += `
        <tr>
            <td>${peserta.id}</td>
            <td>${peserta.nama}</td>
            <td>${peserta.jurusan}</td>
            <td>${peserta.email}</td>
            <td>${peserta.event}</td>
        </tr>
        `;
  });
}

document.addEventListener("DOMContentLoaded", muatDaftarPeserta);

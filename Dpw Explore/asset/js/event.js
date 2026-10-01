async function muatDaftarEvent() {
  const tbody = document.querySelector("tbody");

  const res = await fetch("../data/event.json");

  const data = await res.json();

  tbody.innerHTML = "";

  data.forEach((event) => {
    tbody.innerHTML += `
        <tr>
            <td>${event.id}</td>
            <td>${event.namaEvent}</td>
            <td>${event.kategori}</td>
            <td>${event.tanggal}</td>
            <td>${event.lokasi}</td>
            <td>${event.kuota}</td>
        </tr>
        `;
  });
}

document.addEventListener("DOMContentLoaded", muatDaftarEvent);

document.addEventListener("DOMContentLoaded", () => {
  const heute = new Date().toLocaleDateString("de-CH", {
    weekday: "long",
    day: "numeric",
    month: "long"
  });
  document.getElementById("heute").textContent = heute;

  // Tagesprogramm (Testdaten)
  const eintraege = [
    { zeit: "10:00", titel: "Gedächtnistraining", ort: "Sonnenstube", kategorie: "gedaechtnis" },
    { zeit: "14:00", titel: "Spaziergang", ort: "Garten", kategorie: "bewegung" },
    { zeit: "16:00", titel: "Kreativstunde", ort: "Atelier", kategorie: "kreativ" }
  ];

  const container = document.querySelector(".kachel-container");

  eintraege.forEach(eintrag => {
    const kachel = document.createElement("div");
    kachel.className = `kachel ${eintrag.kategorie}`;
    kachel.innerHTML = `<strong>${eintrag.zeit}</strong> – ${eintrag.titel} <br><small>${eintrag.ort}</small>`;
    container.appendChild(kachel);
  });

  // Menüplan (Testdaten)
  document.getElementById("mittag").textContent = "Kartoffelgratin mit Gemüse";
  document.getElementById("abend").textContent = "Tomatensuppe & Toast";
});
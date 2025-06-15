# 🕰️ Heimzeit WebApp

**Heimzeit** ist eine WebApp für das Pflegepersonal eines Altersheims. Sie unterstützt den Alltag durch folgende Funktionen:

- 📆 **Einträge erstellen** (Aktivitäten, Menüpläne, Events etc.)
- ✅ **Personalisierte To-do-Listen** für Mitarbeitende
- 👁️ **Bewohneransicht** (öffentliche Übersicht der geplanten Aktivitäten)
- 🍽️ **Menü-Ansicht** mit wöchentlichem Überblick
- 🔒 **Registrierung, Login, Authentifizierung**
- 🧠 **Modernes, barrierefreies UI** auf Basis eines Figma-Mockups

---

## 🛠️ Technologien

| Bereich           | Tech                 |
|------------------|----------------------|
| Frontend         | HTML, CSS, JavaScript |
| Backend          | PHP                  |
| Datenbank        | MySQL (phpMyAdmin via Infomaniak) |
| Hosting          | Infomaniak Webhosting |
| Versionierung    | Git / GitHub         |

---

## 🚀 Features im Überblick

### 🔐 Login & Registrierung
- Passwort-Hashing (bcrypt)
- Authentifizierung via Sessions
- .gitignore schützt sensible Dateien (`config.php`, `sftp.json` etc.)

### 🧾 Dashboard
- Neue Einträge mit Datum, Zeit, Ort, Kategorie, Beschreibung
- Bearbeiten bestehender Einträge
- Visuelles Feedback (z. B. "Eintrag gespeichert ✅")

### ✅ To-do-Liste
- Aufgaben anlegen, erledigen, löschen
- Nur für eingeloggte User sichtbar
- Aufgaben nach Nutzer-E-Mail gefiltert

### 🧑‍🦳 Bewohneransicht
- Übersicht aller kommenden Aktivitäten
- Sortiert nach Datum und Uhrzeit
- Mit Icons und farblicher Kodierung je Kategorie

### 🍽️ Menü-Ansicht
- Extra-Ansicht nur für Menü-Einträge
- Menüplan pro Tag einsehbar und bearbeitbar

---

## 📦 Projektstruktur (Auszug)

```bash
/Heimzeit
├── auth-check.php
├── config.php           # (durch .gitignore geschützt)
├── dashboard.php
├── login.php / login.html
├── register.php / register.html
├── view-entries.php     # Bewohneransicht
├── menu-view.php        # Menüübersicht
├── edit-entry.php       # Bearbeiten bestehender Einträge
├── save-entry.php / update-entry.php
├── save-todo.php / toggle-todo.php / delete-todo.php
├── style.css
└── .gitignore
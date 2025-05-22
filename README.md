
# 🐾 PetLocaliza

**PetLocaliza** is a simple and intuitive web application designed to help people find their lost pets or report animals they have found on the streets. The goal is to facilitate reunions between pets and their owners, promoting community support and quick communication.

## 🚀 Features

- 📌 Register reports of lost or found animals.
- 📍 Display reports in cards with relevant information (name, location, contact, etc).
- 🔍 Allow users to browse and filter posts.
- 📱 Responsive design with mobile support (PWA).
- 🔗 Integration with WhatsApp to facilitate contact between users.

## 🧰 Technologies Used

- **HTML5, CSS3, and JavaScript** – structure, style, and interactivity.
- **PHP** – backend logic and data integration.
- **JSON** (`data/datas.json`) – simulates a local database of animal reports.
- **MySQL (optional)** – the system is flexible and can be adapted to use a real database instead of JSON.
- **PWA (Progressive Web App)** – allows the site to be installed as a mobile app.

## 🗂 Project Structure

```
PetLocaliza/
├── index.php                # Main page
├── css/
│   └── style.css            # Custom styles
├── js/
│   └── script.js            # Interaction scripts
├── data/
│   └── datas.json           # Simulated report data
├── img/
│   └── icons/               # Icons and images
├── manifest.json           # PWA configuration
└── ...
```

## ⚙️ How to Use

1. **Clone the repository:**

   ```bash
   git clone https://github.com/joaopssouza/PetLocaliza.git
   cd petlocaliza
   ```

2. **Run on a local server** (PHP recommended):

   You can use XAMPP, WampServer, or PHP's built-in server:

   ```bash
   php -S localhost:8000
   ```

   Then open in your browser: [http://localhost:8000](http://localhost:8000)

3. **(Optional) Configure with MySQL:**

   - Create a database and the appropriate table.
   - Replace the logic that reads from `datas.json` with real database access using `mysqli` or `PDO`.
   - Add your credentials to `index.php` or a separate config file.

## 💡 Notes

- The project uses fictional data from the `datas.json` file for simulation. You can edit this file or implement a real database connection.
- The design and colors were chosen to reflect nature and care for animals, using tones like green and brown.

## 📸 Demo

*(You can include screenshots or a link to a live version of the project here)*
"# PetLocaliza" 

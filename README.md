
# 🐾 PetLocaliza

PetLocaliza is a web application that facilitates the dissemination of lost or found animals. With a simple and objective interface, it allows users to register information, consult by location, and maintain a flexible database that can be adapted for various solutions.

![PetLocaliza](./img/icons/icon-192.png)

---

## 🚀 Technologies Used

- **HTML5**
- **CSS3**
- **JavaScript (ES6)**
- **PHP**
- **JSON** → Local database (`datas.json`), which can be easily migrated to NoSQL databases like **Firebase** or **MongoDB**.

---

## 🛠️ Features

- ✅ Register lost or found animals.
- ✅ Search and auto-fill address via ZIP code.
- ✅ Delete records.
- ✅ Ready-to-use **Progressive Web App (PWA)** structure.
- ✅ Responsive interface.

---

## 🔗 APIs and Services

- **ViaCEP API** → Address lookup by ZIP code: [https://viacep.com.br](https://viacep.com.br)

---

## 🗂️ Data Structure

The data is currently stored in `data/datas.json`, but the project can be easily adapted to use **NoSQL** databases such as:

- **Firebase Firestore**
- **MongoDB**
- **CouchDB**

---

## 📦 How to Use

### ✔️ Prerequisites:

- Server with **PHP** support (Apache, Nginx, etc.).
- Modern web browser (for PWA compatibility).

### ✔️ Steps:

1. **Clone the repository:**
```bash
git clone https://github.com/yourusername/PetLocaliza.git
```

2. **Set up the local server:**
- Place the folder in a PHP environment (e.g., `htdocs` for XAMPP or `www` for WAMP).

3. **Access via browser:**
```
http://localhost/PetLocaliza/
```

4. **Use the application:**
- Register new cases.
- View registered animals.
- Edit or delete as needed.

---

## 💡 Customization

- The default storage (`data/datas.json`) can be replaced by a NoSQL database as needed.
- The `manifest.json` is already configured for PWA and can be adjusted with your specific app name and icons.
- Styles can be customized in `css/style.css`.

---

## 📄 License

This project is licensed under the terms of the [LICENSE](./LICENSE) file.

---

## 📸 Demo

https://github.com/user-attachments/assets/6f5c7984-7be1-46d7-babc-dc3f8f83a816

<img src="https://i.ibb.co/nMkrK4cf/Captura-de-tela-2025-05-24-013800.png" width="45%" />

<img src="https://i.ibb.co/XxN7f0yS/Screenshot-20250524-013928-Edge.jpg" width="45%" />

---


## 🤝 Contributions

Contributions are welcome! Feel free to open issues or submit pull requests.

---

## 📧 Contact

For questions or suggestions, please contact:

- **João Paulo**
- **[LinkedIn](https://www.linkedin.com/in/ap-joao-paulo/)**

---

🐾 **PetLocaliza — Because every animal deserves to find their way home.**



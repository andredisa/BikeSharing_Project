# 🚲 Bike Sharing Management System

![Made With PHP](https://img.shields.io/badge/Made%20With-PHP-blue?style=flat-square)
![PostgreSQL](https://img.shields.io/badge/Database-PostgreSQL-blue?style=flat-square)
![Python](https://img.shields.io/badge/WebService-Python-yellow?style=flat-square)

>This is a **bike sharing management system**. The project allows user registration and authentication, management of bicycles and docking stations, operation monitoring, and smart card handling. It includes a user interface for guests, clients, and administrators, as well as an admin panel for system maintenance and control.

---

## 🛠️ Setup & Configuration

### ⚙️ Requirements

- `PHP` >= 8.0  
- `Python` >= 3.9  
- `PostgreSQL` (for the database)  
- `Local web server` (e.g., Apache or Nginx)  
- `Composer` (optional, for managing PHP dependencies)  
- `Virtualenv` (optional, for managing Python environments)

### 📦 Installation

1. **Clone this repository:**
   ```bash
   git clone https://github.com/andredisa/BikeSharing_Project.git
   cd Bike_Sharing
   ```

2. **(Optional) Create a virtual environment for Python:**
   ```bash
   cd web_services
   python3 -m venv venv
   source venv/bin/activate
   ```

3. **Install the required Python libraries (e.g., Flask, psycopg2):**
   ```bash
   pip install flask psycopg2
   ```
4. **Run the Python web services:**
   ```bash
   python app.py
   ```

5. **Start the PHP server from the project root:**
   ```bash
   php -S localhost:8000
   ```
---

## 🧠 Database

🔒 **The SQL file for the database has been intentionally hidden.**

> 🧾 However, the entire schema can be easily **reconstructed** using the provided **Entity-Relationship (ER) diagram**, which outlines all entities and their relationships, including:

- 👥 Users  
- 💳 Credit Cards  
- 📇 Smart Cards  
- 🚲 Bicycles  
- 🛠️ Operations  
- 📍 Docking Stations  

> 📌 All **primary and foreign keys** are clearly defined for easy replication.

You can use tools such as:

- [pgModeler](https://pgmodeler.io/)
- [DBeaver](https://dbeaver.io/)
- [DBDiagram.io](https://dbdiagram.io/)  

>to design and recreate the database schema visually.

---

## 🔐 Features

Here’s a quick overview of the system’s key features:

- ✅ **User registration and authentication**
- 🚴 **Bike rental and return via RFID smart card**
- 🗺️ **Real-time map of available bikes and stations**
- 💳 **Payment processing via credit card**
- 👤 **Personal dashboard with usage history**
- 🛠️ **Admin panel for service operations and maintenance**
- 🔁 **Python-powered RESTful web services**

---

## 🧪 Manual Testing

To test the project manually, follow these steps:

1. 🧩 Recreate the database based on the ER diagram  
2. 🐍 Run the Python web services (`app.py`)  
3. 🌐 Start the PHP server and access the app through your browser  

> 🧪 Manual testing is enough to explore most of the core features and flows.

---

## ✨ Contributing

🎉 **Contributions are more than welcome!**

If you find a bug 🐞, have a feature request ✨, or want to improve the code 💻:

- Open an [Issue](https://github.com/andredisa/BikeSharing_Project/issues)  
- Submit a [Pull Request](https://github.com/andredisa/BikeSharing_Project/pulls) 🚀  

>💬 Feel free to reach out on [GitHub](https://github.com/andredisa) or by [email](mailto:andreadisanti22@gmail.com)!

Let’s build this together!


---

## 📜 License

📄 This project is released under the **MIT License**.  
Please refer to the [LICENSE](LICENSE) file for full details.

---

### 🧑‍💻✨ Happy coding

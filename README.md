# CodeIgniter Assignment

This repository contains two projects: **AuthMicroservice** and **CRUDService**, built with **CodeIgniter 3**.

**AuthMicroservice** handles user management, including new user creation and issuing an authentication token to existing users via APIs.
**CRUDService** enforces **Authorization** for item management, allowing CRUD operations only for API requests with a valid token.



## Table of Contents
- [About the Project](#about-the-project)
- [Tech Stack](#tech-stack)
- [Requirements](#requirements)
- [Setup](#setup)
- [WorkFlow](#workflow-only-if-using-single-xampp)
- [Usage](#usage)
- [Screenshots](#screenshots)
- [Important Code Pages](#important-code-pages)

---

## About the Project

This repo contains two separate projects, **AuthMicroservice** and **CRUDService**, both built using **CodeIgniter 3**.

* **AuthMicroservice**: Deals with **new user creation** and **issuing a token** upon successful authentication via APIs.
* **CRUDService**: Provides **Authorization** for Item management, allowing **CRUD** (Create, Read, Update, Delete) operations only to API requests that possess a **valid token** issued by the AuthMicroservice.

---

## Tech Stack:

* **Framework**: CodeIgniter 3
* **Server/Database**: XAMPP (Apache - PHP Compatible Server, MySQL database)

---

## Requirements:

* **CodeIgniter 3**: [Download CodeIgniter 3](https://www.codeigniter.com/download)
* **XAMPP Bundle**: [Download XAMPP](https://www.apachefriends.org/download.html)
    > **Note**: XAMPP provides a built-in Apache Server and MySQL database. You can use any other PHP compatible server and database setup. The instruction below assumes XAMPP.

---

## Setup

Since AuthMicroservice and CRUDService are two separate applications, they ideally need to be run on separate Apache servers. XAMPP typically provides a single Apache instance. To simplify the setup for demonstration, follow the **Single Setup** process.

### Single Setup for both Projects (Recommended)

1.  Open the **XAMPP Control Panel** (Windows) / **manager-osx** (macOS).
2.  Start the **MySQL Database** and **Apache Web Server**.
3.  Go to **phpMyAdmin** (e.g., `http://localhost/phpmyadmin/`).
4.  Create the databases:
    * Copy and run the SQL script from `auth_db.sql` to create the **AuthMicroservice** database.
    * Copy and run the SQL script from `crud_db.sql` to create the **CRUDService** database.
5.  Download the project files (AuthMicroservice and CRUDService folders).

### Setup if you have separate Xampp software or if you are using virtualization (Original Process)

#### Setup for AuthMicroservice

1.  Download the project's zip folder.
2.  Open the first XAMPP Control Panel.
3.  Start the **MySQL Database** and **Apache Web Server**.
4.  Navigate to the XAMPP installation directory and find the **`htdocs`** folder.
5.  Place the **`AuthMicroservice`** folder inside **`htdocs`**.
6.  In a browser, go to `http://localhost/phpmyadmin/` or `http://<server IP address>/phpmyadmin/`.
7.  Copy and run the SQL script from **`auth_db.sql`** to create the necessary database and tables.

#### Setup for CRUDService

1.  Download the project's zip folder.
2.  Open the second XAMPP Control Panel (or configure the second virtual host/server).
3.  Start the **MySQL Database** and **Apache Web Server**.
4.  Navigate to the second server's **`htdocs`** folder.
5.  Place the **`CRUDService`** folder inside **`htdocs`**.
6.  In a browser, go to `http://localhost/phpmyadmin/` or `http://<server IP address>/phpmyadmin/`.
7.  Copy and run the SQL script from **`crud_db.sql`** to create the necessary database and tables.

> **Important Note:** If you only have one XAMPP software without virtualization, you can only run **one project at a time**. You must place the required project folder (`AuthMicroservice` or `CRUDService`) in the `htdocs` folder and remove the other.

---

## WorkFlow (Only if using Single XAMPP)

Follow this sequence to test the microservices setup:

1.  Follow the **Single Setup for both Projects** steps to create both databases.
2.  Place the **`AuthMicroservice`** folder in the XAMPP **`htdocs`** folder.
3.  Send API requests for **SignUp** and **LogIn** to `http://localhost/AuthMicroservice`.
4.  **Store the received token** from the successful login response.
5.  **Remove** the `AuthMicroservice` folder and **place** the **`CRUDService`** folder in **`htdocs`**.
6.  Perform **CRUD operations** by sending APIs to `http://localhost/CRUDService`, including the **stored token** in the request headers for authorization.

---

## Usage

> **Note**: You can make direct API calls or use tools like **Postman** or **Insomnia**. All API calls must use the **raw JSON format** for the request body, as detailed below.

### AuthMicroservice

#### **SignUp** (Create New User)
* **API**: `http://localhost/AuthMicroservice/SignUp`
* **Method**: `POST` (Note: The document says GET, but API submission for data creation should typically be POST)
* **Body (raw JSON)**:
    ```json
    {
        "username": "enter your username",
        "password": "enterpassword",
        "email": "enter email",
        "role": "enter role"
    }
    ```

#### **SignIn** (Authenticate User)
* **API**: `http://localhost/AuthMicroservice/SignIn`
* **Method**: `POST` (Note: The document says GET, but API submission for authentication should typically be POST)
* **Body (raw JSON)**:
    ```json
    {
        "username": "enter your username",
        "password": "enterpassword"
    }
    ```
* **Successful API Response**:
    ```json
    {
        "status": "true",
        "message": "Login Successful",
        "token": "your secret token",
        "expires_in": 18000,
        "user": {User object}
    }
    ```

### CRUDService

All CRUDService API requests require the `Authorization` header.

* **Headers**:
    * `Content-Type`: `application/json`
    * `Authorization`: `Bearer {token fetched from AuthMicroservice}`

#### **Create Item**
* **API**: `http://localhost/CRUDService/items`
* **Method**: `POST`
* **Body (raw JSON)**:
    ```json
    {
        "name": "item name",
        "description": "item description",
        "price": price
    }
    ```

#### **Get all Items**
* **API**: `http://localhost/CRUDService/items`
* **Method**: `GET`
* **Successful API Response**:
    ```json
    {
        "status": true,
        "data": [list of all items objects]
    }
    ```

#### **Get one Item**
* **API**: `http://localhost/CRUDService/items/{id}` (e.g., `http://localhost/CRUDService/items/1`)
* **Method**: `GET`
* **Successful API Response**:
    ```json
    {
        "status": true,
        "data": {item object}
    }
    ```

#### **Update Item**
* **API**: `http://localhost/CRUDService/items/{id}` (e.g., `http://localhost/CRUDService/items/1`)
* **Method**: `PUT`
* **Body (raw JSON)**:
    ```json
    {
        "name": "updated item name",
        "description": "updated item description",
        "price": updated price
    }
    ```

#### **Delete Item**
* **API**: `http://localhost/CRUDService/items/{id}` (e.g., `http://localhost/CRUDService/items/1`)
* **Method**: `DELETE`

---

## Screenshots

* **SignUp**
    ![SignUp](</Media/SignUp.png>)

* **SignIn**
    ![SignIn](</Media/SignIn.png>)

* **Creating an Item**
    ![Create a item](</Media/CreateItem.png>)

* **Get all Items**
    ![Get all items](</Media/GetAllItems.png>)

* **Get one Item**
    ![Get one item](</Media/GetOneItem.png>)

* **Update Item**
    ![Update item](</Media/UpdateItem.png>)

* **Delete Item**
    ![Delete item](</Media/DeleteItem.png>)


## Important Code Pages:

### **AuthMicroService**

* **[SignIn.php](/AuthMicroservice/application/controllers/SignIn.php)** (Controller for user sign in)
* **[SignUp.php](/AuthMicroservice/application/controllers/SignUp.php)** (Controller for user sign up)
* **[config.php](/AuthMicroservice/application/config/config.php)** (General CodeIgniter configuration)
* **[autoload.php](/AuthMicroservice/application/config/autoload.php)** (Autoloading libraries/helpers)
* **[User_model.php](/AuthMicroservice/application/models/User_model.php)** (Database interaction for users)
* **[database.php](/AuthMicroservice/application/config/database.php)** (Database connection settings)
* **[.htaccess](https://github.com/rishiksailaxdbc/CodeIgniter-Assignment/blob/main/AuthMicroservice/.htaccess)** (URL rewriting)

### **CRUDService**

### **CRUDService**

* **[Authorization_Token.php](/CRUDService/application/libraries/Authorization_Token.php)** (Library/Helper for token validation/authorization logic)
* **[Items.php](/CRUDService/application/controllers/Items.php)** (Controller for CRUD operations on items)
* **[config.php](/CRUDService/application/config/config.php)** (General CodeIgniter configuration)
* **[autoload.php](/CRUDService/application/config/autoload.php)** (Autoloading libraries/helpers)
* **[Item_model.php](/CRUDService/application/models/Item_model.php)** (Database interaction for items)
* **[database.php](/CRUDService/application/config/database.php)** (Database connection settings)
* **[.htaccess](https://github.com/rishiksailaxdbc/CodeIgniter-Assignment/blob/main/CRUDService/.htaccess)** (URL rewriting)
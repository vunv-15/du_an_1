<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - EduBook</title>
    <script src="./assets/js/jquery-3.3.1.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/fonts/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/home.css">
    <link rel="stylesheet" href="./assets/css/product.css">
    <link rel="stylesheet" href="./assets/css/cart.css">
    <link rel="stylesheet" href="./assets/css/category.css">
    <style>
        /* CSS cho dropdown */
.header__top-item {
    position: relative;
}

.header__top-item .dropdown-menu {
    display: none;
    position: absolute;
    top: 100%; /* Hiển thị bên dưới mục chính */
    left: 0;
    background-color: white;
    border: 1px solid #ddd;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    list-style: none;
    padding: 0;
    margin: 0;
    z-index: 10;
}

.header__top-item .dropdown-menu li {
    padding: 10px;
    text-align: left;
}

.header__top-item .dropdown-menu li a {
    text-decoration: none;
    color: #333;
}

.header__top-item .dropdown-menu li a:hover {
    color: red;
}

/* Hiển thị dropdown khi di chuột */
.header__top-item:hover .dropdown-menu {
    font-size: 26px;
    display: block;
}

    </style>
</head>
<body>
    <div class="app">
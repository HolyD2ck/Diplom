<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Product Page
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header .left img {
            height: 40px;
            margin-right: 20px;
        }

        .header .right a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
        }

        .search-bar {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            background-color: #333;
        }

        .search-bar .catalog {
            margin-right: 10px;
        }

        .search-bar input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
            max-width: 300px;
        }

        .search-bar button {
            background-color: #e30613;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .catalog {
            position: relative;
        }

        .catalog button {
            background-color: #e30613;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .catalog-content {
            display: none;
            position: absolute;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1;
            top: 100%;
            left: 0;
            width: 200px;
        }

        .catalog-content a {
            color: #333;
            padding: 10px;
            display: block;
            text-decoration: none;
        }

        .catalog-content a:hover {
            background-color: #f5f5f5;
        }

        .catalog:hover .catalog-content {
            display: block;
        }

        .main-content {
            padding: 20px;
        }

        .main-content h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .product-carousel {
            position: relative;
        }

        .product-list {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding-bottom: 10px;
            scrollbar-width: none;
            /* Firefox */
        }

        .product-list::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Opera */
        }

        .product-item {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-right: 20px;
            min-width: 250px;
            flex: 0 0 auto;
        }

        .product-item img {
            max-width: 100%;
            border-radius: 5px;
        }

        .product-item .title {
            font-size: 16px;
            font-weight: 500;
            margin: 10px 0;
        }

        .product-item .rating {
            color: #f00;
            margin-bottom: 10px;
        }

        .product-item .price {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .product-item .old-price {
            text-decoration: line-through;
            color: #999;
            margin-left: 10px;
        }

        .product-item .discount {
            color: #f00;
            margin-left: 10px;
        }

        .product-item .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-item .actions button {
            background-color: #e30613;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .carousel-control-prev,
        .carousel-control-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 5px;
            cursor: pointer;
            font-size: 20px;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carousel-control-prev {
            left: -15px;
        }

        .carousel-control-next {
            right: -15px;
        }

        .ad-carousel {
            margin-top: 40px;
        }

        .ad-carousel img {
            width: 100%;
            border-radius: 5px;
        }

        .footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 left d-flex align-items-center">
                    <img alt="Logo" height="40"
                        src="https://storage.googleapis.com/a1aa/image/fezeVGN9pPRjXpZVaQDx2QREBa8MSeWWZgMA8WfV6ZOphfpAF.jpg"
                        width="100" />
                </div>
                <div class="col-md-6 right text-right">
                    <a href="#">
                        Контакты
                    </a>
                    <a href="#">
                        О нас
                    </a>
                    <a href="#">
                        Зарегистрироваться
                    </a>
                    <a href="#">
                        <i class="fas fa-shopping-cart">
                        </i>
                    </a>
                </div>
            </div>
        </div>
        <div class="search-bar container">
            <div class="catalog">
                <button>
                    Каталог
                </button>
                <div class="catalog-content">
                    <a href="#">
                        Смартфоны
                    </a>
                    <a href="#">
                        Телевизоры
                    </a>
                    <a href="#">
                        Стиральные машины
                    </a>
                    <a href="#">
                        Ноутбуки
                    </a>
                    <a href="#">
                        Микроволновки
                    </a>
                    <a href="#">
                        Холодильники
                    </a>
                </div>
            </div>
            <input class="form-control" placeholder="Искать подарки к новому году" type="text" />
            <button>
                <i class="fas fa-search">
                </i>
            </button>
        </div>
    </div>
    <div class="main-content container">
        <h2>
            Хиты продаж
        </h2>
        <div class="product-carousel">
            <button class="carousel-control-prev" onclick="scrollCarousel(-1)">
                <i class="fas fa-chevron-left">
                </i>
            </button>
            <div class="product-list">
                <div class="product-item">
                    <img alt="Смартфон POCO M6 Pro 12/512 Gb Black" height="200"
                        src="https://storage.googleapis.com/a1aa/image/kwXWj7EnBhooO1zTvCBkp9NLyr6ebeN6FovS98SJjNmV8nCUA.jpg"
                        width="200" />
                    <div class="title">
                        Смартфон POCO M6 Pro 12/512 Gb Black
                    </div>
                    <div class="rating">
                        <i class="fas fa-star">
                        </i>
                        4.9
                        <span>
                            228 отзывов
                        </span>
                    </div>
                    <div class="price">
                        22 999 ₽
                        <span class="old-price">
                            29 999 ₽
                        </span>
                        <span class="discount">
                            -23%
                        </span>
                    </div>
                    <div class="actions">
                        <button>
                            <i class="fas fa-shopping-cart">
                            </i>
                        </button>
                    </div>
                </div>
                <div class="product-item">
                    <img alt="Телевизор TCL 55C655 Pro" height="200"
                        src="https://storage.googleapis.com/a1aa/image/tnw61eZ5elhzaUWzWnAg8dUFcTmy9jLHnDOIV6FL0gUK8nCUA.jpg"
                        width="200" />
                    <div class="title">
                        Телевизор TCL 55C655 Pro
                    </div>
                    <div class="rating">
                        <i class="fas fa-star">
                        </i>
                        4.6
                        <span>
                            36 отзывов
                        </span>
                    </div>
                    <div class="price">
                        49 999 ₽
                        <span class="old-price">
                            68 999 ₽
                        </span>
                        <span class="discount">
                            -27%
                        </span>
                    </div>
                    <div class="actions">
                        <button>
                            <i class="fas fa-shopping-cart">
                            </i>
                        </button>
                    </div>
                </div>
                <div class="product-item">
                    <img alt="Стиральная машина узкая Hisense WFQP6012VM" height="200"
                        src="https://storage.googleapis.com/a1aa/image/2KT8teBiQftYpUMBJjhYzlfmKff6fgzsIDdRCfGXfD8aR8nCUA.jpg"
                        width="200" />
                    <div class="title">
                        Стиральная машина узкая Hisense WFQP6012VM
                    </div>
                    <div class="rating">
                        <i class="fas fa-star">
                        </i>
                        4.9
                        <span>
                            464 отзыва
                        </span>
                    </div>
                    <div class="price">
                        29 999 ₽
                        <span class="old-price">
                            48 999 ₽
                        </span>
                        <span class="discount">
                            -38%
                        </span>
                    </div>
                    <div class="actions">
                        <button>
                            <i class="fas fa-shopping-cart">
                            </i>
                        </button>
                    </div>
                </div>
                <div class="product-item">
                    <img alt="Ноутбук игровой Thunderobot 911 X Wild/15/Core i5" height="200"
                        src="https://storage.googleapis.com/a1aa/image/MXCQOeL7jAwoFyBzoeVgohKqe9T8cv7wb7Q9NMZZGUAm4PFoA.jpg"
                        width="200" />
                    <div class="title">
                        Ноутбук игровой Thunderobot 911 X Wild/15/Core i5
                    </div>
                    <div class="rating">
                        <i class="fas fa-star">
                        </i>
                        4.7
                        <span>
                            136 отзывов
                        </span>
                    </div>
                    <div class="price">
                        89 999 ₽
                        <span class="old-price">
                            124 999 ₽
                        </span>
                        <span class="discount">
                            -28%
                        </span>
                    </div>
                    <div class="actions">
                        <button>
                            <i class="fas fa-shopping-cart">
                            </i>
                        </button>
                    </div>
                </div>
                <div class="product-item">
                    <img alt="Микроволновая печь solo Gorenje MO17E1W" height="200"
                        src="https://storage.googleapis.com/a1aa/image/RggqKf3xNuQWFSbNWHleYNhia0mwMn2QOF6NS7XBTs5Q8nCUA.jpg"
                        width="200" />
                    <div class="title">
                        Микроволновая печь solo Gorenje MO17E1W
                    </div>
                    <div class="rating">
                        <i class="fas fa-star">
                        </i>
                        4.4
                        <span>
                            1131 отзыв
                        </span>
                    </div>
                    <div class="price">
                        6 499 ₽
                        <span class="old-price">
                            7 599 ₽
                        </span>
                        <span class="discount">
                            -14%
                        </span>
                    </div>
                    <div class="actions">
                        <button>
                            <i class="fas fa-shopping-cart">
                            </i>
                        </button>
                    </div>
                </div>
                <div class="product-item">
                    <img alt="Холодильник Gorenje NRK6202AXL4 серебристый" height="200"
                        src="https://storage.googleapis.com/a1aa/image/18qKUUgKRrrUO5JjCcUOyTh3I1Zr0fbEFRQIr97r4DWGenCUA.jpg"
                        width="200" />
                    <div class="title">
                        Холодильник Gorenje NRK6202AXL4 серебристый
                    </div>
                    <div class="rating">
                        <i class="fas fa-star">
                        </i>
                        4.8
                        <span>
                            699 отзывов
                        </span>
                    </div>
                    <div class="price">
                        56 999 ₽
                        <span class="old-price">
                            78 999 ₽
                        </span>
                        <span class="discount">
                            -27%
                        </span>
                    </div>
                    <div class="actions">
                        <button>
                            <i class="fas fa-shopping-cart">
                            </i>
                        </button>
                    </div>
                </div>
            </div>
            <button class="carousel-control-next" onclick="scrollCarousel(1)">
                <i class="fas fa-chevron-right">
                </i>
            </button>
        </div>
        <div class="ad-carousel mt-5">
            <div id="adCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img alt="Ad 1" src="https://via.placeholder.com/1200x300?text=Ad+1" />
                    </div>
                    <div class="carousel-item">
                        <img alt="Ad 2" src="https://via.placeholder.com/1200x300?text=Ad+2" />
                    </div>
                    <div class="carousel-item">
                        <img alt="Ad 3" src="https://via.placeholder.com/1200x300?text=Ad+3" />
                    </div>
                </div>
                <a class="carousel-control-prev" href="#adCarousel" role="button" data-slide="prev">
                    <span aria-hidden="true" class="carousel-control-prev-icon">
                    </span>
                    <span class="sr-only">
                        Previous
                    </span>
                </a>
                <a class="carousel-control-next" href="#adCarousel" role="button" data-slide="next">
                    <span aria-hidden="true" class="carousel-control-next-icon">
                    </span>
                    <span class="sr-only">
                        Next
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <p>
                Контактная информация: 8-800-600-7775 | email@example.com
            </p>
            <p>
                Все права защищены © 2023
            </p>
        </div>
    </div>
    <script>
        function scrollCarousel(direction) {
            const carousel = document.querySelector('.product-list');
            const scrollAmount = 300;
            carousel.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все товары</title>
</head>

<body>
    <h1>Все товары</h1>
    <div id="products"></div>

    <script>
        // Функция для загрузки товаров из API
        async function loadProducts() {
            try {
                const response = await fetch('/products'); // Убедитесь, что API возвращает данные
                if (!response.ok) {
                    throw new Error(`Ошибка: ${response.statusText}`);
                }

                const products = await response.json();
                const productsContainer = document.getElementById('products');

                // Отображение товаров
                products.forEach(product => {
                    const productElement = document.createElement('div');
                    productElement.innerHTML = `
                        <h2>${product.название}</h2>
                        <p>Цена: ${product.цена} ₽</p>
                        <p>Категория: ${product.категория.название}</p>
                        <p>Производитель: ${product.производитель}</p>
                        <button onclick="addToCart(${product.id})">Добавить в корзину</button>
                    `;
                    productsContainer.appendChild(productElement);
                });
            } catch (error) {
                console.error('Ошибка загрузки товаров:', error);
            }
        }

        // Функция для добавления товара в корзину
        async function addToCart(productId) {
            try {
                const response = await fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: 1 // Количество по умолчанию
                    })
                });

                if (!response.ok) {
                    throw new Error(`Ошибка: ${response.statusText}`);
                }

                const data = await response.json();
                alert(data.success || 'Товар добавлен в корзину');
            } catch (error) {
                console.error('Ошибка добавления в корзину:', error);
                alert('Не удалось добавить товар в корзину');
            }
        }

        // Загрузка товаров при загрузке страницы
        document.addEventListener('DOMContentLoaded', loadProducts);
    </script>
</body>

</html>

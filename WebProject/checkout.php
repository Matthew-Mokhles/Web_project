<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url("images/2700.png");
            background-position: center;
            background-size: cover;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #2c2930e6;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: antiquewhite;
        }

        h1 {
            text-align: center;
        }

        .items {
            margin-bottom: 20px;
        }

        .items h2 {
            margin-bottom: 10px;
        }

        .user-details {
            padding: 20px;
            border: 1px solid #ffc03a;
            border-radius: 5px;
        }

        .user-details h2 {
            margin-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input, textarea, select {
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #cfcfcf;
            background-color: rgba(255, 255, 255, 0.762);
            max-width: 97%;
        }

        input {
            margin-right: 5%;
        }

        .Btn {
            margin-top: 2%;
            align-self: center;
            width: 130px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgb(245, 185, 101);
            border: none;
            color: rgb(0, 0, 0);
            font-weight: 600;
            gap: 8px;
            cursor: pointer;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.103);
            position: relative;
            overflow: hidden;
            transition-duration: .3s;
        }

        .svgIcon {
            width: 16px;
        }

        .svgIcon path {
            fill: rgb(0, 0, 0);
        }

        .Btn::before {
            width: 130px;
            height: 130px;
            position: absolute;
            content: "";
            background-color: white;
            border-radius: 50%;
            left: -100%;
            top: 0;
            transition-duration: .3s;
            mix-blend-mode: difference;
        }

        .Btn:hover::before {
            transition-duration: .3s;
            transform: translate(100%, -50%);
            border-radius: 0;
        }

        .Btn:active {
            transform: translate(5px, 5px);
            transition-duration: .3s;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        <div class="items">
            <h2>Items</h2>
            <ul id="item-list">
                <!-- Items will be added here dynamically -->
            </ul>
        </div>
        <div class="user-details">
            <h2>Customer Information</h2>
            <form action="checkoutwithdb.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name"required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea>
                <label for="payment">Payment Method:</label>
                <select id="payment" name="payment" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                </select>
                <!-- Hidden fields to hold book and price data -->
                <input type="hidden" id="book" name="book">
                <input type="hidden" id="price" name="price">
                <button class="Btn" type="submit">
                    Pay
                    <svg class="svgIcon" viewBox="0 0 576 512"><path d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z"></path></svg>
                </button>
            </form>
        </div>
    </div>
    <script>
        // Function to get query parameters
        function getQueryParams() {
            const params = {};
            const queryString = window.location.search.substring(1);
            const queries = queryString.split("&");
            queries.forEach(query => {
                const [key, value] = query.split("=");
                params[key] = decodeURIComponent(value);
            });
            return params;
        }

        // Function to add item to the list
        function addItemToList(book, price) {
            const itemList = document.getElementById("item-list");
            const li = document.createElement("li");
            li.textContent = `${book} - $${price}`;
            itemList.appendChild(li);
        }

        // Get query parameters and add item to the list
        const params = getQueryParams();
        if (params.book && params.price) {
            addItemToList(params.book, params.price);
            document.getElementById('book').value = params.book;
            document.getElementById('price').value = params.price;
        }
    </script>
</body>
</html>

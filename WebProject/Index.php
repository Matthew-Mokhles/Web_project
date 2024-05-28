<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}
// Output buffering to ensure headers are not sent prematurely
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Book Store</title>
    <style>
        /* Resetting default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url("images/bookstore\ -\ Copy.png");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            line-height: 1.6;
            color: #333;
            margin: 0;
            min-height: 100vh; 
            position: relative; 
        }
        .mySlides {
            display: none;
        }
        .mySlides img{
            vertical-align: middle;
            max-width: 50%; /* Adjust this value to make the images smaller */
            height: auto;
            display: block; /* Ensure the image is treated as a block-level element */
            margin: auto; /* Center the image horizontally */
            width: 250px;
            height: 300px;
            border-radius: 10px;
            
        }
        .slideshow_container {
            max-width: 1120px;
            width: 90%;
            background-color: #e8d7c8f1;
            padding: 40px 0px;
            position: relative;
            /*max-width: 88%; /* Ensure the container uses the full width available */
            margin: auto; /* Center the container itself */
}
        .prev, .next{
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }
        .next{
            right: 0;
            border-radius: 3px 0 0 3px;
        }
        .prev:hover, .next:hover{
            background-color: rgba(0, 0, 0, 0.8);
        }
        /*.text{
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;

        }*/
        /*.numbertext{
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }*/
        .dot{
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }
        .active, .dot:hover{
            background-color: #717171;
        }
        .fade{
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }
        .slideshow_container .mySlides .pics {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .slideshow_container .mySlides .pics .img-container {
        margin: 20px;
        text-align: center;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        white-space: nowrap; 
        overflow: hidden;
        text-overflow: ellipsis; 
        }

        .slideshow_container .mySlides .pics .img-container img {
            width: 200px;
            height: 250px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .slideshow_container .mySlides .pics .img-container img:hover {
            transform: scale(1.05);
        }

        /* Price styles */
        .slideshow_container .mySlides .price {
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
        }
        @-webkit-keyframes fade {
            from {opacity:.4} 
            to {opacity: 1}
        }
        @keyframes fade {
            from {opacity:.4} 
            to {opacity: 1}
        }
        @media only screen and (max-width:300px){
            .prev, .next , .text{
                font-size: 11px;
            }
            .dot{
                height: 10px;
                width: 10px;
            }
        }
        @media only screen and (max-width:500px){
            .prev, .next, .text{
                font-size: 14px;
            }
        }

        header {
            background-color:rgb(56, 72, 103);
            color: white;
            padding: 5px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1; 
        }

        header h1 {
            font-size: 30px;
            letter-spacing: 2px;
        }

        nav ul {
            list-style: none;
            margin-top: 20px;
        }

        nav ul li {
            display: inline;
            margin: 0 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            padding-bottom: 5px;
            border-bottom: 2px solid transparent;
            transition: border-bottom 0.3s ease;
        }

        nav ul li a:hover {
            border-bottom: 2px solid #fff;
        }

        /* Main content styles */
        main {
            background-color: #e8d7c8f1; 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 90%;
            position: relative; 
            z-index: 0;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        hr {
            border: 0;
            height: 1px;
            background-color: #ddd;
            margin: 40px 0;
        }

        /* Image styles */
        .pics {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .pics .img-container {
        margin: 20px;
        text-align: center;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        white-space: nowrap; 
        overflow: hidden;
        text-overflow: ellipsis; 
        }

        .pics .img-container img {
            width: 200px;
            height: 250px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .pics .img-container img:hover {
            transform: scale(1.05);
        }

        /* Price styles */
        .price {
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
        }
        .CContact{
            position: relative;
            max-height: 134vh;
            padding: 50px 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background: url(images/1.png);
            background-position: revert-layer;
            background-repeat: no-repeat;
            background-size: 100%;
            background-position-y: 31%;
            background-position-x: 54%;
            
        }
        .CContact .content{
             max-width: 800px;
             text-align: center;
        }
        .CContact .content h2{
            font-size: 36px;
            font-weight: 500;
            color:#fff;
        }
        .CContact .content p{
            
            font-weight: 300;
            color:#fff;
        }
        .container{
            width:100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
        }
        .container .contactInfo{
            width:50%;
            display: flex;
            flex-direction: column;
        }
        .container .contactInfo .box{
            position: relative;
            padding: 20px 0;
            display:flex;
        }
        .container .contactInfo .box .icon{
            min-width: 60px;
            height: 60px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-size: 22px;
        }
        .container .contactInfo .box .text{
            display: flex;
            margin-left: 20px;
            font-size: 16px;
            color: #fff;
            flex-direction: column;
            font-weight: 300;
        }
        .container .contactInfo .box .text h3{
            font-weight: 500;
            color: #00bcd4;
        }
        .contactform{
            width: 40%;
            padding: 30px;
            background: #ffffff4e;
            background-blend-mode:color-dodge;
            margin-right: 12%;
        }
        .contactform h2{
            font-size: 30px;
            font-weight: 500;
            color:#333;
        }
        .contactform .inputBox{
            position:relative;
            width: 100%;
            margin-top: 10px;
        }
        .contactform .inputBox input,.contactform .inputBox textarea{
            width: 100%;
            padding: 5px 0;
            font-size: 16px;
            margin: 10px 0;
            border: none;
            outline: none;
            border-bottom: 2px solid #333;
            resize: none;
        }
        .contactform .inputBox span{
            position: absolute;
            left: 0;
            padding: 5px 0;
            font-size: 16px;
            margin:10px 0;
            pointer-events: none;
            transition: 0.5s;
            color: #666;
        }
        .contactform .inputBox input:focus ~ span,
        .contactform .inputBox input:valid ~ span,
        .contactform .inputBox textarea:focus ~ span,
        .contactform .inputBox textarea:valid ~ span{
            color:#e91e63;
            font-size: 12px;
            transform: translateY(-20px);
        }
        .contactform .inputBox input[input="submit"]{
            width: 100px;
            background:#00bcd4 ;
            color:#fff;
            border:none;
            cursor: pointer;
            padding: 10px;
            font-size: 18px;
        }
        .website-opener {
    display: flex;
    justify-content: center;
    align-items: center;
    max-width: 95%;
    height: 120vh; /* Adjust as needed */
    overflow: hidden;
    margin-top: 5%;
    margin-left: 3%;
}

.website-opener .content img {
    max-width: 100%;
    max-height: 100%;
    border-radius: 50px;

}
.welcome {
            margin-left: 10px;
            font-size: 1.0em;
            color: white;
            display: flex;
        }
.EBooks .pics .img-container h3 a{
    text-decoration: none;
}
.btn-class-name {
  --color: 180,255, 100;
  border-radius: .5em;
  transition: .3s;
  background-color: rgba(var(black), .2);
  color: rgb(var(black));
  fill: rgb(var(black));
  font-family: monospace;
  font-weight: bolder;
  font-size: x-large;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  cursor: pointer;
  border: 2px solid rgb(var(black));
  box-shadow: 0 0 10px rgba(var(white), .4);
  outline: none;
  display: flex;
  align-items: center;
  padding: .5em 1em;
  max-height: 30px;
  align-self: center;
}
a{
    text-decoration: none;
}
.btn-class-name:hover {
  box-shadow: 0 0 0 5px rgba(var(white), .5);
}

.btn-class-name span {
  transform: scale(.8);
  transition: .3s;
}

.btn-class-name:hover span {
  transform: scale(1);
}

.btn-class-name svg {
  font-size: 0;
  transform: scale(0.5) translateX(0%) rotate(-180deg);
  transition: .3s;
}

.btn-class-name:hover svg {
  font-size: 20px;
  transform: scale(1) translateX(20%) rotate(0deg);
}

.btn-class-name:active {
  transition: 0s;
  box-shadow: 0 0 0 5px rgb(var(--color));
}

        @media(max-width:991px){
            .CContact{
                padding: 50px;
            }
            .container{
                flex-direction: column;
            }
            .container .contactInfo{
                margin-bottom: 40px;
            }
            .container .contactInfo,
            .contactform{
                width: 100%;
            }
        }

    </style>
    
</head>
<body>
<script>
        window.addEventListener('beforeunload', function() {
            navigator.sendBeacon('logout.php');
        });
    </script>
    <header>
        <h1>BOOK<span style="font-weight: normal;">TOPIA</span></h1>
        <span class="welcome">Welcome <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
        <nav>
            <ul>
                <li><a href="#audio">Audio books</a></li>
                <li><a href="#books">Books</a></li>
                <li><a href="#ebooks">Ebooks</a></li>
            </ul>
        </nav>
    </header>
    <section class="website-opener">
        <div class="content">
            <img src="images/Vibrant Colorful Modern Minimalist Luxury Bag Fashion Website UI Prototype.png" usemap="#image-map">
            <map name="image-map">
                <area target="_blank" alt="" title="" href="Bookview2.html" coords="520,254,779,624" shape="rect">
                <area target="_blank" alt="" title="" href="Bookview.html" coords="262,310,458,628" shape="rect">
                <area target="_blank" alt="" title="" href="Bookview2.html" coords="487,684,813,745" shape="rect">
                <area target="_blank" alt="" title="" href="Bookview.html" coords="253,652,456,711" shape="rect">
                <area target="_blank" alt="" title="" href="Bookview1.html" coords="843,654,1050,707" shape="rect">
                <area target="" alt="" title="" href="Bookview1.html" coords="1035,616,841,297" shape="rect">
            </map>
        </div>
    </section>
    <div class="slideshow_container">
        <div class="mySlides fade">
            <div class="pics">
            <div class="img-container">
                <img src="Books/1984 by George Orwel.jpg" alt="1984 by George Orwell">
            </div>
        </div>
        </div>

        <div class="mySlides fade">   
            <div class="pics">
                <div class="img-container">
                    <img src="Books/Harry Potter and the Sorcerer's Stone by J.K. Rowling.jpg" alt="Harry Potter and the Sorcerer's Stone">
                    
                </div>
            </div>
        </div>

        <div class="mySlides fade">
            <div class="pics">
                <div class="img-container">
                    <img src="Books/Pride and Prejudice by Jane Austen.jpg" alt="Pride and Prejudice by Jane Austen">
                    
                </div>
            </div>        
        </div>

        <div class="mySlides fade">
            <div class="pics">
                <div class="img-container">
                    <img src="Books/The Catcher in the Rye by J.D. Salinger.jpg" alt="The Catcher in the Rye by J.D. Salinger">
                   
                </div>
            </div>        
        </div>

        <div class="mySlides fade">
            <div class="pics">
                <div class="img-container">
                    <img src="Books/The Great Gatsby.jpg" alt="The Great Gatsby">
                    
                </div>
            </div>        
        </div>

        <div class="mySlides fade">
            <div class="pics">
                <div class="img-container">
                    <img src="Books/The Hobbit by J.R.R. Tolkien.jpg" alt="The Hobbit by J.R.R. Tolkien">
                   
                </div>
            </div>       
         </div>
        
        <div class="mySlides fade">
            <div class="pics">
                <div class="img-container">
                    <img src="Books/The Silent Patient by Alex Michaelides.jpg" alt="The Silent Patient by Alex Michaelides">
                    
                </div>
            </div>        
        </div>

        <div class="mySlides fade">
            <div class="pics">
                <div class="img-container">
                    <img src="Books/To Kill a Mockingbird by Harper Lee.jpg" alt="To Kill a Mockingbird by Harper Lee">
                </div>
            </div>        
        </div>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <main>
        <section class="Audio" id="audio">
            <h1>Audio books</h1>
            <div class="pics">
                <div class="img-container">
                    <img src="Books/1984 by George Orwel.jpg" alt="1984 by George Orwell">
                    <h3>1984 by George Orwell</h3>
                    <div class="price">10$</div>
                </div>
                <div class="img-container">
                    <img src="Books/Harry Potter and the Sorcerer's Stone by J.K. Rowling.jpg" alt="Harry Potter and the Sorcerer's Stone">
                    <h3>Harry Potter and the Sorcerer's Stone</h3>
                    <div class="price">20$</div>
                </div>
                <div class="img-container">
                    <a href="bookview1.html">
                    <img src="Books/Pride and Prejudice by Jane Austen.jpg" alt="Pride and Prejudice by Jane Austen">
                </a>
                    <h3>Pride and Prejudice by Jane Austen</h3>
                    <div class="price">20$</div>
                </div>
                <div class="img-container">
                    <img src="Books/The Catcher in the Rye by J.D. Salinger.jpg" alt="The Catcher in the Rye by J.D. Salinger">
                    <h3>The Catcher in the Rye by J.D. Salinger</h3>
                    <div class="price">10$</div>
                </div>
                <button class="btn-class-name">
                    <a href="Audiobooks.html">
                    <span>Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                      <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z">
                    </path>
                    </svg>
                </a>
                  </button>
            </div>
        </section>
        <hr>
        <section class="Books" id="books">
            <h1>Books</h1>
            <div class="pics">
                <div class="img-container">
                    <img src="Books/The Great Gatsby.jpg" alt="The Great Gatsby">
                    <h3>The Great Gatsby</h3>
                    <div class="price">10$</div>
                </div>
                <div class="img-container">
                    <img src="Books/The Hobbit by J.R.R. Tolkien.jpg" alt="The Hobbit by J.R.R. Tolkien">
                    <h3>The Hobbit by J.R.R. Tolkien</h3>
                    <div class="price">10$</div>
                </div>
                <div class="img-container">
                    <a href="bookview2.html">
                    <img src="Books/The psychology of money.jpg" alt="The psychology of money">
                    </a>
                    <h3><a href="bookview2.html" target="_blank">The psychology of money</a></h3>
                    <div class="price">20$</div>
                </div>
                <div class="img-container">
                    <img src="Books/The Silent Patient by Alex Michaelides.jpg" alt="The Silent Patient by Alex Michaelides">
                    <h3>The Silent Patient by Alex Michaelides</h3>
                    <div class="price">20$</div>
                </div>
                <button class="btn-class-name">
                    <a href="book.html">
                    <span>Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                      <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z">
                    </path>
                    </svg>
                </a>
                  </button>
            </div>
        </section>
        <hr>
        <section class="EBooks" id="ebooks">
            <h1>Ebooks</h1>
            <div class="pics">
                <div class="img-container">
                    <img src="Books/matt-ridley-How Innovations works.jpg" alt="matt-ridley-How Innovations works">
                    <h3>matt-ridley-How Innovations works</h3>
                    <div class="price">10$</div>
                </div>
                <div class="img-container">
                    <a href="Bookview.html">
                    <img src="Books/To Kill a Mockingbird by Harper Lee.jpg" alt="To Kill a Mockingbird by Harper Lee">
                    </a>
                    <h3><a href="Bookview.html" target="_blank"> To Kill a Mockingbird by Harper Lee</a></h3>
                    <div class="price">10$</div>
                </div>
                <div class="img-container">
                    <img src="Books/Harry Potter and the Sorcerer's Stone by J.K. Rowling.jpg" alt="Harry Potter and the Sorcerer's Stone by J.K. Rowling">
                    <h3>Harry Potter and the Sorcerer's Stone by J.K. Rowling</h3>
                    <div class="price">10$</div>
                </div>
                <div class="img-container">
                    <a href="bookview1.html">
                    <img src="Books/Pride and Prejudice by Jane Austen.jpg" alt="Pride and Prejudice by Jane Austen">
                    </a>
                    <h3><a href="bookview1.html" target="_blank">Pride and Prejudice by Jane Austen</a></h3>
                    <div class="price">10$</div>
                </div>
                <button class="btn-class-name">
                    <a href="E-books.html">
                    <span>Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                      <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z">
                    </path>
                    </svg>
                </a>
                  </button>
            </div>
        </section>
    </main>
    <script>
  var slideIndex = 0;
  var timer;

  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    
    if (n !== undefined) {
      slideIndex = n;
    } else {
      slideIndex++;
    }
    
    if (slideIndex > slides.length) { slideIndex = 1 }
    if (slideIndex < 1) { slideIndex = slides.length }
    
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
    }
    
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    
    slides[slideIndex - 1].style.display = "block";  
    dots[slideIndex - 1].className += " active";

    clearTimeout(timer);
    timer = setTimeout(showSlides, 2000);
  }

  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  document.addEventListener('DOMContentLoaded', (event) => {
    showSlides();
  });
</script>

</body>

</html>


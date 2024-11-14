<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Packed Drinking Water</title>
    <link rel="stylesheet" href="styles.css" />
  </head>

  <body>
    <div class="navbar">
      <a href="#">
        <img src="logo.jpg" alt="Logo" class="logo" />
      </a>
      <a href="#about">About</a>
      <a href="#social">Contact</a>
      <a href="#faq">FAQ's</a>
      <a href="#delivery-info">Where You Can Deliver?</a>
      <a href="#cart" class="cart-icon"><i class="fas fa-shopping-cart"></i></a>

      <?php if (isset($_SESSION['user_name'])): ?>
        <span class="user-name">Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</span>
        <button onclick="window.location.href='logout.php'">Logout</button>
      <?php else: ?>
        <button onclick="window.location.href='signup.html'">Sign Up</button>
      <?php endif; ?>
    </div>

    <div class="banner" style="background-image: url('back.jpg')">
      <div class="title-container">
        <h1 class="title">MOUNT WATER</h1>
        <p class="subtitle">
          Packed Drinking Water<br />Stay hydrated, Stay safe
        </p>
      </div>
    </div>

    <div class="banner-container">
      <div class="mySlides fade">
        <img src="x.jpg" alt="Banner 1" />
      </div>
      <div class="mySlides fade">
        <img src="xy.jpg" alt="Banner 2" />
      </div>
      <div class="mySlides fade">
        <img src="xyz.jpg" alt="Banner 3" />
      </div>
    </div>

    <br />

    <div class="dot-container" style="text-align: center">
      <span class="dot"></span>
      <span class="dot"></span>
      <span class="dot"></span>
    </div>

    <div class="container">
      <div class="products">
        <a href="order.php" class="product">
          <div class="image-container">
            <img src="5l.jpg" alt="Product 1" />
          </div>
          <h2>Product 1</h2>
          <p>Description of product 1</p>
          <p class="price">$10.00</p>
        </a>
        <a href="order.php" class="product">
          <div class="image-container">
            <img src="10l.jpg" alt="Product 2" />
          </div>
          <h2>Product 2</h2>
          <p>Description of product 2</p>
          <p class="price">$12.00</p>
        </a>
      </div>
    </div>

    <div
      class="unified-background"
      style="
        background-image: url('cover.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        opacity: 0.5;
      "
    >
      <section class="about-us" id="about">
        <h2>About Us</h2>
        <p>
          We provide the purest and healthiest packed drinking water to keep you
          hydrated on the go. Our products are rigorously tested and certified
          to meet the highest standards of quality.
        </p>
      </section>

      <section class="social-media" id="social">
        <h2>Contact Us</h2>
        <ul>
          <li><a href="https://www.linkedin.com">Connect on LinkedIn</a></li>
          <li><a href="https://www.twitter.com">Follow us on Twitter</a></li>
          <li><a href="https://www.facebook.com">Like us on Facebook</a></li>
        </ul>
      </section>

      <section class="faq-container" id="faq">
        <h2>FAQs</h2>
        <div class="faq">
          <h3>Where do you deliver?</h3>
          <div class="answer">
            <p>We deliver in major cities and towns nationwide.</p>
          </div>
        </div>
        <div class="faq">
          <h3>Is the water certified?</h3>
          <div class="answer">
            <p>
              Yes, our water is certified by national and international
              standards.
            </p>
          </div>
        </div>
      </section>
    </div>

    <div class="slider-container" id="sliderContainer">
      <button class="arrow left" id="leftArrow">&#10094;</button>
      <div class="card-wrapper" id="cardWrapper">
        <div class="card">
          <img src="5l.jpg" alt="Card 1" />
          <h3>The Health Risks of <br />Drinking Water While Standing</h3>
          <p>
            Have you ever been cautioned by your <br />
            elders or family members against drinking <br />
            water
          </p>
        </div>
        <div class="card">
          <img src="5l.jpg" alt="Card 2" />
          <h3>Card 2</h3>
          <p>This is the description for card 2.</p>
        </div>
        <div class="card">
          <img src="5l.jpg" alt="Card 3" />
          <h3>Card 3</h3>
          <p>This is the description for card 3.</p>
        </div>
        <div class="card">
          <img src="5l.jpg" alt="Card 4" />
          <h3>Card 4</h3>
          <p>This is the description for card 4.</p>
        </div>
      </div>
      <button class="arrow right" id="rightArrow">&#10095;</button>
    </div>

    <a href="#" class="scroll-to-top" id="scrollToTopBtn">&#8679;</a>

    <footer>
      <p>&copy; 2024 Packed Drinking Water. All rights reserved.</p>
      <div class="delivery-info" id="delivery-info">
        <h3>Where We Deliver</h3>
        <p>
          We are pleased to inform you that our delivery services are available
          all over India. <br />
          No matter where you are, we can reach you with ease. From the largest
          cities to the <br />smallest towns, we ensure prompt and reliable
          service. Our network is designed to cover <br />every corner of the
          country. Rest assured, wherever you need us, we’ll be there to
          deliver!
        </p>
      </div>
    </footer>

    <script src="script.js"></script>
  </body>
</html>

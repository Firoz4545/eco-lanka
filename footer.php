<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

    <style>
        /* footer */

.footer {
  background: #07320b no-repeat;
  padding: 3vw;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  flex-wrap: wrap;
}

.footer .footer-col {
  padding-bottom: 40px;
}

.footer h3 {
  color: white;
  font-weight: 600;
  padding-bottom: 20px;
}

.footer li {
  list-style: none;
  color: #7b838a;
  padding: 10px 0;
  font-size: 15px;
  cursor: pointer;
  transition: 0.3s ease;
}

.footer li:hover {
  color: white;
}

.footer p {
  color: #7b838a;
}

.footer .subcribe {
  margin-top: 20px;
}

.footer input {
  width: 220px;
  padding: 15px 12px;
  background: #ccd7e3;
  border: none;
  outline: none;
  color: white;
}

.footer .subcribe a {
  text-decoration: none;
  font-size: 0.9rem;
  padding: 15px 20px;
  background-color: #ffffff;
  font-weight: 600;
  border-radius: 5px;
}

.footer .subcribe a.red {
  color: rgb(255, 255, 255);
  background: rgb(14, 165, 32);
  transition: 0.4s ease;
}
.footer .subcribe a.red:hover {
  color: rgb(0, 0, 0);
  background: rgb(255, 255, 255);
}

/* icons */

.pro-links i {
  padding: 9px 12px;
  border: 1px solid rgb(0, 0, 0);
  cursor: pointer;
}

.pro-links i:hover {
  background: rgb(255, 255, 255);
  color: rgb(0, 0, 0);
  border: 1px solid rgb(0, 0, 0);
  cursor: pointer;
}

/* copyright */

.footer .copyright {
  margin-top: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  flex-wrap: wrap;
}

.footer .copyright .pro-links {
  margin-top: 0px;
}
.footer .copyright .pro-links i {
  background: rgb(15, 88, 15);
  color: #fff;
}

.footer .copyright .pro-links i:hover {
  background: rgb(221, 227, 223);
  color: #2c2c2c;
}
.footer .copyright p {
  color: rgb(255, 255, 255);
    </style>

</head>
<body>
<section class="footer">
        <div class="footer-col">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="book-pickup.php">Marketplace</a></li>
                <li><a href="contactus.php">Contact us</a></li>
                <li><a href="aboutus.php">About us</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>Get in Touch</h3>
            <ul>
                <li>10/A Colombo, Sri Lanka</li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>Subscribe</h3>
            <p>Work with us</p>
            <div class="subscribe">
                <input type="text" placeholder="Your Email Address">
                <a href="#" class="red">Subscribe</a>
            </div>
        </div>
        <div class="copyright">
            <p>© 2024 E-Eco Lanka. All rights reserved.</p>
            <div class="pro-links">
                <i class="fa-brands fa-square-facebook"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin"></i>
            </div>
        </div>
    </section>

</body>
</html>
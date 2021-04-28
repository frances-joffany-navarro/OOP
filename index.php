<?php
require('./controller/frontend.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'about-us') {
        aboutUs();
    } else if ($_GET['action'] == 'shop') {
        shop();
    } else if ($_GET['action'] == 'shop-detail') {
        shopDetail();
    } else if ($_GET['action'] == 'cart') {
        cart();
    } else if ($_GET['action'] == 'checkout') {
        checkout();
    } else if ($_GET['action'] == 'my-account') {
        myAccount();
    } else if ($_GET['action'] == 'wishlist') {
        wishlist();
    } else if ($_GET['action'] == 'gallery') {
        gallery();
    } else if ($_GET['action'] == 'contact-us') {
        contactUs();
    } else if ($_GET['action'] == 'register') {
        registerNewUser();
    } else if ($_GET['action'] == 'sign-in') {
        signInUser();
    }
} else {
    homePage();
}

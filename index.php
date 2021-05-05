<?php

require('./controller/frontend.php');

try {
    //start a session
    session_start();

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'about-us') {
            aboutUs();
        } else if ($_GET['action'] == 'shop') {
            shop();
        } else if ($_GET['action'] == 'shop-detail') {
            if (isset($_GET['id'])) {
                shopDetail();
            } else {
                shop();
            }
        } else if ($_GET['action'] == 'cart') {
            if (isset($_POST['update-cart'])) {
                updateCart();
            } else {
                cart();
            }
        } else if ($_GET['action'] == 'checkout') {
            if (isset($_POST['countryId'])) {
                getState($_POST['countryId']);
            } else {
                checkout();
            }
        } else if ($_GET['action'] == 'my-account') {
            myAccount();
        } else if ($_GET['action'] == 'wishlist') {
            wishlist();
        } else if ($_GET['action'] == 'gallery') {
            gallery();
        } else if ($_GET['action'] == 'contact-us') {
            contactUs();
        } else if ($_GET['action'] == 'register') {
            register();
        } else if ($_GET['action'] == 'sign-in') {
            signIn();
        } else if ($_GET['action'] == 'register-new-user') {
            if (isset($_POST['account-register'])) {
                registerNewUser();
            } else {
                throw new Exception("No registration request");
            }
        } else if ($_GET['action'] == 'sign-in-user') {
            if (isset($_POST['sign-in'])) {
                signInUser();
            } else {
                throw new Exception("No sign in request");
            }
        } else if ($_GET['action'] == 'sign-out') {
            signOutUser();
        } else if ($_GET['action'] == 'subscription') {
            if (isset($_POST['subscription'])) {
                subscription();
            } else {
                throw new Exception("No subscription request");
            }
        } else if ($_GET['action'] == 'add-to-cart') {
            if (isset($_GET['id'])) {
                addCart();
            } else {
                homePage();
            }
        } elseif ($_GET['action'] == 'update-cart') {
            /* if (isset($_GET['id'])) {
                addCart();
            }  */
        } elseif ($_GET['action'] == 'delete-item') {
            if (isset($_GET['id'])) {
                deleteItem($_GET['id']);
            }
        }
    } else {
        homePage();
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

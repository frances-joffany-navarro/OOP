<?php
function homePage()
{
    require('view/frontend/home.php');
}

function aboutUs()
{
    require('view/frontend/about.php');
}

function shop()
{
    require('view/frontend/shop.php');
}

function shopDetail()
{
    require('view/frontend/shop-detail.php');
}

function cart()
{
    require('view/frontend/cart.php');
}

function checkout()
{
    require('view/frontend/checkout.php');
}

function myAccount()
{
    require('view/frontend/my-account.php');
}

function wishlist()
{
    require('view/frontend/wishlist.php');
}

function gallery()
{
    require('view/frontend/gallery.php');
}

function contactUs()
{
    require('view/frontend/contact-us.php');
}

function registerNewUser()
{
    require('model/frontend.php');

    if (isset($_POST['account-register'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        //instantiation of user
        $newUser = new User([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password
        ]);
        //var_dump($newUser);

        //instantiation of manager
        $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
        $manager = new UserManager($db);

        //add new user to database
        $manager->add($newUser);
    }
}

function signInUser()
{
}

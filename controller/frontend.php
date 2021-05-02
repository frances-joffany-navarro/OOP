<?php

/**
 * General Function
 */
function classAutoLoader($className)
{
    require_once "model/" . $className . ".php";
}

spl_autoload_register('classAutoLoader');


function userSession()
{
    if (isset($_SESSION['user'])) {
        return $_SESSION['user'];
    } else {
        // throw new Exception("User Session is not set.");
    }
}

function cartSession()
{
    if (isset($_SESSION['userCartItems'])) {
        return $_SESSION['userCartItems'];
    } else {
        //throw new Exception("Cart Session is not set.");
    }
}

/**
 *  Home page function
 */
function homePage()
{
    $userCartItems = cartSession();
    $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
    $productManager = new ProductManager($db);
    $totalPrice = 0;
    $grandPrice = 0;

    require('view/frontend/home.php');
}

/**
 *  About page function
 */
function aboutUs()
{
    $userCartItems = cartSession();
    $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
    $productManager = new ProductManager($db);
    $totalPrice = 0;
    $grandPrice = 0;

    require('view/frontend/about.php');
}

/**
 *  Shop page function
 */
function shop()
{
    $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
    $productManager = new ProductManager($db);

    $products = $productManager->getList();

    $totalProduct = count($products);

    $userCartItems = cartSession();
    $totalPrice = 0;
    $grandPrice = 0;

    require('view/frontend/shop.php');
}

/**
 *  Shop detail page function
 */
function shopDetail()
{
    $id = $_GET['id'];

    $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
    $productManager = new ProductManager($db);

    //var_dump($productManager->get($id));
    $product = $productManager->get($id);

    //availability
    $stock = "available-stock";
    $sold = $product->getSold() . " Sold";
    if ($product->getAvailable() == 30) {
        $available = "Full stock";
        $sold = "";
    } else if ($product->getAvailable() > 20) {
        $available = "More than 20 is available /";
    } else if ($product->getAvailable() > 10) {
        $available = "More than 10 is available /";
    } else if ($product->getAvailable() > 0) {
        $available = "Running out of Stock /";
    } else {
        $available = "No available stock";
        $stock = "";
        $sold = "";
    }

    $userCartItems = cartSession();
    $totalPrice = 0;
    $grandPrice = 0;

    require('view/frontend/shop-detail.php');
}

/**
 *  Cart page function
 */
function cart()
{
    $userCartItems = cartSession();
    $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
    $productManager = new ProductManager($db);
    $totalPrice = 0;
    $grandPrice = 0;

    require('view/frontend/cart.php');
}

/**
 *  Checkout page function
 */
function checkout()
{
    $userCartItems = cartSession();
    $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
    $productManager = new ProductManager($db);
    $totalPrice = 0;
    $grandPrice = 0;

    require('view/frontend/checkout.php');
}

/**
 *  My account page function
 */
function myAccount()
{
    $userCartItems = cartSession();
    $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
    $productManager = new ProductManager($db);
    $totalPrice = 0;
    $grandPrice = 0;

    require('view/frontend/my-account.php');
}

/**
 *  Wishlist page function
 */
function wishlist()
{
    $userCartItems = cartSession();
    $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
    $productManager = new ProductManager($db);
    $totalPrice = 0;
    $grandPrice = 0;

    require('view/frontend/wishlist.php');
}

/**
 *  Gallery page function
 */
function gallery()
{

    $userCartItems = cartSession();
    $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
    $productManager = new ProductManager($db);
    $totalPrice = 0;
    $grandPrice = 0;

    require('view/frontend/gallery.php');
}

/**
 *  Contact page function
 */
function contactUs()
{
    $userCartItems = cartSession();
    $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
    $productManager = new ProductManager($db);
    $totalPrice = 0;
    $grandPrice = 0;

    require('view/frontend/contact-us.php');
}

function register()
{
    require('view/frontend/register.php');
}

function signIn()
{
    require('view/frontend/signin.php');
}

/**
 *  Start of Register & sign in/ feature
 */

function registerNewUser()
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);

    //instantiation of user
    $newUser = new User([
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'password' => $password
    ]);

    //instantiation of manager
    $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
    $userManager = new UserManager($db);

    //add new user to database
    $userManager->add($newUser);

    header('Location: index.php');
    exit;
}

function signInUser()
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = new User([
        'email' => $email,
        'password' => $password
    ]);

    $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
    //instantiate a user manager
    $userManager = new UserManager($db);
    //check if email exists
    $emailExists = $userManager->emailExists($user->getEmail());
    if ($emailExists) {
        //get value of hash password from the dbase
        $hashPassword = $userManager->getHashPassword($user->getEmail());
        //check if password is equal from the database
        $isPasswordMatch = password_verify($user->getPassword(), $hashPassword);
        if ($isPasswordMatch) {
            //get user information
            $user = $userManager->get($user->getEmail());

            //create session for the user information
            $_SESSION["user"] = $user;

            //instantiate a cart manager
            $cartManager = new CartManager($db);
            //get the user id from the session
            $userId = $user->getId(); /**/
            //get the cart of user using the userId
            $userCartItems = $cartManager->getCart($userId);
            // create session for the cart of that user
            $_SESSION["userCartItems"] = $userCartItems;

            header('Location: index.php');
            exit();
        } else {
            echo "Password is incorrect.";
        }
    } else {
        echo "This email is not registered. Please create an account first.";
    }
}

function signOutUser()
{
    session_destroy();
    header('Location: index.php');
    exit();
}

/**
 *  End of Register & sign in/ feature
 */

/**
 *  Newsletter (only add the email address to the database)
 */
function subscription()
{
    $email = $_POST['email'];
    $user = new User([
        'email' => $email
    ]);

    $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
    $userManager = new NewsletterManager($db);

    $emailExists = $userManager->emailExists($user->getEmail());

    if (!$emailExists) {
        $userManager->add($user);
        header('Location: index.php');
        exit;
    } else {
        echo "This email is already in our database.";
    }
}
/**
 * The shopping cart must work (add / remove / calculate / order)
 */
function addCart()
{
    $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
    $user = userSession();
    //get values needed
    $userId = $user->getId();
    $productId = $_GET['id'];
    $quantity = 1;

    //instantiate Cart with the values about
    $itemToAdd = new Cart([
        'userid' => $userId,
        'productid' => $productId,
        'quantity' => $quantity
    ]);
    //instantiate Cart Manager    
    $cartManager = new CartManager($db);

    //add the new item into the cart if theres a same item in the cart modify the quantity
    if ($cartManager->exists($itemToAdd)) {

        //get the data from dbase
        $data = $cartManager->getInfo($itemToAdd);
        $quantity = $data->getQuantity();

        $data->setQuantity($quantity + 1);
        //modify
        $cartManager->update($data);
    } else {
        $cartManager->add($itemToAdd);
    }
    //update the userCartItems in session
    $user = userSession();
    $userId = $user->getId();

    $userCartItems = $cartManager->getCart($userId);

    $_SESSION["userCartItems"] = $userCartItems;

    header('Location: index.php?action=shop');
    exit;
}

function deleteItem($cartId)
{
    $db = new PDO('mysql:host=localhost;dbname=freshshop', 'root', '');
    $cartManager = new CartManager($db);
    $itemToDelete = $cartManager->get($cartId);
    $cartManager->delete($itemToDelete);

    //update the userCartItems in session
    $user = userSession();
    $userId = $user->getId();

    $userCartItems = $cartManager->getCart($userId);

    $_SESSION["userCartItems"] = $userCartItems;

    header('Location: index.php?action=cart');
}

function calculateCart()
{
}

function order()
{
}

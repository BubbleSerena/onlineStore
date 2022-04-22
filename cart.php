<?php
    session_start();
    
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $name = $_GET['name'];
        $unit_price = $_GET['unit_price'];
        $quantity = $_GET['quantity'];
        if(empty($_SESSION['cart'])){
		   $_SESSION['cart'] = array();
        }
        $cart = $_SESSION['cart'];
        
        if(!isset($_SESSION['sum'])){
            $_SESSION['sum'] = 0;
        }
        $_SESSION['sum'] += $unit_price * $quantity;
    
        if(array_key_exists($id, $cart)){
            $cart[$id]['quantity'] += $quantity;
            $cart[$id]['product_sum'] += $unit_price * $quantity;
        }
        else{
            $product_total = $unit_price * $quantity;
            $new_input = array($id => array( 'id' => $id, 'name' => $name, 'unit_price' => $unit_price, 'quantity'=> $quantity, "product_total"=>$product_total));
            foreach ($new_input as $key => $value) {
                $cart[$key] = $value;
            }
        }
        $_SESSION['cart']=$cart;
    }
    
    else if(isset($_POST['clearID'])){
        $clear_id = $_POST['clearID'];
        $clear_total = $_POST['clearTotal'];
        $_SESSION['sum'] -= $clear_total;
        unset($_SESSION['cart'][$clear_id]);
    }
    else if(isset($_POST['clear_all'])){
        unset($_SESSION['cart']);
        unset($_SESSION['sum']);
    }
    print "<p>Shopping Cart</p>";
    if(!empty($_SESSION['cart'])){
    print "<table>";
    print "<tr><td>Product ID</td><td>Product Name</td><td>Product Price</td><td>Product Quantity</td><td>Total Price</td><td>Operation</td></tr>";
    foreach ($_SESSION['cart'] as $product => $info) {
        print "<tr>";
        print "<td>".$info['id']."</td>";
        print "<td>".$info['name']."</td>";
        print "<td>".$info['unit_price']."</td>";
        print "<td>".$info['quantity']."</td>";
        print "<td>".$info['product_total']."</td>";
        print "<form method='POST' action='ShoppingCart.php'>";
        print "<td>";
        $clearid = $info['id'];
        $cleartotal = $info['product_total'];
        print "<input type='hidden' name='clearID' value='$clearid'>";
        print "<input type='hidden' name='clearTotal' value= '$cleartotal'>";
        print "<input type='submit' name='c' value='clear'>";
        print "</td></form>";
        print "</tr>";
    }
    print "<tr>";
    print "<td>Total</td>";
    print "<td colspan='5'>".$_SESSION['sum']."</td>";
    print "</tr>";
    print "</table>";
    print "<br>";
    print "<form action='cart.php' method='POST'>";
    print "<input type='submit' name='clear_all' value='Clear All'>";
    print "</form>";
    print "<form action='checkout.html' method='POST' target='_blank'>";
    print "<input type='submit' value='Checkout' name='checkout'>";
    print "</form>";
    }
    else{
        echo "No ptoduct in your shopping cart!";
    }
?>

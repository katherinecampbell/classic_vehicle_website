<?php
echo '<header class="header">';
echo '<img src="sportcar.png" alt="Classic Car" class="pic">';
echo '<h1 class="heading"> Classic Models</h1>';
echo '<div class="navbar">';
echo '<ul>';
//    <!--below code as to how to use array instead of repeating code in php nav bars found at stackoverflow.com courtasy of user A.L at http://stackoverflow.com/questions/35460276/php-include-nav-bar-for-every-page-techniques-->
//    
    
        $urls = array(
            'Home' => 'index.php',
            'Products' => 'products.php',
            'Customers' => 'customers.php',
            'Orders' => 'orders.php',
            // …
        );

        foreach ($urls as $name => $url) {
            print '<li><a href="'.$url.'">'.$name.'</a></li>';
        }
    
echo '</ul>';
echo '</div>';
echo '</header>';
?>
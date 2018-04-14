
<?php
 $cart = Session::get('cart');
 $quantities  = 0;
 $price       = 0;

 if(!empty($cart)){

     $quantities = array_sum($cart['quantities']);
     $price      = array_sum($cart['price']);
 }

 $linkViewCart = URL::setURL('default','user','cart',null,'cart.html');

?>



<ul class="nav nav-pills">
    <li><a href="#" >My cart: <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
    <li><a><smail class="text-danger"><?php echo $quantities;?></smail> x item | <smail class="text-uppercase text-danger">TOTAL</smail> <?php echo number_format($price);?></a></li>
    <li><a href="<?php echo $linkViewCart;?>">View cart</a></li>
</ul>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: meeyad
 * Date: 19-Mar-18
 * Time: 2:39 PM
 */

require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;

$woocommerce = new Client(
    'http://projonmo.com/ov-site1/',
    'ck_408247a1024f3b073acc5ea45de9c69359a78187',
    'cs_0ab48f3ca375cc14baaed094ea4c30b01d895b83',
    [
        'wp_api' => true,
        'version' => 'wc/v1',
    ]
);

try{
    $results = $woocommerce->get('orders');

    $products = $woocommerce->get('products');

    $customers = $woocommerce->get('customers');

    $result = count($results);

    $customer = count($customers);

    $product = count($products);

    $sales = $woocommerce->get('reports/sales');

    $sale = $sales[0]->total_sales;



}
catch (HttpClientException $ex){
    $ex -> getMessage();    //Error message
    $ex -> getRequest();    //Last request data
    $ex -> getResponse();    //Last response data
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-1">

    <h1 class="page-header">Dashboard</h1>

        <div class="col-xs-6 col-sm-3 placeholder">

            <p id="large">
                There are a total of:
                <b> <?php echo $product?> </b>
                products

            </p>

            <hr>

            <span class="text-muted">All Products</span>

        </div>

        <div class="col-xs-6 col-sm-3 placeholder">

            <p id="large">

                <?php echo $sale?>

            </p>

            <hr>

            <span class="text-muted">Total Sales</span>

        </div>

</div>

<div class="container">

    <h2 class="sub-header">Products List</h2>

    <div class='table-responsive'>

        <table id='myTable' class='table table-striped table-bordered'>

            <thead>

            <tr>

                <th>ID</th>

                <th>Name</th>

                <th>Short Description</th>

                <th>Description</th>

                <th>Price</th>

                <th>Picture</th>

            </tr>

            </thead>

            <tbody>

            <?php

            foreach($products as $product){

                $p = $product->id;

                $initialPrice = ($product->price);

                $discountedPrice = $initialPrice - ($initialPrice * (15/100));

                echo "<tr>
                        <td>" . $p ."</td>
                        
                        <td>" . $product->name . "</td> 
                        
                        <td>" . $product->short_description . "</td>
                        
                        <td>" . $product->description . "</td>
                           
                        <td>" .  "<strike>" . $initialPrice . "</strike>" . "<br>" . $discountedPrice . "</td>
                        
                        <td><img height='50px' width='50px' src='".$product->images[0]->src . "'></td>
                        
                      </tr>";

            }

            ?>

            </tbody>

        </table>

    </div>

</div>

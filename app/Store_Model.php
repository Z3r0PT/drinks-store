<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 18/11/2019
 * Time: 21:04
 */


namespace App;
use Carbon\Carbon;
use http\Cookie;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Cookie\CookieJar;

class Store_Model
{
    public static function insertUser($name, $email, $password){
        $password_encrypt = md5($password);
        $date = Carbon::now()->toDateTimeString();
        DB::table('customers')->insert(['name' => $name, 'email' => $email, 'created_at' => $date, 'updated_at' => $date, 'password_digest' => $password_encrypt]);
    }

    public static function checkEmail($email){
        $check = DB::table('customers')->where('email', '=', $email)->count();
        if($check != 0){
            return true;
        }else{
            return false;
        }
    }

    public static function checkUser($email, $password){
        $check = DB::table('customers')->where('email', '=', $email)->where('password_digest', '=', $password)->count();
        if($check != 0){
            return true;
        }else{
            return false;
        }
    }

    public static function getUser($email){
        return DB::table('customers')->where('email', '=', $email)->get();
    }

    public static function insertCookie($cookie, $id){
        DB::table('customers')->where('id', $id)->update(['remember_digest' => $cookie]);
    }

    public static function createCookie($name, $value){
        $time = time() +(3600 * 24 * 30);
        setcookie($name, $value, $time);
    }

    public static function getNamebyId($id){
        $name = DB::table('customers')->select('customers.name')->where('id', '=', $id)->get();
        return $name;
    }

    public static function getCats(){
        $cats = DB::table('categories')->select('categories.*')->orderBy('categories.name', 'ASC')->get();
        return $cats;
    }

    public static function getProducts(){
        $products = DB::table('products')->select('products.*')->orderBy('products.name', 'ASC')->simplePaginate(4);
        return $products;
    }

    public static function getProductsbyCat($cat){
        $products = DB::table('products')->select('products.*')->where('cat_id', '=', $cat)->orderBy('products.name', 'ASC')->simplePaginate(4);
        return $products;
    }

    public static function orderByprice($cat, $order){
        $products = "";
        if(strcmp($order, 'high') == 0){
            $products = DB::table('products')->select('products.*')->orderBy('products.price', 'DESC')->get();
        }
        if(strcmp($order, 'low') == 0){
            $products = DB::table('products')->select('products.*')->orderBy('products.price', 'ASC')->get();
        }
        return $products;
    }

    public static function deleteAccount($id){
        DB::table('customers')->where('id', '=', $id)->delete();
    }

    public static function updateUsername($id, $name){
        DB::table('customers')->where('id', $id)->update(['name' => $name]);
        session(['NAME' => $name]);
    }

    public static function getProductbyId($id){
        $product = DB::table('products')->where('id', '=', $id)->get();
        return $product;
    }

    public static function getProductPrice($id){
        $price = DB::table('products')->select('products.price')->where('id', '=', $id)->get();
        return $price;
    }

    public static function placeOrder($total, $id){
        $time = Carbon::now();
        DB::table('orders')->insert(['customer_id' => $id, 'created_at' => $time, 'status' => '1', 'total' => $total]);
    }

    public static function orderItems($product_id, $order_id){
        //$product_id =  $product->{'id'};
        if(!self::existsOrder($order_id, $product_id)){
            DB::table('order_items')->insert(['order_id' => $order_id, 'product_id' => $product_id, 'quantity' => 1]);
        }else{
            $quantity = DB::table('order_items')->select('order_items.quantity')->where(['order_id', '=', $order_id], ['product_id', '=', $product_id])->get();
            $quantity = $quantity + 1;
            DB::table('order_items')->where(['order_id', '=', $order_id], ['product_id', '=', $product_id])->update(['quantity' => $quantity]);
        }
    }

    public static function existsOrder($order_id, $product_id){
        $product = DB::table('order_items')->select('orders.*')->where(['order_id', '=', $order_id], ['product_id', '=', $product_id])->get();
        if(!empty($product)){
            return true;
        }else{
            return false;
        }
    }

    public static function getLastorder($customer_id){
        $order = DB::table('orders')->select('orders.id')->orderBy('orders.created_at', 'DESC')->first();
        return$order;
    }

    public static function getOrders($id){
        $orders = DB::table('orders')->select('orders.*')->where('orders.customer_id', '=', $id)->orderBy('orders.created_at', 'DESC')->simplePaginate(10);
        return $orders;
    }

}
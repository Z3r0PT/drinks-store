<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 18/11/2019
 * Time: 20:56
 */

namespace App\Http\Controllers;
use App\products;
use App\Store_Model;
use http\Cookie;
use http\Env\Response;
use Illuminate\Cookie\CookieJar;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog_model;

class Store extends Controller
{
    public function index(Request $request)
    {
        $skips = ["[","]","\""];
        //return $request->session()->get('NAME');
        $check = 0;
        //$request->session()->forget(['cart']);
        //$request->session()->flush();
        $name = "";
        $search = "";
        $user = "";
        $count = count($request->session()->get('CART'));
        $cat = $request->cat;
        $order = $request->order; //WIP
        $products = "";
        $cats = Store_Model::getCats();
        if(!empty($cat)){
            $products = Store_Model::getProductsbyCat($cat);
        }else
            if(!empty($order)){
                $products = Store_Model::orderByprice($cat, $order);
            }else{
            $products = Store_Model::getProducts();
        }
        if(!empty($_COOKIE['cookie'])){
            $cookie = $_COOKIE['cookie'];
            $name = str_replace($skips, ' ',Store_Model::getNamebyId($cookie)->pluck('name'));
            session(['ID' => $cookie]);
            session(['NAME' => $name]);
        }
        if($request->session()->has('NAME')){
            $name = $request->session()->get('NAME');
        }
        if($request->session()->has('ID')){
            $check = 1;
            $user = $request->session()->get('ID');
        }
        return view("/index_template")->with('check', $check)->with('ID', $user)->with('NAME', $name)->with('cats', $cats)->with('products', $products)->with('COUNT', $count);
    }

    public function register(Request $request){
        $check = 0;
        $error = "";
        $name = "";
        $email = "";
        $message = "";
        if(!empty(Input::get('error'))){
            $check = 1;
            $error = Input::get('error');
        }
        if($error == 1){
            $message = "Passwords don't match!";
        }
        if($error == 2){
            $message = "Email already registered!";
        }
        if(!empty(Input::get('name'))){
            $name = Input::get('name');
        }
        if(!empty(Input::get('email'))){
            $email = Input::get('email');
        }
        return view('/register_template')->with('check', $check)->with('ERROR', $message)->with('NAME', $name)->with('EMAIL', $email);
    }

    public function register_action(Request $request){
        $name = Input::get('Name');
        $email = Input::get('Email');
        $password = Input::get('Password');
        $pass_conf = Input::get('Password_Confirm');
        if(Store_Model::checkEmail($email)){
            return redirect()->action('Store@register', ['error' => 2, 'name' => $name]);
        }
        else if($password != $pass_conf){
            return redirect()->action('Store@register', ['error' => 1, 'name' => $name, 'email' => $email]);
        }else {
            Store_Model::insertUser($name, $email, $password);
            $message = "User registered with success!";
            return view('/message')->with('MESSAGE', $message);
        }
    }

    public function login(Request $request){
        $check = 0;
        $error = "";
        $email = "";
        $password = "";
        $message = "";
        if(!empty(Input::get('error'))){
            $check = 1;
            $error = Input::get('error');
        }
        if($error == 1){
            $message = "Email and/or password wrong!";
        }
        return view('/login_template')->with('check', $check)->with('ERROR', $message)->with('EMAIL', $email)->with('PASSWORD', $password);
    }

    public function login_action(Request $request){
        $skips = ["[","]","\""];
        $email = Input::get('email');
        $password = Input::get('password');
        $remember = Input::get('autologin');
        if(Store_Model::checkUser($email, md5($password))){
            $id = str_replace($skips, ' ',Store_Model::getUser($email)->pluck('id'));
            $name = str_replace($skips, ' ',Store_Model::getUser($email)->pluck('name'));
            session(['ID' => $id]);
            session(['NAME' => $name]);
            if($remember == 1){
                $time = time() +(3600 * 24 * 30);
                Store_Model::insertCookie(substr(md5(time()), 0, 32), $id);
                Store_Model::createCookie('cookie', $id);
            }
            $message = "Welcome back $name";
            return view('/message')->with('MESSAGE', $message);
        }else{
            return redirect()->action('Store@login', ['error' => 1]);
        }
    }

    public function logout(Request $request){
        $request->session()->forget(['ID', 'NAME']);
        $request->session()->flush();
        if(isset($_COOKIE['cookie'])){
            setcookie("cookie", "", time()-3600);
        }
        $message = "See you soon!";
        return view('/message')->with('MESSAGE', $message);
    }

    public function addtoCart(Request $request){
        $item = $request->id;
        $product = Store_Model::getProductbyId($item);
        if(!empty($product)){
            $request->session()->push('CART', $item);
        }
        return redirect()->back();
    }

    public function user_area(Request $request){
        $name = $request->session()->get('NAME');
        $user = $request->session()->get('ID');
        return view('/user_details')->with('NAME', $name)->with('USER_ID', $user);
    }

    public function update_username(Request $request){
        $name = Input::get('Name');
        $user = Input::get('user_id');
        Store_Model::updateUsername($user, $name);
        $message = "Username updated!";
        return view('/message')->with('MESSAGE', $message);
    }

    public function delete_account(Request $request)
    {
        $user = Input::get('user_id');
        Store_Model::deleteAccount($user);
        $request->session()->forget(['ID', 'NAME']);
        $request->session()->flush();
        if (isset($_COOKIE['cookie'])) {
            setcookie("cookie", "", time() - 3600);
        }
        $message = "Profile deleted!";
        return view('/message')->with('MESSAGE', $message);
    }

    public function showCart(Request $request){
        $cart = $request->session()->get('CART');
        $products = [];
        $total = 0;
        for($i = 0; $i < count($cart); $i++){
            $price = str_replace(["[","]","\""], ' ',Store_Model::getProductPrice($cart[$i])->pluck('price'));
            $total = $total + intval($price);
           $products = Arr::add($products, $i, Store_Model::getProductbyId($cart[$i]));
        }
        return view('checkout')->with('CART', $products)->with('TOTAL', $total);
        //return $products;
    }

    public function cancel_order(Request $request){
        $request->session()->forget(['CART']);
        $message = "Cart emptied!";
        return view('/message')->with('MESSAGE', $message);
    }

    public function order_items(Request $request){
        $total = Input::get('total');
        if($request->session()->has('ID')) {
            $id = $request->session()->get('ID');
            $cart = $request->session()->get('CART');
            Store_Model::placeOrder($total, $id);
            /*$order_id = Store_Model::getLastorder($id);
            $i = 0;
            foreach ($cart as $item){
                //$id = $item[$i];
                $id = str_replace(["[","]","\""], '',$item[$i]);
                Store_Model::orderItems($id, $order_id);
                $i++;
            }*/
            $request->session()->forget(['CART']);
            $message = "Order placed!";
            return view('/message')->with('MESSAGE', $message);
        }else{
            return redirect('/login');
        }
    }

    public function orders(Request $request){
        $id = $request->session()->get('ID');
        $orders = Store_Model::getOrders($id);
        return view('/orders')->with('ORDERS', $orders);
    }
}
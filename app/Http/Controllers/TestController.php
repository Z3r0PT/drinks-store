<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 18/11/2019
 * Time: 20:56
 */

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog_model;

class TestController extends Controller
{
    public function index()
    {
        return view('index_template');
    }
}
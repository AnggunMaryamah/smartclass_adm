<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class TestJsonController extends Controller {
    public function test() {
        return response()->json(['location' => 'test']);
    }
}
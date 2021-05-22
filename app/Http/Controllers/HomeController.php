<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use App\Services\StockServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param StockServices $stoke
     */
    public function __construct(private StockServices $stoke)
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = $this->stoke->getAllProducts();

        return view('home', compact('products'));
    }

    public function show($id)
    {
        $product = $this->stoke->productById($id);

        return view('product', compact('product'));
    }

    public function predict(Request $request, $id)
    {
        $date = $request->get('date');

        $product = $this->stoke->productById($id);

        $predict = $this->stoke->predict($product, $date);

        $stocks = $product->stocks;

        return view('product', compact('predict', 'product', 'date', 'stocks'));
    }
}

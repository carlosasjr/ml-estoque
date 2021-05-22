<?php


namespace App\Services;


use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Phpml\Regression\LeastSquares;

class StockServices
{
    public function __construct(private Product $product)
    {
    }

    public function getAllProducts()
    {
        return Product::addSelect([
            'count' => Stock::select(DB::raw('count(*)'))->whereColumn('product_id', 'products.id')
        ])
            ->orderBy('count', 'desc')
            ->get();
    }

    public function productById($id)
    {
       return $this->product->with('stocks')->findOrFail($id);
    }

    public function predict(Product $product, $date)
    {
        list($amostral, $labels) = $this->getDataSets($product);


        $regression = new LeastSquares();

        $regression->train($amostral, $labels);

        $dataset = [
            $product->id,
            (int) date('d', strtotime($date)),
            (int) date('m', strtotime($date)),
            (int) date('Y', strtotime($date))
        ];

        return $regression->predict($dataset);
    }

    /**
     * @param Product $product
     * @return array[]
     */
    private function getDataSets(Product $product): array
    {
        $amostral = [];
        $labels = [];


        foreach ($product->stocks as $stock) {
            array_push($amostral, [
                $stock->product_id,
                (int) date('d', strtotime($stock->data_mov)),
                (int) date('m', strtotime($stock->data_mov)),
                (int) date('Y', strtotime($stock->data_mov))
            ]);

            array_push($labels, (int) $stock->in_stoke );
        }

        return array($amostral, $labels);
    }


}

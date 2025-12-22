<?php

namespace App\Console\Commands;

use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductProductCategory;
use Illuminate\Console\Command;

class SyncCategoy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $products = Product::all();
        $productCategories = ProductCategory::all();

        foreach ($products as $value) {
            ProductProductCategory::firstOrCreate([
                'product_id' => $value->id,
                'product_category_id' => $value->product_category_id,
            ]);
        }


    }
}

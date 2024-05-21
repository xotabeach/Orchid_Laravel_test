<?php

namespace App\Orchid\Screens;

use App\Models\Product;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Illuminate\Http\Request;

class ProductEditScreen extends Screen
{
    public $product;

    public function query(Product $product): iterable
    {
        return [
            'product' => $product
        ];
    }

    public function name(): ?string
    {
        return $this->product->exists ? 'Edit Product' : 'Create Product';
    }

    public function commandBar(): iterable
    {
        return [
            Button::make('Save')
                ->icon('check')
                ->method('save'),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->product->exists)
        ];
    }

    public function layout(): iterable
    {
        return [
            \Orchid\Support\Facades\Layout::rows([
                Input::make('product.name')
                    ->title('Name')
                    ->required(),

                Input::make('product.price')
                    ->title('Price')
                    ->required()
                    ->type('number')
                    ->step(0.01)
            ])
        ];
    }

    public function save(Request $request)
    {
        $productData = $request->input('product');
        $product = new Product($productData);
        $product->save();

        return redirect()->route('platform.product.list')->with('success', 'Product saved successfully.');
    }

    public function remove(Product $product)
    {
        $product->delete();

        Alert::info('You have successfully deleted the product.');

        return redirect()->route('platform.product.list');
    }
}
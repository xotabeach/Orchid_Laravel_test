<?php

namespace App\Orchid\Screens;

use App\Models\Product;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'products' => Product::paginate()
        ];
    }

    /**
     * Display header name.
     *
     * @return string
     */
    public function name(): ?string
    {
        return 'Products';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Create')
                ->icon('plus')
                ->route('platform.product.edit')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('products', [
                TD::make('name', 'Name')
                    ->sort()
                    ->filter(TD::FILTER_TEXT),

                TD::make('price', 'Price')
                    ->sort()
                    ->filter(TD::FILTER_TEXT),

                TD::make('edit')
                    ->render(function (Product $product) {
                        return Link::make('Edit')
                            ->route('platform.product.edit', $product);
                    }),
            ])
        ];
    }
}

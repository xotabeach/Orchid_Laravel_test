namespace App\Orchid\Layouts;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class ProductEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return array
     */
    protected function fields(): array
    {
        return [
            Input::make('product.name')
                ->title('Name')
                ->required(),

            Input::make('product.price')
                ->title('Price')
                ->required()
                ->type('number')
                ->step(0.01)
        ];
    }
}

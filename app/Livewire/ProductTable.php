<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Number;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use Livewire\Attributes\On;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Container\Attributes\Auth;

final class ProductTable extends PowerGridComponent
{
    public string $tableName = 'product-table-cwhbml-table';
    public bool $multiSort = true;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput()
                ->showToggleColumns(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount('full'),
        ];
    }
    public function header(): array
    {
        return [
            Button::add('bulk-delete')
                ->slot(__('Bulk delete (<span x-text="window.pgBulkActions.count(\'' . $this->tableName . '\')"></span>)'))
                ->class('pg-btn-white dark:ring-pg-primary-600 space-x-2 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('bulkDelete.' . $this->tableName, []),
        ];
    }
    #[On('bulkDelete.{tableName}')]
    public function bulkDelete(): void
    {
        if($this->checkboxValues){
            Product::destroy($this->checkboxValues); // clear the count on the interface.
            $this->js('window.pgBulkActions.clearAll()');
        }
    }
    public function datasource(): Builder
    {
        return Product::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name', fn($product) => Str::limit($product->description, '10', '...'))
            ->add('slug', fn($product) => Str::limit($product->description, '10', '...'))
            ->add('description', fn($product) => Str::limit($product->description, '10', '...'))
            ->add('price', fn($data) => Number::currency($data->price, 'USD'))
            ->add('stock')
            ->add('category_id', fn($data) => e($data->category->name))
            ->add('brand_id', fn($data) => e($data->brand->name))
            ->add('discount_id')
            ->add('created_at_formatted', fn (Product $model) => Carbon::parse($model->created_at)->format('d, M Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable()
                ->editOnClick(
                    hasPermission:  auth()->check(),
                    fallback: '- empty -'
                ),

            Column::make('Slug', 'slug')
                ->sortable()
                ->searchable(),

            Column::make('Description', 'description')
                ->sortable()
                ->searchable(),

            Column::make('Price', 'price')
                ->sortable()
                ->searchable()
                ->withSum('Sum Price', header: false, footer: true),

            Column::make('Stock', 'stock')
            ->editOnClick(
                    hasPermission:  auth()->check(),
                    fallback: '- empty -'
                ),
            Column::make('Category id', 'category_id'),
            Column::make('Brand id', 'brand_id'),
            Column::make('Discount id', 'discount_id'),
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('created_at'),

            Filter::inputText('category_id')
                ->filterRelation('category', 'name'),

            Filter::number('price_BRL', 'price')->thousands('.')
                ->decimal(','),
        ];
    }

    #[On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Product $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }
    public function onUpdatedEditable(string|int $id, string $field, string $value): void
    {

        Product::query()->find($id)->update([
            $field => e($value),
        ]);
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}

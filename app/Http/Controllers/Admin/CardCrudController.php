<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CardRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CardCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CardCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Card::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/card');
        CRUD::setEntityNameStrings('card', 'cards');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::column('name');
        CRUD::column('description');
        $this->crud->addColumn([
            'label' => 'Collection',
            'type' => 'select_multiple',
            'name' => 'collections', // the relationship name in your Model
            'entity' => 'collections', // the relationship name in your Model
            'attribute' => 'name', // attribute on Article that is shown to admin
            'model' => "App\Models\Collection",
        ], 'update');
        CRUD::column('created_at');
        CRUD::column('updated_at');
        

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CardRequest::class);

        CRUD::field('name');
        CRUD::field('description');

        $this->crud->addField([
            'label' => 'Collection',
            'type' => 'select_multiple',
            'name' => 'collections', // the relationship name in your Model
            'entity' => 'collections', // the relationship name in your Model
            'attribute' => 'name', // attribute on Article that is shown to admin
            'model' => "App\Models\Collection",
        ], 'update');

        CRUD::field('created_at');
        CRUD::field('updated_at');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Item::select('id','name','active')
                        ->where('active', true)
                            ->orderBy('name', 'ASC')
                                ->get();
    }

    /**
     * Display the whole listing of the resource.
     */
    public function indexAll()
    {
        return Item::orderBy('name', 'ASC')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $existingItem = Item::whereRaw( 'LOWER(name)=?', [strtolower($request->item["name"])] )->first();

        if($existingItem){

            $existingItem->active = true;
            $existingItem->save();

        }else{

            $newItem = new Item;
            $newItem->name = $request->item["name"];
            $newItem->save();

        }


        return $this->index();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $existingItem = Item::find( $id );

        if($existingItem){

            $existingItem->active = $existingItem->active ? false : true;
            $existingItem->save();

        }

        return $this->index();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

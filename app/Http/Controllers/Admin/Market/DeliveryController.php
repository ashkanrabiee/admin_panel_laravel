<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Delivery;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\DeliveryRequest;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $delivery_methods = Delivery::all();
        return view('admin.market.delivery.index', compact('delivery_methods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.market.delivery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryRequest $request)
    {
        $inputs = $request->all();
        $delivery = Delivery::create($inputs);
        return redirect()->route('admin.market.delivery.index')->with('swal-success', 'روش ارسال جدید شما با موفقیت ثبت شد');
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
    public function edit(Delivery $delivery)
    {
        return view('admin.market.delivery.edit', compact('delivery'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(DeliveryRequest $request, Delivery $delivery)
    {
        $inputs = $request->all();
        $delivery->update($inputs);
        return redirect()->route('admin.market.delivery.index')->with('swal-success', 'روش ارسال شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        $result = $delivery->delete();
       return redirect()->route('admin.market.delivery.index')->with('swal-success', 'روش ارسال شما با موفقیت حذف شد');
    }


    public function status(Delivery $delivery){

        $delivery->status = $delivery->status == 0 ? 1 : 0;
        $result = $delivery->save();
        if($result){
                if($delivery->status == 0){
                    return response()->json(['status' => true, 'checked' => false]);
                }
                else{
                    return response()->json(['status' => true, 'checked' => true]);
                }
        }
        else{
            return response()->json(['status' => false]);
        }

    }
}

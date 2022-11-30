<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    // Permissions -------------------
    public function __construct()
    {
        $this->middleware(['permission:Discount-read'])->only('index');
        $this->middleware(['permission:Discount-create'])->only(['store','create']);
        $this->middleware(['permission:Discount-update'])->only(['update','edit']);
        $this->middleware(['permission:Discount-delete'])->only('destroy');
    }
    
    public function index()
    {
        $discounts = Discount::all();
        return view('dashboard/discount/index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/discount/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|required|unique:discounts',
            'amount' => 'required'
        ]);

        Discount::create([
            'name' => $request->name,
            'amount' => $request->amount,
        ]);

        return redirect()->route('discount.index')->with('success','تمت الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->back()->with('success','تم الحذف بنجاح');
    }
}

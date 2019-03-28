<?php

namespace App\Http\Controllers;
use App\User;
use App\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $items = Auction::select('item_name', 'price')->where('guild_id', Auth::user()->guild_id)->get();
        return view('auctions.auctionIndex',[
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(Auth::user()->role_id);
        if(Auth::user()->role_id <= 4)
        {
            return redirect()->route('home');
        } else
        {
            return view('auctions.auctionNew',[
                'guild_id' => Auth::user()->guild_id,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newAucItem = new Auction;
        $newAucItem->item_name = $request->input('item_name');
        $newAucItem->description = $request->input('item_description');
        $newAucItem->price = $request->input('price');
        $newAucItem->user_create = Auth::id();
        $newAucItem->guild_id = $request->input('guild_id');
        $newAucItem->save();
        return redirect()->route('auction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

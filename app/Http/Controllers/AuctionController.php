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
        $activ_user = Auth::user()->role_id;
        if ($activ_user <= 2)
        {
            $mngm = true;
        } else 
        {
            $mngm = false;
        }
        $items = Auction::where('guild_id', Auth::user()->guild_id)->where('auc_status_id', 1)->get();
        return view('auctions.auctionIndex',[
            'items' => $items,
            'edit_visible' => $mngm,
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
        if(Auth::user()->role_id <= 2)
        {
            return view('auctions.auctionNew',[
                'guild_id' => Auth::user()->guild_id,
            ]);
        } else
        {
            return redirect()->back();
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
        $newAucItem->auc_status_id = 1;
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
        $auction_item = Auction::find($id);
        if(($auction_item->guild_id == Auth::user()->guild_id) && Auth::user()->role_id <= 2) //if item != guild -> redirect guild page 
        {
            return view('auctions.auctionEdit',[
                'item' => Auction::find($id),
            ]);
        } else 
        {
            return redirect()->route('guilds.show',['id' => Auth::user()->guild_id]);
        }
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
        $auc_item = Auction::find($id);
        if((Auth::user()->guild_id == $auc_item->guild_id) && Auth::user()->role_id <= 2)
        {
            $auc_item->item_name != $request->input('item_name') ? $auc_item->item_name = $request->input('item_name') : false;
            $auc_item->description != $request->input('description') ? $auc_item->description = $request->input('description') : false;
            $auc_item->price != $request->input('price') ? $auc_item->price = $request->input('price') : false;
            $auc_item->save();
            return redirect()->route('auction.index');
        }
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

    public function buy($id)
    {
        $auc = Auction::find($id);
        if(Auth::user()->guild_id == $auc->guild_id)
        {
            return view('auctions.auctionBuyItem',[
                'item' => $auc,
                'user' => Auth::user(),
            ]);
        } else 
        {
            return redirect()->route('home')->with('success','Opsss');
        }
    }
    public function buyConfirm(Request $request)
    {
        $item = Auction::find($request->input('item_id'));
        if(Auth::user()->guild_id == $item->guild_id)
        {
            if(Auth::user()->balance < $item->price)
            {
                return redirect()->back()->with('status','Low balance');
            } else {
                Auth::user()->balance = Auth::user()->balance - $item->price;
                Auth::user()->save();
                $item->user_customer = Auth::id();
                $item->auc_status_id = 2;
                $item->save();
                return redirect()->route('guilds.show',['id' => Auth::user()->guild_id])->with('status','You buy item'.$item->name);
            }
           
        } else 
        {
            return redirect()->route('guilds.show',['id' => Auth::user()->guild_id]);
        }
    }
    public function closeOrder($id)
    {
        $item = Auction::find($id);
        if(Auth::user()->role_id <= 2 && Auth::user()->guild_id == $item->guild_id)
        {
            $item->auc_status_id = 3;
            $item->save();
            return redirect()->route('auction.index')->with('status', 'Order CLOSE');
        } else 
        { 
            return redirect()->route('auction.index')->with('status', 'No access');
        }
    }
}

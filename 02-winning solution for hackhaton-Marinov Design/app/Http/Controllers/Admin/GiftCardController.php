<?php

namespace App\Http\Controllers\Admin;

use App\Models\GiftCard;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GiftCardController extends Controller
{
    public function index()
    {
        $giftCards = GiftCard::all();
        return view('gift-card.all-gift-cards', compact('giftCards'));
    }    

    public function create()
    {
        $code = Str::random(10);

        return view('gift-card.add-gift-card', compact('code'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'card_code' => 'required|unique:gift_cards',
            'amount' => 'required|numeric',
        ]);

        GiftCard::create([
            'card_code' => $request->input('card_code'),
            'amount' => $request->input('amount'),
        ]);

        return redirect()->route('gift-card.index')->with('successAdd   ', 'Gift card added successfully!');
    }

    public function edit($id)
    {
        $giftCard = GiftCard::findOrFail($id);

        return view('gift-card.edit-gift-card', compact('giftCard'));
    }

    public function update(Request $request, $id)
    {
        $giftCard = GiftCard::findOrFail($id);

        $request->validate([
            'card_code' => 'required|unique:gift_cards,card_code,' . $id,
            'amount' => 'required|numeric',
        ]);        

        $giftCard->update([
            'card_code' => $request->input('card_code'),
            'amount' => $request->input('amount'),
        ]);

        return redirect()->route('gift-card.index')->with('successEdit', 'Gift card updated successfully!');
    }

    public function destroy($id)
    {
        $giftCard = GiftCard::findOrFail($id);
        $giftCard->delete();

        return redirect()->route('gift-card.index')->with('successDelete', 'Gift card deleted successfully!');
    }
}
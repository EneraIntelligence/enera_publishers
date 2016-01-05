<?php

namespace Publishers\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Publishers\GiftCard;
use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;
use Validator;

class GiftCardsController extends Controller
{
    /**
     * Cnajear cupon
     */
    public function exchange()
    {
        $validator = Validator::make(Input::all(), [
            'coupon' => 'required|alpha_num',
        ]);
        if ($validator->passes()) {
            $card = GiftCard::where('code', Input::get('coupon'))->first();
            if ($card && $card->status == 'active') {
                $card->status = 'used';
                $card->save();
                if (auth()->user()->wallet->increment('current', $card->amount)) {
                    $move = auth()->user()->movements()->create([
                        'client_id' => auth()->user()->client_id,
                        'movement' => [
                            'type' => 'income',   //income, outcome
                            'concept' => 'deposit_giftcard',
                            'from' => 'giftcard',
                            'to' => 'wallet',
                        ],
                        'reference_id' => $card->_id,
                        'reference_type' => 'GiftCard',
                        'amount' => $card->amount,
                        'balance' => auth()->user()->wallet->current,
                    ]);
                    return redirect()->route('budget::deposits')->with('success', 'Tu GiftCard a sido abonada a tu saldo.');
                } else {
                    $card->status = 'active';
                    $card->save();
                    return redirect()->route('budget::deposits')->with('error', 'Tu GiftCard no pudo ser usada.');
                }
            } else {
                return redirect()->route('budget::deposits')->with('error', 'El codigo GiftCard no es valido.');
            }
        } else {
            return redirect()->route('budget::deposits')->withErrors($validator);
        }
    }
}

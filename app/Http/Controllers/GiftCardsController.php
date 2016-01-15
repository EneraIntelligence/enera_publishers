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
     * Canjear cupon
     */
    public function exchange()
    {
        $validator = Validator::make(Input::all(), [
            "coupon" => "required|alpha_num",
            "name" => "required",
            "address" => "required",
            "rfc" => "required|alpha_num",
            "country" => "required",
            "state" => "required",
            "city" => "required",
            "cp" => "required",
            "phone" => "required",
            "email" => "required|email",
        ]);
        if ($validator->passes()) {
            $card = GiftCard::where('code', Input::get('coupon'))->first();
            if ($card && $card->status == 'active') {
                if ($card->getDeadline() >= date('Y-m-d')) {
                    $user_cards = isset(auth()->user()->giftcards) ? auth()->user()->giftcards : [];
                    $step = !$card->filters['unique_user'] ?
                        (in_array($card->code, $user_cards) == false) : true;
                    if ($step) {
                        if (auth()->user()->wallet->increment('current', $card->amount)) {
                            $admin_payment = auth()->user()->payments()->create([
                                'amount' => $card->amount,
                                'type' => 'giftcard',
                                'status' => 'done',
                                'invoice' => [
                                    'name' => Input::get('name'),
                                    'address' => Input::get('address'),
                                    'rfc' => Input::get('rfc'),
                                    'state' => Input::get('state'),
                                    'city' => Input::get('city'),
                                    'cp' => Input::get('cp'),
                                    'phone' => Input::get('phone'),
                                    'email' => Input::get('email'),
                                ],
                                'giftcard' => [
                                    'code' => $card->code,
                                    'amount' => $card->amount,
                                    'filters' => [
                                        'unique_user' => $card->filters['unique_user'],
                                        'deadline' => $card->filters['deadline'],
                                    ]
                                ],
                            ]);

                            $move = auth()->user()->movements()->create([
                                'client_id' => auth()->user()->client_id,
                                'movement' => [
                                    'type' => 'income',   //income, outcome
                                    'concept' => 'deposit',
                                    'from' => 'giftcard',
                                    'to' => 'wallet',
                                ],
                                'reference_id' => $admin_payment->_id,
                                'reference_type' => 'Payment',
                                'amount' => $card->amount,
                                'balance' => auth()->user()->wallet->current,
                            ]);

                            if ($card->filters['unique_user']) {
                                $card->status = 'used';
                                $card->save();
                            }

                            auth()->user()->push('giftcards', $card->code, true);

                            return redirect()->route('budget::index')->with([
                                'n_type' => 'success',
                                'n_msg' => 'Tu GiftCard a sido abonada a tu saldo.'
                            ]);
                        } else {
                            return redirect()->route('budget::deposits')->with([
                                'n_type' => 'danger',
                                'n_msg' => 'Tu GiftCard no pudo ser usada.'
                            ]);
                        }
                    } else {
                        return redirect()->route('budget::deposits')->with([
                            'n_type' => 'danger',
                            'n_msg' => 'Tu GiftCard ya ha sido utilizada.'
                        ]);
                    }
                } else {
                    return redirect()->route('budget::deposits')->with([
                        'n_type' => 'danger',
                        'n_msg' => 'Tu GiftCard ha expirado.'
                    ]);
                }
            } else {
                return redirect()->route('budget::deposits')->with([
                    'n_type' => 'danger',
                    'n_msg' => 'Tu GiftCard no es valido.'
                ]);
            }
        } else {
            return redirect()->route('budget::deposits')->withErrors($validator);
        }
    }
}

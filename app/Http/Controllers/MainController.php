<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Mail\OrderDecline;
use App\Mail\OrderAccept;
use Mail;


class MainController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function order_list()
    {
        $orders = Order::all();

        return view('list_orders', ['orders' => $orders]);
    }

    public function store_order(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required|alpha|min:3|max:11|regex:/^[a-zA-Z]{3,11}$/u',
        ]);

        Order::create([
            'name' => $request->name,
            'status' => 'new',
            'email' => $request->email,
        ]);

        return redirect()->back()->with('message', 'Имя отправителя успешно доставленно модератору');

    }

    public function accept_order($id)
    {
        Order::where('id', $id)->update(['status' => 'accept']);

        $email = Order::where('id', $id)->value('email');

        Mail::to($email)->send(new OrderAccept());

        return redirect()->back()->with('message', 'Имя отправителя подтверженно');
    }

    public function decline_order(Request $request)
    {

        $email = Order::where('id', $request->id)->value('email');
        $text = $request->text;

        Mail::to($email)->send(new OrderDecline($text));

        Order::where('id', $request->id)->update(['status' => 'decline']);

        return redirect()->back()->with('message', 'Имя отправителя отклонено');
    }
}

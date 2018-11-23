<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Http\Requests\MoneyValidationFormRequest;
use App\User;
class BalanceController extends Controller
{
    public function index()
    {
        $amount = Balance::amount();

        return view('admin.balance.index', compact('amount'));
    }

    public function deposit()
    {
        return view('admin.balance.deposit');
    }

    public function depositStore(MoneyValidationFormRequest $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->deposit($request->value);

        //messages session
        \Session::flash('success',[
            'success' => $response['success'],
            'message' => $response['message']
        ]);

        return redirect()->back();
    }

    public function withdraw()
    {
        return view('admin.balance.withdraw');
    }

    public function withdrawStore(MoneyValidationFormRequest $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->withdraw($request->value);

        //messages session
        \Session::flash('success',[
            'success' => $response['success'],
            'message' => $response['message']
        ]);

        return redirect()->back();
    }

    public function transfer()
    {
        return view('admin.balance.transfer');
    }

    public function confirmTransfer(Request $request, User $user)
    {        
        $response = $user->getSender($request->sender);
        
        if ($response['success']) {
            
            //messages session
            \Session::flash('success',[
                'success' => $response['success'],
                'message' => $response['message'] 
            ]);

            return redirect()->back();
        }

        return view('admin.balance.confirm',[
            'sender' => $response
            ]);
    }

    public function transferStore(Request $request)
    {
        dd($request);
    }
}

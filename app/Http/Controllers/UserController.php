<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function getHome()
    {
        return view('customer.index');
    }

    public function createOrder()
    {
        return view('customer.order');
    }

    public function submitOrder(Request $request)
    {       
        $request->validate([
            'name' => 'required',
            'phoneNo' => 'required',
            'address' => 'required',
            'pickup_date' => 'required',
            'pickup_time' => 'required',
            'category_trash' => 'required',
            'amount' => 'required|numeric',
            'notes' => 'required',
            'file_payment' => 'required',
        ]);

        $user_id = Auth::id();

        $ordersubmission = Order::create([
            'user_id' => $user_id,
            'pickup_date'=> $request->input('pickup_date'),
            'pickup_time' => $request->input('pickup_time'),
            'category_trash'=> $request->input('category_trash'),
            'amount' => $request->input('amount'),
            'notes' => $request->input('notes'),
            'file_payment' => $request->input('file_payment'),
        ]);

        if($ordersubmission) {
            $user = User::find($user_id);
            $amount = $request->input('amount');
            if ($user) {
                $user->total_daur_ulang += $amount;
                if($amount < 10 ) {
                    $user->total_points += 5;
                } elseif ($amount > 10 && $amount < 20) {
                    $user->total_points += 10;
                } elseif ($amount > 20 ) {
                    $user->total_points += 15;
                }
                $user->save();
            }
            return redirect ('success-payment');
        }
    }

    public function getSuccessPayment()
    {
        return view('customer.form-success');
    }

    public function getCustomerService()
    {
        return view('customer.customer-service');
    }

    public function submitComplaint(Request $request)
    {       
        $request->validate([
            'name' => 'required',
            'phoneNo' => 'required',
            'email' => 'required',
            'subjek' => 'required',
            'description' => 'required',
        ]);

        $user_id = Auth::id();

        $complaintsubmission = Complaint::create([
            'user_id' => $user_id,
            'email' => $request->input('email'),
            'subjek'=> $request->input('subjek'),
            'description' => $request->input('description'),
        ]);

        if($complaintsubmission) {
            Session::flash('status','Tiket Berhasil Dikirimkan');
            return redirect('customer-service');
        }
    }

    public function getRiwayat()
    {
        return view('customer.riwayat');
    }

    public function getDataRiwayat(){
        $data_order = Order::all();
        return view('customer.riwayat', compact('data_order'));
    }

    public function deleteRiwayat($schedule_id)
    {
        $deleteRiwayat = Order::find($schedule_id);

        $deleteRiwayat->delete();
        
        if($deleteRiwayat) {
            Session::flash('deleteRiwayat','Data Deleted Succesfully');
            return redirect('riwayat');
        } else {
            dd($deleteRiwayat);
        }

    }

    public function getDetailRiwayat()
    {
        return view('customer.detail-riwayat');
    }

    
}

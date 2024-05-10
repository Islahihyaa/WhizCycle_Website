<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Complaint;
use App\Models\Article;
use App\Models\Rewarder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function getHome()
    {
        $user_data = Auth::user();
        return view('customer.index', compact('user_data'));
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
        }

    }

    public function getDetailRiwayat()
    {
        return view('customer.detail-riwayat');
    }

    public function getArticle()
    {
        $data_article = Article::all();
        return view('customer.show-article', compact('data_article'));
    }

    public function getDetailArticle(Request $request)
    {
        $data_article = Article::find($request->article_id);
        return view('customer.detail-article', [
            'article' => $data_article
        ]);
    }

    public function getTukarPoint()
    {
        $data_point = Rewarder::all();
        $user_data = Auth::user();
        return view('customer.redeem-point', compact('data_point', 'user_data'));
    }

    public function submitTukarPoint($redeem_id)
    {
        $rewarder = Rewarder::find($redeem_id);
    
        if (!$rewarder) {
            return back()->with('error', 'Rewarder tidak ditemukan.');
        }

        $user = Auth::user();

        if ($user->total_points >= $rewarder->point_rewarder) {
            $user->total_points -= $rewarder->point_rewarder;
            $user->save();

            return back()->with('success', 'Berhasil melakukan redeem point.');
        } else {
            return back()->with('error', 'Point Anda kurang.');
        }
        }

    
}

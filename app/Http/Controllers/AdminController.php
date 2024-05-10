<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Complaint;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Article;
use App\Models\User;
use App\Models\Rewarder;
use Session;

class AdminController extends Controller
{
    public function getDashboard()
    {
        $total_user = User::count();
        $recyle_total = DB::table('user')->sum('total_daur_ulang');
        $data_article = Article::all();
        return view('admin.dashboard', [
            'total_user' => $total_user,
            'recyle_total' => $recyle_total,
            'data_article' => $data_article,
        ]);
    }

    public function getResponseComplaint()
    {
        $complaintdata = Complaint::all();
        return view('admin.response-complaint', compact('complaintdata'));
    }

    public function deleteComplaint($complaint_id)
    {
        $deleteComplaint = Complaint::find($complaint_id);

        $deleteComplaint->delete();
        
        if($deleteComplaint) {
            Session::flash('successDeleteComplaint','Data berhasil dihapus');
            return redirect('response-complaint');
        } else {
            Session::flash('failDeleteComplaint','Data gagal dihapus');
            return redirect('response-complaint');
        }

    }

    public function updateStatus(Request $request, $complaint_id)
    {
        $statusComplaint = Complaint::find($complaint_id);
        $statusComplaint->status = $request->input('status');
        $statusComplaint->save();

        Session::flash('updateStatus',"Data Updated To $statusComplaint->status");
        return redirect('response-complaint');

    }

    public function getManageVehicle()
    {
        $data_vehicle = Vehicle::all();
        return view('admin.manage-vehicles', compact('data_vehicle'));
    }
    
    public function getAddVehicle()
    {
        return view('admin.add-vehicles');
    }

    public function submitAddVehicle(Request $request)
    {       
        $request->validate([
            'name_vehicle' => 'required|min:5|max:20',
            'category_vehicle' => 'required',
            'description_vehicle' => 'required',
            'status_vehicle' => 'required',
        ]);

        $createAddVehicle = Vehicle::create([
            'name_vehicle' => $request->input('name_vehicle'),
            'category_vehicle'=> $request->input('category_vehicle'),
            'description_vehicle' => $request->input('description_vehicle'),
            'status_vehicle' => $request->input('status_vehicle'),
        ]);


        if($createAddVehicle) {
            Session::flash('status','Data Kendaraan Berhasil Ditambahkan');
            return redirect('add-vehicles');
        } else { 
            Session::flash('notSetDataMessage', 'Data Kendaaraan Gagal Ditambahkan');
            return redirect('add-vehicles');
        }
    }

    public function updateStatusVehicle(Request $request, $vehicle_id)
    {
        $statusVehicle = Vehicle::find($vehicle_id);
        $statusVehicle->status_vehicle = $request->input('status_vehicle');
        $statusVehicle->save();

        Session::flash('updateStatusVehicle',"Data Updated To $statusVehicle->status_vehicle");
        return redirect('manage-vehicles');

    }

    public function deleteVehicle($vehicle_id)
    {
        $deleteVehicle = Vehicle::find($vehicle_id);
        $deleteVehicle->delete();   
        
        if($deleteVehicle) {
            Session::flash('successDeleteVehicle','Data berhasil dihapus');
            return redirect('manage-vehicles');
        } else {
            Session::flash('failDeleteVehicle','Data gagal dihapus');
            return redirect('manage-vehicles');
        }
    }

    public function getManageDriver()
    {
        $data_driver = Driver::all();
        return view('admin.manage-driver', compact('data_driver'));
    }

    public function getAddDriver()
    {
        $data_vehicle = Vehicle::all();
        return view('admin.add-driver', compact('data_vehicle'));
    }

    public function submitAddDriver(Request $request)
    {       
        $request->validate([
            'name_driver' => 'required',
            'phoneNo_driver' => 'required',
            'license_number' => 'required',
            'vehicle_id' => 'required',
        ]);

        $createAddDriver = Driver::create([
            'name_driver' => $request->input('name_driver'),
            'phoneNo_driver'=> $request->input('phoneNo_driver'),
            'license_number' => $request->input('license_number'),
            'vehicle_id' => $request->input('vehicle_id'),
        ]);


        if($createAddDriver) {
            Session::flash('status','Data Driver Berhasil Ditambahkan');
            return redirect('add-driver');
        } else { 
            Session::flash('notSetDataMessage', 'Data Driver Gagal Ditambahkan');
            return redirect('add-driver');
        }
    }

    public function deleteDriver($driver_id)
    {
        $deleteDriver = Driver::find($driver_id);
        $deleteDriver->delete();
        
        if($deleteDriver) {
            Session::flash('successDeleteDriver','Data berhasil dihapus');
            return redirect('manage-driver');
        } else {
            Session::flash('failDeleteDriver','Data gagal dihapus');
            return redirect('manage-driver');
        }
    }

    public function getArticle()
    {
        $data_article = Article::all();
        return view('admin.manage-article', compact('data_article'));
    }

    public function show_detail_article(Request $request) {
        $article = Article::find($request->article_id);

        return view('admin.detail-article', [
            'article' => $article
        ]);
    }

    public function getAddArticle()
    {
        return view('admin.add-article');
    }

    public function submitAddArticle(Request $request)
    {       
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image_article' => 'required',
        ]);

        $article_image_path = $request->file('image_article')->store('article-image', 'public');

        $createAddArticle = Article::create([
            'title' => $request->input('title'),
            'content'=> $request->input('content'),
            'image_article' => $article_image_path,
        ]);

        if($createAddArticle) {
            Session::flash('status','Data Article Berhasil Ditambahkan');
            return redirect('add-article');
        } else { 
            Session::flash('notSetDataMessage', 'Data Article Gagal Ditambahkan');
            return redirect('add-article');
        }
    }

    public function destroy_article(Request $request) {
        $article = Article::find($request->article_id);

        $article->delete();

        Session::flash('success-to-delete-article', 'Data Arttkel' . $article->title . ' Berhasil Dihapus');
        return redirect(url('manage-article'));
    }

    public function getManageOrder()
    {
        $data_order = Order::all();
        return view('admin.manage-order', compact('data_order'));
    }

    public function detailOrder($schedule_id)
    {
        $updateOrder = Order::find($schedule_id);
        $data_driver = Driver::all();
        return view('admin.update-order', compact('updateOrder', 'data_driver'));
    }

    public function submitUpdateOrder(Request $request, $schedule_id)
    {   
        $updateOrder = Order::find($schedule_id);
        $updateOrder->status = $request->input('status');
        $updateOrder->driver_id = $request->input('driver_id');

        $updateOrder->save();

        if($updateOrder) {
            Session::flash('status','Data Order Berhasil Ditambahkan');
            return redirect('manage-order');
        } else { 
            Session::flash('notSetDataMessage', 'Data Order Gagal Ditambahkan');
            return view('admin.update-order');
        }
    }

    public function getManagePoint()
    {
        $data_rewarder = Rewarder::all();
        return view('admin.manage-point', compact('data_rewarder'));
    }

    public function getAddRewarder()
    {
        return view('admin.add-rewarder');
    }

    public function submitAddRewarder(Request $request)
    {   
        $request->validate([
            'name_rewarder' => 'required',
            'title_rewarder' => 'required',
            'point_rewarder' => 'required',
            'description_rewarder' => 'required',
            'logo_rewarder' => 'required',
        ]);

        $rewarder_logo_path = $request->file('logo_rewarder')->store('rewarder-image', 'public');

        $createLogoRewarder = Rewarder::create([
            'name_rewarder' => $request->input('name_rewarder'),
            'title_rewarder'=> $request->input('title_rewarder'),
            'point_rewarder'=> $request->input('point_rewarder'),
            'description_rewarder'=> $request->input('description_rewarder'),
            'logo_rewarder' => $rewarder_logo_path,
        ]);

        if($createLogoRewarder) {
            Session::flash('status','Data Article Berhasil Ditambahkan');
            return redirect('add-rewarder');
        } else { 
            Session::flash('notSetDataMessage', 'Data Article Gagal Ditambahkan');
            return redirect('add-rewarder');
        }
    }

    public function deleteRewarder($redeem_id)
    {
        $deleteRewarder = Rewarder::find($redeem_id);
        $deleteRewarder->delete();
        
        if($deleteRewarder) {
            Session::flash('successDeleteRewarder','Data berhasil dihapus');
            return redirect('manage-points');
        } else {
            Session::flash('failDeleteRewarder','Data gagal dihapus');
            return redirect('manage-points');
        }
    }
}

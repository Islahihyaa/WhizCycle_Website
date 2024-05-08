<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Vehicle;
use Session;

class AdminController extends Controller
{
    public function getDashboard()
    {
        return view('admin.dashboard');
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
}

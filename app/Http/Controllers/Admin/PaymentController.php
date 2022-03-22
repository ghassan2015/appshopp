<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{

    public function index(Request $request)
    {


        return view('admin.supervisors.index');

    }
    public function getSupervisor(Request $request)
    {
        $data = Payment::query();
        return DataTables::of($data)
            ->addColumn('name', function ($data) {
                return $data->freelancer->first_name.' '.$data->freelancer->name;
            })
            ->addColumn('email', function ($data) {
                return $data->freelancer->email;

            })
            ->addColumn('payment_value', function ($data) {
                return $data->payment_value;

            })
            ->addColumn('status', function ($data) {


            })
            ->addColumn('action', function ($data) {


                $button = '<a    href="'.route('admin.supervisors.edit',$data->id).'" ><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a>';

//                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
//                $button .= '<a  id="' . $data->id . '"  sup_name="' . $data->first_name.''.$data->last_name . '" class="delete "><span><i  style="color: red" class="fas fa-trash-alt"></i></span></button>';
//                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                return $button;

            })->rawColumns(['action'])
            ->make(true);
    }
}

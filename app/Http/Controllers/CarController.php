<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Yajra\DataTables\DataTables;

class CarController extends Controller
{
    public function getListCar(Request $request) {
        if ($request->ajax()) {
            return $this->datatables();
        }
        return view('dashboard.list-car');
    } 

    public function datatables()
    {
        $car = Car::select(
            'suzuki_car.id as ID',
            'suzuki_car.car_name as carName',
            'suzuki_car.price as Price',
            'suzuki_car.type as Type',
        )->orderBy("id")->get();

        return DataTables::of($car)
        ->editColumn('Type', function ($car)
        {
            if($car->Type == 1) {
                return "Nhập khẩu nguyên chiếc";
            } else if($car->Type == 2) {
                return "Lắp ráp trong nước";
            }
        })
        ->editColumn('Price', function ($car)
        {
            return number_format($car->Price, 0, '', ',');
        })
        ->make(true);
    }

    public function addNewCar(Request $request) {
        $price = str_replace('.', '', preg_replace('/,/', '', $request->price));

        if($request->carID != null) {
            Car::where("id", $request->carID)->update([
                'car_name' => $request->carName,
                'price' => $price,
                'type' => $request->type,
            ]);
        } else {
            Car::insert([
                'car_name' => $request->carName,
                'price' => $price,
                'type' => $request->type,
            ]);
        }

        return redirect()->route('car.get');
    }

    public function carDetail(Request $request) {
        $carDetail = Car::where("id", $request->id)->first();

        return response()->json(['carDetail'=>$carDetail]);
    }

    public function carDelete(Request $request) {
        $carDetail = Car::where("id", $request->id)->delete();

        return redirect()->route('car.get');
    }
}

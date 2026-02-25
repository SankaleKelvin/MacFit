<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
     //CRUD FUNCTIONS
    //Create
    public function createEquipment(Request $request){
        $validated = $request->validate([
            'name'=>'required|string',
            'usage'=>'required|string|max:1000',
            'model_no'=>'required|string|unique:equipment,model_no',
            'value'=>'required|number',
            'status'=>'required|string'
        ]);

        $equipment = new Equipment();
        $equipment->name = $validated['name'];
        $equipment->usage = $validated['usage'];
        $equipment->model_no = $validated['model_no'];
        $equipment->value = $validated['value'];
        $equipment->status = $validated['status'];
        try{
            $equipment->save();
            return response()->json([
                'message'=>'Equipment Saved Successfully.'
            ], 200);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Save a Equipment.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    //Read All Equipments
    public function readAllEquipments(){
        try{
            $equipments = Equipment::all();
            return response()->json($equipments);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch Equipments.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }


    //Read Equipment(id)
    public function readEquipment($id){
        try{
            $equipment = Equipment::findOrFail($id);
            return response()->json($equipment);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch the Equipment.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    //Update equipment(id)
    public function updateEquipment(Request $request, $id){
        $validated = $request->validate([
            'name'=>'required|string',
            'usage'=>'required|string|max:1000',
            'model_no'=>'required|string|unique:equipment,model_no',
            'value'=>'required|number',
            'status'=>'required|string'
        ]);

        $equipment = Equipment::findOrFail($id);
        $equipment->name = $validated['name'];
        $equipment->usage = $validated['usage'];
        $equipment->model_no = $validated['model_no'];
        $equipment->value = $validated['value'];
        $equipment->status = $validated['status'];
        try{
            $equipment->save();
            return response()->json([
                'message'=>'Equipment Updated Successfully.'
            ], 200);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Update the Equipment.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    //Delete equipment(id)
    public function deleteEquipment($id){
        try{
            $equipment = Equipment::findOrFail($id);
            $equipment->delete();
            return response('Equipment Deleted Successfully');
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Delete the Equipment.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }
}

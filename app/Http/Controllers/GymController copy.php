<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use Illuminate\Http\Request;

class GymController extends Controller
{
    //CRUD FUNCTIONS
    //Create
    public function createGym(Request $request){
        $validated = $request->validate([
            'name'=>'required|string|unique:gyms,name',
            'description'=>'nullable|string|max:1000',
            'longitude'=>'required|string',
            'latitude'=>'required|string',
        ]);

        $gym = new Gym();
        $gym->name = $validated['name'];
        $gym->description = $validated['description'];
        $gym->longitude = $validated['longitude'];
        $gym->latitude = $validated['latitude'];
        try{
            $gym->save();
            return response()->json([
                'message'=>'Gym Saved Successfully.'
            ], 200);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Save a Gym.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    //Read All Gyms
    public function readAllGyms(){
        try{
            $gyms = Gym::all();
            return response()->json($gyms);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch Gyms.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }


    //Read Gym(id)
    public function readGym($id){
        try{
            $gym = Gym::findOrFail($id);
            return response()->json($gym);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch the Gym.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    //Update gym(id)
    public function updateGym(Request $request, $id){
        $validated = $request->validate([
            'name'=>'required|string|unique:gyms,name',
            'description'=>'nullable|string|max:1000',
            'longitude'=>'required|string',
            'latitude'=>'required|string',
        ]);

        $gym = Gym::findOrFail($id);
        $gym->name = $validated['name'];
        $gym->description = $validated['description'];
        $gym->longitude = $validated['longitude'];
        $gym->latitude = $validated['latitude'];
        try{
            $gym->save();
            return response()->json([
                'message'=>'Gym Updated Successfully.'
            ], 200);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Update the Gym.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    //Delete gym(id)
    public function deleteGym($id){
        try{
            $gym = Gym::findOrFail($id);
            $gym->delete();
            return response('Gym Deleted Successfully');
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Delete the Gym.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }
}

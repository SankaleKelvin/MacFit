<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use Illuminate\Http\Request;

class BundleController extends Controller
{
    //CRUD FUNCTIONS
    //Create
    public function createBundle(Request $request){
        $validated = $request->validate([
            'name'=>'required|string|unique:bundles,name',
            'start_time'=>'required',
            'duration'=>'required',
            'value'=>'required|number',
            'description'=>'required|string|max:1000',
            'category_id'=>'required|integer|exists:categories,id',
        ]);

        $bundle = new Bundle();
        $bundle->name = $validated['name'];
        $bundle->start_time = $validated['start_time'];
        $bundle->duration = $validated['duration'];
        $bundle->value = $validated['value'];
        $bundle->description = $validated['description'];
        $bundle->category_id = $validated['category_id'];
        try{
            $bundle->save();
            return response()->json([
                'message'=>'Bundle Saved Successfully.'
            ], 200);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Save a Bundle.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    //Read All Bundles
    public function readAllBundles(){
        try{
            $bundles = Bundle::all();
            return response()->json($bundles);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch Bundles.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }


    //Read Bundle(id)
    public function readBundle($id){
        try{
            $bundle = Bundle::findOrFail($id);
            return response()->json($bundle);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch the Bundle.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    //Update bundle(id)
    public function updateBundle(Request $request, $id){
        $validated = $request->validate([
            'name'=>'required|string|unique:bundles,name',
            'start_time'=>'required',
            'duration'=>'required',
            'value'=>'required|number',
            'description'=>'required|string|max:1000',
            'category_id'=>'required|integer|exists:categories,id',
        ]);

        $bundle = Bundle::findOrFail($id);
        $bundle->name = $validated['name'];
        $bundle->start_time = $validated['start_time'];
        $bundle->duration = $validated['duration'];
        $bundle->value = $validated['value'];
        $bundle->description = $validated['description'];
        $bundle->category_id = $validated['category_id'];
        try{
            $bundle->save();
            return response()->json([
                'message'=>'Bundle Updated Successfully.'
            ], 200);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Update the Bundle.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    //Delete bundle(id)
    public function deleteBundle($id){
        try{
            $bundle = Bundle::findOrFail($id);
            $bundle->delete();
            return response('Bundle Deleted Successfully');
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Delete the Bundle.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //CRUD FUNCTIONS
    //Create
    public function createSubscription(Request $request){
        $validated = $request->validate([            
            'bundle_id'=>'required|integer|exists:bundles,id',
        ]);

        $userId = auth()->user()->id;

        $subscription = new Subscription();
        $subscription->user_id = $userId;
        $subscription->bundle_id = $validated['bundle_id'];
        try{
            $subscription->save();
            return response()->json([
                'message'=>'Subscription Saved Successfully.'
            ], 200);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Save a Subscription.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    //Read All Subscriptions
    public function readAllSubscriptions(){
        try{
            // $subscriptions = Subscription::all();
            $subscriptions = Subscription::join('users','subscriptions.user_id','=','users.id')
                                        ->join('bundles','subscriptions.bundle_id','=','bundles.id')
                                        ->select('subscriptions.*', 'bundles.value as bundle_value', 'users.name as user_name', 'bundles.name as bundle_name')
                                        ->get();
            return response()->json($subscriptions);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch Subscriptions.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }


    //Read Subscription(id)
    public function readSubscription($id){
        try{
            $subscription = Subscription::findOrFail($id);
            return response()->json($subscription);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch the Subscription.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    //Update subscription(id)
    public function updateSubscription(Request $request, $id){
        $validated = $request->validate([
            'user_id'=>'required|integer|exists:users,id',
            'bundle_id'=>'required|integer|exists:bundles,id',
        ]);

        $subscription = Subscription::findOrFail($id);
        $subscription->user_id = $validated['user_id'];
        $subscription->bundle_id = $validated['bundle_id'];
        try{
            $subscription->save();
            return response()->json([
                'message'=>'Subscription Updated Successfully.'
            ], 200);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Update the Subscription.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    //Delete subscription(id)
    public function deleteSubscription($id){
        try{
            $subscription = Subscription::findOrFail($id);
            $subscription->delete();
            return response('Subscription Deleted Successfully');
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Delete the Subscription.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    public function getUserCharges(){
        $user = auth()->user();
        $userId = $user->id;

        $userCharge = Subscription::where('user_id', $userId)
                        ->join('users', 'subscriptions.user_id', '=', 'users.id')
                        ->join('bundles', 'subscriptions.bundle_id', '=', 'bundles.id')
                        ->sum('bundles.value');
        return response()->json([
            'user'=>$user->name,
            'total_charge'=>$userCharge,
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Website;

use App\Models\eservices_orders;
use App\Models\PrivateOrder;

use App\Models\PublicOrder;
use App\Models\Review;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;


class ReviewController extends Controller
{
    public function reviews(Request $request)
    {
        $user = User::with('avgReviews')->find(auth()->id());
        return view('website.user.reviews', ['user' => $user]);
    }

    public function reviewsForm($order_type, $order_id, $provider_id)
    {

        //check if this order was rated befor!
        //do something for example redirect to /settings or to /reviews for this provider
        //elsewise


        $provider = User::with('avgReviews')->find($provider_id);

        return view('website.user.reviews_form', ['order_type' => $order_type, 'user' => $provider, 'order_id' => $order_id]);
    }

    public function makeReviews(Request $request)
    {
        //check if this order belongs to this user  !

        if ($request->order_type == 'public-order'){
            $belongs_to = PublicOrder::where(['user_id' => Auth::id(), 'id' => $request->order_id])->first();
        }

        if ($request->order_type == 'private-order'){
            $belongs_to = PrivateOrder::where(['user_id' => Auth::id(), 'id' => $request->order_id])->first();
        }

        if ($request->order_type == 'eservice-order'){
            $belongs_to = Eservices_orders::where(['user_id' => Auth::id(), 'id' => $request->order_id])->first();
        }

        if (!$belongs_to)
            return 'You dont have permissions to make rate!';



        //check if this order was rated befor!
        $rated_befor = Review::where(['order_id' => $request->order_id, 'order_type' => $request->order_type])->first();
        if ($rated_befor)
            return 'You have already rated this order befor';
        //elsewise
        $reviews = Review::create($request->all() + [
            'user_id' => Auth::id(),
        ]);
        return $reviews->id;
    }
}

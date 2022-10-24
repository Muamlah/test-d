@foreach($balance_orders as $order)
<tr  class="h-40px">
    <th scope="row">{{$order->id}}</th>

    {{-- <td>{{!is_null($order->user) ? $order->user->name ."-". $order->user->phone : "---"}}</td>
    <td>{{!is_null($order->provider) ? $order->provider->name ."-". $order->provider->phone : "---"}}</td> --}}
    <td>
        {{-- {{!is_null($order->user) ? $order->user->name ."-". $order->user->phone : "---"}} --}}
        @if(!empty($order->user))
            <a target="_blank" href="user-informations/{{$order->user->id}}">{{$order->user->name}}</a><br>
            <a target="_blank" href="https://api.whatsapp.com/send?phone=966{{substr($order->user->phone, 1)}}" class="">
                {{$order->user->phone}}
                <i class="fab fa-whatsapp"></i>
            </a>
        @else
            ---
        @endif
    </td>
    <td>
        {{-- {{!is_null($order->provider) ? $order->provider->name ."-". $order->provider->phone : "---"}} --}}
        @if(!empty($order->provider))
            <a target="_blank" href="https://api.whatsapp.com/send?phone=966{{substr($order->provider->phone,1)}}" class="">
                {{$order->provider->phone}}
                <i class="fab fa-whatsapp"></i>
            </a>
        @else
            ---
        @endif
    </td>
    <td><span class="label label-inline label-light-wating font-weight-bold">{{__('dashboard.balance_order')}}</span></td>
    <td>{!! \Illuminate\Support\Str::limit($order->details, 250) !!}</td>
        <td>{{$order->price}}</td>
    <td>{{$order->created_at}}</td>
</tr>
@endforeach

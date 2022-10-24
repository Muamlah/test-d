<div class="row">
    <div class="col-md-4">
        <div class="card-counter primary">
            <i class="fas fa-users"></i>
        <span class="count-numbers">{{$users_today_count}}</span>
        <span class="count-name">{{__('dashboard.today_number_of_users')}}</span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-counter danger">
            <i class="fas fa-users"></i>
        <span class="count-numbers">{{$providers_today_count}}</span>
        <span class="count-name">{{__('dashboard.today_number_of_providers')}}</span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-counter success">
            <i class="fas fa-handshake"></i>
        <span class="count-numbers">{{$orders_today_count}}</span>
        <span class="count-name">{{__('dashboard.today_number_of_orders')}}</span>
        </div>
    </div>
</div>
</br>


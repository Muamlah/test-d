@foreach($balance_request as $item)
    <a data-toggle="collapse" href="#invoice-1" aria-expanded="false" aria-controls="invoice-1" class="card card-style mb-2">
        <div class="content">
            <div class="d-flex mb-n1">
                <div class="align-self-center">
                    <img src="{{auth()->user()->getImage()}}" width="40" class="rounded-xl ml-3">
                </div>
                <div>
                    <h3 class="font-16">#{{$item->id}} {{$item->description}}</h3>
                    <p class="opacity-80 font-10 mt-n2">{{@$item->created_at->format('d M Y')}}</p>
                </div>
                <div class="mr-auto text-center">
                    @if($item->status == 'completed')
                        <span class="bg-green3-dark rounded-xs text-uppercase font-900 font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                            تم التسليم
                        </span>
                    @else
                        <span class="bg-yellow1-dark rounded-xs text-uppercase font-900 font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                            بانتظار التنفيذ
                        </span>
                    @endif
                    <h2 class="mb-n1 font-18 color-highlight">{{$item->amount}} <span class="font-13">ريال</span>
                    </h2>
                </div>
            </div>
        </div>
    </a>
    <div class="divider mb-2 mt-n2"></div>
@endforeach

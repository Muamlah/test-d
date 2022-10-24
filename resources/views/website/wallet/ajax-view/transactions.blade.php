@foreach($items as $item)
    <a href="#" class="d-flex mb-3">

        <div class="align-self-center">
            <h1 class="mb-n2 font-16">{{@$item->description}}</h1>
        </div>
        <div class="align-self-center mr-auto text-left">
            @if(@$item->type == 'deposit')
                <h2 class="mb-n1 font-18 color-highlight">+ {{@$item->amount}} <span class="font-13">ريال</span></h2>
            @else
                <h2 class="mb-n1 font-18 color-red2-dark">- {{@$item->amount}} <span class="font-13">ريال</span></h2>
            @endif
            <p class="font-12 opacity-50">{{@$item->created_at->format('d-m-Y')}}</p>
        </div>
    </a>
@endforeach

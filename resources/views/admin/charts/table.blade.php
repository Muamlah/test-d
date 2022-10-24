<h4 class="text-center">
    {{__('dashboard.wating_orders')}}
</h4>
<ul class="nav nav-tabs" id="myTab" role="tablist">
{{--  <li class="nav-item">--}}
{{--    <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">({{$eservices_orders_count}}) طلبات الخدمات الإلكترونية</a>--}}
{{--  </li>--}}
  <li class="nav-item">
    <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">({{$public_orders_count}}) طلبات الخدمات الإلكترونية</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
    <table class="">
      <thead>
        <tr >
          <th scope="col">#</th>
          <th scope="col">{{__('dashboard.user')}}</th>
          <th scope="col">{{__('dashboard.provider')}}</th>
          <th scope="col">{{__('common.status_pay')}}</th>
          <th scope="col">{{__('dashboard.details')}}</th>
          <th scope="col">{{__('dashboard.price')}}</th>
          <th scope="col">{{__('dashboard.created_at')}}</th>
          {{-- <th scope="col">{{__('dashboard.actions')}}</th> --}}
        </tr>
      </thead>
      <tbody id="eservices-head">

      </tbody>
      <tfoot>

        <tr>
          <td colspan="7">
            <a class="btn btn-success w-100 see-more" data-page="1" data-link="{{route('admin.current_orders',['type' => 'eservices'])}}" data-div="#eservices-head" href="javascript:;">تحميل المزيد</a>

          </td>
        </tr>
      </tfoot>
    </table>
  </div>
  <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
    <table class="">
      <thead>
        <tr >
          <th scope="col">#</th>
          <th scope="col">{{__('dashboard.user')}}</th>
          <th scope="col">{{__('dashboard.provider')}}</th>
          <th scope="col">{{__('common.status_pay')}}</th>
          <th scope="col">{{__('dashboard.details')}}</th>
          <th scope="col">{{__('dashboard.price')}}</th>
          <th scope="col">{{__('dashboard.created_at')}}</th>
          {{-- <th scope="col">{{__('dashboard.actions')}}</th> --}}
        </tr>
      </thead>
      <tbody id="public-head">

      </tbody>
      <tfoot>
        <tr>
          <td colspan="7">
            <a class="btn btn-success w-100 see-more" data-page="1" data-link="{{route('admin.current_orders',['type' => 'public'])}}" data-div="#public-head" href="javascript:;">تحميل المزيد</a>

          </td>
        </tr>

      </tfoot>
    </table>
  </div>
</div>
@section('script')
<script>
  $(".see-more").click(function() {
      let div = $($(this).data('div')); //div to append
      let link = $(this).data('link'); //current URL
      let page = $(this).data('page'); //get the next page #
      let thisSeeMore =$(this);
      let href = link + '?page='+ page; //complete URL
      $.ajax(
          {
              url:   href,
              type: "get",
              beforeSend: function()
              {
                  thisSeeMore.html('جاري التحميل....');
              }
          })
          .done(function(data)
          {
              if(data == ""){
                  thisSeeMore.html('لا يوجد المزيد');
                  thisSeeMore.hide(1000);
                  return;
              }
              thisSeeMore.data('page',page + 1); //update page #
              div.append(data).show(1000);
              thisSeeMore.html('المزيد');
          })
          .fail(function(jqXHR, ajaxOptions, thrownError)
          {
              alert('الرجاء المحاولة مرة اخرى');
          });
  });
  $(".see-more").click();
</script>
@endsection

@extends('website.layout')

@section('content')
    <div class="page-content header-clear-medium">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">اعادة تعين كلمة السر</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.phone') }}" id="resetForm">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">رقم الهاتف</label>

                            <div class="col-md-6">
                                <input id="phone" type="tel"  placeholder="رقم الموبايل" title="يجب ان يكون رقم هاتف سعودي" pattern="(05)([0-9]{8})" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="reset" class="btn btn-primary">
                                    ارسال
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('#reset').click(function() {
            $(this).attr('disabled',true);
            $('#resetForm').submit();
            return true;
        });
    </script>
@endsection

<div class="card">
    <div class="card-body">
        <form action="">
            <div class="row align-items-center">
                <div class="col-md-5 my-2 my-md-0">
                    <div class="form-group">
                        <label>من تاريخ </label>
                        <input type="date" name="since" value="{{request()->has('since') ? request()->since : ''}}" class="form-control kt_datatable_date_from" placeholder="من تاريخ">
                    </div>
                </div>
                <div class="col-md-5 my-2 my-md-0">
                    <div class="form-group">
                        <label>إلى تاريخ </label>
                        <input type="date" name="until" value="{{request()->has('until') ? request()->until : ''}}" id="kt_datatable_date_to" class="form-control" placeholder="إلى تاريخ">
                    </div>
                </div>
                <div class="col-md-2 my-2 my-md-0">
                    <button type="submit" class="btn btn-primary" style="width:100%" id="kt_account_profile_details_submit">فلترة</button>
                </div>
            </div>
        </form>
    </div>
</div>
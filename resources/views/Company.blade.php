@extends('layouts.app')


@section('content')
<link href="{{ URL::asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css">

<script>
    $(document).ready(function() {

        $('#save').click(function(){
            if($("#company_name").val()==-1){
                alert("Please select company from the list");
                return;
            }

            var status = "Active";

            if($("#trading_name").val().length == 0){
                status = "Incomplete";
            }

            if($("#abn").val().length == 0){
                status = "Incomplete";
            }

            if($("#building_number").val().length == 0){
                status = "Incomplete";
            }

            if($("#street_name").val().length == 0){
                status = "Incomplete";
            }

            if($("#city_name").val().length == 0){
                status = "Incomplete";
            }

            if($("#primary_contact").val().length == 0){
                status = "Incomplete";
            }

            if($("#secondry_contact").val().length == 0){
                status = "Incomplete";
            }



            $.ajax({
                method:"POST",
                url:"/provider/save",
                data:{
                    "_token": "{{ csrf_token() }}",
                    "id":$("#company_name").val(),
                    "trading_name": $("#trading_name").val(),
                    "building_number": $("#building_number").val(),
                    "abn": $("#abn").val(),
                    "street_name":$("#street_name").val(),
                    "city_name":$("#city_name").val(),
                    "primary_contact":$("#primary_contact").val(),
                    "secondry_contact":$("#secondry_contact").val(),
                    "status":status,

                },
                async:false,
                success: function(response){
                    $("#message").text(response);
                    return;
                },
                error: function(err){
                    $("#message").text(err);
                    //console.log(err);
                }
            });
       });

    });

</script>

<form method="POST" action="{{ ('/provider/save') }}">
{!! csrf_field() !!}
<div class="content">
    <div class="card">
        <div class="col-md-12">
            <fieldset class="content-group">
                <legend class="text-uppercase font-weight-bold">Company Information</legend>
                <div class="form-group row">
                    <div class="col-md-12">
                        <span class="error" id="message"></span>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <lable class="font-size-sm">Company Name</lable>
                        <input type="text" name="company_name" id="company_name"  class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <lable class="font-size-sm">Trading Name</lable>
                        <input type="text" name="trading_name" id="trading_name"  class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <lable class="font-size-sm">Building Number</lable>
                        <input type="text" name="building_number" id="building_number"  class="form-control">
                    </div>
                    <div class="col-md-6">
                        <lable class="font-size-sm">ABN</lable>
                        <input type="text" name="abn" id="abn"  class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <lable class="font-size-sm">Street Name</lable>
                        <input type="text" name="street_name" id="street_name"  class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <lable class="font-size-sm">City</lable>
                        <input type="text" name="city_name" id="city_name"  class="form-control">
                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <lable class="font-size-sm">Primary Contact</lable>
                        <input type="text" name="primary_contact" id="primary_contact"  class="form-control">
                    </div>
                    <div class="col-md-6">
                        <lable class="font-size-sm">Secondry Contact</lable>
                        <input type="text" name="secondry_contact" id="secondry_contact"  class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-9">&nbsp;</div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-light btn-width">Close</button>&nbsp;&nbsp;
                        <button type="button" id="save" class="btn btn-success btn-width" >Save</button>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
</form>
@endsection

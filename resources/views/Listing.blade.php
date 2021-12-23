@extends('layouts.app')

@section('content')
<link href="{{ URL::asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css">
<script type="text/javascript">
  $(document).ready(function() {
    $.ajax({
        method:"GET",
        url:"/provider/getCompany",
        async:false,
        success: function(response){

            for(i=0;i<response.length;i++){
                $('#tblProviders tr:last').after("<tr class='detail'><td>"+response[i]['TradingName']+"</td><td>"+response[i]['ABNNo']+"</td><td><a href=http://maps.google.com/maps?q="+response[i]['BuildingNo']+"+"+response[i]['StreetName']+"+,"+response[i]['City']+" target='_blank'>View map</a></td></tr>");
                //alert(text[i]['Comp anyName']);
            }

        }
       });
  });
</script>
<body>
<div class="content">
    <div class="card">
        <h1 class="mb-4 text-center">Providers List</h1>
        <div class="col-md-12">
            <fieldset class="content-group">
                <div class="form-group row">
                    <div class="col-md-3">&nbsp;</div>
                    <div class="col-md-6">
                    <table class="table table-bordered" id="tblProviders" width="100%">
                        <thead>
                            <tr>
                                <th class="header">Trading Name</th>
                                <th class="header">ABN</th>
                                <th class="header">View Location</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </div>
                    <div class="col-md-3">&nbsp;</div>
                </div>
            </fieldset>
        </div>

    </div>
</div>
<div class="container mt-5">


</div>
</body>
@endsection



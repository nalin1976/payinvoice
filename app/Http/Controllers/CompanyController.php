<?php

namespace App\Http\Controllers;

use App\Models\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ProvidersList = DB::table('companies')
                         ->select('TradingName','ABNNo')
                         ->where('Deleted','=',0)
                         ->get();

        return $ProvidersList;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash("message",'');

        $status = "Active";


        $ABNNumber = $request->abn;

        $lenABNNumber = strlen(str_replace(' ','',$ABNNumber));

        if($lenABNNumber != 0) {

            if(!$this->ValidateABNNumber($ABNNumber)){

               return 'Invalid ABN number';
            }
        }

        if(!$this->VerifyABNExist($ABNNumber)){
            return 'Given ABN number already exist';
        }



        $data = $request->all();

        foreach($data as $key => $value){
            switch($key){
                case "company_name";
                   if(strlen($value) == 0){
                    Session::flash("message",'Company Name cannot be empty');
                    return redirect()->back();
                   }
                break;

                case "trading_name";
                   if(strlen($value) == 0){
                        $status = "Incomplete";
                   }
                break;

                case "abn";
                if(strlen($value) == 0){
                     $status = "Incomplete";
                }
                break;

                case "primary_contact";
                if(strlen($value) == 0){
                     $status = "Incomplete";
                }
                break;

                case "secondry_contact";
                if(strlen($value) == 0){
                     $status = "Incomplete";
                }
                break;
            }
        }

        if(strlen($request->building_number) != 0){
            if((strlen($request->street_name) == 0) || (strlen($request->city_name) == 0)){

                return 'Please complete address';
            }
        }



        $Compnay = new Company();
        $Compnay->CompanyName = $request->company_name;
        $Compnay->TradingName = $request->trading_name;
        $Compnay->ABNNo = $request->abn;
        $Compnay->BuildingNo = $request->building_number;
        $Compnay->StreetName = $request->street_name;
        $Compnay->City = $request->city_name;
        $Compnay->PrimaryContact = $request->primary_contact;
        $Compnay->SecondryContact = $request->secondry_contact;
        $Compnay->Status = $status;
        $Compnay->Deleted = 0;
        $Compnay->save();




        //Session::flash("message",'Records saved successfully');
        //return redirect()->back();

        return 'Records saved successfully';

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $resCompanyInfo = Company::where('id','=',$request->id)->firstOrFail();

        return $resCompanyInfo;


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ValidateABNNumber($varABNNumber){

        $weightedVal = 1;
        $sumValue = 0;


        $leftMostNumber = substr($varABNNumber,0,1);
        $leftMostNumber -= 1;

        $concatNumber = str_replace(' ','',$leftMostNumber.substr($varABNNumber,1));

        if(strlen($concatNumber)<11){
            return false;
        }

        for($i=0, $len=strlen($concatNumber); $i<$len; $i++ ){

            $num = $concatNumber[$i];

            if($i == 0){
                $sumValue = $num * 10;
            }else{

                $sumValue = $sumValue + ($num * $weightedVal);
                $weightedVal += 2;
            }
        }

        $reminadarValue = $sumValue % 89;

        if($reminadarValue == 0){
            return true;
        }else{
            return false;
        }

    }

    public function GetCompanyName(){

        $CompanyNameList = DB::table('companies')
                         ->select('id','CompanyName','ABNNo','TradingName', 'BuildingNo','StreetName','City')
                         ->where('Deleted','=',0)
                         ->get();

        return $CompanyNameList;

    }

    public function updateCompany(Request $request){

        $ABNNumber = $request->abn;

        $lenABNNumber = strlen(str_replace(' ','',$ABNNumber));

        if($lenABNNumber != 0) {

            if(!$this->ValidateABNNumber($ABNNumber)){

               return 'Invalid ABN number';
            }
        }

        if(!$this->VerifyABNExistWithOther($ABNNumber, $request->input('id'))){
            return 'Given ABN number already exist';
        }

        $CompanyUpdate = Company::where('id', $request->input('id'))
                        ->update(['TradingName'=>$request->trading_name,
                                  'BuildingNo'=>$request->building_number,
                                  'ABNNo'=>$request->abn,
                                  'StreetName'=>$request->street_name,
                                  'City'=>$request->city_name,
                                  'PrimaryContact'=>$request->primary_contact,
                                  'SecondryContact'=>$request->secondry_contact,
                                  'Status'=>$request->status]);

                                  return 'Records saved successfully';
    }

    public function removeCompany(Request $request){

        $CompanyUpdate = Company::where('id', $request->input('id'))
                        ->update(['Deleted'=>1]);
    }

    public function VerifyABNExist($varABNNumber){

        $resABNNumber = Company::where("ABNNo","=",$varABNNumber)->first();

        if($resABNNumber == null){
            return true;
        }else{
            return false;
        }

    }

    public function VerifyABNExistWithOther($varABNNumber, $id){

        $resABNNumber = Company::where("ABNNo","=",$varABNNumber)->whereNotIn("id",[$id])->first();

        if($resABNNumber == null){
            return true;
        }else{
            return false;
        }

    }
}

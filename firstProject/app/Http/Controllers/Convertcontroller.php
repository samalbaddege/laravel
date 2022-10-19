<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request; //New import for calculator

class Convertcontroller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function viewconv(){
        $lenInMtr = 0;
        $ans = 0;

        $volInLtr = 0;
        $volAnsw = 0;
        //we set values to HTML value
        return view('converter') -> with('lenMtr',$lenInMtr) -> with('answ',$ans) -> with('volLtr', $volInLtr) -> with('volAnsw',$volAnsw);

    }

    public function convert(Request $request){
        //we get values from HTML name
        $lenInMtrs = $request->nameLenInMtr;
        $volInLtrs = $request->nameVolInLtr;
        
        $operation = $request->convertButton;

        $ans=0;
        $volAns=0;

        if($operation=="mm"){
            //$ans=$num1+$num2;
            $ans = ($lenInMtrs * 1000).' '.$operation;
        }
        elseif ($operation=="cm"){
            //$ans=$num1-$num2;
            $ans = ($lenInMtrs * 100).' '.$operation;
        }
        elseif ($operation=="inch"){
            //$ans=$num1*$num2;
            $ans = ($lenInMtrs * 39.37).' '.$operation;
        }
        elseif ($operation=="feet"){
            $ans=($lenInMtrs * 3.281).' '.$operation;
        }        
        elseif ($operation=="ml"){
            $volAns=($volInLtrs * 1000).' '.$operation;
        }
        elseif ($operation=="fl-oz"){
            $volAns=($volInLtrs * 33.814).' '.$operation;
        }
        elseif ($operation=="gal"){
            $volAns=($volInLtrs / 3.785).' '.$operation;
        }
        elseif ($operation=="pint"){
            $volAns=($volInLtrs * 2.113).' '.$operation;
        }else{
            $lenInMtrs=0;
            $volInLtrs=0;
            $ans=0;
            $volAns=0;
        }


        return view ('converter') -> with ('lenMtr',$lenInMtrs) -> with ('answ', $ans) -> with('volLtr',$volInLtrs) -> with('volAnsw',$volAns);

    }

}


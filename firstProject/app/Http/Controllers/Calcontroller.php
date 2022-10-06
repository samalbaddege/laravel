<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request; //New import for calculator

class Calcontroller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function viewcal(){
        $num1 = 0;
        $num2 = 0;
        $ans = 0;

        return view('cal') -> with('numb1',$num1) -> with('numb2',$num2) -> with('answ',$ans);

    }

    public function cal(Request $request){
        $num1 = $request->n1;
        $num2 = $request->n2;
        //$ans = $num1+$num2;
        $operation = $request->calbutton;

        if($operation=="Add"){
            $ans=$num1+$num2;
        }
        elseif ($operation=="Sub"){
            $ans=$num1-$num2;
        }
        elseif ($operation=="Mul"){
            $ans=$num1*$num2;
        }
        elseif ($operation=="Div"){
            if($num2==0){
                $ans="N/A";
            }else{
                $ans=$num1/$num2;
            }
        } else{
            $num1=0;
            $num2=0;
            $ans=0;
        }

        return view ('cal') -> with ('numb1',$num1) -> with ('numb2', $num2) -> with ('answ', $ans);

    }

}


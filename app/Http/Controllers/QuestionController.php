<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Bonus;
use App\Models\Answer;
use App\Models\Niveau;

use Illuminate\Http\RedirectResponse;


class QuestionController extends Controller
{
    public function getQsts(Request $req){

         $page=  $req->get('page');
         $start_from= $page * 3;
         $data=Question::join('answers', 'questions.idQst', '=', 'answers.idQst')->where('questions.idNv', '=', 2)->offset($start_from)->limit(3)->get();

           return $data->toJson();
         /* return response()->json([
                      'qst'=> $questions, 'ans'=>$answers
                    ]);*/

   }
   public function getQstsNv0(Request $req){
        $page=  $req->get('page');
        $start_from= $page * 3;
        $data=Question::join('answers', 'questions.idQst', '=', 'answers.idQst')->where('questions.idNv', '=', 1)
            ->offset($start_from)->limit(3)->get();

        return $data->toJson();
    }
    public function AnsNv0(Request $req){

        $rep=json_decode($req->getContent(), true);
        $isCorrect=Answer::where('abv', $rep['rep'] )->value('isCorrect');
        $qstId=Answer::where('abv', $rep['rep'] )->value('idQst');
        $xp=Answer::where('abv', $rep['rep'])->value('xp');
        //$p= $req->get('page');

        if($isCorrect==true){
            //User.xp += xp
            // go to next Qst
            return   true;
        }else{
            //User.xp == stay the same
            // go to next Qst
            return   false;
        }
        return response($isCorrect, 200);
    }
   public function getQstNv2(){
        $data=Question::join('answers', 'questions.idQst', '=', 'answers.idQst')->where('questions.idQst', '=', 4)->get();
        return $data->toJson();
   }

    public function Ans(Request $req){

      $rep=json_decode($req->getContent(), true);
        $isCorrect=Answer::where('abv', $rep['rep'] )->value('isCorrect');
        $qstId=Answer::where('abv', $rep['rep'] )->value('idQst');
         $xp=Answer::where('abv', $rep['rep'])->value('xp');
         $p= $req->get('page');
        $d= $req->get('double');


        if($isCorrect==true ){
            //User.xp += xp
            // go to next Qst
             if ($d==true) {
                 return "doubled";
             }else {
                 return true;
             }
        }else{
            //User.xp == stay the same
            // go to next Qst
            return   false;
        }
    }

   public function ans1Nv2(Request $req){
      $tabTaches= $req->get('rep');
      $n=0;
          if(str_contains($tabTaches[0], 'bg-primary')){
             $n++;
          }
           if (str_contains($tabTaches[2], 'bg-warning')){
              $n++;
          }
           if (str_contains($tabTaches[3], 'bg-secondary')){
            $n++;
          }
           if (str_contains($tabTaches[1], 'bg-success')){
             $n++;
          }
           if (str_contains($tabTaches[4], 'bg-danger')){
            $n++;
          }
              return response($n, 200);
       }
    public function AnsMulti1 (){
       $r= true;
       // add xp
       return response($r, 200);
    }
    public function AnsAc1Nv3 (Request $req){
        // add xp
        return response($req->get('isCorrect'), 200);

    }
    public function AnsAc2Nv3 (Request $req){
        // add xp
        return response($req->get('isCorrect'), 200);

    }

    public function randomBonus(){
        // add xp
        $random= rand(1,4);
        $bonus=Bonus::where('idBns', $random )->get();
        return $bonus->toJson();

    }
    public function getUserXp(Request  $req){
        // nomalement pour connaite combien l'user a gagné on va fair totalxp (niveau) - score qu'il a gagner dans le niveau
        // mais pour test je veux seulement retourner le nbr total

        //$random= rand(1,4);
        $id= $req->get('nv');
        $xp=Niveau::where('idNv', $id )->get('xpTotal');
        return response($xp, 200);

    }


}

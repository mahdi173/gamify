<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;


class HomeController extends Controller
{
    public function getTopUsers(Request $req){

        $idUser=  $req->get('idUser');

        $data=User::join('levels', 'users.idLv', '=', 'levels.idLv')->where('users.idUser', '>=', $idUser)->orderByDesc('users.xp')->offset($idUser-1)->limit(5)->get();

        return $data->toJson();
        /* return response()->json([
                     'qst'=> $questions, 'ans'=>$answers
                   ]);*/

    }
}

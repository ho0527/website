<?php
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;
    include("error.php");
    include("function.php");

    class user extends Controller{
        public function login(Request $request){

        }

        public function logout(Request $request){

        }

        public function getuser(Request $request){

        }

        public function banuser(Request $request,$userid){

        }

        public function getblocklist(Request $request){

        }
    }
?>
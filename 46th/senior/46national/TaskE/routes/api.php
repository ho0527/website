<?php
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\DB;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "api" middleware group. Make something great!
    |
    */

    $ok=response()->json(["status"=>"scueess","data"=>"OK"],200);
    // $newbook=["respondcode"=>"200","status"=>"scueess","data"=>$row->id];
    $isbnerror=response()->json(["status"=>"fail","data"=>"ISBN duplicate"],409);
    $isbnincorrect=response()->json(["status"=>"fail","data"=>"ISBN error"],400);
    $tomanydata=response()->json(["status"=>"fail","data"=>"input error"],400);
    $booksearchfromid=response()->json(["id"=>"{id}","name"=>"{book name}","isbn"=>"{isbn}"],200);
    $booksearchfromiderror=response()->json(["status"=>"fail","data"=>"book not found"],404);
    $editbook=response()->json(["status"=>"scueess","data"=>"OK"],200);
    $editbookfromiderror=response()->json(["status"=>"fail","data"=>"book id not found"],404);
    $delectbook=response()->json(["status"=>"scueess","data"=>"OK"],200);
    $delectbookfromiderror=response()->json(["status"=>"fail","data"=>"book id not found"],404);
    $bookdata=response()->json(["id"=>"{id}","name"=>"{book name}","isbn"=>"{isbn}"],200);
    $urlnotfound=response()->json(["status"=>"fail","data"=>"403 Forbidden"],403);

    Route::get("/reset",function()use($ok){
        DB::table("book")->truncate();
        return $ok;
    });

    Route::post("/books",function(Request $request)use($isbnerror,$isbnincorrect,$tomanydata){
        $name=$request->input("name");
        $isbn=$request->input("isbn");
        $row=DB::table("book")
            ->where(function($query)use($isbn){
                $query->where("isbn","=",$isbn);
            })->select("id")->get();
        if($row->isEmpty()){
            if(count(explode(" ",$isbn))==3||preg_match("/^([0-9] {3}){3}\ [0-9]$/",$isbn)||true){
                if(count(array_diff(array_keys($request->all()),["name","isbn"]))<=0){
                    DB::table("book")->insert([
                        "name"=>$name,
                        "isbn"=>$isbn,
                    ]);
                    $row=DB::table("book")
                        ->where(function($query)use($isbn){
                            $query->where("isbn","=",$isbn);
                        })->select("id")->get()[0];
                    return response()->json([
                        "status"=>"scueess",
                        "data"=>"$row->id"
                    ],200);
                }else{
                    return $tomanydata;
                }
            }else{
                return $isbnincorrect;
            }
        }else{
            return $isbnerror;
        }
    });

    Route::get("/books/{id}",function(Request $request)use($booksearchfromid,$booksearchfromiderror){
        $id=$request->route("id");
        $row=DB::table("book")
            ->where(function($query)use($id){
                $query->where("id","=",$id);
            })->select("id","name","isbn")->get();
        if($row->isNotEmpty()){
            $row=$row[0];
            return response()->json([
                "id"=>"$row->id",
                "name"=>"$row->name",
                "isbn"=>"$row->isbn",
            ],200);
        }else{
            return $booksearchfromiderror;
        }
    });

    Route::put("/books/{id}",function(Request $request)use($editbook,$booksearchfromiderror,$editbookfromiderror,$isbnerror,$isbnincorrect,$tomanydata){
        $id=$request->route("id");
        $name=$request->input("name");
        $isbn=$request->input("isbn");
        $rowid=DB::table("book")
            ->where(function($query)use($id){
                $query->where("id","=",$id);
            })->select("id")->get();
        $row=DB::table("book")
            ->where(function($query)use($isbn){
                $query->where("isbn","=",$isbn);
            })->select("id")->get();
        if($rowid->isNotEmpty()){
            if($row->isEmpty()/*||$row[0]->id==$id*/){
                $isbncheckcode=$isbn[count($isbn)-1];
                $isbntotal=0;
                for ($i=0;$i<strlen($isbn);$i=$i+1) {
                    if($i%2==0){ $multiplier=1; }else{ $multiplier=3; }
                    $isbntotal=$isbntotal+((int)$isbn[$i]*$multiplier);
                }
                $isbntotal=$isbntotal%10;
                // $isbntotal=(($isbn[0]*1)+($isbn[1]*3)+($isbn[2]*1)+($isbn[4]*3)+($isbn[5]*1)+($isbn[6]*3)+($isbn[8]*1)+($isbn[9]*3)+($isbn[10]*1)+($isbn[12]*3)+($isbn[13]*1)+($isbn[14]*3)%10);
                $n=10-$isbntotal;
                if($n==10){ $check=0; }else{ $check=$n; }
                if($check==$isbncheckcode){ $isbncheck=true; }else{ $isbncheck=false; }
                $isbncheck=true;
                if((count(explode(" ",$isbn))==3&&preg_match("/^([0-9] {3}){3}\ [0-9]$/",$isbn))||$isbncheck){
                    if(count(array_diff(array_keys($request->all()),["name","isbn"]))<=0){
                        DB::table("book")
                        ->where("id",$id) // replace with the ID of the row you want to update
                        ->update([
                            "name"=>$name,
                            "isbn"=>$isbn,
                        ]);
                        return $editbook;
                    }else{
                        return $tomanydata;
                    }
                }else{
                    return ;
                }
            }else{
                return $isbnerror;
            }
        }else{
            return $editbookfromiderror;
        }
    });

    Route::delete("/books/{id}",function(Request $request)use($ok,$booksearchfromiderror,$editbookfromiderror,$isbnerror,$isbnincorrect,$tomanydata){
        $id=$request->route("id");
        $row=DB::table("book")
            ->where(function($query)use($id){
                $query->where("id","=",$id);
            })->select("id")->get();
        if($row->isNotEmpty()){
            DB::table("book")
                ->where("id",$id)
                ->delete();
            return $ok;
        }else{
            return $editbookfromiderror;
        }
    });

    Route::get("/books",function(){
        return DB::table("book")->get();
    });
?>
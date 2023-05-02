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
    $booktomanydata=response()->json(["status"=>"fail","data"=>"input error"],400);
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

    Route::post("/books",function(Request $request)use($isbnerror,$isbnincorrect,$booktomanydata){
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
                    })->select("id")->first();
                    return response()->json([
                        "status"=>"scueess",
                        "data"=>"$row->id"
                    ],200);
                }else{
                    return $booktomanydata;
                }
            }else{
                return $isbnincorrect;
            }
        }else{
            return $isbnerror;
        }
    });

    Route::get("/books/:id",function(Request $request)use($booksearchfromid,$booksearchfromiderror){
        $id=$request->input("id");
        $row=DB::table("book")
            ->where(function($query)use($id){
                $query->where("id","=",$id);
            })->select("id","name","isbn")->get();
        if($row->isNotEmpty()){
            $row=$row->first();
            return response()->json([
                "id"=>"$row->id",
                "name"=>"$row->name",
                "isbn"=>"$row->isbn",
            ],200);
        }else{
            return $booksearchfromiderror;
        }
    });

    Route::put("/books",function(Request $request)use($editbook,$booksearchfromiderror,$editbookfromiderror,$isbnerror,$isbnincorrect,$booktomanydata){
        $id=$request->input("id");
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
            if($row->isEmpty()/*||$row->first()->id==$id*/){
                if(count(explode(" ",$isbn))==3||preg_match("/^([0-9] {3}){3}\ [0-9]$/",$isbn)||true){
                    if(count(array_diff(array_keys($request->all()),["id","name","isbn"]))<=0){
                        DB::table("book")
                            ->where("id",$id) // replace with the ID of the row you want to update
                            ->update([
                                "name"=>$name,
                                "isbn"=>$isbn,
                            ]);
                        return $editbook;
                    }else{
                        return $booktomanydata;
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

    Route::delete("/books",function(Request $request)use($ok,$booksearchfromiderror,$editbookfromiderror,$isbnerror,$isbnincorrect,$booktomanydata){
        $id=$request->input("id");
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
        $row = DB::table("book")
            ->get();
        $data = [];
        for($i=0;$i<count($row);$i=$i+1){
            $data[] = [
                "id"=>$row[$i]->id,
                "name"=>$row[$i]->name,
                "isbn"=>$row[$i]->isbn
            ];
        }
        return $data;
    });
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
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    Route::post("/user/login",function(){
        return view("welcome");
    });

    Route::post("/user/logout",function(){
        return view("welcome");
    });

    Route::post("/user/register",function(){
        return view("welcome");
    });

    Route::get("/post/public",function(){
        return view("welcome");
    });

    Route::get("/post",function(){
        return view("welcome");
    });

    Route::post("/post",function(){
        return view("welcome");
    });

    Route::post("/post",function(){
        return view("welcome");
    });

    Route::delete("/post",function(){
        return view("welcome");
    });

    Route::post("/post/:post_id/favorite",function(){
        return view("welcome");
    });

    Route::get("/post/favorite",function(){
        return view("welcome");
    });

    Route::post("/post/:post_id/comment",function(){
        return view("welcome");
    });

    Route::post("/post/:post_id/comment/:comment_id",function(){
        return view("welcome");
    });

    Route::delete("/post/:post_id/comment/:comment_id",function(){
        return view("welcome");
    });

    Route::get("/user/:user_id/post",function(){
        return view("welcome");
    });

    Route::get("/user/:user_id/profile",function(){
        return view("welcome");
    });

    Route::post("/user/:user_id/profile",function(){
        return view("welcome");
    });

    Route::get("/user/:user_id/follow",function(){
        return view("welcome");
    });

    Route::post("/user/:user_id/follow",function(){
        return view("welcome");
    });

    Route::delete("/user/:user_id/follow",function(){
        return view("welcome");
    });
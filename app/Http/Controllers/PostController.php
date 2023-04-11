<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
       if(count($posts) > 0 )
       {
        $response = [
            'messsage' => count($posts).' Posts Found',
            'status' => 1,
            'data' => $posts
        ];
       }
       else{
        $response = [
            'messsage' => count($posts).' Posts Found',
            'status' => 0
        ];
       }
        return response()->json($response , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $validator = validator::make($request->all(),[
        'title' => 'required',
        'description' => 'required'
       ]);
       if($validator->fails()){
            return response()->json( $validator->messages(),400 );
       }
       else{
           
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ];
       //p($data);
       //die;
        DB::beginTransaction();
        try{
            $post = Post::create($data);
                DB::commit();
            }
            catch(\Exception $e){
                DB::rollBack();
                //p($e->getMessage());
                $post = null;
            }
            if($post != null)
            {
                return response()->json([
                    'message' => 'Post saved successfully',
                    'status' => 'success',
                    'data' => $post
                 ],200);
            }
            else
            {
                return response()->json([
                    'message' => 'internal server Error',
                    'status' => 'Fail'
                 ],500);
            }
       }
       

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json([
            'post' => $post 
        
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Post $post)
    // {
        
    //     $post->title = $request->title;
    //     $post->description = $request->description;
    //     $post->status = $request->status;
    //     $post->save();

    //     return response()->json([
    //         'message' => 'Post Updated successfully',
    //         'status' => 'success',
    //         'data' => $post
    //      ]);
    // }

    /// Custom code WScube Tech
    public function update(Request $request,  $id)
    {
        $post = Post::find($id);
        if(is_null($post))
        {
            $response = [
                'message' => 'Invalid ID or Page not Found',
                'status' => 0
            ];
            $responce_code = 404;
        }
        else
        {
            DB::beginTransaction();
            try
            {
                $post->title = $request->title;
                $post->description = $request->description;
                $post->status = $request->status;
                $post->save();
                DB::commit();
                $response = [
                    'message' => 'Post updated successfully',
                    'status' => 1
                ];
                $responce_code = 200;
            }
            catch(\Exception $err)
            {
               DB::rollBack();
                $response = [
                    'message' => 'Internal Server Error',
                    'status' => 0,
                    'error_message' => $err->getMessage()
                ];
                $responce_code = 500;
            }
        }
        return response()->json($response , $responce_code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    // public function destroy(Post $post)
    // {
    //     $post->delete();
    //     return response()->json([
    //         'message' => 'Deleted Successfully',
    //         'status' => 'success'
    //     ]);


    // }
        /// Custom code WScube Tech
    public function destroy($id)
    {
        $post = Post::find($id);
        if(is_null($post))
        {
            $response = [
                'message' => 'Invalid ID or Page not Found',
                'status' => 0
            ];
            $responce_code = 404;
        }
        else
        {
            DB::beginTransaction();
            try
            {
                $post->delete();
                DB::commit();
                $response = [
                    'message' => 'Post deleted successfully',
                    'status' => 1
                ];
                $responce_code = 200;
            }
            catch(\Exception $err)
            {
               DB::rollBack();
                $response = [
                    'message' => 'Internal Server Error',
                    'status' => 0
                ];
                $responce_code = 500;
            }
        }
        return response()->json($response , $responce_code);

    }
      
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\apiModel;
use App\Models\categoryModel;
use file;
class categController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = categoryModel::latest()->get();
        return response([
            'success'   =>true,
            'message'   =>'List Semua Posts',
            'data'      =>$posts
        ],200);
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
        $image_path = $request->file('photo')->store('photo','public');

        $post = categoryModel::create([
            'category'      =>$request->category,
            'photo'         =>$image_path,
            
        ]);

        if ($post)  {
            return response()->json([
                'success'   =>true,
                'message'   =>'Post Berhasil Disimpan!',
            ], 200);
        }   else {
                return response()->json([
                    'success'   =>false,
                    'message'   =>'Post Gagal Disimpan!',
                ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $post = categoryModel::whereId($id)->first();
        $post = categoryModel::whereId($id)->get()->load(['apiModel']);


        if($post)   {
            return response()->json([
                'success'   =>true,
                'message'   =>'Detail Post!',
                'data'      =>$post
            ], 200);
        }   else {
            return response()->json([
                'success'   =>false,
                'message'   =>'Post Tidak Ditemukan!',
                'data'      =>''
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $post=categoryModel::findOrFail($id);
        
            if($post){
                $post->update([
                    'photo'     =>$request->photo,
                    'category'  =>$request->category,
                ]);
            

                return response()->json([
                    'success'   =>true,
                    'message'   =>'Post telah di update',
                    'data'      =>$post
                ],200);
            }

            return response()->json([
                'success'   =>false,
                'message'   =>'Post Tidak Ditemukan!',
            ],400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=categoryModel::find($id);
        if($category){
            $file = str_replace('\\', '/', public_path('storage/')).$category->photo;
            unlink($file);
            $category->delete();

            return response()->json([
                'message'   =>'product berhasil dihapus',
                'code'      =>200
            ]);
            
        }else{
            return response()->json([
                'message'   =>'product dengan id:$id tidak tersedia',
                'code'      =>400
            ]);
        }
    }
}

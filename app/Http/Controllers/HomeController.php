<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CupCake;
use App\Category;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.add_product',compact('categories'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required|image',
            'price' => 'required|integer',

        ]);
        if($request->hasFile('image')){
            $image_url = Storage::putFile('public/cakes', $request->file('image'));
        }
        
        $cupcake = new CupCake();
        $cupcake->title = $request->title;
        $cupcake->price = $request->price * 100;
        $cupcake->category_id = $request->category_id;
        $cupcake->image_url = $image_url ? $image_url : 'noimage.jpg';
        $cupcake->user_id = auth()->user() ? auth()->user()->id : null;
        $cupcake->save();
        return back(); 
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required|image',
            'price' => 'required|integer',

        ]);
        if($request->hasFile('image')){
            $image_url = Storage::putFile('cakes', $request->file('image'));
        }
        
        $cupcake = CupCake::findOrFail($id);
        $cupcake->title = $request->title;
        $cupcake->price = $request->price;
        $cupcake->category = $request->category;
        $cupcake->image_url = $image_url ? $image_url : 'noimage.jpg';
        $cupcake->update();
        return back();
    }

    public function destroy($id){
        $cupcake = CupCake::findOrFail($id);

        if($cupcake->image_url != 'noimage.jpg'){
            Storage::delete($cupcake->image_url);
        }
        $cupcake->delete();
        return back();  
    }
}

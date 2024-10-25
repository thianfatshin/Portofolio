<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Category;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::latest()->paginate(10);
        return view('food.index', compact('foods')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'description'=>'required',
            'price'=>'required|integer',
            'category'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png,gif,svg'
        ]);

        $image = $request->file('image');
        $name = 
        time().'.'.$image->getClientOriginalExtension();
        $destionationPath = public_path ('/image');
        $image->move($destionationPath, $name);

        Food::create([
            'name'=>$request->get('name'),
            'description'=>$request->get('description'),
            'price'=>$request->get('price'),
            'category_id'=>$request->get('category'),
            'image'=>$name,
            
        ]);

        return redirect()->back()->with('message', 'Food Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $food = Food::find($id);
        return view('food.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
         'name'=>'required',
         'description'=>'required',
         'price'=>'required|integer',
         'category'=>'required',
         'image'=>'mimes:jpg,jpeg,png,gif,svp'
        ]);

        $food = Food::find($id);
        $name = $food->image;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destionationPath = public_path('/image');
            $image->move($destionationPath,$name);
        }
        $food->name = $request->get('name');
        $food->description = $request->get('description');
        $food->price = $request->get('price');
        $food->category_id = $request->get('category');
        $food->image = $name;
        $food->save();

        return redirect()->route('food.index')->with('message','food information updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $food = Food::find($id);
        $food->delete(); 
        return redirect()->route('food.index')->with('message', 'food berhasil dihapus');
    }
    
    public function listFood(){
         $categories = Category::with('food')->get();
        return view ('index', compact('categories'));
    }

    public function detailFood($id){
        $food = Food::find($id);
        return view('detail', compact('food'));
    }
}

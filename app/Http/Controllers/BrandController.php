<?php


namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandFormRequest;
use App\Http\Requests\UpdateBrandFormRequest;



class BrandController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:brand-list|branch-create|brand-create|brand-edit|brand-delete', ['only' => ['index','show']]);
         $this->middleware('permission:brand-create', ['only' => ['create','store']]);
         $this->middleware('permission:brand-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:branch-create', ['only' => ['create','store']]);
         $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(5);
        return view('brands.index',compact('brands'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
            
    }
    public function list()
    {
        $brands = Brand::latest()->paginate(5);
    
            return view('brands.list',compact('brands'))
            ->with('i', (request()->input('page', 1) - 1) * 5);   

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandFormRequest $request)
    {
       

        Brand::create($request->all());


        return redirect()->route('brands.index')
                        ->with('success','Brand created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
       
   
    $brands= Brand::where('id',$brand->id)->first();
        $branches = Branch::where('brand_id',$brand->id)->get();
    
       return view('brands.show',compact('brands','branches'));

    }
    public function showbrand($id)
    {
       
   
   
    $brands= Brand::where('id',$id)->first();
    
        $branches = Branch::where('brand_id',$id)->get();
        
    
       return view('brands.showbrand',compact('brands','branches'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('brands.edit',compact('brand'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandFormRequest $request, Brand $brand)
    {
        


        $brand->update($request->all());


        return redirect()->route('brands.index')
                        ->with('success','Brand updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();


        return redirect()->route('brands.index')
                        ->with('success','Brand deleted successfully');
    }
}
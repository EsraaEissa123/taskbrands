<?php


namespace App\Http\Controllers;
use App\Models\branch;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBranchFormRequest;
use App\Http\Requests\UpdateBranchFormRequest;



class branchController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:branch-list|branch-create|branch-edit|branch-management|branch-delete', ['only' => ['index','show']]);
         $this->middleware('permission:branch-create', ['only' => ['create','store']]);
         $this->middleware('permission:branch-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:branch-management', ['only' => ['create','store']]);
         $this->middleware('permission:branch-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = branch::latest()->paginate(5);
        return view('branches.index',compact('branches'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function create(Request $request){
        $brand= Brand::where('id',$request->id)->first();
        $products = Product::where('brand_id',$brand->id)->get();
        $brand_id=$brand->id;

        return view('branches.create',compact('brand','products','brand_id'));    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBranchFormRequest $request)
    {
        
        // return response()->json([
        //     $request->all()
        // ]);
        $branch = Branch::create([
            'branch_name' => $request->branch_name,
            'region' => $request->region,
            'country' => $request->country,
            'street' => $request->street,
            'brand_id' => $request->brand_id,

        ]);

        $branch->products()->sync($request->product_ids);

        //  $branch_id=Branch::where('branch_name'==$request->branch_name)->get();
         
        
        return redirect()->route('branches.show', $branch->id)
                        ->with('success','branch created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(branch $branch)
    {
           
        
        $branches= branch::where('id',$branch->id)->first();
        //    dd($branch->id);
       
       $products=Product::where('id',$branch->id)->get();
//    return $products;
       

       return view('branches.show',compact('branch','products'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(branch $branch)
    {
        
        return view('branches.edit',compact('branch'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBranchFormRequest $request, branch $branch)
    {
         

        $branch->update($request->all());


        return redirect()->route('branches.index')
                        ->with('success','branch updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(branch $branch)
    {
        $branch->delete();


        return redirect()->route('branches.index')
                        ->with('success','branch deleted successfully');
    }
}
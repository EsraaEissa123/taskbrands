<?php


namespace App\Http\Controllers;
use App\Models\branch;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;



class branchController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:branch-list|branch-create|branch-edit|branch-delete', ['only' => ['index','show']]);
         $this->middleware('permission:branch-create', ['only' => ['create','store']]);
         $this->middleware('permission:branch-edit', ['only' => ['edit','update']]);
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
    public function create()
    {
        $brands=Brand::select('name','id')->get();
        $brand_id=2;
        return view('branches.create',compact('brands','brand_id'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'branch' => 'required',
            // 'detail' => 'required',
        ]);


        Branch::create($request->all());


        return redirect()->route('branches.index')
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
           
       $branches= branch::with(['products'])->first();
       $products=Product::where('branch_id',$branches->id)->get();
   
       return view('branches.show',compact('branches','products'));

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
    public function update(Request $request, branch $branch)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);


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
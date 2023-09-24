<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\PropertyFecility;
use App\Models\Property;


class PropertyController extends Controller
{
    public function index()
    {
        $data['property']=Property::with('getFeclities')->get();
        return view('index',compact('data'));
    }

    public function create()
    {
        return view('create');
    }

    public function submit(Request $request)
    {
     
       $data=$request->all();

       $validator=Validator::make($data,['name'=>'required',
                                        'slug'=>'required|unique:property,slug',
                                   'price'=>'required']);
       
      if($validator->fails())
      {
        //    return response()->json([
        //     'status' => 'false',
        //     'errors' => $validator->getMessageBag()->toArray()
        //     ], 200);


        return redirect()->back()->with('error','Validation error');
      }
     
       unset($data['_token']);
      $facilities=serialize($data['facilities']);
      unset($data['facilities']);
      if($request->file('img1'))
      {
        $image=$request->file('img1');
        $filename=time().str_replace(" ","",$image->getClientOriginalName());
        $path=public_path().'/assets/images/blog/';
        $image->move($path,$filename);
        $data['img1']=$filename;
      }
     
      if($request->file('img2'))
      {
        $image=$request->file('img2');
        $filename=time().str_replace(" ","",$image->getClientOriginalName());
        $path=public_path().'/assets/images/blog/';
        $image->move($path,$filename);
        $data['img2']=$filename;
      }
      if(Property::select('*')->count() == 0)
      {
        $code='PRT1';
      }
      else{
        $property=Property::select('*')->orderBy('id','DESC')->first();
        $code='PRT'.$property->id+1;
       
      }
     
      $data['code']=$code;
       $insert=Property::insertGetId($data);
    
       if($insert)
       {
       
            $facilityInsert=PropertyFecility::insert(['property_id'=>$insert,'faciities'=>$facilities]); 
           
            if($facilityInsert)
            {   
                return redirect('/')->with('success','Successfully added');
            } 
            else
            {
                return redirect()->back()->with('error','Error while inserting');
            }   
       }
      else
       {
            return redirect()->back()->with('error','Error while inserting');
       }

    }

    public function show(Request $request)
    {
            if(isset($request->slug) && $request->slug != NULL)
            {
                if(Property::where('slug',$request->slug)->exists())
                {
                    $property=Property::where('slug',$request->slug)->first();
                    $html=view('ajax.show',['property'=>$property])->render();
                    return response()->json(['status'=>true,'message'=>'SUCCESS','data'=>$html],200);
                }
                else{
                    return response()->json(['status'=>false,'message'=>'Invalid slug'],402);
                }
            }
            else{
                return response()->json(['status'=>false,'message'=>'Missing required parameters'],402);
            }
    }

    public function edit($slug)
    {
        if(isset($slug))
        {
            if(Property::where('slug',$slug)->exists())
            {
                $data['property']=Property::where('slug',$slug)->first();
                $select=['Facility1','Facility2','Facility3'];
                $fecilities=unserialize($data['property']->getFeclities->faciities);
                $data['select']=array_diff($select,$fecilities);
                return view('edit',compact('data'));
            }
            else{
                return redirect()->back()->with('error','Invalid slug');
            }
        }
        else{
            return redirect()->back()->with('error','Missing required parameters');
        }
    }

    public function update(Request $request)
    {
        $data=$request->all();
        $validator=Validator::make($data,['name'=>'required',
                                    'price'=>'required']);
        
       if($validator->fails())
       {
         return redirect()->back()->with('error','Validation error');
       }
      
        unset($data['_token']);
       $facilities=serialize($data['facilities']);
       unset($data['facilities']);
       if($request->file('img1'))
       {
         $image=$request->file('img1');
         $filename=time().str_replace(" ","",$image->getClientOriginalName());
         $path=public_path().'/assets/images/blog/';
         $image->move($path,$filename);
         $data['img1']=$filename;
       }
      
       if($request->file('img2'))
       {
         $image=$request->file('img2');
         $filename=time().str_replace(" ","",$image->getClientOriginalName());
         $path=public_path().'/assets/images/blog/';
         $image->move($path,$filename);
         $data['img2']=$filename;
       }
             

       $property=Property::where('slug',$data['slug'])->first();
        $update=$property->update($data);
    
        if($update)
        {
        
             $facilityUpdate=PropertyFecility::where('property_id',$property->id)->update(['faciities'=>$facilities]); 
            
             if($facilityUpdate)
             {   
                 return redirect('/')->with('success','Successfully updated');
             } 
             else
             {
                 return redirect()->back()->with('error','Error while updating');
             }   
        }
       else
        {
             return redirect()->back()->with('error','Error while updating');
        }
 
    }

    public function checkSlug(Request $request)
    {
        if(isset($request->id) && $request->id !=NULL)
        {
            if(isset($request->slug) && $request->slug != NULL)
            {
                if(Property::where('slug',$request->slug)->where('id','!=',$request->id)->exists())
                {
                    return response()->json(['status'=>false,'message'=>'Slug already exists']);
                }
                else{
                    return response()->json(['status'=>true,'message'=>'SUCCESS']);
                }
            }
            else{
                return response()->json(['status'=>false,'message'=>'Misssing required parameters']);
            }
        }
        else{
            if(isset($request->slug) && $request->slug != NULL)
            {
                if(Property::where('slug',$request->slug)->exists())
                {
                    return response()->json(['status'=>false,'message'=>'Slug already exists']);
                }
                else{
                    return response()->json(['status'=>true,'message'=>'SUCCESS']);
                }
            }
            else{
                return response()->json(['status'=>false,'message'=>'Misssing required parameters']);
            } 
        }
    }






}

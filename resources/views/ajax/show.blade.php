<div class="row">
    <div class="col-md-12">
    <div class="form-group">
        <label for="pName">Name</label>
        <p class="text-muted">{{$property->name}}</p>
    
    </div>
    </div>
    <div class="col-md-12">
    <div class="form-group">
        <label for="pName">Code</label>
        <p class="text-muted">{{$property->code}}</p>
    
    </div>
    </div>
  
   <div class="col-md-6">
   <div class="form-group">
            <label  style="margin-top: 30px;"><strong>Description </strong></label>
            <div>{!!$property->description!!}</div>
        
    </div>
   </div>
    
    <div class="col-md-12">
    <div class="form-group">
            <label><strong>Enclusions & Exclusions </strong></label>
            <div>{!!$property->description!!}</div>        
    </div>
    </div>
    
    </div>
   
 <div class="row">
 <div class="col-md-6" style="margin-top:20px;">
    <div class="form-group">
       
        <img src="{{asset('assets/images/blog')}}/{{$property->img1}}" alt="" height="80px" width="90px">

        </div>

    @isset($property->img2)
    <div class="col-md-6" style="margin-top:20px;">
    <div class="form-group">
        
        <img src="{{asset('assets/images/blog')}}/{{$property->img2}}" alt="" height="80px" width="90px">
        

        </div>
    </div>
    @endisset
 </div>
 
</div>
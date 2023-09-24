<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Property</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
</head>
<style>
 p{
    font-weight:bold;
    padding:10px;
    border-bottom:solid grey 5px;
 }
 .col-md-6
 {
  height: 100px;
 }
 .text-danger {
    color: #ef0d08;
}
.dropify-wrapper .dropify-message p {
        margin: 5px 0 0 0;
        font-size: 20px;
    }
    .nav-item .disabled {
        background: #ebebeb;
        margin: 0 5px;
        width: 150px;
        text-align: center;
    }
    
    .gallery1 + .dropify-wrapper .dropify-message span.file-icon:before, .gallery2 + .dropify-wrapper .dropify-message span.file-icon:before, .gallery3 + .dropify-wrapper .dropify-message span.file-icon:before, .gallery4 + .dropify-wrapper .dropify-message span.file-icon:before, .gallery5 + .dropify-wrapper .dropify-message span.file-icon:before {
        content: '\f03e'!important;
        font-family: 'FontAwesome';
    }
    .video-icon + .dropify-wrapper .dropify-message span.file-icon:before {
        content: '\f1c8'!important;
        font-family: 'FontAwesome';
    }
    .dropify-wrapper .dropify-message p {
        font-size: 16px;
    }
    .upload-section{
      height: 332px;
    max-height: 332px;
    }

</style>
<body>
<div class="col-sm-12 col-md-12 text-center " style="margin-top:45px;">
  <h1>Edit Property</h1>
</div>
<div class="col-sm-12 col-md-4"></div>
<div class="col-sm-12 col-md-4 col-md-offset-0">
<form action="{{route('property.update')}}" method="post" enctype="multipart/form-data" id="createForm">
  @csrf
<div class="row">
<div class="col-md-6">
  <div class="form-group">
    <label for="pName">Name</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="pName" placeholder="Name" name="name" value="{{$data['property']->name}}">
    <label id="pName-error" class="error" for="pName"></label>
  </div>
  </div>
  <div class="col-md-6">
  <div class="form-group">
    <label for="pSlug">Slug</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="pSlug" placeholder="Slug" name="slug" value="{{$data['property']->slug}}">
    <label id="pSlug-error" class="error" for="pSlug"></label>
  </div>
  </div>

  <div class="col-md-6">
  <div class="form-group">
    <label for="pPrice">Price</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="pPrice" placeholder="Price" name="price" value="{{$data['property']->price}}">
    <label id="pPrice-error" class="error" for="pPrice"></label>   
  </div>
  </div>
  <div class="col-md-6">
  <div class="form-group">
    <label for="pType">Type</label>
    <select  id="pType" class="form-control" name="currency">
     @if($data['property']->currency =="INR")
      <option value="INR">INR</option>
     @else 
      <option value="AED">AED</option>
     @endif 
    </select>
    <label id="pType-error" class="error" for="pType"></label>
  </div>
  </div>
  <div class="col-md-6">
  <div class="form-group">
    <label for="pPhone">Phone</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="pPhone" placeholder="Phone" name="phone" value="{{$data['property']->phone}}">
    <label id="pPhone-error" class="error" for="pPhone"></label>
  </div>
  </div>
  <div class="col-md-6">
  <div class="form-group">
    <label for="pEmail">Email</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="pEmail" placeholder="Email" name="email" value="{{$data['property']->email}}">
    <label id="pEmail-error" class="error" for="pEmail"></label>
  </div>
  </div>
  <div class="col-md-12">
  <div class="form-group">
    <label for="exampleInputPassword1">Facilities</label><span class="text-danger">*</span>
    <select name="facilities[]" id="fac" class="multiple-select form-control" multiple="multiple">
      <option value="" disabled>-Select Fecility-</option>
      @foreach(unserialize($data['property']->getFeclities->faciities) as $fec)  
        <option selected value="{{$fec}}">{{$fec}}</option>
        @endforeach 
        @foreach($data['select'] as $select)
          <option value="{{$select}}">{{$select}}</option>
        @endforeach  
      
    </select>
    <label id="fac-error" class="error" for="pSlug"></label>
  </div>
  </div>
<div class="col-md-12">
  <p class="text-muted">Descriptions</p>
</div>
<br>
  <div class="form-group">
        <label  style="margin-top: 30px;"><strong>Description </strong></label><span class="text-danger">*</span>
        <textarea class="ckeditor form-control" name="description" id="desc">{{$data['property']->description}}</textarea>
        <label id="desc-error" class="error" for="desc"></label>
</div>
 
<div class="form-group">
        <label><strong>Enclusions & Exclusions </strong></label><span class="text-danger">*</span>
        <textarea class="ckeditor form-control" name="inclusion_exclusion" id="incExc">{{$data['property']->inclusion_exclusion}}</textarea>
        <label id="incExc-error" class="error" for="incExc"></label>
</div>
</div>
<br>
<div class="col-md-12">
  <p class="text-muted">Uploads</p>
</div>
<div class="upload-section">
  <div class="col-md-12" style="margin-top:20px;">
  <div class="form-group">
      <label for="exampleInputFile">Image1</label><span class="text-danger">*</span>
      <input type="file" id="img1" class="dropify" name="img1" value="{{$data['property']->img1}}" data-default-file="{{asset('assets/images/blog')}}/{{$data['property']->img1}}">
  </div>
  <div class="col-md-12" style="margin-top:20px;">
  <div class="form-group">
      <label for="exampleInputFile">Image2</label>
      <input type="file" class="dropify" name="img2" id="gallery1" value="{{$data['property']->img2}}" data-default-file="{{asset('assets/images/blog')}}/{{$data['property']->img2}}">

    </div>
  </div>
</div>


  
  <div class="row m-3">
      <input type="hidden" value="{{$data['property']->slug}}" name="slug">
      <button type="submit" class="btn btn-success" style="margin:20px">Submit</button>
  </div>

</form>

</div>

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

<!-- include FilePond library -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<!-- include FilePond plugins -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

<!-- include FilePond jQuery adapter -->
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
<!-- jquery validator -->
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.3/jquery.validate.min.js"></script>
<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>


<script>
  $(document).ready(function() {
    $('.multiple-select').select2();
    $('.dropify').dropify();
    

    $("#createForm").validate({
      ignore: [],
              debug: false,
        rules: {
            name:{
              required:true,
              maxlength:200,
              pattern:'[a-zA-Z][a-zA-Z ]+[a-zA-Z]$',
             
            },
            email: {
                required: true,
                email: true
            },
            description:{
              required:true
            },
            inclusion_exclusion:
            {
              required:true
            },
           
            cktext:{
                         required: function() 
                        {
                         CKEDITOR.instances.cktext.updateElement();
                        },

                         minlength:10
                    },
              
            name:{
              required:true
            },
            slug:{
              required:true
            },
            price:{
              required:true
            },
            phone:{
              required:true,
              maxlength:10,
            	minlength:10,
              number:true
            }



        },
        messages: {
            name:{
              required:"Please enter your name",
              pattern : "Please Enter valid Name",
              maxlength : "Length should not be greater than 200 characters",
             
            },
            email: "Please enter a valid email address",
            description:"Please enter description",
            inclusion_exclusion:"Please enter enclusions and exclusions"
        }
    });
    
});

$(document).on('focusout','#pSlug',function()
{
  let slug=$("#pSlug").val();
  let id=<?php echo $data['property']->id; ?>;
               
               $.ajax({
                   url:"{{route('slug.check')}}",
                   type:"GET",
                   data:{slug:slug,id:id},
                   success:function(data)
                   {
                      if(data.status == false)
                      {
                        $("#pSlug-error").css('display','block');
                        $("#pSlug-error").text(data.message);
                        $("#subBtn").attr('disabled',true);
                      }else{
                        $("#subBtn").attr('disabled',false);
                      }

                   }
               })
});


</script>
</body>
</html>
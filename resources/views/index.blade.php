<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Laravel crud</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="{{asset('assets/landing.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  
  </style>
  <body>
    <div class="container mt-5">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Property <b>Lists</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="{{route('property.add')}}" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Property</span></a>
										
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						
                        <th>Name</th>
                        <th>Email</th>
						<th>Fecilities</th>
                        <th>Phone</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['property'] as $property)
                    <tr>
						
                        <td>{{$property->name}}</td>
                        <td>{{$property->email}}</td>
						<td>
                            <ul>
                            @foreach(unserialize($property->getFeclities->faciities) as $fecilities)    
                                <li>{{$fecilities}}</li>
                                @endforeach  
                            </ul>
                                                    
                        </td>
                            
                        <td>{{$property->phone}}</td>
                        <td>{{$property->currency}} {{$property->price}}</td>
                        <td>
                          <div class="row">
                                <a href="{{route('property.edit',$property->slug)}}" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" value="{{$property->slug}}">&#xE254;</i></a>
                                <button class="view btn btn-light" value="{{$property->slug}}" data-toggle="modal" id="btnView"><i class="material-icons" data-toggle="tooltip" title="View">&#x1f441;</i></button>

                          </div>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
			
        </div>
    </div>
	
    <!-- show Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="modalShow">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Property Details</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody" style="overflow:scroll">
                   
                </div>
               
                </div>
            </div>
    </div>


    <!-- show Modal ends here -->
    @if(Session::has('success'))
 
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    Swal.fire(
      '',
      '{{session()->get('success')}}',
      'success'
    )
  </script>

  @endif
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script>
            $(document).on('click','.view',function()
            {
                let slug=$(this).val();
               
                $.ajax({
                    url:"{{route('property.show')}}",
                    type:"GET",
                    data:{slug:slug},
                    success:function(data)
                    {
                        if(data.status)
                        {
                            $("#modalShow").modal('toggle');
                            $("#modalBody").empty();
                            $("#modalBody").html(data.data);
                        }
                        else{
                            alert("error");
                        }
                    }
                })
                
            });
    </script>
</body>
</html>
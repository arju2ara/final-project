@extends('admin.layouts.app')
@section('content')
    

<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Contact US  List</h1>
            </div>
            {{-- <div class="col-sm-6 text-right">
                <a href="{{route('categories.create')}}" class="btn btn-primary">+Add New</a>
            </div> --}}
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        @include('admin.message')
        <div class="card">
            <form action="" method="GET">
            <div class="card-header">
                <div class="card-title">
                    <button type="button" onclick="window.location.href='{{route('contacts.index')}}'" class="btn btn-default btn-sm">Reset</button>
                </div>
                <div class="card-tools">
                    <div class="input-group input-group" style="width: 250px;">
                        <input  value="{{Request::get('keyword')}}" type="text" name="keyword" class="form-control float-right" placeholder="Search">
    
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                </div>
          
            </div>
        </form>
            <div class="card-body table-responsive p-0">								
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            

                        </tr>
                    </thead>
                    <tbody>
                        @if($contacts->isNotEmpty())
                            @foreach ($contacts as $contact)
                        <tr>     
                            <td>{{$contact->id}}</td>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->email}}</td>  
                            <td>{{$contact->subject}}</td> 
                            <td>{{$contact->message}}</td> 
                            
                        </tr>
                            @endforeach
                        
                         @else
                         <tr>
                            <td colspan="5"> Records not found</td>
                         </tr>
                            
                        @endif

                        
                      
                        
                         
                    </tbody>
                </table>										
            </div>
            <div class="card-footer clearfix">

                {{$contacts->links()}}
            
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

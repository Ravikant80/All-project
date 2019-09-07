@extends('layouts.app')
@section('content')




 @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif




<div class="container-fluid">
<div class="row">
<div class="col-md-12 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">
         <h4><font color="blue"> Uploading Multipal Image </font> <h4>
        </div>

    <div class="panel-body">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                Please correct following errors:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('/photo') }}" method="post" enctype="multipart/form-data">

                <div class="form-group">
                <input type="file" name="image[]" class="form-control-file" multiple="true">
                </div>

                {{ csrf_field() }}

                <button type="submit" class="btn btn-primary">Upload To Server</button>
            </form>
                <hr>
                    <h3>Listing Images</h3>

                            <div class="row">
                             @forelse($photos as $photo)
                            <div class="col-md-3">
                            <?php
                             echo "<br/> <br/>";
                             ?>
                            &nbsp; &nbsp;<img src="{{ $photo->thumbnail }}" class="img-responsive">
                            
                        </div>
                         <a href="{{url('/deleteimg/'.$photo->id)}}">Delete</a>
                        @empty
                        No image found
                        @endforelse
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection


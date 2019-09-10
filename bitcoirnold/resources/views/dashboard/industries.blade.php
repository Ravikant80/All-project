@extends('layouts.dashboard')
@section('content')




        <div class="row">
            <div class="col-md-12">


                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">

                            <thead>
                            <tr>
                                <th>ID#</th>
                                <th>Industry Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $i=0;@endphp
                            @foreach($industries as $p)
                                @php $i++;@endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>
                                        @if($p->status == 1)
                                            <span class="badge badge-primary  bold uppercase"><i class="fa fa-check"></i>Active</span> 
                                        @else
                                            <span class="badge badge-warning  bold uppercase"><i class="fa fa-spinner"></i>In Active</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('industry-edit',$p->id) }}" data-container="body" data-placement="top" data-original-title="Edit" class="btn btn-info btn-sm bold tooltips"><i class="fa fa-edit"></i></a></td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                       
                    </div>
                </div>

            </div>
        </div>



@endsection

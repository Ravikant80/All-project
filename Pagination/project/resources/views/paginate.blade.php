<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Our Data Here</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
   </head>
<body>
   <div class="container">
      <table class="table table-striped">
         <thead>
         <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
             <th>Amount</th>
            <th>Date</th>
         </tr>
         </tr>
         </thead>
         <tbody>
            @foreach($data as $datas)
            <tr>
               <td>{{ $datas->id }}</td>
               <td>{{ $datas->name }}</td>
               <td>{{ $datas->address }}</td>
               <td>{{ $datas->amount }}</td>
               <td>{{ $datas->date }}</td>
            </tr>
            @endforeach
         </tbody>
      </table>
      {{ $data->links() }}
   </div>
   </body>
</html>
@extends('layouts/app')

@section('content')
{{-- @dd($orders) --}}

<div id="table-container" class="container " >
    

    @if ($orders->isNotEmpty())

    <table class="table table-borderless table-striped table-hover mt-4">
        <thead>
          <tr>
            
            <th scope="col">Nome </th>
            <th scope="col">Cognome</th>
            <th scope="col">Via</th>
            <th scope="col">Mail</th>
            <th scope="col">totale</th>
    
          </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
          <tr>
                
            <td>{{$order->first_name}}</td>
            <td>{{$order->last_name}}</td>
            <td>{{$order->address}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->total}}</td>
                      
        </tr>
        @endforeach
          
        </tbody>
      </table>
    
    @else

    <div class="alert alert-danger mt-4" role="alert">
       Non hai ordini da visualizzare
    </div>
           
    @endif
        
    

</div>

@endsection
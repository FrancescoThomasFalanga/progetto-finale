@extends('layouts/app')

@section('content')
{{-- @dd($orders) --}}

<div id="table-container" class="container " >
    

    @if ($orders->isNotEmpty())

    <table class="table table-dark table-hover m-5">
        <thead>
          <tr>
            
            <th scope="col">N. Ordine </th>
            <th scope="col">Nome </th>
            <th scope="col">Cognome</th>
            <th scope="col">Via</th>
            <th scope="col">Mail</th>
            <th scope="col">Totale</th>
            <th scope="col">Data</th>
            <th scope="col">Ordini</th>
    
          </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
          <tr>
                
            <td>{{$order->id}}</td>
            <td>{{$order->first_name}}</td>
            <td>{{$order->last_name}}</td>
            <td>{{$order->address}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->total}}</td>
            <td>{{$order->created_at}}</td>
            <td><a class="btn btn-warning" href="{{route('admin.orders.show', $order->id)}}">Visualizza</a> </td>
                      
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
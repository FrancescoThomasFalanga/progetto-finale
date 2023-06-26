@extends('layouts/app')

@section('content')


<div class="container-fluid d-flex align-items-center justify-content-center">

    <canvas id="myChart" class="bg-white m-5" style="max-width:800px"></canvas>
    
    <div class="card" style="width: 300px;">
        <div class="card-body">
            <h1 class="text-center"> Guadagno totale: 
    
                @php
              
                  $totalArray = [];
                  
                  foreach ($total as $singleTotal) {
                    
                    $totalArray[] = $singleTotal['total'];
                    
                  };
              
                  $all = array_sum($totalArray);
              
                  echo $all . '€';
              
                @endphp
              
              </h1>
        </div>
      </div>

</div>


<script>
  const orderCounts = @json($orderCounts);
  const months = @json($months);

  orderCounts.push(0);
  
  const labels = months.map(month => {
      const monthString = month.toString().padStart(2, '0');
      return `${monthString}/23`;
  });

  const data = {
      labels: labels,
      datasets: [{
          label: 'Vendite mensili',
          data: orderCounts,
          backgroundColor: [
              'rgba(255, 26, 104, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(0, 0, 0, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(0, 0, 0, 0.2)',
          ],
          borderColor: [
              'rgba(255, 26, 104, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(0, 0, 0, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(0, 0, 0, 1)'
          ],
          borderWidth: 1
      }]
  };

  const config = {
      type: 'bar',
      data,
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          },
          
      }
  };

  const myChart = new Chart(
      document.getElementById('myChart'),
      config
  );
</script>

@endsection
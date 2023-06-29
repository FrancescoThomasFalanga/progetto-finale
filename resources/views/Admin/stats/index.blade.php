@extends('layouts/app')

@section('content')


<div class="container-fluid d-flex flex-column align-items-center justify-content-center">

    <div class="canvas-container m-5" style="max-width: 100%; width: 800px;">
        <canvas id="myChart" style="display: block; height: 400px; width: 100%; max-width: 800px; background-color: #ffcc6a; border-radius: 30px;"></canvas>
    </div>

    <div class="card" style="max-width: 400px; border-radius: 11px;">
        <div class="card-body text-center" style="background-color: #212529; color: #ffcc6a; border-radius: 9px;">
            <h1 class="text-center">Guadagno totale</h1>
            <b class="text-center" style="font-size: 30px;">

                @php
              
                  $totalArray = [];
                  
                  foreach ($total as $singleTotal) {
                    
                    $totalArray[] = $singleTotal['total'];
                    
                  };
              
                  $all = array_sum($totalArray);
              
                  echo $all . '€';
              
                @endphp
            </b>
              
        </div>
      </div>

</div>


<script>

    @php
        echo "var ciao = '" . json_encode($orderCounts) . "';";
    @endphp

    let ordersData = JSON.parse(ciao)
    var dataCorrente = new Date();

    var mesi = []; 

    var dataCorrente = new Date();

    for (var i = 0; i < 12; i++) {
    var mese = dataCorrente.toLocaleString('en-US', { month: 'short', locale: 'en-US' });
    var anno = dataCorrente.getFullYear();
    var meseAnno = mese + " " + anno;

    mesi.unshift(meseAnno); 

    dataCorrente.setMonth(dataCorrente.getMonth() - 1);
    }
    
        var totals = [];
        mesi.forEach(function(month) {
            var found = false;
            ordersData.forEach(function(order) {
                
                if (order.date === month ) {
                    totals.push(order.total);
                    found = true;
                }
            });
            if (!found) {
                totals.push(0);
            }
        });

    const data = {
      labels: mesi,
      datasets: [{
          label: 'Vendite mensili',
          data: totals,
          backgroundColor: [
              'rgba(255, 26, 104, 0.5)',
              'rgba(54, 162, 235, 0.5)',
              'rgba(255, 206, 86, 0.5)',
              'rgba(75, 192, 192, 0.5)',
              'rgba(153, 102, 255, 0.5)',
              'rgba(255, 159, 64, 0.5)',
              'rgba(255, 0, 0, 0.5) ',
              'rgba(25, 206, 86, 0.5)',
              'rgba(175, 192, 192, 0.5)',
              'rgba(53, 102, 255, 0.5)',
              'rgba(230, 129, 64, 0.5)',
              'rgba(0, 0, 100, 0.5)',
          ],
          borderColor: [
              'rgba(255, 26, 104, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(255, 0, 0, 1) ',
              'rgba(25, 206, 86, 1)',
              'rgba(175, 192, 192, 1)',
              'rgba(53, 102, 255, 1)',
              'rgba(230, 129, 64, 1)',
              'rgba(0, 0, 100, 1)'
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
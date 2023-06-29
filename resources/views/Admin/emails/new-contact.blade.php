<html>
    <div class="body">
    
        <h2>    
            Ciao {{ $lead->name }} grazie per aver scelto DeliveBOO  
        </h2>
        <div class="container">
            <div class="container-img">

                <img src="{{ Vite::asset('resources/img/logo-deliveboo.png') }}" alt="">
            </div>
            <span>Il tuo Codice Ordine: <mark>{{ $lead->messaggio }}</mark> </span> 
            
            <span>Rider in arrivo in circa 10 minuti...</span>
        </div>
    </div>

</html>

<style>
    body{
        display: flex;
    justify-content: center;
    }
    .container{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
    img{
        width: 80px;
        
    }
   mark{
    padding: 5px;
   }
</style>

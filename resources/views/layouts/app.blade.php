<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        @include('partials/navbar')
        <main>
            @yield('content')
        </main>
        @include('partials/footer')
    </div>
</body>

<script>

    function previewImage() {

        let file = document.getElementById('cover_image').files;

        if (file.length > 0) {

            let fileReader = new FileReader();

            fileReader.onload = function (event) {

                document.getElementById('preview').setAttribute('src', event.target.result);

            };

            fileReader.readAsDataURL(file[0]);
            
        }

    };

    function validateForm() {
      let checkboxes = document.getElementsByName('types[]');
      let isChecked = false;
  
      for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
          isChecked = true;
          break;
        }
      }
  
      if (!isChecked) {

        let paragraphEl = document.getElementById('paragraph');
        

        if (!paragraphEl.querySelector('.text-danger')) {

            let newParagraph = document.createElement('p');

            newParagraph.textContent = 'Seleziona almeno una tipologia!';

            newParagraph.classList.add('text-danger', 'fw-bold');
            
            paragraphEl.appendChild(newParagraph);

        }


        // alert('Seleziona almeno una opzione');
        return false;
      }
  
      return true;
    };

</script>

</html>

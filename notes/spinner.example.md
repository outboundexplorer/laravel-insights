<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>
        <style type="text/css">
        #spin-area{
        height:100px;
        width:100px;
        background-color: #FFF;
        border-radius: 3px;
        }
        </style>



    </head>
    <body>
        <div id="spin-area"></div>

        {{ HTML::script('js/spin.js') }}
        <script>
        var target = document.getElementById('spin-area');
        var spinner = new Spinner().spin(target);
        </script>
    </body>
</html>
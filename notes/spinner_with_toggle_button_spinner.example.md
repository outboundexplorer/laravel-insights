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
        <button onclick="toggleSpin()">Spin it!</button>
        <div id="spin-area">Spin Area</div>

        {{ HTML::script('js/spin.js') }}
        <script>
            var target = document.getElementById('spin-area');
            var spinning = false;
            function toggleSpin(){
                spinning ? spinner.stop() : spinner = new Spinner().spin(target);
                spinning = !spinning;
            }
        </script>
    </body>
</html>
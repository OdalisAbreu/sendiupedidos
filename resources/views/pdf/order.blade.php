<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style type="text/css"> 
        .contenido
        {
            padding: 13px !important;
        }
        .logo
        {   
            width: 225px;
        }
    </style>
    <title></title>
</head>
<body>
             
            <div id="html-content-holder" class="contenido" >
 
                <img src="{{ asset('/public/images/logo/Botpro_logo.png') }}" class="logo"> <br>
               
                <div>
                   <p> BotPRo <br />
                    Calle Paseo de los Locutores No.27 <br />
                    Evaristo Morales <br />
                    Distrito Nacional <br />
                    República Dominicana </p>
                </div>
             
                <div>
                   <P>
                    Nombre:   {{$orders->user->name}} <br />
                    Direccion:   {{$orders->user->address}} <br />
                    Telefono:   {{$orders->user->phone}}
                   </P> 
             
                </div>
                <div>
                  <P>  Cotizacion No. {{$orders->id }} <P>
                </div>
                <table class="table table-striped"
                    <tr>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio Unidad</th>
                        <th>18 % ITBIS</th>
                        <th>Importe</th>
                    </tr>
                    @foreach ($orders->cart->details  as $cart)
                    <tr>
                        <td>{{$cart->product->name}}</td>
                        <td>{{$cart->quantity}}</td>
                        <td>{{ number_format($cart->product->price, 2)}}</td>
                        <td><?php echo number_format($cart->product->price *0.18, 2); ?> </td>
                        <td><?php echo number_format(($cart->product->price + ($cart->product->price *0.18)) * $cart->quantity, 2) ?> </td>
                     </tr>
                     @endforeach
                 </table>
                 <p> 
                     SubTotal: RD$ {{number_format($orders->cart->total, 2)}} <br />
                     ITBIS: RD$ <?php echo number_format($orders->cart->total *0.18, 2); ?> <br />
                     Total: RD$ <?php echo number_format($orders->cart->total + ($orders->cart->total *0.18), 2); ?>
                 </p>
             
                El pago debe ser efectuado en un plazo de 3 días 

         </div>
         
         <div style="padding: 18px !important;">
             <a id="btn-Convert-Html2Image" class="btn btn-info" href="#"> Descargar </a>
             
             @guest
              @else
                 <a href="{{ url('orders/'.$orders->id.'/Cancelado?type=canceladas')}}" class="btn btn-danger"> Cancelado </a>
             @endguest
        </div>

        <div id="previewImage" style="display: none">
        </div>

      <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
      <script src="{{ asset('js/html2canvas.min.js') }}" type="text/javascript"></script>
      <script src="{{ asset('js/canvas2image.js') }}" type="text/javascript"></script>
      <script>
        var element = $("#html-content-holder"); // global variable
        var getCanvas; // global variable
        
             function precargar() {
                 html2canvas(element, {
                 onrendered: function (canvas) {
                        $("#previewImage").append(canvas);
                        getCanvas = canvas;
                     }
                 });
            };
            
            $("#btn-Convert-Html2Image").on('click', function save() {
                var imgageData = getCanvas.toDataURL("image/png");
                // Now browser starts downloading it instead of just showing it
                var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                $("#btn-Convert-Html2Image").attr("download", "Orden.png").attr("href", newData);
            });



           
      </script>
</body>
</html>
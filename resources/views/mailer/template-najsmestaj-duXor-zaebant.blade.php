<html>
<head>
    <title>NajSmeštaj</title>
    <style>
        body{margin:0}
        p,b,i{font-size: 18px}
        .header{
            overflow-x: hidden;
            height: 120px;
            margin-bottom:10px;
        }
        .header img{height: 100%;width: 1920px;}
        .footer{
            margin: 50px 0 0 0;
            padding: 10px 50px;
            background-color: #222;
            color: #cbcbcb;
            width: 100%;
            height:160px;
        }
        .footer img{ height: 100%}

        .container{
            width:80%;
            margin:0 auto;
            padding: 0 10px;
        }
        .container img{width:100%;margin-bottom: 20px}
        .box{
            background-color: #222;
            color: #fff;
            width: 40%;
        }
        .padd{
            padding: 50px;
        }
        .left{
            float: left;
        }
        .left3{
            margin-left: 3px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{$message->embed($heder)}}">
    </div>

    <div class="container">
        <img src="{{$message->embed($naslovna)}}">
        <h1><b>duXor</b> je Faca! kako god okreneš.</h1>
        <hr>
        <p>Ovo je mejl za testiranje. Ukoliko ste ga dobili slučajno i smatrate da nije namijenjen vama, molimo da ga izbrišete.</p>
        <div class="box left">
            <img src="{{$message->embed('http://cdn3.worldcarfans.co/2012/9/19/medium/12744536541374220907.jpg')}}" style="width: 100%">
            Aston in Monte Carlo
        </div>
        <div class="left box padd left3">Zapamti!!: duXor je Faca! i voziće Aston Martina po Monte Karlu!</div>
        <br clear="all">
    </div>

    <div class="footer">
        <img src="{{$message->embed($footer)}}">
    </div>
</body>
</html>
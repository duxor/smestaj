@extends('moderacija.master-moderator')
@section('content')
    @if($podaci['galerije'])
        <div class="panel-group" id="galerije" role="tablist" aria-multiselectable="true">
            @foreach($podaci['galerije'] as $key => $galerija)
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading{{$galerija['slug']}}">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#galerije" href="#collapse{{$galerija['slug']}}" aria-expanded="true" aria-controls="collapse{{$galerija['slug']}}">
                                <span style="color:#c8c6c6;font-size: 80%">Aplikacija: <b>{{$galerija['app']}},</b></span> <span style="font-size: 90%;color:#646262">Naziv galerije:</span> <b>{{$galerija['naziv']}}</b>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{$galerija['slug']}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$galerija['slug']}}">
                        <div class="panel-body">
                            <div class="col-sm-7">
                                <a href="/moderator/{{$podaci['aplikacija']}}/galerije/galerija/{{$galerija['id']}}/{{$galerija['slug']}}" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-pencil"></span> Uredi</a></a>
                                @if($galerija['vrsta_sadrzaja_id']!=7)
                                    <a href="#" class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-check"></span> Promeni status</a>
                                    <a href="#" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-trash"></span> Obriši</a>
                                @endif
                                <p>{!!$galerija['sadrzaj']!!}</p>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($galerija['slike']))
                                    @if(sizeof($galerija['slike']))
                                        <div id="carousel-{{$galerija['slug']}}" class="carousel slide" data-ride="carousel">
                                            <!-- Indicators -->
                                            <ol class="carousel-indicators">
                                                <li data-target="#carousel-{{$galerija['slug']}}" data-slide-to="0" class="active"></li>
                                                @for($i=1;$i<sizeof($galerija['slike']);$i++)
                                                    <li data-target="#carousel-{{$galerija['slug']}}" data-slide-to="{{$i}}"></li>
                                                @endfor
                                            </ol>

                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">
                                                @foreach($galerija['slike'] as $i => $slika)
                                                    @if($i==0)<div class="item active">@else<div class="item">@endif
                                                            <img src="/{{$slika}}" alt="...">
                                                            <div class="carousel-caption">
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>

                                                    <!-- Controls -->
                                                    <a class="left carousel-control" href="#carousel-{{$galerija['slug']}}" role="button" data-slide="prev">
                                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="right carousel-control" href="#carousel-{{$galerija['slug']}}" role="button" data-slide="next">
                                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                            </div>
                                            @else <p>Galerija ne sadrži ni jednu fotografiju.</p>
                                            @endif
                                            @endif
                                        </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                    <p>Ne postoji ni jedna galerija.</p>
                @endif
                {{--<a href="#" data-toggle="modal" data-target="#novaGalerija" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-plus"></span> Dodaj novu</a>--}}
@endsection
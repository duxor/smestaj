@extends('moderacija.master-moderator')
@section('content')
    <h2>Uredi galeriju fotografija</h2><i class='icon-spin6 animate-spin' style="color: rgba(0,0,0,0)"></i>
    <div id="poruka" style="display: none"></div>
    <div id="wait" style="display:none"><center><i class='icon-spin6 animate-spin' style="font-size: 350%"></i></center></div>
    <div id="hide" style="margin-bottom: 20px">
        {!!Form::hidden('_token',csrf_token())!!}
        {!!Form::hidden('galerija_id',$podaci['galerija']['id'])!!}
        {!!Form::hidden('korisnik_id',Session::get('id'))!!}
        <div class="form-group">{!!Form::text('naziv',$podaci['galerija']['naziv'],['class'=>'form-control'])!!}</div>
        <div class="form-group">{!!Form::textarea('sadrzaj',$podaci['galerija']['sadrzaj'],['class'=>'form-control'])!!}</div>
        {!!Form::button('<span class="glyphicon glyphicon-save"></span> Sačuvaj',['class'=>'btn btn-lg btn-primary','onclick'=>'Komunikacija.posalji("/moderator/'.$podaci['slugApp'].'/galerije/galerija-update","hide","poruka","wait","hide")'])!!}
    </div>
    <a href="#" class="btn btn-lg btn-warning" data-toggle="modal" data-target="#dodajFoto"><span class="glyphicon glyphicon-picture"></span> Dodaj fotografije</a>
    @if($podaci['slike'])
            <div class="row">
                    @foreach($podaci['slike'] as $slika)
                    <div class="col-xs-6 col-md-3">
                        {!! Form::open(['url'=>'/moderator/'.$podaci['slugApp'].'/galerije/ukloni-foto']) !!}
                            {!! Form::hidden('slika',$slika) !!}
                            {!! Form::button('<img src="/'.$slika.'">',['class'=>'thumbnail','data-html'=>'true','data-toggle'=>'popover','data-trigger'=>'focus','title'=>'Opcije','data-content'=>'<button class="btn btn-danger" type="submit">Ukloni</button>']) !!}
                        {!! Form::close() !!}
                    </div>
                    @endforeach
                    <script>$(document).ready(function(){$('.thumbnail').popover();});</script>
            </div>
    @else <p>Nije dodata ni jedna fotografija u ovu galeriju.</p>
    @endif


@endsection

@section('body')
    <div class="modal fade" id="dodajFoto">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h2>Dodaj nove fotografije</h2>
                </div>
                <div class="modal-body">
                    <input id="input-700" name="images[]" type="file" multiple=true class="file-loading" >
                </div>
                <div class="modal-footer">
                    <a href="/moderator/{{$podaci['slugApp']}}/galerije/galerija/{{$podaci['galerija']['id']}}/{{$podaci['galerija']['slug']}}" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-ok"></span> Završeno dodavanje</a>
                </div>
            </div>
        </div>
    </div>

    {!! HTML::style('/dragdrop/css/fileinput.css') !!}
    {!! HTML::script('/dragdrop/js/fileinput.min.js') !!}
    <script>
        $("#input-700").fileinput({
            uploadExtraData: {folder: '{{$podaci['folder']}}/', _token:'{{csrf_token()}}'},
            uploadUrl: '/moderator/{{$podaci['slugApp']}}/galerije/upload',
            uploadAsync: true,
            maxFileCount: 10
        });
    </script>
@endsection
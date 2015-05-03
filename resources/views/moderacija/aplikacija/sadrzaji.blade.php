@extends('moderacija.master-moderator')
@section('content')
    <h1>Podešavanje sadrzaja</h1>
    {!!Form::open(['id'=>'app'])!!}
        {!!Form::select('slug',$podaci['aplikacije'],isset($podaci['app'])?$podaci['app']['slug']:null,['class'=>'form-control'])!!}
    {!!Form::close()!!}
    <script>
        $(document).ready($('select').change(function(){
            $('#app').attr("action", '/moderator/sadrzaji/'+$(this).val());
            $('#app').submit();
        }));
    </script>
    @if(isset($podaci['sadrzaji']))
        @foreach($podaci['sadrzaji'] as $podatak)
            <hr>
            {!!Form::open(['url'=>'/moderator/sadrzaji-update/'.$podatak['id'],'class'=>'form-horizontal'])!!}
                <div class="form-group">
                    <div class="col-sm-12">
                        {!!Form::text('naziv',$podatak['sadrzaj_naziv'],['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        {!!Form::textarea('sadrzaj',$podatak['sadrzaj'],['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        {!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['class'=>'btn btn-lg btn-primary','type'=>'submit'])!!}
                    </div>
                </div>
            {!!Form::close()!!}
        @endforeach
        @if($podaci['pozadine'])
            @foreach($podaci['pozadine'] as $pozadina)
                <hr>
                <div class="col-sm-3"><img id="pozadina-{{$pozadina['id']}}" src="/{{$pozadina['sadrzaj']}}" width="100%"></div>
                <div class="col-sm-9">
                    @if($pozadina['sadrzaj_naziv'])Naznv: {{$pozadina['sadrzaj_naziv']}}@endif
                    {!!Form::open(['url'=>'/moderator/sadrzaji-update/'.$pozadina['id']])!!}
                        {!!Form::hidden('sadrzaj',$pozadina['sadrzaj'],['id'=>'sadrzaji-'.$pozadina['id']])!!}
                        {!!Form::button('<i class="glyphicon glyphicon-pencil"></i> Izmeni',['class'=>'btn btn-lg btn-info','data-toggle'=>'modal','data-target'=>'#foto'])!!}
                        {!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['class'=>'btn btn-lg btn-primary','type'=>'submit'])!!}
                    {!!Form::close()!!}
                </div><br clear="all">
            @endforeach
        @endif
    @endif

    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            theme: "modern",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | forecolor backcolor emoticons",
            image_advtab: true,
            templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ]
        });
    </script>
@endsection

@section('body')
    @if(isset($podaci['sadrzaji']))
    <div class="modal fade" id="foto">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h2>Izaberite pozadinu <i>iz galerije</i></h2>
                </div>
                <div class="modal-body">
                    @foreach(\App\OsnovneMetode::listaFotografija('galerije/'.Session::get('username').'/aplikacije/'.$podaci['app']['slug'].'/'.$podaci['app']['tema'].'/pozadine-1') as $pozadina)
                        <div class="col-sm-4">
                            {!! Form::button('<img src="/'.$pozadina.'">',['class'=>'thumbnail','data-html'=>'true','data-toggle'=>'popover','data-trigger'=>'focus','title'=>'Opcije','data-content'=>\App\OsnovneMetode::dugmiciZaIzborPozadine($podaci['pozadine'],$pozadina)]) !!}
                        </div>
                    @endforeach
                    <script>
                        $(document).ready(function(){$('.thumbnail').popover();});
                        function pozadina(id,url){$('#pozadina-'+id).attr('src','/'+url);$('#sadrzaji-'+id).val(url)}
                    </script>
                    <br clear="all">
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
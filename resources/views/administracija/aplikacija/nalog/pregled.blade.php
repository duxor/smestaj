@extends('administracija.masterBackEnd')
@section('content')
    <h1>Pregled aplikacija</h1>
    @if(isset($podaci))
        @if($podaci)
            @foreach($podaci as $podatak)
                <hr>
                {!!Form::open(['url'=>'/administracija/nalog/sadrzaji/'.$podatak['id'],'class'=>'form-horizontal'])!!}
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
        @else
            <p>Ne postoje podaci u evidenciji.</p>
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
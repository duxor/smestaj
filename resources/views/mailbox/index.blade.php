@extends("{$podaci['prava']}.master")
@section('content')
    <div class="col-sm-3">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" @if($podaci['akcija']=='nova') class="active" @endif><a href="#">Kreiraj poruku</a></li>
            <li role="presentation" @if($podaci['akcija']=='inbox') class="active" @endif><a href="#">Inbox</a></li>
            <li role="presentation" @if($podaci['akcija']=='poslate') class="active" @endif><a href="#">Poslate</a></li>
        </ul>
    </div>
    <div class="col-sm-9">

    </div>
@endsection
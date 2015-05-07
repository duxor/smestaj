
$(document).ready(function() {
	// navigation click actions	
	$('.scroll-link').on('click', function(event){
		event.preventDefault();
		var sectionID = $(this).attr("data-id");
		scrollToID('#' + sectionID, 750);
	});
	// scroll to top action
	$('.scroll-top').on('click', function(event) {
		event.preventDefault();
		$('html, body').animate({scrollTop:0}, 'slow');
	});
	// mobile nav toggle
	$('#nav-toggle').on('click', function (event) {
		event.preventDefault();
		$('#main-nav').toggleClass("open");
	});
});
// scroll function
function scrollToID(id, speed){
	var offSet = 50;
	var targetOffset = $(id).offset().top - offSet;
	var mainNav = $('#main-nav');
	$('html,body').animate({scrollTop:targetOffset}, speed);
	if (mainNav.hasClass("open")) {
		mainNav.css("height", "1px").removeClass("in").addClass("collapse");
		mainNav.removeClass("open");
	}
}
//funkcija za zadrzavanje aktivnog taba na strani registracija
$(document).ready(function() {
 $('a[data-toggle="tab"]').on('click', function (e) {
    localStorage.setItem('lastTab', $(e.target).attr('href'));
  });
  var lastTab = localStorage.getItem('lastTab');
  if (lastTab) {
      $('a[href="'+lastTab+'"]').click();
  }
});
/*#
 ### Autor: Dusan Perisci
 ### Home: dusanperisic.com
 ###
 ### Napomena: 	Klasa je pisana kao dodatak Bootstrap framework-a
 ###			Voditi racuna o formatiranju koje je potrebno da bude zadovoljeno (Pogledati primjer ispod)
 ### 			Ukoliko ne želite da se određeno polje nađe u provjeri ne treba mu dodjeljivati ID
 ###			ID = NAZIV_POLJA
 ###			ID_DIV = dID
 ###			ID_SPAN = sID
 ### ------------------------------------------------------------------
 ### Primjer:
 ### HTML:
 ### <form id="forma" class="form-horizontal">
 ### 	<div id="dime" class="form-group has-feedback">
 ###		<label for="ime" class="control-label col-sm-2">Ime</label>	
 ###		<div class="col-sm-10">
 ###			<input id="ime" name="ime" class="form-control" placeholder="Unesite vaše ime">
 ### 			<span id="sime" class="glyphicon form-control-feedback"></span>
 ###		</div>
 ### 	</div>
 ###	<div class="form-group">
 ###		<div class="col-sm-2"></div>
 ###		<div class="col-sm-10">
 ###			<button type="button" class="btn btn-lg btn-success" onClick="SubmitForm.submit('forma')">
 ###				Submit
 ###			</button>
 ###		</biv>
 ###	</div>
 ### </form>
 ###
 */
var SubmitForm = {
	submit: function(formaID){
		var test = 1;
		var input = document.forms[formaID].getElementsByTagName('input');
		var area = document.forms[formaID].getElementsByTagName('textarea');
		var inputL = input.length,
			areaL = area.length;
		for(i=0; i< Math.max(inputL,areaL); i++){
			if(i < inputL && input[i].getAttribute('id'))
				test = this.succErr(input[i].getAttribute('type')=='email'?'email':'input',input[i].getAttribute('id'), test);
			if(i < areaL && area[i].getAttribute('id'))
				test = this.succErr('area',area[i].getAttribute('id'), test);
		}
		if(test) $('#'+formaID).submit();
		else alert('Popunite sve podatke.');
	},
	testEmail: function(email){
		var i1 = email.indexOf('@'),
			i2 = email.indexOf('.');
		if((i1 < 1 || i2 < 1) || (i1 > i2)) return false;
		else return true;
	},
	succErr: function(tip, ime, t){
		var polje = tip == 'input' || tip == 'email' ? 'input[name="'+ime+'"]' : tip == 'area' ? '#'+ime : null;
		if($(polje).val().length > 2 && (tip=='email'?this.testEmail($(polje).val()):true)){
			$('#d'+ime).removeClass('has-error');
			$('#d'+ime).addClass('has-success');
			$('#s'+ime).removeClass('glyphicon-remove');
			$('#s'+ime).addClass('glyphicon-ok');
			return t;
		}else{
			$('#d'+ime).removeClass('has-success');
			$('#d'+ime).addClass('has-error');
			$('#s'+ime).removeClass('glyphicon-ok');
			$('#s'+ime).addClass('glyphicon-remove');
			return 0;
		}
	}
}
/*#
 ### Autor: Dusan Perisci
 ### Home: dusanperisic.com
 ###
 ### Napomena: 	Klasa je pisana kao dodatak Laravel framework-a
 ### ------------------------------------------------------------------
 ### Primjer:
 ### HTML:  <div id="poruka" style="display: none;background-color: #005fb3"></div>
 ###        <div id="wait" style="display:none">
 ###            <center>
 ###                <i class='icon-spin6 animate-spin' style="font-size: 350%"></i>
 ###            </center>
 ###        </div>
 ###        <div id="hide">
 ###            <button class="btn btn-lg btn-danger" onclick="Komunikacija.posalji('{{csrf_token()}}','/pretraga/test',{prezime:'Perisic',ime:'Dusan'},'poruka','wait','hide')">Test</button>
 ###        </div>
 ###
 ### LARAVEL metoda:
 ### 	public function postTest(){
 ###		return json_encode(['msg'=>'prezime='.Input::get('podaci')['prezime'].' ime='.Input::get('podaci')['ime'],'check'=>1]);
 ###	}
 ### VARIJABLE
 ### token = jedinstven i kreira se preko laravel ugradjene funkcije csrf_token()
 ### url = adresa kojoj se prosledjuju podaci
 ### podaci = niz koji sadrzi sve podatke koje se prosledjuju
 ### poruka = ID elementa u kome ce da se ispisuje poruka
 ### wait = ID elementa koji sadrzi wait animaciju
 ### hide = ID elementa ciji sadrzaj treba da se sakrije dok je wait aktivan
 ###
*/
var Komunikacija = {
    posalji: function(token,url,podaci,poruka,wait,hide){
        $('#'+hide).css('display','none');
        $('#'+wait).fadeToggle();
        $.post(url,
            {
                _token:token,
                podaci:podaci
            },
            function(data){
                data=JSON.parse(data);
                $('#'+poruka).html('<div class="alert alert-'+ (data['check']?'success':'danger') +'" role="alert">'+data['msg']+'</div>');
                $('#'+wait).fadeToggle();
                $('#'+poruka).fadeToggle('slow');
                window.setTimeout(function(){
                    $('#'+poruka).fadeToggle('slow');
                    $('#'+hide).fadeToggle('slow')
                },3000);
            }
        );
    }
}

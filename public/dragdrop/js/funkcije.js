$(document).ready(function() {
	// navigacioni klik
	$('.scroll-link').on('click', function(event){
		event.preventDefault();
		var sectionID = $(this).attr("data-id");
		scrollToID('#' + sectionID, 750);
	});
	// scroll na vrh
	$('.scroll-top').on('click', function(event) {
		event.preventDefault();
		$('html, body').animate({scrollTop:0}, 'slow'); 		
	});
	// toggle za mobilne platforme
	$('#nav-toggle').on('click', function (event) {
		event.preventDefault();
		$('#main-nav').toggleClass("open");
	});
});
// scroll funkcija
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
if (typeof console === "undefined") {
    console = {
        log: function() { }
    };
}

//REZERVACIJA
function provjeraTermina(){
	if(!$('input[name="datumOd"]').val()){
		var n = new Date();
		var d = n.getFullYear()+'-'+ (n.getMonth()+1) +'-'+ n.getDate();
		var dd = n.getFullYear()+'-'+ (n.getMonth()+1) +'-'+ (n.getDate()+1);
		$('input[name="datumOd"]').val(d);
		$('input[name="datumDo"]').val(dd);
	}
	var dod = $('input[name="datumOd"]').val();
	var ddo = $('input[name="datumDo"]').val();

	$.get('/administracija/dostupnost',
		{
			od: dod,
			do: ddo
		},
		function(data, status){
			var r = JSON.parse(data);
			var tabela = '<thead><tr><th>Naziv</th><th>Vrsta</th><th>Cena (*din)</th><th>Broj kreveta</th><th></th></tr></thead>';
			for(i=0; i<r.length; i++)
				tabela+="<tr><td>"+r[i]['naziv']+"</td><td>"+r[i]['vrsta']+"</td><td>"+r[i]['cena']+"</td><td>"+r[i]['brojKreveta']+"</td><td><button type='button' class='btn btn-success' onclick='rPodaci("+r[i]['id']+","+r[i]['brojKreveta']+","+r[i]['cena']+")'>Rezervisite</button></td></tr>";
			$("#dostupno").html(tabela);
		});
}
$('#rezervacije .input-daterange').datepicker({
	orientation: "top auto",
	weekStart: 1,
	startDate: "current",
	todayBtn: "linked",
	toggleActive: true,
	format: "yyyy-mm-dd"
});
var cenaG = 0;
function rPodaci(id,brKreveta,cena){
	cenaG = cena;
	$('#rPo').css('display','block');
	$('input[name="objekat_id"]').val(id);
	$('input[name="cena"]').val(cena);
	$('#brojOsoba').html('');
	for(var i=1;i<brKreveta+1;i++) $('#brojOsoba').append("<option value=\""+i+"\">"+i+"</option>");
}
function racunajCenu(){
	$('input[name="cena"]').val(cenaG*$('#brojOsoba').val());
}
function subRezervacija(){//Akcija prilikom submit-a forme za rezervacije
	var test = 1;
	test = succErr('prezime',test);
	test = succErr('ime',test);
	test = succErr('email',test);
	test = succErr('telefon',test);
	if(test) $('#forma').submit();
	else alert('Popunite sve podatke.');
}
function subEmail(){
	var test = 1;
	test = succErr('k_ime',test);
	test = succErr('k_email',test);
	test = succErr('k_poruka',test);
	if(test) $('#kontaktForma').submit();
	else alert('Popunite sve podatke.');
}
/*#
### Autor: Dusan Perisci
###	Home: dusanperisic.com
###
### Napomena: 	Voditi racuna o napomenama navedenim za funkciju succErr(tip, ime, t)
### 			formaID je id forme koja prosledjuje podatke
*/
function _submit(formaID){
	var test = 1;
	var input = document.forms[formaID].getElementsByTagName('input');
	var area = document.forms[formaID].getElementsByTagName('textarea');
	var inputL = input.length,
		areaL = area.length;
		
	for(i=0; i< Math.max(inputL,areaL); i++){
		if(i < inputL && input[i].getAttribute('id')) test = succErr('input',input[i].getAttribute('id'), test);
		if(i < areaL && area[i].getAttribute('id')) test = succErr('area',area[i].getAttribute('id'), test);
	}
	if(test) $('#'+formaID).submit();
	else alert('Popunite sve podatke.');
}
/*#
### Autor: Dusan Perisci
###	Home: dusanperisic.com
###
### Napomena: 1	Div elementu koji cini form-group se dodaje ID polje po formuli d+id 
### 			pri cemu je id input polja ili textare-e koju obuhvata
### 		  2 Ukoliko polje ne zahtijeva provjeru ne dodjeljivati ID ni form-group polju ni elementu unosa
*/
function succErr(tip, ime, t){
	var polje = tip == 'input' ? 'input[name="'+ime+'"]' : tip == 'area' ? '#'+ime : null;
	if($(polje).val().length > 2){
		$('#d'+ime).removeClass('has-error');
		$('#d'+ime).addClass('has-success');
		return t;
	}else{
		$('#d'+ime).removeClass('has-success');
		$('#d'+ime).addClass('has-error');
		return 0;
	}
}

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
 ### JS: var SubmitForma = new SubmitForm();
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
 ###			<button type="button" class="btn btn-lg btn-success" onClick="SubmitForma.submit('forma')">
 ###				Submit
 ###			</button>
 ###		</biv>
 ###	</div>
 ### </form>
 ###
 */
function SubmitForm(){
	this.submit = function(formaID){
		var test = 1;
		var input = document.forms[formaID].getElementsByTagName('input');
		var area = document.forms[formaID].getElementsByTagName('textarea');
		var inputL = input.length,
			areaL = area.length;
		for(i=0; i< Math.max(inputL,areaL); i++){
			if(i < inputL && input[i].getAttribute('id'))
				test = succErr(input[i].getAttribute('type')=='email'?'email':'input',input[i].getAttribute('id'), test);
			if(i < areaL && area[i].getAttribute('id')) 
				test = succErr('area',area[i].getAttribute('id'), test);
		}
		if(test) $('#'+formaID).submit();
		else alert('Popunite sve podatke.');
	}
	var testEmail = function(email){
		var i1 = email.indexOf('@'),
			i2 = email.indexOf('.');
		if((i1 < 1 || i2 < 1) || (i1 > i2)) return false;
		else return true;
	}
	var succErr = function(tip, ime, t){
		var polje = tip == 'input' || tip == 'email' ? 'input[name="'+ime+'"]' : tip == 'area' ? '#'+ime : null;
		if($(polje).val().length > 2 && (tip=='email'?testEmail($(polje).val()):true)){
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

var SubmitForma = new SubmitForm();
var r = new Responsive();
$(window).resize(function(){
	r.ready();
});

function Responsive(){
	this.ready = function(){ rowToButton(); };
	var rowToButton = function(e) {
		if($(window).width() < 600){
			$('.rowElement').css('display','none');
			$('.rowInstead').css('display','block');	
		}else{
			$('.rowElement').css('display','block');
			$('.rowInstead').css('display','none');
		}
	};	
	return this.ready();
}

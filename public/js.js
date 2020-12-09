function ObliczStawke(){
	let stawka = parseInt($('#stawka').text());
	let czas = parseInt($('#select').val());
	let razem = stawka * czas;
	$('#razem').text(razem);
}
$(document).ready(function(){
	ObliczStawke();
	$('#select').change(function(){
		ObliczStawke();
	});
});

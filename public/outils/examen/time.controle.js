
var timeEnd = document.getElementById('leftTime').value;
$('#clock').countdown(timeEnd, function(event) {
	 $(this).html(event.strftime('%H:%M:%S'));
});
var timeEndInSec = document.getElementById('leftTimeInSec').value;

function Horloge() {
   document.getElementById('formRepense').submit();
}
setTimeout(Horloge, parseInt(timeEndInSec));

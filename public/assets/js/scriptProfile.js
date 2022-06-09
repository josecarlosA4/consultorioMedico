document.getElementById('openHistoric').addEventListener('click', (e)=> {
	e.preventDefault();
	if(document.getElementById('historic').classList.contains('inative')) {
		document.getElementById('historic').classList.remove('inative')
		document.getElementById('historic').classList.add('active')
	} else if(document.getElementById('historic').classList.contains('active')) {
		document.getElementById('historic').classList.remove('active')
		document.getElementById('historic').classList.add('inative')
	}
});

function login(){
	var username = $('#username').val();
	var password = $('#password').val();

	if(username === 'admin' && password === 'admin'){
		$(location).attr('href', 'html/main.php');
	}
	else{
		alert(username + "\n" + password);
	}
}
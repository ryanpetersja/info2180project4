window.onload = function() {
	var results = document.getElementById("messages");
    var button = document.getElementById("refresh");

	/*Output the result of the ajax request*/
    function successFunction(res) {
        results.innerHTML = res.responseText;
    }
    
    /*AJAX request to refresh content for the user without refreshing the page*/
    button.addEventListener("click", function() {
        new Ajax.Request("mail.php", {
            onSuccess : successFunction,
            method : "post"
        });
    });

    /*Load the content for the user on page load*/
    new Ajax.Request("mail.php", {
        onSuccess : successFunction,
        method : "post"
    });
}
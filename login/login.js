const urlParams = new URLSearchParams(window.location.search); 

//? Si j'ai le paramètre logout dans mon url alors
if (urlParams.get("logout")) {
    $.ajax({
        url: "../php/logout.php", 
        type: "GET", 
        dataType: "json", 
        success: () => {
            //! Je supprime l'utilisateur de mon localStorage car il s'est déconnecté
            localStorage.removeItem("user");
        }
    });
}

$("form").submit((event) => {
    event.preventDefault(); 

    $.ajax({
        url: "../php/login.php", 
        type: "POST", 
        dataType: "json", 
        data: { 
            email: $("#email").val(),
            password: $("#password").val()
        },
        success: (res) => {
            if (res.success) { 
                localStorage.setItem("user", JSON.stringify(res.user)); 
                window.location.replace("../home/home.html"); 
            } else alert(res.error);
        }
    });
});
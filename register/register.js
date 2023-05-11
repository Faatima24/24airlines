$("form").submit((event) => { 
    event.preventDefault(); 

    $.ajax({
        url: "../php/register.php", // URL cible
        type: "POST", // Type de méthode de requête HTTP
        dataType: "json", // Type de réponse attendue
        data: { // Donnée(s) à envoyer s'il y en a
            firstname: $("#firstname").val(),
            lastname: $("#lastname").val(),
            birthdate: $("#birthdate").val(),
            email: $("#email").val(),
            password: $("#password").val(),
            chief: $("#chief").val(),
            street_number: $("#street_number").val(),
            street_name: $("#street_name").val(),
            zip_code: $("#zip_code").val(),
            city: $("#city").val(),
            flight_hours: $("#flight_hours").val(),
            profile_picture: $("#profile_picture").val(),
        },
        success: (res) => {
            if (res.success) window.location.replace("../login/login.html");
            else alert(res.error); 
        }
    });
});
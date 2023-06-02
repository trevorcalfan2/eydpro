

document.getElementById("pwdtxt").addEventListener("keyup", (event) => {
        
                

    var pswd = $('#pwdtxt').val;
var pswd = document.getElementById("pwdtxt")





    //validate the length
    if ( pswd.length < 8 ) {

        document.getElementById("threereq").classList.remove("validd");

        document.getElementById("threereq").classList.add("invalidd");



    $('#threereq').removeClass('validd').addClass('invalidd');
    } else {

        document.getElementById("threereq").classList.remove("invalidd");

        document.getElementById("threereq").classList.add("validd");
    $('#threereq').removeClass('invalidd').addClass('validd');
    }
                //validate letter
    if ( pswd.match(/[A-z]/) ) {
    $('#onereq').removeClass('invalidd').addClass('validd');
    } else {
    $('#onereq').removeClass('validd').addClass('invalidd');
    }

    //validate capital letter
    if ( pswd.match(/[A-Z]/) ) {
    $('#tworereq').removeClass('invalidd').addClass('validd');
    } else {
    $('#tworereq').removeClass('validd').addClass('invalidd');
    }
    //validate number
    if ( pswd.match(/\d/) ) {
    $('#fourreq').removeClass('invalidd').addClass('validd');
    } else {
    $('#fourreq').removeClass('validd').addClass('invalidd');
    }
    if (containsSpecialCharacters(pswd)) {
    $('#fivereq').removeClass('invalidd').addClass('validd');
    } else {
    $('#fivereq').removeClass('validd').addClass('invalidd');
    }


}).focus(function() {

}).blur(function() {

});


function containsSpecialCharacters(str){
        var format = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
        return format.test(str)
    }

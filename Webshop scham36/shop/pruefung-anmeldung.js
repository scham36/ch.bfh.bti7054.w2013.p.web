// Javascript Funktion für Überprüfung Eingabe bei Anmeldung ausgelagert

function pruefungEingabe()
{
    var username = document.forms["anmeldung"]["username"].value;
    var password = document.forms["anmeldung"]["password"].value;

    if (username == null || username == "")
    {
        alert("Benutzername muss ausgefüllt werden.");
        return false;
    }
    if (password == null || password == "") {
        alert("Passwort muss ausgefüllt werden.");
        return false;
    }
    return true;
}

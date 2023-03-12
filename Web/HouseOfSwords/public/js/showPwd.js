// JELSZÓ MEGJELENÍTÉSE VAGY KITAKARÁSA
// A SZEM IKONRA VALÓ KATTINTÁSKOR
// REGISZTRÁCIÓNÁL VAGY BEJELENTKEZÉSNÉL
function showPwd(value) {
    // BEVITELI MEZŐK TÍPUSÁNAK VÁLTOZTATÁSA
    document.querySelector('#PwdField').type = value ? 'text' : 'password';

    if (document.querySelector('#PwdFieldConf') != null){
        document.querySelector('#PwdFieldConf').type = value ? 'text' : 'password';
    }

    // SZEM IKON MEGVÁLTOZTATÁSA
    document.querySelector('#showPwdButton').innerHTML = value ? '<img src="img/hidePassword.png" alt="Hide password"/>' : '<img src="img/showPassword.png" alt="Show password"/>';
    document.querySelector('#showPwdButton').onclick = function () {
        showPwd(!value);
    }
}

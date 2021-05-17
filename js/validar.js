function validarISBN(str) {

    var sum,
        weight,
        digit,
        check,
        i;

    str = str.replace(/[^0-9X]/gi, '');

    if (str.length != 10 && str.length != 13) {
        return false;
    }

    if (str.length == 13) {
        sum = 0;
        for (i = 0; i < 12; i++) {
            digit = parseInt(str[i]);
            if (i % 2 == 1) {
                sum += 3 * digit;
            } else {
                sum += digit;
            }
        }
        check = (10 - (sum % 10)) % 10;
        return (check == str[str.length - 1]);
    }

    if (str.length == 10) {
        weight = 10;
        sum = 0;
        for (i = 0; i < 9; i++) {
            digit = parseInt(str[i]);
            sum += weight * digit;
            weight--;
        }
        check = (11 - (sum % 11)) % 11
        if (check == 10) {
            check = 'X';
        }
        return (check == str[str.length - 1].toUpperCase());
    }
}

function validarString(cadena, min, max) {
    var res = false;
    if (min == 0 && max != null) {
        if ((isNaN(cadena) && cadena.length <= max) || cadena == "")
            res = true;
    }
    if (min > 0 && max == null) {
        if (isNaN(cadena) && cadena.length >= min)
            res = true;
    }
    if (min == 0 && max == null) {
        if (isNaN(cadena) || cadena == "")
            res = true;
    }
    if (min > 0 && max != null) {
        if (isNaN(cadena) && cadena.length >= min && cadena.length <= max)
            res = true;
    }
    return res;
}

function esVacio(valor) {
    if (valor == "") {
        return true;
    } else {
        return false;
    }

}

function validarClave(contrasenna) {
    if (contrasenna.length >= 6) {
        var mayuscula = false;
        var minuscula = false;
        var numero = false;


        for (var i = 0; i < contrasenna.length; i++) {
            if (contrasenna.charCodeAt(i) >= 65 && contrasenna.charCodeAt(i) <= 90) {
                mayuscula = true;
            } else if (contrasenna.charCodeAt(i) >= 97 && contrasenna.charCodeAt(i) <= 122) {
                minuscula = true;
            } else if (contrasenna.charCodeAt(i) >= 48 && contrasenna.charCodeAt(i) <= 57) {
                numero = true;
            } else {
                caracter_raro = false;
            }
        }
        if (mayuscula == true && minuscula == true && numero == true) {
            return true;
        }
    }
    return false;
}

function validateDocumento(value) {
    var validChars = 'TRWAGMYFPDXBNJZSQVHLCKET';
    var nifRexp = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i;
    var nieRexp = /^[XYZ]{1}[0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i;
    var str = value.toString().toUpperCase();

    if (!nifRexp.test(str) && !nieRexp.test(str)) return false;

    var nie = str
        .replace(/^[X]/, '0')
        .replace(/^[Y]/, '1')
        .replace(/^[Z]/, '2');

    var letter = str.substr(-1);
    var charIndex = parseInt(nie.substr(0, 8)) % 23;

    if (validChars.charAt(charIndex) === letter) return true;

    return false;
}
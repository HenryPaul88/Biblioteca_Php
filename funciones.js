function mostrar(elemento) {
    elemento.style.display = "block";
}

function noMostrar(elemento) {
    elemento.style.display = "none";
}

function validarStringInside(elemento, min, max, capaerror) {
    if (!validarString(elemento.value, min, max)) {
        if (!esVacio(elemento)) {
            elemento.style.borderColor = "red";
            mostrar(capaerror);
        }

    } else {
        elemento.style.backgroundColor = "";
        elemento.style.borderColor = "green";
        noMostrar(capaerror);
    }
}

function validarISBNInside(elemento, capaerror) {
    if (!validarISBN(elemento.value)) {
        if (!esVacio(elemento)) {
            elemento.style.borderColor = "red";
            mostrar(capaerror);
        }

    } else {
        elemento.style.backgroundColor = "";
        elemento.style.borderColor = "green";
        noMostrar(capaerror);
    }
}

function validarClaveInside(elemento, capaerror) {
    if (!validarClave(elemento.value)) {
        if (!esVacio(elemento)) {
            elemento.style.borderColor = "red";
            mostrar(capaerror);
        }

    } else {
        elemento.style.backgroundColor = "";
        elemento.style.borderColor = "green";
        noMostrar(capaerror);
    }
}

function validarDocumentoIndise(elemento, capaerror) {
    if (!validateDocumento(elemento.value)) {
        if (!esVacio(elemento)) {
            elemento.style.borderColor = "red";
            mostrar(capaerror);
        }
    } else {
        elemento.style.borderColor = "green";
        noMostrar(capaerror);
    }
}


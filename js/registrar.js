
function getMinisterio() {
    $("#ministerio").empty();

    fetch('https://sistemas.mininterior.gob.ar/api/organigrama/api/organigrama/', {

        method: "GET",
        headers: new Headers({
            'Content-Type': 'application/x-www-form-urlencoded',
        })
    })
        .then(resp => resp.json())
        .then(respObj => {

            if (respObj.status == 0) {
                var objData = JSON.parse(respObj.messege);

                $("#ministerio").append('<option value="">Elija una opción</option>');
                for (i = 0; i < objData.length; i++) {
                    $("#ministerio").append('<option value="' + objData[i].id + '">' + objData[i].ministerio + '</option>');
                }

            } else {
                swal("Algo salió mal!", respObj.messege, "error");
            }
        })
        .catch(error => {
            swal("Algo salió mal!", error, "error");
        });
}

function getSecretaria() {
    $("#secretaria").empty();
    $("#subsecretaria").empty();
    $("#direcciongral").empty();
    $("#direccion").empty();
    $("#coordinacion").empty();

    var ministerio = $("#ministerio").val();
    // alert(ministerio);
    fetch('https://sistemas.mininterior.gob.ar/api/organigrama/api/organigrama/secretarias/' + ministerio, {
        method: "GET",
        headers: new Headers({
            'Content-Type': 'application/x-www-form-urlencoded',
        })
    })
        .then(resp => resp.json())
        .then(respObj => {

            if (respObj.status == 0) {
                var objData = JSON.parse(respObj.messege);
                if(objData.length>0){ 
                    document.getElementById("secretariaDiv").setAttribute("style", "visibility:visible");
                    $("#secretaria").append('<option value="">Elija una opción</option>');
                    for (i = 0; i < objData.length; i++) {
                        $("#secretaria").append('<option value="' + objData[i].id + '">' + objData[i].descripcion + '</option>');
                    }
                }
                

            } else {
                swal("Algo salió mal!", respObj.messege, "error");
            }
        })
        .catch(error => {
            swal("Algo salió mal!", error, "error");
        });
}

function getSubSecretaria() {
    $("#subsecretaria").empty();
    $("#direcciongral").empty();
    $("#direccion").empty();
    $("#coordinacion").empty();

    var ministerio = $("#secretaria").val();
    // alert(ministerio);

    fetch('https://sistemas.mininterior.gob.ar/api/organigrama/api/organigrama/subsecretarias/' + ministerio, {
        method: "GET",
        headers: new Headers({
            'Content-Type': 'application/x-www-form-urlencoded',
        })
    })
        .then(resp => resp.json())
        .then(respObj => {

            if (respObj.status == 0) {

                var objData = JSON.parse(respObj.messege);
                if(objData.length>0){ 
                    document.getElementById("subsecretariaDiv").setAttribute("style", "visibility:visible;");
                    $("#subsecretaria").append('<option value="">Elija una opción</option>');
                    for (i = 0; i < objData.length; i++) {
                        $("#subsecretaria").append('<option value="' + objData[i].id + '">' + objData[i].descripcion + '</option>');
                    }
                }

            } else {
                swal("Algo salió mal!", respObj.messege, "error");
            }
        })
        .catch(error => {
            swal("Algo salió mal!", error, "error");
        });
}

function getDirecciongral() {
    $("#direcciongral").empty();
    $("#direccion").empty();
    $("#coordinacion").empty();

    var ministerio = $("#subsecretaria").val();
    // alert(ministerio);

    fetch('https://sistemas.mininterior.gob.ar/api/organigrama/api/organigrama/direcciongral/' + ministerio, {
        method: "GET",
        headers: new Headers({
            'Content-Type': 'application/x-www-form-urlencoded',
        })
    })
        .then(resp => resp.json())
        .then(respObj => {

            if (respObj.status == 0) {
                if(objData.length>0){ 
                    document.getElementById("direcciongralDiv").setAttribute("style", "visibility:visible;");
                    var objData = JSON.parse(respObj.messege);
                    $("#direcciongral").append('<option value="">Elija una opción</option>');
                    for (i = 0; i < objData.length; i++) {
                        $("#direcciongral").append('<option value="' + objData[i].id + '">' + objData[i].descripcion + '</option>');
                    }
                }

            } else {
                swal("Algo salió mal!", respObj.messege, "error");
            }
        })
        .catch(error => {
            swal("Algo salió mal!", error, "error");
        });
}

function getDireccion() {
    $("#direccion").empty();
    $("#coordinacion").empty();

    var ministerio = $("#direcciongral").val();

    // alert(ministerio);
    fetch('https://sistemas.mininterior.gob.ar/api/organigrama/api/organigrama/direccion/' + ministerio, {
        method: "GET",
        headers: new Headers({
            'Content-Type': 'application/x-www-form-urlencoded',
        })
    })
        .then(resp => resp.json())
        .then(respObj => {

            if (respObj.status == 0) {
                var objData = JSON.parse(respObj.messege);
                if(objData.length>0){ 
                    document.getElementById("direccionDiv").setAttribute("style", "visibility:visible;");
                    $("#direccion").append('<option value="">Elija una opción</option>');
                    for (i = 0; i < objData.length; i++) {
                        $("#direccion").append('<option value="' + objData[i].id + '">' + objData[i].descripcion + '</option>');
                    }
                }

            } else {
                swal("Algo salió mal!", respObj.messege, "error");
            }
        })
        .catch(error => {
            swal("Algo salió mal!", error, "error");
        });
}

function getCoordinacion() {
    $("#coordinacion").empty();

    var ministerio = $("#direccion").val();

    // alert(ministerio);
    fetch('https://sistemas.mininterior.gob.ar/api/organigrama/api/organigrama/coordinaciones/' + ministerio, {
        method: "GET",
        headers: new Headers({
            'Content-Type': 'application/x-www-form-urlencoded',
        })
    })
        .then(resp => resp.json())
        .then(respObj => {

            if (respObj.status == 0) {

                var objData = JSON.parse(respObj.messege);
                if(objData.length>0){ 
                    document.getElementById("coordinacionDiv").setAttribute("style", "visibility:visible;");
                    $("#coordinacion").append('<option value="">Elija una opción</option>');
                    for (i = 0; i < objData.length; i++) {
                        $("#coordinacion").append('<option value="' + objData[i].id + '">' + objData[i].descripcion + '</option>');
                    }
                }

            } else {
                swal("Algo salió mal!", respObj.messege, "error");
            }
        })
        .catch(error => {
            swal("Algo salió mal!", error, "error");
        });
}

getMinisterio();
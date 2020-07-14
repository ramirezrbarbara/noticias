
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
                // var intro = document.getElementById('osecretaria');
                // intro.style.display = 'block';
                // $("#osecretaria").css("display", "block");
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
    if (ministerio != "") {
        $("#osecretaria").css("display", "block");     
        $("#osubsecretaria").css("display", "none");
        $("#odirecciongral").css("display", "none");
        $("#odireccion").css("display", "none");
        $("#ocoordinacion").css("display", "none");
    } else {
        ministerio = 0;
        $("#osecretaria").css("display", "none");
        $("#osubsecretaria").css("display", "none");
        $("#odirecciongral").css("display", "none");
        $("#odireccion").css("display", "none");
        $("#ocoordinacion").css("display", "none");
    }
      
    fetch('https://sistemas.mininterior.gob.ar/api/organigrama/api/organigrama/secretarias/' + ministerio, {
        method: "GET",
        headers: new Headers({
            'Content-Type': 'application/x-www-form-urlencoded',
        })
    })
        .then(resp => resp.json())
        .then(respObj => {
            //console.log(respObj.messege);
            if (respObj.status == 0) {                
                var objData = JSON.parse(respObj.messege);
                //alert(respObj.messege.length);
                if (jQuery.isEmptyObject(objData)) {
                    $("#osecretaria").css("display", "none");
                    $("#osubsecretaria").css("display", "none");
                    $("#odirecciongral").css("display", "none");
                    $("#odireccion").css("display", "none");
                    $("#ocoordinacion").css("display", "none");
                    return false;
                }

                // var ministerio = $("#ministerio").val();
                // if (ministerio != "") {
                $("#osecretaria").css("display", "block");
                // } else {
                //     $("#osecretaria").css("display", "none");
                //     $("#osubsecretaria").css("display", "none");
                //     $("#odirecciongral").css("display", "none");
                //     $("#odireccion").css("display", "none");
                //     $("#ocoordinacion").css("display", "none");
                // }

                $("#secretaria").append('<option value="">Elija una opción</option>');
                for (i = 0; i < objData.length; i++) {
                    $("#secretaria").append('<option value="' + objData[i].id + '">' + objData[i].descripcion + '</option>');
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
    if (ministerio != "") {
        $("#osubsecretaria").css("display", "block");
        $("#odirecciongral").css("display", "none");
        $("#odireccion").css("display", "none");
        $("#ocoordinacion").css("display", "none");
    } else {
        ministerio = 0;
        $("#osubsecretaria").css("display", "none");
        $("#odirecciongral").css("display", "none");
        $("#odireccion").css("display", "none");
        $("#ocoordinacion").css("display", "none");
    }

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
                if (jQuery.isEmptyObject(objData)) {
                    $("#osubsecretaria").css("display", "none");
                    $("#odirecciongral").css("display", "none");
                    $("#odireccion").css("display", "none");
                    $("#ocoordinacion").css("display", "none");
                    return false;
                }
                
                // var ministerio = $("#secretaria").val();
                // if (ministerio != "") {
                $("#osubsecretaria").css("display", "block");
                // } else {                      
                //     $("#osubsecretaria").css("display", "none");
                //     $("#odirecciongral").css("display", "none");
                //     $("#odireccion").css("display", "none");
                //     $("#ocoordinacion").css("display", "none");
                // }

                $("#subsecretaria").append('<option value="">Elija una opción</option>');
                for (i = 0; i < objData.length; i++) {
                    $("#subsecretaria").append('<option value="' + objData[i].id + '">' + objData[i].descripcion + '</option>');
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
    if (ministerio != "") {
        $("#odirecciongral").css("display", "block");
        $("#odireccion").css("display", "none");
        $("#ocoordinacion").css("display", "none");
    } else {
        ministerio = 0;
        $("#odirecciongral").css("display", "none");
        $("#odireccion").css("display", "none");
        $("#ocoordinacion").css("display", "none");
    }
    
    fetch('https://sistemas.mininterior.gob.ar/api/organigrama/api/organigrama/direcciongral/' + ministerio, {
        method: "GET",
        headers: new Headers({
            'Content-Type': 'application/x-www-form-urlencoded',
        })
    })
        .then(resp => resp.json())
        .then(respObj => {

            if (respObj.status == 0) {                
                var objData = JSON.parse(respObj.messege);                
                if (jQuery.isEmptyObject(objData)) {
                    $("#odirecciongral").css("display", "none");
                    $("#odireccion").css("display", "none");
                    $("#ocoordinacion").css("display", "none");
                    return false;
                }
                
                // var ministerio = $("#secretaria").val();
                // if (objData != "") {
                $("#odirecciongral").css("display", "block");
                // } else {                    
                //     $("#odirecciongral").css("display", "none");
                //     $("#odireccion").css("display", "none");
                //     $("#ocoordinacion").css("display", "none");
                // }

                $("#direcciongral").append('<option value="">Elija una opción</option>');
                for (i = 0; i < objData.length; i++) {
                    $("#direcciongral").append('<option value="' + objData[i].id + '">' + objData[i].descripcion + '</option>');
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
    if (ministerio != "") {
        $("#odireccion").css("display", "block");
        $("#ocoordinacion").css("display", "none");
    } else {
        ministerio = 0;
        $("#odireccion").css("display", "none");
        $("#ocoordinacion").css("display", "none");
    }

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
                if (jQuery.isEmptyObject(objData)) {
                    $("#odireccion").css("display", "none");
                    $("#ocoordinacion").css("display", "none");
                    return false;
                }

                // var ministerio = $("#direcciongral").val();
                // if (objData != "") {
                $("#odireccion").css("display", "block");
                // } else {
                //     $("#odireccion").css("display", "none");
                //     $("#ocoordinacion").css("display", "none");
                // }

                $("#direccion").append('<option value="">Elija una opción</option>');
                for (i = 0; i < objData.length; i++) {
                    $("#direccion").append('<option value="' + objData[i].id + '">' + objData[i].descripcion + '</option>');
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
    if (ministerio != "") {
        $("#ocoordinacion").css("display", "block");
    } else {
        ministerio = 0;
        $("#ocoordinacion").css("display", "none");
    }
    
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
                if (jQuery.isEmptyObject(objData)) {
                    $("#ocoordinacion").css("display", "none");
                    return false;
                }

                // var ministerio = $("#direccion").val();            
                // if (objData != "") {
                $("#ocoordinacion").css("display", "block");
                // } else {
                //     $("#ocoordinacion").css("display", "none");
                // }

                $("#coordinacion").append('<option value="">Elija una opción</option>');
                for (i = 0; i < objData.length; i++) {
                    $("#coordinacion").append('<option value="' + objData[i].id + '" idd="' + objData[i].id + ministerio +'">' + objData[i].descripcion + '</option>');
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
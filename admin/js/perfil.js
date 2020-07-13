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
                if (respObj.messege != "") {                    
                    // var intro = document.getElementById('osecretaria');
                    // intro.style.display = 'block';
                    //$("#osecretaria").attr("style", "block");

                    var objData = JSON.parse(respObj.messege);

                    $("#ministerio").append('<option value="">Elija una opción</option>');
                    for (i = 0; i < objData.length; i++) {
                        $("#ministerio").append('<option value="' + objData[i].id + '">' + objData[i].ministerio + '</option>');
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

// function getMinisterio() {
//     $("#ministerio").empty();

//     fetch('https://sistemas.mininterior.gob.ar/api/organigrama/api/organigrama/', {
//         method: "GET",
//         headers: new Headers({
//             'Content-Type': 'application/x-www-form-urlencoded',
//         })
//     })
//         .then(resp => resp.json())
//         .then(respObj => {

//             if (respObj.status == 0) {
//                 var objData = JSON.parse(respObj.messege);                

//                 $("#ministerio").append('<option value="">Elija una opción</option>');
//                 for (i = 0; i < objData.length; i++) {
//                     $("#ministerio").append('<option value="' + objData[i].id + '">' + objData[i].ministerio + '</option>');
//                 }

//             } else {
//                 swal("Algo salió mal!", respObj.messege, "error");
//             }
//         })
//         .catch(error => {
//             swal("Algo salió mal!", error, "error");
//         });
// }

function getSecretaria() {
    $("#osecretaria").attr("style", "block");
    $("#secretaria").empty();
    $("#subsecretaria").empty();
    $("#direcciongral").empty();
    $("#direccion").empty();
    $("#coordinacion").empty();

    var ministerio = $("#ministerio").val();
    // console.log(ministerio);
    // if (empty(ministerio)) {
    //     $("#osecretaria").attr("style", "block");
    // }
    //     $("#osecretaria").attr("style", "none");
    //     $("#osubsecretaria").attr("style", "none");
    //     $("#odirecciongral").attr("style", "none");
    //     $("#odireccion").attr("style", "none");
    //     $("#ocoordinacion").attr("style", "none");
    // }
    // alert(ministerio);
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
                if (respObj.messege != "") {                    

                    var objData = JSON.parse(respObj.messege);

                    $("#secretaria").append('<option value="">Elija una opción</option>');
                    for (i = 0; i < objData.length; i++) {
                        $("#secretaria").append('<option value="' + objData[i].id + '">' + objData[i].descripcion + '</option>');
                    }
                } else {
                    $("#osubsecretaria").attr("style", "none");
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
    $("#osubsecretaria").attr("style", "block");
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
    $("#odirecciongral").attr("style", "block");
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
                var objData = JSON.parse(respObj.messege);                

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
    //$("#odireccion").attr("style", "block");
    $("#direccion").empty();
    $("#coordinacion").empty();

    var ministerio = $("#direcciongral").val();
    if (empty(ministerio)) {
        $("#odireccion").attr("style", "block");
    } else {
        $("#odireccion").attr("style", "none");
        $("#ocoordinacion").attr("style", "none");
    }
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
    $("#ocoordinacion").attr("style", "block");
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

                $("#coordinacion").append('<option value="">Elija una opción</option>');
                for (i = 0; i < objData.length; i++) {
                    $("#coordinacion").append('<option value="' + objData[i].id + '">' + objData[i].descripcion + '</option>');
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
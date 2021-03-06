
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
    if (ministerio != null) {
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
                    $("#secretaria").append('<option value="' + objData[i].id + '" idd="' + objData[i].id + ministerio + '">' + objData[i].descripcion + '</option>');
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
                    $("#subsecretaria").append('<option value="' + objData[i].id + '" idd="' + objData[i].id + ministerio + '">' + objData[i].descripcion + '</option>');
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
                    $("#direcciongral").append('<option value="' + objData[i].id + '" idd="' + objData[i].id + ministerio + '">' + objData[i].descripcion + '</option>');
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
                    $("#direccion").append('<option value="' + objData[i].id + '" idd="' + objData[i].id + ministerio + '">' + objData[i].descripcion + '</option>');
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
                    $("#coordinacion").append('<option value="' + objData[i].id + '" idd="' + objData[i].id + ministerio + '">' + objData[i].descripcion + '</option>');
                }

            } else {
                swal("Algo salió mal!", respObj.messege, "error");
            }
        })
        .catch(error => {
            swal("Algo salió mal!", error, "error");
        });
}

$('#registrar_usuario').click(function () {
    $("#iddValor").val("");

    //Obtengo el dato IDD del select option
    var iddSec = $("#secretaria>option:selected").attr("idd");
    var iddSub = $("#subsecretaria>option:selected").attr("idd");
    var iddDgr = $("#direcciongral>option:selected").attr("idd");
    var iddDir = $("#direccion>option:selected").attr("idd");   
    var iddCoo = $("#coordinacion>option:selected").attr("idd");

    // alert($('select[id="coordinacion"] option:selected').text());
    // alert($("#coordinacion>option:selected").text());
    //Obtengo la descripcion del select option
    var iddSecDes = $("#secretaria>option:selected").text();
    var iddSubDes = $("#subsecretaria>option:selected").text();
    var iddDgrDes = $("#direcciongral>option:selected").text();
    var iddDirDes = $("#direccion>option:selected").text();
    var iddCooDes = $("#coordinacion>option:selected").text();


    // if (iddCoo != null) {
    //     $("#iddValor").val(iddCoo);
    //     $("#iddDesc").val(iddCooDes);
    // } else if (iddDir != null) {        
    //     $("#iddValor").val(iddDir);
    //     $("#iddDesc").val(iddDirDes);
    // } else if (iddDgr != null) {
    //     $("#iddValor").val(iddDgr);
    //     $("#iddDesc").val(iddDgrDes);
    // } else if (iddSub != null) {
    //     $("#iddValor").val(iddSub);
    //     $("#iddDesc").val(iddSubDes);
    // } else if (iddSec != null) {
    //     $("#iddValor").val(iddSec);
    //     $("#iddDesc").val(iddSecDes);
    // }

    if (document.getElementById("osecretaria").style.display == "block") {
        if(iddSecDes == "Elija una opción"){
            $("#iddValor").val(null);
            $("#iddDesc").val(null);
        }else { 
            $("#iddValor").val(iddSec);
            $("#iddDesc").val(iddSecDes);
        }

    } 
    if (document.getElementById("osubsecretaria").style.display == "block") {
        if(iddSubDes == "Elija una opción"){
            $("#iddValor").val(null);
            $("#iddDesc").val(null);
        }else { 
            $("#iddValor").val(iddSub);
            $("#iddDesc").val(iddSubDes);
        }
       
    } 
    if(document.getElementById("odirecciongral").style.display == "block"){
        if(iddDgrDes == "Elija una opción"){
            $("#iddValor").val(null);
            $("#iddDesc").val(null);
        }else { 
            $("#iddValor").val(iddDgr);
            $("#iddDesc").val(iddDgrDes);
        }
    }
    if (document.getElementById("odireccion").style.display == "block") {        
        if(iddDirDes == "Elija una opción"){
            $("#iddValor").val(null);
            $("#iddDesc").val(null);
        }else { 
            $("#iddValor").val(iddDir);
            $("#iddDesc").val(iddDirDes);
        }
    }
    if (document.getElementById("ocoordinacion").style.display == "block") {
        if(iddCooDes == "Elija una opción"){
            $("#iddValor").val(null);
            $("#iddDesc").val(null);
        }else { 
            $("#iddValor").val(iddCoo);
            $("#iddDesc").val(iddCooDes);
        }
    } 
}); 

getMinisterio();


function tampilFORM() {
    var status = document.getElementById('level').value;
    if(status == "operator"){
        document.getElementById("cabang").disabled = false;
        document.getElementById("kas").disabled = false;
        console.log(status);
    }else if (status == "admin") {
        document.getElementById("cabang").disabled = true;
        document.getElementById("kas").disabled = true;
    }
}
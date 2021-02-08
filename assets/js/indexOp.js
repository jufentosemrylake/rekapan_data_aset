MaunyaApa();

function cekValidasiUsername() {
    var originalusername = document.getElementById('OPusername').value;
    var inputUsername = document.getElementById('username').value;
    if (originalusername == inputUsername) {
        document.getElementById('errorUsername').innerHTML = "Username Benar.";
        document.getElementById('errorUsername').setAttribute('style', "color:green; margin-bottom:0;");
    }else if(inputUsername == ""){
        document.getElementById('errorUsername').innerHTML = inputUsername;
        document.getElementById('errorUsername').setAttribute('style', "color:white; margin-bottom:0;");
    }else{
        document.getElementById('errorUsername').innerHTML = "Username yang anda masukan salah.";
        document.getElementById('errorUsername').setAttribute('style', "color:red; margin-bottom:0;");
    }
}
function cekValidasiPassword() {
    var newPassword1 = document.getElementById('newpassword1').value;
    var newPassword2 = document.getElementById('newpassword2').value;
    if (newPassword1 == newPassword2) {
        document.getElementById('errorNewPassword2').innerHTML = "Password sesuai.";
        document.getElementById('errorNewPassword2').setAttribute('style', "color:green; margin-bottom:0;");
    }else if(newPassword1 == "" || newPassword2 == ""){
        document.getElementById('errorNewPassword2').innerHTML = newPassword2;
        document.getElementById('errorNewPassword2').setAttribute('style', "color:white; margin-bottom:0;");
    }else{
        document.getElementById('errorNewPassword2').innerHTML = "Password tidak sesuai.";
        document.getElementById('errorNewPassword2').setAttribute('style', "color:red; margin-bottom:0;");
    }
}
function showpassword() {
    var newPassword1 = document.getElementById('newpassword1').value;
    var newPassword2 = document.getElementById('newpassword2').value;
    document.getElementById('newpassword1').setAttribute('type', 'text');
    document.getElementById('newpassword2').setAttribute('type', 'text');
    document.getElementById('newpassword1').innerHTML=newPassword1;
    document.getElementById('newpassword2').innerHTML=newPassword2;
}
function hidepassword() {
    var newPassword1 = document.getElementById('newpassword1').value;
    var newPassword2 = document.getElementById('newpassword2').value;
    document.getElementById('newpassword1').setAttribute('type', 'password');
    document.getElementById('newpassword2').setAttribute('type', 'password');
    document.getElementById('newpassword1').innerHTML=newPassword1;
    document.getElementById('newpassword2').innerHTML=newPassword2;
}
function hitungResidu() {
    var harga = document.getElementById('sold').value;
    var tarif = document.getElementById('tarif').value;
    var masaManfaat = document.getElementById('masaManfaat').value;
    var jumlah = document.getElementById('qty').value;
    if(harga != "" && tarif != "" && masaManfaat!=""){
        console.log("Semua Nilai Sudah Diisi");
        var nilaiSisa = Math.round(harga * Math.pow((1 - (tarif / 100)), masaManfaat));
        document.getElementById("nilaiResidu").removeAttribute('readonly');
        document.getElementById('nilaiResidu').setAttribute('value',nilaiSisa);
    }
    if (harga!="" && jumlah!="") {
        var nilaijumlah = harga*jumlah;
        document.getElementById("nilaiJumlah").removeAttribute('readonly');
        document.getElementById('nilaiJumlah').setAttribute('value',nilaijumlah);
    }
    if(harga == ""){
        document.getElementById("nilaiResidu").setAttribute('readonly','');
        document.getElementById('nilaiResidu').setAttribute('value','');
        document.getElementById('nilaiResidu').setAttribute('placeholder','Nilai Residu');
    }
    if(jumlah == ""){
        document.getElementById("nilaiJumlah").setAttribute('readonly','');
        document.getElementById('nilaiJumlah').setAttribute('value','');
        document.getElementById('nilaiJumlah').setAttribute('placeholder','Nilai Nilai Jumlah (Rp.)');
    }
   
}
function getIDLaporan() {
    var idLaporan = document.getElementById('perioLap').value;
    console.log(idLaporan);
}
function MaunyaApa() {
    $(document).ready(function() {
        $('#asetEditModal').on('mousemove', function() {
            var harga = document.getElementById('harga').value;
            var tarif = document.getElementById('tarifEdit').value;
            var masaManfaat = document.getElementById('masaManfaatEdit').value;
            var jumlah = document.getElementById('jumlah').value;
            if(harga != "" && tarif != "" && masaManfaat!=""){
                console.log("Semua Nilai Sudah Diisi");
                var nilaiSisa = Math.round(harga * Math.pow((1 - (tarif / 100)), masaManfaat));
                document.getElementById("nilaiResiduEdit").removeAttribute('readonly');
                document.getElementById('nilaiResiduEdit').setAttribute('value',nilaiSisa);
            }
            if (harga!="" && jumlah!="") {
                var nilaijumlah = harga*jumlah;
                document.getElementById("nilaiJumlahEdit").removeAttribute('readonly');
                document.getElementById('nilaiJumlahEdit').setAttribute('value',nilaijumlah);
            }
            if(harga == ""){
                document.getElementById("nilaiResiduEdit").setAttribute('readonly','');
                document.getElementById('nilaiResiduEdit').setAttribute('value','');
                document.getElementById('nilaiResiduEdit').setAttribute('placeholder','Nilai Residu');
            }
            if(jumlah == ""){
                document.getElementById("nilaiJumlahEdit").setAttribute('readonly','');
                document.getElementById('nilaiJumlahEdit').setAttribute('value','');
                document.getElementById('nilaiJumlahEdit').setAttribute('placeholder','Nilai Nilai Jumlah (Rp.)');
            }
        });
      });
}
//live search dengan ajax
//ambil elemen yang dibutuhkan
//var keyword = document.getElementById('keyword');
//var btnCari = document.getElementById('tombolCari');
//var tabelnya = document.getElementById('tabelXaja');

//keyword.addEventListener('keyup', function () {
    //buat object ajax
  //  var xhr = new XMLHttpRequest();
    //cek kesiapan ajaxnya
   // xhr.onreadystatechange = function () {
     //   if(xhr.readyState == 4 && xhr.status == 200){
        //    tabelnya.innerHTML = xhr.responseText;
       // }    }
    //xhr.open('GET', 'assets/ajax/masaHabis.php?keyword='+keyword.value, true);
    //xhr.send();});

    //live search dengan ajax
    $(document).ready(function () {
        $('#keyword').on('keyup', function () {
            $('#tabelXaja').load('assets/ajax/masaHabis.php?keyword='+$('#keyword').val());
        });
    });
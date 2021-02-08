</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-dark">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span class="text-light">Copyright &copy; Semry <?= $tglSek =  date("Y"); ?></span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="assets/javScript/script.js"></script>
<script src="assets/jQuery/jquery-3.4.1.min.js"></script>
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->

<!-- Page level custom scripts -->
<script src="assets/datepicker/js/bootstrap-datepicker.js"></script>
<script>
  $('#tglStart').datepicker({
    format: 'dd/mm/yyyy',
  });
  $('#tglEnd').datepicker({
    format: 'dd/mm/yyyy',
  });
  $(document).ready(function() {
    $('.editLapBtn').on('click', function() {
      $('#lapEditModal').modal('show');
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();
      console.log(data);
      $('#namaKASedit').val(data[5]);
      $('#tit').val(data[2]);
      var str = data[3];
      var res = str.split(" - ");
      $('#tStart').val(res[0]);
      $('#tEnd').val(res[1]);
      $('#noLapEDIT').val(data[1]);
    });
  });
</script>
<script>
  $('#tglPRL').datepicker({
    format: 'dd/mm/yyyy',
  });
  $('#tglBeli').datepicker({
    format: 'dd/mm/yyyy',
  });

  $(document).ready(function() {
    $('.editAsetBtn').on('click', function() {
      $('#asetEditModal').modal('show');
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();
      console.log(data);
      $('#asetID').val(data[3]);
      $('#INVnm').val(data[4]);
      $('#kate').val(data[7]);
      $('#jns').val(data[8]);
      $('#pjk').val(data[9]);
      $('#tglBeli').val(data[10]);
      $('#jumlah').val(data[11]);
    });
  });
</script>

<script src="assets/js/indexOp.js"></script>

</body>

</html>
<!-- Essential javascripts for application to work-->
  
<script src="js/jquery-3.7.0.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/plugins/pace.min.js"></script>

  <script type="text/javascript" src="js/plugins/sweetalert.min.js"></script>
  <!-- Data table plugin-->
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script src="js2/functions-usuarios.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#searchStudent').on('input', function () {
            var searchText = $(this).val().toLowerCase();
            $('#idestudiante option').each(function () {
                var optionText = $(this).text().toLowerCase();
                $(this).toggle(optionText.includes(searchText));
            });
        });
    });
</script>




    
  </body>
</html>
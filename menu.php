<div id="sidebar" class="active">
  <div class="sidebar-wrapper active ps ps--active-y">
    <div class="sidebar-header position-relative">

      <div class="d-flex justify-content-between align-items-center">

        <div class="logod">
          <a href="../panelcontrol/index.php"><img src="../assets/logo/sinfondologopequeno.png" alt="CE" height="150px" width="50px" srcset=""></a>
          <!--img src="../assets/logo/logoce.svg" alt="Logo" height="150px" width="150px" /-->

        </div>
        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
            <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
              <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
              <g transform="translate(-210 -1)">
                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                <circle cx="220.5" cy="11.5" r="4"></circle>
                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
              </g>
            </g>
          </svg>
          <div class="form-check form-switch fs-6">
            <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
            <label class="form-check-label"></label>
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
            <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
            </path>
          </svg>
        </div>
        <div class="sidebar-toggler  x">
          <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
        </div>
      </div>

    </div>

    <div class="sidebar-menu">
      <ul class="menu">


        <!--buscador-->

        <li class="sidebar-item ">

          <form method="post" action="../perfil/index.php">

            <div class="row">
              <div class="col-8">
                <input type="number" id="dni" class="form-control" name="dni" placeholder="Ingresar DNI">
              </div>
              <div class="col-4">
                <button type="submit" id="buscar_dni_perfil" class="btn btn-outline-primary">Buscar</button>
              </div>
            </div>


          </form>



        </li>

        <!--inicio menu-->

        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item ">
          <a href="../panelcontrol/index.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Panel de Control</span>
          </a>
        </li>

        <li class="sidebar-item ">
          <a href="../personas/index.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Personas</span>
          </a>
        </li>

        <li class="sidebar-item ">
          <a href="../alumno/index.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Alumnos</span>
          </a>
        </li>

        <li class="sidebar-item ">
          <a href="../caja/index.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i><span>Caja</span>
          </a>
        </li>

        <!--li class="sidebar-item ">
          <a href="../ingreso/index.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Pago Cuotas</span>
          </a>
        </li-->

        <li class="sidebar-item ">
          <a href="../otroingreso/index.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Otros Ingresos</span>
          </a>
        </li>

        <li class="sidebar-item ">
          <a href="../carrera/index.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Cursos</span>
          </a>
        </li>

        <!--li class="sidebar-item ">
          <a href="../cuota/index.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Carreras - Cuotas</span>
          </a>
        </li-->

        <!--li class="sidebar-item ">
          <a href="../ingresoTipo/index.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Tipo Ingresos</span>
          </a>
        </li-->

        <li class="sidebar-item ">
          <a href="../egreso/index.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Egreso</span>
          </a>
        </li>

        <li class="sidebar-item ">
          <a href="../egresoTipo/index.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Tipo Egresos</span>
          </a>
        </li>

        <li class="sidebar-item ">
          <a href="../usuarios/index.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Usuarios</span>
          </a>
        </li>

        <li class="sidebar-item ">
          <a href="../salir.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Salir</span>
          </a>
        </li>

        <!--fin menu-->

      </ul>
    </div>

    <!-- no se que hace -->
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
      <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0px; height: 1498px; right: 0px;">
      <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 1200px;"></div>
    </div>
  </div>
</div>

<script src="../assets/js/jquery-3.6.3.min.js"></script>
<script src="../assets/js/jquery.validate.min.js"></script>
<script src="../assets/js/validar.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    /* $('#password').blur(function (e) {
       valor = $('#password').val();
       checkPassword(valor);
     });

     function checkPassword(valor) {
       var myregex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
       if (myregex.test(valor)) {
         alert(valor + " es valido :-) !");
         return true;
       } else {
         alert(valor + " NO es valido!");
         return false;
       }
     }*/



    // buscar por dni 17/03/2024
    $("#buscar_dni_perfil").click(function() {
      var vdni = $("#dni").val();
      $.ajax({
        url: "buscar_dni.php",
        type: "POST",
        data: {
          dni: vdni
        },
        success: function(response) {
          var jsonData = JSON.parse(response);
          console.log(jsonData);
          //alert(jsonData.estado);
          if (jsonData.estado == "ok") {
            $("#resultadoBusqueda").html("<h6 class='text-muted mb-0'> Persona : " + jsonData.nombre + "</h6>");
            $("#id_persona").val(jsonData.id_persona);
          } else {
            $("#resultadoBusqueda").html(jsonData.mensaje);
          }

        },
        failure: function(data) {
          alert(response);
        },
        error: function(data) {
          alert(response);
        }
      });
    });
  }); //fin jquery   
</script>
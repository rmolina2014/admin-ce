<?php
session_start();
include("../cabecera.php");
include("../menu.php");
?>
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>

    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Panel de Control</h3>
                    <!--p class="text-subtitle text-muted">The default layout.</p-->
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">

                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><?php echo "Usuario : " . $_SESSION['sesion_usuario']; ?></li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <!--div class="card-header">
                    <h4 class="card-title"> Demo</h4>
                </div>
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, commodi? Ullam quaerat similique iusto
                    temporibus, vero aliquam praesentium, odit deserunt eaque nihil saepe hic deleniti? Placeat delectus
                    quibusdam ratione ullam!
                </div--->
            </div>
        </section>
    </div>



    <?php
    include("../pie.php");
    ?>
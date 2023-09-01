<!-- ROW MAIN CONTENT  -->

<div class="row full-height ml-2 mt-4">
    <!-- LEFT COLUMN -->

    <div class="col-2 mt-3 blurPanelOnEdit" id="leftPanel">
        <div class="card card-secondary card-outline panel-height" id='panel-left'>
            <!-- Header -->
            <div class="card-header car-header-double d-flex align-items-center" id="cardLeftHeader">
                <div class="row justify-content-between w-100">
                    <div>
                        <h5 class="mt-2 ml-2"><b>CLIENTES</b></h5>
                    </div>

                </div>
            </div>

            <!-- SEARCH BOX -->
            <div class="container w-100 m-0 p-0 ">
                <div class="input-group mb-0 p-1">
                    <input type="text" id="searchBox" class="form-control form-control search-box-input border-primary" placeholder="Buscar...">
                    <div class="input-group-append search-box-icon">
                        <button class="btn btn-outline-primary" type="button" id="clearButton">
                            <span class="material-icons">close</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="card-body h-100 m-0 p-0 overflow-auto">                
                <!-- LIST OF COMPANIES -->
                <div id="ulContacts" class="container m-0 p-0 ">
                    <ul class="list-group w-100 m-0 p-0"  id="companyList">
                        <?php
                            $terceros = ControllerTerceros::ctrGetTerceros();
                           
                            foreach ($terceros as $key => $value) {
                                echo '<li id="'.$value["id"].'" class="list-group-item w-100 m-0 p-2 pl-3 on-hover pointer-cursor propuestas">'.$value["main_nombre"]." ".$value["main_apellidos"].'</li>';
                            }
                        ?>
                            
                    </ul>     
                </div>

            </div>
        </div>
    </div>

    <!-- MAIN COLUMN -->      

    <div class="col mt-3 mr-3 w-100">
        <div class="card card-secondary card-outline panel-height" id='panel-content'>
            <!-- Main Header -->
            <div class="card-header car-header-double" id="cardMainHeader">
                <div class="row d-flex justify-content-between">

                    <div class="standard-form">
                        <div class="form-field">
                            <input class="form-input" type="month" id="dateGantt">
                            <label class="label" for="dateGantt"></label>
                        </div>
                    </div>
                        
                
    
                    <div class="mt-2">
                        <h5 id="empresaName">    
                            <b class="text-uppercase" id="mainHeaderName">Contratos</b>
                        </h5>
                    </div>
                    
                
                    <div class="mt-2 mr-5">
                        <button class="btn bg-primary btn-sm" data-toggle='modal' data-target='#modalAddComment'>Comentario</button>
                    </div>
                    
                </div>
        
            </div>

            <!-- Main Body -->
          
            <div class="card-body">
                
                <canvas id="myChart"></canvas>

            </div>
         
        
        </div>
        
    </div>
</div>

<!-- JavaSrcipt Load -->

<script src="frontoffice/propuestas/resources/js/propuestas_planificacion.js"></script>

<!-- MODALS -->
<?php
    // Add new comment
    require_once "modals/propuestas_modal_add_comment.php";
    
?>
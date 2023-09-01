<div class="tab-pane fade" id="custom-tabs-four-contrato" role="tabpanel" aria-labelledby="custom-tabs-four-contrato-tab">
    
    <div class="row">
        <div class="col-sm-6">
            <p class="lead mt-2 mb-2 pl-2 bg-secondary text-uppercase" style="opacity:0.8;">Datos del contrato</p>

            <form class="standard-form">

                <div class="row pt-2">
    
                    <div class="form-field col-sm-6">
                        <input type="date" class="form-input" id="formInicio" name="formInicio" required="required">
                        <label for="formInicio" class="label">Fecha inicio:</label>
                        
                    </div>
                    <div class="form-field col-sm-6">
                        <input type="date" class="form-input" id="FormInicioReal" name="FormInicioReal" required="required">
                        <label for="FormInicioReal" class="label">Fecha real inicio:</label>
                        
                    </div>
                
                    <div class="form-field col-sm-6">
                        <input type="date" class="form-input" id="FormFin" name="FormFin" required="required">
                        <label for="FormFin" class="label">Fecha fin:</label>
                        
                    </div>
                    <div class="form-field col-sm-6">
                        <input type="date" class="form-input" id="FormFinReal" name="FormFinReal" required="required">
                        <label for="FormFinReal" class="label">Fecha real fin:</label>
                        
                    </div>
                    <div class="form-field col-sm-6">
                        <input type="text" class="form-input" id="FormDuracion" name="FormDuracion" required="required">
                        <label for="formDuracion" class="label">Duración:</label>
                        
                    </div>
                  
                    <div class="form-field col-sm-6">
                        <input type="text" class="form-input" id="formDuracionReal" name="formDuracionReal" required="required">
                        <label for="formDuracionReal" class="label">Duración real:</label>
                        
                    </div>
    
                   
                  
                </div>
                
                <div class="d-inline-flex">
                    <div class="icheck-primary">
                        <input type="checkbox" id="someCheckboxId-1" name="someCheckboxId-1" checked disabled>
                        <label for="someCheckboxId-1">Certificado Ejecución</label>
                        
                    </div>
                    <div class=" ml-4 icheck-primary">
                        <input type="checkbox" id="someCheckboxId-2" name="someCheckboxId-2">
                        <label for="someCheckboxId-2">Alta a terceros</label>    
                    </div>
                </div>

            </form>
            
        </div>

        <div class="col-sm-6">
            <p class="lead mt-2 mb-2 pl-2 bg-secondary text-uppercase" style="opacity:0.8;">Archivos del contrato</p>
            <table class="table table-sm table-hover dt-responsive w-100">
                <thead class="thead-light">
                    <tr>
                        <th>Etiqueta</th>
                        <th>Archivo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Propuesta enviada</td>
                        <td>propuesta.enviada.pdf</td>
                    </tr>
                    <tr>
                        <td>Propuesta firmada</td>
                        <td>propuesta.firmada.pdf</td>
                    </tr>
                    <tr>
                        <td>Contrato enviado</td>
                        <td>contrato.enviado.pdf</td>
                    </tr>
                    <tr>
                        <td>Contrado firmado</td>
                        <td>contrato.firmado.pdf</td>
                    </tr>

                </tbody>
            </table>

        </div>
        
    </div>
    
</div>
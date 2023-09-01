window.addEventListener("DOMContentLoaded", (event) => {

    var grupo = JSON.stringify([10,11,12,13]);
    var nivel = 3;
    var idEjercicio = sessionStorage.getItem("idEjercicio");
    var fondosPropios = 0;

    var data = new FormData;
    data.append('ejercicio', idEjercicio);
    data.append('grupo', grupo);
    data.append('nivel', nivel);

    $.ajax({
        url:'frontoffice/cierre/ajax/CierreControlesGruposAjax.php',
        method: 'POST',
        data:data,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(answer) {

            waitForElement('fondosPropios').then(container => {
        
                const table = document.createElement('table');
                const thead = document.createElement('thead');
                const tbody = document.createElement('tbody');
                const tfoot = document.createElement('tfoot');
                const headerRow = document.createElement('tr');
                const footerRow = document.createElement('tr');
            
                table.classList.add('table', 'table-sm');
            
                // Cabecera
                ['Cuenta', 'Descripcion', 'Saldo'].forEach((text, index) => {
                    const th = document.createElement('th');
                    th.textContent = text;
                    if (index === 2) th.classList.add('text-center');
                    headerRow.appendChild(th);
                });
                thead.appendChild(headerRow);
            
                
                const formatter = new Intl.NumberFormat('es-ES', {
                    style: 'currency',
                    currency: 'EUR',
                    minimumFractionDigits: 2
                })
            
                // Filas
                const answerValues = Object.values(answer);
                for (let item of answerValues) {
                    const tr = document.createElement('tr');
            
                    tr.innerHTML = `
                        <td>${item.plan_detalle_cuenta}</td>
                        <td>${item.plan_detalle_descripcion}</td>
                        <td class="text-right">${formatter.format(item.total_plan_detalle_saldo * -1)}</td>
                    `;
            
                    fondosPropios += parseFloat(item.total_plan_detalle_saldo);
                    tbody.appendChild(tr);
                }
            
                // Pie
                const tdLabel = document.createElement('td');
                tdLabel.setAttribute('colspan', '2');
                tdLabel.innerHTML = '<strong>Total Fondos Propios:</strong>';
                footerRow.appendChild(tdLabel);
            
                const tdData = document.createElement('td');
                tdData.classList.add('text-right');
                tdData.textContent = formatter.format(fondosPropios*-1);
                footerRow.append(tdData);
            
                tfoot.appendChild(footerRow);
            
                table.appendChild(thead);
                table.appendChild(tbody);
                table.appendChild(tfoot);
            
                container.append(table);

                var capitalSocial = 0;

                var grupo = JSON.stringify([100]);
                var nivel = 3;
                var idEjercicio = sessionStorage.getItem("idEjercicio");
                
                var data = new FormData;
                data.append('ejercicio', idEjercicio);
                data.append('grupo', grupo);
                data.append('nivel', nivel);

                $.ajax({
                    url:'frontoffice/cierre/ajax/CierreControlesGruposAjax.php',
                    method: 'POST',
                    data:data,
                    cache:false,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(answer) {
                        capitalSocial = answer[100].total_plan_detalle_saldo*-1/2;
                        fondosPropios = fondosPropios*-1;

                        waitForElement('causaDisolucion').then(container => {

                            var div = document.createElement('div');
                            div.classList.add('row', 'mt-5', 'mx-3', 'w-100');
                           
                            if(fondosPropios<capitalSocial){
                                var callout = document.createElement('div');
                                callout.classList.add('callout', 'w-100', 'mr-5');
                                var p = document.createElement('p');
                                p.innerHTML = 'La empresa tiene los fondos propios por debajo de la mitad del capital social. <br>Por lo tanto <span class="text-danger"><b>SE ENCUENTRA EN CAUSA DE DISOLUCION</b></span>';
                                callout.append(p);
                                div.append(callout);
                            
                            }else{
                                var callout = document.createElement('div');
                                callout.classList.add('callout', 'w-100', 'mr-5');
                                var p = document.createElement('p');
                                p.innerHTML = 'La empresa tiene los fondos propios por encima de la mitad del capital social. <br>Por lo tanto <span class="text-success"><b>NO SE ENCUENTRA EN CAUSA DE DISOLUCION</b></span>';
                                callout.append(p);
                                div.append(callout);
                            }

                            container.append(div);

                        });
                    }
                });

            }).catch(error => {
                console.error(error);
            });

            

        }
    });

    

    



    function waitForElement(elementId, timeout = 3000) {
        return new Promise((resolve, reject) => {
            let counter = 0;
            const interval = setInterval(() => {
                const el = document.getElementById(elementId);
                counter += 100; // assuming we're checking every 100ms
    
                if (el) {
                    clearInterval(interval);
                    resolve(el);
                } else if (counter > timeout) {
                    clearInterval(interval);
                    reject(new Error(`Element with ID ${elementId} not found within ${timeout}ms`));
                }
            }, 100);
        });
    }
    


});
window.addEventListener("DOMContentLoaded", (event) => {
  //DATA
  const data = {
    labels: ['Activos', 'Fondo Maniobra', 'Pasivos'],
    datasets: [
      {
        label: 'AC',
        data: [68, 0, 0],
        backgroundColor: 'rgba(128, 128, 128, 1)',
        padding:{
          right: 20,
        }
      },
      {
        label: 'ANC',
        data: [42, 0, 0],
        backgroundColor: 'rgba(128, 128, 128, 0.6)',
      },
      {
        label: 'Fondo Maniobra',
        data: [0,10,0],
        backgroundColor: 'rgba(40, 167, 69, 1)',
        
        datalabels: {
          display: false  //hidden labels
        }
      },
      {
        label: 'PC',
        data: [0, 0, 33],
        backgroundColor: 'rgba(255, 107, 36, 1)',
        datalabels: {
        },
      },
      {
        label: 'PNC',
        data: [0, 0, 33],
        backgroundColor: 'rgba(255, 107, 36, 0.8)',
      },
      {
        label: 'PN',
        data: [0, 0, 34],
        backgroundColor: 'rgba(255, 107, 36, 0.5)',
      }
    ],

    
  };

  /* Proccessed Data */
  const processedData = {
    labels: data.labels,
    datasets: data.datasets
  };

  /* fixes height when chart has positive and negative values */
  const patrimonioNeto = data.datasets[5].data[2];

  const chartHeightPositive = 350;
  const chartHeightNegative = 700;

  let chartHeight = patrimonioNeto >= 0 ? chartHeightPositive : chartHeightNegative;

  const config = {
    type: 'bar',
    data: processedData,
    options: {
      maintainAspectRatio: false,
      scales: {
        x: {
          stacked: true,
          display: false,
      
        },
        y: {
          stacked: true,
          display: false,
          min: (ctx) => {
            // Calcula el valor mínimo basado en el patrimonio neto
            if (ctx.chart.data.datasets[5].data[2] >= 0) {
              return 0;
            }
            return -100;
          },
          max: 100,
        },

      },

      plugins:{
        tooltip:{
          enabled: false,
        },

        legend: {
           display: false,
         },
        
        /* Text inside of bar */ 
        datalabels: {
    
          color: 'white',
          font:{
            weight: 'bold',
            size: 20,      
          },
          anchor:'start',
          align: 'top',
          formatter: function(value, context) {
            /* const datasetArray = []; */
            var labelName = '';
            var valor = '';
            var lines = '';

            if(value !== 0){
              labelName = context.dataset.label;
              lines = labelName;
              valor = value +'%';

            }
           
            return `${lines} ${valor}`;
           
          },
        
        },

      },
      /* delete border of bars */
      elements: {
        bar: {
          clip: false,
          borderWidth: 1, // Ancho del borde para todas las barras
          borderColor: (context) => {

            if (context.dataset.label === 'Fondo Maniobra') {

              return 'rgba(0, 0, 0, 0)'; // Establece el color transparente para ocultar las líneas
            }

            /* return context.dataset.backgroundColor; // Color del borde para otras barras */
            return 'rgba(0, 0, 0, 0)';
          },
         
        },  
      },  
    },

    //Plugins
    plugins: [ChartDataLabels]
  };
  const balanceChart = new Chart(
    document.getElementById('balanceChart'),
    config
  );

  // Adjusting bar thickness and bar percentage
  balanceChart.options.datasets.bar.barThickness = 160; // Adjust the value as needed
  balanceChart.data.datasets[2].barThickness = 35; //Adjust the value fondo maniobra
  balanceChart.update(); // Update the chart with the new configuration
  balanceChart.canvas.parentNode.style.height = `${chartHeight}px`; 
});
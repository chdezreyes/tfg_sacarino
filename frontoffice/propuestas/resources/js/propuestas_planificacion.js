window.addEventListener("DOMContentLoaded", (event) => {
  //INITIAL DATE

  //Current month
  var currentDate = new Date();

  var minDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1, currentDate.getDay() + 1);
  //Date 2 months more
  var maxDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 2);
  
  // Format date "yyyy-mm-dd"
  var min = minDate.toISOString().substr(0, 10);
  var max = maxDate.toISOString().substr(0, 10);

  // setup

  const dataContract =  [
      {Plazo: ['2023-08-07', '2023-10-10'], Contrato: 'Elaboración de procedimientos',  Entidad: 'Carlos Hernández Reyes', },
      {Plazo: ['2023-08-07', '2023-10-10'], Contrato: '01 Servicio de adaptación a LOPD',  Entidad: 'Ayuntamiento de Wisconsin' },
      {Plazo: ['2023-08-08', '2023-12-15'], Contrato: 'Servicio de adaptación a LOPD',  Entidad: 'Carlos Hernández Reyes' },  
      {Plazo: ['2023-08-13', '2023-12-02'], Contrato: 'As. en mat- de Contratación',  Entidad: 'Carlos Hernández Reyes' },  
      {Plazo: ['2023-09-14', '2023-12-09'], Contrato: 'Consultoría Contrato Asistencia técnica en mat. de contratación', Entidad: 'Carlos Hernández Reyes'},  
      {Plazo: ['2023-10-07', '2023-12-11'], Contrato: 'Elaboración de procedimientos 2', Entidad: 'Gextiona APV Consultores SL'},  
      {Plazo: ['2023-10-08', '2023-12-21'], Contrato: 'Servicio de adaptación a LOPD 3', Entidad: 'Gextiona APV Consultores SL'},   
      {Plazo: ['2023-08-07', '2023-10-10'], Contrato: 'Elaboración de procedimientos 3',  Entidad: 'Carlos Hernández Reyes' },
      {Plazo: ['2023-08-09', '2023-10-10'], Contrato: '01 Servicio de adaptación a LOPD 3',  Entidad: 'Ayuntamiento de Wisconsin' },
      {Plazo: ['2023-08-16', '2023-12-15'], Contrato: 'Servicio de adaptación a LOPD 2',  Entidad: 'Carlos Hernández Reyes' },  
      {Plazo: ['2023-08-17', '2023-12-02'], Contrato: 'As. en mat- de Contratación 2',  Entidad: 'Carlos Hernández Reyes' },  
      {Plazo: ['2023-09-18', '2023-12-09'], Contrato: 'Consultoría Contrato Asistencia técnica en mat. de contratación 3', Entidad: 'Carlos Hernández Reyes'},  
      {Plazo: ['2023-11-02', '2024-01-26'], Contrato: 'Consultoría y Asistencia técnica en mat. de contratación 5', Entidad: 'Gextiona APV Consultores SL',
      }];
 
   const data = {
    datasets: [{
      data: dataContract,
      
      backgroundColor: [
        'rgba(108, 117, 125, 0.5)', 
      ],

      borderSkipped: false,
      barPercentage: 0.5,
      
    }]
  };

  // Change Size bar 

  const dataSize = data.datasets[0].data.length;
 
  if(data.datasets[0].data.length === 1){

    data.datasets[0].barPercentage = 0.1;
  
  }else if(data.datasets[0].data.length === 2){

    data.datasets[0].barPercentage = 0.2;

  }else if(data.datasets[0].data.length <= 4) {

    data.datasets[0].barPercentage = 0.3;

  }else{
    data.datasets[0].barPercentage = 0.6;
  }

  // TodayLine plugin block

  const todayLine = {
    id: 'todayLine',
    afterDatasetsDraw(chart, args, pluginOptions){
      const { ctx, data, chartArea: { top, bottom, left, right }, scales: { x, y} } = chart;

      ctx.save();

      ctx.beginPath();
      ctx.lineWidth = 3;
      ctx.strokeStyle = '#ff6b24';
      ctx.setLineDash([6, 6]);
      ctx.moveTo(x.getPixelForValue(new Date()), top);
      ctx.lineTo(x.getPixelForValue(new Date()), bottom);
      ctx.stroke();
      ctx.restore(); 

      ctx.setLineDash([ ]);

      ctx.beginPath();
      ctx.lineWidth = 1;
      ctx.strokeStyle = '#ff6b24';
      ctx.fillStyle = '#ff6b24';
      ctx.moveTo(x.getPixelForValue(new Date()), top + 5);
      ctx.lineTo(x.getPixelForValue(new Date()) - 5, top - 5);
      ctx.lineTo(x.getPixelForValue(new Date()) + 5, top - 5);
      ctx.closePath();
      ctx.stroke();
      ctx.fill();
      ctx.restore();  

      ctx.font = 'bold 12 px sans-serif';
      ctx.fillStyle = '#ff6b24';
      ctx.textAlign = 'center';
      ctx.fillText('Hoy', x.getPixelForValue(new Date()), bottom + 12); 
      
    }
  }

   // weekend plugin block

  const weekend = {
    id: 'weekend',
    beforeDatasetsDraw(chart, args, pluginOptions){
      const { ctx, data, chartArea: { top, bottom, left, right, width, height }, scales: { x, y} } = chart;

      ctx.save();

      x.ticks.forEach((tick, index) => {
        const day = new Date (tick.value).getDay();

        if(day === 6 || day === 0){
          ctx.fillStyle = 'rgba(0, 0, 0, 0.02)';
          ctx.fillRect(x.getPixelForValue(tick.value), top, x.getPixelForValue(new Date(tick.value).setHours(24)) - x.getPixelForValue(tick.value), height);
        }

      });


    }
    
  }
  
  // config 
  const config = {
    type: 'bar',
    data,
    options: {
      locale: 'es',
      layout:{
        padding:{
          bottom: 20,
        },
      },
      parsing: {
        xAxisKey: 'Plazo',
        yAxisKey: 'Contrato',
      },
      maintainAspectRatio: false,
       indexAxis: 'y', 
      scales: {
        // DATE IN DAYS
        x: {
          position: 'top', 
          type: 'time',
          time: {
            unit: 'day',
          }, 

          ticks:{
            callback: (value, index, ticks) => {
              const date = new Date (value);
              config.log
              console.log(date);
              return new Intl.DateTimeFormat('es-ES', {
                
                /* weekday: 'long', */
                /*  year: 'numeric',
                month: 'long',  */
                day: 'numeric'
                
              }).format(date)

            },

            font: {
              size: 10,
            }, 

          }, 
          
          min: min, // current month and year 
          max: max, // one year more

          grid:{
            drawOnChartArea: false,
          },

          afterFit: ((ctx) => {
            ctx.height += 10;
          }), 

        },
        // DATE IN MONTHS
        x2: {
          position: 'top',
          type: 'time',
          time: {
            unit: 'month',
            }, 

            ticks:{
              font: {
                size: 12,
                weight: 'bold',
              },
              callback: (value, index, ticks) => {

                const date = new Date (value);

                return new Intl.DateTimeFormat('es-ES', {
                  
                  /* weekday: 'long', */
                  year: 'numeric',
                  month: 'long',  
                  /* day: 'numeric' */  

                }).format(date)

              },

            }, 
          
          
          min: min, // current month and year 
          max: max, // one year more
  

        },

        y: {
          display: false, 
        }
        
      },

      plugins: {

        legend: {
          display: false,
        },
        //INFORMATION ABOUT THE CONTRACT
        tooltip:{
          padding: 15,
          
          callbacks: {
            label: (ctx) => {
              return '';
            },

            title: (ctx) => {
              //DEADLINE
              const startDate = new Date(ctx[0].raw.Plazo[0]);
              const endDate =  new Date(ctx[0].raw.Plazo[1]);
              //DURATION
              const currentDate = new Date();
              const differenceInMilliseconds = endDate - startDate;
              const differenceInDays = Math.floor(differenceInMilliseconds / (1000 * 60 * 60 * 24));
              const week = (Math.floor(differenceInDays/ 7));
              //STARTED
              const remaining = endDate - currentDate;
              const remainingDays = (Math.floor(remaining / (1000 * 60 * 60 * 24)));
              const weekDays = (Math.floor(remainingDays / 7));

              const formattedStartedDate = startDate.toLocaleString([], {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
              });
              const formattedEndDate = endDate.toLocaleString([], {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
              });

              return ['Contrato: '+ ctx[0].raw.Contrato,`Entidad: `+ ctx[0].raw.Entidad,`Plazo: ${formattedStartedDate} - ${formattedEndDate}`, 'Duración: '+ `${week}`+' semanas '+`(${differenceInDays} días)`,  'Faltan: '+ `${weekDays}`+' semanas '+`(${remainingDays} días)`]; 
          
            }
            
            
          }
        },

        //NAME OF CONTRACT
        datalabels: {

          color: 'black',
          font:{
            weight: 'bold',
          },
          clamp: 'true',
          display: 'true',
          clip: true,
          

          formatter: function(value, context) {

            const typeContract = context.dataset.data[context.dataIndex].Contrato;
            const nameContract = context.dataset.data[context.dataIndex].Entidad;

            return `${typeContract} - ${nameContract}`;
          },
        
        } 
      }
    },

    //Plugins
  
    plugins: [todayLine, ChartDataLabels, weekend]

  };

  // render init block

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );

  // filter date
  $('#dateGantt').change(function(){
  
    const date = $('#dateGantt').val();
  
    const year = date.substring(0,4);
    const month = date.substring(5,7);

    const lastDay = (y, m) => new Date(y, m, 0).getDate(); //get last day of month

    const startDate = `${year}-${month}-01`; //MIN DATE

    //MAX DATE 
    let newMonth = parseInt(month) + 1;
    let newYear = year;

    if (newMonth > 12) {
        newMonth -= 12;
        newYear = parseInt(year) + 1;
    }

    const newLastDay = lastDay(newYear, newMonth);

    const endDate = `${newYear}-${String(newMonth).padStart(2, '0')}-${newLastDay}`;
    
    //X
    myChart.config.options.scales.x.min = startDate;
    myChart.config.options.scales.x.max = endDate;

    //X2
    myChart.config.options.scales.x2.min = startDate;
    myChart.config.options.scales.x2.max = endDate;
    
    myChart.update(); 

  });

  //Customer Filter


});
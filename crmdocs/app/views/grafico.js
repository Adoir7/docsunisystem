console.log(grafico);

let primeiroGrafico = document.getElementById('primeiroGrafico').getContext('2d');

let segundoGrafico = document.getElementById('segundoGrafico').getContext('2d');

                       
    let chartclientes = new Chart(primeiroGrafico, {
    type: 'line',
    data: {
        labels: ['2000', '2001', '2002', '2003', '2004', '2005'],
        datasets: [{
                label: 'Crecimento Populacional',
                data: [173448346, 175885229, 178276128, 180619108, 182911487, 185150806],
                backgroundColor: "rgba(255, 34, 0, 0.3)",
                borderColor: "#0000ff"
            },
            {
                label: 'Exemplo de Gráfico Comparativo',
                data: [173448346, 185150806, 175885229, 182911487, 178276128, 180619108],
                backgroundColor: "rgba(0, 255, 0, 0.3)",
                borderColor: "#002200"
            }
        ]
    }
});


                       
    let chartvisitanalista = new Chart(segundoGrafico, {
    type: 'bar',
    data: {
        labels: ['2000', '2001', '2002', '2003', '2004', '2005'],
        datasets: [{
                label: 'Crecimento Populacional',
                data: [173448346, 175885229, 178276128, 180619108, 182911487, 185150806],
                backgroundColor: "rgba(255, 34, 0, 0.3)",
                borderColor: "#0000ff"
            },
            {
                label: 'Exemplo de Gráfico Comparativo',
                data: [173448346, 185150806, 175885229, 182911487, 178276128, 180619108],
                backgroundColor: "rgba(0, 255, 0, 0.3)",
                borderColor: "#002200"
            }
        ]
    }
});


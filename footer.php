 <!-- ======= Footer ======= -->
 <footer id="footer" class="footer">
     <div class="copyright">
         &copy; Copyright. Todos os direitos reservados.
     </div>
     <div class="credits">
         <!-- All the links in the footer should remain intact. -->
         <!-- You can delete the links only if you purchased the pro version. -->
         <!-- Licensing information: https://bootstrapmade.com/license/ -->
         <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
     </div>
 </footer><!-- End Footer -->

 <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
     <i class="bi bi-arrow-up-short"></i>
 </a>

 <!-- Vendor JS Files -->
 <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
 <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="assets/vendor/chart.js/chart.min.js"></script>
 <script src="assets/vendor/echarts/echarts.min.js"></script>
 <script src="assets/vendor/quill/quill.min.js"></script>
 <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
 <script src="assets/vendor/tinymce/tinymce.min.js"></script>
 <script src="assets/vendor/php-email-form/validate.js"></script>

 <!-- Template Main JS File -->
 <script src="assets/js/main.js"></script>

 <?php

    /* Obter total de desenvolvedores */
    $sql = "SELECT count(*) as total FROM login WHERE nivel = 'dev';";
    $resultado = mysqli_query($conn, $sql);
    // $dados = mysqli_fetch_all($resultado);
    $devs = mysqli_fetch_object($resultado);
    $totalDevs = $devs->total;

    /* Obter total de projetos cadastrados */
    $sql = "SELECT count(*) as total FROM projeto WHERE 1";
    $resultado = mysqli_query($conn, $sql);
    $projetos = mysqli_fetch_object($resultado);
    $totalProjetos = $projetos->total;

    /* Dados de faturamento no útimos 12 meses */
    $meses_abreviado = array(
        1 => 'Jan',
        'Fev',
        'Mar',
        'Abr',
        'Mai',
        'Jun',
        'Jul',
        'Ago',
        'Set',
        'Out',
        'Nov',
        'Dez'
    );
    $dataFaturamento = [
        'meses' => [],
        'valores' => [],
    ];

    for ($i = 0; $i < 12; $i++) {

        $mesCorrente = date('n', strtotime(date('Y-m-15') . " - $i months"));
        $anoCorrente = date('Y', strtotime(date('Y-m-15') . " - $i months"));

        array_unshift($dataFaturamento['meses'], $meses_abreviado[$mesCorrente] . '/' . $anoCorrente);

        $sql = "SELECT SUM(valor) as despesas_empresa FROM despesa WHERE data <= '" . date('Y-m-t') . "';";
        $resultado = mysqli_query($conn, $sql);
        $despesas = mysqli_fetch_object($resultado);

        $sql = "SELECT sum(valor_parcela) as lucro_mes FROM lucro_empresa WHERE YEAR(data_parcela) <= " . date('Y') . " AND MONTH(data_parcela) = $mesCorrente;";
        $resultado = mysqli_query($conn, $sql);
        $projetos = mysqli_fetch_object($resultado);
        array_unshift($dataFaturamento['valores'], ($projetos->lucro_mes == '' ? 0 : $projetos->lucro_mes - $total_despesas_empresa));
    }
?>

 <!-- Gráfico devs/demandas -->
 <script>
document.addEventListener("DOMContentLoaded", () => {
    echarts.init(document.querySelector("#desenvolver-demanda")).setOption({
        tooltip: {
            trigger: 'item'
        },
        legend: {
            top: '5%',
            left: 'center'
        },
        series: [{
            // name: 'Access From',
            type: 'pie',
            radius: ['40%', '70%'],
            avoidLabelOverlap: false,
            label: {
                show: false,
                position: 'center'
            },
            emphasis: {
                label: {
                    show: true,
                    fontSize: '18',
                    fontWeight: 'bold'
                }
            },
            labelLine: {
                show: false
            },
            data: [{
                    value: <?= $totalDevs ?>,
                    name: 'Desenvolvedores'
                },
                {
                    value: <?= $totalProjetos ?>,
                    name: 'Demandas'
                }
            ]
        }]
    });
});
 </script>

 <!-- Gráfico faturamento -->
 <script>
var options = {
    series: [{
        data: JSON.parse(`<?= json_encode($dataFaturamento['valores']) ?>`),
    }],
    chart: {
        height: 350,
        type: 'bar',
        events: {
            click: function(chart, w, e) {
                // console.log(chart, w, e)
            }
        }
    },
    // colors: colors,
    plotOptions: {
        bar: {
            columnWidth: '45%',
            distributed: true,
        }
    },
    dataLabels: {
        enabled: false
    },
    legend: {
        show: false
    },
    xaxis: {
        categories: JSON.parse(`<?= json_encode($dataFaturamento['meses']) ?>`),
        labels: {
            style: {
                // colors: colors,
                fontSize: '12px'
            }
        }
    },
    tooltip: {
        y: {
            formatter: function(val) {
                return val.toLocaleString('pt-br', {
                    style: 'currency',
                    currency: 'BRL'
                });

            },
            title: {
                formatter: function(seriesName) {
                    return 'Lucro:'
                }
            }
        }
    }
};

var chart = new ApexCharts(document.querySelector("#chart-faturamento-meses"), options);
chart.render();

const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
 </script>

<style type="text/css">
  
:after, :before {
    box-sizing: border-box;
}

a {
    color: #337ab7;
    text-decoration: none;
}
i{
  margin-bottom:4px;
}

.btn {
    display: inline-block;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}


.btn-app {
    color: white;
    box-shadow: none;
    border-radius: 3px;
    position: relative;
    padding: 10px 15px;
    margin: 0;
    min-width: 60px;
    max-width: 80px;
    text-align: center;
    border: 1px solid #ddd;
    background-color: #f4f4f4;
    font-size: 12px;
    transition: all .2s;
    background-color: steelblue !important;
}

.btn-app > .fa, .btn-app > .glyphicon, .btn-app > .ion {
    font-size: 30px;
    display: block;
}

.btn-app:hover {
    border-color: #aaa;
    transform: scale(1.1);
}

.pdf {
  background-color: #dc2f2f !important;

}

.excel {
    background-color: #3ca23c !important;
}

.csv {
    background-color: #e86c3a !important;
}

.imprimir {
    background-color: #8766b1 !important;
}

/*
Esto es opcional pero sirve para que todos los botones de exportacion se distribuyan de manera equitativa usando flexbox

.flexcontent {
    display: flex;
    justify-content: space-around;
}
*/

.selectTable{
  height:auto;
  float:right;
}

div.dataTables_wrapper div.dataTables_filter {
    /*text-align: left;*/
    margin-top: 0px;
}

.btn-secondary {
    color: #fff;
    background-color: #4682b4;
    border-color: #4682b4;
}
.btn-secondary:hover {
    color: #fff;
    background-color: #315f86;
    border-color: #545b62;
}



.titulo-tabla{
  color:#606263;
  text-align:center;
  margin-top:15px;
  margin-bottom:15px;
  font-weight:bold;
}

.table-responsive{ padding: 0px; }




.inline{
  display:inline-block;
  padding:0;
}

</style>

<script type="text/javascript">
  var idioma=

            {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ Payroll Records",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "No Records Founds",
                "sInfo":           "Showing _START_ to _END_ From Total _TOTAL_ Payroll Records",
                "sInfoEmpty":      "Showing 0 to 0 de un total de 0 Payroll Records",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ Payroll Records)",
                "sInfoPostFix":    "",
                "sSearch":         "Search:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Ãšltimo",
                    "sNext":     "Next",
                    "sPrevious": "Previous"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copyTitle": 'Informacion copiada',
                    "copyKeys": 'Use your keyboard or menu to select the copy command',
                    "copySuccess": {
                        "_": '%d filas copiadas al portapapeles',
                        "1": '1 fila copiada al portapapeles'
                    },

                    "pageLength": {
                    "_": "%d",
                    "-1": "Show All"
                    }
                }
            };

$(document).ready(function() {
  
  
  var table = $('#ejemplo').DataTable( {
    
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "language": idioma,
    //"lengthMenu": [[5,10,20, -1],[5,10,50,"Show All"]],
    "lengthMenu": [[-1],["Show All"]],
    dom: 'Bfrt<"col-md-6 inline"i> <"col-md-6 inline"p>',
    
    
    buttons: {
          dom: {
            container:{
              tag:'div',
              className:'flexcontent'
            },
            buttonLiner: {
              tag: null
            }
          },
          
          
          
          
          buttons: [


                    {
                        extend:    'copyHtml5',
                        text:      '<i class="fa fa-clipboard"></i>Copy',
                        title:'Payroll Master Sheet Copy',
                        titleAttr: 'Copiar',
                        className: 'btn btn-app export barras',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19 ]
                        }
                    },

                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="fa fa-file-pdf-o"></i>PDF',
                        title:'Payroll Master Sheet pdf',
                        titleAttr: 'PDF',
                        className: 'btn btn-app export pdf',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19 ]
                        },
                        customize:function(doc) {

                            doc.styles.title = {
                                color: '#4c8aa0',
                                fontSize: '20',
                                alignment: 'center'
                            }
                            doc.styles['td:nth-child(2)'] = { 
                                width: '100px',
                                'max-width': '100px'
                            },
                            doc.styles.tableHeader = {
                                fillColor:'#4c8aa0',
                                color:'white',
                                alignment:'center'
                            },
                            doc.content[1].margin = [ 0, 0, 0, 0 ]

                        }

                    },

                    {
                        extend:    'excelHtml5',
                        text:      '<i class="fa fa-file-excel-o"></i>Excel',
                        title:'Payroll Master Sheet excel',
                        titleAttr: 'Excel',
                        className: 'btn btn-app export excel',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19 ]
                        },
                    },
                    {
                        extend:    'csvHtml5',
                        text:      '<i class="fa fa-file-text-o"></i>CSV',
                        title:'Payroll Master Sheet CSV',
                        titleAttr: 'CSV',
                        className: 'btn btn-app export csv',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19 ]
                        }
                    },
                    {
                        extend:    'print',
                        text:      '<i class="fa fa-print"></i>Print',
                        title:'Payroll Master Sheet impresion',
                        titleAttr: 'Print',
                        className: 'btn btn-app export imprimir',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19 ]
                        }
                    },
                    {
                        extend:    'pageLength',
                        titleAttr: 'Registros a mostrar',
                        className: 'selectTable'
                    }
                ]          
        }

    });

} );

</script>


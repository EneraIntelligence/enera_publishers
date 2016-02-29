var graficas;
graficas = function () {

    this.bar = function bar() {

    };
    //grafica de pastel para los sistemas operativos
    this.so = function so(sistemas) {
        console.log(sistemas);
        var column = [];
        for (var k in sistemas) {
            //console.log(k);
            column.push([ k,sistemas[k] ]);
        }
        //console.log(column);

        var chart4 = c3.generate({
            bindto : '#so',
            data: {
                columns: column,
                type: 'pie'
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c', '#98df8a', '#d62728', '#ff9896', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5']
            },
            axis: {
                y: {
                    padding: {top: 200, bottom: 0}
                },
                y2: {
                    padding: {top: 100, bottom: 100},
                    show: true
                }
            }
        });
        return chart4;
    };
//------------------------grafica de barra para los años y edades
    this.genderAge = function genderAge(men, women) {
        // Data gathered from http://populationpyramid.net/germany/2015/
        $(function () {
            // Age categories
            var categories = ['0-17', '18-20', '21-30', '31-40', '41-50', '51-60',
                '61-70', '71-80', '81-90', '91-100 +'];
            //var categories = [''];
            var elemento;
            $('#genderAge').highcharts({
                chart: {
                    type: 'bar'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ' DISTRIBUCION POR EDADES<a href="http://populationpyramid.net/germany/2015/"></a>'
                },
                xAxis: [{
                    categories: ['', '', '', '', '', '', '', '', '', ''],//se le pasa el arreglo de categorias
                    reversed: false,// para decirle el orden en que van a parecer las categorias
                    labels: {
                        step: 1
                    }
                }, { // mirror axis on right side
                    opposite: true, //para que en la grafica se muestren las barras encontradas o no en la misma direccion
                    reversed: false,
                    categories: ['', '', '', '', '', '', '', '', '', ''],
                    linkedTo: 0,
                    labels: {
                        step: 1 //es como decirle cuantos numeros de la categoria  aparescan en la grafica
                    }
                }],
                yAxis: {
                    title: {
                        text: 'numero de personas por edad y genero'
                    },
                    labels: {//en esta parte van las etiquetas que van abajo de la grafica
                        formatter: function () {
                            return Math.abs(this.value) + '';
                        }
                    }
                },
                plotOptions: {
                    series: {
                        stacking: 'normal'
                    }
                },
                tooltip: {
                    formatter: function () {//funcion para hacer operaciones para mostrar los datos
                        return '<div  style="background-color: #FFF; padding-top: 0px; margin-top: 0px; top: 0px;"> <b>' + this.series.name + ', age ' + categories[this.point.index] + '</b><br/>' +
                            'usuarios: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0) + '</div>';
                    }
                },

                series: [{
                    name: 'Male',
                    color: '#5294C2',
                    data: [men[1], men[2], men[3], men[4], men[5], men[6], men[7], men[8], men[9], men[10]]
                }, {
                    name: 'Female',
                    color: '#fc92cc',
                    data: [women[1], women[2], women[3], women[4], women[5], women[6], women[7], women[8], women[9], women[10]]
                }]
            });
            return elemento;
        });
    };
//------------------------grafica de barra para los años y edades
    this.gender = function gender(array) {
        console.log('entro a la  grafica de interacciones por modelos');
        var chart3 = c3.generate({
            bindto: '#intPerDay',
            data: {
                columns: [
                    ['hace 1 dia', dia1],
                    ['hace 2 dia', dia2],
                    ['hace 3 dia', dia3],
                    ['hace 4 dia', dia4],
                    ['hace 5 dia', dia5]
                ],
                type: 'bar'
                /*groups: [
                 ['Android', 'Blackberry', 'IOS', 'Windows Phone', 'other']
                 ]*/
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c', '#98df8a', '#d62728', '#ff9896', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5']
            },
            axis: {
                y: {
                    padding: {top: 200, bottom: 0}
                }
            }
        });
        return gender;
    };
//------------------------grafica de barra para las interacciones por dia
    this.intPerDay = function intPerDay(dias, cnt) {
        var graphDates = ['x'];
        var graphInt = ['interacciones'];
        for (i = 0; i < dias.length; i++) {
            graphDates[i + 1] = dias[i];
        }
        for (i = 0; i < cnt.length; i++) {
            graphInt[i + 1] = cnt[i];
        }
        //console.log(graphDates);
        //console.log(graphInt);
        var chart = c3.generate({
            bindto: '#intPerDay',
            data: {
                x: 'x',
                columns: [
                    //['x',dias[0], dias[1],dias[2],dias[3],dias[4]],
                    graphDates,
                    //                            ['interacciones por dia '],
                    //['interacciones', ['interacciones', dia1, dia2,dia3, dia4,dia5,dia6,dia7]]
                    graphInt
                ],
                type: 'bar'
            },
            bar: {
                width: {
                    ratio: 0.5 // this makes bar width 50% of length between ticks
                }
                // or
                //width: 100 // this makes bar width 100px
            },
            axis: {
                y: {
                    tick: {
                        count: 2
                    }
                },
                x: {
                    type: 'timeseries',
                    tick: {
                        format: '%d'
                        //                                format: '%Y-%m-%d'
                    }
                }
            },
            legend: {
                show: false
            }
        });
    };
    this.intPerDay2 = function intPerDay2(dias) {
        //        Interacciones por modelos
        var chart3 = c3.generate({
            bindto: '#intPerDay',
            data: {
                x: 'x',
                columns: [
                    ['x', dia1['num'],],
                    //                            ['interacciones por dia '],
                    ['interacciones', dias, dia2, dia3, dia4, dia5, dia6, dia7]
                ],
                type: 'bar'
            },
            bar: {
                width: {
                    ratio: 0.5 // this makes bar width 50% of length between ticks
                }
                // or
                //width: 100 // this makes bar width 100px
            },
            axis: {
                y: {
                    tick: {
                        count: 2
                    }
                },
                x: {
                    type: 'timeseries',
                    tick: {
                        format: '%d'
                        //                                format: '%Y-%m-%d'
                    }
                }
            },
            legend: {
                show: false
            }
        });
        return chart3;
    };
    this.intPerHour = function intPerHour(IntXDias, Load, complet, horas) {
        var c3chart_area_stacked_id = '#intXHour';

        var columns = [
            ['x'],
            ['Visto'],
            ['Completado']
        ];
        for (var k in IntXDias) {
            columns[0].push(k);
            columns[1].push(IntXDias[k]['loaded']);
            columns[2].push(IntXDias[k]['completed']);
        }

        if ($(c3chart_area_stacked_id).length) {

            var chart = c3.generate({
                bindto: c3chart_area_stacked_id,
                data: {
                    x: 'x',
                    columns: columns,
                    types: {
                        Visto: 'area',
                        Completado: 'area'
                    },
                    groups: [['Visto', 'Completado']]
                },
                color: {
                    pattern: ['#1565C0', '#727272']
                }
            });

            $window.on('debouncedresize', function () {
                c3chart_area_stacked.resize();
            });

        } else {
            console.log('error en el contenedor');
        }
    }
};

//---------------------     EJEMPLOS    ---------------------------------------------
var chart2 = c3.generate({
    bindto: '#genderAge',
    data: {
        columns: [
            ['Mujeres', 30, 200, 100, 400, 150, 250],
            ['Hombres', -130, -100, -140, -200, -150, -50]
        ],
        groups: [
            ['Mujeres', 'Hombres']
        ],
        type: 'bar'
    },
    bar: {
        width: {
            ratio: 0.5 // this makes bar width 50% of length between ticks
        }
        // or
        //width: 100 // this makes bar width 100px
    },
    color: {
        pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78']
    },
    axis: {
        y: {
            padding: {top: 10, bottom: 10}
        },
        rotated: true
    }
});


//        Interacciones por modelos
var chart3 = c3.generate({
    bindto: '#intPerDay',
    data: {
        columns: [
            ['Android', 30, 200, 200, 400, 150, 250],
            ['Blackberry', 130, 100, 100, 200, 150, 50],
            ['IOS', 230, 200, 200, 300, 250, 250],
            ['Windows Phone', 230, 200, 200, 300, 250, 250],
            ['other', 230, 200, 200, 300, 250, 250]
        ],
        type: 'bar',
        /*groups: [
         ['Android', 'Blackberry', 'IOS', 'Windows Phone', 'other']
         ]*/
    },
    color: {
        pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c', '#98df8a', '#d62728', '#ff9896', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5']
    },
    axis: {
        y: {
            padding: {top: 200, bottom: 0}
        }
    }
});

//        Visitantes por edades
var chart4 = c3.generate({
    bindto: '#chart4',
    data: {
        columns: [
            ['<13-19', 130],
            ['20-41', 12],
            ['41-60', 1],
            ['60+', 10]
        ],
        type: 'pie'
    },
    color: {
        pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c', '#98df8a', '#d62728', '#ff9896', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5']
    },
    axis: {
        y: {
            padding: {top: 200, bottom: 0}
        },
        y2: {
            padding: {top: 100, bottom: 100},
            show: true
        }
    }
});
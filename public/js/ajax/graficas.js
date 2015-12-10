var graficas;
graficas = function () {

    this.bar = function bar() {

    }
    //grafica de pastel para los sistemas operativos
    this.so = function so(array) {
        console.log(array);
        var chart4 = c3.generate({
            bindto: '#so',
            data: {
                columns: [
                    ['mac', 30],
                    ['android', 120],
                    ['windows', 34],
                    ['otros', 10]
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
        return chart4;
    }
//------------------------grafica de barra para los años y edades
    this.genderAge = function genderAge(array){

        // Data gathered from http://populationpyramid.net/germany/2015/
        $(function () {
            // Age categories
            var categories = ['0-17','18-20','21-30', '31-40', '41-50','51-60',
                '61-70', '71-80', '81-90', '91-100 +'];
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
                    categories: categories,//se le pasa el arreglo de categorias
                    reversed: false,// para decirle el orden en que van a parecer las categorias
                    labels: {
                        step: 1
                    }
                }, { // mirror axis on right side
                    opposite: true, //para que en la grafica se muestren las barras encontradas o no en la misma direccion
                    reversed: false,
                    categories: categories,
                    linkedTo: 0,
                    labels: {
                        step: 1 //es como decirle cuantos numeros de la categoria  aparescan en la grafica
                    },
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
                        return '<b>' + this.series.name + ', age ' + this.point.category + '</b><br/>' +
                            'Population: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
                    }
                },

                series: [{
                    name: 'Male',
                    color:'#5294C2',
                    data: [-1,-2,-3,-4,-5,-6,-7,-8,-9,-10]
                }, {
                    name: 'Female',
                    color:'#fc92cc',
                    data: [1,2,3,4,5,6,7,8,9,10]
                }]
            });
            return elemento;
        });
    }
//------------------------grafica de barra para los años y edades
    this.gender = function gender(array) {
        console.log('entro a la segunda grafica');
        var categoriesArr = ['> 50 años', '40-49 años', '30-39 años', '26-29 años', '18-25 años','13-17 años'];

        var gender = c3.generate({
            bindto: '#gender',
            data: {
                columns: [
                    ['hombres', -30, -200, -100, -400, -150, -250],
                    ['mujeres', 30, 200, 100, 100, 150, 250],
                ],
                type:'bar',
                labels:{
                    format: function (v,id,i,j) {

                        return categoriesArr[i];

                        /*
                         if(j==0)
                         return categoriesArr[i]+" ("+Math.abs(v)+")";

                         return "("+Math.abs(v)+") "+categoriesArr[i];*/
                    },
                },
                groups: [ ['hombres','mujeres'] ]
            },
            color: {
                pattern: ['#5294C2', '#fc92cc']
            },
            axis: {
                rotated: true,
                y:{
                    tick: {
                        format: function (y) { return Math.abs(y) }
                    },
                    center: 0
                },
                x:{
                    show:false,
                    type: 'category',
                    categories: categoriesArr,
                }
            }
        });
        gender.ygrids([
            {value: 0},
        ]);

        return gender;
    }
//------------------------grafica de barra para las interacciones por dia
    this.intPerDay = function intPerDay (dia1,dia2,dia3,dia4,dia5) {
        //        Interacciones por modelos
        var chart3 = c3.generate({
            bindto: '#intPerDay',
            data: {
                columns: [
                    ['hace 1 dia',  dia1 ],
                    ['hace 2 dia',  dia2 ],
                    ['hace 3 dia',  dia3 ],
                    ['hace 4 dia',  dia4 ],
                    ['hace 5 dia',  dia5 ]
        /*['Android', 30, 200, 200, 400, 150, 250],
         ['Blackberry', 130, 100, 100, 200, 150, 50],
         ['IOS', 230, 200, 200, 300, 250, 250],
         ['Windows Phone', 230, 200, 200, 300, 250, 250],
         ['other', 230, 200, 200, 300, 250, 250]*/
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
        return chart3;
    }

    function ajax(json_data, paso) {
        $.ajax({
            url: '/interaction/logs/' + paso,
            type: 'POST',
            dataType: 'JSON',
            data: json_data
        }).done(function (data) {
            console.log("success");
            console.log(data);
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }).always(function () {
            console.log("complete-");
        });
    }
};

//------------------------------------------------------------------
var chart1 = c3.generate({
    bindto: '#chart1',
    data: {
        columns: [
            ['Welcome', 300, 249, 400, 190, 200, 500, 450],
            ['Joined', 250, 100, 389, 120, 100, 500, 450],
            ['Requested', 200, 100, 300, 100, 450, 450, 420],
            ['Loaded', 120, 100, 250, 80, 400, 450, 410],
            ['Completed', 25, 90, 200, 60, 312, 400, 402]
        ],
        types: {
            Welcome: 'area-spline',
            Joined: 'area-spline',
            Requested: 'area-spline',
            Loaded: 'area-spline',
            Completed: 'area-spline'
            // 'line', 'spline', 'step', 'area', 'area-step' are also available to stack
        },
    },
    color: {
        pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78', '#fff000']
    },
    donut: {
        title: "nombre"
    }
});

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
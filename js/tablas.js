function autoresReservas(){

    var svg = d3.select('#autores-reservados'),
    margin = 200,
    width = svg.attr("width") - margin,
    height = svg.attr("height") - margin;

    /* Titulo */

    svg.append("text")
        .attr("transform", "translate(100,0)")
        .attr("x",250)
        .attr("y", 50)
        .attr("font-size", "24px")
        .text("Autores reservados en los últimos 90 días")

    var xScale = d3.scaleBand().range([0, 1000]).padding(0.4),
        yScale = d3.scaleLinear().range([height, 0]);

    var g = svg.append("g").attr("transform", "translate("+100+","+100+")");

    d3.json("php/autoresReservados.php").then(function(data){

            xScale.domain(data.map(function(d){return d.nombreAutor}));
            yScale.domain([0, d3.max(data, function(d){return d.cantidad * 1.1})])

            g.append('g').attr('transform','translate(0,'+height+')')
                .call(d3.axisBottom(xScale))
            
            g.append('g').call(d3.axisLeft(yScale).tickFormat(function(d){
                return d;
            }).ticks(10))
                .append("text")
                .attr("transform", "rotate(-90)")
                .attr("y", 10)
                .attr("dy", '-5em')
                .attr('text-anchor', 'end')
                .attr('font-size', '15px')
                .attr("stroke", 'black')
                .text("Cantidad de autores reservados")

            g.selectAll(".bar")
                .data(data)
                .enter().append("rect")
                .attr("class", "bar")
                .on("mouseover", onMouseOver)
                .on("mouseout", onMouseOut)
                .attr("x", function(d){return xScale(d.nombreAutor);})
                .attr("y", function(d){return yScale(d.cantidad);})
                .attr("width", xScale.bandwidth())
                .transition()
                .ease(d3.easeLinear)
                .duration(500)
                .delay(function(d,i){ return i * 50 })
                .attr("height", function(d){return height - yScale(d.cantidad);});

    });

    //Mouse over y Out eventListeners

    function onMouseOver(d, i){
        //agarra los valores X y Y
        var xPos = parseFloat(d3.select(this).attr('x')) + xScale.bandwidth() + 75;
        var yPos = parseFloat(d3.select(this).attr('y')) / 2 + height / 1.5;
    
        //Actualiza la posición del tooltip;
        d3.select('#tooltip')
            .style('left', xPos + 'px')
            .style('top', yPos + 'px')
            .select('#cantidad-reservas').text(i.cantidad)
        
        d3.select('#tooltip')
            .select('#nombre-libro').text(i.nombreAutor)
        
        d3.select('#tooltip').classed('hidden', false)
    }
    
    function onMouseOut(d, i){
    
        d3.select('#tooltip').classed('hidden', true)
    }
}

function historialReserva(){
    var svg = d3.select('#historial-reserva'),
    margin = 200,
    width = svg.attr("width") - margin,
    height = svg.attr("height") - margin;

    /* Titulo */

    svg.append("text")
        .attr("transform", "translate(100,0)")
        .attr("x",250)
        .attr("y", 50)
        .attr("font-size", "24px")
        .text("Categorias más reservadas en los últimos 90 días")

    var xScale = d3.scaleBand().range([0, 1000]).padding(0.4),
        yScale = d3.scaleLinear().range([height, 0]);

    var g = svg.append("g").attr("transform", "translate("+100+","+100+")");

    d3.json("php/allTimeReserved.php").then(function(data){
            xScale.domain(data.map(function(d){return d.nombreCategoria}));
            yScale.domain([0, d3.max(data, function(d){return d.cantidad;})])

            g.append('g').attr('transform','translate(0,'+height+')')
                .call(d3.axisBottom(xScale))
            
            g.append('g').call(d3.axisLeft(yScale).tickFormat(function(d){
                return d;
            }).ticks(10))
                .append("text")
                .attr("transform", "rotate(-90)")
                .attr("y", 10)
                .attr("dy", '-5em')
                .attr('text-anchor', 'end')
                .attr('font-size', '15px')
                .attr("stroke", 'black')
                .text("Cantidad de reservas")

            g.selectAll(".bar")
                .data(data)
                .enter().append("rect")
                .attr("class", "bar")
                .on("mouseover", onMouseOver)
                .on("mouseout", onMouseOut)
                .attr("x", function(d){return xScale(d.nombreCategoria);})
                .attr("y", function(d){return yScale(d.cantidad);})
                .attr("width", xScale.bandwidth())
                .transition()
                .ease(d3.easeLinear)
                .duration(500)
                .delay(function(d,i){ return i * 50 })
                .attr("height", function(d){return height - yScale(d.cantidad);});

    });

    function onMouseOver(d, i){
        //agarra los valores X y Y
        var xPos = parseFloat(d3.select(this).attr('x')) + xScale.bandwidth() + 100;
        var yPos = parseFloat(d3.select(this).attr('y')) / 2 + height  + 550;
    
        //Actualiza la posición del tooltip;
        d3.select('#tooltip-todo')
            .style('left', xPos + 'px')
            .style('top', yPos + 'px')
            .select('#cantidad-reservas-todo').text(i.nombreCategoria)

        d3.select('#tooltip-todo')
            .select('#nombre-libro-todo').text(i.cantidad)
        
        d3.select('#tooltip-todo').classed('hidden', false)
    }
    
    function onMouseOut(d, i){
    
        d3.select('#tooltip-todo').classed('hidden', true)
    }

}

//Cancelaciones y finalizadas
function canceladasYFinalizadas(){  

    var svg = d3.select("#can-y-fin"),
    margin = { top: 20, right: 20, bottom: 30, left: 40 },
    width = +svg.attr("width") - margin.left - margin.right,
    height = +svg.attr("height") - margin.top - margin.bottom,
    g = svg.append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    svg.append("text")
        .attr("transform", "translate(100,0)")
        .attr("x",150)
        .attr("y", 50)
        .attr("font-size", "24px")
        .text("Cantidad de reservas canceladas y finalizadas");


    var x0 = d3.scaleBand()
        .rangeRound([0, width])
        .paddingInner(0.1);

    var x1 = d3.scaleBand()
        .padding(0.05);

    var y = d3.scaleLinear()
        .rangeRound([height, 0]);

    var z = d3.scaleOrdinal()
        .range(["#000080", "#ff0000"]);

    d3.json("php/reservasFinYCan.php").then(function(data){
        console.log(data);
        var keys = Object.keys(data[0]).slice(1);
        console.log(keys);

        x0.domain(data.map(function (d) { return d.mes; }));
        x1.domain(keys).rangeRound([0, x0.bandwidth()]);
        /* y.domain([0, d3.max(data, function (d) { return d3.max(keys, function (key) { return d[key]; }); })]).nice(); */
        y.domain([0, d3.max(data, function(d){return (d.finalizado + d.cancelado) / 8;})])
        g.append("g")
            .selectAll("g")
            .data(data)
            .enter().append("g")
            .attr("transform", function (d) { return "translate(" + x0(d.mes) + ",0)"; })
            .selectAll("rect")
            .data(function (d) { 
            debugger;
            return keys.map(function (key) { 
                return { key: key, value: d[key] }; 
                }); 
            })
            .enter().append("rect")
            .attr("x", function (d) { return x1(d.key); })
            .attr("y", function (d) { return y(d.value); })
            .attr("width", x1.bandwidth())
            .attr("height", function (d) { return height - y(d.value); })
            .attr("fill", function (d) { return z(d.key); });

        g.append("g")
            .attr("class", "axis")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x0));

        g.append("g")
            .attr("class", "axis")
            .call(d3.axisLeft(y).ticks(null, "s"))
            .append("text")
            .attr("x", 2)
            .attr("y", y(y.ticks().pop()) + 0.5)
            .attr("dy", "0.32em")
            .attr("fill", "#000")
            .attr("font-weight", "bold")
            .attr("text-anchor", "start")
            .text("Cantidad de canceladas y finalizadas");

        var legend = g.append("g")
            .attr("font-family", "sans-serif")
            .attr("font-size", 10)
            .attr("text-anchor", "end")
            .selectAll("g")
            .data(keys.slice().reverse())
            .enter().append("g")
            .attr("transform", function (d, i) { return "translate(0," + i * 20 + ")"; });

        legend.append("rect")
            .attr("x", width - 19)
            .attr("width", 19)
            .attr("height", 19)
            .attr("fill", z);

        legend.append("text")
            .attr("x", width - 24)
            .attr("y", 9.5)
            .attr("dy", "0.32em")
            .text(function (d) { return d; });

    });

}

function librosReservados(){

    var svg = d3.select('#libros-treinta-dias'),
    margin = 200,
    width = svg.attr("width") - margin,
    height = svg.attr("height") - margin;

    /* Titulo */

    svg.append("text")
        .attr("transform", "translate(100,0)")
        .attr("x",250)
        .attr("y", 50)
        .attr("font-size", "24px")
        .text("Libros reservados en los últimos 30 días.")

    var xScale = d3.scaleBand().range([0, 1000]).padding(0.4),
        yScale = d3.scaleLinear().range([height, 0]);

    var g = svg.append("g").attr("transform", "translate("+100+","+100+")");

    d3.json("php/librosReservados.php").then(function(data){

            xScale.domain(data.map(function(d){return d.titulo}));
            yScale.domain([0, d3.max(data, function(d){return d.cantidad})])

            g.append('g')
                .attr('transform','translate(0,'+height+')')
                .call(d3.axisBottom(xScale))
                .selectAll(".tick text")
                .call(wrap, xScale.bandwidth());
                
            
            g.append('g').call(d3.axisLeft(yScale).tickFormat(function(d){
                return d;
            }).ticks(10))
                .append("text")
                .attr("transform", "rotate(-90)")
                .attr("y", 10)
                .attr("dy", '-5em')
                .attr('text-anchor', 'end')
                .attr('font-size', '15px')
                .attr("stroke", 'black')
                .text("Cantidad de autores reservados")

            g.selectAll(".bar")
                .data(data)
                .enter().append("rect")
                .attr("class", "bar")
                .on("mouseover", mouseOver)
                .on("mouseout", mouseOut)
                .attr("x", function(d){return xScale(d.titulo);})
                .attr("y", function(d){return yScale(d.cantidad);})
                .attr("width", xScale.bandwidth())
                .transition()
                .ease(d3.easeLinear)
                .duration(500)
                .delay(function(d,i){ return i * 50 })
                .attr("height", function(d){return height - yScale(d.cantidad);});

    });

    //Mouse over y Out eventListeners

    function mouseOver(d, i){
        //agarra los valores X y Y
        var xPos = parseFloat(d3.select(this).attr('x')) + xScale.bandwidth() + 170;
        var yPos = parseFloat(d3.select(this).attr('y')) / 2 + height / 0.13;
    
        //Actualiza la posición del tooltip;
        d3.select('#tooltip-libros')
            .style('left', xPos + 'px')
            .style('top', yPos + 'px')
            .select('#cantidad-libros').text(i.cantidad)
        
        d3.select('#tooltip-libros')
            .select('#nombre-libro').text(i.titulo)
        
        d3.select('#tooltip-libros').classed('hidden', false)
    }
    
    function mouseOut(d, i){
    
        d3.select('#tooltip-libros').classed('hidden', true)
    }

    function wrap(text, width) {
        text.each(function() {
          var text = d3.select(this),
              words = text.text().split(/\s+/).reverse(),
              word,
              line = [],
              lineNumber = 0,
              lineHeight = 1.1, // ems
              y = text.attr("y"),
              dy = parseFloat(text.attr("dy")),
              tspan = text.text(null).append("tspan").attr("x", 0).attr("y", y).attr("dy", dy + "em");
          while (word = words.pop()) {
            line.push(word);
            tspan.text(line.join(" "));
            if (tspan.node().getComputedTextLength() > width) {
              line.pop();
              tspan.text(line.join(" "));
              line = [word];
              tspan = text.append("tspan").attr("x", 0).attr("y", y).attr("dy", ++lineNumber * lineHeight + dy + "em").text(word);
            }
          }
        });
      }
}




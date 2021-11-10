function diasReserva(){

    var svg = d3.select('#dias-reserva'),
    margin = 200,
    width = svg.attr("width") - margin,
    height = svg.attr("height") - margin;

    /* Titulo */

    svg.append("text")
        .attr("transform", "translate(100,0)")
        .attr("x",250)
        .attr("y", 50)
        .attr("font-size", "24px")
        .text("Los libros más reservados de los últimos 30 días")

    var xScale = d3.scaleBand().range([0, 1000]).padding(0.4),
        yScale = d3.scaleLinear().range([height, 0]);

    var g = svg.append("g").attr("transform", "translate("+100+","+100+")");

    d3.json("php/treintaDiasReservado.php").then(function(data){

            xScale.domain(data.map(function(d){return d.titulo}));
            yScale.domain([0, d3.max(data, function(d){return d.ejem_count;})])

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
                .attr("x", function(d){return xScale(d.titulo);})
                .attr("y", function(d){return yScale(d.ejem_count);})
                .attr("width", xScale.bandwidth())
                .transition()
                .ease(d3.easeLinear)
                .duration(500)
                .delay(function(d,i){ return i * 50 })
                .attr("height", function(d){return height - yScale(d.ejem_count);});

    });

    //Mouse over y Out eventListeners

    function onMouseOver(d, i){
        //agarra los valores X y Y
        var xPos = parseFloat(d3.select(this).attr('x')) + xScale.bandwidth() + 100;
        var yPos = parseFloat(d3.select(this).attr('y')) / 2 + height / 1.5;
    
        //Actualiza la posición del tooltip;
        d3.select('#tooltip')
            .style('left', xPos + 'px')
            .style('top', yPos + 'px')
            .select('#cantidad-reservas').text(i.ejem_count)
        
        d3.select('#tooltip')
            .select('#nombre-libro').text(i.titulo)
        
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
        .text("Los libros más reservados de todos los tiempos")

    var xScale = d3.scaleBand().range([0, 1000]).padding(0.4),
        yScale = d3.scaleLinear().range([height, 0]);

    var g = svg.append("g").attr("transform", "translate("+100+","+100+")");

    d3.json("php/allTimeReserved.php").then(function(data){

            xScale.domain(data.map(function(d){return d.titulo}));
            yScale.domain([0, d3.max(data, function(d){return d.ejem_count;})])

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
                .attr("x", function(d){return xScale(d.titulo);})
                .attr("y", function(d){return yScale(d.ejem_count);})
                .attr("width", xScale.bandwidth())
                .transition()
                .ease(d3.easeLinear)
                .duration(500)
                .delay(function(d,i){ return i * 50 })
                .attr("height", function(d){return height - yScale(d.ejem_count);});

    });

    function onMouseOver(d, i){
        //agarra los valores X y Y
        var xPos = parseFloat(d3.select(this).attr('x')) + xScale.bandwidth() + 100;
        var yPos = parseFloat(d3.select(this).attr('y')) / 2 + height  + 550;
    
        //Actualiza la posición del tooltip;
        d3.select('#tooltip-todo')
            .style('left', xPos + 'px')
            .style('top', yPos + 'px')
            .select('#cantidad-reservas-todo').text(i.ejem_count)

        d3.select('#tooltip-todo')
            .select('#nombre-libro-todo').text(i.titulo)
        
        d3.select('#tooltip-todo').classed('hidden', false)
    }
    
    function onMouseOut(d, i){
    
        d3.select('#tooltip-todo').classed('hidden', true)
    }

}


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
            }).ticks(10));

            g.selectAll(".bar")
                .data(data)
                .enter().append("rect")
                .attr("class", "bar")
                .attr("x", function(d){return xScale(d.titulo);})
                .attr("y", function(d){return yScale(d.ejem_count);})
                .attr("width", xScale.bandwidth())
                .attr("height", function(d){return height - yScale(d.ejem_count);});

    });
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
            }).ticks(10));

            g.selectAll(".bar")
                .data(data)
                .enter().append("rect")
                .attr("class", "bar")
                .attr("x", function(d){return xScale(d.titulo);})
                .attr("y", function(d){return yScale(d.ejem_count);})
                .attr("width", xScale.bandwidth())
                .attr("height", function(d){return height - yScale(d.ejem_count);});

    });

}
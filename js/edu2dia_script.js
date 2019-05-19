function edu_thirdGraph(chosen_city) {

    d3.select('.svg4c').selectAll("*").remove();
    var color = ["orange", "blue", "red", "green"];
    for (m=0;m<chosen_city.length;m++){
        make_graph3(chosen_city[m],m);
    }
    function make_graph3(city_id,m){
        var max_value = 0
        //console.log(pop_data.length)
        for (i = 0; i < sc_size.length; i++){
            var record = sc_size[i];
            //console.log(record['city_id']);
            if (chosen_city.includes(record['city_id'])){
                //console.log(record['city_id']);
                var comp = Number(record['school_size']);
                if (max_value < comp){
                    max_value = comp;
                }
            }
        }
        // console.log(max_value)
        max_value = max_value * 1.05;

        // function make_y_gridlines() {
        //     return d3.axisLeft(y)
        //         .ticks(5)
        // }
        var data2 = [];
        for (k = 0; k < sc_size.length; k++){
            record = sc_size[k];
            if (sc_size[k]['city_id'] == city_id){
                data2.push(record);
                var city_name = sc_size[k]['city_name'];
            }
        }
        console.log(data2);
        var margin2 = {top: 40, right: 20, bottom: 30, left: 60},
            width2 = 300 - margin2.left - margin2.right,
            height2 = 250 - margin2.top - margin2.bottom;

        var x2 = d3.scale.ordinal()
            .rangeRoundBands([0, width2], .1);

        var y2 = d3.scale.linear()
            .range([height2, 0]);

        var xAxis2 = d3.svg.axis()
            .scale(x2)
            .orient("bottom");

        var yAxis2 = d3.svg.axis()
            .scale(y2)
            .orient("left")
            .innerTickSize(-width2)
            .outerTickSize(0)
            .tickPadding(10);
        var tip2 = d3.tip()
            .attr('class', 'd3-tip')
            .offset([-10, 0])
            .html(function(d) {
                return "<strong>School Size:</strong> <span style='color:mediumpurple'>" + Math.floor(d.school_size * 100) / 100 + " students" + "</span>";
            })
        var svg2 = d3.select(".svg4c").append("svg")
            .attr("width", width2 + margin2.left + margin2.right)
            .attr("height", height2 + margin2.top + margin2.bottom)
            .append("g")
            .attr("transform", "translate(" + margin2.left + "," + margin2.top + ")");

        svg2.call(tip2);

        // d3.json("pop_den.php", function(error, data) {
        x2.domain(data2.map(function(d) { return d.school_type; }));
        y2.domain([0, max_value]);
        svg2.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height2 + ")")
            .call(xAxis2);
        svg2.append("g")
            .attr("class", "y axis")
            .call(yAxis2)
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("x", -25)
            .attr("y", -50)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .style("font-size", "12px")
            .text("Number of Students");
        svg2.selectAll(".bar")
            .data(data2)
            .enter().append("rect")
            .attr("class", "bar")
            .attr("x", function(d) { return x2(d.school_type); })
            .attr("width", x2.rangeBand())
            .attr("y", function(d) { return y2(d.school_size); })
            .attr("height", function(d) { return height2 - y2(d.school_size); })
            .on('mouseover', tip2.show)
            .on('mouseout', tip2.hide)
            .attr("fill", function(d){ return color[m]; })
        svg2.append("text")
            .attr("x", (width2 / 2))
            .attr("y", 0 - (margin2.top / 2))
            .attr("text-anchor", "middle")
            .style("font-size", "16px")
            // .style("text-decoration", "underline")
            .text(city_name);
    }

}
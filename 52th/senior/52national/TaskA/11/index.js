function displayData(populationData) {
    let width = 500,
        height = 500;
    let svg = d3.select("#chart").append("svg")
        .attr("width", width)
        .attr("height", height)
    let xScale = d3.scaleBand()
        .domain(populationData.map(function(d) { return d.county; }))
        .rangeRound([0, width])
        .padding(0.1)
    let yScale = d3.scaleLinear()
        .domain([0, d3.max(populationData, function(d) { return +d.population; })])
        .range([height, 0])
    let bars = svg.selectAll(".bar")
        .data(populationData)
        .enter()
        .append("rect")
        .attr("class", "bar")
        .attr("x", function(d) { return xScale(d.county); })
        .attr("y", function(d) { return yScale(d.population); })
        .attr("width", xScale.bandwidth())
        .attr("height", function(d) { return height - yScale(d.population); })
}

function loadCSV(file) {
    let xhr = new XMLHttpRequest()
    xhr.open("GET", file, true)
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            parseCSV(xhr.responseText);
        }
    }
    xhr.send();
}

function parseCSV(data) {
    let rows = data.split("\n")
    let header = rows[0].split(",")
    let populationData = []
    for (let i = 1; i < rows.length; i++) {
        let population = {}
        let values = rows[i].split(",")
        for (let j = 0; j < header.length; j++) {
            population[header[j]] = values[j]
        }
        populationData.push(population)
    }
    displayData(populationData)
}


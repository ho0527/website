let fileInput = document.getElementById('csvInput');
let chartDiv = document.getElementById('chartDiv');
let populationData = [];

fileInput.addEventListener('change', function() {
  let file = fileInput.files[0];
  let reader = new FileReader();

  reader.onload = function(event) {
    let csvData = event.target.result;
    processData(csvData);
    createChart();
  };

  reader.readAsText(file);
});

function processData(csvData) {
  let lines = csvData.split('\n');

  // extract headers
  let headers = lines[0].split(',');

  for (let i = 1; i < lines.length; i++) {
    let data = lines[i].split(',');

    // extract population data
    let population = parseInt(data[2]) + parseInt(data[3]);

    // check if county exists in populationData array
    let countyIndex = populationData.findIndex(function(item) {
      return item.county === data[0];
    });

    if (countyIndex >= 0) {
      // county already exists in array, add population to existing data
      populationData[countyIndex].population += population;
      populationData[countyIndex].towns.push({
        town: data[1],
        population: population
      });
    } else {
      // add county to populationData array
      populationData.push({
        county: data[0],
        population: population,
        towns: [{
          town: data[1],
          population: population
        }]
      });
    }
  }
}

function createChart() {
  chartDiv.innerHTML = '';

  for (let i = 0; i < populationData.length; i++) {
    let county = populationData[i];
    let countyDiv = document.createElement('div');
    countyDiv.classList.add('countyDiv');
    countyDiv.textContent = county.county;
    chartDiv.appendChild(countyDiv);

    countyDiv.addEventListener('click', function() {
      let townDivs = countyDiv.querySelectorAll('.townDiv');
      if (townDivs.length > 0) {
        // town divs already exist, remove them
        for (let j = 0; j < townDivs.length; j++) {
          townDivs[j].remove();
        }
      } else {
        // create town divs
        for (let j = 0; j < county.towns.length; j++) {
          let town = county.towns[j];
          let townDiv = document.createElement('div');
          townDiv.classList.add('townDiv');
          townDiv.textContent = town.town + ': ' + town.population;
          countyDiv.appendChild(townDiv);
        }
      }
    });

    let countyPopulation = county.population.toLocaleString();
    let barHeight = countyPopulation / 10000;
    let countyBar = document.createElement('div');
    countyBar.classList.add('countyBar');
    countyBar.style.height = barHeight + 'px';
    countyBar.setAttribute('title', county.county + ': ' + countyPopulation);
    countyDiv.appendChild(countyBar);
  }
}

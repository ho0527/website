let chessboard = document.getElementById("chessboard");
let cells = chessboard.getElementsByTagName("td");

let grid = [];
for (let i = 0; i < 6; i++) {
  grid[i] = [];
  for (let j = 0; j < 7; j++) {
    grid[i][j] = 0;
  }
}

let currentPlayer = 1; // 1代表黑棋，2代表白棋
for (let i = 0; i < cells.length; i++) {
    cells[i].addEventListener("click", function() {
      let row = Math.floor(i / 7);
      let col = i % 7;
      for (let j = 5; j >= 0; j--) {
        if (grid[j][col] === 0) {
          grid[j][col] = currentPlayer;
          if (currentPlayer === 1) {
            this.style.backgroundColor = "black";
          } else {
            this.style.backgroundColor = "white";
          }
          break;
        }
      }
      currentPlayer = (currentPlayer === 1) ? 2 : 1;
      checkForWin();
    });
  }
  function checkForWin() {
    // Check rows
    for (let i = 0; i < 6; i++) {
      for (let j = 0; j < 4; j++) {
        if (grid[i][j] !== 0 &&
            grid[i][j] === grid[i][j + 1] &&
            grid[i][j] === grid[i][j + 2] &&
            grid[i][j] === grid[i][j + 3]) {
          alert("Player " + grid[i][j] + " wins!");
        }
      }
    }
  
     // Check columns
  for (let i = 0; i < 3; i++) {
    for (let j = 0; j < 7; j++) {
      if (grid[i][j] !== 0 &&
          grid[i][j] === grid[i + 1][j] &&
          grid[i][j] === grid[i + 2][j] &&
          grid[i][j] === grid[i + 3][j]) {
        alert("Player " + grid[i][j] + " wins!");
      }
    }
  }

  // Check diagonals (left to right)
  for (let i = 0; i < 3; i++) {
    for (let j = 0; j < 4; j++) {
    if (grid[i][j] !== 0 &&
    grid[i][j] === grid[i + 1][j + 1] &&
    grid[i][j] === grid[i + 2][j + 2] &&
    grid[i][j] === grid[i + 3][j + 3]) {
    alert("Player " + grid[i][j] + " wins!");
    }
    }
    }
}
const Jimp = require('jimp');

const BACKGROUND_IMG_PATH = 'image/background.jpg';
const RESULT_IMG_PATH = 'ans/result.jpg';

const PATTERN_WIDTH = 100;
const PATTERN_HEIGHT = 100;
const PATTERN_COLOR = 0x000000FF; // Black, with 100% opacity

async function drawPattern(image) {
  const { width, height } = image.bitmap;

  // Draw horizontal lines
  for (let y = 0; y < height; y += PATTERN_HEIGHT) {
    image.scan(0, y, width, 1, function(x, y, idx) {
      this.bitmap.data[idx + 0] = (PATTERN_COLOR >> 24) & 0xFF; // R
      this.bitmap.data[idx + 1] = (PATTERN_COLOR >> 16) & 0xFF; // G
      this.bitmap.data[idx + 2] = (PATTERN_COLOR >> 8) & 0xFF; // B
      this.bitmap.data[idx + 3] = PATTERN_COLOR & 0xFF; // A
    });
  }

  // Draw vertical lines
  for (let x = 0; x < width; x += PATTERN_WIDTH) {
    image.scan(x, 0, 1, height, function(x, y, idx) {
      this.bitmap.data[idx + 0] = (PATTERN_COLOR >> 24) & 0xFF; // R
      this.bitmap.data[idx + 1] = (PATTERN_COLOR >> 16) & 0xFF; // G
      this.bitmap.data[idx + 2] = (PATTERN_COLOR >> 8) & 0xFF; // B
      this.bitmap.data[idx + 3] = PATTERN_COLOR & 0xFF; // A
    });
  }
}

async function main() {
  // Load background image
  const backgroundImage = await Jimp.read(BACKGROUND_IMG_PATH);

  // Create result image with the same size as background image
  const resultImage = new Jimp(backgroundImage.bitmap.width, backgroundImage.bitmap.height);

  // Draw pattern on result image
  await drawPattern(resultImage);

  // Composite result image on top of background image
  backgroundImage.composite(resultImage, 0, 0);

  // Save result image
  await backgroundImage.writeAsync(RESULT_IMG_PATH);
}

main();

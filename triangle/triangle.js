// https://developer.mozilla.org/en-US/docs/Web/API/Canvas_API/Tutorial/Drawing_shapes
// https://www.w3schools.com/jsref/met_element_addeventlistener.asp

let ctx = document.querySelector("#triangle");
let context = ctx.getContext("2d");


// draw a triangle ABC
function triangle(x, y) {
  context.beginPath();
  context.moveTo(x, y);
  context.lineTo(x - 100, y + 200);
  context.lineTo(x + 100, y + 200);
  context.closePath();
  context.lineWidth = 2;
  context.stroke();
  context.font = "30px Arial";
  context.fillText("C", x - 10, y - 5);
  context.fillText("A", x - 120, y + 200);
  context.fillText("B", x + 100, y + 200);
}

// fill color when clicking on the triangle
ctx.addEventListener("click", function (event) {
  let x = event.pageX - ctx.offsetLeft;
  let y = event.pageY - ctx.offsetTop;

  if (context.isPointInPath(x, y)) {
    context.fillStyle = "red";
    context.fill();
  }
});

// remove color when clicking outside the triangle
ctx.addEventListener("click", function (event) {
  let x = event.pageX - ctx.offsetLeft;
  let y = event.pageY - ctx.offsetTop;
  if (context.isPointInPath(x, y)) {
    return;
  }

  context.fillStyle = "#ffffff";
  context.fill();
});

// call the function
triangle(500, 200);

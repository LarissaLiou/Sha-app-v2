var selected = [];

function selectCategory() {
  // console.log("selectCategory function called");
  if (
    this.style.backgroundColor == "silver" ||
    this.style.backgroundColor == "#9c9999"
  ) {
    this.style.backgroundColor = "gray";
    selected.push(this.getElementsByClassName("interest-name")[0].innerHTML);
  } else {
    this.style.backgroundColor = "silver";
    selected.splice(
      selected.indexOf(
        this.getElementsByClassName("interest-name")[0].innerHTML
      ),
      1
    );
  }

  // console.log(selected);

  const jsonArray = JSON.stringify(selected);
  // console.log(jsonArray);
  document.getElementById("interestsArray").value = jsonArray;
}

// submit function

// function submitNext(selected_interest_arry) {
//   console.log("submitNext function called");
//   console.log(JSON.stringify(selected_interest_arry));

//   // run multiple requests
//   if (selected_interest_arry.length > 0) {
//     for (i = 0; i < selected_interest_arry.length; i++) {
//       fetch("backend/interest3-end-point.php", {
//         method: "POST",
//         headers: {
//           "Content-Type": "application/json; charset=utf-8",
//         },
//         body: JSON.stringify(selected_interest_arry[i]),
//       })
//         .then(function (response) {
//           return response.text();
//         })
//         .then(function (data) {
//           console.log("data: ", data);
//         });
//       // .then((window.location.href = "../index.php?filename=home"));
//     }
//   } else {
//     console.log("Skiped");
//   }

// fetch("../backend/interest-end-point.php", {
//   method: "POST",
//   headers: {
//     "Content-Type": "application/json; charset=utf-8",
//   },
//   body: JSON.stringify(selected_interest_arry),
// })
//   .then(function (response) {
//     return response.text();
//   })
//   .then(function (data) {
//     console.log("data: ", data);
//   });
// }

function returnHome() {
  console.log("selectCategory function called");
}

function initialise() {
  console.log("initialise function called");
  var interests = document.getElementsByClassName("interest-items");
  var submitBtn = document.getElementById("submitBtn");
  var navLogo = document.getElementById("nav-logo");

  for (element of interests) {
    element.addEventListener("click", selectCategory);
    element.style.backgroundColor = "silver";
  }
  // submitBtn.addEventListener("click", () => {
  //   submitNext(selected);
  // });
}

window.onload = initialise;

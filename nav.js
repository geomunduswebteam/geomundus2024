// Based on https://stackoverflow.com/questions/31954089/how-can-i-reuse-a-navigation-bar-on-multiple-pages/42333464#42333464
fetch("nav.html")
  .then((response) => response.text())
  .then((data) => {
    let old_element = document.querySelector("script#replace_with_navbar");
    let new_element = new DOMParser()
      .parseFromString(data, "text/html")
      .querySelector("nav");
    old_element.parentNode.replaceChild(new_element, old_element);
  })
  .catch((err) => console.log(err));

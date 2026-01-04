// Head menu
const burger = document.querySelector(".burger_tab");
const menu = document.querySelector(".head_menu");
const body = document.querySelector("body");

burger.addEventListener("click", () => {
  burger.classList.toggle("active");
  menu.classList.toggle("active");
  body.classList.toggle("no-scroll");
});

// Tabs
const tabButtons = document.querySelectorAll(".tab_btn");
const tabContents = document.querySelectorAll(".tab_content");

tabButtons.forEach((btn) => {
  btn.addEventListener("click", () => {
    const tab = btn.dataset.tab;

    tabButtons.forEach((b) => b.classList.remove("active"));
    btn.classList.add("active");

    tabContents.forEach((content) => {
      content.classList.remove("active");
      if (content.id === tab) {
        content.classList.add("active");
      }
    });
  });
});

// Home slide
var homeSlide = new Swiper(".homeSlide", {
  speed: 700,
  loop: true,
  pagination: {
    el: ".swiper-pagination",
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

// productTabs
const productTabs = document.querySelectorAll(".products_content-tabs .tab");

productTabs.forEach((tab) => {
  tab.addEventListener("click", () => {
    productTabs.forEach((t) => t.classList.remove("active"));

    tab.classList.add("active");
  });
});

// Select tabs
const selects = document.querySelectorAll(".custom-select");

selects.forEach((sel) => {
  const display = sel.querySelector(".select-display");
  const arrow = sel.querySelector(".arrow-box");
  const options = sel.querySelectorAll(".option");

  function toggle() {
    sel.classList.toggle("active");
  }

  display.onclick = toggle;
  arrow.onclick = toggle;

  options.forEach((opt) => {
    opt.onclick = () => {
      display.textContent = opt.textContent;
      sel.classList.remove("active");
    };
  });
});

document.addEventListener("click", (e) => {
  selects.forEach((sel) => {
    if (!sel.contains(e.target)) sel.classList.remove("active");
  });
});

// Checkbox
document.querySelectorAll(".checkbox-block").forEach((block) => {
  const box = block.querySelector(".custom-checkbox");

  block.addEventListener("click", () => {
    box.classList.toggle("checked");
  });
});

// Basket calc
document.querySelectorAll('.basket_calc').forEach(calc => {
  const minus = calc.querySelector('.minus');
  const plus = calc.querySelector('.plus');
  const num = calc.querySelector('.num');

  plus.addEventListener('click', () => {
    num.textContent = Number(num.textContent) + 1;
  });

  minus.addEventListener('click', () => {
    let current = Number(num.textContent);
    if (current > 0) {
      num.textContent = current - 1;
    }
  });
});

// Basket modal
const modal = document.querySelector('.basket_modal');
const basketOpens = document.querySelectorAll('.basketOpen');

basketOpens.forEach(open => {
  open.addEventListener('click', (e) => {
    e.stopPropagation(); 
    modal.classList.toggle('active'); 
  });
});

document.addEventListener('click', (e) => {
  if (!modal.contains(e.target)) {
    modal.classList.remove('active');
  }
});